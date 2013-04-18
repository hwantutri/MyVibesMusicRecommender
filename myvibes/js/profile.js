 //code by: Husamaldin Tayeh [http://www.codersmount.com/2011/08/ajax-file-upload-made-easy/]
 //edited by: Aiko Katherine Olaer

$(document).ready(function() {

    //if submit button is clicked
    $('form#upload').submit(function(){  

		$('#upload_wrapper').hide();
		$('#loading').show();
		
		// get the uploaded file name from the iframe
		$('#upload_target').unbind().load( function(){								
		var img = $('#upload_target').contents().find('#filename').html();
		
		$('#loading').hide();

		// load to preview image
		if (img){
        $('#preview').show();
		$('#preview').attr('src', 'img/profile/'+img);
		$('#preview').attr('width', 100)
		$('#preview').attr('height', 100)
		$('#image_wrapper').show();
		}

		});
	});
});

