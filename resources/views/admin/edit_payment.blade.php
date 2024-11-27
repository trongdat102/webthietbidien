@extends('admin_layout')
@section('admin_content')       
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật phương thức thanh toán
                        </header>
                        <div class="panel-body">
                        <?php
    $message = Session::get('message');
    if($message){
        echo '<span style="color: orangered; font-weight: bold; padding: 10px; border-radius: 5px; width: 100%; ">', $message, '</span>';
        Session::put('message', null);
    }
?>
                            @foreach($edit_payment as $key => $edit_value)                            
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-payment/'.$edit_value->payment_id)}}" method='post'>
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên phương thức thanh toán</label>
                                    <input type="text" value="{{ $edit_value->payment_method }}" name="payment_method" class="form-control" id="exampleInputEmail1" placeholder=" Tên phương thức thanh toán">
                                </div>
                                <button type="submit" name ="update_payment" class="btn btn-info">Cập nhật phương thức thanh toán</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>

            </div>
@endsection