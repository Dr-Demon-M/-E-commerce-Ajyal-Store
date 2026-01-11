
// update quantity
import $ from 'jquery';
$(document).on('change', '.item-quantity', function () {
    const quantity = $(this).val();
    const id = $(this).data('id');

    $.ajax({
        url: '/cart/' + id,
        method: 'PUT',
        data: { quantity: quantity },
        success: function () {
            // بعد نجاح التحديث، عمل refresh للصفحة
            location.reload();
        },
        error: function (xhr) {
            console.error('Error updating cart', xhr.responseText);
            alert('Error updating cart');
        }
    });
});

// delete single product from cart and refresh total
$(document).on('click', '.remove-item', function () {
    const id = $(this).data('id');
    const row = $(this).closest('.cart-single-list');

    $.ajax({
        url: '/cart/' + id,
        method: 'DELETE',
        success: function () {
            row.remove(); // حذف العنصر من الصفحة

            // إعادة حساب المجموع
            let total = 0;
            $('.cart-single-list').each(function () {
                const subtotalText = $(this).find('p').eq(1).text(); // عمود subtotal
                const subtotal = parseFloat(subtotalText.replace(/[^0-9.-]+/g, ""));
                total += subtotal;
            });

            // تحديث الـ total في الصفحة
            $('#cart-total').text('$' + total.toFixed(2));
        },
        error: function (xhr) {
            alert('Error removing item');
        }
    });
});

// delete product from cart-menu and refresh total and number of product
$(document).on('click', '.remove', function () {
    const id = $(this).data('id');
    const row = $(this).closest('li'); // عنصر الـ li يحتوي المنتج بالكامل

    $.ajax({
        url: '/cart/' + id,
        method: 'DELETE',
        success: function (res) {
            row.remove();

            // تحديث الـ total في القائمة
            let total = 0;
            $('.shopping-list .amount').each(function () {
                const priceText = $(this).text().replace(/[^0-9.-]+/g, "");
                total += parseFloat(priceText);
            });
            $('.total-amount').text('$' + total.toFixed(2));

            // تحديث عدد العناصر في الكارت (badge)
            $('.total-items').text($('.shopping-list li').length);
        },
        error: function () {
            alert('Error removing item');
        }
    });
});

