<?php if(!defined("TRECE")):header("location:/");die();endif; ?>
<?php
//EXAMPLE

# ......................................................................
# ..########.##.....##....###....##.....##.########..##.......########..
# ..##........##...##....##.##...###...###.##.....##.##.......##........
# ..##.........##.##....##...##..####.####.##.....##.##.......##........
# ..######......###....##.....##.##.###.##.########..##.......######....
# ..##.........##.##...#########.##.....##.##........##.......##........
# ..##........##...##..##.....##.##.....##.##........##.......##........
# ..########.##.....##.##.....##.##.....##.##........########.########..
# ......................................................................

// http://patorjk.com/software/taag/#p=display&f=Banner4&t=%20TRECE%20
// http://patorjk.com/software/taag/#p=display&f=Bright&t=Deprecated
// https://stackoverflow.com/questions/8154158/mysql-how-do-i-use-delimiters-in-triggers









  $goBack = $action."/".$conf["file"]["adminlist"];

  if(isset($conf["site"]["queryArray"]["back"])) :

    parse_str($conf["site"]["query"],$conf["site"]["queryArray"]);
    $goBack = $conf["site"]["queryArray"]["back"]."/".$conf["file"]["adminlist"];
    unset($conf["site"]["queryArray"]["back"]);
    $conf["site"]["queryq"] = count($conf["site"]["queryArray"])>0? "?".http_build_query($conf["site"]["queryArray"]) : "";

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

  if(isset($_POST["title_es"])) :

    $msg = true;

    if(isset($_POST["id_status"]))          : $trece->id_status         = 1; else : $trece->id_status = 0;                                                        endif;
    if(isset($_POST["title_es"]))           : $trece->title_es          = htmlspecialchars(trim(preg_replace("/[[:blank:]]+/"," ",$_POST["title_es"])));          endif;
    if(isset($_POST["title_gal"]))          : $trece->title_gal         = htmlspecialchars(trim(preg_replace("/[[:blank:]]+/"," ",$_POST["title_gal"])));         endif;
    if(isset($_POST["title_en"]))           : $trece->title_en          = htmlspecialchars(trim(preg_replace("/[[:blank:]]+/"," ",$_POST["title_en"])));          endif;
    if(isset($_POST["description_es"]))     : $trece->description_es    = htmlspecialchars(trim(preg_replace("/[[:blank:]]+/"," ",$_POST["description_es"])));    endif;
    if(isset($_POST["description_gal"]))    : $trece->description_gal   = htmlspecialchars(trim(preg_replace("/[[:blank:]]+/"," ",$_POST["description_gal"])));   endif;
    if(isset($_POST["description_en"]))     : $trece->description_en    = htmlspecialchars(trim(preg_replace("/[[:blank:]]+/"," ",$_POST["description_en"])));    endif;
    if(isset($_POST["code"]))               : $trece->code              = htmlspecialchars(trim($_POST["code"]));                                                 endif;
    if(isset($_POST["ids_users"]))          : $trece->ids_users         = htmlspecialchars(trim($_POST["ids_users"]));                                            endif;

    if($trece->updateOne()) :

      if($trece->dupeCode > 0) :

        $msgType = $trece->dupeCode > 0 ? "danger" : "success";
        $msgText = $trece->dupeCode > 0 ?
                  ($trece->dupeCode > 0 ? $lCustom["duplicated_code"][LANG]." " : "") :
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

          $trece->id_status         = $cconf["default"]["id_status"];
          $trece->title_es          = $cconf["default"]["title_es"];
          $trece->title_gal         = $cconf["default"]["title_gal"];
          $trece->title_en          = $cconf["default"]["title_en"];
          $trece->description_es    = $cconf["default"]["description_es"];
          $trece->description_gal   = $cconf["default"]["description_gal"];
          $trece->description_en    = $cconf["default"]["description_en"];
          $trece->code              = $cconf["default"]["code"];

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
    $conf["site"]["queryq"] = $conf["site"]["queryq"] != "" ? "?".http_build_query($conf["site"]["queryArray"]) : "";
    header("location:".REALPATHLANG.$action."/".$crudlpx."/".$what."/".$conf["file"]["adminlist"]."/1".$conf["site"]["queryq"]);
    die();

  endif;



