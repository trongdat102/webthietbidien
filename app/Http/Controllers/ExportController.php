<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProvideProduct;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Customer;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Font;
use Carbon\Carbon;
use App\Models\Warehouse;
use App\Models\WarehouseDetail;
use PhpOffice\PhpWord\PhpWord;


use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function exportCategories()
    {
        // Đường dẫn đến file Excel mẫu (đã có sẵn)
        $filePath = storage_path('app/public/excel/category.xlsx'); // Đảm bảo đường dẫn chính xác

        // Mở file Excel có sẵn
        $spreadsheet = IOFactory::load($filePath);

        // Lấy sheet đầu tiên
        $sheet = $spreadsheet->getActiveSheet();

        // Chèn ngày giờ vào ô A1

        // Thêm tên trường (tiêu đề cột) vào hàng đầu tiên
        $sheet->setCellValue('A9', 'Số thứ tự');
        $sheet->setCellValue('B9', 'Tên hãng thiết bị');
        $sheet->setCellValue('C9', 'Mô tả');
        $sheet->setCellValue('D9', 'Trạng thái');

        // Lấy tất cả dữ liệu từ bảng categories
        $categories = Category::all();

        // Điền dữ liệu vào file Excel mẫu từ hàng 3
        $row = 10; // Bắt đầu điền từ hàng thứ 3 (hàng đầu tiên là ngày giờ, hàng thứ 2 là tên trường)
        foreach ($categories as $category) {
            $sheet->setCellValue('A' . $row, $category->category_id);
            $sheet->setCellValue('B' . $row, $category->category_name);
            $sheet->setCellValue('C' . $row, $category->category_desc);
            $sheet->setCellValue('D' . $row, $category->category_status ? '' : 'Hiển thị');
            $row++;
        }

        // Tạo tên file động (nếu cần)
        $fileName = 'Báo_cáo_loại_thiết_bị_điện' .'.xlsx';

        // Trả về file cho người dùng tải xuống
        return response()->stream(
            function () use ($spreadsheet) {
                $writer = new Xlsx($spreadsheet);
                $writer->save('php://output'); // Lưu vào output stream
            },
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Cache-Control' => 'max-age=0',
            ]
        );
    }
    public function exportExcelProduct(Request $request)
    {
        // Lấy ngày bắt đầu và ngày kết thúc từ form
        $startDate = Carbon::parse($request->input('start_date'));
        $endDate = Carbon::parse($request->input('end_date'))->endOfDay();

        // Truy vấn dữ liệu theo ngày
        $products = Product::whereBetween('created_at', [$startDate, $endDate])
            ->with(['category', 'brand', 'provider'])
            ->get();
        // Đường dẫn đến file Excel mẫu (đã có sẵn)
        $filePath = storage_path('app/public/excel/product.xlsx'); // Đảm bảo đường dẫn chính xác

        // Mở file Excel có sẵn
        $spreadsheet = IOFactory::load($filePath);

        // Lấy sheet đầu tiên
        $sheet = $spreadsheet->getActiveSheet();

        // Chèn ngày giờ vào ô A1
        $sheet->setCellValue('A6', 'Từ ngày: ' . $startDate->format('Y-m-d') . '   đến ngày: ' . $endDate->format('Y-m-d'));

        // Thêm tên trường (tiêu đề cột) vào hàng đầu tiên
        $sheet->setCellValue('A9', 'Số thứ tự');
        $sheet->setCellValue('B9', 'Tên thiết bị');
        $sheet->setCellValue('C9', 'Loại thiết bị');
        $sheet->setCellValue('D9', 'Hãng thiết bị');
        $sheet->setCellValue('E9', 'Nhà cung cấp');
        $sheet->setCellValue('F9', 'Giá (VNĐ)');
        $sheet->setCellValue('G9', 'Số lượng');
        $sheet->setCellValue('H9', 'Số lượng đã bán');
        $sheet->setCellValue('I9', 'Trạng thái');

        // Lấy tất cả dữ liệu từ bảng categories
        $products = Product::all();

        // Điền dữ liệu vào file Excel mẫu từ hàng 3
        $row = 10; // Bắt đầu điền từ hàng thứ 3 (hàng đầu tiên là ngày giờ, hàng thứ 2 là tên trường)
        foreach ($products as $product) {
            $sheet->setCellValue('A' . $row, $product->product_id);
            $sheet->setCellValue('B' . $row, $product->product_name);
            $sheet->setCellValue('C' . $row, $product->category ? $product->category->category_name : 'N/A'); // Tên danh mục
            $sheet->setCellValue('E' . $row, $product->brand ? $product->brand->brand_name : 'N/A'); // Tên hãng
            $sheet->setCellValue('D' . $row, $product->provider ? $product->provider->provider_name : 'N/A'); // Tên nhà cung cấp

            $sheet->setCellValue('F' . $row, $product->product_price);
            $sheet->setCellValue('G' . $row, $product->product_quantity);
            $sheet->setCellValue('H' . $row, $product->product_sold);
            $sheet->setCellValue('I' . $row, $product->product_status ? '0' : '1');
            $row++;
        }


        // Tạo tên file động (nếu cần)
        $fileName = 'Báo_cáo_thiết_bị'.'.xlsx';

        // Trả về file cho người dùng tải xuống
        return response()->stream(
            function () use ($spreadsheet) {
                $writer = new Xlsx($spreadsheet);
                $writer->save('php://output'); // Lưu vào output stream
            },
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Cache-Control' => 'max-age=0',
            ]
        );
    }
    public function exportExcelProvider()
    {
        // Lấy dữ liệu từ bảng nhà cung cấp
        $filePath = storage_path('app/public/excel/provider.xlsx'); // Đảm bảo đường dẫn chính xác

        // Mở file Excel có sẵn
        $spreadsheet = IOFactory::load($filePath);

        // Lấy sheet đầu tiên
        $sheet = $spreadsheet->getActiveSheet();


        // Lấy tất cả dữ liệu từ bảng categories
        $providers = ProvideProduct::all();

        // Thêm tên trường vào hàng đầu tiên
        $sheet->setCellValue('A9', 'ID');
        $sheet->setCellValue('B9', 'Tên nhà cung cấp');
        $sheet->setCellValue('C9', 'Mô tả');
        $sheet->setCellValue('D9', 'Trạng thái');

        // Điền dữ liệu vào file Excel
        $row = 10;
        foreach ($providers as $provider) {
            $sheet->setCellValue('A' . $row, $provider->provider_id);
            $sheet->setCellValue('B' . $row, $provider->provider_name);
            $sheet->setCellValue('C' . $row, $provider->provider_desc);
            $sheet->setCellValue('D' . $row, $provider->provider_status ? '' : 'Hiển thị');

            $row++;
        }

        // Tạo tên file động
        $fileName = 'Báo_cáo_nhà_cung_cấp' .'.xlsx';

        // Trả về file cho người dùng tải xuống
        return response()->stream(
            function () use ($spreadsheet) {
                $writer = new Xlsx($spreadsheet);
                $writer->save('php://output'); // Lưu vào output stream
            },
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Cache-Control' => 'max-age=0',
            ]
        );
    }
    public function exportExcelBrand()
    {
        // Lấy dữ liệu từ bảng thương hiệu
        $filePath = storage_path('app/public/excel/brand.xlsx'); // Đảm bảo đường dẫn chính xác

        // Mở file Excel có sẵn
        $spreadsheet = IOFactory::load($filePath);

        // Lấy sheet đầu tiên
        $sheet = $spreadsheet->getActiveSheet();


        // Lấy tất cả dữ liệu từ bảng categories
        $brands = Brand::all();

        // Thêm tên trường vào hàng đầu tiên
        $sheet->setCellValue('A9', 'ID');
        $sheet->setCellValue('B9', 'Tên thương hiệu');
        $sheet->setCellValue('C9', 'Mô tả');
        $sheet->setCellValue('D9', 'Trạng thái');

        // Điền dữ liệu vào file Excel
        $row = 10;
        foreach ($brands as $brand) {
            $sheet->setCellValue('A' . $row, $brand->brand_id);
            $sheet->setCellValue('B' . $row, $brand->brand_name);
            $sheet->setCellValue('C' . $row, $brand->brand_desc);
            $sheet->setCellValue('D' . $row, $brand->brand_status ? '' : 'Hiển thị'); // Hiển thị trạng thái
            $row++;
        }

        // Tạo tên file với ngày giờ hiện tại
        $fileName = 'Báo_cáo_hãng_thiết_bị'.'.xlsx';

        // Trả về file cho người dùng tải xuống
        return response()->stream(
            function () use ($spreadsheet) {
                $writer = new Xlsx($spreadsheet);
                $writer->save('php://output'); // Lưu vào output stream
            },
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Cache-Control' => 'max-age=0',
            ]
        );
    }
    public function exportExcelOrders(Request $request)
    {
        // Lấy ngày bắt đầu và ngày kết thúc từ request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Lấy danh sách đơn hàng
        $orders = Order::whereBetween('created_at', [$startDate, $endDate])
            ->with(['customer', 'shipping', 'orderDetails'])
            ->get();
        $filePath = storage_path('app/public/excel/order.xlsx'); // Đảm bảo đường dẫn chính xác

        // Mở file Excel có sẵn
        $spreadsheet = IOFactory::load($filePath);

        // Lấy sheet đầu tiên
        $sheet = $spreadsheet->getActiveSheet();

        // Chèn ngày giờ vào ô A6
        $dateRange = 'Từ ngày: ' . \Carbon\Carbon::parse($startDate)->format('d/m/Y') . ' đến ngày: ' . \Carbon\Carbon::parse($endDate)->format('d/m/Y');
        $sheet->setCellValue('A6', $dateRange);

        // Thêm tên cột vào hàng đầu tiên
        $headerRow = 9;
        $sheet->setCellValue('A9', 'ID');
        $sheet->setCellValue('B9', 'Mã đơn hàng');
        $sheet->setCellValue('C9', 'Tên khách hàng');
        $sheet->setCellValue('D9', 'Địa chỉ');
        $sheet->setCellValue('E9', 'Email');
        $sheet->setCellValue('F9', 'Tổng tiền (VNĐ)');
        $sheet->setCellValue('G9', 'Trạng thái');
        $sheet->setCellValue('H9', 'Ngày đặt hàng');
        $sheet->setCellValue('I9', 'Lý do');

        $sheet->getStyle("A{$headerRow}:I{$headerRow}")
            ->getFont()
            ->setBold(true);
        $sheet->getStyle("A{$headerRow}:I{$headerRow}")
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $startRow = 10;
        $templateRowCount = 1;
        $dataRowCount = $orders->count();

        if ($dataRowCount > $templateRowCount) {
            $additionalRows = $dataRowCount - $templateRowCount;
            $sheet->insertNewRowBefore($startRow + 1, $additionalRows); // Thêm dòng mới
        }

        // Lặp qua từng đơn hàng và điền thông tin vào sheet
        $currentRow = $startRow;
        foreach ($orders as $order) {
            // Xử lý trạng thái đơn hàng
            $status = '';
            switch ($order->order_status) {
                case 1:
                    $status = 'Đơn hàng mới';
                    break;
                case 2:
                    $status = 'Đã giao hàng';
                    break;
                case 3:
                    $status = 'Đơn hàng đã bị hủy';
                    break;
                case 4:
                    $status = 'Đang giao hàng';
                    break;
                case 5:
                    $status = 'Giao hàng thành công';
                    break;
                case 6:
                    $status = 'Đơn hàng đã bị trả';
                    break;
                default:
                    $status = 'Không xác định'; // Phòng trường hợp trạng thái khác
                    break;
            }

            // Điền thông tin vào các ô Excel
            $sheet->setCellValue('A' . $currentRow, $order->order_id);
            $sheet->setCellValue('B' . $currentRow, $order->order_code);
            $sheet->setCellValue('C' . $currentRow, $order->customer->customer_name ?? '');
            $sheet->setCellValue('D' . $currentRow, $order->shipping->shipping_address ?? '');
            $sheet->setCellValue('E' . $currentRow, $order->customer->customer_email ?? '');
            $sheet->setCellValue('F' . $currentRow, number_format($order->calculateTotal(), 0, ',', ','));
            $sheet->setCellValue('G' . $currentRow, $status);
            $sheet->setCellValue('H' . $currentRow, $order->order_date);
            $sheet->setCellValue('I' . $currentRow, $order->order_destroy);

            $currentRow++;
        }

        // Tạo tên file động theo ngày xuất
        $fileName = 'Báo_cáo_đơn_hàng' . '.xlsx';

        // Trả về file Excel cho người dùng tải xuống
        return response()->stream(
            function () use ($spreadsheet) {
                $writer = new Xlsx($spreadsheet);
                $writer->save('php://output');
            },
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Cache-Control' => 'max-age=0',
            ]
        );
    }

    public function exportExcelCustomer()
    {
        // Lấy dữ liệu từ bảng thương hiệu
        $filePath = storage_path('app/public/excel/customer.xlsx'); // Đảm bảo đường dẫn chính xác

        // Mở file Excel có sẵn
        $spreadsheet = IOFactory::load($filePath);

        // Lấy sheet đầu tiên
        $sheet = $spreadsheet->getActiveSheet();


        // Lấy tất cả dữ liệu từ bảng categories
        $customers = Customer::all();

        // Thêm tên trường vào hàng đầu tiên
        $sheet->setCellValue('A9', 'ID');
        $sheet->setCellValue('B9', 'Họ và tên');
        $sheet->setCellValue('C9', 'Tài khoản');
        $sheet->setCellValue('D9', 'Điện thoại');

        // Điền dữ liệu vào file Excel
        $row = 10;
        foreach ($customers as $customer) {
            $sheet->setCellValue('A' . $row, $customer->customer_id);
            $sheet->setCellValue('B' . $row, $customer->customer_name);
            $sheet->setCellValue('C' . $row, $customer->customer_email);
            $sheet->setCellValue('D' . $row, $customer->customer_phone);
            $row++;
        }

        // Tạo tên file với ngày giờ hiện tại
        $fileName = 'Báo_cáo_tài_khoản_khách_hàng'.'.xlsx';

        // Trả về file cho người dùng tải xuống
        return response()->stream(
            function () use ($spreadsheet) {
                $writer = new Xlsx($spreadsheet);
                $writer->save('php://output'); // Lưu vào output stream
            },
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Cache-Control' => 'max-age=0',
            ]
        );
    }


    public function exportExcelInventory()
    {

        $filePath = storage_path('app/public/excel/inventory.xlsx');
        $spreadsheet = IOFactory::load($filePath);

        // Lấy sheet đầu tiên
        $sheet = $spreadsheet->getActiveSheet();

        // Thêm tên cột vào hàng đầu tiên
        $sheet->setCellValue('A9', 'ID');
        $sheet->setCellValue('B9', 'Tên thiết bị');
        $sheet->setCellValue('C9', 'Số lượng còn lại');
        $sheet->setCellValue('D9', 'Giá nhập (VNĐ)');
        $sheet->setCellValue('E9', 'Kho');
        $sheet->setCellValue('F9', 'Trạng thái');

        // Lấy tất cả dữ liệu từ bảng sản phẩm
        $products = Product::all();

        // Điền dữ liệu vào file Excel
        $row = 10;
        foreach ($products as $product) {
            // Tính số lượng còn lại
            $remainingQuantity = $product->product_quantity - $product->product_sold;
            $remainingQuantity = $remainingQuantity < 0 ? 0 : $remainingQuantity;  // Nếu số lượng còn lại âm thì cho phép là 0

            // Lấy giá từ chi tiết kho (giả sử giá đầu tiên của sản phẩm)
            $warehousePrice = WarehouseDetail::where('product_id', $product->product_id)
                ->first()->warehouse_details_price ?? 0;  // Lấy giá nhập đầu tiên của sản phẩm

            // Định dạng giá nhập với VNĐ
            $formattedPrice = number_format($warehousePrice, 0, ',', ',') ;

            // Lấy thông tin kho và số lượng tồn trong từng kho
            $warehouses = WarehouseDetail::where('product_id', $product->product_id)
                ->join('tbl_warehouse', 'tbl_warehouse.warehouse_id', '=', 'tbl_warehouse_details.warehouse_id')
                ->select('tbl_warehouse.warehouse_name', 'tbl_warehouse_details.warehouse_details_quantity')
                ->get();

            // Nối tên kho và số lượng tồn trong kho, cách nhau bởi dấu phẩy
            $warehouseList = $warehouses->map(function ($warehouse) {
                return $warehouse->warehouse_name . ': ' . $warehouse->warehouse_details_quantity;
            })->implode(', ');

            // Xác định tình trạng hàng
            if ($remainingQuantity == 0) {
                $status = 'Hết hàng';
            } elseif ($remainingQuantity > 0 && $remainingQuantity <= 10) {
                $status = 'Sắp hết hàng';
            } else {
                $status = 'Còn hàng';
            }

            // Điền dữ liệu vào từng hàng của Excel
            $sheet->setCellValue('A' . $row, $product->product_id);
            $sheet->setCellValue('B' . $row, $product->product_name);
            $sheet->setCellValue('C' . $row, $remainingQuantity);
            $sheet->setCellValue('D' . $row, $formattedPrice);  // Hiển thị giá nhập với định dạng VNĐ
            $sheet->setCellValue('E' . $row, $warehouseList);  // Cột kho
            $sheet->setCellValue('F' . $row, $status);

            $row++;  // Tăng dòng cho sản phẩm tiếp theo
        }

        // Tạo tên file động theo ngày xuất
        $fileName = 'Báo_cáo_hàng_tồn_kho' . '.xlsx';

        // Trả về file cho người dùng tải xuống
        return response()->stream(
            function () use ($spreadsheet) {
                $writer = new Xlsx($spreadsheet);
                $writer->save('php://output');
            },
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Cache-Control' => 'max-age=0',
            ]
        );


    }


}
