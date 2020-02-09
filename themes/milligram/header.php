<?php if(!defined("TRECE")):header("location:./");die();endif; ?>
<!doctype html>

  <!-- TRECE <?=$conf["trece"]["version"];?> -->
<?php

  if(!isset($lCustom["pagetitle"])) :
            $lCustom["pagetitle"] =                   strip_tags($conf["meta"]["title"][LANG]); endif;
  if(!isset($lCustom["metadescription"])) :
            $lCustom["metadescription"] =             strip_tags($conf["meta"]["description"][LANG]); endif;
  if(!isset($lCustom["metakeywords"])) :
            $lCustom["metakeywords"] =                $conf["meta"]["keywords"]; endif;
  if(!isset($lCustom["charset"])) :
            $lCustom["charset"] =                     $conf["site"]["charset"]; endif;
  if(!isset($lCustom["x_ua_compatible"])) :
            $lCustom["x_ua_compatible"] =             $conf["site"]["x_ua_compatible"]; endif;
  if(!isset($lCustom["viewport"])) :
            $lCustom["viewport"] =                    $conf["site"]["viewport"]; endif;
  if(!isset($lCustom["generator"])) :
            $lCustom["generator"] =                   $conf["site"]["generator"]; endif;
  if(!isset($lCustom["robots"])) :
            $lCustom["robots"] =                      $conf["site"]["robots"]; endif;
  if(!isset($lCustom["og_type"])) :
            $lCustom["og_type"] =                     $conf["site"]["homepage"] == $conf["site"]["action"]?"website":"article"; endif;
  if(!isset($lCustom["og_title"][LANG])) :
            $lCustom["og_title"][LANG] =              $lCustom["pagetitle"]; endif;
  if(!isset($lCustom["og_description"][LANG])) :
            $lCustom["og_description"][LANG] =        $lCustom["metadescription"]; endif;
  if(!isset($lCustom["og_image"])) :
            $lCustom["og_image"] =                    isset($conf["meta"]["image"]["file"])? $conf["meta"]["image"]["file"] : REALPATH.$conf["dir"]["images"]."og/".(file_exists($conf["dir"]["images"]."og/".$conf["site"]["action"].".jpg")?$conf["site"]["action"].".jpg":"trece.jpg"); endif;
  if(!isset($lCustom["og_image_alt"][LANG])) :
            $lCustom["og_image_alt"][LANG] =          $lCustom["metadescription"]; endif;
  if(!isset($lCustom["og_site_name"][LANG])) :
            $lCustom["og_site_name"][LANG] =          $conf["meta"]["name"][LANG]; endif;
  if(!isset($lCustom["twitter_title"][LANG])) :
            $lCustom["twitter_title"][LANG] =         $lCustom["pagetitle"]; endif;
  if(!isset($lCustom["twitter_image_alt"][LANG])) :
            $lCustom["twitter_image_alt"][LANG] =     $lCustom["metadescription"]; endif;
  if(!isset($lCustom["twitter_site"])) :
            $lCustom["twitter_site"] =                $conf["contact"]["twitter"]; endif;
  if(!isset($lCustom["geo"]["region"])) :
            $lCustom["geo"]["region"] =               $conf["contact"]["geo"]["region"]; endif;
  if(!isset($lCustom["geo"]["latitude"])) :
            $lCustom["geo"]["latitude"] =             $conf["contact"]["geo"]["latitude"]; endif;
  if(!isset($lCustom["geo"]["longitude"])) :
            $lCustom["geo"]["longitude"] =            $conf["contact"]["geo"]["longitude"]; endif;
  if(!isset($lCustom["geo"]["placename"])) :
            $lCustom["geo"]["placename"] =            $conf["contact"]["geo"]["placename"]; endif;

?>

  <!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="<?=$conf["site"]["langs"][LANG]["culture-name1"];?>"> <![endif]-->
  <!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="<?=$conf["site"]["langs"][LANG]["culture-name1"];?>"> <![endif]-->
  <!--[if IE 8]>         <html class="no-js lt-ie9" lang="<?=$conf["site"]["langs"][LANG]["culture-name1"];?>"> <![endif]-->
  <!--[if gt IE 8]><!--> <html class="no-js" dir="<?=$conf["site"]["langs"][LANG]["direction"];?>" lang="<?=$conf["site"]["langs"][LANG]["culture-name1"];?>" itemscope itemtype="https://schema.org/LocalBusiness"> <!--<![endif]-->
