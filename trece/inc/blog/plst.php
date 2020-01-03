<?php if(!defined("TRECE")):header("location:/");die();endif; ?>
<?php
//BLOG

# ..........................................
# ..########..##........#######...######....
# ..##.....##.##.......##.....##.##....##...
# ..##.....##.##.......##.....##.##.........
# ..########..##.......##.....##.##...####..
# ..##.....##.##.......##.....##.##....##...
# ..##.....##.##.......##.....##.##....##...
# ..########..########..#######...######....
# ..........................................

// http://patorjk.com/software/taag/#p=display&f=Banner4&t=%20TRECE%20
// http://patorjk.com/software/taag/#p=display&f=Bright&t=Deprecated
// https://stackoverflow.com/questions/8154158/mysql-how-do-i-use-delimiters-in-triggers









//Included or not?

  if(!isset($included)) :

    $included = false;

  else :

    $cconf    = require($conf["dir"]["includes"].$action."/".$conf["file"]["conf"].".php");
    $lCustom  = require($conf["dir"]["includes"].$action."/".$conf["file"]["i18n"].".php");

    $conf["site"]["queryArray"]["back"] = $back;
    $conf["site"]["queryq"] = "?".http_build_query($conf["site"]["queryArray"]);

  endif;



/*
//Not logged? Not admin? Get out of here!

  if(
//  1+1==3 # Public for everyone
    !$app->getUserSignInStatus() # Must be logged in
    || $app->getUserHierarchy() != 1 # Must be admin
    ) :

//  header("location:".REALPATHLANG.$action."/".$conf["file"]["publiclist"].QUERYQ);
    header("location:".REALPATHLANG.QUERYQ);
    die();

  endif;
*/



//No $what? Load page 1!

  if(!isset($what)) :

    header("location:".REALPATHLANG.$action."/".$crudlpx."/1".QUERYQ);
    die();

  endif;



//Still here? OK, let's talk.

  require_once($conf["dir"]["includes"].$action."/".$conf["file"]["crud"].".php");

//metastuff
  $lCustom["pagetitle"][LANG] = strip_tags($lCustom["list"][LANG]);
  $lCustom["metadescription"][LANG] = strip_tags("Custom metadescription goes here"); # 160 char text
  $lCustom["metakeywords"] = strip_tags("Custom keywords go here");
  $lCustom["og_image"] = "https://custom.url/image-goes-here"; # 1200x630 px image

  $searchTarget = false;
  $searchWhat   = "";
  $searchLabel  = "";

  if(isset($conf["site"]["queryArray"]["wr"]) && $conf["site"]["queryArray"]["wr"]==$action) :

    $searchTarget = true;
    $searchWhat   = isset($conf["site"]["queryArray"]["wh"]) ? $conf["site"]["queryArray"]["wh"] : "" ;
    $searchLabel  = isset($conf["site"]["queryArray"]["label"]) ? $conf["site"]["queryArray"]["label"] : "" ;

  endif;

  $page = $what;



//Pagination Part 1

  $records_per_page = $included ? 200 : 20;
  $from_record_num = ($records_per_page*$page)-$records_per_page;
  $from_record_num_prev = ($records_per_page*($page-1))-$records_per_page;

//End of Pagination Part 1



