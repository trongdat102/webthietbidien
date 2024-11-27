@extends('admin_layout')
@section('admin_content')       
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm phương thức thanh toán
                </header>
                <div class="panel-body">
                    <?php
                    $message = Session::get('message');
                    if($message){
                        echo '<span style="color: orangered; font-weight: bold; padding: 10px; border-radius: 5px; width: 100%; ">', $message, '</span>';
                        Session::put('message', null);
                    }
                    ?>
                    <div class="position-center">
                        <form role="form" action="{{URL::to('/save-payment')}}" method='post'>
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên phương thức thanh toán</label>
                            <input type="text" name="payment_method" class="form-control" id="exampleInputEmail1" placeholder="Tên phương thức thanh toán">
                            <!-- Hiển thị lỗi -->
                            @error('payment_method')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="payment_status" class="form-control input-sm m-bot15">
                                <option value="">Chọn trạng thái</option>
                                <option value="1">Ẩn</option>
                                <option value="0">Hiển thị</option>
                            </select>
                            <!-- Hiển thị lỗi -->
                            @error('payment_status')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" name="add_payment" class="btn btn-info">Thêm phương thức thanh toán</button>
                    </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
