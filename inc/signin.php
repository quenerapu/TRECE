<?php if(!defined("TRECE")):header("location:/");die();endif; ?>
<?php

//Logged? Get out of here!

  if ( $app->getUserSignInStatus() ) :

    header("location:".$conf["site"]["realpathLang"].$conf["file"]["admin"].$conf["site"]["queryq"]);
    die();

  endif;



//OK. Let's talk.

  $lCustom["pagetitle"][$conf["site"]["lang"]] = $lCommon["signin"][$conf["site"]["lang"]];

  $msg = false;



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
    $msgType = "danger";
    $msgText = $lCommon["signin_fail"][$conf["site"]["lang"]];

  endif;

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

    <div class="row">
      <div class="col-xs-12 col-sm-10 col-sm-offset-1">
        <div class="page-header">
          <h1><strong><?=$lCustom["pagetitle"][$conf["site"]["lang"]];?></strong></h1>
        </div>
      </div>
    </div><!-- row -->

    <form action="" class="form-horizontal form-large" method="post" autocomplete="off" role="form">

    <div class="row">

      <div class="col-xs-12 col-sm-10 col-sm-offset-1">


          <div class="form-group">
            <label for="email_or_username" class="col-sm-6 control-label"><?=$lCommon["email_or_username"][$conf["site"]["lang"]];?>:</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="email_or_username" id="email_or_username" placeholder="<?=$lCommon["email_or_username"][$conf["site"]["lang"]];?>" autocomplete="off" value="" style="margin-bottom:.5em" required>
            </div>
          </div>

          <div class="form-group has-feedback">
            <label for="password" class="col-sm-6 control-label"><?=$lCommon["password"][$conf["site"]["lang"]];?>:</label>
            <div class="col-sm-6">
              <input type="password" name="password" id="password" autocomplete="off" class="form-control" placeholder="" required>
              <span class="showhide glyphicon glyphicon-eye-close form-control-feedback" aria-hidden="true"></span>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-6 col-sm-6">
              <button type="submit" name="signin" class="btn btn-cons" style="margin-top:.75em;"><?=$lCommon["signin"][$conf["site"]["lang"]];?></button>
              <p style="margin-top:20px;"><span class="help-block"><a href="<?=$conf["site"]["realpathLang"].$conf["file"]["forgot-pass"].$conf["site"]["queryq"];?>"><?=$lCommon["forgot-password"][$conf["site"]["lang"]];?></a></span></p>
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
