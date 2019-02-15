<?php if(!defined("TRECE")):header("location:/");die();endif; ?>
<?php
//GENDER

# ............................................................
# ...######...########.##....##.########..########.########...
# ..##....##..##.......###...##.##.....##.##.......##.....##..
# ..##........##.......####..##.##.....##.##.......##.....##..
# ..##...####.######...##.##.##.##.....##.######...########...
# ..##....##..##.......##..####.##.....##.##.......##...##....
# ..##....##..##.......##...###.##.....##.##.......##....##...
# ...######...########.##....##.########..########.##.....##..
# ............................................................

// http://patorjk.com/software/taag/#p=display&f=Banner4&t=%20TRECE%20
// http://patorjk.com/software/taag/#p=display&f=Bright&t=Deprecated
// https://stackoverflow.com/questions/8154158/mysql-how-do-i-use-delimiters-in-triggers









  $goBack = $action."/".$conf["file"]["adminlist"];

  if(isset($conf["site"]["queryArray"]["back"])) :

    parse_str($conf["site"]["query"],$conf["site"]["queryArray"]);
    $goBack = $conf["site"]["queryArray"]["back"]."/".$conf["file"]["adminlist"];
    unset($conf["site"]["queryArray"]["back"]);
    QUERYQ = count($conf["site"]["queryArray"])>0? "?".http_build_query($conf["site"]["queryArray"]) : "";

  endif;





//Not logged? Not admin? Get out of here!

  if (
//    1+1==3 # Public for everyone
      !$app->getUserSignInStatus() # Must be logged in
      || $app->getUserHierarchy() != 1 # Must be admin
     ) :

    header("location:".REALPATHLANG.QUERYQ);
    die();

  endif;



//Wrong reference? Get out of here!

  require_once($conf["file"]["crud"].".php");

  $trece = new $action($db,$conf,$cconf,$lCommon,$lCustom);
  $trece->ref = $what;
  $trece->intimacy = 1;
  $stmt = $trece->checkRef();

  if($trece->rowcount == 0) :

    header("location:".REALPATHLANG.QUERYQ);
    die();

  endif;



  $msg = false;



# ......##....................................................
# ...########..........########...#######...######..########..
# ..##..##..##.........##.....##.##.....##.##....##....##.....
# ..##..##.............##.....##.##.....##.##..........##.....
# ...########..........########..##.....##..######.....##.....
# ......##..##.........##........##.....##.......##....##.....
# ..##..##..##.........##........##.....##.##....##....##.....
# ...########..#######.##.........#######...######.....##.....
# ......##....................................................



# ...................................................................................
# ..#####..######.##.....######.######.######...######.##...##..####...####..######..
# ..##..##.##.....##.....##.......##...##.........##...###.###.##..##.##.....##......
# ..##..##.####...##.....####.....##...####.......##...##.#.##.######.##.###.####....
# ..##..##.##.....##.....##.......##...##.........##...##...##.##..##.##..##.##......
# ..#####..######.######.######...##...######...######.##...##.##..##..####..######..
# ...................................................................................

  if(isset($_POST["deleteImage"]) && isset($_POST["object_who"])) :

    $items = explode("↲",$_POST["object_who"]);
    foreach($items as $item) :
      if(file_exists($item)) :
        unlink($item);
      endif;
    endforeach;
    die();

  endif;

# .. END DELETE IMAGE
# ...................................................................................



