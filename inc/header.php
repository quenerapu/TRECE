<?php if(!defined("TRECE")):header("location:/");die();endif; ?>
<!doctype html><?=BEGRATEFUL;?>
<?php

  if(!isset($lCustom["pagetitle"][$conf["site"]["lang"]])) :
            $lCustom["pagetitle"][$conf["site"]["lang"]] =            $conf["meta"]["title"][$conf["site"]["lang"]]; endif;
  if(!isset($lCustom["metadescription"][$conf["site"]["lang"]])) :
            $lCustom["metadescription"][$conf["site"]["lang"]] =      $conf["meta"]["description"][$conf["site"]["lang"]]; endif;
  if(!isset($lCustom["charset"])) :
            $lCustom["charset"] =                                     $conf["site"]["charset"]; endif;
  if(!isset($lCustom["x_ua_compatible"])) :
            $lCustom["x_ua_compatible"] =                             $conf["site"]["x_ua_compatible"]; endif;
  if(!isset($lCustom["viewport"])) :
            $lCustom["viewport"] =                                    $conf["site"]["viewport"]; endif;
  if(!isset($lCustom["generator"])) :
            $lCustom["generator"] =                                   $conf["site"]["generator"]; endif;
  if(!isset($lCustom["robots"])) :
            $lCustom["robots"] =                                      $conf["site"]["robots"]; endif;
  if(!isset($lCustom["og_type"])) :
            $lCustom["og_type"] =                                     $conf["file"]["homepage"] == $conf["site"]["action"]?"website":"article"; endif;
  if(!isset($lCustom["og_title"][$conf["site"]["lang"]])) :
            $lCustom["og_title"][$conf["site"]["lang"]] =             $lCustom["pagetitle"][$conf["site"]["lang"]]; endif;
  if(!isset($lCustom["og_description"][$conf["site"]["lang"]])) :
            $lCustom["og_description"][$conf["site"]["lang"]] =       $lCustom["metadescription"][$conf["site"]["lang"]]; endif;
  if(!isset($lCustom["og_image"])) :
            $lCustom["og_image"] =                                    file_exists($conf["dir"]["images"]."og/".$conf["site"]["action"].".jpg")?$conf["site"]["action"].".jpg":"trece.jpg"; endif;
  if(!isset($lCustom["og_image_alt"][$conf["site"]["lang"]])) :
            $lCustom["og_image_alt"][$conf["site"]["lang"]] =         $lCustom["metadescription"][$conf["site"]["lang"]]; endif;
  if(!isset($lCustom["og_site_name"][$conf["site"]["lang"]])) :
            $lCustom["og_site_name"][$conf["site"]["lang"]] =         $conf["meta"]["name"][$conf["site"]["lang"]]; endif;
  if(!isset($lCustom["twitter_title"][$conf["site"]["lang"]])) :
            $lCustom["twitter_title"][$conf["site"]["lang"]] =        $lCustom["pagetitle"][$conf["site"]["lang"]]; endif;
  if(!isset($lCustom["twitter_image_alt"][$conf["site"]["lang"]])) :
            $lCustom["twitter_image_alt"][$conf["site"]["lang"]] =    $conf["meta"]["name"][$conf["site"]["lang"]]." | ".$lCustom["pagetitle"][$conf["site"]["lang"]]; endif;
  if(!isset($lCustom["twitter_site"])) :
            $lCustom["twitter_site"] =                                $conf["contact"]["twitter"]; endif;
  if(!isset($lCustom["geo"]["region"])) :
            $lCustom["geo"]["region"] =                               $conf["contact"]["geo"]["region"]; endif;
  if(!isset($lCustom["geo"]["latitude"])) :
            $lCustom["geo"]["latitude"] =                             $conf["contact"]["geo"]["latitude"]; endif;
  if(!isset($lCustom["geo"]["longitude"])) :
            $lCustom["geo"]["longitude"] =                            $conf["contact"]["geo"]["longitude"]; endif;
  if(!isset($lCustom["geo"]["placename"])) :
            $lCustom["geo"]["placename"] =                            $conf["contact"]["geo"]["placename"]; endif;