# ..............................................................
# ..##.....######..####..######...######.##..##.######.##...##..
# ..##.......##...##.......##.......##...##..##.##.....###.###..
# ..##.......##....####....##.......##...######.####...##.#.##..
# ..##.......##.......##...##.......##...##..##.##.....##...##..
# ..######.######..####....##.......##...##..##.######.##...##..
# ..............................................................

  $trece = new $action($db,$conf);
  $trece->intimacy = 2; #Intimacy 0 : For owner's eyes | Intimacy 1 : For admin's eyes | Intimacy 2 : Public
  $stmt = $trece->readAll($records_per_page,$page,$from_record_num,$searchWhat,$searchLabel);
  $rowcount_page = $trece->rowcount;

  if(!$included && ($rowcount_page == 0 && $page>1)) :

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
  <link href="https://fonts.googleapis.com/css?family=Amiko|Changa:700|Palanquin&display=swap" rel="stylesheet">
  <style>
    /* https://fontjoy.com/ */
    h1{font-family:"Changa",sans-serif;}
    h2{font-family:"Amiko",sans-serif;}
    .post p,.post li{font-family:"Palanquin",sans-serif;}

    /* vertical smartphones */
    @media screen and (min-width:360px) and (max-width:752px){
      .navbar-fixed-top>.container{padding-left:0;}
      .navbar-text{margin-left:15px;}
      .navbar-collapse{max-height:100% !important;}
      .navbar-brand{padding:18px 0 0 15px;margin:0;}

      .info-cal{font-size:1.3em;line-height:1.1em;letter-spacing:-.03em;margin-bottom:1em;font-weight:bold;}
      .info-tit{font-size:2em;line-height:1.1em;letter-spacing:-.03em;margin-bottom:.3em;font-weight:bold;}
      .info-intro{font-size:1.5em;line-height:1.1em;margin-bottom:.5em;}
      .info-labels{font-size:1.3em;line-height:1.2em;margin-bottom:0;}
    }
    /* horizontal smartphones and vertical tablets */
    @media screen and (min-width:753px) and (max-width:1023px){
      .info-cal{font-size:1.3em;line-height:1.1em;letter-spacing:-.03em;margin-bottom:1em;font-weight:bold;}
      .info-tit{font-size:1.3em;line-height:1.1em;letter-spacing:-.03em;margin-bottom:.3em;font-weight:bold;}
      .info-intro{font-size:1.1em;line-height:1.2em;margin-bottom:.5em;}
      .info-labels{font-size:1em;line-height:1.2em;margin-bottom:0;}
    }
    /* horizontal tablets and normal desktops */
    @media screen and (min-width:1024px) and (max-width:1199px){
      .info-cal{font-size:1.3em;line-height:1.1em;letter-spacing:-.03em;margin-bottom:1em;font-weight:bold;}
      .info-tit{font-size:1.6em;line-height:1em;letter-spacing:-.03em;margin-bottom:.3em;font-weight:bold;}
      .info-intro{font-size:1.1em;line-height:1.2em;margin-bottom:.5em;}
      .info-labels{font-size:1em;line-height:1.2em;margin-bottom:0;}
    }
    /* big desktops */
    @media screen and (min-width:1200px){
      .info-cal{font-size:1.3em;line-height:1.1em;letter-spacing:-.03em;margin-bottom:1em;font-weight:bold;}
      .info-tit{font-size:1.6em;line-height:1.2em;letter-spacing:-.03em;margin-bottom:.3em;font-weight:bold;}
      .info-intro{font-size:1.1em;line-height:1.2em;margin-bottom:.5em;}
      .info-labels{font-size:1em;line-height:1.2em;margin-bottom:0;}
    }
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
          <?php // $lacosa = "Questiontypes"; ?>
          <div class="pull-right"><p>
<?php /*    <?=btn("!".$lCustom["new"][LANG],null,"add".(isset($lacosa)?"AndSelect":"")."Them","fa-plus");?> */ ?>
            <?=btn($lCommon["admin_list"][LANG],"!".$action."/".$conf["file"]["adminlist"],"","fa-list");?>
          </p></div>
          <?php endif; ?>
          <h1><strong><a href="<?=REALPATHLANG.$action."/".$conf["file"]["publiclist"];?>"><?=$lCustom["list"][LANG];?></a></strong></h1>
        </div>
      </div>
    </div><!-- End row -->



<?php
# .............................................
# ...####..######..####..#####...####..##..##..
# ..##.....##.....##..##.##..##.##..##.##..##..
# ...####..####...######.#####..##.....######..
# ......##.##.....##..##.##..##.##..##.##..##..
# ...####..######.##..##.##..##..####..##..##..
# .............................................

  if(!isset($included)) : $included = false; endif;

