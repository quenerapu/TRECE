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



  $url = REALPATHLANG.($included?$back:$action)."/".$crudlpx."/1";

  $customJS = <<<EOD
<script>
    \$(function(){\$("#search + .trash").on("click",function(){location.replace("{$url}");});});
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

      <h1><a href="<?=REALPATHLANG.$action."/".$conf["file"]["publiclist"];?>"><?=$lCustom["pagetitle"];?></a></h1>

    </div>

  </div>

<?php require_once($conf["dir"]["themes"].$conf["trece"]["theme"]."/"."search.php"); ?>

<?php if($rowcount_page>0): ?>

  <div class="row row-responsive">

<?php $sum = 1; for($i=0;$i<$rowcount_page;$i++) : ?>

    <div class="column column-xs-50 column-sm-33 column-md-25 column-lg-20">

      <div class="ribbon-box">

        <?php $hierarchy = explode("|",$trece->hierarchy[$i]); $hierarchy_color =  $hierarchy[1]; $hierarchy =  $hierarchy[0]; ?>

        <div class="ribbon ribbon-top-left"><span style="background:#<?=$hierarchy_color;?>"></span></div>

        <a href="<?=REALPATHLANG.$action."/".$trece->{$cconf["file"]["ref"]}[$i].QUERYQ;?>">
          <img src="<?=(file_exists($conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}[$i].".jpg")?$conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}[$i].".jpg?".time():(file_exists($conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"].$trece->ugender[$i].".jpg")?$conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"].$trece->ugender[$i].".jpg?".time():(file_exists($conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"]."0.jpg")?$conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"]."0.jpg?".time():"https://fakeimg.pl/".$cconf["img"]["icon_w"]."x".$cconf["img"]["icon_h"]."/?text=".$lCustom["singular"][LANG])));?>" class="img-thumbnail img-responsive" style="width:100%;min-width:100%;max-width:100%;" alt="<?=htmlspecialchars($trece->name[$i]." ".$trece->surname[$i]);?>">
        </a>
        <h4><a href="<?=REALPATHLANG.$action."/".$trece->{$cconf["file"]["ref"]}[$i].QUERYQ;?>"><?=mb_strtoupper($trece->name[$i]." ".$trece->surname[$i],"UTF-8");?></a></h4>

      </div>

    </div>

<?php $sum++; endfor; ?>

  </div>

<?php endif; ?>

<?php if($trece->rowcount_absolute > $records_per_page): require $conf["dir"]["themes"].$conf["trece"]["theme"]."/"."pager.php"; endif; ?>

</div>



<?php require_once($conf["dir"]["themes"].$conf["trece"]["theme"]."/"."footer.php"); ?>