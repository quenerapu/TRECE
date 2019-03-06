<?php if(!defined("TRECE")):header("location:/");die();endif; ?>
<?php /* IMPORTANT: at line 7, replace 0.0.0.0 with your public IPv4. You can get it here, for instance: https://whatismyip.com. */ ?>
<?php define("YOUR_IP","0.0.0.0"); ?>
<?php if($_SERVER["REMOTE_ADDR"]==YOUR_IP): ?>
<small>
<?php // echo "<pre>"; ?>
<?php // echo "SESSION ID: ".session_id()."\n----\n\n"; # uncomment this line to print ?>
<?php // echo "session_get_cookie_params(): "; print_r(session_get_cookie_params()); echo "\n----\n\n"; # uncomment this line to print ?>
<?php // echo "What's in \$_SESSION array: "; print_r($_SESSION); echo "\n----\n\n"; # uncomment this line to print ?>
<?php // echo "What's in USER VARIABLES array: "; print_r(compact(array_keys(get_defined_vars()))); echo "\n----\n\n"; # uncomment this line to print ?>
<?php // echo "What's in USER CONSTANTS array: "; print_r(get_defined_constants(true)["user"]); echo "\n----\n\n"; # uncomment this line to print ?>
<?php // echo "What's in \$_POST array: "; print_r($_POST); echo "\n----\n\n"; # uncomment this line to print ?>
<?php // echo "What's in \$_GET array: "; print_r($_GET); echo "\n----\n\n"; # uncomment this line to print ?>
<?php // echo "What's in \$_SERVER array: "; print_r($_SERVER); echo "\n----\n\n"; # uncomment this line to print ?>
<?php // echo "What's in \$conf array: "; print_r($conf); echo "\n----\n\n"; # uncomment this line to print ?>
<?php // echo "SIGNED IN: ".$app->getUserSignInStatus()."\n"; # uncomment this line to print?>
<?php // echo "NAME: ".$app->getUserName()."\n"; # uncomment this line to print?>
<?php // echo "GENDER: ".$app->getUserGender()."\n"; # uncomment this line to print?>
<?php // echo "USERNAME: ".$app->getUserUsername()."\n"; # uncomment this line to print?>
<?php // echo "ID: ".$app->getUserID()."\n"; # uncomment this line to print?>
<?php // echo "REF: ".$app->getUserRef()."\n"; # uncomment this line to print?>
<?php // echo "HIERARCHY: ".$app->getUserHierarchy()."\n"; # uncomment this line to print?>
<?php // echo "PRIVILEGES: ".$app->getUserPrivileges()."\n"; # uncomment this line to print?>
<?php // echo "</pre>"; ?>
</small>
<?php endif; ?>
