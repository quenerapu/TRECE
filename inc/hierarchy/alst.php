<?php if(!defined("TRECE")):header("location:/");die();endif; ?>
<?php
//HIERARCHY

# .....................................................................................
# ..##.....##.####.########.########.....###....########...######..##.....##.##....##..
# ..##.....##..##..##.......##.....##...##.##...##.....##.##....##.##.....##..##..##...
# ..##.....##..##..##.......##.....##..##...##..##.....##.##.......##.....##...####....
# ..#########..##..######...########..##.....##.########..##.......#########....##.....
# ..##.....##..##..##.......##...##...#########.##...##...##.......##.....##....##.....
# ..##.....##..##..##.......##....##..##.....##.##....##..##....##.##.....##....##.....
# ..##.....##.####.########.##.....##.##.....##.##.....##..######..##.....##....##.....
# .....................................................................................

// http://patorjk.com/software/taag/#p=display&f=Banner4&t=%20TRECE%20
// http://patorjk.com/software/taag/#p=display&f=Bright&t=Deprecated
// https://stackoverflow.com/questions/8154158/mysql-how-do-i-use-delimiters-in-triggers













  if(!isset($included)) :

    $included = false;

  else :

    $cconf    = require($conf["dir"]["includes"].$action."/".$conf["file"]["conf"].".php");
    $lCustom  = require($conf["dir"]["includes"].$action."/".$conf["file"]["i18n"].".php");

  endif;



//Not logged? Not admin? Get out of here!

  if (
//    1+1==3 # Public for everyone
      !$app->getUserSignInStatus() # Must be logged in
      || $app->getUserHierarchy() != 1 # Must be admin
     ) :

    header("location:".REALPATHLANG.$conf["site"]["virtualpathArray"][0]."/".$conf["file"]["publiclist"].QUERYQ);
    die();

  endif;



//No $what? Load page 1!

  if ( !isset($what) ) :

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
          \"name\":\"".$trece->name[$i]."\"
        }";

      endfor;

      header("Content-Type: application/json; charset=UTF-8");
      echo "[" .join(",", $rows) ."\n]";

    endif;

    die();

  endif;

# .. END SELECTIZE
# ...........................................................................



# ......##....................................................
# ...########..........########...#######...######..########..
# ..##..##..##.........##.....##.##.....##.##....##....##.....
# ..##..##.............##.....##.##.....##.##..........##.....
# ...########..........########..##.....##..######.....##.....
# ......##..##.........##........##.....##.......##....##.....
# ..##..##..##.........##........##.....##.##....##....##.....
# ...########..#######.##.........#######...######.....##.....
# ......##....................................................



# ..............................................................
# ...####...####..#####..######...######.##..##.######.##...##..
# ..##.....##..##.##..##...##.......##...##..##.##.....###.###..
# ...####..##..##.#####....##.......##...######.####...##.#.##..
# ......##.##..##.##..##...##.......##...##..##.##.....##...##..
# ...####...####..##..##...##.......##...##..##.######.##...##..
# ..............................................................

  if(isset($_POST["sortThem"])) :

    $now    = array("",",");
    $before = array("sort[]=","&");
    $sort   = str_replace($before,$now,$_POST["sort"]);
    $sort   = explode(",",$sort);

    $trece  = new $action($db,$conf);
    $trece->sort = $sort;
    $trece->sort();
    die();

  endif;

# .. END SORT THEM
# ..............................................................



# ...........................................................................
# ..##..##..........######.#####..######.######..####..#####..##.....######..
# ...####...........##.....##..##...##.....##...##..##.##..##.##.....##......
# ....##....######..####...##..##...##.....##...######.#####..##.....####....
# ...####...........##.....##..##...##.....##...##..##.##..##.##.....##......
# ..##..##..........######.#####..######...##...##..##.#####..######.######..
# ...........................................................................

  if(isset($_POST["pk"])) : # x-editable fields

    $trece        = new $action($db,$conf);
    $trece->field = $_POST["field"];
    $trece->value = $_POST["value"];
    $trece->pk    = $_POST["pk"];

    $trece->updateOneSingleField();

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
    $trece->name                = trim(preg_replace("/[[:blank:]]+/"," ",$cconf["default"]["name"]));
    $trece->sort               = 0;

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
    $trece->name                = "Copy of ".$_POST["clone_name"];
    $trece->ids_privileges      = $_POST["clone_ids_privileges"];
    $trece->sort                = 0;

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
    $trece->who = explode("↲",$_POST["delete_who"]);

    foreach($trece->who as $items) :

      $item = explode("|",$items);
      $trece->id = $item[0];
      $trece->{$cconf["img"]["ref"]}  = $item[1];

      $trece->deleteOne();
      $filename = $cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg";
      if(file_exists($conf["dir"]["images"].$conf["css"]["thumb_prefix"].$filename)):unlink($conf["dir"]["images"].$conf["css"]["thumb_prefix"].$filename);endif;
      if(file_exists($conf["dir"]["images"].$conf["css"]["icon_prefix"].$filename)):unlink($conf["dir"]["images"].$conf["css"]["icon_prefix"].$filename);endif;
      if(file_exists($conf["dir"]["images"].$filename)):unlink($conf["dir"]["images"].$filename);endif;

    endforeach;

    die();

  endif;

