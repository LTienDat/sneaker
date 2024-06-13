$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function removeRow(id, url){
    if (confirm('Bạn có chắc chắn muốn xóa nội dung này không?')) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'DELETE',
            datatype: 'JSON',
            data: {id: id},
            url: url,
            success: function(result){
                if (result.error === false) {
                    alert('Xóa thành công');
                    location.reload();
                } else {
                    alert('Xóa lỗi, Vui lòng xóa lại');
                }
            },
            error: function(xhr, status, error) {
                console.error('Status:', status);
                console.error('Error:', error);
                console.error('Response:', xhr.responseText);
                alert('Đã xảy ra lỗi. Vui lòng thử lại sau.');
                location.reload();
            }
        });
    }
}



// #upload file

$('#upload').change(function(){


    const form = new FormData();
    form.append('file', $(this)[0].files[0])

    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'JSON',
        data: form,
        url: '/admin/upload/services',
        success: function(result){
            if(result.error === false){
                $('#image_show').html('<a href="'+ result.url +'" target="_blank">'+
                    '<img src="'+ result.url +'" width="100px"></img ></a>')

                $('#file').val(result.url);
                console.log(result.url);
            }else{
                alert('Upload file lỗi');
            }
        },
    });
});