## Enable/Disable script using Softaculous API Guide
This guide explains how to enable/disable script using Softaculous API.

### via cURL
```php

curl -d "updatesoft=Update Settings" -d "soft_26=1" -d "soft_18=1" -d "soft_543=1" -d "soft_11=1" -d "soft_3=1" -d "soft_34=1" -d "soft_14=1" -d "soft_470=1" "https://user:password@domain.com:2087/url/to/softaculous/index.php?act=softwares&api=json"

```

### via PHP script

```php

<?php

// URL
$url = 'http://admin.controlpanel.com:PORT/url/to/softaculous/index.php?'.
			'&api=serialize'.
			'&act=softwares';

$post = array('updatesoft' => 'Update Settings',
	'soft_26' => 1, // WordPress
	'soft_18' => 1, // Joomla 2.5
	'soft_543' => 1, // Drupal 8
	'soft_11' => 1, // Open Blog
	'soft_3' => 1, // Serendipity
	'soft_34' => 1, // Dotclear
	'soft_14' => 1, // b2evolution
	'soft_470' => 1 // Ghost
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
```
### Expected response
```php

output here

```

### Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication    | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act    | editplans   |	This will trigger the edit plan function |
| plan   | plan1   | This will be the plan name of the plan you want to edit |
| **POST** |
| saveplan | 1  |	This will trigger the edit plan function |
| planname  | plan1   |	Plan name for the new plan being created |
| resellers_abc  | 1   |	(Optional) Use this only if you want to assign a reseller to the plan. resellers_ is the prefix for adding a reseller and abc is the name of the reseller (that should already exist). Similarly pass a separate key for each reseller you want to assign to the plan. |
| users_xyz | 1   |	(Optional) Use this only if you want to assign a user to the plan. users_ is the prefix for assigning a user and xyz is the name of the user (that should already exist). Similarly pass a separate key for each user you want to assign to the plan. |
| scripts_26  | 1   |	Use this to pass the scripts to be assigned to the plan. scripts_ is the prefix for assigning a script and 26 is the id of the script to be assigned. Similarly pass a separate key for each script you want to assign to the plan. Get Script ids |
| cpplan_CPPlanName  | 1   |	Use this to pass the control panel plan(s). cpplan_ is the prefix followed by the control panel plan name. For Example: cpplan_SoftRestriction. |
