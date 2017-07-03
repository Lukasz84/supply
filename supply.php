<?php
require_once('config/class.dbmysqldriver.php');
require_once('config/query.dbmysql.php');
require_once('view/main.view.php');
class supply
{
    public function __conctruct()
    {
        
    }
    public function odd()
        {
            $DB=new dbmysqldriver();
      $result2=$DB->query('select * from supply_order');
        $cnt=$DB->numrows($result2);
        $view=new mainview();
        for($i=0;$i<=$cnt;$i++)
        {
            echo $view->view();
        }    
        }

}

?>