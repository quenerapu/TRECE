<?php if(!defined("TRECE")):header("location:./");die();endif; ?>
<?php



//Included or not?

  if(!isset($included)) :

    $included = false;

  else :

    $cconf    = require($conf["dir"]["includes"].$action."/".$conf["file"]["conf"].".php");
    $lCustom  = require($conf["dir"]["includes"].$action."/".$conf["file"]["i18n"].".php");

  endif;



//No $what? Load page 1!

  if(!isset($what)) :

    header("location:".REALPATHLANG.$action."/".$crudlpx."/1".QUERYQ);
    die();

  endif;



//Still here? OK, let's talk.

  require_once($conf["dir"]["includes"].$action."/".$conf["file"]["crud"].".php");



# ..........................
# ...####....####...##..##..
# ..##..##..##......##..##..
# ..##.......####...##..##..
# ..##..##......##...####...
# ...####....####.....##....
# ..........................

  $csv = null; if(isset($_GET["csv"])) : $csv = true; endif;



# ...............................
# ..######..####...####..##..##..
# ......##.##.....##..##.###.##..
# ......##..####..##..##.##.###..
# ..##..##.....##.##..##.##..##..
# ...####...####...####..##..##..
# ...............................

  $json = null; if(isset($_GET["json"])) : $json = true; endif;
/*
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
*/
# .. END JSON
# ...............................



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
  $lCustom["pagetitle"] = $lCustom["list"][LANG];
//$lCustom["metadescription"] = strip_tags("Custom metadescription goes here"); # 160 char text
//$lCustom["metakeywords"] = strip_tags("Custom keywords go here");
//$lCustom["og_image"] = "https://custom.url/image-goes-here"; # 1200x630 px image

  $searchTarget = false;
  $searchWhat   = "";

  if(isset($conf["site"]["queryArray"]["wr"]) && $conf["site"]["queryArray"]["wr"]==$action) :

    $searchTarget = true;
    $searchWhat   = isset($conf["site"]["queryArray"]["search"]) ? $conf["site"]["queryArray"]["search"] : "" ;

  endif;

  $page = $what;



//Pagination Part 1

  $records_per_page = $included ? 200 : 5;
  $max_columns = 3;
  $from_record_num = ($records_per_page*$page)-$records_per_page;
  $from_record_num_prev = ($records_per_page*($page-1))-$records_per_page;

//End of Pagination Part 1



  $trece = new $action($db,$conf);

  if($trece->firstTime()) :

    echo '<html style="padding:0;margin:0;"><head><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width,initial-scale=1"></head><body style="padding:0;margin:0;"><img src="https://fakeimg.pl/250x100/?text='.$action.'"></body></html>';
    die();

  endif;

  $trece->intimacy = 1; #Intimacy 0 : For owner's eyes | Intimacy 1 : For admin's eyes | Intimacy 2 : Public
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



  $url = REALPATHLANG.($included?$back:$action)."/".$crudlpx."/1";

  $customJS = <<<EOD
<script>
    \$(function(){\$("#search + .undo").on("click",function(){location.replace("{$url}");});});
  </script>

EOD;

  unset($url);

  $customCSS = <<<EOD
