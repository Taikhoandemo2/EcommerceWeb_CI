<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RevenueModel extends CI_Model
{
    public function getAllOrders()
    {
        return $this->db->get('order_details')->result();
    }
    public function getAllRevenue()
    {
        return $this->db->get('revenue')->result();
    }

    public function getOrderCode($code)
    {
        return $this->db->get_where('order_details', array('order_code' => $code))->result();
    }
    public function getOrderDetails($id)
    {
        return $this->db->get_where('order_details', array('id' => $id))->result();
    }
    public function selectProductPrize()
    {
        $query = $this->db->select('products.*')
            ->from('order_details')
            ->join('products', 'products.id=order_details.product_id')
            ->get();
        return $query->result();
    }
    public function insert($data_revenue)
    {
        return $this->db->insert('revenue', $data_revenue);
    }
    // public function calculateOrderTotal($order_id)
    // {
    //     // Lấy danh sách giá tiền của sản phẩm trong đơn hàng
    //     $product_prices = $this->selectProductPrize();

    //     // Lấy chi tiết đơn hàng
    //     $order_details = $this->getOrderDetails($order_id);

    //     // Khởi tạo tổng giá tiền
    //     $total_amount = 0;

    //     // Tính tổng giá tiền từ chi tiết đơn hàng
    //     foreach ($order_details as $detail) {
    //         // Tìm giá tiền của sản phẩm từ danh sách giá tiền
    //         foreach ($product_prices as $product_price) {
    //             if ($product_price->id == $detail->product_id) {
    //                 // Tính tổng giá tiền của sản phẩm
    //                 $total_amount += $product_price->price * $detail->quantity;
    //                 break;
    //             }
    //         }
    //     }

    //     return $total_amount;
    // }
    public function calculateOrderTotal($order_id)
    {
        $this->db->select('SUM(products.price * order_details.quantity) as total_amount')
            ->from('order_details')
            ->join('products', 'products.id = order_details.product_id')
            ->where('order_details.id', $order_id);

        $query = $this->db->get();
        $result = $query->row();

        if ($result && $result->total_amount) {
            return $result->total_amount;
        } else {
            return 0;
        }
    }
    public function calculateOrderByCodeTotal($order_id)
    {
        $this->db->select('top 1 sum(products.price * order_details.quantity) as total_amount')
            ->from('order_details')
            ->join('products', 'products.id = order_details.product_id')
            ->where('order_details.order_code', $order_id);

        $query = $this->db->get();
        $result = $query->row();

        if ($result && $result->total_amount) {
            return $result->total_amount;
        } else {
            return 0;
        }
    }
}

