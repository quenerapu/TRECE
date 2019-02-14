<?php if(!defined("TRECE")):header("location:/");die();endif; ?>
<?php

  $lCustom["pagetitle"]["es"] = "TRECE";
  $lCustom["pagetitle"]["gal"] = "TRECE";
  $lCustom["pagetitle"]["en"] = "TRECE";

$customCSS = <<<EOD
  <style>
    /* whatever */
  </style>
EOD;

  require_once($conf["dir"]["includes"]."header.php");
  require_once($conf["dir"]["includes"]."nav.php");

?>



<?php if(!$app->getUserSignInStatus()) : ?>

  <div class="container main-container">

    <div class="row">
      <div class="col-xs-12">
        <h4 class="text-right text-success" style="margin-right:.5em;margin-top:0;">Start here <i class="fa fa-arrow-up" aria-hidden="true"></i></h4>
      </div>
    </div><!-- row -->

  </div>

<?php endif; ?>



<?php require_once($conf["dir"]["includes"]."footer.php"); ?>
