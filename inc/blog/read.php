<?php if(!defined("TRECE")):header("location:/");die();endif; ?>
<?php
//BLOG

# ----------------------------------........
# ..########..##........#######...######....
# ..##.....##.##.......##.....##.##....##...
# ..##.....##.##.......##.....##.##.........
# ..########..##.......##.....##.##...####..
# ..##.....##.##.......##.....##.##....##...
# ..##.....##.##.......##.....##.##....##...
# ..########..########..#######...######....
# ..................................--------

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



  $customJS = <<<EOD
  <script>
    /* whatever */
  </script>

EOD;
  $customCSS = <<<EOD
  <style>
    .post p:first-of-type:first-letter{font-family:"Open Sans";font-weight:800;float:left;font-size:3.95em;line-height:.8em;margin:.4rem .6rem 0 -.4rem;}
  </style>
EOD;



  $lCustom["og_image"] = file_exists($conf["dir"]["images"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg")?REALPATH.$conf["dir"]["images"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg":(file_exists($conf["dir"]["includes"].$action."/".$cconf["img"]["prefix"]."0.jpg")?REALPATH.$conf["dir"]["includes"].$action."/".$cconf["img"]["prefix"]."0.jpg":"https://fakeimg.pl/".$cconf["img"]["img_w"]."x".$cconf["img"]["img_h"]."/?text=Novas");
  $lCustom["pagetitle"][LANG] = ${"trece"}->{"title"};
  $conf["meta"]["description"][LANG] = ${"trece"}->{"intro"};
  require_once($conf["dir"]["includes"]."header.php");
  require_once($conf["dir"]["includes"]."nav.php");

?>



<?php if($rowcount_page>0) : ?>
  <div class="container main-container"<?=$included ? " style=\"padding-bottom:3em;\"" : "";?>>

    <div class="row">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2">

        <h1><strong><?=${"trece"}->{"title"};?></strong></h1>

      </div>
    </div><!-- row -->



    <div class="row">

      <div class="col-xs-12 col-sm-8 col-sm-offset-2">

        <img src="<?=(file_exists($conf["dir"]["images"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg")?$conf["dir"]["images"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg?".time():(file_exists($conf["dir"]["includes"].$action."/".$cconf["img"]["prefix"]."0.jpg")?REALPATH.$conf["dir"]["includes"].$action."/".$cconf["img"]["prefix"]."0.jpg?".time():"https://fakeimg.pl/".$cconf["img"]["img_w"]."x".$cconf["img"]["img_h"]."/?text=Novas"));?>" class="img-thumbnail img-responsive" alt="<?=${"trece"}->{"title"};?>">

      </div>

      <div class="col-xs-12 col-sm-8 col-sm-offset-2">

        <h4><i class="fa fa-calendar" aria-hidden="true"></i> <?=date("d/m/Y",strtotime(${"trece"}->{"date"}));?></h4>

        <h4>
          <a href="https://www.facebook.com/sharer/sharer.php?u=<?=$conf["site"]["fullpath"];?>&quote=<?=${"trece"}->{"intro"};?>" target="_blank" title="Compartir en Facebook"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
          <a href="https://twitter.com/intent/tweet?source=<?=$conf["site"]["fullpath"];?>&text=<?=$conf["site"]["fullpath"];?>%20<?=${"trece"}->{"intro"};?>%20--%20&via=@vilarfao" target="_blank" title="Compartir en Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
          <a href="mailto:?subject=&body=<?=${"trece"}->{"intro"};?>%20<?=$conf["site"]["fullpath"];?>" target="_blank" title="Enviar por correo electrónico"><i class="fa fa-envelope" aria-hidden="true"></i></a>
<?php if($app->getUserSignInStatus() && $app->getUserHierarchy() == 1) : ?>
          <a href="https://developers.facebook.com/tools/debug/sharing/?q=<?=$conf["site"]["fullpath"];?>" target="_blank">Facebook debugger</a>
          <a href="https://developers.facebook.com/tools/debug/sharing/?q=<?=$conf["site"]["fullpath"];?>" target="_blank">Twitter Card Validator</a>
<?php endif; ?>
        </h4>

        <div class="panel panel-default" style="margin:2em 0;padding:2em;">
          <h4 style="line-height:1.4em;"><?=${"trece"}->{"intro"};?></h4>
        </div>

      </div>

      <div class="col-xs-12 col-sm-8 col-sm-offset-2">

        <div class="post" style="line-height:1.6em;">

          <?=mb_strlen(${"trece"}->{"post"})>0 ?${"trece"}->{"post"}:"";?>

        </div>

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
