# Install Script via API

This document explains how to upgrade an installation using Softaculous API.


## via cURL
```php
curl -d "softsubmit=1" "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=upgrade&insid=26_12345&api=json"
```

## via PHP script

```php
<?php

// The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
			'&api=serialize'.
			'&act=upgrade'.
      '&insid=26_12345';

$post = array('softsubmit' => '1');

// Set the curl parameters.
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $time);
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

	// There might be some task that the user has to perform
	if(!empty($res['setupcontinue'])){

		echo 'Please visit the following URL to complete upgrade : '.$res['setupcontinue'];	

	// It upgraded
	}else{

		echo 'Upgraded successfully. URL to Installation : '.$res['__settings']['softurl'];	

	}

// Error
}else{

	echo 'Some error occured';
	print_r($res['error']);

}

// Print the entire output just incase !
print_r($res);
```
### Expected output of $resp
```php
Array
(
    [title] => Softaculous 
    [done] => 1
    [info] => Array
        (
            [overview] => WordPress is web software you can use to create a beautiful website or blog. We like to say that WordPress is both free and priceless at the same time.
            [install] => 
            [features] => WordPress powers more than 23% of the web - a figure that rises every day. Everything from simple websites, to blogs, to complex portals and enterprise websites, and even applications, are built with WordPress.
            [demo] => http://www.softaculous.com/demos/WordPress
            [ratings] => http://www.softaculous.com/softwares/blogs/WordPress
            [support] => http://www.wordpress.org/
            [release_date] => 30-09-2025
            [mod] => 254
            [mod_files] => 
            [import] => 1
        )

    [settings] => Array
        (
            [Database Settings] => Array
                (
                    [dbprefix] => Array
                        (
                            [tag] => wp_
                            [head] => Table Prefix
                            [exp] => 
                            [handle] => 
                            [optional] => 1
                            [quick_install] => 
                            [minlen] => 
                            [orig_val] => wp_
                        )

                )
.........

```

## Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication    | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act    | software, js, perl   | The value should be “software” to install PHP script, “js” to install a JavaScript and “perl” to install a PERL script for softaculous to perform the action of installing a software.   |
| soft    | 26 (26 is the Script ID of WordPress)   | The value should be “SID” for softaculous to perform the action of installing a software. You can find the list of sid’s [here](https://api.softaculous.com/scripts.php?in=serialize)   |
| **POST**    |
| softsubmit  | 1   | This will trigger the install   |
| softdomain | domain.com   | 	This is the domain on which you wish to install the script  |
| softdirectory  | wp   | This is the sub-directory to install the script in. Leave it blank to install in root of the domain   |
| softdb  | wp123   | This is the database name for the script. If the script does not require database you can leave this blank   |
| dbusername  | wp123   | This is the database user(Only for Softaculous Remote)   |
| dbuserpass  | w1XRF28mq8   | This is the database password. You can generate a random password(Only for Softaculous Remote)   |
| hostname  | localhost   | This is the hostname of your MySQL server. You can enter your MySQL server IP if you have MySQL on a remote server(Only for Softaculous Remote)   |
| admin_username  | admin   | This is the admin account username for the installation  |
| admin_pass  | pass   | This is the admin account password for the installation  |
| admin_email  | 	admin@domain.com   | This is the admin account email address for the installation   |
| language  | en   | Language for the installation. You can get the language codes from the respective install.xml   |
| site_name  | My Blog   | 	Site Name for the installation   |
| site_desc  | My WordPress Blog   | 	Site Description for the installation   |
| dbprefix  | dbpref_  | 	(Optional) Table Prefix to be used for the tables created by application   |
| noemail  | 1   | (Optional) – Use this only if you do not want to send an email to the user  |
| overwrite_existing  | 1   | 	(Optional) – Use this only if you do not want Softaculous to check for existing files in installation path. If any file(s) exists they will be overwritten.  |
| softproto  | 1 – http:// <br> 2 – http://www.  <br>3 – https://  <br>4 – https://www.  |(Optional) – Protocol to be used for the installation   |
| eu_auto_upgrade  | 1   | 	(Optional) – Pass 1 to enable auto upgrade. Auto upgrade will be enabled only if the script supports auto upgrade.   |
| auto_upgrade_plugins  | 1   | 	(Optional) – Pass 1 to enable auto upgrade plugins. If script supports auto upgrade for plugin then it will be enabled.  |
| auto_upgrade_themes  | 1   | (Optional) – Pass 1 to enable auto upgrade themes. If script supports auto upgrade for theme then it will be enabled.   |
| auto_backup  | daily – Once a day <br> weekly – Once a week <br> monthly – Once a month   | (Optional) – Enable auto backups   |
| auto_backup_rotation  | 0 – Unlimited backup rotation <br> 1 – backup rotation after 1 backup <br> 4 – backup rotation after 1 backup  |(Optional) – Possible values (0-10). Use this to set the value for auto backup rotation.   |
| sets_name[]  | 	set-name   | (Optional) This is used when you want the user to install sets, here set-name is the name of the set created.   |
