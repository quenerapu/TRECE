<?php if(!defined("TRECE")):header("location:./");die();endif; ?>
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



//Not logged? Not admin? Get out of here!

  if (
//    1+1==3 # Public for everyone
      !$app->getUserSignInStatus() # Must be logged in
      || $app->getUserHierarchy() != 1 # Must be admin
     ) :

//  header("location:".REALPATHLANG.$action."/".$conf["file"]["publiclist"].QUERYQ);
    header("location:".REALPATHLANG.QUERYQ);
    die();

  endif;



//No $what? Load page 1!

  if(!isset($what)) :

    header("location:".REALPATHLANG.$action."/".$crudlpx."/1".QUERYQ);
    die();

  endif;



//Still here? OK, let's talk.

  require_once($conf["dir"]["includes"].$action."/".$conf["file"]["crud"].".php");



# ......##..........................................
# ...########...........######...########.########..
# ..##..##..##.........##....##..##..........##.....
# ..##..##.............##........##..........##.....
# ...########..........##...####.######......##.....
# ......##..##.........##....##..##..........##.....
# ..##..##..##.........##....##..##..........##.....
# ...########..#######..######...########....##.....
# ......##..........................................



# ...............................
# ..######..####...####..##..##..
# ......##.##.....##..##.###.##..
# ......##..####..##..##.##.###..
# ..##..##.....##.##..##.##..##..
# ...####...####...####..##..##..
# ...............................

  if(isset($_GET["json"])) : # JSON list

    $trece = new $action($db,$conf,$cconf);
    $trece->intimacy  = 1;
    $trece->search = isset($_GET["q"]) ? htmlspecialchars($_GET["q"]) : null;
    $stmt = $trece->readAllJSON();

    if ($trece->rowcount>0):

      for($i=0;$i<$trece->rowcount;$i++) :

        $rows[] = "\n{
          \"value\":\"".$trece->id[$i]."\",
          \"date\":\"".$trece->date[$i]."\",
          \"title_en\":\"".html_entity_decode(str_replace(array('"',"'"),array('&#8243;','&#8242;'),$trece->title_en[$i]))."\",
          \"url_title_en\":\"".$trece->url_title_en[$i]."\"
        }";

      endfor;

      header("Content-Type: application/json; charset=UTF-8");
      echo "[" .join(",", $rows) ."\n]";

    endif;

    die();

  endif;

# .. END JSON
# ...............................



# ......##....................................................
# ...########..........########...#######...######..########..
# ..##..##..##.........##.....##.##.....##.##....##....##.....
# ..##..##.............##.....##.##.....##.##..........##.....
# ...########..........########..##.....##..######.....##.....
# ......##..##.........##........##.....##.......##....##.....
# ..##..##..##.........##........##.....##.##....##....##.....
# ...########..#######.##.........#######...######.....##.....
# ......##....................................................



# ...........................................................................
# ..##..##..........######.#####..######.######..####..#####..##.....######..
# ...####...........##.....##..##...##.....##...##..##.##..##.##.....##......
# ....##....######..####...##..##...##.....##...######.#####..##.....####....
# ...####...........##.....##..##...##.....##...##..##.##..##.##.....##......
# ..##..##..........######.#####..######...##...##..##.#####..######.######..
# ...........................................................................

  if(isset($_POST["pk"])) : # x-editable fields

    $trece              = new $action($db,$conf);
    $trece->field       = $_POST["name"];
    $trece->value       = isset($_POST["value"])?(is_array($_POST["value"])?implode(",",$_POST["value"]):$_POST["value"]):0;
    $trece->pk          = $_POST["pk"];

    if (strpos($trece->pk,"|") !== false) :
      $trece->pk        = explode("|",$trece->pk);
      $trece->pk        = $trece->pk[0];
      $trece->url_value = getUrlFriendlyString($trece->value);
    endif;

    if(!$trece->updateOneSingleField()) :
      echo "error";
    endif;
    die();

  endif;

# .. END X-EDITABLE
# ...........................................................................



