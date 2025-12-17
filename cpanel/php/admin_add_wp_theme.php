<?php 

//The URL
$url = 'http://admin.controlpanel.com:PORT/url/to/softaculous/index.php'.
			  '&api=serialize'.
              '&sets_name=SET-NAME_admin'.
              '&themes=1'.
              '&add_plugins_themes_data=1'.
			  '&act=manage_sets';

$post = array('add_plugins_themes_data_slugs' => array('popularfx'), //Slug name
              'add_plugins_themes_data_names' => array('Popularfx') //Theme name
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
