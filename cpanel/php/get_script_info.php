<?php 

// The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
			'&api=serialize'.
			'&act=software'.
			'&soft=26'.
			'&giveinfo=1';


// Set the curl parameters.
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Turn off the server and peer verification (TrustManager Concept).
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

if(!empty($post)){
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
}
 
// Get response from the server.
$resp = curl_exec($ch);
 
// The response will hold a string as per the API response method. In this case its PHP Serialize
$res = unserialize($resp);
 
print_r($res);
print_r($res['info']['overview']); // will have overview of the script (in HTML format)
print_r($res['info']['features']); // will have features list of the script (in HTML format)
print_r($res['info']['demo']); // will have the link to demo of the script
print_r($res['info']['ratings']); // will have the link to ratings page of the script
print_r($res['info']['support']); // will have the link to script vendor support page
print_r($res['info']['release_date']); // will have the release date of the current version of the script
print_r($res['settings']); // will have an array of the list of fields that the script will require, e.g. site_name, site_desc, language, etc
print_r($res['dbtype']); // if the value is not empty it means the script requires a database, if the value is empty it means that the script does not require a database
print_r($res['cron']); // if the value is not empty it means the script requires a CRON JOB, if the value is empty it means that the script does not require a CRON JOB
print_r($res['datadir']); // if the value is not empty it means the script requires a data directory, if the value is empty it means that the script does not require a data directory

?>
