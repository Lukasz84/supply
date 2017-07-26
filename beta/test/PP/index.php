<?php
// Turn off all error reporting
error_reporting(0);
require_once("nusoap/lib/nusoap.php");
$servername="http://emonitoring.poczta-polska.pl/";
$client = new nusoap_client("https://tt.poczta-polska.pl/Sledzenie/services/Sledzenie?wsdl", "wsdl"); 
$client->soap_defencoding = "UTF-8";
$client->decode_utf8 = false; 

//Uwierzytelnianie dla poczty polskiej protokół UTA

$header = "<wsse:Security xmlns:wsse='http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd'>";
$header.=   "<wsse:UsernameToken xmlns:wsse='http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd'>";
$header.=       "<wsse:Username>sledzeniepp</wsse:Username>";
$header.=       "<wsse:Password Type='http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText'>PPSA</wsse:Password>";
$header.=   "</wsse:UsernameToken>";
$header.= "</wsse:Security>";
 
//Koniec uwierzytelniania

$numer='00459007731185404992';
$backresult=array();
try
{
 if($err = $client->getError()){
        echo 'Wystąpił błąd';
    }
	else
	{
        $result = $client->call("sprawdzPrzesylkePl", array("numer" => $numer),$servername,'',$header);
       if($result['return']['status']==0) {
			
			foreach($result['return']['danePrzesylki'] as $key=>$value)
						foreach($value as $key2=>$value2)
								foreach($value2 as $key3=>$value3)
									foreach($value3 as $key4=>$value4)
									{
										if(!is_array($value4)&&$key4!='kod'&&$key4!='przyczyna'&&$key4!='konczace')
										{
											echo  ucfirst($key4).':  '.$value4.'<br>';
										}
									}
			
		echo '<br><br>Czy zakończono obsługę przesyłki: ';
		if($result['return']['danePrzesylki']['zakonczonoObsluge']=='true') echo 'Tak'; else echo 'Nie';
			echo $result['return']['danePrzesylki']['zakonczonoObsluge'];
	        }
    }
}
	catch(SoapFault $fault){
        print_r($fault);
        print("Fault string: " . $fault->faultstring . "\n");
        print("Fault code: " . @$fault->detail->WebServiceException->code . "\n");
} 

?>