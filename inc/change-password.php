<?php if(!defined("TRECE")):header("location:/");die();endif; ?>
<?php

//Wrong reference? Get out of here!

  $users = "users";

  require_once($users."/".$conf["file"]["crud"].".php");

  $trece = new $users($db,$conf,null,$lCommon);
  $trece->password_change_hash = $conf["site"]["virtualpathArray"][1];

  $trece->changePass1();

  if ( $trece->num == 0 ) :

    header("location:".REALPATHLANG.QUERYQ); die();

  endif;



//Still here? OK, let's talk.

  $lCustom["pagetitle"][LANG] = $lCommon["change-password"][LANG];
  $msg = false;



  if ( $_POST ) :

    $msg = true;

    $trece->email_or_username       = htmlspecialchars(strtolower(preg_replace("/\s/","",$_POST["email_or_username"])));
    $trece->password                = $_POST["password"];
    $trece->password_strength       = $_POST["password-strength"];
    $trece->g_recaptcha_response    = $_POST["g-recaptcha-response"];


    if ( $trece->changePass2() ) :

      $msgType = $trece->wrongCaptchaResponse || $trece->wrongeMailorUsername || $trece->wrongPasswordStrength ? "danger" : "success";
      $msgText = ($trece->wrongCaptchaResponse ? $lCommon["wrong_captcha_response"][LANG] :
                 ($trece->wrongeMailorUsername ? $lCommon["not_corresponding_email_address_or_username"][LANG] :
                 ($trece->wrongPasswordStrength ? $lCommon["wrong_password_strength"][LANG] :
                 $lCommon["password_successfully_changed"][LANG])));

    else :

      $msgType = "danger";
      $msgText = $lCommon["general_error"][LANG];

    endif;

  endif;

  require_once($conf['dir']['includes']."header.php");
  require_once($conf['dir']['includes']."nav.php");

