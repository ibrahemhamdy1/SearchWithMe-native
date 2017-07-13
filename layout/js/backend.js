$(function(){
'use strict';
// DashBord

$('.toggle-info').click(function () {
	$(this).toggleClass('selected').parent().next('.panel-body').fadeToggle(100);
	if ($(this).hasClass('selected')){

		$(this).html('<i class="fa fa-minus fa-lg"></i>');

	}else{
			$(this).html('<i class="fa fa-puls fa-lg"></i>');
	}		
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

//Convert password Filed in to text Filed on hover
var passField =$('.password');
$('.show-pass').hover(function(){
passField.attr('type','text');

},function(){
	passField.attr('type','password');


});


$('.confirm').click(function(){

return confirm('Are you  sure?');

});
$('.cat h3').click(function (){
$(this).next('.full-view').fadeToggle(200);
});

$('.option span').click(function(){

	$(this).addClass('active').siblings('span').removeClass('active');
	if($(this).data('view')==='full'){
		$('.cat .full-view').fadeIn(200);
	}else{
		$('.cat .full-view').fadeOut(200);
	}

});
});