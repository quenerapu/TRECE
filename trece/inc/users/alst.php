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

  if (!isset($what)) :

    header("location:".REALPATHLANG.$action."/".$conf["file"]["adminlist"]."/1".QUERYQ);
//  header("location:".REALPATHLANG.QUERYQ);
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
          \"name\":\"".html_entity_decode(str_replace(array('"',"'"),array('&#8243;','&#8242;'),($trece->name[$i].($trece->surname[$i]!=""?" ":"").$trece->surname[$i])))."\"
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
    $trece->username            = $cconf["default"]["username"];
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



//metastuff
  $lCustom["pagetitle"][LANG] = $lCustom["admin_list"][LANG];
  $lCustom["metadescription"][LANG] = "La metadescription"; # 160 char text
  $lCustom["metakeywords"] = "key word keyword";
  $lCustom["og_image"] = "https://ddfsdf.com"; # 1200x630 px image

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

  if($trece->firstTime()) :

    echo "<html><body style=\"padding:0;margin:0;\"><img src=\"https://fakeimg.pl/250x100/?text=".$action."\"></body></html>";
//  header("location:".REALPATHLANG.$action."/".$crudlpx."/1".QUERYQ);
    die();

  endif;

  $trece->intimacy = 1;
  $stmt = $trece->readAll($records_per_page,$page,$from_record_num,$searchWhat);
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



  <div class="container main-container" style="margin-bottom:10em;">



    <div class="row">
      <div class="col-xs-12 col-sm-10 col-sm-offset-1">
        <div class="page-header">
          <?php if($app->getUserHierarchy() == 1) : ?>
          <?php // $lacosa = "Questiontypes"; ?>
          <div class="pull-right"><p>
            <?=btn("!".$lCustom["new"][LANG],null,"add".(isset($lacosa)?"AndSelect":"")."Them","fa-plus");?>
