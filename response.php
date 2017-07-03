<?php
require_once('config/class.dbmysqldriver.php');
require_once('config/query.dbmysql.php');


$DB=new dbmysqldriver();


<<<<<<< HEAD
$result2=$DB->query('select * from supply_order');
=======
$result2=$DB->query($mainquery_demo);
>>>>>>> 3dc9981220f61a5f73871d151fa2f804261f1265


//foreach($result2 as $key)
//{
  //  echo $key['orderid'];
//}

echo json_encode($result2);




?>