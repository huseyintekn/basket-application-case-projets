var message = {
    error: function (message){
        toastr.options = {
            timeOut: 3000,
            progressBar: true,
            showMethod: "slideDown",
            hideMethod: "slideUp",
            positionClass:"toast-bottom-right",
            showDuration: 200,
            hideDuration: 200
        };
        toastr.error(message);
    },
    success: function (message){
        toastr.options = {
            timeOut: 3000,
            progressBar: true,
            showMethod: "slideDown",
            hideMethod: "slideUp",
            positionClass: "toast-bottom-right",
            showDuration: 200,
            hideDuration: 200
        };
        toastr.success(message);
    },
    info: function (message){
        toastr.options = {
            timeOut: 3000,
            progressBar: true,
            showMethod: "slideDown",
            hideMethod: "slideUp",
            positionClass: "toast-bottom-right",
            showDuration: 200,
            hideDuration: 200
        };
        toastr.info(message);
    }
};

Number.prototype.formatMoney = function(c, d, t){
    var n = this,
        c = isNaN(c = Math.abs(c)) ? 2 : c,
        d = d == undefined ? "." : d,
        t = t == undefined ? "," : t,
        s = n < 0 ? "-" : "",
        i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
        j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(d{3})(?=d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
}

$(document).on('click', '[data-toggle=\'data-create\']', function(e) {
    e.preventDefault();
    let element = $(this);
    let basket = $('#basket');
    let total = $('.total');
    let url = $('base').attr('href');
    let sum = 0;
    $.ajax({
        type: 'post',
        data:$('#' + $(this).attr('data-form')).serialize(),
        url: $(this).attr('data-action'),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        error: function (){
            message.error('Ürün Sepete Eklenemedi')
        },
        success: function(data) {
            if (data['attributes'] != null){
                $('#basket-body').children().remove()
                let count = 0;
                let html = '';
                $.each(data['attributes'], function (key, value){
                    count += value.quantity;
                    sum += parseFloat(value.product.price) * value.quantity;
                    html += '    <tr class="basket-row-' + value.basket_id + '">';
                    html += '        <td>' + value.product.name + '</td>';
                    html += '        <td id="price-' + value.basket_id + '" data-price="' + parseFloat(value.product.price) *  value.quantity + '">' + parseFloat(value.product.price) + '</td>';
                    html += '        <td class="text-center" id="quantity-' + value.basket_id + '" data-quantity="' + value.quantity + '">' + value.quantity + '</td>';
                    html += '        <td class="text-right"><a href="#" id="' + value.basket_id + '" data-action="'+ url +'/basket/delete/'+value.basket_id+'" onclick="basketDelet(this.id)"><i class="fa fa-trash text-danger"></i></a></td>';
                    html += '    </tr>';
                });
                basket.text(count)
                $('#basket-body').append(html)
                $('.total').text(data.total.totalPrice.formatMoney(2, ',', '.') + " ₺");
                $('.totalDiscount').text(data.total.totalDiscount.formatMoney(2, ',', '.') + " ₺");
                $('.totalQuantity').text(data.total.totalQuantity);
                (data.total['discounts'].length > 0) ? $('.discountedTotal').text(data.total.discountedTotal.formatMoney(2, ',', '.') + " ₺") : $('.discountedTotal').text(data.total.totalPrice.formatMoney(2, ',', '.') + " ₺");
                $('#exampleModal').modal('hide');
                $('#exampleModal').remove();
                message.success(data.notification)
            }else{
                $('#exampleModal').modal('hide');
                $('#exampleModal').remove();
                message.info(data.notification);
            }
        }
    });
});

function basketDelet(id)
{
    event.preventDefault();
    var html = ''
    let basket = Number($('#basket').text());
    let quantity = Number($('#quantity-' + id).attr('data-quantity'));
    let total_quantity = (basket- quantity);
    $('#basket').text(total_quantity);
    $.ajax({
        type:'GET',
        url:$('#' + id).attr('data-action'),
        error: function (){
            message.error('Something went wrong')
        },
        success: function (data){
            $('.basket-row-' + id).remove();
            $('.total').text(data.total.totalPrice.formatMoney(2, ',', '.') + " ₺");
            $('.totalDiscount').text(data.total.totalDiscount.formatMoney(2, ',', '.') + " ₺");
            $('.totalQuantity').text(data.total.totalQuantity);
            message.info('Ürün Sepetten Çıkarıldı.');
            if (data.total['discounts'].length > 0){
                $('.discountedTotal').text(data.total.discountedTotal.formatMoney(2, ',', '.') + " ₺")
                $('.alert-message').remove();
                $.each(data.total.discounts, function (key, value){
                    html +='<h5 class="text-success alert-message">'+ value.discountReason +'</h5>'
                });
                $('#message-list').append(html)
            }else{
                $('.discountedTotal').text(data.total.totalPrice.formatMoney(2, ',', '.') + " ₺");
                $('.alert-message').remove()
            }
        }
    });
}
$(document).on('click', '[data-toggle=\'data-update\']', function (e){
    e.preventDefault();
    let element = $(this);
    let id = element.attr('id')
    let quantity = Number($('#quantity-' + id).attr('data-quantity'));
    $.ajax({
        type:'post',
        data:$('#' + element.attr('data-form')).serialize(),
        url:element.attr('data-action'),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        error: function (){
             message.error('Güncelenemedi.')
        },
        success: function(data) {
            if (data.total){
                $('.total').text(data.total.totalPrice.formatMoney(2, ',', '.') + " ₺");
                $('.totalDiscount').text(data.total.totalDiscount.formatMoney(2, ',', '.') + " ₺");
                $('.totalQuantity').text(data.total.totalQuantity);
                $('#quantity-' + id + ':last').attr('data-quantity', Number(data.quantity))
                $('#quantity-' + id + ':first').text(Number(data.quantity))
                total_quantity = (Number(data.quantity) - quantity)
                $('#basket').text(data.total.totalQuantity);
                if (data.total['discounts'].length > 0){
                    $('.discountedTotal').text(data.total.discountedTotal.formatMoney(2, ',', '.') + " ₺");
                    $('.alert-message').remove();
                    var html = ''
                    $.each(data.total.discounts, function (key, value){
                        html +='<h5 class="text-success alert-message">'+ value.discountReason +'</h5>'
                    });
                    $('#message-list').append(html)
                }else{
                    $('.discountedTotal').text(data.total.totalPrice.formatMoney(2, ',', '.') + " ₺");
                    $('.alert-message').remove()
                }
            }
            message.info(data.notification);
        }
    });
});

$(document).on('click', '[data-toggle=\'modal\']', function (e){
    e.preventDefault();
    let element = $(this);
    $('#exampleModal').remove();
    $.ajax({
        url:element.attr('data-action'),
        dataType: 'html',
        error:function (){

        },
        success:function (html){
            $('body').append(html);
            $('#exampleModal').modal('show');
        }

    })
})



/*    let total = Number(parseFloat($('.total').text()));
    console.log('total =' +total);
    let price = Number(parseFloat($('#price-' + id).attr('data-price')));
    console.log('price =' +price);
    let result = (total - price);
    console.log('result =' +result);
    $('.total').text(result.formatMoney(2, ',', '.')+" ₺");
    console.log('total =' +result.formatMoney(2, ',', '.'))*/
