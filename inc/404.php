<?php if(!defined("TRECE")):header("location:/");die();endif; ?>
<?php

//OK. Let's talk.

  $lCustom["pagetitle"]["es"] = "404";
  $lCustom["pagetitle"]["gal"] = "404";
  $lCustom["pagetitle"]["en"] = "404";

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
