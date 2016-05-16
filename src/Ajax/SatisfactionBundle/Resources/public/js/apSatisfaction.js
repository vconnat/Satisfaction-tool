function showSatisfactionDialog(element, year, month)
{
	var dataUrl 	= $(element).attr("data-url");
	var dataHTML 	= ""; 

	$.ajax({
		type    : "POST",
		url     : dataUrl,
		data 	: {
			rqYear 	: year,
			rqMonth : month
		}, 
		async   : false,
		success : function( data ){
			if( data["status"] == "success" ){
				dataHTML = data["template"]
			}else{
				alert( data["message"] );
			}
		},
		error: function( data ) {
			alert( "Ajax retrieval Error. Please try later" );
		}
	});

	if( dataHTML != "" ){
		$("#humorEquilibriumDialog").html( dataHTML );

		$("#humorEquilibriumDialog").find(".hmrChoice").each( function(){
			if( $(this).is(':checked') ){
				var clk = $(this).attr("onClick");
				clk = clk.replace( "showIrritantField(", "" ).replace( ")", "" );
				showIrritantField( parseInt( clk ) );
			}
		});

		$( "#humorEquilibriumDialog" ).dialog(
	    {
	    	resizable: false,
	    	height: 460,
	    	width: 525,
	    	modal: true,
	    	dialogClass: "validationDialog",
	    	open: function() {
	    		$('.ui-dialog-titlebar').addClass('ui-dialog-noshow');
	    		$('.ui-widget-content').addClass('ui-widget-content-style');
	    	},
	    	close: function() {
	    		$('.ui-dialog-titlebar').removeClass('ui-dialog-noshow');
	    		$('.ui-widget-content').removeClass('ui-widget-content-style');
	    	},
	    	buttons: {
	    		"Envoyer": function() {
	    			var returnValue = false;

	    			$.ajax({
						type    : "POST",
						url     : dataUrl+"Submit",
						data 	: $("#validationSatisfactionForm").serialize(), 
						async   : false,
						success : function( data ){
							console.log(data);
							if( data["status"] == "success" ){
								dataHTML = data["template"]
								$('#humorEquilibriumDialog').dialog( "close" );
								returnValue = true;
							}else{
								alert( data["message"] );
							}
						},
						error: function( data ) {
							alert( "Ajax retrieval Error. Please try later" );
						}
					});
					return returnValue;
	    		},
	    		"Annuler": function() {
	    			$('#humorEquilibriumDialog').dialog( "close" );
	    		}
	    	}
	    });
	}else{
		return true;
	}
}

function showIrritantField( elementValue ){
	if( elementValue == 0 ){
		$( "#ac_maintIrritant_table" ).hide();
	}else{
		$( "#ac_maintIrritant_table" ).show();
	}
}