?>

  <!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="<?=$conf["site"]["langs"][$conf["site"]["lang"]]["culture-name1"];?>"> <![endif]-->
  <!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="<?=$conf["site"]["langs"][$conf["site"]["lang"]]["culture-name1"];?>"> <![endif]-->
  <!--[if IE 8]>         <html class="no-js lt-ie9" lang="<?=$conf["site"]["langs"][$conf["site"]["lang"]]["culture-name1"];?>"> <![endif]-->
  <!--[if gt IE 8]><!--> <html class="no-js" dir="<?=$conf["site"]["langs"][$conf["site"]["lang"]]["direction"];?>" lang="<?=$conf["site"]["langs"][$conf["site"]["lang"]]["culture-name1"];?>" itemscope itemtype="http://schema.org/LocalBusiness"> <!--<![endif]-->

  <head prefix="og: http://ogp.me/ns#">
  <title><?=$conf["meta"]["name"][$conf["site"]["lang"]]." | ".$lCustom["pagetitle"][$conf["site"]["lang"]];?></title>
  <link rel="canonical" href="<?=$conf["site"]["realpath"].$conf["site"]["virtualpath"];?>" />
  <base href="<?=$conf["site"]["realpath"];?>" target="_self" />
  <meta charset="<?=$lCustom["charset"];?>" />
  <meta http-equiv="X-UA-Compatible" content="<?=$lCustom["x_ua_compatible"];?>" />
  <meta name="viewport" content="<?=$lCustom["viewport"];?>" />
  <meta name="lang" content="<?=$conf["site"]["langs"][$conf["site"]["lang"]]["culture-name1"];?>" />
  <meta name="generator" content="<?=$lCustom["generator"];?>" />
  <meta name="robots" content="<?=$lCustom["robots"];?>" />
  <meta name="description" content="<?=$lCustom["og_description"][$conf["site"]["lang"]];?>" />

<?php if((NPE) || (DEBUG)) : ?>
<!-- DEBUG MODE -->
  <meta http-equiv="Expires" content="0">
  <meta http-equiv="Last-Modified" content="0">
  <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
  <meta http-equiv="Pragma" content="no-cache">
<?php endif; ?>

<!-- OG -->
  <meta property="fb:app_id" content="<?=$conf["contact"]["fb_app_id"];?>" />
  <meta property="og:type" content="<?=$lCustom["og_type"];?>" />
  <meta property="og:url" content="<?=$conf["site"]["realpath"].$conf["site"]["virtualpath"];?>" />
  <meta property="og:title" content="<?=$lCustom["og_title"][$conf["site"]["lang"]];?>" />
  <meta property="og:image" content="<?=$conf["site"]["realpath"].$conf["dir"]["images"]."og/".$lCustom["og_image"];?>" /><!-- 1200x630 px -->
  <meta property="og:description" content="<?=$lCustom["og_description"][$conf["site"]["lang"]];?>" />
  <meta property="og:image:alt" content="<?=$lCustom["og_image_alt"][$conf["site"]["lang"]];?>" />
  <meta property="og:site_name" content="<?=$lCustom["og_site_name"][$conf["site"]["lang"]];?>" />

<!-- Twitter -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?=$lCustom["twitter_title"][$conf["site"]["lang"]];?>">
  <meta name="twitter:image:alt" content="<?=$lCustom["twitter_image_alt"][$conf["site"]["lang"]];?>">
  <meta name="twitter:site" content="<?=$lCustom["twitter_site"];?>">

<!-- Geo Stuff -->
  <meta name="geo.region" content="<?=$lCustom["geo"]["region"];?>">
  <meta name="geo.position" content="<?=$lCustom["geo"]["latitude"].";".$lCustom["geo"]["longitude"];?>">
  <meta name="ICBM" content="<?=$lCustom["geo"]["latitude"].", ".$lCustom["geo"]["longitude"];?>">
  <meta name="geo.placename" content="<?=$lCustom["geo"]["placename"];?>">

<!-- Bootstrap & jQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/<?=$conf["version"]["jquery"];?>/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/<?=$conf["version"]["jqueryui"];?>/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/<?=$conf["version"]["moment"];?>/moment-with-locales.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/<?=$conf["version"]["bootstrap"];?>/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/<?=$conf["version"]["bootstrap"];?>/css/bootstrap.min.css">

<!-- Favicon https://favicon-generator.org -->
  <link rel="apple-touch-icon" sizes="57x57" href="<?=$conf["site"]["realpath"].$conf["dir"]["images"];?>favicon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="<?=$conf["site"]["realpath"].$conf["dir"]["images"];?>favicon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="<?=$conf["site"]["realpath"].$conf["dir"]["images"];?>favicon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="<?=$conf["site"]["realpath"].$conf["dir"]["images"];?>favicon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?=$conf["site"]["realpath"].$conf["dir"]["images"];?>favicon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="<?=$conf["site"]["realpath"].$conf["dir"]["images"];?>favicon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="<?=$conf["site"]["realpath"].$conf["dir"]["images"];?>favicon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="<?=$conf["site"]["realpath"].$conf["dir"]["images"];?>favicon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="<?=$conf["site"]["realpath"].$conf["dir"]["images"];?>favicon/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192" href="<?=$conf["site"]["realpath"].$conf["dir"]["images"];?>favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?=$conf["site"]["realpath"].$conf["dir"]["images"];?>favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="<?=$conf["site"]["realpath"].$conf["dir"]["images"];?>favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?=$conf["site"]["realpath"].$conf["dir"]["images"];?>favicon/favicon-16x16.png">
  <link rel="manifest" href="<?=$conf["site"]["realpath"].$conf["dir"]["images"];?>favicon/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="<?=$conf["site"]["realpath"].$conf["dir"]["images"];?>favicon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">

