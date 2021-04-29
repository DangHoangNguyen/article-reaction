jQuery(document).ready(function($) { 
		  $('#ar_btn').click(function(){
		  	let currentLikeCount = $('#like_count').text();
		  	if(currentLikeCount.length == 0){
		  		$('#like_count').empty().append('1');
		  	}else{
		  		currentLikeCount = parseInt(currentLikeCount)+1;
		  		$('#like_count').empty().append(currentLikeCount);
		  	}
			
		  	$("#ar_btn").unbind("click");
		        $.ajax({
		            type : "POST", 
		            dataType : "json", 
		            url: $('#admin_ajax_url').val(),
		            data : {
		            	postId: $('#getPosId').val(),
		                action: "store_like_count_ajax", 
		            }
		        });
		        return false;
		    });
		    
	});