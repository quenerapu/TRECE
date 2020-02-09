<?php if(!defined("TRECE")):header("location:./");die();endif; ?>
<?php



//Wrong reference? Get out of here!

  if(!isset($rowcount_page)) :

    require_once($conf["dir"]["includes"].$conf["dir"]["users"]."/".$conf["file"]["crud"].".php");

    $trece = new $conf["dir"]["users"]($db,$conf,$cconf,$lCommon,$lCustom);
    $trece->ref = $what;
    $trece->intimacy = 2;
    $stmt = $trece->readOne();
    $rowcount_page = $trece->rowcount;

  endif;

  if($rowcount_page == 0) :

    header("location:".REALPATHLANG.$conf["site"]["virtualpathArray"][0]."/".$conf["file"]["publiclist"].QUERYQ);
    die();

  endif;



//Still here? OK, let's talk.

//metastuff
  $lCustom["pagetitle"] = $trece->name.(mb_strlen($trece->surname)>0?" ".$trece->surname:"");
//$lCustom["metadescription"] = strip_tags("Custom metadescription goes here"); # 160 char text
//$lCustom["metakeywords"] = strip_tags("Custom keywords go here");
//$lCustom["og_image"] = "https://custom.url/image-goes-here"; # 1200x630 px image



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



  require_once($conf["dir"]["themes"].$conf["trece"]["theme"]."/".$conf["file"]["header"].".php");
  require_once($conf["dir"]["themes"].$conf["trece"]["theme"]."/".$conf["file"]["nav"].".php");

?>



<div class="container">

  <div class="row">

    <div class="column">

      <h1><?=$lCustom["pagetitle"];?></h1>

    </div>

  </div>

  <div class="row">

    <div class="column">

      <div class="ribbon-box">

        <div class="ribbon ribbon-top-left"><span style="background:#<?=$trece->hierarchy_color;?>"></span></div>

        <img src="<?=(file_exists($conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg")?$conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg?".time():(file_exists($conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"].$trece->ugender.".jpg")?$conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"].$trece->ugender.".jpg?".time():(file_exists($conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"]."0.jpg")?$conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"]."0.jpg?".time():"https://fakeimg.pl/".$cconf["img"]["icon_w"]."x".$cconf["img"]["icon_h"]."/?text=".$lCustom["singular"][LANG])));?>" class="img-thumbnail img-responsive" alt="<?=htmlspecialchars($trece->name[$i]." ".$trece->surname[$i]);?>">

        <h4><?=mb_strtoupper($trece->name." ".$trece->surname,"UTF-8");?></h4>

      </div>

    </div>
<?php if(isset($trece->bio)): ?>
    <div class="column" style="background:pink;">

      <?=$trece->bio;?>

    </div>
<?php endif; ?>

  </div>



<?php require_once($conf["dir"]["themes"].$conf["trece"]["theme"]."/".$conf["file"]["footer"].".php"); ?>