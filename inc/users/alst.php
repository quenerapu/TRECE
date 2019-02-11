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

    header("location:".$conf["site"]["realpathLang"].$action."/".$conf["file"]["publiclist"].$conf["site"]["queryq"]);
    die();

  endif;



//No $what? Load page 1!

  if ( !isset($what) ) :

    header("location:".$conf["site"]["realpathLang"].$action."/".$crudlpx."/1".$conf["site"]["queryq"]);
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
    $trece->surname             = trim(preg_replace("/[[:blank:]]+/"," ",$cconf["default"]["surname"]));
    $trece->username            = trim(preg_replace("/[[:blank:]]+/"," ",$cconf["default"]["username"]));
    $trece->email               = $cconf["default"]["email"];
    $trece->uhierarchy          = $cconf["default"]["uhierarchy"];
    $trece->ugender             = $cconf["default"]["ugender"];

    if($howMany > 0 && $howMany <= $cconf["default"]["max_new_items"]) :

      $i=1; do{$trece->addOne();$i++;}while($i<=$howMany);

    endif;

    die();

  endif;

# .. END ADD THEM
# .......................................................



# ..................................................................................................................
# ...####..######..####..##..##....####..##..##.######...######.##..##.######..####....##..##..####..######.#####...
# ..##.......##...##.....###.##...##..##.##..##...##.......##...##..##...##...##.......##..##.##.....##.....##..##..
# ...####....##...##.###.##.###...##..##.##..##...##.......##...######...##....####....##..##..####..####...#####...
# ......##...##...##..##.##..##...##..##.##..##...##.......##...##..##...##.......##...##..##.....##.##.....##..##..
# ...####..######..####..##..##....####...####....##.......##...##..##.######..####.....####...####..######.##..##..
# ..................................................................................................................

  if(isset($_POST["signoutThisUser"])) :

    $trece = new $action($db,$conf);
    $trece->who = $_POST["signout_who"];
    $trece->signoutOne();
    die();

  endif;

# .. END SIGN OUT THIS USER
# ...........................................................................



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
    $trece->surname             = $_POST["clone_surname"];
    $trece->username            = $_POST["clone_username"];
    $trece->email               = $cconf["default"]["email"];
    $trece->uhierarchy          = $_POST["clone_uhierarchy"];
    $trece->ugender             = $_POST["clone_ugender"];

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

      if($trece->id != 1) :

        $trece->deleteOne();
        $filename = $cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg";
        if(file_exists($conf["dir"]["images"].$conf["css"]["thumb_prefix"].$filename)):unlink($conf["dir"]["images"].$conf["css"]["thumb_prefix"].$filename);endif;
        if(file_exists($conf["dir"]["images"].$conf["css"]["icon_prefix"].$filename)):unlink($conf["dir"]["images"].$conf["css"]["icon_prefix"].$filename);endif;
        if(file_exists($conf["dir"]["images"].$filename)):unlink($conf["dir"]["images"].$filename);endif;

      endif;

    endforeach;

    die();

  endif;

