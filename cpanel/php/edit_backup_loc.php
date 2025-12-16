<?php 

//The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
	      '&api=serialize'.
	      '&act=editbackuploc'.
	      '&loc_id=1';
			
$post = array('editbackuploc' => '1',
              'location_name' => 'Backuploc1',
              'server_host' => 'example.com', // Pass the server host where you want to store the backups			  
              'protocol' => 'ftp', // Pass the protocol with which you want to connect to server host. Default is FTP.
	      'port' => '21', // Pass the port with which you want to connect to FTP user account. Default FTP port is 21.
	      'ftp_user' => 'ftpusername',
	      'ftp_pass' => 'ftppassword',
	      'backup_loc' => '/backups1'
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

	echo "Backup location editted successfully";

// Error
}else{

	echo 'Some error occured';
	print_r($res['error']);

}

?>
