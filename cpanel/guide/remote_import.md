## Remote Import an installation using Softaculous API guide

This document will explain how to import your installations from some other server to Softaculous on your server using remote. (For eg. If you want to import a WordPress Installation installed on any other server to Softaculous on your server.)

### via cURL
```php
curl -d "remote_submit=1" -d "domain=source.example.com" -d "server_host=ftp.example.com" -d "protocol=ftp" -d "21" -d "ftp_user=ftp_user" -d "ftp_pass=ftp_pass" -d "ftp_path=/public_html" -d "Installed_path=wp" -d "softdomain=destination.example.com" -d "dest_directory=wp_dest" -d "softdb=db_name" "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=import&soft=26&api=json"
```

### via PHP script

```php
<?php

// The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
                  '&api=serialize'.
                  '&act=import'.
                  '&soft=26';

$post = array('remote_submit' => '1',
              'domain' => 'source.example.com', // Source installation domain
              'server_host' => 'ftp.example.com', // Optional
              'protocol' => 'ftp',
              'port' => '21',
              'ftp_user' => 'ftp_user',
              'ftp_pass' => 'ftp_pass',
              'ftp_path' => '/public_html',
              'Installed_path' => 'wp', // Optional
              'softdomain' => 'destination.example.com', // Destination domain
              'dest_directory' => 'wp_dest', // Optional Directory
              'softdb' => 'dbname' // Database name (Option for scripts that do not have database name)
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
$res = unserialize($resp);

print_r($res);

?>

```
### Expected response
```php
Array
(
    [title] => Softaculous - Powered by Softaculous
    [done_msg] => Import has been pushed in background
    [insid] => 
    [done] => 5O7yiTxqCcMobfz4bSBtEcI26GgD6eoy
    [info] => Array
        (
            [overview] => ...............  

```

### Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication    | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act    | import   | The value should be “import” to perform the action of importing an installation.   |
| soft    | 26 (26 is the Script ID of WordPress)   | The value should be “SID” for softaculous to perform the action of installing a software. You can find the list of sid’s [here](https://api.softaculous.com/scripts.php?in=serialize)  |
| **Post** |
| domain  | source.example.com  | This will be the domain where your script is installed. |
| server_host  | ftp.example.com  | (OPTIONAL) This is the server host which will be used as the host to connect via FTP.  |
| protocol  | ftp  | The Protocol to use for connecting to the domain. Currently only FTP protocol is supported.  |
| port  | 21  | Port number to connect to the FTP server. FTP default is 21.  |
| ftp_user | ftp_user  | User to connect to the FTP server.  |
| ftp_pass | ftp_pass  | Password for User to connect to the FTP server.  |
| ftp_path | /public_html | Path to the directory relative to home directory of user for installations.  |
| Installed_path | wp  | (OPTIONAL) This will be the directory under the domain where your script is installed. Leave this blank if the script is installed in the root of domain.  |
| softproto | 1 – http:// <br> 2 – http://www. <br> 3 – https:// <br> 4 – https://www.  | (Optional) – Protocol to be used for the destination installation.  |
| softdomain    | destination.example.com  | This is the destination domain on which you wish to import the script.  |
| dest_directory | wp_dest  | (OPTIONAL) This will be the directory under the domain where you want the installation to be imported. Leave this blank if you want to import the installation to the root of your domain. |
| softdb | dbname | (OPTIONAL) This is the database name for the script. If the script does not require database you can leave this blank  |
| remote_submit | 1  | This will trigger the remote import function. |