# .. END DELETE THEM
# ............................................................................



  $lCustom["pagetitle"][$conf["site"]["lang"]] = $lCustom["admin_list"][$conf["site"]["lang"]];

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
//$rowcount_page = $stmt->rowCount();
  $rowcount_page = $trece->rowcount;

  if(!$included && ($rowcount_page == 0 && $page>1)) :

    header("location:".$conf["site"]["realpathLang"].$action."/".$crudlpx."/1".$conf["site"]["queryq"]);
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
            <?=btn("!".$lCustom["new"][$conf["site"]["lang"]],null,"add".(isset($lacosa)?"AndSelect":"")."Them","fa-plus");?>
            <?=btn($lCommon["public_list"][$conf["site"]["lang"]],"!".$action."/".$conf["file"]["publiclist"],"","fa-list");?>
          </p></div>
          <?php endif; ?>
          <h1><strong><?=$lCustom["pagetitle"][$conf["site"]["lang"]];?></strong></h1>
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
          <strong><?=$trece->rowcount_absolute;?> resultado<?=$trece->rowcount_absolute == 1 ? "" : "s";?></strong>
        </p></div>
        <h4>
          <a id="deleteThem" data-toggle="tooltip" data-placement="bottom" title="<?=$lCommon["multiple_delete"][$conf["site"]["lang"]];?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
        </h4>



        <table class="table table-condensed" style="margin:.5em 0;">
          <thead>
            <tr>
              <th><input type="checkbox" id="allnone"></th>
              <th><?=$lCommon["avatar"][$conf["site"]["lang"]];?></th>
              <th><?=$lCommon["name"][$conf["site"]["lang"]];?></th>
              <th style="text-align:right;"><?=$lCommon["actions"][$conf["site"]["lang"]];?></th>
            </tr>
          </thead>
          <?php // foreach($array as $row) : ?>
          <?php for($i=0;$i<$rowcount_page;$i++) : ?>
          <?php
            $hierarchy = explode("|",$trece->hierarchy[$i]);
            $hierarchy_color =  $hierarchy[1];
            $hierarchy =  $hierarchy[0];
          ?>
          <tbody>
            <tr>
              <td>
                <input type="checkbox" class="checkme" name="item" data-id="<?=$trece->id[$i]?>" value="<?=$trece->id[$i];?>|<?=$trece->{$cconf["img"]["ref"]}[$i];?>">
              </td>
              <td<?=$trece->id_status[$i]==0?" class=\"attenuate\"":"";?>>
                <div class="side-corner-tag">
                  <a href="<?=$conf["site"]["realpathLang"].$action."/".$conf["file"]["update"]."/".$trece->ref[$i].$conf["site"]["queryq"];?>">
                    <p><span style="background:#<?=$hierarchy_color;?>;width:130px;right:-50px;"></span></p>
                    <img src="<?=(file_exists($conf["dir"]["images"].$conf["css"]["thumb_prefix"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}[$i].".jpg")?$conf["dir"]["images"].$conf["css"]["thumb_prefix"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}[$i].".jpg?".time():(file_exists($conf["dir"]["images"].$conf["css"]["thumb_prefix"].$cconf["img"]["prefix"].$trece->ugender[$i].".jpg")?$conf["dir"]["images"].$conf["css"]["thumb_prefix"].$cconf["img"]["prefix"].$trece->ugender[$i].".jpg?".time():(file_exists($conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"]."0.jpg")?$conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"]."0.jpg?".time():"https://fakeimg.pl/".$cconf["img"]["thumb_w"]."x".$cconf["img"]["thumb_h"]."/?text=".$lCustom["singular"][$conf["site"]["lang"]])));?>" class="img-thumbnail img-responsive" style="width:80px;" alt="<?=$trece->name[$i];?>">
                  </a>
                </div>
              </td>
              <td<?=$trece->id_status[$i]==0?" class=\"attenuate\"":"";?>>
                <a href="<?=$conf["site"]["realpathLang"].$action."/".$conf["file"]["update"]."/".$trece->ref[$i].$conf["site"]["queryq"];?>"><?=$trece->name[$i];?> <?=$trece->surname[$i];?></a><br>
                <small><strong><?=$hierarchy;?></strong> <?=strpos($trece->email[$i],"@")!==false?$trece->email[$i]:"<span class=\"label label-warning\">NO EMAIL</span>";?></small><br>
              </td>
              <td nowrap style="text-align:right;">
                <div class="btn-group">
                  <a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i> <?=$lCommon["actions"][$conf["site"]["lang"]];?> <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="<?=$conf["site"]["realpathLang"].$action."/".$conf["file"]["update"]."/".$trece->ref[$i].$conf["site"]["queryq"];?>"><i class="fa fa-pencil-square-o fa-fw" aria-hidden="true"></i> <?=$lCommon["edit"][$conf["site"]["lang"]];?></a></li>
                    <li class="divider"></li>
                    <li><a data-id="<?=$trece->id[$i];?>" class="signout-object" style="cursor:pointer;"><i class="fa fa-sign-out fa-fw" aria-hidden="true"></i> <?=$lCommon["signout"][$conf["site"]["lang"]];?></a></li>
                    <li><a href="mailto:<?=$trece->email[$i];?>" target="_blank"><i class="fa fa-envelope fa-fw" aria-hidden="true"></i> <?=$lCommon["send_email"][$conf["site"]["lang"]];?></a></li>
                    <li><a href="<?=$conf["site"]["realpathLang"].$conf["file"]["forgot-pass"]."?m=".$trece->username[$i];?>" class="<?=$trece->id_status[$i]==0?"disabled ":"";?>"><i class="fa fa-key fa-fw" aria-hidden="true"></i> <?=$lCommon["password"][$conf["site"]["lang"]];?></a></li>
                    <li><a data-ref="<?=$trece->ref[$i];?>" data-name="<?=$trece->name[$i];?>" data-surname="<?=$trece->surname[$i];?>" data-username="<?=$trece->username[$i];?>" data-ugender="<?=$trece->ugender[$i];?>" data-uhierarchy="<?=$trece->uhierarchy[$i];?>" class="clone-object" style="cursor:pointer;"><i class="fa fa-files-o fa-fw" aria-hidden="true"></i> <?=$lCommon["clone"][$conf["site"]["lang"]];?></a></li>
                    <li class="divider"></li>
                    <li><a href="<?=$conf["site"]["realpathLang"].$action."/".$trece->{$cconf["file"]["ref"]}[$i].$conf["site"]["queryq"];?>" class="<?=$trece->id_status[$i]==0?"disabled ":"";?>"><i class="fa fa-eye fa-fw" aria-hidden="true"></i> <?=$lCommon["see"][$conf["site"]["lang"]];?></a></li>
                  </ul>
                </div>



