function addCourseToCart(courseId, success_message, fail_message, typeButton, cartItemType)
{
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
success: function(response)
{
if(response) {
$('#navbar').load(location.href + " #navbar");
if(typeButton === 'buy-now') {
var currentUrl = $(location).attr('href');
var position = currentUrl.indexOf('/courses');
var endpoint = currentUrl.substring(position, position+10);
var redirectUrl = currentUrl.replace(endpoint, '/cart_items/checkout');
$.notify({
// options
message: success_message
},{
// settings
type: 'success'
});
setTimeout(function() {
window.location.replace(redirectUrl);
}, 3000);
} else {
$.notify({
// options
message: success_message
},{
// settings
type: 'success'
});
}
} else {
$.notify({
// options
message: fail_message
},{
// settings
type: 'danger'
});
}
}
});
}