# .......................................................
# ...####..#####..#####....######.##..##.######.##...##..
# ..##..##.##..##.##..##.....##...##..##.##.....###.###..
# ..######.##..##.##..##.....##...######.####...##.#.##..
# ..##..##.##..##.##..##.....##...##..##.##.....##...##..
# ..##..##.#####..#####......##...##..##.######.##...##..
# .......................................................

  if(isset($_POST["addThem"])) :

    $trece                      = new $action($db,$conf);
    $howMany                    = $_POST["add_howMany"]>0?$_POST["add_howMany"]:1;
    $trece->id_status           = $cconf["default"]["id_status"];
    $trece->title_en            = trim(preg_replace("/[[:blank:]]+/"," ",$cconf["default"]["title_en"]));
    $trece->url_title_en        = trim(preg_replace("/[[:blank:]]+/"," ",$cconf["default"]["url_title_en"]));
    $trece->title_gal           = trim(preg_replace("/[[:blank:]]+/"," ",$cconf["default"]["title_gal"]));
    $trece->url_title_gal       = trim(preg_replace("/[[:blank:]]+/"," ",$cconf["default"]["url_title_gal"]));
    $trece->title_es            = trim(preg_replace("/[[:blank:]]+/"," ",$cconf["default"]["title_es"]));
    $trece->url_title_es        = trim(preg_replace("/[[:blank:]]+/"," ",$cconf["default"]["url_title_es"]));
    $trece->date                = trim(preg_replace("/[[:blank:]]+/"," ",$cconf["default"]["date"]));
    $trece->id_author           = $app->getUserID();

    if($howMany > 0 && $howMany <= $cconf["default"]["max_new_items"]) :

      $i=1; do{$trece->addOne();$i++;}while($i<=$howMany);

    endif;

    die();

  endif;

# .. END ADD THEM
# .......................................................



# ....................................................................
# ...####..##......####..##..##.######...######.##..##.######..####...
# ..##..##.##.....##..##.###.##.##.........##...##..##...##...##......
# ..##.....##.....##..##.##.###.####.......##...######...##....####...
# ..##..##.##.....##..##.##..##.##.........##...##..##...##.......##..
# ...####..######..####..##..##.######.....##...##..##.######..####...
# ....................................................................

  if(isset($_POST["cloneThis"])) :

    $trece                      = new $action($db,$conf);
    $trece->ref                 = $_POST["clone_ref"];
    $trece->id_status           = $cconf["default"]["id_status"];
    $trece->date                = date("Y-m-d");
    $trece->title_en            = mb_substr("Copy of ".$_POST["clone_title_en"],0,54);
    $trece->url_title_en        = trim(preg_replace("/[[:blank:]]+/"," ",$trece->date."-".$cconf["default"]["url_title_en"]));
    $trece->intro_en            = $_POST["clone_intro_en"];
    $trece->post_en             = $_POST["clone_post_en"];

    $trece->title_gal           = mb_substr("Copia de ".$_POST["clone_title_gal"],0,54);
    $trece->url_title_gal       = trim(preg_replace("/[[:blank:]]+/"," ",$trece->date."-".$cconf["default"]["url_title_gal"]));
    $trece->intro_gal           = $_POST["clone_intro_gal"];
    $trece->post_gal            = $_POST["clone_post_gal"];

    $trece->title_es            = mb_substr("Copia de ".$_POST["clone_title_es"],0,54);
    $trece->url_title_es        = trim(preg_replace("/[[:blank:]]+/"," ",$trece->date."-".$cconf["default"]["url_title_es"]));
    $trece->intro_es            = $_POST["clone_intro_es"];
    $trece->post_es             = $_POST["clone_post_es"];

    $trece->ids_labels          = $_POST["clone_ids_labels"];
    $trece->id_author           = $app->getUserID();

    $trece->addOne();

    die();

  endif;

# .. END CLONE THIS
# ....................................................................



# ............................................................................
# ..#####..######.##.....######.######.######...######.##..##.######.##...##..
# ..##..##.##.....##.....##.......##...##.........##...##..##.##.....###.###..
# ..##..##.####...##.....####.....##...####.......##...######.####...##.#.##..
# ..##..##.##.....##.....##.......##...##.........##...##..##.##.....##...##..
# ..#####..######.######.######...##...######.....##...##..##.######.##...##..
# ............................................................................

  if(isset($_POST["deleteThem"])) :

    $trece      = new $action($db,$conf);
    $trece->who = explode("???",$_POST["delete_who"]);

    foreach($trece->who as $items) :

      $item = explode("|",$items);
      $trece->id = $item[0];
      $trece->{$cconf["img"]["ref"]}  = $item[1];

      $trece->deleteOne();
      $filename = $cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg";
      if(file_exists($conf["dir"]["images"].$conf["css"]["thumb_prefix"].$filename)):unlink($conf["dir"]["images"].$conf["css"]["thumb_prefix"].$filename);endif;
      if(file_exists($conf["dir"]["images"].$conf["css"]["icon_prefix"].$filename)):unlink($conf["dir"]["images"].$conf["css"]["icon_prefix"].$filename);endif;
      if(file_exists($conf["dir"]["images"].$filename)):unlink($conf["dir"]["images"].$filename);endif;

      foreach(glob($conf["dir"]["images"]."*.{jpg,JPG,jpeg,JPEG,png,PNG}",GLOB_BRACE) as $file):
        if((substr(basename($file),0,13+(strlen($action)))===$action."-img-".$trece->{$cconf["img"]["ref"]})) :
          unlink($conf["dir"]["images"].basename($file));
        endif;
      endforeach;

    endforeach;

    die();

  endif;

