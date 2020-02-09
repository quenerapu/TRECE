<?php if(!defined("TRECE")):header("location:./");die();endif; ?>
<?php
//FORGOT PASSWORD

# ...............................................................................................................................................
# ..########..#######..########...######....#######..########....########.....###.....######...######..##......##..#######..########..########...
# ..##.......##.....##.##.....##.##....##..##.....##....##.......##.....##...##.##...##....##.##....##.##..##..##.##.....##.##.....##.##.....##..
# ..##.......##.....##.##.....##.##........##.....##....##.......##.....##..##...##..##.......##.......##..##..##.##.....##.##.....##.##.....##..
# ..######...##.....##.########..##...####.##.....##....##.......########..##.....##..######...######..##..##..##.##.....##.########..##.....##..
# ..##.......##.....##.##...##...##....##..##.....##....##.......##........#########.......##.......##.##..##..##.##.....##.##...##...##.....##..
# ..##.......##.....##.##....##..##....##..##.....##....##.......##........##.....##.##....##.##....##.##..##..##.##.....##.##....##..##.....##..
# ..##........#######..##.....##..######....#######.....##.......##........##.....##..######...######...###..###...#######..##.....##.########...
# ...............................................................................................................................................

// http://patorjk.com/software/taag/#p=display&f=Banner4&t=%20TRECE%20
// http://patorjk.com/software/taag/#p=display&f=Bright&t=Deprecated
// https://stackoverflow.com/questions/8154158/mysql-how-do-i-use-delimiters-in-triggers









  $users = "users";
//$email = isset($_GET["m"]) ? strpos($_GET["m"],"@")!==false ? $_GET["m"] : "NO TIENE EMAIL" : "";
  $email = isset($_GET["m"]) ? $_GET["m"] : "";

  $msg = false;

  require_once($conf["dir"]["core"].$conf["file"]["db"].".php");
  require_once($users."/".$conf["file"]["crud"].".php");



//metastuff
  $lCustom["pagetitle"] = $lCommon["forgot_password"][LANG];
//$lCustom["metadescription"] = strip_tags("Custom metadescription goes here"); # 160 char text
//$lCustom["metakeywords"] = strip_tags("Custom keywords go here");
//$lCustom["og_image"] = "https://custom.url/image-goes-here"; # 1200x630 px image



  if($_POST) :

    $msg = true;

    $trece = new $users($db,$conf,null,$lCommon);
    $trece->email_or_username = htmlspecialchars(strtolower(preg_replace("/\s/","",$_POST["email_or_username"])));

    if ($trece->changePassRequest()) :

      $msgType = "success";
      $msgText = sprintf($lCommon["we_have_just_sent_an_email_to"][LANG],$trece->email_or_username);

    else :

      $msgType = "danger";
      $msgText = $lCommon["unknown_email_or_username"][LANG];

    endif;

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

    <?php if ( $msg ): ?>

    <div class="row">
      <div class="col-xs-12 col-sm-10 col-sm-offset-1">
        <div class="alert alert-<?=$msgType;?> alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <?=$msgText;?>
        </div>
      </div>
    </div><!-- row -->

    <?php endif; ?>

  <?php if(isset($trece) && $trece->done) : ?>

    <div class="row">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2">
        <div class="page-header">
          <h1><strong>:-)</strong></h1>
        </div>
      </div>
    </div><!-- row -->

  <?php else : ?>

    <div class="row">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2">
        <div class="page-header">
          <?php if (isset($app) && $app->getUserHierarchy()==1) : ?>
          <?php if (strpos($email,"@")===false) : ?>
          <div class="pull-right"><p>
            <?=btn($lCommon["admin_list"][LANG],"!users/".$conf["file"]["adminlist"],"","fa-list");?>
          </p></div>
          <?php endif; ?>
          <?php endif; ?>
          <h1><strong><?=$lCustom["pagetitle"];?></strong></h1>
        </div>
      </div>

      <div class="col-xs-12 col-sm-8 col-sm-offset-2">

        <form action="" class="form-horizontal form-large" method="post" autocomplete="off" role="form">

          <div class="form-group<?=$msg && $msgType=="danger"?" has-error":"";?>">
            <label for="email_or_username" class="col-sm-6 control-label"><?=$lCommon["email_or_username"][LANG];?>:</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="email_or_username" id="email_or_username" placeholder="<?=$lCommon["email_or_username"][LANG];?>" autocomplete="off" value="<?=isset($email)?$email:(isset($_SESSION["username"])?$_SESSION["username"]:"");?>" style="margin-bottom:.5em" required>
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
              <button type="submit" name="forgot_password" class="btn btn-cons" style="margin-top:.75em;"><?=$lCommon["change-password"][LANG];?></button>
            </div>
          </div>

        </form>

      </div>

    </div><!-- row -->

    <?php endif; ?>

  </div>



  <?php if ( isset($trece) && !$trece->done ) : ?>

  <?php if ( $msg && $msgType != "danger" ) : ?>
  <script>$(".alert-dismissable").fadeTo(2000,500).slideUp(500,function(){$(".alert-dismissable").slideUp(500);});</script>
  <?php endif; ?>

  <?php endif; ?>



<?php require_once($conf["dir"]["includes"]."footer.php"); ?>
