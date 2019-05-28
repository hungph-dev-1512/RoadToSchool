<script type="text/javascript">
    function addCourseToCart(courseId, success_message, fail_message_in_cart_already, fail_message_my_course_already, fail_message_my_bill_already, typeButton, cartItemType) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/cart_items/create',
            type: 'post',
            data: {
                courseId: courseId,
                cartItemType: cartItemType,
            },
            success: function (response) {
                if (response === 10000) {
                    $.notify({
                        // options
                        message: fail_message_in_cart_already
                    }, {
                        // settings
                        type: 'danger'
                    });
                } else if (response === 10001) {
                    $.notify({
                        // options
                        message: fail_message_my_course_already
                    }, {
                        // settings
                        type: 'danger'
                    });
                } else if (response === 10002) {
                    $.notify({
                        // options
                        message: fail_message_my_bill_already
                    }, {
                        // settings
                        type: 'danger'
                    });
                } else {
                    $('#navbar').load(location.href + " #navbar");
                    if (typeButton === 'buy-now') {
                        var currentUrl = $(location).attr('href');
                        var position = currentUrl.indexOf('/courses');
                        var endpoint = currentUrl.substring(position, position + 10);
                        var redirectUrl = currentUrl.replace(endpoint, '/cart_items/checkout');
                        $.notify({
                            // options
                            message: success_message
                        }, {
                            // settings
                            type: 'success'
                        });
                        setTimeout(function () {
                            window.location.replace(redirectUrl);
                        }, 3000);
                    } else {
                        $.notify({
                            // options
                            message: success_message
                        }, {
                            // settings
                            type: 'success'
                        });
                    }
                }
            }
        });
    }
</script>