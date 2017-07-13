$(function(){
'use strict';
//Switch Between Login &Singup

$('.login-page h1 span').click(function (){
	$(this).addClass('selected').siblings().removeClass('selected');
	$('.login-page form').hide();
	$('.'+ $(this).data('class')).fadeIn(100);

});



//Trigger The Selectboxit
$("select").selectBoxIt({
	autoWidth:false
});


//Hid Placeholder on  form  focus
$('[placeholder]').focus(function(){
$(this).attr('date-text', $(this).attr('placeholder'));
$(this).attr('placeholder','');


}).blur(function(){
	$(this).attr('placeholder', $(this).attr('date-text'));
});




// add Asterisk on Required 
$('input').each(function(){
if ($(this).attr('required')=='required') {
	$(this).after('<span class="asterisk">*</span>');


}

});



$('.confirm').click(function(){

return confirm('Are you  sure?');

});

$('.live').keyup(function(){
	$($(this).data('class')).text($(this).val());
})



});

