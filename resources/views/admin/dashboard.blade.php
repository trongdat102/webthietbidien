@extends('admin_layout')
@section('admin_content')
<?php
                    $message = Session::get('message');
                    if($message){
                        echo '<span style="color: red; font-weight: bold; padding: 10px; border-radius: 5px; width: 100%; ">', $message, '</span>';
                        Session::put('message', null);
                    }
                    ?>
<div class="container-fluid">
    <style type="text/css">
        p.title_thongke {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
        }
    </style>                 
    <div class="row">
        <p class="title_thongke">Thống kê đơn hàng, doanh số</p>
        <form autocomplete="off" id="filterForm">
            @csrf
            <div class="col-md-2">
                <p>Từ ngày: <input type="text" id="datepicker" class="form-control"></p>
            </div>
            <div class="col-md-2">
                <p>Đến ngày: <input type="text" id="datepicker2" class="form-control"></p>
            </div>
            
        </form>
        <div class="col-md-12">
            <div id="myfirstchart" style="height: 400px;"></div>
        </div>
    </div>
    <div class="col-md-4">
                <input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="Lọc kết quả">
                <a id="btn-print-pdf" class="btn btn-success btn-sm" target="_blank">In báo cáo PDF</a>
                <a id="btn-print-word" class="btn btn-success btn-sm" target="_blank">In file word</a>
            </div>
</div>

<script>
    document.getElementById('btn-dashboard-filter').onclick = function() {
        var from_date = document.getElementById('datepicker').value;
        var to_date = document.getElementById('datepicker2').value;
        
        var baseUrl = "{{ url('/') }}";
        document.getElementById('btn-print-pdf').href = `${baseUrl}/print-statistics-report/${from_date}/${to_date}`;
        var baseUrl = "{{ url('/') }}";
        document.getElementById('btn-print-word').href = `${baseUrl}/export-statistics-word/${from_date}/${to_date}`;
    }
</script>
@endsection