# .. END DELETE THEM
# ............................................................................



  $lCustom["pagetitle"][LANG] = $lCustom["admin_list"][LANG];

  $searchTarget = false;
  $searchWhat   = "";

  if(isset($conf["site"]["queryArray"]["wr"]) && $conf["site"]["queryArray"]["wr"]==$action) :

    $searchTarget = true;
    $searchWhat   = isset($conf["site"]["queryArray"]["wh"]) ? $conf["site"]["queryArray"]["wh"] : "" ;

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
  $trece->intimacy = 1;
  $stmt = $trece->readAll($page,$from_record_num,$records_per_page,$searchWhat);
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
          <h1><strong><?=$lCustom["pagetitle"][LANG];?></strong></h1>
        </div>
      </div>
    </div><!-- row -->



<?php require $conf["dir"]["includes"]."search.php"; ?>



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
          <a id="deleteThem" data-toggle="tooltip" data-placement="bottom" title="<?=$lCommon["multiple_delete"][LANG];?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
        </h4>



        <table class="table table-condensed sortable" style="margin:.5em 0;">
          <thead>
            <tr>
              <th><input type="checkbox" id="allnone"></th>
              <th><?=$lCustom["color"][LANG];?></th>
              <th><?=$lCommon["name"][LANG];?></th>
              <th><?=$lCustom["privileges"][LANG];?></th>
              <th style="text-align:right;"><?=$lCommon["actions"][LANG];?></th>
            </tr>
          </thead>
          <?php // foreach($array as $row) : ?>
          <?php for($i=0;$i<$rowcount_page;$i++) : ?>
          <tbody class="sortable-item" id="sort-<?=$trece->id[$i];?>">
            <tr class="handle">
              <td>
                <input type="checkbox" class="checkme" name="item" data-id="<?=$trece->id[$i]?>" value="<?=$trece->id[$i];?>|<?=$trece->{$cconf["img"]["ref"]}[$i];?>">
              </td>
              <td<?=$trece->id_status[$i]==0?" class=\"attenuate\"":"";?>>
                <div class="side-corner-tag">
                  <a href="<?=REALPATHLANG.$action."/".$conf["file"]["update"]."/".$trece->ref[$i].QUERYQ;?>">
                    <img src="<?=file_exists($conf["dir"]["images"].$conf["css"]["thumb_prefix"].$conf["css"]["avatar_prefix"]."0.jpg")?$conf["dir"]["images"].$conf["css"]["thumb_prefix"].$conf["css"]["avatar_prefix"]."0.jpg?".time():"https://fakeimg.pl/".$cconf["img"]["thumb_w"]."x".$cconf["img"]["thumb_h"]."/?text=Hierarchy";?>" class="img-thumbnail img-responsive" style="width:80px;" alt="<?=$trece->name[$i];?>">
                  </a>
                  <p><span style="background:#<?=$trece->color[$i];?>;width:140px;right:-50px;"></span></p>
              </td>
              <td<?=$trece->id_status[$i]==0?" class=\"attenuate\"":"";?>>
                <a href="<?=REALPATHLANG.$action."/".$conf["file"]["update"]."/".$trece->ref[$i].QUERYQ;?>"><?=$trece->name[$i];?></a>
              </td>
              <td<?=$trece->id_status[$i]==0?" class=\"attenuate\"":"";?>>
                <?=$trece->ids_privileges[$i];?>
              </td>
              <td nowrap style="text-align:right;">
                <a href="<?=REALPATHLANG.$action."/".$conf["file"]["update"]."/".$trece->ref[$i].QUERYQ;?>" data-toggle="tooltip" data-placement="bottom" title="<?=$lCommon["edit"][LANG];?>" class=""><i class="fa fa-pencil-square-o fa-fw" aria-hidden="true"></i></a>
                <a data-ref="<?=$trece->ref[$i];?>" data-name="<?=$trece->name[$i];?>" data-ids_privileges="<?=$trece->ids_privileges[$i];?>" data-toggle="tooltip" data-placement="bottom" title="<?=$lCommon["clone"][LANG];?>" class="clone-object" style="cursor:pointer;"><i class="fa fa-files-o fa-fw" aria-hidden="true"></i></a>
                <a href="<?=REALPATHLANG.$action."/".$trece->{$cconf["file"]["ref"]}[$i].QUERYQ;?>" data-toggle="tooltip" data-placement="bottom" title="<?=$lCommon["see"][LANG];?>" class="<?=$trece->id_status[$i]==0?"disabled ":"";?>"><i class="fa fa-eye fa-fw" aria-hidden="true"></i></a>
              </td>
            </tr>
          </tbody>
          <?php endfor; ?>
          <?php //endforeach; ?>
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



<?php
# ....................................................................
# ...####..##......####..##..##.######...######.##..##.######..####...
# ..##..##.##.....##..##.###.##.##.........##...##..##...##...##......
# ..##.....##.....##..##.##.###.####.......##...######...##....####...
# ..##..##.##.....##..##.##..##.##.........##...##..##...##.......##..
# ...####..######..####..##..##.######.....##...##..##.######..####...
# ....................................................................
?>

  <script>
    $(document).on("click",".clone-object",function(){
      var ref             =   $(this).data("ref");
      var name            =   $(this).data("name");
      var ids_privileges  =   $(this).data("ids_privileges");

      $.post("",{
        cloneThis:true,
        clone_ref:ref,
        clone_name:name,
        clone_ids_privileges:ids_privileges,
        },function(data){location.reload();}).fail(function(){alert("<?=addslashes($lCommon["cannot_be_cloned"][LANG]);?>");}); // alert(data) | location.reload()
      return false;
      });
  </script>

<?php
# .. END CLONE THIS
# ....................................................................
?>



<?php require_once($conf["dir"]["includes"]."javascript.php"); ?>



<?php require_once($conf["dir"]["includes"]."footer.php"); ?>
