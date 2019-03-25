<?php if(!defined("TRECE")):header("location:/");die();endif; ?>
<?php
//EXAMPLE

# ......................................................................
# ..########.##.....##....###....##.....##.########..##.......########..
# ..##........##...##....##.##...###...###.##.....##.##.......##........
# ..##.........##.##....##...##..####.####.##.....##.##.......##........
# ..######......###....##.....##.##.###.##.########..##.......######....
# ..##.........##.##...#########.##.....##.##........##.......##........
# ..##........##...##..##.....##.##.....##.##........##.......##........
# ..########.##.....##.##.....##.##.....##.##........########.########..
# ......................................................................

// http://patorjk.com/software/taag/#p=display&f=Banner4&t=%20TRECE%20
// http://patorjk.com/software/taag/#p=display&f=Bright&t=Deprecated
// https://stackoverflow.com/questions/8154158/mysql-how-do-i-use-delimiters-in-triggers













//Not logged? Not admin? Get out of here!

  if (
      1+1==3 # Public for everyone
//    !$app->getUserSignInStatus() # Must be logged in
//    || $app->getUserHierarchy() != 1 # Must be admin
     ) :

    header("location:".REALPATHLANG.$action."/".$conf["file"]["adminlist"].QUERYQ);
    die();

  endif;



//Wrong reference? Get out of here!

  if(!isset($rowcount_page)) :

    require_once($conf["file"]["crud"].".php");

    $trece = new $action($db,$conf,$cconf,$lCommon,$lCustom);
    $trece->ref = $what;
    $trece->intimacy = 2;
    $stmt = $trece->readOne();
    $rowcount_page = $trece->rowcount;

  endif;

  if($rowcount_page == 0) :

    header("location:".REALPATHLANG.$action."/".$conf["file"]["publiclist"].QUERYQ);
    die();

  endif;



//Wrong query parameters for a list of subitems? Reload without those parameters!

  $readtype = array_search($what,$conf["site"]["virtualpathArray"]);

  if( isset($conf["site"]["virtualpathArray"][$readtype+1]) &&
      $conf["site"]["virtualpathArray"][$readtype+1] == $conf["file"]["adminlist"] &&
      ( !isset($conf["site"]["virtualpathArray"][$readtype+2]) ||
        !is_numeric($conf["site"]["virtualpathArray"][$readtype+2]) ||
        floor($conf["site"]["virtualpathArray"][$readtype+2]) != $conf["site"]["virtualpathArray"][$readtype+2]
      )
    ) :

//  $conf["site"]["queryArray"]["bk"] = $conf["site"]["virtualpathArray"][$readtype+1];
    $conf["site"]["queryq"] = $conf["site"]["queryq"] != "" ? "?".http_build_query($conf["site"]["queryArray"]) : "";
    header("location:".REALPATHLANG.$action."/".$what."/".$conf["file"]["adminlist"]."/1".$conf["site"]["queryq"]);
    die();

  endif;



//Still here? OK, let's talk.

  $included = false;

  if( isset($conf["site"]["virtualpathArray"][$readtype+1]) && $conf["site"]["virtualpathArray"][$readtype+1] == $conf["file"]["adminlist"] ) :

    $included = true;

  endif;

  $lCustom["pagetitle"][LANG] = ${"trece"}->{"title_".LANG};



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



<?php if($rowcount_page>0) : ?>
  <div class="container main-container"<?=$included ? " style=\"padding-bottom:3em;\"" : "";?>>

    <div class="row">
      <div class="col-xs-12 col-sm-10 col-sm-offset-1">

        <div class="page-header">
          <h1><strong><?=${"trece"}->{"title_".LANG};?></strong></h1>
        </div>

        <p>&nbsp;</p>
      </div>
    </div><!-- row -->



    <div class="row">

      <div class="col-xs-4 col-sm-4 col-sm-offset-1 col-md-3 col-md-offset-2">

        <div style="width:200px;">

          <img src="<?=(file_exists($conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg")?$conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg?".time():(file_exists($conf["dir"]["includes"].$action."/".$conf["css"]["icon_prefix"].$cconf["img"]["prefix"]."0.jpg")?REALPATH.$conf["dir"]["includes"].$action."/".$conf["css"]["icon_prefix"].$cconf["img"]["prefix"]."0.jpg?".time():"https://fakeimg.pl/".$cconf["img"]["icon_w"]."x".$cconf["img"]["icon_h"]."/?text=Example"));?>" class="img-thumbnail img-responsive" alt="<?=${"trece"}->{"title_".LANG};?>">

        </div>

      </div>

      <div class="col-xs-8 col-sm-6 col-md-5">

        <h3><?=${"trece"}->{"title_".LANG};?></h3>

        <hr>

        <?=mb_strlen(${"trece"}->{"description_".LANG})>0 ?"<p>".${"trece"}->{"description_".LANG}."</p>":"";?>

      </div>

    </div><!-- row -->

  </div><!-- container main-container -->
<?php endif; ?>



  <div class="clearfix"></div>



<?php

  if(!$included) :

    require_once($conf["dir"]["includes"]."footer.php");
    die();

  endif;



  $back       = $action."/".$what;
  $argument1  = $conf["table"][$action];
  $argument2  = "id_section";
  $argument3  = $cconf["file"]["ref"];
  $argument4  = $what;

  $action     = "questions";
  $crudlpx    = $conf["site"]["virtualpathArray"][$readtype+1];
  $what       = $conf["site"]["virtualpathArray"][$readtype+2];

  require_once($conf["dir"]["includes"].$action."/".$conf["file"]["adminlist"].".php");

?>
