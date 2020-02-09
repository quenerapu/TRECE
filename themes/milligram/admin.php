<?php if(!defined("TRECE")):header("location:./");die();endif; ?>
<?php

  if(!$app->getUserSignInStatus()) :

    header("location:".REALPATHLANG.$conf["file"]["signin"].QUERYQ);
    die();

  endif;



  $basedir = $conf["site"]["dir"]."/".$conf["dir"]["includes"];
  $subdirs = array();
  $dirtocheck = scandir($basedir);
  foreach($dirtocheck as $item) :
    if(
         $item!=".." 
      && $item!="." 
      && is_dir($basedir."/".$item) 
      && $item[0]!="_" 
      && file_exists($basedir."/".$item."/tables.sql")
      ) :
      array_push($subdirs,$item);
      $last = end($subdirs);
    endif;
  endforeach;



  if(count($subdirs)>0) :

  $customJS = <<<EOD
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sprintf/{$conf["version"]["sprintf"]}/sprintf.min.js"></script>
  <script>
    $("#{$last}").on("load",setTimeout(function(){window.location.href=window.location.href;},3000));
  </script>

EOD;

  else :
  $customJS = <<<EOD
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sprintf/{$conf["version"]["sprintf"]}/sprintf.min.js"></script>
  <script>
    /* whatever */
  </script>

EOD;
  endif;

  $customCSS = <<<EOD
  <style>
    /* whatever */
  </style>
EOD;



//metastuff
  $lCustom["pagetitle"] = strip_tags($lCommon["admin"][LANG]);
//$lCustom["metadescription"][LANG] = strip_tags("Custom metadescription goes here"); # 160 char text
//$lCustom["metakeywords"] = strip_tags("Custom keywords go here");
//$lCustom["og_image"] = "https://custom.url/image-goes-here"; # 1200x630 px image

  require_once($conf["dir"]["themes"].$conf["trece"]["theme"]."/".$conf["file"]["header"].".php");
  require_once($conf["dir"]["themes"].$conf["trece"]["theme"]."/".$conf["file"]["nav"].".php");

?>

  <div class="container main-container">

    <div class="row">
      <div class="column">
        <h1><?=count($subdirs)>0 ? $lCommon["installing_new_modules"][LANG] : sprintf($lCommon["panel_of"][LANG],$app->getUserName()); ?></h1>
      </div>
    </div>
<?php if(count($subdirs)>0) : ?>
    <div class="row">
      <div class="column column-xs-100 column-sm-33 column-md-25">
        <?php foreach($subdirs as $dir) : ?>
        <iframe id="<?=$dir;?>" src="<?=REALPATHLANG.$dir;?>" style="width:254px;height:104px;overflow:hidden;"></iframe>
        <?php endforeach; ?>
      </div>
    </div>
