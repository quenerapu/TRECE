<?php if(!defined("TRECE")):header("location:/");die();endif; ?>
<?php

  if ( !$app->getUserSignInStatus() ) :

    header("location:".REALPATHLANG.$conf["file"]["signin"].QUERYQ);
    die();

  endif;

$basedir = $conf["site"]["dir"]."/".$conf["dir"]["includes"];
$subdirs = array();
$dirtocheck = scandir($basedir);
foreach($dirtocheck as $item) :
  if($item!=".." && $item!="." && is_dir($basedir."/".$item) && file_exists($basedir."/".$item."/tables.sql")) :
    array_push($subdirs,$item);
  endif;
endforeach;

if(count($subdirs)>0) :

  require_once($conf["dir"]["includes"]."header.php");
  require_once($conf["dir"]["includes"]."nav.php");

?>
<div class="container main-container">

    <div class="row">
      <div class="col-xs-12 col-sm-10 col-sm-offset-1">
<?php foreach($subdirs as $dir) : ?>
        <iframe src="<?=REALPATHLANG.$dir;?>" style="width:250px;height:100px;overflow:hidden;"></iframe>
<?php endforeach; ?>
      </div>
    </div>

<?php

  require_once($conf["dir"]["includes"]."footer.php");

else :

  header("location:".REALPATHLANG.QUERYQ);
  die();

endif;

?>
