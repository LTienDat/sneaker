@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th style="width:50px">ID:</th>
                <th>Tên sản phẩm</th>
                <th>Ảnh sản phẩm</th>
                <th>Size</th>
                <th>Màu</th>
                <th>Số lượng</th>
                <th style="width=5px">Sửa|Xóa</th>
                <th width="100px"><a class="btn btn-success btn-sm " href="/admin/product/addAttribute">Thêm màu và size</a></th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $warehouses as $key => $warehouse )
            <tr>
                <td>{{$warehouse->id}}</td>
                <td>{{$warehouse->name}}</td>
                <th><a href="{{$warehouse->file}}" target="_blank"><img src="{{$warehouse->file}}" height="50px"></a></th>
                <td>{{$warehouse->warehouse->size}}</td>
                <td>{{$warehouse->warehouse->color}}</td>
                <td>{{$warehouse->warehouse->quantity}}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/product/edit/{{$warehouse->id}}"><i class="fas fa-edit"></i></a>
                    <a class="btn btn-danger btn-sm" href="#"
                    onclick="removeRow({{$warehouse->id}},'/admin/product/destroy')">
                    <i class="fas fa-trash"></i></a>
                </td>             
            </tr>
            @endforeach
        </tbody>
    </table>



    
@endsection