<?php else : ?>
    <div class="row">
      <div class="column">
        <p id="trece-version"></p>
        <h3>
        » <?=nav($lCommon["edit_profile"][LANG],$conf["file"]["me"]);?>
        </h3>
        <h3>
        <?=is_dir($basedir."/".$conf["dir"]["users"]) ?           "» ".nav($lCommon["users"][LANG],$conf["dir"]["users"]) : "" ;?>
        <?=is_dir($basedir."/".$conf["dir"]["organizations"]) ?   "| ".nav($lCommon["organizations"][LANG],$conf["dir"]["organizations"]) : "" ;?>
        <?=is_dir($basedir."/".$conf["dir"]["genders"]) ?         "| ".nav($lCommon["genders"][LANG],$conf["dir"]["genders"]) : "" ;?>
        <?=is_dir($basedir."/".$conf["dir"]["uhierarchy"]) ?      "| ".nav($lCommon["hierarchy"][LANG],$conf["dir"]["uhierarchy"]) : "" ;?>
        <?=is_dir($basedir."/".$conf["dir"]["uprivileges"]) ?     "| ".nav($lCommon["privileges"][LANG],$conf["dir"]["uprivileges"]) : "" ;?>
        <?=is_dir($basedir."/".$conf["dir"]["languages"]) ?       "| ".nav($lCommon["languages"][LANG],$conf["dir"]["countries"]) : "" ;?>
        </h3>
        <h3>
        <?=is_dir($basedir."/".$conf["dir"]["labels"]) ?          "» ".nav($lCommon["labels"][LANG],$conf["dir"]["labels"]) : "" ;?>
        <?=is_dir($basedir."/".$conf["dir"]["blog"]) ?            "| ".nav($lCommon["blog"][LANG],$conf["dir"]["blog"]) : "" ;?>
        <?=is_dir($basedir."/".$conf["dir"]["pages"]) ?           "| ".nav($lCommon["pages"][LANG],$conf["dir"]["pages"]) : "" ;?>
        </h3>
        <h3>
        <?=is_dir($basedir."/".$conf["dir"]["locations"]) ?       "» ".nav($lCommon["places"]["locations"][LANG],$conf["dir"]["locations"]) : "" ;?>
        <?=is_dir($basedir."/".$conf["dir"]["counties"]) ?        "| ".nav($lCommon["places"]["counties"][LANG],$conf["dir"]["counties"]) : "" ;?>
        <?=is_dir($basedir."/".$conf["dir"]["provinces"]) ?       "| ".nav($lCommon["places"]["provinces"][LANG],$conf["dir"]["provinces"]) : "" ;?>
        <?=is_dir($basedir."/".$conf["dir"]["regions"]) ?         "| ".nav($lCommon["places"]["regions"][LANG],$conf["dir"]["regions"]) : "" ;?>
        <?=is_dir($basedir."/".$conf["dir"]["countries"]) ?       "| ".nav($lCommon["places"]["countries"][LANG],$conf["dir"]["countries"]) : "" ;?>
        </h3>
      </div>
    </div>

    <script>
      function compareversion(v1,v2){
//      abc.append(v1 + ' vs ' + v2 + ' = ');
        var result=false;
        if(typeof v1!=='object'){v1=v1.toString().split('.');}
        if(typeof v2!=='object'){v2=v2.toString().split('.');}
        for(var i=0;i<(Math.max(v1.length,v2.length));i++){
          if(v1[i]==undefined){v1[i]=0;}
          if(v2[i]==undefined){v2[i]=0;}
          if(Number(v1[i])<Number(v2[i])){result=true;break;}
          if(v1[i]!=v2[i]){break;}
          }
//      console.log(result);
        return(result);
        }
    </script>
    <script>function trece(info){
      var current = '<?=$conf["trece"]["version"];?>'.replace(/[^\d.]/g,'');
      var latest = info.latestVersion.replace(/[^\d.]/g,'');
//    console.log(current);
//    console.log(latest);

      var today = new Date();
      var today = new Date(today.getTime()-(today.getTimezoneOffset()*60000)).toISOString().split("T")[0];

      var d1 = Date.parse(today);
      var d2 = Date.parse(info.latestVersionDate);
//    console.log('d1: '+d1);
//    console.log('d2: '+d2);
//    console.log('d1-d2: '+(d1-d2));
//    console.log('d2-604800000: '+(d2-604800000));
      var wow=0;if(d1===d2){wow=1;}if(d1<(d2+604800000)&&d1>(d2)){wow=2;}if(d1<d2){wow=3;}

      if(wow!=3 && compareversion(current,latest)){

        var common =
            '👉 '
          + '<strong><?=$lCommon["important"][LANG];?></strong>: '
          + '<?=addslashes($lCommon["outdated_version_of_trece"][LANG]);?> '
          + '(<?=$conf["trece"]["version"];?>). ';

        if(wow===0){
          document.getElementById("trece-version").innerHTML=
            common
          + vsprintf('<?=$lCommon["please_update_trece_urgent"][LANG];?>',['<a href="<?=$conf["trece"]["download"];?>"><strong>TRECE '+latest+'-'+info.latestVersionName+'</strong></a>']);
          }
        if(wow===1){
          document.getElementById("trece-version").innerHTML=
            common
          + vsprintf('<?=$lCommon["please_update_trece_quiet_today"][LANG];?>',['<a href="<?=$conf["trece"]["download"];?>"><strong>TRECE '+latest+'-'+info.latestVersionName+'</strong></a>']);
          }
        if(wow===2){
          document.getElementById("trece-version").innerHTML=
            common
          + vsprintf('<?=$lCommon["please_update_trece_quiet_week"][LANG];?>',['<a href="<?=$conf["trece"]["download"];?>"><strong>TRECE '+latest+'-'+info.latestVersionName+'</strong></a>']);
          }

      }else{

        document.getElementById("trece-version").innerHTML=
          '👍 '
        + '<?=addslashes($lCommon["you_are_running_the_latest_version_of_trece"][LANG]);?> '
        + '(<?=$conf["trece"]["version"];?>).'
        }

      }
    </script>
    <script src="https://trece.boa.gal/v.php"></script>
<?php endif; ?>

  </div>



<?php require_once($conf["dir"]["themes"].$conf["trece"]["theme"]."/".$conf["file"]["footer"].".php"); ?>