<?php /*    <?=btn($lCommon["public_list"][LANG],"!".$action."/".$conf["file"]["publiclist"],"","fa-list");?> */ ?>
          </p></div>
          <?php endif; ?>
          <h1><strong><?=$lCustom["admin_list"][LANG];?></strong></h1>
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



        <table class="table table-condensed" style="margin:.5em 0;">
          <thead>
            <tr>
              <th><input type="checkbox" id="allnone"></th>
              <th><?=$lCustom["status"][LANG];?></th>
              <th><?=$lCommon["avatar"][LANG];?></th>
              <th><?=$lCommon["name"][LANG];?></th>
              <th style="text-align:right;"><!-- <?=$lCommon["actions"][LANG];?> --></th>
            </tr>
          </thead>
          <?php for($i=0;$i<$rowcount_page;$i++) : ?>
          <?php
            $hierarchy = explode("|",$trece->hierarchy[$i]);
            $hierarchy_color =  $hierarchy[1];
            $hierarchy =  $hierarchy[0];
          ?>
          <tbody id="tbody_<?=$trece->id[$i];?>">
            <tr id="tr_<?=$trece->id[$i]?>">
              <td>
                <input type="checkbox" class="checkme" name="item" data-id="<?=$trece->id[$i]?>" value="<?=$trece->id[$i];?>|<?=$trece->{$cconf["img"]["ref"]}[$i];?>">
              </td>
              <td>
                <a href="javascript:void(0);" class="change-status" style="text-decoration:none !important;" data-pk="<?=$trece->id[$i];?>" data-name="id_status" data-value="<?=$trece->id_status[$i];?>"><span class="label label-<?=$trece->id_status[$i]==1?"success":"danger";?>" style="padding-bottom:.1em;"><?=$trece->id_status[$i]==1?"ON":"OFF";?></span></a>
              </td>
              <td<?=$trece->id_status[$i]==0?" class=\"attenuate\"":"";?>>
                <div class="side-corner-tag">
                  <a href="<?=REALPATHLANG.$action."/".$conf["file"]["update"]."/".$trece->ref[$i].QUERYQ;?>">
                    <p><span style="background:#<?=$hierarchy_color;?>;width:130px;right:-50px;"></span></p>
                    <img src="<?=(file_exists($conf["dir"]["images"].$conf["css"]["thumb_prefix"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}[$i].".jpg")?$conf["dir"]["images"].$conf["css"]["thumb_prefix"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}[$i].".jpg?".time():(file_exists($conf["dir"]["images"].$conf["css"]["thumb_prefix"].$cconf["img"]["prefix"].$trece->ugender[$i].".jpg")?$conf["dir"]["images"].$conf["css"]["thumb_prefix"].$cconf["img"]["prefix"].$trece->ugender[$i].".jpg?".time():(file_exists($conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"]."0.jpg")?$conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"]."0.jpg?".time():"https://fakeimg.pl/".$cconf["img"]["thumb_w"]."x".$cconf["img"]["thumb_h"]."/?text=".$lCustom["singular"][LANG])));?>" class="img-thumbnail img-responsive" style="height:80px;" alt="<?=htmlspecialchars($trece->name[$i]." ".$trece->surname[$i]);?>">
                  </a>
                </div>
              </td>
              <td<?=$trece->id_status[$i]==0?" class=\"attenuate\"":"";?>>
                <a href="<?=REALPATHLANG.$action."/".$conf["file"]["update"]."/".$trece->ref[$i].QUERYQ;?>"><?=$trece->name[$i];?> <?=$trece->surname[$i];?></a><br>
                <small><strong><?=$hierarchy;?></strong> <?=strpos($trece->email[$i],"@")!==false?$trece->email[$i]:"<span class=\"label label-warning\">NO EMAIL</span>";?></small><br>
              </td>
              <td style="white-space:nowrap;text-align:right;">
                <div class="btn-group">
                  <a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i> <?=$lCommon["actions"][LANG];?> <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="<?=REALPATHLANG.$action."/".$conf["file"]["update"]."/".$trece->ref[$i].QUERYQ;?>"><i class="fa fa-pencil-square-o fa-fw" aria-hidden="true"></i> <?=$lCommon["edit"][LANG];?></a></li>
                    <li class="divider"></li>
                    <li><a data-id="<?=$trece->id[$i];?>" class="signout-object" style="cursor:pointer;"><i class="fa fa-sign-out fa-fw" aria-hidden="true"></i> <?=$lCommon["signout"][LANG];?></a></li>
                    <li><a href="mailto:<?=$trece->email[$i];?>" target="_blank"><i class="fa fa-envelope fa-fw" aria-hidden="true"></i> <?=$lCommon["send_email"][LANG];?></a></li>
                    <li><a href="<?=REALPATHLANG.$conf["file"]["forgot-pass"]."?m=".$trece->username[$i];?>" class="<?=$trece->id_status[$i]==0?"disabled ":"";?>"><i class="fa fa-key fa-fw" aria-hidden="true"></i> <?=$lCommon["password"][LANG];?></a></li>
                    <li><a data-ref="<?=$trece->ref[$i];?>" 
                           data-name="<?=htmlspecialchars($trece->name[$i]);?>" 
                           data-surname="<?=htmlspecialchars($trece->surname[$i]);?>" 
                           data-ugender="<?=$trece->ugender[$i];?>" 
                           data-uhierarchy="<?=$trece->uhierarchy[$i];?>" 
                           class="clone-object" style="cursor:pointer;"><i class="fa fa-files-o fa-fw" aria-hidden="true"></i> <?=$lCommon["clone"][LANG];?></a></li>
<?php /*
                    <li class="divider"></li>
                    <li><a href="<?=REALPATHLANG.$action."/".$trece->{$cconf["file"]["ref"]}[$i].QUERYQ;?>" class="<?=$trece->id_status[$i]==0?"disabled ":"";?>"><i class="fa fa-eye fa-fw" aria-hidden="true"></i> <?=$lCommon["see"][LANG];?></a></li>
*/ ?>
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



<!-- Sign out this user -->
  <script>
    $(document).on("click",".signout-object",function(){
      var who = $(this).data("id");

      $.post("",{
        signoutThisUser:true,
        signout_who:who,
        },function(data){
        location.reload();
//      alert(data);
        }).fail(function(){alert("<?=addslashes($lCommon["cannot_be_logged_out"][LANG]);?>");});
      return false;
      });
  </script>



<!-- Clone This -->
  <script>
    $(document).on("click",".clone-object",function(){
      var ref             =   $(this).data("ref");
      var name            =   $(this).data("name");
      var surname         =   $(this).data("surname");
      var ugender         =   $(this).data("ugender");
      var uhierarchy      =   $(this).data("uhierarchy");

      $.post("",{
        cloneThis:true,
        clone_ref:ref,
        clone_name:name,
        clone_surname:surname,
        clone_ugender:ugender,
        clone_uhierarchy:uhierarchy,
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
