<?php if(!defined("TRECE")):header("location:./");die();endif; ?>
<?php

  if(!$app->getUserSignInStatus()) :

    header("location:".REALPATHLANG.$conf["file"]["signin"].QUERYQ);
    die();

  endif;



  $basedir = $conf["site"]["dir"]."/".$conf["dir"]["includes"];
  $subdirs = array();
  $dirtocheck = scandir($basedir);
  foreach($dirtocheck as $item) :
    if(
         $item!=".." 
      && $item!="." 
      && is_dir($basedir."/".$item) 
      && $item[0]!="_" 
      && file_exists($basedir."/".$item."/tables.sql")
      ) :
      array_push($subdirs,$item);
      $last = end($subdirs);
    endif;
  endforeach;



  if(count($subdirs)>0) :

  $customJS = <<<EOD
  <script>
    $("#{$last}").on("load",setTimeout(function(){window.location.href=window.location.href;},3000));
  </script>

EOD;

  else :
  $customJS = <<<EOD
  <script>
    /* whatever */
  </script>

EOD;
  endif;

  $customCSS = <<<EOD
  <style>
    /* whatever */
  </style>
EOD;



//metastuff
  $lCustom["pagetitle"] = strip_tags($lCommon["admin"][LANG]);
//$lCustom["metadescription"][LANG] = strip_tags("Custom metadescription goes here"); # 160 char text
//$lCustom["metakeywords"] = strip_tags("Custom keywords go here");
//$lCustom["og_image"] = "https://custom.url/image-goes-here"; # 1200x630 px image

  require_once($conf["dir"]["includes"]."header.php");
  require_once($conf["dir"]["includes"]."nav.php");

?>

  <div class="container main-container">

    <div class="row">
      <div class="col-xs-12 col-sm-10 col-sm-offset-1">
        <h1><?=count($subdirs)>0 ? "Instalando nuevos módulos" : "Panel de administración!! :)";?></h1>
      </div>
    </div>
<?php if(count($subdirs)>0) : ?>
    <div class="row">
      <div class="col-xs-12 col-sm-10 col-sm-offset-1">
        <?php foreach($subdirs as $dir) : ?>
        <iframe id="<?=$dir;?>" src="<?=REALPATHLANG.$dir;?>" style="width:254px;height:104px;overflow:hidden;"></iframe>
        <?php endforeach; ?>
      </div>
    </div>
<?php endif; ?>

  </div>



<?php require_once($conf["dir"]["includes"]."footer.php"); ?>
