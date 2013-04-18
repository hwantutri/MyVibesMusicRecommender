$(document).ready(function ()
{

$(this).scrollTop(0);

$('#myTab2 a').click(function (e) {
  e.preventDefault();
  $(this).tab('show');
});

$('#myTab2 a:first').tab('show');

$('#myTab a').click(function (e) {
  e.preventDefault();
  $(this).tab('show');
});


	showTab(location.hash || "listfriends");

    $("#myTab a").click(function() {
        var hash = this.getAttribute("href");
        if (hash.substring(0, 1) === "#") {
            hash = hash.substring(1);
        }
        location.hash = hash;
		//alert(hash);
        showTab(hash);
        return false;
    });
	
	

    function showTab(hash) {
        //$("div.tab-pane").show();
		if(hash == "listfriends"){
			$('#myTab a:first').tab('show');
		}
		else{
			$('#myTab a:last').tab('show');
		}
    }
	
	//$('#myTab a:first').tab('show');
	
	$("#example").popover();


});