//Still here? OK, let's talk.

  $included = false;

  if( isset($conf["site"]["virtualpathArray"][$readtype+1]) && $conf["site"]["virtualpathArray"][$readtype+1] == $conf["file"]["adminlist"] ) :

    $included = true;

  endif;

  $code             = isset($trece->code)?$trece->code:$cconf["default"]["code"];
  $dupeCode         = isset($trece->dupeCode)?$trece->dupeCode:0;
  $stmt = $trece->readOne();
  $trece->code      = $dupeCode > 0 ? $code : $trece->code;
  $filename         = $cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg";
  $trece->gotPic    = file_exists($conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg") ? true : false;

/*
  echo "<pre><small>";
//print_r($trece);
  echo "<br>id: ".$trece->id;
  echo "<br>ref: ".$trece->ref;
  echo "<br>id_status: ".$trece->id_status;
  echo "<br>title_es: ".$trece->title_es;
  echo "<br>title_gal: ".$trece->title_gal;
  echo "<br>title_en: ".$trece->title_en;
  echo "<br>description_es: ".$trece->description_es;
  echo "<br>description_gal: ".$trece->description_gal;
  echo "<br>description_en: ".$trece->description_en;
  echo "<br>code: ".$trece->code;
  echo "<br>dupeCode: ".$trece->dupeCode;
  echo "<br>ids_users: ".$trece->ids_users;
  echo "<br>gotPic: ".($trece->gotPic ? "true" : "false");
  echo "<br>tablename: ".$trece->tablename;
  echo "<br>tableletter: ".$trece->tableletter;
  echo "<br>intimacy: ".$trece->intimacy;
  echo "</small></pre>";
*/

  $lCustom["pagetitle"][LANG] = $lCustom["edit"][LANG];



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

  <style>
    a.tit-btn{text-decoration:none;}
    a.tit-btn:hover:not(.btn-primary){background:#eee;}
  </style>

  <div class="container main-container"<?=$included ? " style=\"padding-bottom:3em;\"" : "";?>>

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

        <div class="form-group">
          <label for="tit"><?=$lCustom["title"][LANG];?>:
            <a href="#div_title_es" class="tit-btn btn-xs btn-primary" data-toggle="tab">ES</a>
            <a href="#div_title_gal" class="tit-btn btn-xs" data-toggle="tab">GAL</a>
            <a href="#div_title_en" class="tit-btn btn-xs" data-toggle="tab">EN</a>
          </label><br>
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="div_title_es">
              <input type="text" id="title_es" name="title_es" class="form-control" placeholder="<?=$trece->title_es;?>" value="<?=($cconf["default"]["title_es"]===$trece->title_es)||(strpos($trece->title_es,$cconf["default"]["title_es"])===0)?"":$trece->title_es;?>" required>
            </div>
            <div role="tabpanel" class="tab-pane fade in" id="div_title_gal">
              <input type="text" id="title_gal" name="title_gal" class="form-control" placeholder="<?=$trece->title_gal;?>" value="<?=($cconf["default"]["title_gal"]===$trece->title_gal)||(strpos($trece->title_gal,$cconf["default"]["title_gal"])===0)?"":$trece->title_gal;?>">
            </div>
            <div role="tabpanel" class="tab-pane fade in" id="div_title_en">
              <input type="text" id="title_en" name="title_en" class="form-control" placeholder="<?=$trece->title_en;?>" value="<?=($cconf["default"]["title_en"]===$trece->title_en)||(strpos($trece->title_en,$cconf["default"]["title_en"])===0)?"":$trece->title_en;?>">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="description"><?=$lCustom["description"][LANG];?>:
            <a href="#div_description_es" class="description-btn btn-xs btn-primary" data-toggle="tab">ES</a>
            <a href="#div_description_gal" class="description-btn btn-xs" data-toggle="tab">GAL</a>
            <a href="#div_description_en" class="description-btn btn-xs" data-toggle="tab">EN</a>
          </label><br>
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="div_description_es">
              <textarea id="description_es" name="description_es" class="form-control" rows="5" placeholder="<?=$trece->description_es;?>" required><?=($cconf["default"]["description_es"]===$trece->description_es)||(strpos($trece->description_es,$cconf["default"]["description_es"])===0)?"":$trece->description_es;?></textarea>
            </div>
            <div role="tabpanel" class="tab-pane fade in" id="div_description_gal">
              <textarea id="description_gal" name="description_gal" class="form-control" rows="5" placeholder="<?=$trece->description_gal;?>" required><?=($cconf["default"]["description_gal"]===$trece->description_gal)||(strpos($trece->description_gal,$cconf["default"]["description_gal"])===0)?"":$trece->description_gal;?></textarea>
            </div>
            <div role="tabpanel" class="tab-pane fade in" id="div_description_en">
              <textarea id="description_en" name="description_en" class="form-control" rows="5" placeholder="<?=$trece->description_en;?>" required><?=($cconf["default"]["description_en"]===$trece->description_en)||(strpos($trece->description_en,$cconf["default"]["description_en"])===0)?"":$trece->description_en;?></textarea>
            </div>
          </div>
        </div>

        <div class="form-group<?=$dupeCode>0?" has-error":"";?>">
          <label for="code"><?=$lCustom["code"][LANG];?>:</label><br>
          <input type="text" id="code" name="code" class="form-control" value="<?=$trece->code;?>" required>
          <span class="help-block">* <?=($dupeCode>0?$lCustom["duplicated_code"][LANG]." ":"").$lCommon["it_must_be_unique"][LANG];?></span>
        </div>

        <div class="row">
          <div class="form-group">
            <input type="hidden" id="cropData1" name="cropData1">
            <input type="hidden" id="cropData2" name="cropData2">
            <input type="hidden" id="imagebase64" name="imagebase64">
            <button type="submit" class="btn btn-cons confirm-image"><?=$lCommon["save_changes"][LANG];?></button>
<?php if(($cconf["default"]["title_es"]===$trece->title_es)||(strpos($trece->title_es,$cconf["default"]["title_es"])===0)) : ?>
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
    $("[href^=\\#div_tit]").on("shown.bs.tab",function(e){$("[href^=\\#div_tit]").removeClass("btn-primary");$(this).addClass("btn-primary");});
    $("[href^=\\#div_description]").on("shown.bs.tab",function(e){$("[href^=\\#div_description]").removeClass("btn-primary");$(this).addClass("btn-primary");});
  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/<?=$conf["version"]["croppie"];?>/croppie.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/exif-js/<?=$conf["version"]["exif_js"];?>/exif.min.js"></script>
  <script>
    var thePic="<?=$trece->gotPic?$conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg?".time():"https://fakeimg.pl/".$cconf["img"]["viewport_w"]."x".$cconf["img"]["viewport_h"]."/?text=Example";?>";
    function resetCroppie(){destroyCroppie();initCroppie();}function destroyCroppie(){$uploadCrop.croppie("destroy");}function deleteCroppie(){$.post("",{deleteImage:true,object_who:"<?=$conf["dir"]["images"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg";?>↲<?=$conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg";?>↲<?=$conf["dir"]["images"].$conf["css"]["thumb_prefix"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg";?>"},function(data){$("#img-delete").remove();$("form#form").submit();}).fail(function(){alert("<?=addslashes($lCommon["cannot_be_deleted"][LANG]);?>");});}function initCroppie(){$uploadCrop=$("#crop-image").croppie({enableExif:true,viewport:{width:<?=$cconf["img"]["viewport_w"];?>,height:<?=$cconf["img"]["viewport_h"];?>,type:"square"},boundary:{width:<?=$cconf["img"]["viewport_w"];?>,height:<?=$cconf["img"]["viewport_h"];?>}});}$uploadCrop=$("#crop-image").croppie({enableExif:true,viewport:{width:<?=$cconf["img"]["viewport_w"];?>,height:<?=$cconf["img"]["viewport_h"];?>,type:"square"},boundary:{width:<?=$cconf["img"]["viewport_w"];?>,height:<?=$cconf["img"]["viewport_h"];?>}});$("#cropData1").val(JSON.stringify($("#crop-image").croppie("get")));$uploadCrop.croppie("bind",{url:thePic},function(){$("#cropData1").val(JSON.stringify($("#crop-image").croppie("get")));});$("#img-delete").on("click",function(ev){var q=confirm("<?=$lCommon["are_you_sure"][LANG];?>");if(q==true){$("#imagebase64").val("nopic");deleteCroppie();}return false;});$("#img-delete").hover(function(){$(this).animate({fontSize:"3.8rem"});},function(){$(this).animate({fontSize:"2.8rem"});});$("#upload").on("change",function(){resetCroppie();var reader=new FileReader();reader.onload=function(e){$uploadCrop.croppie("bind",{url:e.target.result}).then(function(){console.log("jQuery bind complete");});};reader.readAsDataURL(this.files[0]);});$("#img-upload").hover(function(){$(this).animate({fontSize:"4rem"});},function(){$(this).animate({fontSize:"3rem"});});var form=document.querySelector("form#form");form.addEventListener("submit",function(e){e.preventDefault();},false);var submit_form_btn=document.querySelector(".confirm-image");submit_form_btn.addEventListener("click",function(ev){if(form.checkValidity()){if(($("#cropData1").val()!=$("#cropData2").val())&&($("#imagebase64").val!=""||$("#imagebase64").val!="nopic")){ev.preventDefault();$uploadCrop.croppie("result",{type:"canvas",size:{width:<?=$cconf["img"]["canvas_w"];?>,height:<?=$cconf["img"]["canvas_h"];?>},format:"jpeg",quality:0.9}).then(function(resp){$("#imagebase64").val(resp);});};setTimeout(function(){$("form#form").submit();},10);}else{form.querySelector('input[type="submit"]').click();}},false);$("#crop-image").on("update.croppie",function(ev,cropData){$("#cropData2").val(JSON.stringify(cropData));});
  </script>




<?php

  if(!$included) :

    require_once($conf["dir"]["includes"]."footer.php");
    die();

  endif;



  $back       = $action."/".$crudlpx."/".$what;
  $argument1  = $conf["table"][$action];
  $argument2  = "id_test";
  $argument3  = "ref";
  $argument4  = $what;

  $action     = "sections";
  $crudlpx    = $conf["site"]["virtualpathArray"][$readtype+1];
  $what       = $conf["site"]["virtualpathArray"][$readtype+2];

  require_once($conf["dir"]["includes"].$action."/".$conf["file"]["adminlist"].".php");

?>
