$( document ).ready(function() {
    function getEQ() {
        $.ajax({
          type: "GET",  
          url: "response.php",
          dataType: "json",       
          success: function(response)  
          {
            for (var i = 0; i < response.length; i++) {
                 $('#supply_grid').append("<tr><td>" + response[i].id + "</td><td>" + response[i].employee_name + "</td><td>" 
                 + response[i].employee_salary + "</td><td>" 
                 + response[i].employee_age + "</td></tr>");
             }
          },
         error: function(jqXHR, textStatus, errorThrown) {
             alert("loading error data " + errorThrown);
         }
        });
    }
});