<?php if(!defined("TRECE")):header("location:/");die();endif; ?>
<?php

  $users = "users";
//$email = isset($_GET["m"]) ? strpos($_GET["m"],"@")!==false ? $_GET["m"] : "NO TIENE EMAIL" : "";
  $email = isset($_GET["m"]) ? $_GET["m"] : "";

  $msg = false;

  require_once($conf["dir"]["core"].$conf["file"]["db"].".php");
  require_once($users."/".$conf["file"]["crud"].".php");



  $lCustom["pagetitle"][$conf["site"]["lang"]] = $lCommon["forgot-password"][$conf["site"]["lang"]];



  if ( $_POST ) :

    $msg = true;

    $trece = new $users($db,$conf,null,$lCommon);
    $trece->email_or_username = htmlspecialchars(strtolower(preg_replace("/\s/","",$_POST["email_or_username"])));

    if ( $trece->changePassRequest() ) :

      $msgType = "success";
      $msgText = sprintf($lCommon["we_have_just_sent_an_email_to"][$conf["site"]["lang"]],$trece->email_or_username);

    else :

      $msgType = "danger";
      $msgText = $lCommon["unknown_email_or_username"][$conf["site"]["lang"]];

    endif;

  endif;

  require_once($conf["dir"]["includes"]."header.php");
  require_once($conf["dir"]["includes"]."nav.php");

?>


  <div class="container main-container">

    <?php if ( $msg ): ?>

    <div class="alert alert-<?=$msgType;?> alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <?=$msgText;?>
    </div>

    <?php endif; ?>

  <?php if ( isset($trece) && $trece->done ) : ?>

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
          <?php if (isset($app) && $app->getUserHierarchy()==1) : ?>
          <?php if (strpos($email,"@")===false) : ?>
          <div class="pull-right"><p>
            <?=btn($lCommon["admin_list"][$conf["site"]["lang"]],"!users/".$conf["file"]["adminlist"],"","fa-list");?>
          </p></div>
          <?php endif; ?>
          <?php endif; ?>
          <h1><strong><?=$lCustom["pagetitle"][$conf["site"]["lang"]];?></strong></h1>
        </div>
      </div>
    </div><!-- row -->

    <div class="row">

      <div class="col-xs-12 col-sm-10 col-sm-offset-1">

        <form action="" class="form-horizontal form-large" method="post" autocomplete="off" role="form">

          <div class="form-group<?=$msg && $msgType=="danger"?" has-error":"";?>">
            <label for="email_or_username" class="col-sm-6 control-label"><?=$lCommon["email_or_username"][$conf["site"]["lang"]];?>:</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="email_or_username" id="email_or_username" placeholder="<?=$lCommon["email_or_username"][$conf["site"]["lang"]];?>" autocomplete="off" value="<?=isset($email)?$email:(isset($_SESSION["username"])?$_SESSION["username"]:"");?>" style="margin-bottom:.5em" required>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-6 col-sm-6">
              <button type="submit" name="forgot-password" class="btn btn-cons" style="margin-top:.75em;"><?=$lCommon["change-password"][$conf["site"]["lang"]];?></button>
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



<?php require($conf["dir"]["includes"]."footer.php"); ?>
