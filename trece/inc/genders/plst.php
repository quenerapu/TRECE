<?php if(!defined("TRECE")):header("location:./");die();endif; ?>
<?php
//GENDERS

# .....................................................................
# ...######...########.##....##.########..########.########...######...
# ..##....##..##.......###...##.##.....##.##.......##.....##.##....##..
# ..##........##.......####..##.##.....##.##.......##.....##.##........
# ..##...####.######...##.##.##.##.....##.######...########...######...
# ..##....##..##.......##..####.##.....##.##.......##...##.........##..
# ..##....##..##.......##...###.##.....##.##.......##....##..##....##..
# ...######...########.##....##.########..########.##.....##..######...
# .....................................................................

// http://patorjk.com/software/taag/#p=display&f=Banner4&t=%20TRECE%20
// http://patorjk.com/software/taag/#p=display&f=Bright&t=Deprecated
// https://stackoverflow.com/questions/8154158/mysql-how-do-i-use-delimiters-in-triggers









//Included or not?

  if(!isset($included)) :

    $included = false;

  else :

    $cconf    = require($conf["dir"]["includes"].$action."/".$conf["file"]["conf"].".php");
    $lCustom  = require($conf["dir"]["includes"].$action."/".$conf["file"]["i18n"].".php");

  endif;



//Not logged? Not admin? Get out of here!

  if(
//  1+1==3 # Public for everyone
    !$app->getUserSignInStatus() # Must be logged in
    || $app->getUserHierarchy() != 1 # Must be admin
    ) :

    header("location:".REALPATHLANG.QUERYQ);
    die();

  endif;



//No $what? Load page 1!

  if(!isset($what)) :

    header("location:".REALPATHLANG.$action."/".$crudlpx."/1".QUERYQ);
    die();

  endif;



//Still here? OK, let's talk.

//metastuff
  $lCustom["pagetitle"] = $lCustom["list"][LANG];
//$lCustom["metadescription"] = strip_tags("Custom metadescription goes here"); # 160 char text
//$lCustom["metakeywords"] = strip_tags("Custom keywords go here");
//$lCustom["og_image"] = "https://custom.url/image-goes-here"; # 1200x630 px image

  $searchTarget = false;
  $searchWhat   = "";

  if(isset($conf["site"]["queryArray"]["wr"]) && $conf["site"]["queryArray"]["wr"]==$action) :

    $searchTarget = true;
    $searchWhat   = isset($conf["site"]["queryArray"]["wh"]) ? $conf["site"]["queryArray"]["wh"] : "" ;

  endif;

  $page = $what;



//Pagination Part 1

  $records_per_page = $included ? 200 : 20;
  $max_columns = 3;
  $from_record_num = ($records_per_page*$page)-$records_per_page;
  $from_record_num_prev = ($records_per_page*($page-1))-$records_per_page;

//End of Pagination Part 1



  require_once($conf["dir"]["includes"].$action."/".$conf["file"]["crud"].".php");

  $trece = new $action($db,$conf);
  $trece->intimacy = 2; #Intimacy 0 : For owner's eyes | Intimacy 1 : For admin's eyes | Intimacy 2 : Public
  $stmt = $trece->readAll($records_per_page,$page,$from_record_num,$searchWhat);
  $rowcount_page = $trece->rowcount;

  if($rowcount_page == 0 && $page>1) :

    header("location:".REALPATHLANG.$action."/".$crudlpx."/1".QUERYQ);
    die();

  endif;



//Pagination Part 2

  $total_pages = ceil($trece->rowcount_absolute / $records_per_page);
  $range = 2;
  $initial_num = $page - $range;
  $condition_limit_num = ($page + $range) + 1;

//End of Pagination Part 2



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



  <div class="container main-container">



    <div class="row">
      <div class="col-xs-12 col-sm-10 col-sm-offset-1">
        <div class="page-header">
          <?php if($app->getUserHierarchy() == 1) : ?>
          <div class="pull-right"><p>
            <?=btn($lCommon["admin_list"][LANG],"!".$action."/".$conf["file"]["adminlist"],"","fa-list");?>
          </p>
          </div>
          <?php endif; ?>
          <h1><strong><a href="<?=REALPATHLANG.$action."/".$conf["file"]["publiclist"];?>"><?=$lCustom["list"][LANG];?></a></strong></h1>
        </div>
      </div>
    </div><!-- End row -->



<?php require $conf["dir"]["includes"]."search.php"; ?>



    <div class="row" style="margin-top:1em;margin-bottom:3em;">
      <div class="col-xs-12 col-sm-10 col-sm-offset-1">
<?php if($rowcount_page>0): ?>
        <?php if($trece->rowcount_absolute > $records_per_page) : require $conf["dir"]["includes"]."pager.php"; endif; ?>
        <?php $sum = 1; ?>
        <?php for($i=0;$i<$rowcount_page;$i++) : ?>
          <?php if($sum==1) : ?><div class="row grid-divider"><!-- Start row --><?php endif; ?>
          <div class="col-xs-6 col-sm-4 col-md-3">
            <div style="margin-bottom:20px;">
              <div class="white-panel" style="margin-bottom:10px;">
                <a href="<?=REALPATHLANG.$action."/".$trece->{$cconf["file"]["ref"]}[$i].QUERYQ;?>">
                  <img src="<?=file_exists($conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}[$i].".jpg")?$conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}[$i].".jpg?".time():(file_exists($conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"]."0.jpg")?$conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"]."0.jpg?".time():"https://fakeimg.pl/".$cconf["img"]["icon_w"]."x".$cconf["img"]["icon_h"]."/?text=?");?>" class="img-thumbnail img-responsive" style="width:100%;" alt="<?=htmlspecialchars($trece->name[$i]);?>">
                </a>
              </div>
              <p style="line-height:.8em;"><small><strong><a href="<?=REALPATHLANG.$action."/".$trece->{$cconf["file"]["ref"]}[$i].QUERYQ;?>"><?=mb_strtoupper($trece->name[$i],"UTF-8");?></a></strong></small></p>
              <div class="clearfix"></div>
            </div>
          </div>
          <?php if($sum%4==0) : ?><div class="hidden-sm"><div class="clearfix"></div></div><?php endif; ?>
          <?php if($sum%3==0) : ?><div class="visible-sm-block"><div class="clearfix"></div></div><?php endif; ?>
          <?php if($sum%2==0 && $sum%4!=0) : ?><div class="visible-xs-block"><div class="clearfix"></div></div><?php endif; ?>
        <?php $sum++; endfor; ?>
        <?php if($sum > 0) : ?></div><?php endif; ?>
        <?php if($trece->rowcount_absolute > $records_per_page) : require $conf["dir"]["includes"]."pager.php"; endif; ?>
<?php else: ?>
        <div class="alert alert-danger">
          <?php if($trece->rowcount_absolute > 0) : ?><?=$lCommon["few_data"][LANG];?><?php else : ?><?=$lCommon["no_data"][LANG];?><?php endif; ?>
        </div>
<?php endif; ?>
      </div>
    </div><!-- End row -->
  </div><!-- End container main-container -->



  <script>
    $(function(){$('[data-toggle="tooltip"]').tooltip();});
  </script>



<?php require_once($conf["dir"]["includes"]."footer.php"); ?>
