<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Warehouse;
use App\Models\WarehouseDetail;
use Session;
session_start();

class WarehouseDetailsController extends Controller
{
    public function inventory()
    {
        // Lấy tất cả các sản phẩm với thông tin từ warehouse_details (bao gồm giá nhập)
        $products = Product::with(['warehouseDetails' => function($query) {
            $query->select('product_id', 'warehouse_details_price'); // Lấy trường giá nhập
        }])->paginate(10);

        // Trả về view với danh sách sản phẩm
        return view('admin.warehouse_inventory', compact('products'));
    }

    // Hiển thị form thêm hàng vào kho
    public function create()
    {
        // Lấy tất cả sản phẩm và kho
        $products = Product::all();
        $warehouses = Warehouse::all();

        // Trả về view thêm hàng vào kho
        return view('admin.add_warehouse_stock', compact('products', 'warehouses'));
    }
    public function editDetail($warehouse_details_id)
    {
        // Lấy thông tin chi tiết kho từ warehouse_details theo warehouse_details_id
        $detail = WarehouseDetail::find($warehouse_details_id);

        // Lấy tên kho từ bảng Warehouse
        $warehouse = Warehouse::find($detail->warehouse_id);

        // Lấy danh sách sản phẩm
        $product = Product::find($detail->product_id);

        // Trả về view chỉnh sửa chi tiết kho
        return view('admin.edit_warehouse_detail', compact('detail', 'warehouse', 'product'));
    }

    // Sau khi cập nhật thành công chi tiết kho
    public function updateDetail(Request $request, $warehouse_details_id)
    {
        // Xác thực dữ liệu chỉ cho phép sửa số lượng và giá nhập
        $request->validate([
            'warehouse_details_quantity' => 'required|integer|min:1',
            'warehouse_details_price' => 'required|numeric|min:0',
        ]);

        // Lấy chi tiết kho cần chỉnh sửa
        $warehouseDetail = WarehouseDetail::find($warehouse_details_id);

        // Cập nhật số lượng và giá nhập
        $warehouseDetail->warehouse_details_quantity = $request->warehouse_details_quantity;
        $warehouseDetail->warehouse_details_price = $request->warehouse_details_price;
        $warehouseDetail->updated_at = now();
        $warehouseDetail->save();

        // Cập nhật lại số lượng sản phẩm trong bảng `products`
        $product = Product::find($warehouseDetail->product_id);
        $product->product_quantity += ($request->warehouse_details_quantity - $warehouseDetail->warehouse_details_quantity);
        $product->save();

        // Thêm thông báo thành công
        Session::put('message', 'Cập nhật chi tiết sản phẩm thành công!');

        // Chuyển hướng về trang chi tiết kho
        return redirect()->route('warehouse.details', ['warehouse_id' => $warehouseDetail->warehouse_id]);
    }

// Sau khi xóa chi tiết kho thành công
    public function deleteDetail($warehouse_details_id)
    {
        $warehouseDetail = WarehouseDetail::find($warehouse_details_id);

        // Lưu lại thông tin sản phẩm trước khi xóa
        $product = Product::find($warehouseDetail->product_id);
        $product->product_quantity -= $warehouseDetail->warehouse_details_quantity;
        $product->save();

        // Xóa chi tiết kho
        $warehouseDetail->delete();

        // Thêm thông báo xóa thành công
        Session::put('message', 'Xóa sản phẩm khỏi kho thành công!');

        // Chuyển hướng về trang chi tiết kho
        return redirect()->route('warehouse.details', ['warehouse_id' => $warehouseDetail->warehouse_id]);
    }


    // Lưu thông tin nhập hàng vào kho
    public function store(Request $request)
    {
        // Xác thực dữ liệu
        $request->validate([
            'warehouse_id' => 'required|exists:tbl_warehouse,warehouse_id',
            'product_id' => 'required|exists:tbl_product,product_id',
            'warehouse_details_quantity' => 'required|integer|min:1',
            'warehouse_details_price' => 'required|numeric|min:0',
        ]);

        // Tạo bản ghi nhập hàng vào kho
        $warehouseDetails = new WarehouseDetail();
        $warehouseDetails->warehouse_id = $request->warehouse_id;
        $warehouseDetails->product_id = $request->product_id;
        $warehouseDetails->warehouse_details_quantity = $request->warehouse_details_quantity;
        $warehouseDetails->warehouse_details_price = $request->warehouse_details_price;
        $warehouseDetails->warehouse_details_date = now();
        $warehouseDetails->warehouse_details_status = 1; // Trạng thái hàng tồn kho là hoạt động
        $warehouseDetails->save();

        // Cập nhật số lượng sản phẩm trong bảng `products`
        $product = Product::find($request->product_id);
        $product->product_quantity += $request->warehouse_details_quantity;
        $product->save();

        // Trả về thông báo thành công và chuyển hướng lại trang thêm hàng vào kho
        return redirect()->route('add.warehouse.stock')->with('message', 'Nhập hàng vào kho thành công!');
    }

    public function show($warehouse_id)
    {
        // Lấy thông tin chi tiết kho từ warehouse_details theo warehouse_id
        $warehouseDetails = WarehouseDetail::with(['product', 'warehouse'])
            ->where('warehouse_id', $warehouse_id)
            ->paginate(10);

        // Lấy tên kho từ bảng Warehouse
        $warehouse = Warehouse::find($warehouse_id);

        // Trả về view chi tiết kho
        return view('admin.warehouse_detail', compact('warehouseDetails', 'warehouse'));
    }





}
