<?php
//echo ('Test polaczenia');
require_once('config/class.dbmysqldriver.php');
require_once('config/query.dbmysql.php');
require_once('view/main.view.php');


$DB=new dbmysqldriver();


$result1=$DB->query('select * from supply_desc');



//foreach($result2 as $key)
//{
  //  echo $key['orderid'];
//}

echo json_encode($result1);





?>