## Edit ACL plan using Softaculous API Guide
This guide explains how to edit ACL plan using Softaculous API.

### via cURL
```php

curl -d "saveplan=1" -d "planname=1" -d "cpplan_CPPlanName" -d "resellers_abc=1" -d "users_xyz=1" -d "scripts_543=1" -d "scripts_72=1" "https://user:password@domain.com:2087/url/to/softaculous/index.php?act=editplans&plan=plan1&api=json"

```

### via PHP script

```php

// URL
$url = 'http://admin.controlpanel.com:PORT/url/to/softaculous/index.php?'.
			'&api=serialize'.
			'&act=editplans'.
			'&plan=plan1';


$post = array('saveplan' => '1',
	'planname' => 'plan1',
	'resellers_abc' => '1',
	'users_xyz' => '1',
	'cpplan_CPPlanName' => '1',
	'scripts_543' => '1', // Add Drupal
	'scripts_72' => '1' // Add PrestaShop
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

Array
(
    [title] => Softaculous - Admin Panel
    [done] => 1
    [unserplan] => Array
        (
            [name] => plan1
            [disable_autoupgrade] => 0
            [max_ins_script] => 
            [max_backup_script] => 
            [max_clone_script] => 
            [max_staging_script] => 
            [sets] => Array
                (
                )

            [scripts] => Array
                (
                    [26] => 26
                    [11] => 11
                )

        )

    [acl] => Array
        (
            [users] => Array
                (
                    [abc] => plan1
                )
        )

    [_users] => Array
        (
            [user1] => Array
                (
                    [original_key] => user1
                )
        )

    [_cpplan] => Array
        (
            [Package] => Array
                (
                    [original_key] => Package
                )
        )

    [allcatwise] => Array
        (
            [php] => Array
                (
                    [blogs] => Array
                        (
                            [26] => Array
                                (
                                    [name] => WordPress
                                    [softname] => wp
                                    [desc] => WordPress is a state-of-the-art publishing platform with a focus on aesthetics, web standards, and usability.
                                    [ins] => 1
                                    [cat] => blogs
                                    [type] => php
                                    [ver] => 6.9.4
                                )
							[11] => Array
								(
									[name] => Pubvana
									[softname] => openb
									[desc] => Kick-ass Blog application built using the CodeIgniter PHP Framework
									[ins] => 1
									[cat] => blogs
									[type] => php
									[ver] => 1.0.4
								)
						)
                )
        )

    [_resellers] => Array
        (
            [alex] => Array
                (
                    [original_key] => alex
                )
        )

    [timenow] => 1776067137
    [time_taken] => 0.002
)

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
