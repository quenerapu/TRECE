<?php if(!defined("TRECE")):header("location:./");die();endif; ?>
<?php
//ORGANIZATIONS

# ......................................................................................................................
# ...#######..########...######......###....##....##.####.########....###....########.####..#######..##....##..######...
# ..##.....##.##.....##.##....##....##.##...###...##..##.......##....##.##......##.....##..##.....##.###...##.##....##..
# ..##.....##.##.....##.##.........##...##..####..##..##......##....##...##.....##.....##..##.....##.####..##.##........
# ..##.....##.########..##...####.##.....##.##.##.##..##.....##....##.....##....##.....##..##.....##.##.##.##..######...
# ..##.....##.##...##...##....##..#########.##..####..##....##.....#########....##.....##..##.....##.##..####.......##..
# ..##.....##.##....##..##....##..##.....##.##...###..##...##......##.....##....##.....##..##.....##.##...###.##....##..
# ...#######..##.....##..######...##.....##.##....##.####.########.##.....##....##....####..#######..##....##..######...
# ......................................................................................................................

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
  <link href="https://fonts.googleapis.com/css?family=Amiko|Changa:700|Palanquin&display=swap" rel="stylesheet">
  <style>
    /* https://fontjoy.com/ */
    h1{font-family:"Changa",sans-serif;}
    h2{font-family:"Amiko",sans-serif;}
    .post p,.post li{font-family:"Palanquin",sans-serif;}

    /* vertical smartphones */
    @media screen and (min-width:360px) and (max-width:752px) and (-webkit-min-device-pixel-ratio:0){ /* CHROME ONLY!! */
      .post p:first-of-type::first-letter{font-size:6.4em;margin:.25em .1em .1em -.05em;}
      }
    @-moz-document url-prefix() { /* FIREFOX ONLY!! */
      @media screen and (min-width:360px) and (max-width:752px){
        .post p:first-of-type::first-letter{font-size:6.2em;margin:.1em .1em 0 0;}
        }
      }

    /* vertical smartphones */
    @media screen and (min-width:360px) and (max-width:752px){
      .container-top{margin-top:-2em;}
      h2{font-size:1.3em;line-height:1.6em;padding:.5em;}
      .post{padding:.5em;}
      .post p,.post li{font-size:1.3em;line-height:1.6em;padding-bottom:.7em;}
      .post p:first-of-type::first-letter{font-family:"Changa",sans-serif;float:left;}
    }

    /* horizontal smartphones and vertical tablets */
    @media screen and (min-width:753px) and (max-width:1023px){
      h2{font-size:1.3em;line-height:1.6em;padding:1.2em 0;}
    }

    /* horizontal tablets and normal desktops */
    @media screen and (min-width:1024px) and (max-width:1199px){
      h2{font-size:1.3em;line-height:1.6em;padding:1.2em 0;}
    }

    /* big desktops */
    @media screen and (min-width:1200px) and (-webkit-min-device-pixel-ratio:0){ /* CHROME ONLY!! */
      .post p:first-of-type::first-letter{margin:.3em .1em .1em 0;}
      }
    @-moz-document url-prefix() { /* FIREFOX ONLY!! */
      @media screen and (min-width:1200px){
        .post p:first-of-type::first-letter{margin:.1em .1em .1em 0;}
      }
    }
    @media screen and (min-width:1200px){
      .container-top{margin-top:-1em;}
      h2{font-size:1.3em;line-height:1.6em;padding:1.2em 0;}
      .post p,.post li{font-size:1.3em;line-height:1.6em;padding-bottom:.7em;}
      .post p:first-of-type::first-letter{display:inline-block;font-family:"Changa",sans-serif;float:left;font-size:6.2em;}
    }

    .social-share{margin:1em 0;padding-bottom:3em;width:140px;text-align:left;}
    .icon{position:relative;text-align:center;width:0px;height:0px;padding:20px;border-top-right-radius:20px;border-top-left-radius:20px;border-bottom-right-radius:20px;border-bottom-left-radius:20px;-moz-border-radius:20px 20px 20px 20px;-webkit-border-radius:20px 20px 20px 20px;-khtml-border-radius:20px 20px 20px 20px;}
    .icon i{font-size:18px;position:absolute;left:9px;top:10px;color:#fff;}
    .icon.social{float:left;margin:0 5px 0 0;cursor:pointer;background:#666;transition:.5s;-moz-transition:.5s;-webkit-transition:.5s;-o-transition:.5s;}
    .icon.social:hover{background:#000;transition:.5s;-moz-transition:.5s;-webkit-transition:.5s;-o-transition:.5s;-webkit-filter:drop-shadow(0 1px 10px rgba(0,0,0,.8));-moz-filter:drop-shadow(0 1px 10px rgba(0,0,0,.8));-ms-filter:drop-shadow(0 1px 10px rgba(0,0,0,.8));-o-filter:drop-shadow(0 1px 10px rgba(0,0,0,.8));filter:drop-shadow(0 1px 10px rgba(0,0,0,.8));}
    .icon.social.fb i{left:14px;top:10px;}
    .icon.social.tw i{left:11px;}
    .icon.social.em i{left:11px;}
  </style>
EOD;



//metastuff
  $lCustom["pagetitle"] = strip_tags(${"trece"}->{"title_".LANG});
  $lCustom["metadescription"] = strip_tags(${"trece"}->{"intro_".LANG});
//$lCustom["metakeywords"] = strip_tags("Custom keywords go here");
  $lCustom["og_image"] = file_exists($conf["dir"]["images"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg")?REALPATH.$conf["dir"]["images"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg":(file_exists($conf["dir"]["includes"].$action."/".$cconf["img"]["prefix"]."0.jpg")?REALPATH.$conf["dir"]["includes"].$action."/".$cconf["img"]["prefix"]."0.jpg":"https://fakeimg.pl/".$cconf["img"]["img_w"]."x".$cconf["img"]["img_h"]."/?text=Organization");



  require_once($conf["dir"]["includes"]."header.php");
  require_once($conf["dir"]["includes"]."nav.php");

?>



<?php if($rowcount_page>0) : ?>

  <div class="container container-top"<?=$included ? " style=\"padding-bottom:3em;\"" : "";?>>
    <div class="row">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2">

        <h1>
          <small><i class="far fa-calendar-alt"></i> <?=date($conf["site"]["langs"][LANG]["date-format"],strtotime(${"trece"}->{"date"}));?></small><br>
          <?=${"trece"}->{"title_".LANG};?>
        </h1>

      </div>
    </div><!-- row -->
    <div class="row">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2">

        <img src="<?=$lCustom["og_image"];?>" class="img-thumbnail img-responsive" style="width:100%;" alt="<?=htmlspecialchars(${"trece"}->{"title_".LANG});?>">

      </div>
      <div class="col-xs-12 col-sm-8 col-sm-offset-2">

        <div class="social-share">
          <div class="icon social fb"><a href="https://www.facebook.com/sharer/sharer.php?u=<?=$conf["site"]["fullpath"];?>&quote=<?=htmlspecialchars(${"trece"}->{"intro_".LANG});?>" target="_blank" title="Compartir en Facebook"><i class="far fa-facebook-square"></i></a></div>
          <div class="icon social tw"><a href="https://twitter.com/intent/tweet?source=<?=$conf["site"]["fullpath"];?>&text=<?=$conf["site"]["fullpath"];?>%20<?=htmlspecialchars(${"trece"}->{"intro_".LANG});?>%20--%20&via=<?=$conf["contact"]["twitter"];?>" target="_blank" title="Compartir en Twitter"><i class="far fa-twitter"></i></a></div>
          <div class="icon social em"><a href="mailto:?subject=&body=<?=htmlspecialchars(${"trece"}->{"intro_".LANG});?>%20<?=$conf["site"]["fullpath"];?>" target="_blank" title="Enviar por correo electrónico"><i class="far fa-envelope"></i></a></div>
        </div>

      </div>
    </div><!-- row -->
  </div><!-- container -->

  <div class="container-fluid" style="background:#ddd;">
    <div class="row">
      <div class="container"<?=$included ? " style=\"padding-bottom:3em;\"" : "";?>>
        <div class="row">
          <div class="col-xs-12 col-sm-8 col-sm-offset-2">

<?php if($app->getUserSignInStatus() && $app->getUserHierarchy() == 1) : ?>

            <p><small>
              <a href="https://developers.facebook.com/tools/debug/sharing/?q=<?=$conf["site"]["fullpath"];?>" target="_blank" style="text-decoration:underline;">Facebook debugger</a> | 
              <a href="https://cards-dev.twitter.com/validator" target="_blank" style="text-decoration:underline;">Twitter Card Validator</a>
            </small></p>

<?php endif; ?>

            <h2><?=${"trece"}->{"intro_".LANG};?></h2>

          </div>
        </div>
      </div>
    </div>
  </div><!-- container-flud -->

  <div class="container" style="margin:3em auto 8em auto;">
    <div class="row">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2">

        <div class="post">
          <?=mb_strlen(${"trece"}->{"post_".LANG})>0 ?${"trece"}->{"post_".LANG}:"";?>
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
