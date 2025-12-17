<?php 

//The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
			'&api=serialize'.
                        '&act=wordpress';

$post = array('insids' => array('26_31793'),
              'secure_options'=> array(
			'change_admin_username' => 1 ,
			'no_file_dir_access' => 1 ,
			'disable_xml_rpc' => 1 ,
			'block_htaccess' => 1 ,
			'disable_pingbacks' => 1 ,
			'no_file_editing' => 1 ,
			'block_author_scan' => 1 ,
			'block_dir_browsing' => 1 ,
			'no_php_exec_wpinc' => 1 ,
			'no_php_exec_wpuploads' => 1 ,
			'no_script_concat' => 1 ,
			'block_sensitive_files' => 1 ,
			'enable_bot_protection' => 1 ),
              'save_security_measures' => '1'
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
