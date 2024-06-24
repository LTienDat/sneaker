

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
    }
}


// #upload file

$('#upload').change(function(){


    const form = new FormData();
    form.append('file', $(this)[0].files[0])

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
    chart30daysorder();

    var Chart = new Morris.Line({
        // ID of the element in which to draw the chart.
        element: 'myfirstchart',
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        data: [
          { year: '2008', value: 20 },
          { year: '2009', value: 10 },
          { year: '2010', value: 5 },
          { year: '2011', value: 5 },
          { year: '2012', value: 20 }
        ],
        // The name of the data record attribute that contains x-values.
        xkey: 'year',
        // A list of names of data record attributes that contain y-values.
        ykeys: ['value'],
        // Labels for the ykeys -- will be displayed when you hover over the
        // chart.
        labels: ['Value']
      });

    new Morris.Bar({
        element: 'myfirstchart',
        lineColors: ['#819C79', '#fc8710', '#A4ADD3', '#766B57'],
        
        poinFillColors: ['#ffffff'],
        poinStrokeColors: ['black'],
        fillPpacity: 0.6,
        hideHover: 'auto',
        parseTime: false,
        xkey: 'period',
        behavelLikeLine: true,
        lables: ['Đơn hàng', 'Doanh số', 'Lợi nhuận', 'Số lượng']
    })
    
    function chart30daysorder(){
        
    }
    $('#btn-dashboard-filter').click(function(){
        
        var _token = $('input[name="_token"]').val();
        var form_date = $('#datepicker').val();
        var to_date = $('#datepicker2').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ url('/filterByDate') }}",
            method: "POST",
            dataType: "json",
            data: {form_date: form_date, to_date: to_date, _token: _token},
            success: function(data){
                Chart.setData(data);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
        
    });
});


