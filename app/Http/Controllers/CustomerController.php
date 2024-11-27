<?php

namespace App\Http\Controllers;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
use Illuminate\Http\Request;
class CustomerController extends Controller
{
    //customer backend
    public function AuthLogin() {
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('dashboard'); // Thêm dấu chấm phẩy ở đây
        } else {
            return Redirect::to('admin')->send();
        }
    }
    public function all_customer() {
        $this->AuthLogin();
        $all_customer = DB::table('tbl_customers')->paginate(10);
        $manager_customer = view('admin.all_customer')->with('all_customer',$all_customer);
        return view('admin_layout')->with('admin.all_customer', $manager_customer);
    }



}
