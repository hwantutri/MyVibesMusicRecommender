$(document).ready(function() {

	function(){
	
	}

  $('#example-1').ratings(5, getRating('user_prten')).bind('ratingchanged', function(event, data) {
    $('#example-rating-1').text(data.rating);
	var star_value = data.rating;
	$.post('star_rate.php', {star:star_value,extra:'user_prten'}, function(data){});
  });
  
  $('#example-2').ratings(5).bind('ratingchanged', function(event, data) {
    $('#example-rating-2').text(data.rating);
	var star_value = data.rating;
	$.post('star_rate.php', {star:star_value,extra:'user_pcten'}, function(data){});
  });
  
    $('#example-3').ratings(5).bind('ratingchanged', function(event, data) {
    $('#example-rating-3').text(data.rvating);
	var star_value = data.rating;
	$.post('star_rate.php', {star:star_value,extra:'friends_prten'}, function(data){});
  });
  
    $('#example-4').ratings(5).bind('ratingchanged', function(event, data) {
    $('#example-rating-4').text(data.rating);
	var star_value = data.rating;
	$.post('star_rate.php', {star:star_value,extra:'friends_pcten'}, function(data){});
  });
  
    $('#example-5').ratings(5).bind('ratingchanged', function(event, data) {
    $('#example-rating-5').text(data.rating);
	var star_value = data.rating;
	$.post('star_rate.php', {star:star_value,extra:'global_prten'}, function(data){});
  });
  
    $('#example-6').ratings(5).bind('ratingchanged', function(event, data) {
    $('#example-rating-6').text(data.rating);
	var star_value = data.rating;
	$.post('star_rate.php', {star:star_value,extra:'global_pcten'}, function(data){});
  });
});