# ................................................................................................
# ..##..##.#####..#####...####..######.######...#####..#####...####..######.######.##.....######..
# ..##..##.##..##.##..##.##..##...##...##.......##..##.##..##.##..##.##.......##...##.....##......
# ..##..##.#####..##..##.######...##...####.....#####..#####..##..##.####.....##...##.....####....
# ..##..##.##.....##..##.##..##...##...##.......##.....##..##.##..##.##.......##...##.....##......
# ...####..##.....#####..##..##...##...######...##.....##..##..####..##.....######.######.######..
# ................................................................................................

  if(isset($_POST["name"])) :

    $msg = true;

    if(isset($_POST["id_status"]))          : $trece->id_status          = 1; else : $trece->id_status = 0;                 endif;
    if(isset($_POST["name"]))               : $trece->name               = htmlspecialchars(trim(preg_replace("/[[:blank:]]+/"," ",$_POST["name"])));          endif;
    if(isset($_POST["letter"]))             : $trece->letter             = htmlspecialchars(trim(preg_replace("/[[:blank:]]+/"," ",$_POST["letter"])));        endif;

    if($trece->updateOne()) :

      if($trece->dupeName + $trece->dupeLetter > 0) :

        $msgType = $trece->dupeName + $trece->dupeLetter > 0 ? "danger" : "success";
        $msgText = $trece->dupeName + $trece->dupeLetter > 0 ?
                  ($trece->dupeName > 0 ? $lCustom["duplicated_name"][LANG]." " : "") .
                  ($trece->dupeLetter > 0 ? $lCustom["duplicated_letter"][LANG]   ." " : "") :
                   $lCommon["general_ok"][LANG];

      else :

        $imagebase64 = !isset($trece->{$cconf["img"]["ref"]}) ? "" : $_POST["imagebase64"];
        $filename = $cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg";

        if($imagebase64 == "") :

        elseif($imagebase64 == "nopic") :

          if(file_exists($conf["dir"]["images"].$conf["css"]["thumb_prefix"].$filename)) : unlink($conf["dir"]["images"].$conf["css"]["thumb_prefix"].$filename); endif;
          if(file_exists($conf["dir"]["images"].$conf["css"]["icon_prefix"].$filename)) : unlink($conf["dir"]["images"].$conf["css"]["icon_prefix"].$filename); endif;
          if(file_exists($conf["dir"]["images"].$filename)) : unlink($conf["dir"]["images"].$filename); endif;

        else :

          list($type,$imagebase64) = explode(";",$imagebase64);
          list(,$imagebase64) = explode(",",$imagebase64);
          $imagebase64 = base64_decode($imagebase64);

          file_put_contents($conf["dir"]["images"]."TC_".$filename,$imagebase64);

          $source = @imagecreatefromjpeg($conf["dir"]["images"]."TC_".$filename);
          fixImageOrientation($source,$conf["dir"]["images"]."TC_".$filename);
          if($source){imagejpeg($source,$conf["dir"]["images"]."TC_".$filename);}
          list($width,$height) = getimagesize($conf["dir"]["images"]."TC_".$filename);

          resizeImage($source,$conf["dir"]["images"].$filename,$width,$height,$cconf["img"]["img_w"],$cconf["img"]["img_h"]);
          resizeImage($source,$conf["dir"]["images"].$conf["css"]["icon_prefix"].$filename,$width,$height,$cconf["img"]["icon_w"],$cconf["img"]["icon_h"]);
          resizeImage($source,$conf["dir"]["images"].$conf["css"]["thumb_prefix"].$filename,$width,$height,$cconf["img"]["thumb_w"],$cconf["img"]["thumb_h"]);

          // CLEAN THE CRIME SCENE
          imagedestroy($source);
          if(file_exists($conf["dir"]["images"]."TC_".$filename)) : unlink($conf["dir"]["images"]."TC_".$filename); endif;

        endif;

        if(isset($_POST["addNew"]) && $_POST["addNew"] == 1) :

          $trece->id_status     = $cconf["default"]["id_status"];
          $trece->name          = $cconf["default"]["name"];
          $trece->letter        = $cconf["default"]["letter"];;

          $trece->addOne();

          header("location:".REALPATHLANG.$conf["site"]["virtualpathArray"]["0"]."/".$conf["site"]["virtualpathArray"]["1"]."/".$trece->ref);
          die();

        else :

          $msgType = "success";
          $msgText = $lCommon["general_ok"][LANG];

        endif;

      endif;

    else :

      $msgType = "danger";
      $msgText = $lCommon["general_error"][LANG];

    endif;

  endif;

# .. END UPDATE PROFILE
# ................................................................................................



