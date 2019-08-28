<?php if(!defined("TRECE")):header("location:/");die();endif; ?>
<?php
//PAGES

# ...................................................
# ..########.....###.....######...########..######...
# ..##.....##...##.##...##....##..##.......##....##..
# ..##.....##..##...##..##........##.......##........
# ..########..##.....##.##...####.######....######...
# ..##........#########.##....##..##.............##..
# ..##........##.....##.##....##..##.......##....##..
# ..##........##.....##..######...########..######...
# ...................................................

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



//  $thread = $conf["site"]["virtualpathArray"];
//  $threadCount = count($thread);


//Wrong reference? Get out of here!

  if(!isset($rowcount_page)) :

    header("location:".REALPATHLANG.$action."/".$conf["file"]["adminlist"].QUERYQ);
    die();

/*
    require_once($conf["file"]["crud"].".php");

    $trece = new $action($db,$conf,$cconf,$lCommon,$lCustom);

    $trece->intimacy = 2;
    $trece->getBreadcrumbTrail();
    $stmt = $trece->readOne();
    $rowcount_page = $trece->rowcount;

*/
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



//metastuff
  $lCustom["pagetitle"][LANG] = ${"trece"}->{"title"};
  $lCustom["metadescription"][LANG] = ${"trece"}->{"intro"}; # 160 char text
  $lCustom["metakeywords"] = "key word keyword";
  $lCustom["og_image"] = file_exists($conf["dir"]["images"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg")?REALPATH.$conf["dir"]["images"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg":(file_exists($conf["dir"]["includes"].$action."/".$cconf["img"]["prefix"]."0.jpg")?REALPATH.$conf["dir"]["includes"].$action."/".$cconf["img"]["prefix"]."0.jpg":"https://fakeimg.pl/".$cconf["img"]["img_w"]."x".$cconf["img"]["img_h"]."/?text=Page");

  require_once($conf["dir"]["includes"]."header.php");
  require_once($conf["dir"]["includes"]."nav.php");

?>



<?php if($rowcount_page>0) : ?>

  <div class="container container-top"<?=$included ? " style=\"padding-bottom:3em;\"" : "";?>>
    <div class="row">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2">

        <h1>
          <?=${"trece"}->{"title"};?>
        </h1>

      </div>
    </div><!-- row -->
    <div class="row">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2">

        <img src="<?=(file_exists($conf["dir"]["images"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg")?$conf["dir"]["images"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg?".time():(file_exists($conf["dir"]["includes"].$action."/".$cconf["img"]["prefix"]."0.jpg")?REALPATH.$conf["dir"]["includes"].$action."/".$cconf["img"]["prefix"]."0.jpg?".time():"https://fakeimg.pl/".$cconf["img"]["img_w"]."x".$cconf["img"]["img_h"]."/?text=Page"));?>" class="img-thumbnail img-responsive" alt="<?=htmlspecialchars(${"trece"}->{"title"});?>">

      </div>
      <div class="col-xs-12 col-sm-8 col-sm-offset-2">

      </div>
    </div><!-- row -->
  </div><!-- container -->

  <div class="container-fluid" style="background:#ddd;">
    <div class="row">
      <div class="container"<?=$included ? " style=\"padding-bottom:3em;\"" : "";?>>
        <div class="row">
          <div class="col-xs-12 col-sm-8 col-sm-offset-2">
            <h2><?=${"trece"}->{"intro"};?></h2>
          </div>
        </div>
      </div>
    </div>
  </div><!-- container-flud -->

  <div class="container" style="margin:3em auto 8em auto;">
    <div class="row">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2">

        <div class="post">
          <?=mb_strlen(${"trece"}->{"post"})>0 ?${"trece"}->{"post"}:"";?>
        </div>

      </div>
    </div><!-- row -->
  </div><!-- container -->

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
