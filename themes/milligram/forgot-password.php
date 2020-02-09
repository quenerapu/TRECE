<?php if(!defined("TRECE")):header("location:./");die();endif; ?>
<?php

//$email = isset($_GET["m"]) ? strpos($_GET["m"],"@")!==false ? $_GET["m"] : "NO TIENE EMAIL" : "";
  $email = isset($_GET["m"]) ? $_GET["m"] : "";

  $msg = false;
  $msgType = "";

  require_once($conf["dir"]["includes"].$conf["dir"]["users"]."/".$conf["file"]["crud"].".php");



//metastuff
  $lCustom["pagetitle"] = $lCommon["forgot_password"][LANG];
//$lCustom["metadescription"] = strip_tags("Custom metadescription goes here"); # 160 char text
//$lCustom["metakeywords"] = strip_tags("Custom keywords go here");
//$lCustom["og_image"] = "https://custom.url/image-goes-here"; # 1200x630 px image



  if($_POST) :

    $msg = true;

    $trece = new $conf["dir"]["users"]($db,$conf,null,$lCommon);
    $trece->email_or_username = htmlspecialchars(strtolower(preg_replace("/\s/","",$_POST["email_or_username"])));

    if($trece->changePassRequest()):

      $msgType = $trece->wrongCaptchaResponse || $trece->unknownEmailOrUsername ? "error" : "valid";
      $msgText = ($trece->wrongCaptchaResponse ? $lCommon["wrong_captcha_response"][LANG] :
                 ($trece->unknownEmailOrUsername ? $lCommon["unknown_email_or_username"][LANG] :
                 sprintf($lCommon["we_have_just_sent_an_email_to"][LANG],$trece->email_or_username)));

    else :

      $msgType = "error";
      $msgText = $lCommon["unknown_email_or_username"][LANG];

    endif;

  endif;



  $customJS = <<<EOD
<script>

  \$(function(){setTimeout(function(){\$("#{$msgType}-alert").fadeOut(500);},5000);});

</script>

EOD;

  $customCSS = <<<EOD
<style>

    #{$msgType}-alert{position:absolute;z-index:1000;margin:-6rem 0 0 0;width:100%;}
    #{$msgType}-alert .container{padding:1em;color:black;text-align:center;}

    /* Mediaqueries */

    /* Larger than mobile screen */
    @media(min-width:40.0rem){
      .forgot-password-form{max-width:550px;}
      }
    /* Larger than tablet screen */
    @media(min-width:80.0rem){
      }
    /* Larger than desktop screen */
    @media(min-width:120.0rem){
      }

    /* End of mediaqueries */

</style>

EOD;



  require_once($conf["dir"]["themes"].$conf["trece"]["theme"]."/".$conf["file"]["header"].".php");
  require_once($conf["dir"]["themes"].$conf["trece"]["theme"]."/".$conf["file"]["nav"].".php");

?>


<?php if($msg && $msgType=="error"): ?>
  <div id="<?=$msgType;?>-alert">
  <div class="container">
    <div class="row">
      <div class="column">
        <strong><?=$msgText;?></strong>
      </div>
    </div>
  </div>
  </div>
<?php endif; ?>


<div class="col-xs-12 col-sm-8 col-sm-offset-2">
<div class="page-header">
<?php if (isset($app) && $app->getUserHierarchy()==1) : ?>
<?php if (strpos($email,"@")===false) : ?>
<div class="pull-right"><p>
<?=btn($lCommon["admin_list"][LANG],"!users/".$conf["file"]["adminlist"],"","fa-list");?>
</p></div>
<?php endif; ?>
<?php endif; ?>
</div>
</div>



  <div class="container forgot-password-form">

    <div class="row">

      <div class="column">

        <?php if($msg && $msgType == "valid") : ?>

          <h1 style="text-align:center;">💌 <?=$msgText;?></h1>

        <?php else: ?>

          <h1>😳 <?=$lCustom["pagetitle"];?></h1>

        <?php endif; ?>

      </div>

    </div>

<?php if(!$msg || ($msg && $msgType != "valid")) : ?>

    <form action="" method="post" autocomplete="off" role="form">

    <div class="row">

      <div class="column">

        <p>
          <label for="email_or_username"><?=$lCommon["email_or_username"][LANG];?>:</label>
          <input type="text" 
                 name="email_or_username" 
                 id="email_or_username" 
                 placeholder="<?=$lCommon["email_or_username"][LANG];?>" 
                 autocomplete="off" 
                 value="<?=isset($email)?$email:(isset($_SESSION["username"])?$_SESSION["username"]:"");?>"
                 required>
        </p>

      </div>

    </div>

    <div class="row">

      <div class="column">

        <label for="mathcaptcha"><?=$lCommon["so_you_are_a_human_hmm"][LANG];?></label>
        <p style="display:flex;">
          <span class="dibu">
            <img src="<?=REALPATH.$conf["dir"]["images"]."mathcaptcha.php";?>" id="mathcaptcha" alt="Mathcaptcha image" style="float:left;">
          </span>
          <span class="human" style="flex:1;">
            <input type="text" 
                   name="mathcaptchaAnswer" 
                   id="mathcaptchaAnswer" 
                   style="max-width:100px;"
                   required>
          </span>
        </p>

      </div>

    </div>

    <div class="row">

      <div class="column submit">

        <p>
          <button type="submit" name="forgot-password"><?=$lCommon["change-password"][LANG];?></button>
        </p>

      </div>

    </div>

    </form>

<?php endif; ?>

  </div>



<?php require_once($conf["dir"]["themes"].$conf["trece"]["theme"]."/".$conf["file"]["footer"].".php"); ?>
