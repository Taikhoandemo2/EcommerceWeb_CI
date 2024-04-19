<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RevenueController extends CI_Controller
{
    public function index()
    {
        // Load model
        $this->load->model('RevenueModel');

        // Lấy danh sách đơn hàng
        $orders = $this->RevenueModel->getAllOrders();

        // Khởi tạo biến để lưu tổng doanh thu


        // Tính tổng doanh thu từ mỗi đơn hàng
        $order_totals = array();

        // Duyệt qua từng đơn hàng để tính tổng tiền cho mỗi Order Code
        foreach ($orders as $order) {
            // Lấy tổng tiền cho Order Code hiện tại
            $total_amount = $this->RevenueModel->calculateOrderTotal($order->id);

            // Nếu đã có tổng tiền cho Order Code này, cộng thêm vào tổng tiền hiện có
            if (isset($order_totals[$order->order_code])) {
                $order_totals[$order->order_code] += $total_amount;
            } else { // Nếu chưa có, khởi tạo tổng tiền cho Order Code này
                $order_totals[$order->order_code] = $total_amount;
            }

        }

        // Gửi dữ liệu tổng doanh thu và danh sách đơn hàng đến view

        $data['order_totals'] = $order_totals;
        $data['orders'] = $orders;

        // Load view
        $this->load->view('revenue/revenue_view', $data);
    }
    public function export_excel()
    {
        // Load thư viện PHPExcel
        $this->load->library('PHPExcel');

        // Tạo một object PHPExcel mới
        $objPHPExcel = new PHPExcel();

        // Set thuộc tính cho object PHPExcel
        $objPHPExcel->getProperties()->setCreator("Your Name")
            ->setLastModifiedBy("Your Name")
            ->setTitle("Revenue Report")
            ->setSubject("Revenue Report")
            ->setDescription("Revenue Report")
            ->setKeywords("excel php")
            ->setCategory("Report");

        // Thêm dữ liệu vào sheet "Revenue"
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Order Code');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Total Amount');

        $row = 2;
        foreach ($this->order_totals as $order_code => $total_amount) {
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $order_code);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $total_amount);
            $row++;
        }

        // Tạo tên file
        $filename = 'revenue_report_' . date('YmdHis') . '.xlsx';

        // Thiết lập header cho file excel
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Tạo đối tượng writer
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        // Ghi file excel vào đường dẫn tạm thời
        $objWriter->save('php://output');
    }
}
?>