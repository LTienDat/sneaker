@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th style="width:50px">ID:</th>
                <th>Tên</th>
                <th>Ảnh danh mục</th>
                <th>Hoạt động</th>
                <th>Cập nhật</th>
                <th style="width=5px">Sửa|Xóa</th>
            </tr>
        </thead>
        <tbody>
            {!!\app\Helpers\Helper::menu($menus)!!}
        </tbody>
    </table>
@endsection