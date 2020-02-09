<?php if(!defined("TRECE")):header("location:./");die();endif; ?>
<?php

//Wrong reference? Get out of here!

  require_once($conf["dir"]["includes"].$conf["dir"]["users"]."/".$conf["file"]["crud"].".php");

  $trece = new $conf["dir"]["users"]($db,$conf,null,$lCommon);
  $trece->password_change_hash = $conf["site"]["virtualpathArray"][1];

  $trece->changePass1();

  if ($trece->num == 0) :

    header("location:".REALPATHLANG.QUERYQ);
    die();

  endif;



//Still here? OK, let's talk.

//metastuff
  $lCustom["pagetitle"] = strip_tags($lCommon["change-password"][LANG]);
//$lCustom["metadescription"] = strip_tags("Custom metadescription goes here"); # 160 char text
//$lCustom["metakeywords"] = strip_tags("Custom keywords go here");
//$lCustom["og_image"] = "https://custom.url/image-goes-here"; # 1200x630 px image



  $msg = false;
  $msgType = "";



  if ($_POST) :

    $msg = true;

    $trece->email_or_username       = htmlspecialchars(strtolower(preg_replace("/\s/","",$_POST["email_or_username"])));
    $trece->password                = $_POST["password"];
    $trece->password_strength       = $_POST["password-strength"];
//  $trece->g_recaptcha_response    = $_POST["g-recaptcha-response"];


    if ($trece->changePass2()) :

      $redirect_url = REALPATHLANG.$conf["file"]["signin"];
      $msgType = $trece->wrongCaptchaResponse || $trece->unknownEmailOrUsername || $trece->wrongPasswordStrength ? "error" : "valid";
      $msgText = ($trece->wrongCaptchaResponse ? $lCommon["wrong_captcha_response"][LANG] :
                 ($trece->unknownEmailOrUsername ? $lCommon["not_corresponding_email_address_or_username"][LANG] :
                 ($trece->wrongPasswordStrength ? $lCommon["wrong_password_strength"][LANG] :
                 sprintf($lCommon["password_successfully_changed"][LANG],$redirect_url))));

    else :

      $msgType = "error";
      $msgText = $lCommon["general_error"][LANG];

    endif;

  endif;

  if($msg && $msgType == "valid") :

    $customJS = <<<EOD

<script>

  \$(function(){var time=5;setInterval(function(){time--;$("#countdown").text(time);if(time===0){location.replace("{$redirect_url}");}},1000);});

</script>

EOD;

  else : 

    $customJS = <<<EOD

<script src="https://cdnjs.cloudflare.com/ajax/libs/hideshowpassword/{$conf["version"]["hideshowpassword"]}/hideShowPassword.min.js"></script>

<script src="https://www.google.com/recaptcha/api.js"></script>

