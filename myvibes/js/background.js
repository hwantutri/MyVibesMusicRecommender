

$(document).ready(function() {

    //if submit button is clicked
    $('form#upload2').submit(function(){  

		$('#upload_wrapper2').hide();
		$('#loading2').show();
		
		// get the uploaded file name from the iframe
		$('#upload_target2').unbind().load( function(){								
		var img = $('#upload_target2').contents().find('#filename2').html();
		
		$('#loading2').hide();

		// load to preview image
		if (img){
        $('#preview2').show();
		$('#preview2').attr('src', 'img/background/'+img);
		$('#preview2').attr('width', 100)
		$('#preview2').attr('height', 100)
		$('#image_wrapper2').show();
		}

		});
	});
});

