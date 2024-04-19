<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revenue</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ccc;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tfoot {
            font-weight: bold;
        }

        tfoot td:first-child {
            text-align: right;
        }

        tfoot td:last-child {
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1
            style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #4CAF50; text-align: center; text-transform: uppercase; letter-spacing: 2px;">
            Revenue</h1>
        <div style="display: flex; justify-content: center; align-items: center; margin-top: 20px;">
            <input type="date" id="searchDate"
                style="margin-right: 10px; padding: 8px; border-radius: 5px; border: 1px solid #ccc;">

            <button onclick="searchByDate()"
                style="background-color: #4CAF50; border: none; color: white; padding: 8px 16px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer; border-radius: 5px;">
                Find Data by Date
            </button>
        </div>
        <table>
            <thead>
                <tr>
                    <th style="text-align: center;">Order Code</th>
                    <th style="text-align: center;">Total Amount</th>
                    <th style="text-align: center;">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Kết nối database và truy vấn để lấy dữ liệu từ bảng revenue
                $this->load->model('RevenueModel');
                $revenueData = $this->RevenueModel->getAllRevenue();
                $totalRevenue = 0;
                // Duyệt qua mỗi dòng dữ liệu và hiển thị trong bảng
                foreach ($revenueData as $row): ?>
                    <tr>
                        <td><?php echo $row->order_code; ?></td>
                        <td><?php echo number_format($row->total_amount, 0, ',', '.'); ?></td>
                        <td><?php echo date('Y-m-d', strtotime($row->date)); ?></td>
                        <?php
                        $totalRevenue += $row->total_amount;
                        ?>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>

        </tbody>
        <tfoot>
            <tr>
                <td style="text-align: center;">
                    <strong style="color: #ff0000; font-size: 18px; font-weight: bold;">Total Revenue:</strong>
                </td>
                <td style="text-align: center;">
                    <strong
                        style="color: #ff0000; font-size: 18px;"><?php echo number_format($totalRevenue, 0, ',', '.'); ?></strong>
                </td>

            </tr>
        </tfoot>
        </table>
    </div>
    <div style="display: flex; justify-content: center; align-items: center; ">
        <button onclick="exportToExcel()" style="background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 10px;">
            Xuất Excel
        </button>
    </div>



    <!-- Script JavaScript -->
    <script>
        function exportToExcel() {
            // Dữ liệu từ PHP được chuyển sang JavaScript
            var data = <?php echo json_encode($revenueData); ?>;
            var date = '<?php echo date("Y-m-d"); ?>'; // Lấy ngày hiện tại
            var totalRevenue = <?php echo $totalRevenue; ?>; // Lấy tổng doanh thu

            // Tạo một danh sách chứa dữ liệu
            var excelData = [
                ["Order Code", "Date", "Total Amount"]
            ];

            // Lặp qua dữ liệu và thêm vào danh sách
            data.forEach(function (row) {
                excelData.push([row.order_code, row.total_amount, row.date]);
            });

            // Thêm dòng Total Revenue vào danh sách dữ liệu
            excelData.push(["Total Revenue", "", totalRevenue]);

            // Tạo workbook và worksheet
            var wb = XLSX.utils.book_new();
            var ws = XLSX.utils.aoa_to_sheet(excelData);

            // Thêm worksheet vào workbook
            XLSX.utils.book_append_sheet(wb, ws, "Revenue Report");

            // Tạo và tải file Excel
            XLSX.writeFile(wb, 'revenue_report.xlsx');
        }
        function searchByDate() {
            var searchDate = document.getElementById("searchDate").value;
            // Lặp qua các hàng trong bảng và ẩn đi những hàng không phù hợp với ngày tìm kiếm
            var tableRows = document.querySelectorAll("tbody tr");
            tableRows.forEach(function (row) {
                var rowDate = row.querySelector("td:nth-child(3)").textContent;
                if (rowDate !== searchDate) {
                    row.style.display = "none";
                } else {
                    row.style.display = "";
                }
            });
        }
    </script>

</body>

</html>