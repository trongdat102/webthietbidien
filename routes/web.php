<?php
//Frontend
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\BrandProduct;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\WarehouseDetailsController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PaymentController;

//Frontend
Route::get('/', [HomeController::class, 'index']);
Route::get('/trangchu', [HomeController::class, 'index']);
Route::post('/tim-kiem', [HomeController::class, 'search']);

//Danh muc san pham - trang chu
Route::get('/danh-muc-san-pham/{category_id}', [CategoryProduct::class, 'show_category_home']);
Route::get('/thuong-hieu-san-pham/{brand_id}', [BrandProduct::class, 'show_brand_home']);
Route::get('/chi-tiet-san-pham/{product_id}', [ProductController::class, 'details_product']);


//Backend
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/dashboard', [AdminController::class, 'show_dashboard']);
Route::post('/filter-by-date', [AdminController::class, 'filter_by_date']);
Route::post('/admin-dashboard', [AdminController::class, 'dashboard']);
Route::post('/add-admin', [AdminController::class, 'add_admin']);
Route::get('/admin-register', [AdminController::class, 'registerAdmin']);
Route::get('/logout', [AdminController::class, 'logout']);
Route::get('/print-statistics-report/{from_date}/{to_date}', [AdminController::class, 'printStatisticsReportByDate']);
Route::get('/export-statistics-word/{from_date}/{to_date}', [AdminController::class, 'insertStatisticsToWord']);

//Category Product
Route::get('/add-category-product', [CategoryProduct::class, 'add_category_product']);
Route::get('/edit-category-product/{category_product_id}', [CategoryProduct::class, 'edit_category_product']);
Route::get('/delete-category-product/{category_product_id}', [CategoryProduct::class, 'delete_category_product']);
Route::get('/all-category-product', [CategoryProduct::class, 'all_category_product']);

Route::get('/unactive-category-product/{category_product_id}', [CategoryProduct::class, 'unactive_category_product']);
Route::get('/active-category-product/{category_product_id}', [CategoryProduct::class, 'active_category_product']);

Route::post('/luu-danhmucsanpham', [CategoryProduct::class, 'luu_danhmucsanpham']);
Route::post('/update-category-product/{category_product_id}', [CategoryProduct::class, 'update_category_product']);

//Brand Product
Route::get('/add-brand-product', [BrandProduct::class, 'add_brand_product']);
Route::get('/edit-brand-product/{brand_product_id}', [BrandProduct::class, 'edit_brand_product']);
Route::get('/delete-brand-product/{brand_product_id}', [BrandProduct::class, 'delete_brand_product']);
Route::get('/all-brand-product', [BrandProduct::class, 'all_brand_product']);

Route::get('/unactive-brand-product/{brand_product_id}', [BrandProduct::class, 'unactive_brand_product']);
Route::get('/active-brand-product/{brand_product_id}', [BrandProduct::class, 'active_brand_product']);

Route::post('/save-brand-product', [BrandProduct::class, 'save_brand_product']);
Route::post('/update-brand-product/{brand_product_id}', [BrandProduct::class, 'update_brand_product']);

//Provider Product
Route::get('/add-provider-product', [ProviderController::class, 'add_provider_product']);
Route::get('/edit-provider-product/{provider_product_id}', [ProviderController::class, 'edit_provider_product']);
Route::get('/delete-provider-product/{provider_product_id}', [ProviderController::class, 'delete_provider_product']);
Route::get('/all-provider-product', [ProviderController::class, 'all_provider_product']);

Route::get('/unactive-provider-product/{provider_product_id}', [ProviderController::class, 'unactive_provider_product']);
Route::get('/active-provider-product/{provider_product_id}', [ProviderController::class, 'active_provider_product']);

Route::post('/save-provider-product', [ProviderController::class, 'save_provider_product']);
Route::post('/update-provider-product/{ProviderController}', [ProviderController::class, 'update_provider_product']);

//Payment
Route::get('/add-payment', [PaymentController::class, 'add_payment']);
Route::get('/edit-payment/{payment_id}', [PaymentController::class, 'edit_payment']);
Route::get('/delete-payment/{payment_id}', [PaymentController::class, 'delete_payment']);
Route::get('/all-payment', [PaymentController::class, 'all_payment']);

Route::get('/unactive-payment/{payment_id}', [PaymentController::class, 'unactive_payment']);
Route::get('/active-payment/{payment_id}', [PaymentController::class, 'active_payment']);

Route::post('/save-payment', [PaymentController::class, 'save_payment']);
Route::post('/update-payment/{PaymentController}', [PaymentController::class, 'update_payment']);

//Product
Route::get('/add-product', [ProductController::class, 'add_product']);
Route::get('/edit-product/{product_id}', [ProductController::class, 'edit_product']);
Route::get('/delete-product/{product_id}', [ProductController::class, 'delete_product']);
Route::get('/all-product', [ProductController::class, 'all_product']);

Route::get('/unactive-product/{product_id}', [ProductController::class, 'unactive_product']);
Route::get('/active-product/{product_id}', [ProductController::class, 'active_product']);

Route::post('/save-product', [ProductController::class, 'save_product']);
Route::post('/update-product/{product_id}', [ProductController::class, 'update_product']);

