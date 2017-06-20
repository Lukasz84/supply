<?php
//echo ('Test polaczenia');
require_once('config/class.dbmysqldriver.php');
require_once('config/query.dbmysql.php');
require_once('view/main.view.php');

$DB=new dbmysqldriver();


$result=$DB->query($equipment);
$result=$DB->query($mainquery_demo);
mainview::header();
echo '<table class="table table-condensed table-hover table-striped" width="100%" cellspacing="1px" style="font-size:14px;"><thead><tr>';
//foreach($result as $key)
//{
   // echo '<th>'. $key['equipmentId''</th>';
   echo '<th>kociol</th>';
   echo '<th>naklejki</th>';
   echo '<th>piana</th>';
//}
echo '</tr></thead><tbody id="supply_grid"></tbody></table>';
mainview::footer();



?>