<?php if(!defined("TRECE")):header("location:/");die();endif; ?>
<?php

//Not logged? Get out of here!

  if ( !$app->getUserSignInStatus() ) :

    header("location:".$conf["site"]["realpathLang"].$conf["cms"]["login"].$conf["site"]["queryq"]);
    die();

  endif;



//OK. Let's talk.

  $lCustom["pagetitle"]["es"] = "Área de administración";
  $lCustom["pagetitle"]["gal"] = "Área de administración";
  $lCustom["pagetitle"]["en"] = "Admin area";

  $msg = false;

  if ( $_POST ) :

    $msg = true;
    $msgType = "danger";
    $msgText = $lCommon["login_fail"][$conf["site"]["lang"]];

  endif;

  require_once($conf["dir"]["includes"]."header.php");
  require_once($conf["dir"]["includes"]."nav.php");

?>



  <div class="container main-container">

    <div class="row">
      <div class="col-xs-12 col-sm-10 col-sm-offset-1">
        <div class="page-header">
          <h1><strong><?=$lCustom["pagetitle"][$conf["site"]["lang"]];?></strong></h1>
        </div>
      </div>
    </div><!-- row -->

  </div>



<?php require_once($conf["dir"]["includes"]."footer.php"); ?>