# .. END DELETE THEM
# ............................................................................




//metastuff
  $lCustom["pagetitle"] = strip_tags($lCustom["admin_list"][LANG]);
//$lCustom["metadescription"] = strip_tags("Custom metadescription goes here"); # 160 char text
//$lCustom["metakeywords"] = strip_tags("Custom keywords go here");
//$lCustom["og_image"] = "https://custom.url/image-goes-here"; # 1200x630 px image



  $searchTarget     = false;
  $searchWhat       = "";
  $searchLabel      = "";

  if(isset($conf["site"]["queryArray"]["wr"]) && $conf["site"]["queryArray"]["wr"]==$action) :

    $searchTarget     = true;
    $searchWhat       = isset($conf["site"]["queryArray"]["wh"]) ? $conf["site"]["queryArray"]["wh"] : "" ;
    $searchLabel      = isset($conf["site"]["queryArray"]["label"]) ? $conf["site"]["queryArray"]["label"] : "" ;

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

  $trece = new $action($db,$conf,$cconf);

  if($trece->firstTime()) :

    echo "<html style=\"padding:0;margin:0;\"><head><meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\" /><meta name=\"viewport\" content=\"width=device-width,initial-scale=1\" /></head><body style=\"padding:0;margin:0;\"><img src=\"https://fakeimg.pl/250x100/?text=".$action."\"></body></html>";
