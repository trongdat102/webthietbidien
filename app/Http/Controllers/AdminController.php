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
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Shared\ZipArchive;

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

    public function insertStatisticsToWord($from_date, $to_date)
{
    // Lấy dữ liệu thống kê từ database
    $statistics = Statistic::whereBetween('order_date', [$from_date, $to_date])
                           ->orderBy('order_date', 'ASC')
                           ->get();
    
    $templatePath = storage_path('app/templates/thong_ke.docx');
    $templateProcessor = new TemplateProcessor($templatePath);

    // Điền thông tin từ ngày và đến ngày vào Word template
    $templateProcessor->setValue('from_date', $from_date);
    $templateProcessor->setValue('to_date', $to_date);

    // Khởi tạo các biến tổng
    $tableData = [];
    $totalOrders = 0;
    $totalQuantity = 0;
    $totalSales = 0;

    // Duyệt qua từng bản ghi để lấy dữ liệu và tính toán tổng
    foreach ($statistics as $stat) {
        $tableData[] = [
            'order_date' => \Carbon\Carbon::parse($stat->order_date)->format('d/m/Y'),
            'quantity' => $stat->quantity,
            'total_order' => $stat->total_order,
            'total_sales' => number_format($stat->sales, 0, ',', '.') . ' đ',
        ];

        // Tính tổng sau mỗi vòng lặp
        $totalOrders += $stat->total_order;
        $totalQuantity += $stat->quantity;
        $totalSales += $stat->sales;
    }

    // Clone bảng và điền dữ liệu vào Word
    $templateProcessor->cloneRowAndSetValues('order_date', $tableData);

    // Điền thêm tổng cộng vào Word
    $templateProcessor->setValue('total_order', $totalOrders);
    $templateProcessor->setValue('quantity', $totalQuantity);
    $templateProcessor->setValue('sales', number_format($totalSales, 0, ',', '.') . ' đ');

    // Lưu file Word
    $fileName = 'thong_ke_tu_ngay_' . $from_date . '_den_ngay_' . $to_date . '.docx';
    $filePath = storage_path('app/templates/' . $fileName);

    $templateProcessor->saveAs($filePath);

    // Trả file về cho người dùng
    return response()->download($filePath)->deleteFileAfterSend(true);
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
            Session::put('admin_role', $result->admin_role);
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
    public function registerAdmin(){
        
        return view('admin.add_admin');
    }
    public function add_admin(Request $request) {

    $admin_name = $request->admin_name;
    $admin_email = $request->admin_email;
    $admin_password = md5($request->admin_password);
    $admin_phone = $request->admin_phone;


    $existingAdmin = DB::table('tbl_admin')->where('admin_email', $admin_email)->first();
    if ($existingAdmin) {

        Session::put('message', 'Email này đã được đăng ký. Vui lòng thử email khác.');
        return Redirect::to('/admin-register'); 
    }


    DB::table('tbl_admin')->insert([
        'admin_name' => $admin_name,
        'admin_email' => $admin_email,
        'admin_password' => $admin_password,
        'admin_phone' => $admin_phone,
        'admin_role' => 0
    ]);


    Session::put('message', 'Đăng ký thành công. Bạn có thể đăng nhập.');
    return Redirect::to('/admin');
}

    public function assignRole(Request $request) {

    if (Session::get('admin_role') != 1) {
        Session::flash('message', 'Bạn không có quyền thay đổi quyền admin!');
        return Redirect::to('/dashboard');
    }

    $admin_id = $request->admin_id;
    $new_role = $request->admin_role;


    DB::table('tbl_admin')->where('admin_id', $admin_id)->update(['admin_role' => $new_role]);

    Session::flash('message', 'Cập nhật quyền thành công!');
    return Redirect::to('/manage-admin');
}

    public function manageAdmins() {
    if (Session::get('admin_role') != 1) {
        return Redirect::to('/dashboard')->with('message', 'Không có quyền truy cập!');
    }

    $admins = DB::table('tbl_admin')->get();

    return view('admin.manage_admin')->with('admins', $admins);
}
    public function handle($request, Closure $next) {
    if (Session::get('admin_role') != 1) {
        return Redirect::to('/dashboard');
    }
    return $next($request);
}

}
