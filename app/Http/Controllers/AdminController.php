<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB;
use Session;
use PDF;
use Illuminate\Support\Facades\Redirect;
session_start();
use Carbon\Carbon;
use App\Models\Statistic;

class AdminController extends Controller
{
    public function AuthLogin() {
    $admin_id = Session::get('admin_id');
    if ($admin_id) {
        return Redirect::to('dashboard');
    } else {
        return Redirect::to('admin')->send(); 
    }
}
    public function filter_by_date(Request $request) {
    $data = $request->all();
    $from_date = $data['from_date'];
    $to_date = $data['to_date'];

    $get = Statistic::whereBetween('order_date', [$from_date, $to_date])
                    ->orderBy('order_date', 'ASC')
                    ->get();

    $chart_data = []; 

    foreach ($get as $key => $val) { 
        $chart_data[] = array(
            'period' => $val->order_date,
            'order' => $val->total_order,
            'sales' => $val->sales,
            'profit' => $val->profit,
            'quantity' => $val->quantity,
        );
    }

    return response()->json($chart_data); 
}

   public function printStatisticsReportByDate($from_date, $to_date)
{
    
    $statistics = Statistic::whereBetween('order_date', [$from_date, $to_date])
                           ->orderBy('order_date', 'ASC')
                           ->get();

    
    if ($statistics->isEmpty()) {
        return response()->json(['message' => 'Không có dữ liệu cho khoảng thời gian này.']);
    }

    
    $totalOrders = 0;
    $totalSales = 0;
    $totalQuantity = 0;

    
    $output = '
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }
        h2 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: center;
            font-size: 14px;
            color: #333;
        }
        th {
            background-color: #f2f2f2;
            color: black;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
    </style>

    <h2>Thống Kê Doanh Số Từ '.$from_date.' Đến '.$to_date.'</h2>
    <table>
        <thead>
            <tr>
                <th>Ngày</th>
                <th>Đơn hàng</th>
                <th>Doanh số</th>
                <th>Số lượng bán</th>
            </tr>
        </thead>
        <tbody>';

    
    foreach ($statistics as $stat) {
        $output .= '
        <tr>
            <td>'.\Carbon\Carbon::parse($stat->order_date)->format('d/m/Y').'</td>
            <td>'.$stat->total_order.'</td>
            <td>'.number_format($stat->sales, 0, ',', '.').' đ</td>
            <td>'.$stat->quantity.'</td>
        </tr>';

        
        $totalOrders += $stat->total_order;
        $totalSales += $stat->sales;
        $totalQuantity += $stat->quantity;
    }

    
    $output .= '
        <tr>
            <td><strong>Tổng cộng</strong></td>
            <td><strong>'.$totalOrders.'</strong></td>
            <td><strong>'.number_format($totalSales, 0, ',', '.').' đ</strong></td>
            <td><strong>'.$totalQuantity.'</strong></td>
        </tr>';

    
    $output .= '
        </tbody>
    </table>';

    
    $pdf = PDF::loadHTML($output);
    return $pdf->stream('statistics_report_'.$from_date.'_to_'.$to_date.'.pdf');
}


    public function index(){
        return view('admin_login');
    }
    public function show_dashboard(){
        $this->AuthLogin();
        return view('admin.dashboard');
    }
    public function dashboard(Request $Request){
        $admin_email = $Request->admin_email;
        $admin_password = md5($Request->admin_password);

        $result = DB::table('tbl_admin')->where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();
        if($result){
            Session::put('admin_name',$result->admin_name);
            Session::put('admin_id',$result->admin_id);
          return Redirect::to('/dashboard');
        }
        else {
            Session::put('message','Sai tài khoản hoặc mật khẩu');
            return Redirect::to('/admin');
        }
    }
    public function logout(){
        $this->AuthLogin();
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return Redirect::to('/admin');
    }
}
