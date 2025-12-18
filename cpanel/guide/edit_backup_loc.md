## Edit a Remote Backup Location
This document explains how to edit a remote backup location using Softaculous API.

### via cURL
```php
curl -d "editbackuploc=1" -d "location_name=Backuploc1" -d "server_host=example.com" -d "protocol=ftp" -d "port=21" -d "ftp_user=ftpusername" -d "ftp_pass=ftppassword" -d "backup_loc=/backups1" "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=editbackuploc&loc_id=1&api=json"
```

### via PHP script

```php

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
```
### Expected response
```php
Array
(
    [title] => Softaculous - Powered by Softaculous
    [done_msg] => Your backup is being created in background. You will be notified by email once its completed. You can track the backup process from the  Task List page.
Your installation URL : https://domain.com
    [done] => TDpa5nojrXBWxcIcOBvNYF2e7X9
    [userins] => Array
        (
            [sid] => 26
            [ver] => 6.9
            [itime] => 1765257816
            [softpath] => /home/user/public_html
            [softurl] => https://domain.com
            [adminurl] => wp-admin/
            [disable_wp_cron] => 
            [admin_username] => admin
            [admin_email] => admin@domain.com
            [softdomain] => domain.com
            [softdb] => user_wp152
            [softdbuser] => user_wp152
            [softdbhost] => localhost
            [softdbpass] => pp@683p8S.
            [dbprefix] => wpom_
            [dbcreated] => 1
            [fileindex] => Array .................

```

### Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication    | -   | You can use the Enduser Authenticating methods. |
| act    | editbackuploc  | The value should be “editbackuploc” to perform the action to edit a particular remote backup location. |
| loc_id | 1 | Location ID of a remote backup location. |
| **POST**    |
| editbackuploc  | 1   | This will trigger the backup location edit process.  |
| location_name |Backuploc1 | A reference name for the Backup Location. |
| server_host  | example.com | Server Host where you want to store your backups. |
| protocol  | ftp | Protocol with which you want to connect to the server host. If empty, default protocol will be FTP. |
| port  | 21 | Port with which you want to connect to server host. If empty, default FTP port will be 21. |
| ftp_user  | ftpusername | Username of the FTP account. |
| ftp_pass  | ftppassword | Password of the FTP account. |
| backup_loc  | /backups1 | Relative path from FTP user’s directory where you want to store your backups. |
