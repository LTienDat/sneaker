@extends('admin.main')

@section('content')
<table class="table">
    <thead>
        <tr>
            <th style="width:50px">ID kho hàng:</th>
            <th style="width:50px">ID Sản phẩm:</th>
            <th>Tên sản phẩm</th>
            <th>Ảnh sản phẩm</th>
            <th>Size</th>
            <th>Màu</th>
            <th>Số lượng</th>
            <th style="width:20px">Sửa|Xóa</th>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ( $warehouses as $key => $warehouse )
        <tr>
            <td>{{$warehouse->id}}</td>
            @if($warehouse->product)
            <td>{{$warehouse->product->id}}</td>
            <td>{{$warehouse->product->name}}</td>
            <th><a href="{{$warehouse->product->file}}" target="_blank"><img src="{{$warehouse->product->file}}"
                        height="50px"></a></th>
            @endif
            <td>{{$warehouse->size}}</td>
            <td>{{$warehouse->color}}</td>
            <td>{{$warehouse->quantity}}</td>
            <td>
                <a class="btn btn-primary btn-sm" href="/admin/warehouse/edit/{{$warehouse->id}}"><i
                        class="fas fa-edit"></i></a>
                <a class="btn btn-danger btn-sm" href="#"
                    onclick="removeRow({{$warehouse->id}},'/admin/warehouse/destroy')">
                    <i class="fas fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>




@endsection