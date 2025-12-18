## edit email settings using Softaculous API Guide

This document explains how to edit email settings using Softaculous API.


### via cURL
```php
curl -d "editemailsettings=1" -d "email=admin@example.com" -d "ins_email=1" "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=email&api=json"
```

### via PHP script

```php

<?php

// The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
      			'&api=serialize'.
      			'&act=email';

$post = array('editemailsettings' => 1,
          		'email' => 'admin@example.com',
          		'ins_email' => '1'
              );

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
$res = unserialize($resp);

print_r($res);

?>
```
### Expected response
```php
Array
(
    [title] => Softaculous - Powered by Softaculous
    [done] => 1
    [ins_email] => 1
    [rem_email] => 0
    [editdetail_email] => 0
    [backup_email] => 0
    [email_password_user] => 0
    [disable_all_notify_update] => 1
    [email] => admin@example.com
    [timezone] => 0
    [language] => english
    [user] => Array()....
)
   
```

### Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication    | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act    | email   | The value should be “email” to perform the action of updating the email settings of a user. |
| **POST**    |
| editemailsettings  | 1   | This will trigger the edit email settings function  |
| email  | admin@example.com  | (Optional) Pass a valid email to receive the updates, leave blank to leave the email unchanged. |
| ins_email  | 1   | (Optional) Pass this as 1 to enable receiving email for new installations, off to disable the same.  |
| rem_email | 1   | (Optional) Pass this as 1 to enable receiving email after removing an installation, off to disable the same. |
| editdetail_email  | 1   | (Optional) Pass this as 1 to enable receiving email after editing an installation, off to disable the same. |
| backup_email  | 1   | (Optional) Pass this as 1 to enable receiving email after backup of an installation, off to disable the same. |
| restore_email  | 1 | (Optional) Pass this as 1 to enable receiving email after restore of an installation, off to disable the same. |
| clone_email  | 1   | (Optional) Pass this as 1 to enable receiving email after cloning an installation, off to disable the same.  |
| disable_all_notify_update  | 1   | (Optional) Pass this as 1 to disable receiving update available notification email, off to enable the same. |
