<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Báo Cáo Thống Kê</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .header { text-align: center; font-size: 20px; font-weight: bold; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table, .table th, .table td { border: 1px solid black; }
        .table th, .table td { padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <div class="header">Báo Cáo Thống Kê Doanh Số</div>
    <p>Ngày lập báo cáo: {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>

    <table class="table">
        <thead>
            <tr>
                <th>Ngày</th>
                <th>Đơn hàng</th>
                <th>Doanh số</th>
                <th>Lợi nhuận</th>
                <th>Số lượng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($statistics as $stat)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($stat->order_date)->format('d/m/Y') }}</td>
                    <td>{{ $stat->total_order }}</td>
                    <td>{{ number_format($stat->sales, 0, ',', '.') }} đ</td>
                    <td>{{ number_format($stat->profit, 0, ',', '.') }} đ</td>
                    <td>{{ $stat->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