//Wrong query parameters for a list of subitems? Reload without those parameters!

  $readtype = array_search($what,$conf["site"]["virtualpathArray"]);

  if( isset($conf["site"]["virtualpathArray"][$readtype+1]) &&
      $conf["site"]["virtualpathArray"][$readtype+1] == $conf["file"]["adminlist"] &&
      ( !isset($conf["site"]["virtualpathArray"][$readtype+2]) ||
        !is_numeric($conf["site"]["virtualpathArray"][$readtype+2]) ||
        floor($conf["site"]["virtualpathArray"][$readtype+2]) != $conf["site"]["virtualpathArray"][$readtype+2]
      )
    ) :

//  $conf["site"]["queryArray"]["bk"] = $conf["site"]["virtualpathArray"][$readtype+1];
    QUERYQ = QUERYQ != "" ? "?".http_build_query($conf["site"]["queryArray"]) : "";
    header("location:".REALPATHLANG.$action."/".$crudlpx."/".$what."/".$conf["file"]["adminlist"]."/1".QUERYQ);
    die();

  endif;



//Still here? OK, let's talk.

  $included = false;

  if( isset($conf["site"]["virtualpathArray"][$readtype+1]) && $conf["site"]["virtualpathArray"][$readtype+1] == $conf["file"]["adminlist"] ) :

    $included = true;

  endif;

  $name             = isset($trece->name)?$trece->name:$cconf["default"]["name"];
  $letter           = isset($trece->letter)?$trece->letter:$cconf["default"]["letter"];
  $dupeName         = isset($trece->dupeName)?$trece->dupeName:0;
  $dupeLetter       = isset($trece->dupeLetter)?$trece->dupeLetter:0;
  $stmt = $trece->readOne();
  $name             = $dupeName+$dupeLetter > 0 ? $name : $trece->name;
  $letter           = $dupeName+$dupeLetter > 0 ? $letter : (!is_null($letter) ? $letter : $trece->letter);
  $filename         = $cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg";
  $trece->gotPic    = file_exists($conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg") ? true : false;

/*
  echo "<pre><small>";
//print_r($trece);
  echo "<br>id: ".$trece->id;
  echo "<br>ref: ".$trece->ref;
  echo "<br>id_status: ".$trece->id_status;
  echo "<br>name: ".$trece->name;
  echo "<br>dupeName: ".$trece->dupeName;
  echo "<br>letter: ".$trece->letter;
  echo "<br>dupeLetter: ".$trece->dupeLetter;
  echo "<br>gotPic: ".($trece->gotPic ? "true" : "false");
  echo "<br>tablename: ".$trece->tablename;
  echo "<br>tableletter: ".$trece->tableletter;
  echo "<br>intimacy: ".$trece->intimacy;
  echo "</small></pre>";
*/

  $lCustom["pagetitle"][LANG] = $lCustom["edit"][LANG].": ".$trece->name;

  require_once($conf["dir"]["includes"]."header.php");
  require_once($conf["dir"]["includes"]."nav.php");

?>

  <style>
    a.tit-btn{text-decoration:none;}
    a.tit-btn:hover:not(.btn-primary){background:#eee;}
  </style>

  <div class="container main-container">

    <?php if($msg) : ?>

    <div class="alert alert-<?=$msgType;?> alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <?=$msgText;?>
    </div>

    <?php endif; ?>

    <div class="row">
      <div class="col-xs-12 col-sm-10 col-sm-offset-1">
        <div class="page-header">
          <div class="pull-right"><p>
            <?=btn($lCommon["admin_list"][LANG],"!".$action."/".$conf["file"]["adminlist"],"","fa-list");?>
          </p></div>
          <h1><strong><?=$lCustom["edit"][LANG];?></strong></h1>
        </div>
      </div>
    </div><!-- row -->

    <form id="form" class="form-classic" action="" method="post" enctype="multipart/form-data">

    <div class="row">

      <div class="col-sm-4 col-sm-offset-1 col-md-3 col-md-offset-2">

        <div style="width:<?=$cconf["img"]["viewport_w"];?>px; position:relative;">
          <div style="z-index:2; position:absolute; bottom:35px; left:0; padding:0 10px;">
            <div style="float:left;">
              <input id="upload" name="upload" type="file" style="display:none;">
              <label id="img-upload" for="upload" style="font-size:3rem; color:white; line-height:1rem; text-shadow:0 0 10px #000; cursor:pointer; padding: 0 .15em 0 0;"><i class="fa fa-cloud-upload" aria-hidden="true"></i></label>
            </div>
            <?php if($trece->gotPic) : ?>
            <div style="float:left;">
              <label id="img-delete" for="delete" style="font-size:2.8rem; color:white; line-height:1rem; text-shadow:0 0 10px #000; cursor:pointer;"><i class="fa fa-trash" aria-hidden="true"></i></label>
            </div>
            <?php endif; ?>
          </div>
          <div id="crop-image" class="<?=$trece->id_status == 0?" attenuate":"";?>"></div>
        </div>

      </div>

      <div class="col-sm-6 col-md-5">

        <div class="form-group">
          <label for="id_status"><?=$lCustom["status"][LANG];?>:</label><br>
          <input type="checkbox" id="id_status" name="id_status" data-on-color="success" data-on-text="<?=$lCommon["active"][LANG];?>" data-off-color="danger" data-off-text="<?=$lCommon["inactive"][LANG];?>" class="form-control"<?=$trece->id_status==1?" checked":"";?>>
        </div>

        <div class="form-group<?=$dupeName>0?" has-error":"";?>">
          <label for="name"><?=$lCustom["name"][LANG];?>:</label><br>
          <input type="text" id="name" name="name" class="form-control" placeholder="<?=$trece->name;?>" value="<?=($cconf["default"]["name"]===$name)||(strpos($name,$cconf["default"]["name"])===0)?"":$name;?>" required>
          <span class="help-block">* <?=($dupeName>0?$lCustom["duplicated_name"][LANG]:" ").$lCommon["it_must_be_unique"][LANG];?></span>
        </div>

        <div class="form-group<?=$dupeLetter>0?" has-error":"";?>">
          <label for="letter"><?=$lCustom["letter"][LANG];?>:</label><br>
          <input type="text" id="letter" name="letter" class="form-control" value="<?=$letter;?>" maxlength="1"<?=$dupeName+$dupeLetter==0&&strlen(trim($letter))>0?" readonly":" required";?>>
          <span class="help-block">* <?=($dupeLetter>0?$lCustom["duplicated_letter"][LANG]:" ").$lCommon["it_must_be_unique"][LANG];?></span>
        </div>

        <div class="row">
          <div class="form-group">
            <input type="hidden" id="cropData1" name="cropData1">
            <input type="hidden" id="cropData2" name="cropData2">
            <input type="hidden" id="imagebase64" name="imagebase64">
            <button type="submit" class="btn btn-cons confirm-image"><?=$lCommon["save_changes"][LANG];?></button>
<?php if(($cconf["default"]["name"]===$name)||(strpos($name,$cconf["default"]["name"])===0)) : ?>
<?php /*
            <hr>
            <div class="checkbox">
              <label>
                <input type="checkbox" id="addNew" name="addNew" value="1" checked>
                <?=$lCommon["and_add_a_new_blank_file"][LANG];?>
              </label>
            </div>
*/ ?>
<?php endif; ?>
          </div>
        </div>

      </div>

    </div>

    </form>

  </div>



  <div class="clearfix"></div>



  <script>$(function(){$('[data-toggle="tooltip"]').tooltip();});</script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/<?=$conf["version"]["bootstrap_switch"];?>/js/bootstrap-switch.min.js"></script>
  <script>
    $('[name="id_status"]').bootstrapSwitch();
    $('input[name="id_status"]').on("switchChange.bootstrapSwitch",function(event,state){if(state){$("#crop-image").removeClass("attenuate",500);}else{$("#crop-image").addClass("attenuate",500);}});
  </script>

  <?php if($msg&&$msgType!="danger") : ?>
  <script>$(".alert-dismissable").fadeTo(2000,500).slideUp(500,function(){$(".alert-dismissable").slideUp(500);});</script>
  <?php endif; ?>

  <script>
    $("[href^=\\#div_]").on("shown.bs.tab",function(e){$("[href^=\\#div_]").removeClass("btn-primary");$(this).addClass("btn-primary");});
  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/<?=$conf["version"]["croppie"];?>/croppie.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/exif-js/<?=$conf["version"]["exif_js"];?>/exif.min.js"></script>
  <script>
    var thePic="<?=$trece->gotPic?$conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg?".time():(file_exists($conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"]."0.jpg")?$conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"]."0.jpg":"https://fakeimg.pl/".$cconf["img"]["viewport_w"]."x".$cconf["img"]["viewport_h"]."/?text=?");?>";
    function resetCroppie(){destroyCroppie();initCroppie();}function destroyCroppie(){$uploadCrop.croppie("destroy");}function deleteCroppie(){$.post("",{deleteImage:true,object_who:"<?=$conf["dir"]["images"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg";?>↲<?=$conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg";?>↲<?=$conf["dir"]["images"].$conf["css"]["thumb_prefix"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg";?>"},function(data){$("#img-delete").remove();$("form#form").submit();}).fail(function(){alert("<?=addslashes($lCommon["cannot_be_deleted"][LANG]);?>");});}function initCroppie(){$uploadCrop=$("#crop-image").croppie({enableExif:true,viewport:{width:<?=$cconf["img"]["viewport_w"];?>,height:<?=$cconf["img"]["viewport_h"];?>,type:"square"},boundary:{width:<?=$cconf["img"]["viewport_w"];?>,height:<?=$cconf["img"]["viewport_h"];?>}});}$uploadCrop=$("#crop-image").croppie({enableExif:true,viewport:{width:<?=$cconf["img"]["viewport_w"];?>,height:<?=$cconf["img"]["viewport_h"];?>,type:"square"},boundary:{width:<?=$cconf["img"]["viewport_w"];?>,height:<?=$cconf["img"]["viewport_h"];?>}});$("#cropData1").val(JSON.stringify($("#crop-image").croppie("get")));$uploadCrop.croppie("bind",{url:thePic},function(){$("#cropData1").val(JSON.stringify($("#crop-image").croppie("get")));});$("#img-delete").on("click",function(ev){var q=confirm("<?=$lCommon["are_you_sure"][LANG];?>");if(q==true){$("#imagebase64").val("nopic");deleteCroppie();}return false;});$("#img-delete").hover(function(){$(this).animate({fontSize:"3.8rem"});},function(){$(this).animate({fontSize:"2.8rem"});});$("#upload").on("change",function(){resetCroppie();var reader=new FileReader();reader.onload=function(e){$uploadCrop.croppie("bind",{url:e.target.result}).then(function(){console.log("jQuery bind complete");});};reader.readAsDataURL(this.files[0]);});$("#img-upload").hover(function(){$(this).animate({fontSize:"4rem"});},function(){$(this).animate({fontSize:"3rem"});});var form=document.querySelector("form#form");form.addEventListener("submit",function(e){e.preventDefault();},false);var submit_form_btn=document.querySelector(".confirm-image");submit_form_btn.addEventListener("click",function(ev){if(form.checkValidity()){if(($("#cropData1").val()!=$("#cropData2").val())&&($("#imagebase64").val!=""||$("#imagebase64").val!="nopic")){ev.preventDefault();$uploadCrop.croppie("result",{type:"canvas",size:{width:<?=$cconf["img"]["canvas_w"];?>,height:<?=$cconf["img"]["canvas_h"];?>},format:"jpeg",quality:0.9}).then(function(resp){$("#imagebase64").val(resp);});};setTimeout(function(){$("form#form").submit();},10);}else{form.querySelector('input[type="submit"]').click();}},false);$("#crop-image").on("update.croppie",function(ev,cropData){$("#cropData2").val(JSON.stringify(cropData));});
  </script>




<?php

  if(!$included) :

    require_once($conf["dir"]["includes"]."footer.php");
    die();

  endif;



  $back       = $action."/".$crudlpx."/".$what;
  $argument1  = $conf["table"][$action];
  $argument2  = "id_section";
  $argument3  = "ref";
  $argument4  = $what;

  $action     = "questions";
  $crudlpx    = $conf["site"]["virtualpathArray"][$readtype+1];
  $what       = $conf["site"]["virtualpathArray"][$readtype+2];

  require_once($conf["dir"]["includes"].$action."/".$conf["file"]["adminlist"].".php");

?>
