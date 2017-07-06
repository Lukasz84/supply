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
+ "</td></tr></table>");

$('#supply').append('<table class="table table-condensed table-hover table-striped table-bordered table-responsive " width="100%" cellspacing="5">'+
'<thead><tr><th></tr></thead><tbody id="supply_device'+i+'"></tbody>');




function getDevice(idOrder,row) {
		$.ajax({
		  type: "GET",  
		  url: "response2.php?id="+idOrder,
		  dataType: "json",       
		  success: function(response2)  
		  {
				var cnt=0;
			for (var j = 0; j < response2.length; j++) {
				

					$('#supply_device'+cnt).append('<tr><td>'+response2[j].devName+'</td></tr>');

					$('#supply_device'+cnt).append('<table class="table table-condensed table-hover table-striped table-bordered table-responsive " width="100%" cellspacing="5">'+
'<thead><tr><th>Kocioł</th><th>Naklejki</th><th>Panel Sterujacy</th><th>Przyciski Pulpitów</th><th>Typ Konstrukcji</th><th>Zasilanie</th>'+
'<th>AntiVandal</th><th>Chemia Na Pompkach</th><th>Ciepla Cyrkulacja</th><th>Czujnik Cisnienia</th><th></th><th>Data zakończenia</th><th>Czujniki Poziomu Chemii</th>'+
'<th>Dwa Obiegi Ogrzewania</th><th>Elektroniczne Pływaki Wody Z Proszkiem</th><th>Falowniki</th><th>Filtr Samoczyszczacy</th><th>Hydrofor</th>'+
'<th>Inkasacja</th><th>Kontener Socjalny</th><th>Kontener Techniczny</th><th>Ogrzewanie Kontenera</th><th>Opcja Hydrauliki</th><th>Przewody Grzejne</th>'+
'<th>Rezygnacja Z Proszuku</th><th>SmartHeating</th><th>NSPremium</th><th>Wybor Technologii</th><th>Zasysanie Monet</th><th>Czytnik Banknotów</th>'+
'<th>Czytnik Kart Lojalnościowych</th><th></th><th>Czytnik Kart Płatniczych</th><th>Oprysk Felg</th><th>Piana</th><th>Szczotka</th><th>Turbo Piana</th>'+
'</tr></thead><tbody id="supply_deviceDetails'+cnt+'"></tbody>');
	$('#supply_deviceDetails'+cnt).append('<tr><td>'+response2[j].devName+'</td></tr>');

	}

	cnt++;
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

