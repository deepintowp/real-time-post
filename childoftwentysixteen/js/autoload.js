jQuery(document).ready(function($){
	setInterval(function(){
	$.ajax({
			url:autopostload.url,
			type:'POST',
			data:{
				action: 'autoload_action'
				
				
			},
			success:function(response){
				
					$("main#main").prepend(response);
					
				
			},
			error:function(){
				alert('There Aws some problem');
			}
			
			
		});
	
	
	 }, 30000);
});