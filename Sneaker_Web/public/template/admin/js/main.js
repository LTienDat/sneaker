

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
                console.log(result.error);

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
    }s
}


// #upload file

$('#upload').change(function(){
    console.log(1);
    const form = new FormData();
    form.append('file', $(this)[0].files[0])
    console.log(1);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'JSON',
        data: form,
        url: '/admin/upload/services',
        success: function(result){
            console.log(2);
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


function updateCart(event) {
    event.preventDefault(); // Ngăn chặn form con gửi dữ liệu mặc định

    // Lấy form con
    var childForm = document.getElementById('child-form');

    // Tạo một FormData object từ form con
    var formData = new FormData(childForm);

    // Gửi yêu cầu AJAX đến server
    fetch('/update-cart', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        // Xử lý kết quả trả về nếu cần
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

$(document).ready(function(){
    var Chart = new Morris.Bar({
        element: 'myfirstchart',
        data: [
          { team: 'Brazil', nb: 5 },
          { team: 'Italy', nb: 4 },
          { team: 'Germany', nb: 4 },
          { team: 'Uruguay', nb: 2 },
          { team: 'Argentina', nb: 2 }
        ],
        xkey: 'team',
        ykeys: ['nb'],
        labels: ['Đơn hàng', 'Doanh số', 'Lợi nhuận', 'Số lượng']
      });


    // var Chart = new Morris.Bar({
    //     element: 'myfirstchart',
    //     barColors: ['#819C79', '#fc8710', '#A4ADD3', '#766B57'], // Corrected property name and color definition

    //     pointFillColors: ['#ffffff'],
    //     pointStrokeColors: ['black'],
    //     fillOpacity: 0.6,
    //     hideHover: 'auto',
    //     parseTime: false,
    //     xkey: 'period',
    //     behaveLikeLine: true, // Corrected property name
    //     labels: ['Đơn hàng', 'Doanh số', 'Lợi nhuận', 'Số lượng'] // Corrected property name
    // });

    $('#btn-dashboard-filter').click(function(){
        var _token = $('input[name="_token"]').val();
        var form_date = $('#datepicker').val();
        var to_date = $('#datepicker2').val();
        $.ajax({
            
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "filterByDate", // Corrected to use route() helper function
            method: "POST",
            dataType: "json",
            data: {form_date: form_date, to_date: to_date, _token: _token},
            success: function(data){

                Chart.setData(data);
            },
            error: function(xhr, status, error) {
                console.log(url);
                
            }
        });
    });
});



$(document).ready(function() {
    $('#statusOrder').change(function() {
        var selectedOption = $(this).val();
        console.log(1);

        // Gửi yêu cầu Ajax
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/admin/update-status",
            type: 'POST',
            dataType: 'json',
            data: {
                option: selectedOption,
            },
            success: function(response) {
                console.log(response.message); // Log thành công
                // Các hành động khác sau khi cập nhật thành công
            },
            error: function(xhr, status, error) {
                console.error(error); // Log lỗi nếu có
            }
        });
    });
});