//Cart
Route::post('/update-cart-quantity', [CartController::class, 'update_cart_quantity']);
Route::post('/update-cart', [CartController::class, 'update_cart']);
Route::post('/save-cart', [CartController::class, 'save_cart']);
Route::post('/add-cart-ajax', [CartController::class, 'add_cart_ajax']);
Route::get('/show-cart', [CartController::class, 'show_cart']);
Route::get('/gio-hang', [CartController::class, 'gio_hang']);
Route::get('/delete-to-cart/{id}', [CartController::class, 'delete_to_cart']);
Route::get('/del-product/{session_id}', [CartController::class, 'del_product']);
Route::get('/del-all-product', [CartController::class, 'del_all_product']);


//Checkout
Route::get('/login-checkout', [CheckoutController::class, 'login_checkout']);
Route::get('/logout-checkout', [CheckoutController::class, 'logout_checkout']);
Route::post('/add-customer', [CheckoutController::class, 'add_customer']);
Route::post('/order-place', [CheckoutController::class, 'order_place']);
Route::post('/login-customer', [CheckoutController::class, 'login_customer']);
Route::get('/checkout', [CheckoutController::class, 'checkout']);
Route::get('/payment', [CheckoutController::class, 'payment']);
Route::post('/save-checkout-customer', [CheckoutController::class, 'save_checkout_customer']);
Route::post('/confirm-order', [CheckoutController::class, 'confirm_order']);


//Order 
Route::get('/view-history-order/{order_code}', [OrderController::class, 'view_history_order']);
Route::get('/history', [OrderController::class, 'history']);
Route::get('/print-order/{checkout_code}', [OrderController::class, 'print_order']);
Route::get('/export-invoice/{checkout_code}', [OrderController::class, 'exportInvoiceToWord']);
Route::get('/delete-order/{order_code}', [OrderController::class, 'order_code']);
Route::get('/manage-order', [OrderController::class, 'manage_order']);
Route::get('/view-order/{order_code}', [OrderController::class, 'view_order']);
Route::post('/update-order-qty', [OrderController::class, 'update_order_qty']);
Route::post('/update-qty', [OrderController::class, 'update_qty']);
Route::post('/huy-don-hang', [OrderController::class, 'huy_don_hang']);
Route::post('/tra-don-hang', [OrderController::class, 'tra_don_hang']);
Route::post('/tra-hang', [OrderController::class, 'tra_hang']);
Route::get('/order/received/{order_code}', [OrderController::class, 'markAsReceived']);


//Export excel
Route::post('admin/export-excel-category', [ExportController::class, 'exportCategories'])->name('export.excel.category');
Route::post('admin/export-excel-product', [ExportController::class, 'exportExcelProduct'])->name('export.excel.product');
Route::post('admin/export-excel-provider', [ExportController::class, 'exportExcelProvider'])->name('export.excel.provider');
Route::post('admin/export-excel-brand', [ExportController::class, 'exportExcelBrand'])->name('export.excel.brand');
Route::post('admin/export-excel-orders', [ExportController::class, 'exportExcelOrders'])->name('export.excel.orders');
Route::post('admin/export-excel-inventory', [ExportController::class, 'exportExcelInventory'])->name('export.excel.inventory');
Route::post('admin/export-excel-customer', [ExportController::class, 'exportExcelCustomer'])->name('export.excel.customer');


//warehouse
Route::get('/add-warehouse', [WarehouseController::class, 'add_warehouse'])->name('warehouse.add');
Route::get('/edit-warehouse/{warehouse_id}', [WarehouseController::class, 'edit_warehouse'])->name('warehouse.edit');
Route::get('/delete-warehouse/{warehouse_id}', [WarehouseController::class, 'delete_warehouse'])->name('warehouse.delete');
Route::get('/all-warehouse', [WarehouseController::class, 'all_warehouse'])->name('warehouse.all');

Route::get('/unactive-warehouse/{warehouse_id}', [WarehouseController::class, 'unactive_warehouse'])->name('warehouse.unactive');
Route::get('/active-warehouse/{warehouse_id}', [WarehouseController::class, 'active_warehouse'])->name('warehouse.active');

Route::post('/save-warehouse', [WarehouseController::class, 'save_warehouse'])->name('warehouse.save'); // Lưu kho mới
Route::post('/update-warehouse/{warehouse_id}', [WarehouseController::class, 'update_warehouse'])->name('warehouse.update'); // Cập nhật kho

// Quản lý kho chi tiết

Route::get('/warehouse-inventory', [WarehouseDetailsController::class, 'inventory'])->name('warehouse.inventory');

// Route để xem chi tiết kho
Route::get('/warehouse-details/{warehouse_id}', [WarehouseDetailsController::class, 'show'])->name('warehouse.details');
Route::get('/warehouse-detail/edit/{warehouse_details_id}', [WarehouseDetailsController::class, 'editDetail'])->name('warehouse.detail.edit');
Route::post('/warehouse-detail/edit/{warehouse_details_id}', [WarehouseDetailsController::class, 'updateDetail'])->name('warehouse.detail.update');

Route::get('/warehouse-detail/delete/{warehouse_details_id}', [WarehouseDetailsController::class, 'deleteDetail'])->name('warehouse.detail.delete');

// Route để thêm hàng vào kho
Route::get('/add-warehouse-stock', [WarehouseDetailsController::class, 'create'])->name('add.warehouse.stock');
Route::post('/store-warehouse-stock', [WarehouseDetailsController::class, 'store'])->name('store.warehouse.stock');

//customer backend
Route::get('/delete-customer/{customer_id}', [CustomerController::class, 'delete_customer']);
Route::get('/all-customer', [CustomerController::class, 'all_customer']);
