<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Simple X-Editable inline editing using PHP,MySQL and AJAX</title>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-2.0.3.min.js"></script> 
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/js/bootstrap-editable.js"></script>

</head>
<body>
	
			<table class="table table-condensed table-hover table-striped" width="100%" cellspacing="2">
				<thead>
					<tr>
						<th>ZS</th>
						<th>Zespół Produkcyjny</th>
						<th>Data zakończenia</th>
						<th>Numer Seryjny</th>
					</tr>
				</thead>
				<tbody id="employee_grid">
				</tbody>
			</table>
		
</body>
</html>
<script type="text/javascript">
$( document ).ready(function() {
	function getEmployee() {
		$.ajax({
		  type: "GET",  
		  url: "response.php",
		  dataType: "json",       
		  success: function(response)  
		  {
			for (var i = 0; i < response.length; i++) {
					//$('#employee_grid').append("<tr><td>" + response[i].orderid + "</td><td>" 
				//	+ response[i].team + "</td><td>" 
				//	+ response[i].finalDate + "</td><td>" + response[i].serialNumber + "</td></tr>");



$('#employee_grid').append("<tr><td>" + response[i].orderid + "</td><td data-name='employee_name' class='employee_name' data-type='select' data-pk='"+response[i].orderid+"'>" 
+ response[i].team + "</td><td data-name='employee_salary' class='employee_salary' data-type='text' data-pk='"+response[i].orderid+"'>" 
+ response[i].finalDate 
+ "</td><td data-name='employee_age' class='employee_age' data-type='text' data-pk='"+response[i].orderid+"'>" + response[i].serialNumber + "</td></tr>");


			 }
		  },
		 error: function(jqXHR, textStatus, errorThrown) {
			 alert("loading error data " + errorThrown);
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
	
	getEmployee();
	
	make_editable_col('#employee_grid','td.employee_name','response.php?action=edit','Employee Name');
make_editable_col('#employee_grid','td.employee_age','response.php?action=edit','Employee Age');
make_editable_col('#employee_grid','td.employee_salary','response.php?action=edit','Employee Salary');
	
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
			$("#employee_grid").bootgrid('reload');
		  }   
		});
	}
});
</script>
