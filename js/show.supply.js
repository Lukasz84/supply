$( document ).ready(function() {
	function getOrder() {
		$.ajax({
		  type: "GET",  
		  url: "response.php",
		  dataType: "json",       
		  success: function(response)  
		  {
			for (var i = 0; i < response.length; i++) {
			
$('#supply').append('<table class="table table-condensed table-hover table-striped table-bordered table-responsive " width="100%" cellspacing="5">'+
'<thead><tr><th id="a'+response[i].id+'" class="one"></th></tr><tr><th class="two">Klient</th><th class="two">Zespół Produkcyjny</th><th class="two">Data zakończenia</th>'+
'</tr></thead><tbody id="supply_order'+i+'"></tbody>');


$('#a'+i).append(response[i].zsnumber);

$('#supply_order'+response[i].id).append("<tr><td>" + response[i].akronim + "</td><td data-name='employee_name' class='employee_name' data-type='select'>" 
+ response[i].team + "</td><td data-name='employee_salary' class='employee_salary' data-type='text'>" 
+ response[i].finaldate 
+ "</td></tr>");





function getDevice(idOrder,row) {
		$.ajax({
		  type: "GET",  
		  url: "response2.php?id="+idOrder,
		  dataType: "json",       
		  success: function(response2)  
		  {
			for (var j = 0; j < response2.length; j++) {
				

				//	$('#supply_device'+row).append('<tr><td>'+response2[j].devName+'</td></tr>');


	}
		  },
		 error: function(jqXHR, textStatus, errorThrown) {	
			 alert("loading whem select 2 error data " + errorThrown+textStatus+jqXHR);
			 
		 }
		});
	}

getDevice(response[i].id,i);

$('#supply').append('</table>'); //KONIEC TABELI FSZYSTKIE OPERACJE MUSZĄ BYĆ WYKONYWANE DO TEGO MOMENTU
			 }
		  },
		 error: function(jqXHR, textStatus, errorThrown) {
			 alert("loading error data first error data " + errorThrown);
		 }
		});
	}
	
	
	function make_editable_col(table_selector,column_selector,ajax_url,title) {
		$(table_selector).editable({   
			selector: column_selector,
			url: ajax_url,
			title: title,
			type: "POST",
			dataType: 'json'
		  });
		// $.fn.editable.defaults.mode = 'inline';
		}
	
	getOrder();
	
make_editable_col('#supply','td.employee_name','response.php?action=edit','Wybierz status:');
make_editable_col('#supply','td.employee_age','response.php?action=edit','Wybierz status:');
make_editable_col('#supply','td.employee_salary','response.php?action=edit','Wybierz status:');
	
	function ajaxAction(action) {
		data = $("#frm_"+action).serializeArray();
		$.ajax({
		  type: "POST",  
		  url: "response.php",  
		  data: data,
		  dataType: "json",       
		  success: function(response)  
		  {
			$('#'+action+'_model').modal('hide');
			$("#supply_grid").bootgrid('reload');
		  }   
		});
	}
});

