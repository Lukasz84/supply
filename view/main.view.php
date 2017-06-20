<?php
class mainview
{
    static public function header()
    {
        $ar= <<<HTML
        <html>
    <title>Supply Chain - BKF Myjnie Bezdotykowe Sp. z o.o.</title>
    <head>
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
        <script src="http://code.jquery.com/jquery-2.0.3.min.js"></script> 
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/js/bootstrap-editable.js"></script>

    </head>
    
    <body>
HTML;
echo $ar;
        

    }
  static public function footer()  
  {
        $ar=<<<HTML
             </body>

                </html>
HTML;
echo $ar;

  }
}
?>