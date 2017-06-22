<?php
//echo ('Test polaczenia');
require_once('config/class.dbmysqldriver.php');
require_once('config/query.dbmysql.php');
require_once('view/main.view.php');
require_once('response.php');


$DB=new dbmysqldriver();


//$result1=$DB->query($equipment);
$result2=$DB->query($mainquery_demo);
//echo $result2;
//foreach($result2 as $key)
//{
  //  echo $key['orderid'];
//}
//echo json_encode($result2);

mainview::header();
echo '<table class="table table-condensed table-hover table-striped" width="10 0%" cellspacing="1px" style="font-size:14px;"><thead><tr>';
//foreach($result as $key)
//{
   // echo '<th>'. $key['equipmentId''</th>';
   echo '<th>ZS</th>';
   echo '<th>Numer Seryjny</th>';
   echo '<th>Urządzenie</th>';
//}
echo '</tr></thead><tbody id="supply_grid"></tbody></table>';
mainview::footer();


?>