<script>

  \$(function(){
    \$("#email_or_username").val("");
    \$("#password").val("");
//  \$(".last-step").hide();
//  \$(".last-step").css("display","none");
    setTimeout(function(){\$("#{$msgType}-alert").fadeOut(500);},5000);
    \$(".eye").on("click",function(){
      \$(".eye i").toggleClass("fa-eye").toggleClass("fa-eye-slash");
      \$("#password").togglePassword();
    });
    \$(".redo").on("click",function(){newpass=randString(\$("#password"));\$("#password").val(newpass);\$.strength(\$("#password-progress-bar"),newpass);\$(".redo i").addClass("fa-pulse").delay(1000).queue(function(){\$(this).removeClass("fa-pulse").dequeue();});});
    });

  function randString(id){
    var dataSet=\$(id).attr("data-character-set").split(",");
    var possible="";
    if(\$.inArray("a-z",dataSet) >= 0){possible+="abcdefghijkmnopqrstuvwxyz";} // removed l  to make it less confusing
    if(\$.inArray("A-Z",dataSet) >= 0){possible+="ABCDEFGHJKLMNPQRSTUVWXYZ";}  // removed IO to make it less confusing
    if(\$.inArray("0-9",dataSet) >= 0){possible+="23456789";}                  // removed 01 to make it less confusing
    if(\$.inArray("#",dataSet)   >= 0){possible+="![]{}()%&*\$#^<>~@";}         // removed |  to make it less confusing
    var text = "";
    for(var i=0;i<\$(id).attr("data-size");i++){text+=possible.charAt(Math.floor(Math.random()*possible.length));}
    return text;
    }

  \$.strength=function(element,password){
    var desc=[{"width":"0"},{"width":"20%"},{"width":"40%"},{"width":"60%"},{"width":"80%"},{"width":"100%"}];
    var descClass=["","password-progress-bar-danger","password-progress-bar-danger","password-progress-bar-warning","password-progress-bar-success","password-progress-bar-success"];
    var score=0;
    \$("input[name=password-strength]").val(score);
    if(password.length>6){score++;\$("input[name=password-strength]").val(score);}
    if((password.match(/[a-z]/))&&(password.match(/[A-Z]/))){score++;\$("input[name=password-strength]").val(score);}
    if(password.match(/\d+/)){score++;\$("input[name=password-strength]").val(score);}
    if(password.match(/.[!,@,#,\$,%,^,&,*,?,_,~,-,(,)]/)){score++;\$("input[name=password-strength]").val(score);}
    if(password.length>8){score++;\$("input[name=password-strength]").val(score);}
    element.removeClass().addClass(descClass[score]).css(desc[score]);
//  if(score<4){\$(".last-step").fadeOut();}else{\$(".last-step").fadeIn();}
    };
  \$(function(){\$("#password").keyup(function(){\$.strength(\$("#password-progress-bar"),\$(this).val());});});
  \$('input[rel="gp"]').on("click",function(){\$(this).select();}); // Auto select field on focus

</script>

EOD;

  endif;


  if($msg && $msgType == "valid") :

    $customCSS = <<<EOD
EOD;

  else :

    $customCSS = <<<EOD

<style>

    #{$msgType}-alert{position:absolute;z-index:1000;margin:-6rem 0 0 0;width:100%;}
    #{$msgType}-alert .container{padding:1em;color:black;text-align:center;}
    .password{position:relative;}
    .password .eye{position:absolute;right:1.5rem !important;top:.2rem;display:flex;}
    .password .redo{position:absolute;right:4rem !important;top:.2rem;display:flex;}
    input:focus~.form-control-feedback{z-index:3;}
    #password-progress{height:1rem; width:100%; margin:.5rem 0 1rem 0;}
    #password-progress-bar{width:0%; height:100%; transition:width 500ms linear;}
    .password-progress-bar-nothing{background:#ddd;}
    .password-progress-bar-danger{background:#d00;}
    .password-progress-bar-warning{background:#f50;}
    .password-progress-bar-success{background:#080;}

    /* Mediaqueries */

    /* Larger than mobile screen */
    @media(min-width:40.0rem){
      .change-password-form{max-width:550px;}
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

  endif;



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



  <div class="container change-password-form">

    <div class="row">

      <div class="column">

        <?php if($msg && $msgType == "valid") : ?>

          <h1 style="text-align:center;">💌 <?=$msgText;?></h1>

        <?php else: ?>

          <h1><?=$lCustom["pagetitle"];?></h1>

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
                 value="" 
                 required>
        </p>

      </div>

    </div>

    <div class="row">

      <div class="column">

        <p>
          <label for="password">Password</label>
          <span class="password">
            <input type="password" 
                   name="password" 
                   id="password" 
                   placeholder="Type your Password" 
                   autocomplete="off"
                   value="" 
                   data-size="16" 
                   data-character-set="a-z,A-Z,0-9,#" 
                   style="margin:0;"
                   required>
            <span class="eye"><i class="fas fa-eye fa-fw"></i></span>
            <span class="getNewPass redo"><i class="fas fa-redo-alt fa-fw"></i></span>
          </span>
          <input type="hidden" name="password-strength" id="password-strength" value="0">
        </p>
        <div id="password-progress" class="password-progress-bar-nothing">
          <div id="password-progress-bar"></div>
        </div>
        <p style="line-height:1.4rem;margin-bottom:2rem;"><small><strong><?=$lCommon["tip"][LANG];?>:</strong> <?=sprintf($lCommon["password_tip"][LANG],"<span class=\"glyphicon glyphicon-repeat\" aria-hidden=\"true\"></span>","<span class=\"glyphicon glyphicon-eye-open\" aria-hidden=\"true\"></span>");?></small></p>
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
<?php /*
    <div class="last-step" style="display:none;">

      <div class="row">

        <div class="column">

          <div class="g-recaptcha" data-sitekey="<?=$conf["recaptcha"]["public"];?>"></div>

        </div>

      </div>

    </div>
*/ ?>

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
