@extends('admin.main')

@section('content')
<form action="{{ route('searchProductImage') }}" method="post" style="display:flex">
    @csrf
    <input type="text" name="query" class="col-md-4 form-control" placeholder="Tìm kiếm" required>
    <button type="submit"><i class="fas fa-search fa-fw"></i></button>
</form>
    <table class="table">
        <thead>
            <tr>
                <th style="width:50px">ID:</th>
                <th style="width:50px">ID sản phẩm:</th>
                <th>Tên Sản phẩm</th>
                <th>Ảnh sản phẩm 1</th>
                <th>Ảnh sản phẩm 2</th>
                <th>Ảnh sản phẩm 3</th>
                <th style="width=5px">Sửa|Xóa</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $ProductImages as $key => $ProductImage )
            <tr>
                <td>{{$ProductImage->id}}</td>
                @if($ProductImage->product)
                <td>{{$ProductImage->product->id}}</td>
                <td>{{$ProductImage->product->name}}</td>
                @endif
                <th><a href="{{$ProductImage->file_1}}" target="_blank"><img src="{{$ProductImage->file_1}}" height="50px"></a></th>
                <th><a href="{{$ProductImage->file_2}}" target="_blank"><img src="{{$ProductImage->file_2}}" height="50px"></a></th>
                <th><a href="{{$ProductImage->file_3}}" target="_blank"><img src="{{$ProductImage->file_3}}" height="50px"></a></th>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/productImage/edit/{{$ProductImage->id}}"><i class="fas fa-edit"></i></a>
                    <a class="btn btn-danger btn-sm" href="#"
                    onclick="removeRow({{$ProductImage->id}},'/admin/productImage/destroy')">
                    <i class="fas fa-trash"></i></a>
                </td>             
            </tr>
            @endforeach
        </tbody>
    </table>


    
@endsection