<?php /*
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/<?=$conf["version"]["bootstrap"];?>/<?=$conf["version"]["bootswatch"];?>/bootstrap.min.css">
*/ ?>

<!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/<?=$conf["version"]["fontawesome"];?>/css/font-awesome.min.css">

<!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Cabin+Condensed:400,600" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Fredoka+One:400">



<?php /* TODO: the following libraries must be loaded ONLY when needed, NOT by default */ ?>


<!-- Modernizr -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/<?=$conf["version"]["modernizr"];?>/modernizr.min.js"></script>

<!-- Responsive Bootstrap Toolkit -->
  <script src="https://cdn.jsdelivr.net/npm/responsive-toolkit@2.6.3/src/bootstrap-toolkit.min.js"></script>

<!-- Animate.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/<?=$conf["version"]["animatecss"];?>/animate.min.css">

<!-- Normalize.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/<?=$conf["version"]["normalize_css"];?>/normalize.min.css">

<!-- jQuery Form Validator -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/<?=$conf["version"]["jquery_form_validator"];?>/theme-default.min.css">

<!-- Bootstrap-select -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/<?=$conf["version"]["bootstrap_select"];?>/css/bootstrap-select.min.css">

<!-- Bootstrap Switch.com -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/<?=$conf["version"]["bootstrap_switch"];?>/css/bootstrap3/bootstrap-switch.min.css">

<!-- jQuery Confirm -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/<?=$conf["version"]["jquery_confirm"];?>/jquery-confirm.min.css" />

<!-- Selectize.js -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/<?=$conf["version"]["selectize"];?>/css/selectize.bootstrap3.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/Syone/selectize-bootswatch@1.0/css/selectize.<?=$conf["version"]["bootswatch"];?>.css" />

<!-- Croppie -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/<?=$conf["version"]["croppie"];?>/croppie.min.css">

<!-- Bootstrap Datetimepicker -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/<?=$conf["version"]["bootstrap_datetimepicker"];?>/js/bootstrap-datetimepicker.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/<?=$conf["version"]["bootstrap_datetimepicker"];?>/css/bootstrap-datetimepicker.min.css">

<!-- Bootstrap Colorpicker -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/<?=$conf["version"]["bootstrap_colorpicker"];?>/js/bootstrap-colorpicker.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/<?=$conf["version"]["bootstrap_colorpicker"];?>/css/bootstrap-colorpicker.min.css">

<!-- HTML5 Shiv & Respond.js -->

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/<?=$conf["version"]["html5shiv"];?>/html5shiv.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/<?=$conf["version"]["respond_js"];?>/respond.min.js"></script>
  <![endif]-->

<!-- reCAPTCHA -->

  <script src="https://www.google.com/recaptcha/api.js"></script>

<!-- sprintf.js -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/sprintf/<?=$conf["version"]["sprintf"];?>/sprintf.min.js"></script>

<?php
# .. END SPRINTF.JS
# .....................................................................
?>

<!-- Custom CSS -->

  <link rel="stylesheet" type="text/css" media="screen" href="<?=$conf["dir"]["styles"];?>styles.php?sf=<?=$conf["css"]["stickyfooter_h"];?>">

</head>

<body>

<?php if(NPE) : ?>
<style>
  /* common */
  .npe{text-align:center;transform:rotate(-45deg);background-color:red;color:white;z-index:9999999;font-weight:bold;letter-spacing:.1em;}
  /* vertical smartphones */
  @media screen and (min-width:360px) and (max-width:752px){.npe{position:fixed;width:200px;top:15px;left:-70px;padding:6px;}}
  /* horizontal smartphones and vertical tablets */
  @media screen and (min-width:753px) and (max-width:1023px){.npe{position:fixed;width:200px;top:15px;left:-70px;padding:6px;}}
  /* horizontal tablets and normal desktops */
  @media screen and (min-width:1024px) and (max-width:1199px){.npe{position:fixed;width:200px;top:25px;left:-50px;padding:12px;}}
  /* big desktops */
  @media screen and (min-width:1200px){.npe{position:fixed;width:200px;top:25px;left:-50px;padding:12px;}}
</style>
<div class="npe">NPE</div>
<?php endif; ?>