//  header("location:".REALPATHLANG.$action."/".$crudlpx."/1".QUERYQ);
    die();

  endif;

  $trece->intimacy = 1; #Intimacy 0 : For owner's eyes | Intimacy 1 : For admin's eyes | Intimacy 2 : Public
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
          <?php // $lacosa = "Questiontypes"; ?>
          <div class="pull-right"><p>
            <?=btn("!".$lCustom["new"][LANG],null,"add".(isset($lacosa)?"AndSelect":"")."Them","fa-plus");?>
            <?=btn($lCommon["public_list"][LANG],"!".$action."/".$conf["file"]["publiclist"],"","fa-list");?>
          </p></div>
          <?php endif; ?>
          <h1><strong><?=$lCustom["admin_list"][LANG];?></strong></h1>
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
                    <option value="0"<?=$searchLabel==0?" selected":"";?>><?=$lCustom["any_label"][LANG];?></option>
                    <?php
                      require_once($conf["dir"]["includes"].$conf["dir"]["labels"]."/".$conf["file"]["crud"].".php");
                      $cconfLabels = require($conf["dir"]["includes"].$conf["dir"]["labels"]."/".$conf["file"]["conf"].".php");
                      $labels = new $conf["dir"]["labels"]($db,$conf,$cconfLabels); $stmt = $labels->readAllJSON();
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



    <div class="row" style="margin-top:1em;">
      <div class="col-xs-12 col-sm-10 col-sm-offset-1">

      <?php

        if($rowcount_page>0) :

          if($trece->rowcount_absolute > $records_per_page) :

            require $conf["dir"]["includes"]."pager.php";

          endif;

      ?>

        <div class="pull-right"><p>
          <strong><?=$trece->rowcount_absolute;?> <?=$trece->rowcount_absolute == 1 ? $lCommon["result"][LANG] : $lCommon["results"][LANG];?></strong>
        </p></div>
        <h4>
          <a id="deleteThem" data-toggle="tooltip" data-placement="bottom" title="<?=$lCommon["multiple_delete"][LANG];?>"><i class="fas fa-trash"></i></a>
        </h4>



        <table class="table table-condensed" style="margin:.5em 0;">
          <thead>
            <tr>
              <th><input type="checkbox" id="allnone"></th>
              <th><?=$lCustom["status"][LANG];?></th>
              <th><?=$lCommon["image"][LANG];?></th>
              <th><?=$lCommon["date"][LANG];?> / <?=$lCommon["title"][LANG];?> / <?=$lCustom["intro"][LANG];?> / <?=$lCustom["labels"][LANG];?></th>
              <th style="text-align:right;"><!-- <?=$lCommon["actions"][LANG];?> --></th>
            </tr>
          </thead>
          <?php for($i=0;$i<$rowcount_page;$i++) : ?>
          <tbody id="tbody_<?=$trece->id[$i];?>">
            <tr id="tr_<?=$trece->id[$i]?>">
              <td>
                <input type="checkbox" class="checkme" name="item" data-id="<?=$trece->id[$i]?>" value="<?=$trece->id[$i];?>|<?=$trece->{$cconf["img"]["ref"]}[$i];?>">
              </td>
              <td>
                <a href="javascript:void(0);" class="change-status" style="text-decoration:none !important;" data-pk="<?=$trece->id[$i];?>" data-name="id_status" data-value="<?=$trece->id_status[$i];?>"><span class="label label-<?=$trece->id_status[$i]==1?"success":"danger";?>" style="padding-bottom:.1em;"><?=$trece->id_status[$i]==1?"ON":"OFF";?></span></a>
              </td>
              <td<?=$trece->id_status[$i]==0?" class=\"attenuate\"":"";?>>
                <a href="<?=REALPATHLANG.$action."/".$conf["file"]["update"]."/".$trece->ref[$i].QUERYQ;?>">
                  <img src="<?=(file_exists($conf["dir"]["images"].$conf["css"]["thumb_prefix"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}[$i].".jpg")?$conf["dir"]["images"].$conf["css"]["thumb_prefix"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}[$i].".jpg?".time():(file_exists($conf["dir"]["includes"].$action."/".$conf["css"]["thumb_prefix"].$cconf["img"]["prefix"]."0.jpg")?REALPATH.$conf["dir"]["includes"].$action."/".$conf["css"]["thumb_prefix"].$cconf["img"]["prefix"]."0.jpg?".time():"https://fakeimg.pl/".$cconf["img"]["thumb_w"]."x".$cconf["img"]["thumb_h"]."/?text=Blog post"));?>" class="img-thumbnail img-responsive" alt="<?=htmlspecialchars($trece->title_en[$i]);?>">
                </a>
              </td>
              <td<?=$trece->id_status[$i]==0?" class=\"attenuate\"":"";?>>
                <div class="bs-callout bs-callout-default">
                  <small><i class="far fa-calendar-alt"></i> <?=date($conf["site"]["langs"][LANG]["date-format"],strtotime(${"trece"}->{"date"}[$i]));?></small><br>
                  <a href="<?=REALPATHLANG.$action."/".$conf["file"]["update"]."/".$trece->ref[$i].QUERYQ;?>">
                    <strong><?=${"trece"}->{"title_".LANG}[$i];?></strong>
                  </a><br>
                  <small><?=doWordWrap(${"trece"}->{"intro_".LANG}[$i]);?></small><br>
                  <?php if(${"trece"}->{"labels"}[$i] != "") : ?><small><i class="fas fa-tag"></i> <?=${"trece"}->{"labels"}[$i];?></small><?php endif; ?>
                </div>
              </td>
              <td style="white-space:nowrap;text-align:right;">
                <div class="btn-group">
                  <a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=$lCommon["actions"][LANG];?> <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="<?=REALPATHLANG.$action."/".$conf["file"]["update"]."/".$trece->ref[$i].$conf["site"]["queryq"];?>"><i class="fas fa-edit fa-fw"></i> <?=$lCommon["edit"][LANG];?></a></li>
                    <li><a data-ref="<?=$trece->ref[$i];?>" 
                           data-date="<?=$trece->date[$i];?>" 
                           data-title_en="<?=htmlspecialchars($trece->title_en[$i]);?>" 
                           data-intro_en="<?=htmlspecialchars($trece->intro_en[$i]);?>" 
                           data-post_en="<?=htmlspecialchars($trece->post_en[$i]);?>" 
                           data-title_gal="<?=htmlspecialchars($trece->title_gal[$i]);?>" 
                           data-intro_gal="<?=htmlspecialchars($trece->intro_gal[$i]);?>" 
                           data-post_gal="<?=htmlspecialchars($trece->post_gal[$i]);?>" 
                           data-title_es="<?=htmlspecialchars($trece->title_es[$i]);?>" 
                           data-intro_es="<?=htmlspecialchars($trece->intro_es[$i]);?>" 
                           data-post_es="<?=htmlspecialchars($trece->post_es[$i]);?>" 
                           data-ids_labels="<?=htmlspecialchars($trece->ids_labels[$i]);?>" 
                           data-id_author="<?=htmlspecialchars($trece->id_author[$i]);?>" 
                           class="clone-object" style="cursor:pointer;"><i class="far fa-clone fa-fw"></i> <?=$lCommon["clone"][LANG];?></a></li>
                    <li class="divider"></li>
                    <li><a href="<?=REALPATHLANG.$action."/".$trece->{$cconf["file"]["ref"]}[$i].QUERYQ;?>" class="<?=$trece->id_status[$i]==0?"disabled ":"";?>"><i class="far fa-eye fa-fw"></i> <?=$lCommon["see"][LANG];?></a></li>
                  </ul>
                </div>
              </td>
            </tr>
          </tbody>
          <?php endfor; ?>
        </table>

      <?php

          if($trece->rowcount_absolute > $records_per_page) :

            require $conf["dir"]["includes"]."pager.php";

          endif;

        else:

      ?>

        <div class="alert alert-danger">
          <?php if($trece->rowcount_absolute > 0) : ?>
              <?=$lCommon["few_data"][LANG];?>
          <?php else : ?>
              <?=$lCommon["no_data"][LANG];?>
          <?php endif; ?>
        </div>

      <?php

        endif;

      ?>

        <div class="clearfix"></div>

      </div>
    </div><!-- row -->

  </div>






  <script>
    $(function(){$('[data-toggle="tooltip"]').tooltip();});
  </script>



