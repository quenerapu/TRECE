<?php if(!defined("TRECE")):header("location:./");die();endif; ?>
<?php

//Logged? Get out of here!

  if ($app->getUserSignInStatus()) :

    header("location:".REALPATHLANG.$conf["file"]["admin"].QUERYQ);
    die();

  endif;



//OK. Let's talk.

//metastuff
  $lCustom["pagetitle"] = $lCommon["signin"][LANG];
//$lCustom["metadescription"] = strip_tags("Custom metadescription goes here"); # 160 char text
//$lCustom["metakeywords"] = strip_tags("Custom keywords go here");
//$lCustom["og_image"] = "https://custom.url/image-goes-here"; # 1200x630 px image

  $msg = false;
  $msgType = "";
  $msgText = "";



  if($_POST) :

    $msg = true;

    $msgType = $app->wrongCaptchaResponse || $app->wrongEmailUsernameOrPassword ? "error" : "valid";
    $msgText = ($app->wrongCaptchaResponse ? $lCommon["wrong_captcha_response"][LANG] :
               ($app->wrongEmailUsernameOrPassword ? $lCommon["signin_fail"][LANG] :
               ""));

  endif;



  $customJS = <<<EOD
<script src="https://cdnjs.cloudflare.com/ajax/libs/hideshowpassword/{$conf["version"]["hideshowpassword"]}/hideShowPassword.min.js"></script>

<script>

  \$(function(){
    \$("#password + .eye").on("click",function(){
      \$(".eye i").toggleClass("fa-eye").toggleClass("fa-eye-slash");
      \$("#password").togglePassword();
    });
  });

  \$(function(){setTimeout(function(){\$("#{$msgType}-alert").fadeOut(500);},5000);});

</script>

EOD;

  $customCSS = <<<EOD
<style>

    #{$msgType}-alert{position:absolute;z-index:1000;margin:-6rem 0 0 0;width:100%;}
    #{$msgType}-alert .container{padding:1em;color:black;text-align:center;}
    .password{position:relative;}
    .password .eye{position:absolute;right:1.5rem !important;top:.2rem;display:flex;}

    /* Mediaqueries */

    /* Larger than mobile screen */
    @media(min-width:40.0rem){
      .signin-form{max-width:550px;}
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

  <div class="container signin-form">

    <div class="row">

      <div class="column">

        <h1><?=$lCustom["pagetitle"];?></h1>

      </div>

    </div>

    <form action="" method="post" autocomplete="off" role="form">

    <div class="row">

      <div class="column">

        <label for="email_or_username"><?=$lCommon["email_or_username"][LANG];?>:</label>
        <p>
          <input type="text" 
                 name="email_or_username" 
                 id="email_or_username" 
                 placeholder="<?=$lCommon["email_or_username"][LANG];?>" 
                 autocomplete="off" 
                 value="" 
                 required>
        </p>

      </div>

    </div>

    <div class="row">

      <div class="column">

        <label for="password"><?=$lCommon["password"][LANG];?></label>
        <p>
          <span class="password">
            <input type="password" 
                   name="password" 
                   id="password" 
                   placeholder="Type your Password" 
                   autocomplete="new-password" 
                   value="" 
                   required>
             <span class="eye"><i class="fas fa-eye fa-fw"></i></span>
           </span>
        </p>

      </div>

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
                   required>
          </span>
        </p>

      </div>

    </div>

    <div class="row">

      <div class="column submit">

        <p>
          <button type="submit" name="signin" style="margin-right:2rem;"><?=$lCommon["signin"][LANG];?></button>
          <a href="<?=REALPATHLANG.$conf["file"]["forgot-pass"].QUERYQ;?>"><?=$lCommon["forgot_password"][LANG];?></a>
        </p>

      </div>

    </div>

    </form>

  </div>



<?php require_once($conf["dir"]["themes"].$conf["trece"]["theme"]."/".$conf["file"]["footer"].".php"); ?>
