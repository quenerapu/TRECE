<?php if(!defined("TRECE")):header("location:/");die();endif; ?>
<?php
//USERS

# ..................................................
# ..##.....##..######..########.########...######...
# ..##.....##.##....##.##.......##.....##.##....##..
# ..##.....##.##.......##.......##.....##.##........
# ..##.....##..######..######...########...######...
# ..##.....##.......##.##.......##...##.........##..
# ..##.....##.##....##.##.......##....##..##....##..
# ...#######...######..########.##.....##..######...
# ..................................................

// http://patorjk.com/software/taag/#p=display&f=Banner4&t=%20TRECE%20
// http://patorjk.com/software/taag/#p=display&f=Bright&t=Deprecated
// https://stackoverflow.com/questions/8154158/mysql-how-do-i-use-delimiters-in-triggers













//Not logged? Not admin? Get out of here!

  if (
      1+1==3 # Public for everyone
//    !$app->getUserSignInStatus() # Must be logged in
//    || $app->getUserHierarchy() != 1 # Must be admin
     ) :

    header("location:".REALPATHLANG.$conf["site"]["virtualpathArray"][0]."/".$conf["file"]["publiclist"].QUERYQ);
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

    header("location:".REALPATHLANG.$conf["site"]["virtualpathArray"][0]."/".$conf["file"]["publiclist"].QUERYQ);
    die();

  endif;



//Still here? OK, let's talk.

  $lCustom["pagetitle"][LANG] = $trece->name;

  require_once($conf["dir"]["includes"]."header.php");
  require_once($conf["dir"]["includes"]."nav.php");

?>



<?php if($rowcount_page>0) : ?>
  <div class="container main-container">

    <div class="row">
      <div class="col-xs-12 col-sm-10 col-sm-offset-1">

        <div class="page-header">
          <h1><strong><?=$lCustom["pagetitle"][LANG];?></strong></h1>
        </div>

        <p>&nbsp;</p>
      </div>
    </div><!-- row -->



    <div class="row">

      <div class="col-xs-4 col-sm-4 col-sm-offset-1 col-md-3 col-md-offset-2">

        <div style="width:200px;">

          <div class="side-corner-tag">
            <p><span style="background:#<?=$trece->hierarchy_color;?>;width:160px;right:-50px;"></span></p>
            <img src="<?=(file_exists($conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg")?$conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg?".time():(file_exists($conf["dir"]["includes"].$action."/".$conf["css"]["icon_prefix"].$cconf["img"]["prefix"]."0.jpg")?REALPATH.$conf["dir"]["includes"].$action."/".$conf["css"]["icon_prefix"].$cconf["img"]["prefix"]."0.jpg?".time():(file_exists($conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"]."0.jpg")?$conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"]."0.jpg?".time():"https://fakeimg.pl/".$cconf["img"]["icon_w"]."x".$cconf["img"]["icon_h"]."/?text=User")));?>" class="img-thumbnail img-responsive" alt="<?=$trece->name." ".$trece->surname;?>">
          </div>

        </div>

      </div>

      <div class="col-xs-8 col-sm-6 col-md-5">

        <h3><?=$trece->name.(mb_strlen($trece->surname)>0?" ".$trece->surname:"");?></h3>

        <?php if (isset($trece->bio)) : ?>
        <div>
          <?=$trece->bio;?>
        </div>
        <?php endif; ?>

      </div>

    </div><!-- row -->

  </div><!-- container main-container -->
<?php endif; ?>



  <div class="clearfix"></div>



<?php require_once($conf["dir"]["includes"]."footer.php"); ?>