?>


  <style>
    input:focus~.form-control-feedback{z-index:3;}
    #password-progress{height:1.2em; width:100%; margin-top:0.4em;}
    #password-progress-bar{width:0%; height:100%; transition:width 500ms linear;}
    .password-progress-bar-nothing{background:#ddd;}
    .password-progress-bar-danger{background:#d00;}
    .password-progress-bar-warning{background:#f50;}
    .password-progress-bar-success{background:#080;}
 </style>



  <div class="container main-container">

    <?php if ( $msg ): ?>

    <div class="alert alert-<?=$msgType;?> alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <?=$msgText;?>
    </div>

    <?php endif; ?>

  <?php if ( $trece->done ) : ?>

    <div class="row">
      <div class="col-xs-12 col-sm-10 col-sm-offset-1">
        <div class="page-header">
          <h1><strong>:-)</strong></h1>
        </div>
      </div>
    </div><!-- row -->

  <?php else : ?>

    <div class="row">
      <div class="col-xs-12 col-sm-10 col-sm-offset-1">
        <div class="page-header">
          <h1><strong><?=$lCustom["pagetitle"][LANG]?></strong></h1>
        </div>
      </div>
    </div><!-- row -->

    <div class="row">

      <div class="col-xs-12 col-sm-10 col-sm-offset-1">

        <form action="" class="form-horizontal form-large" method="post" autocomplete="off" role="form">

          <div class="first-step">

            <div class="form-group">
              <label for="email_or_username" class="col-sm-6 control-label"><?=$lCommon['email_or_username'][LANG];?>:</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="email_or_username" id="email_or_username" placeholder="<?=$lCommon['email_or_username'][LANG];?>" autocomplete="off" value="<?=isset($trece) && isset($trece->email_or_username) ? $trece->email_or_username : "";?>" style="margin-bottom:.5em" required>
              </div>
            </div>

            <div class="form-group has-feedback">
              <label for="password" class="col-sm-6 control-label"><?=$lCommon["password"][LANG];?>:</label>
              <div class="col-sm-6">
                <div class="input-group">
                  <span class="input-group-addon"><i class="getNewPass glyphicon glyphicon-repeat" style="cursor:pointer;"></i></span>
                  <input type="password" name="password" id="password" autocomplete="off" class="form-control" placeholder="" data-size="16" data-character-set="a-z,A-Z,0-9,#" required>
                  <span class="showhide glyphicon glyphicon-eye-close form-control-feedback" aria-hidden="true"></span>
                </div>
                <div id="password-progress" class="password-progress-bar-nothing">
                  <div id="password-progress-bar"></div>
                </div>
                <p class="help-block" style="line-height:1em;"><small>
                  <strong><?=$lCommon["tip"][LANG];?>:</strong> <?=sprintf($lCommon["password_tip"][LANG],"<span class=\"glyphicon glyphicon-repeat\" aria-hidden=\"true\"></span>","<span class=\"glyphicon glyphicon-eye-open\" aria-hidden=\"true\"></span>");?></small></p>
              </div>
            </div>


          </div>

          <div class="last-step">

            <div class="form-group">
              <label for="g-recaptcha" class="col-sm-6 control-label"></label>
              <div class="col-sm-6">
                <div class="g-recaptcha" data-sitekey="<?=$conf["recaptcha"]["public"];?>"></div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-6 col-sm-6">
                <input type="hidden" name="password-strength" id="password-strength" value="0">
                <button type="submit" name="forgot_password" class="btn btn-cons" style="margin-top:.75em;"><?=$lCommon["change-password"][LANG];?></button>
              </div>
            </div>

          </div>

        </form>

      </div>

    </div><!-- row -->

    <?php endif; ?>

  </div>



  <?php if ( !$trece->done ) : ?>

  <script>

    $(document).ready(function(){$(".last-step").hide();});

    function randString(id){
      var dataSet = $(id).attr("data-character-set").split(",");
      var possible = "";
      if($.inArray("a-z",dataSet) >= 0){possible+="abcdefghijkmnopqrstuvwxyz";} // removed l to make it less confusing
      if($.inArray("A-Z",dataSet) >= 0){possible+="ABCDEFGHJKLMNPQRSTUVWXYZ";}  // removed IO to make it less confusing
      if($.inArray("0-9",dataSet) >= 0){possible+="23456789";}                  // removed 01 to make it less confusing
      if($.inArray("#",dataSet) >= 0){possible+="![]{}()%&*$#^<>~@|";}
      var text = "";
      for(var i=0; i < $(id).attr("data-size"); i++){text+=possible.charAt(Math.floor(Math.random()*possible.length));}
      return text;
    }

    $.strength=function(element,password) {
      var desc=[{"width":"0"},{"width":"20%"},{"width":"40%"},{"width":"60%"},{"width":"80%"},{"width":"100%"}];
      var descClass=["","password-progress-bar-danger","password-progress-bar-danger","password-progress-bar-warning","password-progress-bar-success","password-progress-bar-success"];
      var score = 0;
      $("input[name=password-strength]").val(score);
      if(password.length>6){score++;$("input[name=password-strength]").val(score);}
      if((password.match(/[a-z]/)) && (password.match(/[A-Z]/))){score++;$("input[name=password-strength]").val(score);}
      if(password.match(/\d+/)){score++;$("input[name=password-strength]").val(score);}
      if(password.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)){score++;$("input[name=password-strength]").val(score);}
      if(password.length>8){score++;$("input[name=password-strength]").val(score);}
      element.removeClass().addClass(descClass[score]).css(desc[score]);
      if(score<4){$(".last-step").fadeOut();}else{$(".last-step").fadeIn();}
      };
    $(function(){$("#password").keyup(function(){$.strength($("#password-progress-bar"),$(this).val());});});
    $(".getNewPass").click(function(){newpass = randString($("#password"));$("#password").val(newpass);$.strength($("#password-progress-bar"),newpass);}); // Create a new password
    $('input[rel="gp"]').on("click",function(){$(this).select();}); // Auto select field on focus

  </script>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/hideshowpassword/<?=$conf["version"]["hideshowpassword"];?>/hideShowPassword.min.js"></script>
  <script>
    $("#password + .showhide").on("click", function() {
      $(this).toggleClass("glyphicon-eye-close").toggleClass("glyphicon-eye-open");
      $("#password").togglePassword();
    });
  </script>



  <?php if ( $msg && $msgType != "danger" ) : ?>
  <script>$(".alert-dismissable").fadeTo(2000,500).slideUp(500,function(){$(".alert-dismissable").slideUp(500);});</script>
  <?php endif; ?>

  <?php endif; ?>



<?php require_once($conf["dir"]["includes"]."footer.php"); ?>
