var myElement = $(".select-product");
var myElement1 = $(".option-product");
let isInsideElement = false;
let isInsideElement1 = false;

myElement.on("mouseenter", function(){
    isInsideElement = true;
});
myElement.on("mouseleave", function(){
    isInsideElement = false
    $(document).one("click", function(event){
        if(!isInsideElement && !isInsideElement1){
            $('.option-product').removeClass('active');
        }
    });
});

myElement1.on("mouseenter", function(){
    isInsideElement1 = true;
});
myElement1.on("mouseleave", function(){
    isInsideElement1 = false
    $(document).one("click", function(event){
        if(!isInsideElement && !isInsideElement1){
            $('.option-product').removeClass('active');
        }
    });
});


$('.select-product').on('click', function (){
    $('.option-product').addClass('active');
    $('.option-product input[type="text"]').focus()
})

function remoteProduct(event, id) {
    event.stopPropagation()
    $('.select-product ol li#check-' + id).remove();
    $("input[value=" + id + "]").prop('checked', false);
}
function isCheckedById(id, name) {

    $('.option-product input[type="text"]').focus()
    var checked = $("input[value=" + id + "]:checked").length;
    console.log(checked)
    if (checked == 1) {
        $('.select-product ol').append('<li id="check-' + id +'">' + name + '<i onclick="remoteProduct(event,'+ id +')" class="fa fa-times"></i>'+'</li>')
        return true;
    } else {
        $('.select-product ol li#check-' + id).remove()
    }
}
var delayTimer;
$('.option-product .search').on('input', function() {
    // Xóa bỏ timer trước đó nếu có
    clearTimeout(delayTimer);

    // Thiết lập timer mới (1 giây = 1000 milliseconds)
    delayTimer = setTimeout(function() {
        let value = $('.option-product .search').val();
        $.ajax({
            type: 'GET',
            url: route('productsApi.show', value),
            success(response) {
                console.log(response)
            }
        })
    }, 1000);
});