<?php /*
  <head prefix="og: http://ogp.me/ns#">
*/ ?>
  <head>
  <!-- :) ISO_639-1 | https://metatags.io | https://htmlhead.dev -->
  <meta http-equiv="X-UA-Compatible" content="<?=$lCustom["x_ua_compatible"];?>">
  <meta name="viewport" content="<?=$lCustom["viewport"];?>">
  <meta charset="<?=$lCustom["charset"];?>">
  <title><?=$conf["meta"]["name"][LANG]." | ".$lCustom["pagetitle"];?></title>
  <meta name="description" content="<?=htmlspecialchars($lCustom["metadescription"]);?>"><!-- https://blog.spotibo.com/meta-description-length/ -->
  <base href="<?=REALPATH;?>" target="_self">
  <link rel="canonical" href="<?=REALPATH.$conf["site"]["virtualpath"];?>">
  <meta name="lang" content="<?=$conf["site"]["langs"][LANG]["culture-name1"];?>">
  <meta name="generator" content="<?=$lCustom["generator"];?>"><!-- https://stackoverflow.com/a/3632220 -->
  <meta name="robots" content="<?=$lCustom["robots"];?>"><!-- https://developers.google.com/search/reference/robots_meta_tag -->
  <meta name="keywords" content="<?=htmlspecialchars($lCustom["metakeywords"]);?>"><!-- https://www.sistrix.es/blog/la-meta-keywords-un-bulo-con-19-anos-de-antiguedad/ -->

<?php if((NPE) || (DEBUG)) : ?>
<!-- DEBUG MODE -->
<?php /* DEPRECATED 
  <meta http-equiv="Expires" content="0">
*/ ?>
  <meta http-equiv="Last-Modified" content="0">
  <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
  <meta http-equiv="Pragma" content="no-cache">
<?php endif; ?>

<!-- OG -->
  <meta property="fb:app_id" content="<?=$conf["contact"]["fb_app_id"];?>">
  <meta property="og:type" content="<?=$lCustom["og_type"];?>">
  <meta property="og:url" content="<?=REALPATH.$conf["site"]["virtualpath"];?>">
  <meta property="og:title" content="<?=htmlspecialchars($lCustom["og_title"][LANG]);?>">
  <meta property="og:image" content="<?=$lCustom["og_image"];?>"><!-- 1200×628 px -->
  <meta property="og:description" content="<?=htmlspecialchars($lCustom["og_description"][LANG]);?>">
  <meta property="og:image:alt" content="<?=htmlspecialchars($lCustom["og_image_alt"][LANG]);?>">
  <meta property="og:site_name" content="<?=htmlspecialchars($lCustom["og_site_name"][LANG]);?>">

<!-- Twitter -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?=htmlspecialchars($lCustom["twitter_title"][LANG]);?>">
  <meta name="twitter:image:alt" content="<?=htmlspecialchars($lCustom["twitter_image_alt"][LANG]);?>">
  <meta name="twitter:site" content="<?=$lCustom["twitter_site"];?>">

<!-- Geo Stuff -->
  <meta name="geo.region" content="<?=$lCustom["geo"]["region"];?>">
  <meta name="geo.position" content="<?=$lCustom["geo"]["latitude"].";".$lCustom["geo"]["longitude"];?>">
  <meta name="ICBM" content="<?=$lCustom["geo"]["latitude"].", ".$lCustom["geo"]["longitude"];?>">
  <meta name="geo.placename" content="<?=htmlspecialchars($lCustom["geo"]["placename"]);?>">

<!-- Favicon https://favicon-generator.org -->
  <link rel="apple-touch-icon" sizes="57x57" href="<?=REALPATH.$conf["dir"]["images"]."favicon/apple-icon-57x57.png".((NPE) || (DEBUG) ? "?".time() : "" );?>">
  <link rel="apple-touch-icon" sizes="60x60" href="<?=REALPATH.$conf["dir"]["images"]."favicon/apple-icon-60x60.png".((NPE) || (DEBUG) ? "?".time() : "" );?>">
  <link rel="apple-touch-icon" sizes="72x72" href="<?=REALPATH.$conf["dir"]["images"]."favicon/apple-icon-72x72.png".((NPE) || (DEBUG) ? "?".time() : "" );?>">
  <link rel="apple-touch-icon" sizes="76x76" href="<?=REALPATH.$conf["dir"]["images"]."favicon/apple-icon-76x76.png".((NPE) || (DEBUG) ? "?".time() : "" );?>">
  <link rel="apple-touch-icon" sizes="114x114" href="<?=REALPATH.$conf["dir"]["images"]."favicon/apple-icon-114x114.png".((NPE) || (DEBUG) ? "?".time() : "" );?>">
  <link rel="apple-touch-icon" sizes="120x120" href="<?=REALPATH.$conf["dir"]["images"]."favicon/apple-icon-120x120.png".((NPE) || (DEBUG) ? "?".time() : "" );?>">
  <link rel="apple-touch-icon" sizes="144x144" href="<?=REALPATH.$conf["dir"]["images"]."favicon/apple-icon-144x144.png".((NPE) || (DEBUG) ? "?".time() : "" );?>">
  <link rel="apple-touch-icon" sizes="152x152" href="<?=REALPATH.$conf["dir"]["images"]."favicon/apple-icon-152x152.png".((NPE) || (DEBUG) ? "?".time() : "" );?>">
  <link rel="apple-touch-icon" sizes="180x180" href="<?=REALPATH.$conf["dir"]["images"]."favicon/apple-icon-180x180.png".((NPE) || (DEBUG) ? "?".time() : "" );?>">
  <link rel="icon" type="image/png" sizes="192x192" href="<?=REALPATH.$conf["dir"]["images"]."favicon/android-icon-192x192.png".((NPE) || (DEBUG) ? "?".time() : "" );?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?=REALPATH.$conf["dir"]["images"]."favicon/favicon-32x32.png".((NPE) || (DEBUG) ? "?".time() : "" );?>">
  <link rel="icon" type="image/png" sizes="96x96" href="<?=REALPATH.$conf["dir"]["images"]."favicon/favicon-96x96.png".((NPE) || (DEBUG) ? "?".time() : "" );?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?=REALPATH.$conf["dir"]["images"]."favicon/favicon-16x16.png".((NPE) || (DEBUG) ? "?".time() : "" );?>">
  <link rel="manifest" href="<?=REALPATH.$conf["dir"]["images"]."favicon/manifest.json?";?>">
  <meta name="msapplication-TileColor" content="#<?=$conf["trece"]["theme-color"];?>">
  <meta name="msapplication-TileImage" content="<?=REALPATH.$conf["dir"]["images"]."favicon/ms-icon-144x144.png".((NPE) || (DEBUG) ? "?".time() : "" );?>">
  <meta name="theme-color" content="#<?=$conf["trece"]["theme-color"];?>">