<style>
    form span.search{position:relative;}
    form.search p{float:left;width:100%;margin-right:1rem;}
    form span.search input[type="text"]{width:100%;padding-left:3rem;}
    form span.search .undo{position:absolute;display:flex;cursor:pointer;left:.7rem;top:.2rem;}

    div.pager{display:inline-block;margin:3rem 0;padding:1rem;border:1px dotted #999;}
    div.pager a{color:#999;font-weight:bold;float:left;padding:8px 16px;text-decoration:none;transition:background-color .3s;}
    div.pager a.active{background-color:#4caf50;color:white;}
    div.pager a.disabled{color:#999;}
    div.pager a:hover:not(.disabled):not(.active){background-color:#ddd;}
    #allnone,.checkme{margin:0 1rem 0 0;}
    .thumbnail{width:10rem;min-width:10rem;max-width:10rem;}
    .flipped-arrow{font-size:2rem;padding-right:.4rem;
    display: inline-block;
    display: -moz-inline-box;
    -moz-box-orient: vertical;
    vertical-align: top;
    zoom: 1;
    *display: inline;
    display:inline-block;
  -moz-transform: scale(-1, 1);
  -webkit-transform: scale(-1, 1);
  -o-transform: scale(-1, 1);
  -ms-transform: scale(-1, 1);
  transform: scale(-1, 1);}




/* JMenu 1.0 RC1 | MIT License | https://github.com/jamesjohnson280/JMenu */
.jmenu{background:#ddd;box-sizing:border-box;line-height:1;max-width:50px;}
label.jm-menu-btn{color:black;cursor:pointer;display:block;padding:16px;}
label.jm-menu-btn:hover{color:black;}
.jm-collapse{border-bottom:4px green solid;}
.jmenu ul,.jmenu li{list-style:none;margin:0;padding:0;}
.jmenu a{color:black;display:inline-block;padding:0;text-decoration:none;}
.jmenu a:hover{color:black;}
.jmenu ul ul{display:none;}
.jm-dropdown:hover ul{display:block;}
.jm-dropdown ul{background:red;padding:0;}
.jm-dropdown ul a,.jm-dropdown:hover ul a{color:white;}
.jm-dropdown ul a:hover,.jm-dropdown:hover ul a:hover{color:#000;}
@media (min-width: 768px){
  .jmenu li{display:inline-block;}
  .jmenu a{padding:16px;}
  .jm-dropdown{position:relative;}
  .jm-dropdown li a{display:block;padding:8px 16px;white-space:nowrap;}
  .jm-dropdown ul{box-shadow:1px 1px 3px 0 rgba(0,0,0,.5);padding:8px 0;position:absolute;}
  }







    @media(max-width:25rem){
      main .row.row-responsive .column.column-offset-xs-50{margin-left:0}
      main .row.row-responsive .column.column-xs-50{flex:0 0 100%;max-width:100%}
      }
    @media(min-width:25rem) and (max-width:40rem){
      main .row{flex-direction:row;}
      main .row .column{margin-bottom:inherit;padding:0 1rem;}
      }
    @media(min-width:25rem) and (max-width:32rem){
      form.search .row .column.column-xs-60{flex:0 0 50%;max-width:50%;}
      }
    @media(min-width:32rem) and (max-width:38rem){
      form.search .row .column.column-xs-60{flex:0 0 45%;max-width:45%;}
      }
    @media(min-width:38rem) and (max-width:50rem){
      form.search .row .column.column-xs-60{flex:0 0 35%;max-width:35%;}
      }
    @media(min-width:50rem) and (max-width:80rem){
      form.search .row .column.column-xs-60{flex:0 0 25%;max-width:25%;}
      }
  </style>

EOD;



  require_once($conf["dir"]["themes"].$conf["trece"]["theme"]."/"."header.php");
  require_once($conf["dir"]["themes"].$conf["trece"]["theme"]."/"."nav.php");

?>



<div class="container">

  <div class="row">

    <div class="column">

      <div class="float-right">
        <p class="text-right"><a class="button <?="add".(isset($lacosa)?"AndSelect":"")."Them";?>" style="margin-bottom:0;"><i class="fas fa-plus"></i> <?=$lCustom["new"][LANG];?></a><br><small>(<strong>Alt+click</strong> for multiple)</small></p>
      </div>
      <h1 style="margin-top:-.2em !important;"><?=$lCustom["pagetitle"];?></h1>

    </div>

  </div>

<?php require_once($conf["dir"]["themes"].$conf["trece"]["theme"]."/"."search.php"); ?>

  <div class="row row-responsive">

    <div class="column">

<?php if($rowcount_page>0): ?>

      <div class="float-right">
        <p><strong><?=$trece->rowcount_absolute;?> <?=$trece->rowcount_absolute == 1 ? $lCommon["result"][LANG] : $lCommon["results"][LANG];?></strong></p>
      </div>

      <table>
        <thead>
          <tr>
            <th>
              <p>
                <span class="flipped-arrow">↴</span><a id="deleteThem"><i class="fas fa-trash"></i></a><br>
                <input type="checkbox" id="allnone">
              </p>
            </th>
            <th><?=$lCommon["avatar"][LANG];?></th>
            <th><?=$lCommon["name"][LANG];?></th>
            <th class="text-right"></th>
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
            <td class="nowrap">
              <input type="checkbox" class="checkme" name="item" data-id="<?=$trece->id[$i]?>" value="<?=$trece->id[$i];?>|<?=$trece->{$cconf["img"]["ref"]}[$i];?>"><a href="javascript:void(0);" class="button change-status<?=$trece->id_status[$i]==1?" on":" off";?>" data-pk="<?=$trece->id[$i];?>" data-name="id_status" data-value="<?=$trece->id_status[$i];?>"><?=$trece->id_status[$i]==1?"ON":"OFF";?></a>
            </td>
            <td class="avatar">
              <div class="ribbon-box">
                <?php $hierarchy = explode("|",$trece->hierarchy[$i]); $hierarchy_color =  $hierarchy[1]; $hierarchy =  $hierarchy[0]; ?>
                <div class="ribbon small-ribbon ribbon-top-left"><span style="background:#<?=$hierarchy_color;?>"></span></div>
                <a href="<?=REALPATHLANG.$action."/".$trece->{$cconf["file"]["ref"]}[$i].QUERYQ;?>">
                  <img src="<?=(file_exists($conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}[$i].".jpg")?$conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}[$i].".jpg?".time():(file_exists($conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"].$trece->ugender[$i].".jpg")?$conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"].$trece->ugender[$i].".jpg?".time():(file_exists($conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"]."0.jpg")?$conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"]."0.jpg?".time():"https://fakeimg.pl/".$cconf["img"]["icon_w"]."x".$cconf["img"]["icon_h"]."/?text=".$lCustom["singular"][LANG])));?>" class="thumbnail" alt="<?=htmlspecialchars($trece->name[$i]." ".$trece->surname[$i]);?>">
                </a>
              </div>
            </td>
            <td>
              <a href="<?=REALPATHLANG.$action."/".$conf["file"]["update"]."/".$trece->ref[$i].QUERYQ;?>"><?=$trece->name[$i];?> <?=$trece->surname[$i];?></a><br>
              <small><strong><?=$hierarchy;?></strong> <?=strpos($trece->email[$i],"@")!==false?$trece->email[$i]:"<span class=\"label label-warning\">NO EMAIL</span>";?></small><br>
            </td>
            <td>

              <nav class="jmenu">
                <ul class="jm-collapse">
                  <li class="jm-dropdown">
                    <a href="javascript:void(0)">Q</a>
                    <ul>
                      <li><a href="javascript:void(0)">Apples</a></li>
                      <li><a href="javascript:void(0)">Bananas and Pears</a></li>
                      <li><a href="javascript:void(0)">Oranges</a></li>
                    </ul>
                  </li>
                </ul>
              </nav>

            </td>


          </tr>
        </tbody>
        <?php endfor; ?>


      </table>


      <?php else : ?>

        <div class="alert alert-danger">
          <?php if($trece->rowcount_absolute > 0) : ?>
              <?=$lCommon["few_data"][LANG];?>
          <?php else : ?>
              <?=$lCommon["no_data"][LANG];?>
          <?php endif; ?>
        </div>

      <?php endif; ?>


    </div>
    </div>
    </div>



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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/<?=$conf["version"]["x-editable"];?>/jqueryui-editable/js/jqueryui-editable.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/<?=$conf["version"]["x-editable"];?>/jquery-editable/jquery-ui-datepicker/css/redmond/jquery-ui-1.10.3.custom.min.css">
  <script>

    $(document).ready(function(){startxEditable();});

    function startxEditable(){
      };

  </script>



<?php require_once($conf["dir"]["includes"]."javascript.php"); ?>
<?php require_once($conf["dir"]["themes"].$conf["trece"]["theme"]."/"."footer.php"); ?>