<?php if(!defined("TRECE")):header("location:/");die();endif; ?>
<?php
//BLOG

# ----------------------------------........
# ..########..##........#######...######....
# ..##.....##.##.......##.....##.##....##...
# ..##.....##.##.......##.....##.##.........
# ..########..##.......##.....##.##...####..
# ..##.....##.##.......##.....##.##....##...
# ..##.....##.##.......##.....##.##....##...
# ..########..########..#######...######....
# ..................................--------

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

  if(isset($_POST["title"])) :

    $msg = true;

    if(isset($_POST["date"]))       : $trece->date       = $_POST["date"]!=""?date("Y-m-d",strtotime(str_replace("/","-",$_POST["date"]))):"0000-00-00";  endif;
    if(isset($_POST["title"]))      : $trece->title      = htmlspecialchars(trim(preg_replace("/[[:blank:]]+/"," ",$_POST["title"])));
                                      $trece->url_title  = $trece->date."-".getUrlFriendlyString($trece->title);                                          endif;
    if(isset($_POST["intro"]))      : $trece->intro      = $_POST["intro"];                                                                               endif;
    if(isset($_POST["post"]))       : $trece->post       = $_POST["post"];                                                                                endif;
    if(isset($_POST["ids_labels"])) : $trece->ids_labels = $_POST["ids_labels"];                                                                          endif;

    if($trece->updateOne()) :

      if($trece->dupeTitle > 0) :

        $msgType = $trece->dupeTitle > 0 ? "danger" : "success";
        $msgText = $trece->dupeTitle > 0 ?
                  ($trece->dupeTitle > 0 ? $lCustom["duplicated_title"][LANG]." " : "") :
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
          $trece->name              = $cconf["default"]["name"];

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

  $title            = isset($trece->title)?$trece->title:$cconf["default"]["title"];
  $dupeTitle        = isset($trece->dupeTitle)?$trece->dupeTitle:0;
  $stmt             = $trece->readOne();
  $filename         = $cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg";
  $trece->gotPic    = file_exists($conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg") ? true : false;

/*
  echo "<pre><small>";
//print_r($trece);
  echo "<br>id: ".$trece->id;
  echo "<br>ref: ".$trece->ref;
  echo "<br>id_status: ".$trece->id_status;
  echo "<br>name: ".$trece->name;
  echo "<br>bio: ".$trece->bio;
  echo "<br>dupeTitle: ".$trece->dupeTitle;
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
    div.mce-fullscreen{z-index:1050;}
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

      <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-lg-4 col-lg-offset-1">

        <div style="width:<?=$cconf["img"]["viewport_w"];?>px; position:relative;margin-bottom:1em;">
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

      <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-lg-5">

        <div class="form-group">
          <label class="sr-only" for="date"><?=$lCustom["date"][LANG];?></label>
          <label for="date"><?=$lCustom["date"][LANG];?>:</label><br>
          <input type="text" id="date" name="date" class="form-control date" value="<?=$trece->date=="0000-00-00"?"":(date("d/m/Y",strtotime($trece->date)));?>" placeholder="DD/MM/AAAA">
          <p class="help-block" style="line-height:.8em;"><small><i class="fa fa-calendar" aria-hidden="true"></i> <a id="onte" style="cursor:pointer;">Onte</a> | <i class="fa fa-calendar-check-o" aria-hidden="true"></i> <a id="hoxe" style="cursor:pointer;">Hoxe</a></small></p>
        </div>

        <div class="form-group">
          <label class="sr-only" for="title"><?=$lCustom["title"][LANG];?></label>
          <label for="title"><?=$lCustom["title"][LANG];?>:</label><br>
          <textarea id="title" name="title" class="form-control input-lg" placeholder="<?=$lCustom["title"][LANG];?>"><?=$trece->title;?></textarea>
        </div>

        <div class="form-group">
          <label class="sr-only" for="date"><?=$lCustom["labels"][LANG];?></label>
          <label for="ids_labels"><?=$lCustom["labels"][LANG];?>:</label><br>
          <input type="text" id="ids_labels" name="ids_labels" class="form-control" placeholder="" data-foradditem="<?=trim($trece->ids_labels,"'");?>" data-foraddoption='[<?=$trece->jsonlabels;?>]' value="">
        </div>

      </div>

      <div class="col-xs-12 col-sm-10 col-sm-offset-1">

        <div class="form-group">
          <label class="sr-only" for="intro"><?=$lCustom["intro"][LANG];?></label>
          <label for="intro"><?=$lCustom["intro"][LANG];?>:</label><br>
          <textarea id="intro" name="intro" class="form-control" placeholder="Entradiña que non supere os 250 caracteres (coma se fora un tuit)"><?=$trece->intro;?></textarea>
        </div>

        <div class="form-group">
          <label class="sr-only" for="post"><?=$lCustom["post"][LANG];?></label>
          <label for="post"><?=$lCustom["post"][LANG];?>:</label><br>
          <textarea id="post" name="post" class="form-control minitinymce" placeholder="Texto completo da publicación."><?=$trece->post;?></textarea>
        </div>

      </div>

      <div class="col-xs-12 col-sm-5 col-sm-offset-1">

        <div class="form-group">
          <input type="hidden" id="cropData1" name="cropData1">
          <input type="hidden" id="cropData2" name="cropData2">
          <input type="hidden" id="imagebase64" name="imagebase64">
          <button type="submit" class="btn btn-cons confirm-image"><?=$lCommon["save_changes"][LANG];?></button>
<?php if(($cconf["default"]["title"]===$trece->title)||(strpos($trece->title,$cconf["default"]["title"])===0)) : ?>
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

    </form>

  </div>



  <div class="clearfix"></div>



  <script>$(function(){$('[data-toggle="tooltip"]').tooltip();});</script>

  <!-- Latest compiled and minified jQuery Mask Plugin from http://igorescobar.github.io/jQuery-Mask-Plugin/ -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/<?=$conf["version"]["jquery_mask"];?>/jquery.mask.min.js"></script>

  <script>
    $(document).ready(function() {
      $('input[name="date"]').mask("00/00/0000"),{placeholder:"__/__/____"};
      $('input[name="dataCambioEstado"]').mask("00/00/0000"),{placeholder:"__/__/____"};
//    $('input[name="iban"]').mask("SS00 0000 0000 0000 0000 0000",{placeholder:"____ ____ ____ ____ ____ ____"});
    });
  </script>

<?php /*
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/<?=$conf["version"]["bootstrap_switch"];?>/js/bootstrap-switch.min.js"></script>
  <script>
    $('[name="id_status"]').bootstrapSwitch();
    $('input[name="id_status"]').on("switchChange.bootstrapSwitch",function(event,state){if(state){$("#crop-image").removeClass("attenuate",500);}else{$("#crop-image").addClass("attenuate",500);}});
  </script>
*/ ?>

  <?php if($msg&&$msgType!="danger") : ?>
  <script>$(".alert-dismissable").fadeTo(2000,500).slideUp(500,function(){$(".alert-dismissable").slideUp(500);});</script>
  <?php endif; ?>

  <script>
    $("[href^=\\#div_tit]").on("shown.bs.tab",function(e){$("[href^=\\#div_tit]").removeClass("btn-primary");$(this).addClass("btn-primary");});
    $("[href^=\\#div_description]").on("shown.bs.tab",function(e){$("[href^=\\#div_description]").removeClass("btn-primary");$(this).addClass("btn-primary");});
    $("#onte").click(function(){$('input[id="date"]').val(moment().subtract(1,"days").format("DD/MM/YYYY"));});
    $("#hoxe").click(function(){$('input[id="date"]').val(moment().format("DD/MM/YYYY"));});
  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/<?=$conf["version"]["croppie"];?>/croppie.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/exif-js/<?=$conf["version"]["exif_js"];?>/exif.min.js"></script>
  <script>
    var thePic="<?=$trece->gotPic?$conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg?".time():"https://fakeimg.pl/".$cconf["img"]["viewport_w"]."x".$cconf["img"]["viewport_h"]."/?text=Entrada blog";?>";
    function resetCroppie(){destroyCroppie();initCroppie();}function destroyCroppie(){$uploadCrop.croppie("destroy");}function deleteCroppie(){$.post("",{deleteImage:true,object_who:"<?=$conf["dir"]["images"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg";?>↲<?=$conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg";?>↲<?=$conf["dir"]["images"].$conf["css"]["thumb_prefix"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg";?>"},function(data){$("#img-delete").remove();$("form#form").submit();}).fail(function(){alert("<?=addslashes($lCommon["cannot_be_deleted"][LANG]);?>");});}function initCroppie(){$uploadCrop=$("#crop-image").croppie({enableExif:true,viewport:{width:<?=$cconf["img"]["viewport_w"];?>,height:<?=$cconf["img"]["viewport_h"];?>,type:"square"},boundary:{width:<?=$cconf["img"]["viewport_w"];?>,height:<?=$cconf["img"]["viewport_h"];?>}});}$uploadCrop=$("#crop-image").croppie({enableExif:true,viewport:{width:<?=$cconf["img"]["viewport_w"];?>,height:<?=$cconf["img"]["viewport_h"];?>,type:"square"},boundary:{width:<?=$cconf["img"]["viewport_w"];?>,height:<?=$cconf["img"]["viewport_h"];?>}});$("#cropData1").val(JSON.stringify($("#crop-image").croppie("get")));$uploadCrop.croppie("bind",{url:thePic},function(){$("#cropData1").val(JSON.stringify($("#crop-image").croppie("get")));});$("#img-delete").on("click",function(ev){var q=confirm("<?=$lCommon["are_you_sure"][LANG];?>");if(q==true){$("#imagebase64").val("nopic");deleteCroppie();}return false;});$("#img-delete").hover(function(){$(this).animate({fontSize:"3.8rem"});},function(){$(this).animate({fontSize:"2.8rem"});});$("#upload").on("change",function(){resetCroppie();var reader=new FileReader();reader.onload=function(e){$uploadCrop.croppie("bind",{url:e.target.result}).then(function(){console.log("jQuery bind complete");});};reader.readAsDataURL(this.files[0]);});$("#img-upload").hover(function(){$(this).animate({fontSize:"4rem"});},function(){$(this).animate({fontSize:"3rem"});});var form=document.querySelector("form#form");form.addEventListener("submit",function(e){e.preventDefault();},false);var submit_form_btn=document.querySelector(".confirm-image");submit_form_btn.addEventListener("click",function(ev){if(form.checkValidity()){if(($("#cropData1").val()!=$("#cropData2").val())&&($("#imagebase64").val!=""||$("#imagebase64").val!="nopic")){ev.preventDefault();$uploadCrop.croppie("result",{type:"canvas",size:{width:<?=$cconf["img"]["canvas_w"];?>,height:<?=$cconf["img"]["canvas_h"];?>},format:"jpeg",quality:0.9}).then(function(resp){$("#imagebase64").val(resp);});};setTimeout(function(){$("form#form").submit();},10);}else{form.querySelector('input[type="submit"]').click();}},false);$("#crop-image").on("update.croppie",function(ev,cropData){$("#cropData2").val(JSON.stringify(cropData));});
  </script>



  <!-- TinyMCE -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/<?=$conf["version"]["tinymce"];?>/tinymce.min.js?cachebuster=123"></script>
  <script>
    tinymce.init({
      selector: "textarea.minitinymce",
      menubar: false,
      plugins: [ "fullscreen visualblocks charmap link paste wordcount lists hr" ],
      toolbar: "bold italic strikethrough bullist numlist link | charmap | fullscreen",
      visualblocks_default_state: true,
      inline_boundaries: true,
//    valid_elements: "p,a[href|target=_blank],em,strong/b",
      entity_encoding : "raw",
      paste_as_text: true,
      paste_word_valid_elements: "b,strong,i,em,h1,h2",
      paste_retain_style_properties: "color",
      height: 400,
      content_css: [
        "//fonts.googleapis.com/css?family=Lato:300,300i,400,400i",
        "../css/tinymce.css?" + new Date().getTime(),
        ],
    });
  </script>


<?php
# ..................................................................
# ...####..######.##.....######..####..######.######.######.######..
# ..##.....##.....##.....##.....##..##...##.....##......##..##......
# ...####..####...##.....####...##.......##.....##.....##...####....
# ......##.##.....##.....##.....##..##...##.....##....##....##......
# ...####..######.######.######..####....##...######.######.######..
# ..................................................................
?>

<!-- Latest compiled and minified Selectize JS from https://selectize.github.io/selectize.js/ -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/<?=$conf["version"]["selectize"];?>/js/standalone/selectize.min.js"></script>
  <script>
//  var xelect = $("#ids_sections").selectize()[0].selectize.destroy();
    var foraddItem = $("#ids_labels").data("foradditem");
    var foraddOption = $("#ids_labels").data("foraddoption");
    var xelect = $("#ids_labels").selectize({
      maxItems: 5,
      valueField: "value",
      labelField: "name",
      searchField: "name",
      plugins: ["remove_button","drag_drop"], // "restore_on_backspace",
      options: [<?=$trece->jsonlabels;?>],
      closeAfterSelect: true,
      persist: true,
      preload: true,
      create: false,
      initData: true,
      hideSelected: true,
      selectOnTab: true,
      load: function(query,callback) {
        $.ajax({
          url: "<?=REALPATHLANG;?>labels/alst?json",
          type: "GET",
          dataType: "json",
          error: function(){callback();},
          success: function(res){callback(res);}
          });
        },
      });
    var xelectize = xelect[0].selectize;
    var foraddItem = JSON.parse('[' + foraddItem + ']');
    for (var iz = 0; iz < foraddOption.length; iz++) {
      if(foraddItem.indexOf(foraddOption[iz].value)!==-1){
        var tocho = '[{"value":'+foraddOption[iz].value+',"name":"'+foraddOption[iz].name+'"}]';
        var realtocho = JSON.parse(tocho);
        xelectize.addOption(realtocho);
        xelectize.addItem(foraddOption[iz].value);
        }
      }
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
