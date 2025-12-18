## Edit installation using Softaculous API Guide
This guide explains how to edit an installation using Softaculous API.

### via cURL
```php
curl -d "editins=1" -d "edit_dir=/path/to/installation/" -d "edit_url=http://example.com" -d "edit_dbname=wpdb" -d "edit_dbuser=dbusername" -d "edit_dbpass=dbuserpass" -d "edit_dbhost=dbhost" -d "admin_username=adminusername" -d "admin_pass=adminpassword" "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=editdetail&insid=26_12345&api=json"
```

### via PHP script

```php
<?php

$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
			'&api=serialize'.
			'&act=editdetail'.
			'&insid=26_12345';

$post = array('editins' => '1',
              'edit_dir' => '/path/to/installation/', // Must be the path to installation
              'edit_url' => 'http://example.com', // Must be the URL to installation
              'edit_dbname' => 'wpdb',
              'edit_dbuser' => 'dbusername',
              'edit_dbpass' => 'dbuserpass',
              'edit_dbhost' => 'dbhost',
              'admin_username' => 'adminusername', //Provide this only if script provides as well as password needs to be reset
              'admin_pass' => 'adminpassword' //Provide this only if script provides
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

// Print the entire output just incase !
print_r($res);

?>
```
### Expected response
```php
Array
(
    [title] => Softaculous - Powered by Softaculous
    [done] => 1
    [settings] => Array
        (
            [Admin Account] => Array
                (
                    [admin_username] => Array
                        (
                            [tag] => admin
                            [head] => Admin Username
                            [exp] => The username/email for which you want to change the password. Leave blank if you do not want to reset the password
                            [handle] => 
                            [optional] => 1
                            [quick_install] => 1
                            [minlen] => 
                        )

                    [admin_pass] => Array
                        (
                            [tag] => password123
                            [head] => Admin Password
                            [exp] => New password. Leave blank if you do not want to reset the password
                            [handle] => 
                            [optional] => 1
                            [quick_install] => 1
                            [minlen] => 
                        )

                    [signon_username] => Array
                        (
                            [save] => 1
                            [tag] => 
                            [head] => Sign on Username
                            [exp] => If set then this user will be used for sign on
                            [handle] => 
                            [optional] => 1
                            [quick_install] => 
                            [minlen] => 
                        )

                ).................


```

### Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication    | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act    | editdetail   | The value should be “editdetail” for Softaculous to perform the action of editing an installation. |
| insid    | 26_12345 (Installation ID)   | The installation ID that you want to edit. It can be fetched from List Installed Script   |
| **POST**    |
| editins  | 1   | This will trigger the edit function   |
| edit_dir | /home/USERNAME/public_html	| 	(Optional) Path to installation. If not posted the path in existing records will be used.  |
| edit_url  | 	http://example.com   | (Optional) URL to installation. If not posted the URL in existing records will be used.   |
| edit_datadir  | /home/USERNAME/datadir   | 	(Optional) Path to data directory of the installation. If not posted the data directory in existing records will be used.  |
| edit_dbname  | username_dbname   | 	(Optional) Database name for the installation. If not posted the Database name in existing records will be used.  |
| edit_dbuser  | username_dbuser   | 	(Optional) Database user for the installation. If not posted the Database user in existing records will be used.  |
| edit_dbpass  | dbpass   | 	(Optional) Password of the database user for the installation. If not posted the password in existing records will be used.  |
| edit_dbhost  | localhost   | 	(Optional) Database host for the installation. If not posted the Database host in existing records will be used.  |
| eu_auto_upgrade  | 1   | 	(Optional) 1 to Enable auto upgrade for Major as well as for Minor update, and 2 to upgrade to only Minor version and 0 to disable. If not posted the existing setting will not be changed.  |
| auto_upgrade_plugins  | 1   | 	(Optional) 1 to Enable auto upgrade plugins option and 0 to disable. If not posted the existing setting will not be changed. (Currently this option is supported only in WordPress)  |
| auto_upgrade_themes  | 1   | 	(Optional) 1 to Enable auto upgrade themes option and 0 to disable. If not posted the existing setting will not be changed. (Currently this option is supported only in WordPress)  |
| noemail  | 1   | 	(Optional) – Use this only if you do not want to send an email to the user  |
| admin_username  | adminusername   | 	(Optional) – Use this only if the script provides admin account creation at the time of installation |
| admin_pass  | adminpassword   | 	(Optional) – Use this only if the script provides admin account creation at the time of installation  |

