@extends('admin_layout')
@section('admin_content')       
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật nhà cung cấp
                        </header>
                        <div class="panel-body">
                        <?php
    $message = Session::get('message');
    if($message){
        echo '<span style="color: orangered; font-weight: bold; padding: 10px; border-radius: 5px; width: 100%; ">', $message, '</span>';
        Session::put('message', null);
    }
?>
                            @foreach($edit_provider_product as $key => $edit_value)                            
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-provider-product/'.$edit_value->provider_id)}}" method='post'>
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên nhà cung cấp</label>
                                    <input type="text" value="{{ $edit_value->provider_name }}" name="provider_product_name" class="form-control" id="exampleInputEmail1" placeholder=" Tên nhà cung cấp">
                                </div>
                               <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả nhà cung cấp</label>
                                <textarea style="resize: none;" rows="5" class="form-control" name="provider_product_desc" id="exampleInputPassword1">{{ trim($edit_value->provider_desc) }}</textarea>
                            </div>

                                
                                <button type="submit" name ="update_provider_product" class="btn btn-info">Cập nhật nhà cung cấp</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>

            </div>
@endsection