<!-- Change Status -->
  <script>
    $(document).on("click",".change-status",function(){
      var pk    = $(this).data("pk");
      var name  = $(this).data("name");
      var value = $(this).data("value")==0?1:0;

      $.post("",{
        pk:pk,
        name:name,
        value:value,
        },function(data){
//      alert(data);
        $("#tr_"+pk).closest("tbody").load(location.href+" #tr_"+pk);
        setTimeout(startxEditable,2000);
        }).fail(function(){alert("<?=addslashes($lCommon["cannot_be_changed"][LANG]);?>");});
      return false;
      });
  </script>



<!-- Clone This -->
  <script>
    $(document).on("click",".clone-object",function(){
      var ref             =   $(this).data("ref");
      var date            =   $(this).data("date");
      var title_en        =   $(this).data("title_en");
      var intro_en        =   $(this).data("intro_en");
      var post_en         =   $(this).data("post_en");
      var title_gal       =   $(this).data("title_gal");
      var intro_gal       =   $(this).data("intro_gal");
      var post_gal        =   $(this).data("post_gal");
      var title_es        =   $(this).data("title_es");
      var intro_es        =   $(this).data("intro_es");
      var post_es         =   $(this).data("post_es");
      var ids_labels      =   $(this).data("ids_labels");
      var id_author       =   $(this).data("id_author");

      $.post("",{
        cloneThis:true,
        clone_ref:ref,
        clone_date:date,
        clone_title_en:title_en,
        clone_intro_en:intro_en,
        clone_post_en:post_en,
        clone_title_gal:title_gal,
        clone_intro_gal:intro_gal,
        clone_post_gal:post_gal,
        clone_title_es:title_es,
        clone_intro_es:intro_es,
        clone_post_es:post_es,
        clone_ids_labels:ids_labels,
        clone_id_author:id_author,
        },function(data){
//        alert(data);
          location.reload();
        }).fail(function(){alert("<?=addslashes($lCommon["cannot_be_cloned"][LANG]);?>");});
      return false;
      });
  </script>



<!-- X-editable -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/<?=$conf["version"]["x-editable"];?>/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/<?=$conf["version"]["x-editable"];?>/bootstrap3-editable/css/bootstrap-editable.css" />
  <script>

    $(document).ready(function(){startxEditable();});

    function startxEditable(){
      };

  </script>



<?php require_once($conf["dir"]["includes"]."javascript.php"); ?>



<?php require_once($conf["dir"]["includes"]."footer.php"); ?>
