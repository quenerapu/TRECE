<?php if(!defined("TRECE")):header("location:./");die();endif; ?>
<?php
//LANGUAGES

# .........................................................................................
# ..##..........###....##....##..######...##.....##....###.....######...########..######...
# ..##.........##.##...###...##.##....##..##.....##...##.##...##....##..##.......##....##..
# ..##........##...##..####..##.##........##.....##..##...##..##........##.......##........
# ..##.......##.....##.##.##.##.##...####.##.....##.##.....##.##...####.######....######...
# ..##.......#########.##..####.##....##..##.....##.#########.##....##..##.............##..
# ..##.......##.....##.##...###.##....##..##.....##.##.....##.##....##..##.......##....##..
# ..########.##.....##.##....##..######....#######..##.....##..######...########..######...
# .........................................................................................

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
          \"value\":\"".$trece->url_name[$i]."\",
          \"name\":\"".html_entity_decode(str_replace(array('"',"'"),array('&#8243;','&#8242;'),$trece->name[$i]))."\"
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

    endforeach;

    die();

  endif;

# .. END DELETE THEM
# ............................................................................



//metastuff
  $lCustom["pagetitle"] = $lCustom["admin_list"][LANG];
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



  <div class="container main-container">



    <div class="row">
      <div class="col-xs-12 col-sm-10 col-sm-offset-1">
        <div class="page-header">
          <?php if($app->getUserHierarchy() == 1) : ?>
          <?php // $lacosa = "Questiontypes"; ?>
          <div class="pull-right"><p>
            <?=btn("!".$lCustom["new"][LANG],null,"add".(isset($lacosa)?"AndSelect":"")."Them","fa-plus");?>
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
          <a id="deleteThem" data-toggle="tooltip" data-placement="bottom" title="<?=$lCommon["multiple_delete"][LANG];?>"><i class="fas fa-trash"></i></a>
        </h4>



        <table class="table table-condensed" style="margin:.5em 0;">
          <thead>
            <tr>
              <th><input type="checkbox" id="allnone"></th>
              <th><?=$lCustom["status"][LANG];?></th>
              <th><?=$lCommon["name"][LANG];?></th>
              <th><?=$lCustom["url_name"][LANG];?></th>
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
                <a href="javascript:void(0);" class="name editable editable-click" data-type="text" data-pk="<?=$trece->id[$i];?>" data-name="name"><?=$trece->name[$i];?></a>
              </td>
              <td<?=$trece->id_status[$i]==0?" class=\"attenuate\"":"";?>>
                <code><a href="javascript:void(0);" class="url_name editable editable-click" data-type="text" data-pk="<?=$trece->id[$i];?>" data-name="url_name"><?=$trece->url_name[$i];?></a></code>
              </td>
              <td style="white-space:nowrap;text-align:right;">
                <div class="btn-group">
                  <a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=$lCommon["actions"][LANG];?> <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a data-ref="<?=$trece->ref[$i];?>"
                           data-name="<?=htmlspecialchars($trece->name[$i]);?>" 
                           data-url_name="<?=htmlspecialchars($trece->url_name[$i]);?>" 
                           class="clone-object" style="cursor:pointer;"><i class="far fa-clone fa-fw"></i> <?=$lCommon["clone"][LANG];?></a></li>
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
      var name            =   $(this).data("name");
      var url_name        =   $(this).data("url_name");

      $.post("",{
        cloneThis:true,
        clone_ref:ref,
        clone_name:name,
        clone_url_name:url_name,
        },function(data){
//      alert(data);
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

      $(".name").editable(
        {
          url:window.location.href,
          mode:"inline", //popup
//        placement:"right",
          showbuttons:false,
          success:function(response,newValue){
  //        alert(JSON.stringify(params,null,4));
            if(response.length>0){
              $.alert({type:"red",content:"<?=$lCommon["duplicated_name"][LANG];?>",closeIcon:true,closeIconClass:"fa fa-close",buttons:{confirm:{text:"OK",btnClass:"btn-red",keys:["enter"],action:function(){}}}});
              }
              id = $(this).data("pk")+""; /* https://stackoverflow.com/a/36483219 */
              if(id.indexOf("|")>=0){id=id.split("|");id=id[0];}
              $(this).closest("tbody").load(location.href+" #tr_"+id);
              setTimeout(startxEditable,2000);
            }
        }
        ).on("shown",function(ev,editable){setTimeout(function(){editable.input.$input.select();},0);}
        ).on("save",function(e,params){
          });

      $(".url_name").editable(
        {
          url:window.location.href,
          mode:"inline", //popup
//        placement:"right",
          showbuttons:false,
          success:function(response,newValue){
  //        alert(JSON.stringify(params,null,4));
            if(response.length>0){
              $.alert({type:"red",content:"<?=$lCustom["duplicated_url_name"][LANG];?>",closeIcon:true,closeIconClass:"fa fa-close",buttons:{confirm:{text:"OK",btnClass:"btn-red",keys:["enter"],action:function(){}}}});
              }
              id = $(this).data("pk")+""; /* https://stackoverflow.com/a/36483219 */
              if(id.indexOf("|")>=0){id=id.split("|");id=id[0];}
              $(this).closest("tbody").load(location.href+" #tr_"+id);
              setTimeout(startxEditable,2000);
            }
        }
        ).on("shown",function(ev,editable){setTimeout(function(){editable.input.$input.select();},0);}
        ).on("save",function(e,params){
          });

      };

  </script>



<?php require_once($conf["dir"]["includes"]."javascript.php"); ?>



<?php require_once($conf["dir"]["includes"]."footer.php"); ?>
