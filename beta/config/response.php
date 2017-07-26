<?php
require_once('config/class.dbmysqldriver.php');
require_once('config/query.dbmysql.php');


$DB=new dbmysqldriver();


$result2=$DB->query('select * from supply_order');



echo json_encode($result2);


?>