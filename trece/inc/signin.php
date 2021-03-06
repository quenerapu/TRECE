<?php if(!defined("TRECE")):header("location:./");die();endif; ?>
<?php
//SIGN IN

# .....................................................
# ...######..####..######...##....##....####.##....##..
# ..##....##..##..##....##..###...##.....##..###...##..
# ..##........##..##........####..##.....##..####..##..
# ...######...##..##...####.##.##.##.....##..##.##.##..
# ........##..##..##....##..##..####.....##..##..####..
# ..##....##..##..##....##..##...###.....##..##...###..
# ...######..####..######...##....##....####.##....##..
# .....................................................

// http://patorjk.com/software/taag/#p=display&f=Banner4&t=%20TRECE%20
// http://patorjk.com/software/taag/#p=display&f=Bright&t=Deprecated
// https://stackoverflow.com/questions/8154158/mysql-how-do-i-use-delimiters-in-triggers









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



# ......##....................................................
# ...########..........########...#######...######..########..
# ..##..##..##.........##.....##.##.....##.##....##....##.....
# ..##..##.............##.....##.##.....##.##..........##.....
# ...########..........########..##.....##..######.....##.....
# ......##..##.........##........##.....##.......##....##.....
# ..##..##..##.........##........##.....##.##....##....##.....
# ...########..#######.##.........#######...######.....##.....
# ......##....................................................

  if($_POST) :

    $msg = true;

    $msgType = $app->wrongCaptchaResponse || $app->wrongEmailUsernameOrPassword ? "danger" : "success";
    $msgText = ($app->wrongCaptchaResponse ? $lCommon["wrong_captcha_response"][LANG] :
               ($app->wrongEmailUsernameOrPassword ? $lCommon["signin_fail"][LANG] :
               ""));

  endif;



  $customJS = <<<EOD
  <script>
    /* whatever */
  </script>
EOD;

  $customCSS = <<<EOD
  <style>
    /* whatever */
  </style>
EOD;



  require_once($conf["dir"]["includes"]."header.php");
  require_once($conf["dir"]["includes"]."nav.php");

?>

  <div class="container main-container">

    <?php if($msg) : ?>

    <div class="alert alert-<?=$msgType;?> alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <?=$msgText;?>
    </div>

    <?php endif; ?>

    <form action="" class="form-horizontal form-large" method="post" autocomplete="off" role="form">

    <div class="row">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2">
        <div class="page-header">
          <h1><strong><?=$lCustom["pagetitle"];?></strong></h1>
        </div>
      </div>

      <div class="col-xs-12 col-sm-8 col-sm-offset-2">

          <div class="form-group">
            <label for="email_or_username" class="col-sm-6 control-label"><?=$lCommon["email_or_username"][LANG];?>:</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="email_or_username" id="email_or_username" placeholder="<?=$lCommon["email_or_username"][LANG];?>" autocomplete="off" value="" style="margin-bottom:.5em" required>
            </div>
          </div>

          <div class="form-group has-feedback">
            <label for="password" class="col-sm-6 control-label"><?=$lCommon["password"][LANG];?>:</label>
            <div class="col-sm-6">
              <input type="password" name="password" id="password" autocomplete="off" class="form-control" style="margin-bottom:.5em" placeholder="" required>
              <span class="showhide glyphicon glyphicon-eye-close form-control-feedback" aria-hidden="true"></span>
            </div>
          </div>

          <div class="form-group">
            <label for="mathcaptcha" class="col-sm-6 control-label"><?=$lCommon["so_you_are_a_human_hmm"][LANG];?></label>
            <div class="col-sm-6">
              <img src="<?=REALPATH.$conf["dir"]["images"]."mathcaptcha.php";?>" id="mathcaptcha" alt="Mathcaptcha image" style="float:left;">
              <input type="text" name="mathcaptchaAnswer" id="mathcaptchaAnswer" class="form-control" style="max-width:20%;" required>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-6 col-sm-6">
              <button type="submit" name="signin" class="btn btn-cons" style="margin-top:.75em;"><?=$lCommon["signin"][LANG];?></button>
              <p style="margin-top:20px;"><span class="help-block"><a href="<?=REALPATHLANG.$conf["file"]["forgot-pass"].QUERYQ;?>"><?=$lCommon["forgot_password"][LANG];?></a></span></p>
            </div>
          </div>

      </div>

    </div><!-- row -->

    </form>

  </div>



  <script src="https://cdnjs.cloudflare.com/ajax/libs/hideshowpassword/<?=$conf["version"]["hideshowpassword"];?>/hideShowPassword.min.js"></script>
  <script>
    $("#password + .showhide").on("click",function(){
      $(this).toggleClass("glyphicon-eye-open").toggleClass("glyphicon-eye-close");
      $("#password").togglePassword();
    });
  </script>

  <?php if($msg): ?>
  <script>$(".alert-dismissable").fadeTo(2000,500).slideUp(500,function(){$(".alert-dismissable").slideUp(500);});</script>
  <?php endif; ?>



<?php require_once($conf["dir"]["includes"]."footer.php"); ?>
