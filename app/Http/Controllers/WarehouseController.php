<?php
namespace App\Http\Controllers;

use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    // Kiểm tra nếu đã đăng nhập
    public function AuthLogin() {
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('dashboard'); // Thêm dấu chấm phẩy ở đây
        } else {
            return Redirect::to('admin')->send();
        }
    }

    // Hiển thị form thêm kho
    public function add_warehouse(){
        $this->AuthLogin();
        return view('admin.add_warehouse');
    }

    // Hiển thị tất cả kho
    public function all_warehouse(){
        $this->AuthLogin();
        $all_warehouse = DB::table('tbl_warehouse')->paginate(10);
        $manager_warehouse = view('admin.all_warehouse')->with('all_warehouse', $all_warehouse);
        return view('admin_layout')->with('admin.all_warehouse', $manager_warehouse);
    }

    // Lưu thông tin kho vào database
    public function save_warehouse(Request $request){
        // Thêm các yêu cầu xác thực
        $request->validate([
            'warehouse_name' => 'required',
            'warehouse_address' => 'required',
            'warehouse_status' => 'required'
        ], [
            'warehouse_name.required' => 'Vui lòng nhập tên kho.',
            'warehouse_address.required' => 'Vui lòng nhập địa chỉ kho.',
            'warehouse_status.required' => 'Vui lòng chọn trạng thái kho.'
        ]);

        // Nếu xác thực thành công, thêm dữ liệu vào database
        $data = array();
        $data['warehouse_name'] = $request->warehouse_name;
        $data['warehouse_address'] = $request->warehouse_address;
        $data['warehouse_status'] = $request->warehouse_status;

        DB::table('tbl_warehouse')->insert($data);
        Session::put('message', 'Thêm kho thành công');
        return Redirect::to('/add-warehouse');
    }

    // Vô hiệu hóa kho
    public function unactive_warehouse($warehouse_id){
        $this->AuthLogin();
        DB::table('tbl_warehouse')
            ->where('warehouse_id', $warehouse_id)
            ->update(['warehouse_status' => 1]); // Vô hiệu hóa kho

        Session::put('message', 'Không kích hoạt kho thành công');
        return Redirect::to('all-warehouse');
    }

    // Kích hoạt kho
    public function active_warehouse($warehouse_id){
        $this->AuthLogin();
        DB::table('tbl_warehouse')
            ->where('warehouse_id', $warehouse_id)
            ->update(['warehouse_status' => 0]); // Kích hoạt kho

        Session::put('message', 'Kích hoạt kho thành công');
        return Redirect::to('all-warehouse');
    }

    // Chỉnh sửa kho
    public function edit_warehouse($warehouse_id){
        $this->AuthLogin();
        $all_warehouse = DB::table('tbl_warehouse')->where('warehouse_id', $warehouse_id)->get();
        $manager_warehouse = view('admin.edit_warehouse')->with('edit_warehouse', $all_warehouse);
        return view('admin_layout')->with('admin.edit_warehouse', $manager_warehouse);
    }

    // Cập nhật kho
    public function update_warehouse(Request $request, $warehouse_id){
        $this->AuthLogin();
        $data = array();
        $data['warehouse_name'] = $request->warehouse_name;
        $data['warehouse_address'] = $request->warehouse_address;
        DB::table('tbl_warehouse')->where('warehouse_id', $warehouse_id)->update($data);
        Session::put('message', 'Cập nhật kho thành công');
        return Redirect::to('all-warehouse');
    }

    // Xóa kho
    public function delete_warehouse($warehouse_id){
        $this->AuthLogin();
        DB::table('tbl_warehouse')->where('warehouse_id', $warehouse_id)->delete();
        Session::put('message', 'Xóa kho thành công');
        return Redirect::to('all-warehouse');
    }
}