?>

    <div class="row">
      <div class="col-xs-12 col-sm-10 col-sm-offset-1">
        <div style="margin-bottom:20px;">
          <form class="form-inline" action="" method="get">
            <div class="panel panel-default">
              <div class="panel-body">

                <div class="pull-left">
                  <div class="input-group" style="max-width:120px; max-width:250px;">
                    <div class="input-group-addon"><a href="<?=REALPATHLANG.($included?$back:$action)."/".$crudlpx;?>" data-toggle="tooltip" data-placement="bottom" title="<?=$lCommon["reset_search"][LANG];?>"><i class="fas fa-trash"></i></a></div>
                    <input type="hidden" name="wr" value="<?=$action;?>">
                    <input type="text" name="wh" class="form-control input-sm" value="<?=$searchWhat;?>" style="max-width:100%;">
                  </div>
                </div>
                <div class="pull-left">
                  <select id="label" name="label" style="margin-left:5px;">
                    <option value="0"<?=$searchLabel==0?" selected":"";?>><?=$lCustom["any_subject"][LANG];?></option>
                    <?php
                      require_once($conf["dir"]["includes"].$conf["dir"]["labels"]."/".$conf["file"]["crud"].".php");
                      $cconfLabels = require($conf["dir"]["includes"].$conf["dir"]["labels"]."/".$conf["file"]["conf"].".php");
                      $labels = new Labels($db,$conf,$cconfLabels); $stmt = $labels->readAllJSON();
                    ?>
                    <?php if ($labels->rowcount>0): for($i=0;$i<$labels->rowcount;$i++) : ?>
                    <option value="<?=$labels->id[$i];?>"<?=$searchLabel==$labels->id[$i]?" selected":"";?>><?=$labels->{"name_".LANG}[$i];?></option>
                    <?php endfor; endif; ?>
                  </select>
                </div>
                <div class="pull-left">
                  <button type="submit" data-toggle="tooltip" data-placement="bottom" title="<?=$lCommon["search"][LANG];?>" class="btn btn-sm" style="margin-left:5px;"><i class="fas fa-search"></i></button>
                </div>

              </div>
            </div>
          </form>
        </div>
      </div>
    </div><!-- row -->

<?php
# .. END SEARCH
# .............................................
?>



    <div class="row" style="margin-top:1em;margin-bottom:3em;">
      <div class="col-xs-12 col-sm-10 col-sm-offset-1">
<?php if($rowcount_page>0): ?>
        <?php if($trece->rowcount_absolute > $records_per_page) : require $conf["dir"]["includes"]."pager.php"; endif; ?>
        <?php $sum = 1; ?>
        <?php for($i=0;$i<$rowcount_page;$i++) : ?>
          <?php if($sum==1) : ?><div class="row grid-divider"><!-- Start row --><?php endif; ?>
          <div class="col-xs-12 col-sm-4"><?php /* <div class="col-xs-6 col-sm-4 col-md-3"> */ ?>
            <div style="margin-bottom:3em;">
              <p class="info-cal"><i class="far fa-calendar-alt"></i> <?=date("d/m/Y",strtotime(${"trece"}->{"date"}[$i]));?></p>
              <div class="white-panel" style="margin-bottom:1em;">
                <a href="<?=REALPATHLANG.$action."/".${"trece"}->{$cconf["file"]["ref"]}[$i].QUERYQ;?>">
                  <img src="<?=(file_exists($conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}[$i].".jpg")?$conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}[$i].".jpg?".time():(file_exists($conf["dir"]["includes"].$action."/".$conf["css"]["icon_prefix"].$cconf["img"]["prefix"]."0.jpg")?REALPATH.$conf["dir"]["includes"].$action."/".$conf["css"]["icon_prefix"].$cconf["img"]["prefix"]."0.jpg?".time():"https://fakeimg.pl/".$cconf["img"]["icon_w"]."x".$cconf["img"]["icon_h"]."/?text=Blog post"));?>" class="img-thumbnail img-responsive" style="width:100%;" alt="<?=htmlspecialchars(${"trece"}->{"title_".LANG}[$i]);?>">
                </a>
              </div>
              <p class="info-tit"><a href="<?=REALPATHLANG.$action."/".${"trece"}->{$cconf["file"]["ref"]}[$i].QUERYQ;?>" style="text-decoration:none;"><?=${"trece"}->{"title_".LANG}[$i];?></a></p><!-- <?=mb_strtoupper(${"trece"}->{"title_".LANG}[$i],"UTF-8");?> -->
              <?php if(${"trece"}->{"intro_".LANG}[$i] != "") : ?><p class="info-intro"><?=${"trece"}->{"intro_".LANG}[$i];?></p><?php endif; ?>
              <?php if(${"trece"}->{"labels"}[$i] != "") : ?><p class="info-labels"><i class="fas fa-tag"></i> <?=${"trece"}->{"labels"}[$i];?></p><?php endif; ?>
              <div class="clearfix"></div>
            </div>
          </div>

<?php /*  <?php if($sum%4==0) : ?><div class="hidden-sm"><div class="clearfix"></div></div><?php endif; ?> */ ?>
          <?php if($sum%3==0) : ?><div class="visible-sm-block visible-md-block visible-lg-block"><div class="clearfix"></div></div><?php endif; ?>
          <?php if($sum%1==0) : ?><div class="visible-xs-block"><div class="clearfix"></div></div><?php endif; ?>
<?php /*  <?php if($sum%2==0 && $sum%4!=0) : ?><div class="visible-xs-block"><div class="clearfix"></div></div><?php endif; ?> */ ?>
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
