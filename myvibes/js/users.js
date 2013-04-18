// edited by: Aiko Katherine L. Olaer 

$('#username2').keyup(function(){
var username	= $(this).val();
$('#username_status').text('searching....');
if(username2 != "")	{
$.post('username_check.php',{username2:username}, function(data){
	$('#username_status').text(data);});
}
else	{
	$('#username_status').text('Nothing');
}





});