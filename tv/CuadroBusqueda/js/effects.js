$(document).ready(function(){
     
    $("input").bind("click",function(){		
	
		var input = $(this);
		
		if (input.val() == "Buscar"){
        	
			input.val("");
			
   		}else{
	    
			this.select();
    	}
		
		$("#wrap-search").addClass("active");
		
		$(input).parent().removeClass("close").addClass("expand");
		
    });

	
	$("#icn-close").bind("click",function(){		
		
		$("#wrap-search").removeClass("active");
	
		$(this).parent().addClass("close").removeClass("expand");
	
		$(this).parent().children("input").val("Buscar");
		
    });


	$("input").bind("blur", function(){

		input = $(this);
		
	    if (input.val() == ""){ 

        	$("#icn-close").trigger("click");
		  
		}		
	
	});
 
});

