$(document).ready(function(){
$('.confirm').click(function(){

var del = confirm("Are You sure want to delete this component");
if (del == true) {
   txt = $(this).data('component');
    $.ajax({
         url:"http://localhost/ossn/action/component/delete",
	type:'get',
	data:"component="+txt,
	success: function(data)
	{
alert("sucess");
	} 

});
} else {
    txt = "You pressed Cancel!";
}
});

});
