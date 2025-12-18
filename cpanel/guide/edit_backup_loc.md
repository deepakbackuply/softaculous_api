## Edit a Remote Backup Location
This guide explains how to edit a remote backup location using Softaculous API.

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
Backup location edited successfully
Array
(
    [title] => Softaculous - Powered by Softaculous
    [done] => 1
    [remote_backup_locs] => Array
        (
            [1] => Array
                (
                    [id] => 1
                    [name] => Backuploc3
                    [protocol] => ftp
                    [backup_loc] => /backups3
                    [server_host] => ftp.domain.com
                    [port] => 21
                    [ftp_user] => user
                    [ftp_pass] => pass
                    [private_key] => 
                    [passphrase] => 
                    [full_backup_loc] => ftp://user:pass@ftp.domain.com:21/backups3
                )

        )

    [timenow] => 1766065416
    [time_taken] => 0.179
)


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
