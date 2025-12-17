<?php 

// URL
$url = 'http://admin.controlpanel.com:PORT/url/to/softaculous/index.php?'.
			'&api=serialize'.
			'&act=customscripts'.
                         '&sact=add';

$post = array('csname' => 'CUSTOM SCRIPT', //Name of your custom script
              'softname' => 'custom', //Name of the custom script folder
              'desc' => 'My Custom Script', //Description of custom script
              'ver' => '1.0', //Version of custom script
              'cat' => 'blogs', //Category
              'add_submit' => '1'
 );

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

// Done ?
if(!empty($res['done'])){

print_r($res);

// Error
}else{

echo 'Some error occured';
print_r($res['error']);

}

?>
