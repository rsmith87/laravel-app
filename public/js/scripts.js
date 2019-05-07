$('.phone_us').mask('(000) 000-0000');

var $ = jQuery;
var hash = window.location.hash;
if(hash){
    $('.tab-content div').removeClass('show').removeClass('active');
    $('.nav-tabs li a').removeClass('active');
    $('.nav-tabs li a[href="'+hash+'"').addClass('active');
    $(hash).addClass('show').addClass('active');
} 

$('#client-address-button').click(function(){
    $('.address-form').css({'height':'225px'});
});

$('#add-opposing-councel').click(function(){
    $('.opposing-councel-form').css({'height':'275px'});
});

$('button.close span').click(function(){
    var $this = $(this);
    $this.parent().parent().parent().parent().css({"height":"0px"});
});