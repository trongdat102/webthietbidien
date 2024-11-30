@extends('admin_layout')
@section('admin_content')       
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê tài khoản
        </div>
                    <?php
                    $message = Session::get('message');
                    if($message){
                        echo '<span style="color: orangered; font-weight: bold; padding: 10px; border-radius: 5px; width: 100%; ">', $message, '</span>';
                        Session::put('message', null);
                    }
                    ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Quyền</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                     @foreach ($admins as $admin)
                        <tr>
                            <td>{{ $admin->admin_name }}</td>
                            <td>{{ $admin->admin_email }}</td>
                            <td>
                                @if ($admin->admin_role == 1)
                                    <span class="label label-success">Admin</span>
                                @else
                                    <span class="label label-primary">User</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ URL::to('/assign-role') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="admin_id" value="{{ $admin->admin_id }}">
                                    <select name="admin_role">
                                        <option value="0" @if ($admin->admin_role == 0) selected @endif>User</option>
                                        <option value="1" @if ($admin->admin_role == 1) selected @endif>Admin</option>
                                    </select>
                                    <button type="submit">Cập nhật</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
