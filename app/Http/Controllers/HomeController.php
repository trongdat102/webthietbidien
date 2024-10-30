<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class HomeController extends Controller
{
    public function index(){

    $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id', 'desc')->get();

    $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id', 'desc')->get();

    $provider_product = DB::table('tbl_provider_product')->where('provider_status','0')->orderby('provider_id', 'desc')->get(); 
        // $all_product = DB::table('tbl_product')
        // ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
        // ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        // ->join('tbl_provider_product', 'tbl_provider_product.provider_id', '=', 'tbl_product.provider_id')
        // ->select('tbl_product.*', 'tbl_category_product.category_name', 'tbl_brand.brand_name', 'tbl_provider_product.provider_name')
        // ->get(); // Lấy dữ liệu từ cơ sở dữ liệu
    $all_product = DB::table('tbl_product')->where('product_status','0')->orderby('created_at', 'desc')->limit(4)->get();
    return view('pages.home')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product', $all_product);

    }
    public function search(Request $request){
    $keywords = $request->keywords_submit;

    $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id', 'desc')->get();

    $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id', 'desc')->get();

    $provider_product = DB::table('tbl_provider_product')->where('provider_status','0')->orderby('provider_id', 'desc')->get(); 
        // $all_product = DB::table('tbl_product')
        // ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
        // ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        // ->join('tbl_provider_product', 'tbl_provider_product.provider_id', '=', 'tbl_product.provider_id')
        // ->select('tbl_product.*', 'tbl_category_product.category_name', 'tbl_brand.brand_name', 'tbl_provider_product.provider_name')
        // ->get(); // Lấy dữ liệu từ cơ sở dữ liệu
    // Kiểm tra nếu không có từ khóa tìm kiếm
    if (empty($keywords)) {
    return view('pages.sanpham.search')->with('category', $cate_product)->with('brand', $brand_product)->with('search_product', collect([]));
    }
        $search_product = DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->get();

    return view('pages.sanpham.search')->with('category',$cate_product)->with('brand',$brand_product)->with('search_product',$search_product);
    }
}