<?php /*
                <a data-id="<?=$trece->id[$i];?>" data-toggle="tooltip" data-placement="bottom" title="<?=$lCommon["clone"][$conf["site"]["lang"]];?>" class="signout-object" style="cursor:pointer;"><i class="fa fa-files-o fa-fw" aria-hidden="true"></i></a>

                <a href="mailto:<?=$trece->email[$i];?>" data-toggle="tooltip" data-placement="bottom" title="<?=$lCommon["send_email"][$conf["site"]["lang"]];?>" class="" target="_blank"><i class="fa fa-envelope fa-fw" aria-hidden="true"></i></a>
                <a href="<?=$conf["site"]["realpathLang"].$conf["file"]["forgot-pass"]."?m=".$trece->username[$i];?>" data-toggle="tooltip" data-placement="bottom" title="<?=$lCommon["password"][$conf["site"]["lang"]];?>" class="<?=$trece->id_status[$i]==0?"disabled ":"";?>"><i class="fa fa-key fa-fw" aria-hidden="true"></i></a>
                <a href="<?=$conf["site"]["realpathLang"].$action."/".$conf["file"]["update"]."/".$trece->ref[$i].$conf["site"]["queryq"];?>" data-toggle="tooltip" data-placement="bottom" title="<?=$lCommon["edit"][$conf["site"]["lang"]];?>" class=""><i class="fa fa-pencil-square-o fa-fw" aria-hidden="true"></i></a>
                <a data-ref="<?=$trece->ref[$i];?>" data-name="<?=$trece->name[$i];?>" data-surname="<?=$trece->surname[$i];?>" data-username="<?=$trece->username[$i];?>" data-ugender="<?=$trece->ugender[$i];?>" data-uhierarchy="<?=$trece->uhierarchy[$i];?>" data-toggle="tooltip" data-placement="bottom" title="<?=$lCommon["clone"][$conf["site"]["lang"]];?>" class="clone-object" style="cursor:pointer;"><i class="fa fa-files-o fa-fw" aria-hidden="true"></i></a>
                <a href="<?=$conf["site"]["realpathLang"].$action."/".$trece->{$cconf["file"]["ref"]}[$i].$conf["site"]["queryq"];?>" data-toggle="tooltip" data-placement="bottom" title="<?=$lCommon["see"][$conf["site"]["lang"]];?>" class="<?=$trece->id_status[$i]==0?"disabled ":"";?>"><i class="fa fa-eye fa-fw" aria-hidden="true"></i></a>
*/ ?>
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
              <?=$lCommon["few_data"][$conf["site"]["lang"]];?>
          <?php else : ?>
              <?=$lCommon["no_data"][$conf["site"]["lang"]];?>
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
# ...........................................................................
# ..##......####...####...####..##..##.######...######.##..##.######..####...
# ..##.....##..##.##.....##..##.##..##...##.......##...##..##...##...##......
# ..##.....##..##.##.###.##..##.##..##...##.......##...######...##....####...
# ..##.....##..##.##..##.##..##.##..##...##.......##...##..##...##.......##..
# ..######..####...####...####...####....##.......##...##..##.######..####...
# ...........................................................................
?>

  <script>
    $(document).on("click",".signout-object",function(){
      var who = $(this).data("id");

      $.post("",{
        signoutThisUser:true,
        signout_who:who,
        },function(data){
        location.reload();
//      alert(data);
        }).fail(function(){alert("<?=addslashes($lCommon["cannot_be_cloned"][$conf["site"]["lang"]]);?>");});
      return false;
      });
  </script>

<?php
# .. END CLONE THIS
# ....................................................................
?>



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
      var surname         =   $(this).data("surname");
      var username        =   $(this).data("username");
      var ugender         =   $(this).data("ugender");
      var uhierarchy      =   $(this).data("uhierarchy");

      $.post("",{
        cloneThis:true,
        clone_ref:ref,
        clone_name:name,
        clone_surname:surname,
        clone_username:username,
        clone_ugender:ugender,
        clone_uhierarchy:uhierarchy,
        },function(data){location.reload();}).fail(function(){alert("<?=addslashes($lCommon["cannot_be_cloned"][$conf["site"]["lang"]]);?>");}); // alert(data) | location.reload()
      return false;
      });
  </script>

<?php
# .. END CLONE THIS
# ....................................................................
?>



<?php unset($trece); ?>



<?php require_once($conf["dir"]["includes"]."javascript.php"); ?>



<?php require_once($conf["dir"]["includes"]."footer.php"); ?>