<!-- jQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/<?=$conf["version"]["jquery"];?>/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/<?=$conf["version"]["jqueryui"];?>/jquery-ui.min.js"></script>

<!-- Moment -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/<?=$conf["version"]["moment"];?>/moment-with-locales.min.js"></script>

<!-- Custom JS -->
  <script src="<?=REALPATH.$conf["dir"]["themes"].$conf["trece"]["theme"];?>/<?=$conf["dir"]["scripts"];?>uilang.js"></script>
  <script src="<?=REALPATH.$conf["dir"]["themes"].$conf["trece"]["theme"];?>/<?=$conf["dir"]["scripts"].$conf["file"]["scripts"];?>.php<?=((NPE) || (DEBUG) ? "?".time() : "" );?>"></script>
  <?=isset($customJS)?$customJS:"";?>

<!-- Normalize.css -->
  <link rel="stylesheet" type="text/css" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/<?=$conf["version"]["normalize_css"];?>/normalize.min.css">

<!-- Font Awesome -->
  <link rel="stylesheet" type="text/css" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/<?=$conf["version"]["fontawesome"];?>/css/all.min.css">

<!-- Custom CSS -->
  <link rel="stylesheet" type="text/css" media="screen" href="<?=REALPATH.$conf["dir"]["themes"].$conf["trece"]["theme"];?>/<?=$conf["dir"]["styles"].$conf["file"]["styles"];?>.php?c=<?=$conf["trece"]["theme-color"];?><?=((NPE) || (DEBUG) ? "&".time() : "" );?>">
  <?=isset($customCSS)?$customCSS:"";?>

<?php if(NPE) : ?>
  <style>
    /* common */
    .npe{text-align:center;transform:rotate(-45deg);background-color:red;color:white;z-index:1047;font-weight:bold;letter-spacing:.1em;}
    /* vertical smartphones */
    @media screen and (min-width:360px) and (max-width:752px){.npe{position:fixed;width:200px;top:15px;left:-70px;padding:6px;}}
    /* horizontal smartphones and vertical tablets */
    @media screen and (min-width:753px) and (max-width:1023px){.npe{position:fixed;width:200px;top:15px;left:-70px;padding:6px;}}
    /* horizontal tablets and normal desktops */
    @media screen and (min-width:1024px) and (max-width:1199px){.npe{position:fixed;width:200px;top:25px;left:-50px;padding:12px;}}
    /* big desktops */
    @media screen and (min-width:1200px){.npe{position:fixed;width:200px;top:25px;left:-50px;padding:12px;}}
  </style>
<?php endif; ?>
<!-- Cookie Consent -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/cookieconsent2/<?=$conf["version"]["cookieconsent2"];?>/cookieconsent.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/cookieconsent2/<?=$conf["version"]["cookieconsent2"];?>/cookieconsent.min.js"></script>
  <script>
    window.addEventListener("load",function(){window.cookieconsent.initialise({"palette":{"popup":{"background":"#237afc"},"button":{"background":"#fff"}},"position":"bottom-right","content":{"message":"<?=$lCommon["gdpr"]["txt"][LANG];?>","dismiss":"<?=$lCommon["gdpr"]["accept"][LANG];?>","link":"<?=$lCommon["gdpr"]["more_info"][LANG];?>","href":"<?=REALPATHLANG.$conf["file"]["cookie-policy"];?>"}})});
  </script>

</head>

<body>

