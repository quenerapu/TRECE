<?php if(!defined("TRECE")):header("location:/");die();endif; ?>
<?php
//ORGANIZATIONS

# ......................................................................................................................
# ...#######..########...######......###....##....##.####.########....###....########.####..#######..##....##..######...
# ..##.....##.##.....##.##....##....##.##...###...##..##.......##....##.##......##.....##..##.....##.###...##.##....##..
# ..##.....##.##.....##.##.........##...##..####..##..##......##....##...##.....##.....##..##.....##.####..##.##........
# ..##.....##.########..##...####.##.....##.##.##.##..##.....##....##.....##....##.....##..##.....##.##.##.##..######...
# ..##.....##.##...##...##....##..#########.##..####..##....##.....#########....##.....##..##.....##.##..####.......##..
# ..##.....##.##....##..##....##..##.....##.##...###..##...##......##.....##....##.....##..##.....##.##...###.##....##..
# ...#######..##.....##..######...##.....##.##....##.####.########.##.....##....##....####..#######..##....##..######...
# ......................................................................................................................

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




# ................................................................................................
# ..##..##.#####..#####...####..######.######...#####..#####...####..######.######.##.....######..
# ..##..##.##..##.##..##.##..##...##...##.......##..##.##..##.##..##.##.......##...##.....##......
# ..##..##.#####..##..##.######...##...####.....#####..#####..##..##.####.....##...##.....####....
# ..##..##.##.....##..##.##..##...##...##.......##.....##..##.##..##.##.......##...##.....##......
# ...####..##.....#####..##..##...##...######...##.....##..##..####..##.....######.######.######..
# ................................................................................................

  if(isset($_POST["name"])) :

    unset($_FILES);
    $msg = true;

    if(isset($_POST["item-loo-image"]) && !empty($_POST["item-loo-image"])):
      $item_loo_image = $_POST["item-loo-image"];
      list($type,$item_loo_image)=explode(";",$item_loo_image);
      list(,$item_loo_image)=explode(",",$item_loo_image);
      $item_loo_image=base64_decode($item_loo_image);
      file_put_contents($conf["dir"]["images"].$action."_".$trece->ref."_loo.jpg",$item_loo_image);
      $source=@imagecreatefromjpeg($conf["dir"]["images"].$action."_".$trece->ref."_loo.jpg");
      fixImageOrientation($source,$conf["dir"]["images"].$action."_".$trece->ref."_loo.jpg");
      if($source){imagejpeg($source,$conf["dir"]["images"].$action."_".$trece->ref."_loo.jpg");}
      list($width,$height)=getimagesize($conf["dir"]["images"].$action."_".$trece->ref."_loo.jpg");
      resizeImage($source,$conf["dir"]["images"].$conf["css"]["thumb_prefix"].$action."_".$trece->ref."_loo.jpg",$width,$height,$cconf["img"]["thumb_w"],$cconf["img"]["thumb_h"]);
    endif;

    if(isset($_POST["item-loo-remove"]) && file_exists($conf["dir"]["images"].$action."_".$trece->ref."_loo.jpg")):
      unlink($conf["dir"]["images"].$action."_".$trece->ref."_loo.jpg");
      unlink($conf["dir"]["images"].$conf["css"]["thumb_prefix"].$action."_".$trece->ref."_loo.jpg");
    endif;

    if(isset($_POST["name"]))       : $trece->name          = htmlspecialchars_decode(trim(preg_replace("/[[:blank:]]+/"," ",$_POST["name"])));
                                      $trece->url_name      = getUrlFriendlyString($trece->name);                                                           endif;
    if(isset($_POST["intro"]))      : $trece->intro         = $_POST["intro"];                                                                              endif;

    if($trece->updateOne()) :

      $msgType = "success";
      $msgText = $lCommon["general_ok"][LANG];

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



# ......##..........................................
# ...########...........######...########.########..
# ..##..##..##.........##....##..##..........##.....
# ..##..##.............##........##..........##.....
# ...########..........##...####.######......##.....
# ......##..##.........##....##..##..........##.....
# ..##..##..##.........##....##..##..........##.....
# ...########..#######..######...########....##.....
# ......##..........................................




//Still here? OK, let's talk.



  $included = false;

  if( isset($conf["site"]["virtualpathArray"][$readtype+1]) && $conf["site"]["virtualpathArray"][$readtype+1] == $conf["file"]["adminlist"] ) :

    $included = true;

  endif;

  $name             = isset($trece->name)?$trece->name:$cconf["default"]["name"];
  $dupeName         = isset($trece->dupeName)?$trece->dupeName:0;
  $stmt             = $trece->readOne();
  $filename         = $cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg";
  $trece->gotPic    = file_exists($conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg") ? true : false;

//metastuff
  $lCustom["pagetitle"][LANG] = $lCustom["edit"][LANG];
  $lCustom["metadescription"][LANG] = "La metadescription"; # 160 char text
  $lCustom["metakeywords"] = "key word keyword";
  $lCustom["og_image"] = "https://ddfsdf.com"; # 1200x630 px image



  $customJS = <<<EOD
  <!-- Croppie -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/{$conf["version"]["croppie"]}/croppie.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/{$conf["version"]["croppie"]}/croppie.min.js"></script>
  <script>
    /* whatever */
  </script>
EOD;
  $customCSS = <<<EOD
  <style>
    div.mce-fullscreen{z-index:1050;}
    a.tit-btn{text-decoration:none;}
    a.tit-btn:hover:not(.btn-primary){background:#eee;}
    label.item-loo{display:block;cursor:pointer;padding:0 !important;}
    label.item-loo input.file{position:relative;height:100%;width:auto;opacity:0;-moz-opacity:0;filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0);margin-top:-30px;}
    #modal-loo-img{width:{$cconf["img"]["w_loo"]}px;height:{$cconf["img"]["h_loo"]}px;}
    figure figcaption{position:relative;top:-27px;left:10px;margin-bottom:-50px;color:#fff;width:100%;text-shadow:0 0 10px #000;}
    #crop-modal-loo-img .modal-dialog,#crop-modal-loo-img .modal-dialog{position:relative;display:table;overflow-y:auto;overflow-x:auto;width:auto;min-width:300px;}
    #crop-modal-loo-img .modal-body{height:{$cconf["img"]["modal_loo_h"]}px;}
  </style>
EOD;



  require_once($conf["dir"]["includes"]."header.php");
  require_once($conf["dir"]["includes"]."nav.php");

?>

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

      <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-lg-10 col-lg-offset-1">

        <div class="form-group">
          <button type="submit" class="btn btn-cons confirm-image"><?=$lCommon["save_changes"][LANG];?></button>
        </div>

        <div class="row">

          <div class="col-xs-12 col-sm-4">

            <div class="form-group">
              <label class="sr-only" for="loo">Logo:</label>
              <label for="loo">Logo:</label><br>
              <label class="item-loo">
                <figure>
                  <img src="<?=file_exists($conf["dir"]["images"].$action."_".$trece->ref."_loo.jpg")?$conf["dir"]["images"].$action."_".$trece->ref."_loo.jpg?".time():(file_exists($conf["dir"]["images"].$action."_generic_loo.jpg")?$conf["dir"]["images"].$action."_generic_loo.jpg?".time():"https://fakeimg.pl/".$cconf["img"]["w_loo"]."x".$cconf["img"]["h_loo"]."/?text=Logo");?>" id="item-loo-output" class="img-responsive img-thumbnail">
                  <figcaption><i class="fa fa-camera"></i></figcaption>
                </figure>
                <input type="file" name="item-loo" id="item-loo" class="file center-block">
              </label>
              <div class="checkbox">
                <label><input type="checkbox" name="item-loo-remove" id="item-loo-remove" value="1"<?=!file_exists($conf["dir"]["images"].$action."_".$trece->ref."_loo.jpg")?" checked":"";?>> Sin logo (usar genérico)</label>
              </div>
              <input type="hidden" id="item-loo-image" name="item-loo-image" value="">
            </div>

          </div>

          <div class="col-xs-12 col-sm-8">

            <div class="form-group">
              <?php $name_length = 55; ?>
              <label class="sr-only" for="name"><?=$lCommon["name"][LANG];?>:</label>
              <label for="name"><?=$lCommon["name"][LANG];?>:</label><br>
              <textarea name="name" class="form-control" style="height:4.5em;font-size:1.4em;" placeholder=""><?=$trece->name;?></textarea>
              <p class="help-block"><span id="name_lettercounter"></span> <i class="fas fa-external-link-alt"></i> <a href="https://seopressor.com/blog/google-title-meta-descriptions-length/" target="_blank">Acerca del tamaño de los títulos</a></p>
            </div>

          </div>

        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-cons confirm-image"><?=$lCommon["save_changes"][LANG];?></button>
        </div>

      </div>

    </div>

    </form>

  </div>



  <div class="clearfix"></div>



  <div class="modal fade" id="crop-modal-loo-img" tabindex="-1" role="dialog" aria-labelledby="crop-modal-loo-label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="crop-modal-loo-label">Recortar imagen</h4>
        </div>
        <div class="modal-body">
          <div id="modal-loo-img" class="center-block"></div>
        </div>
        <div class="modal-footer">
          <button type="button" id="cropImageBtn-loo" class="btn btn-primary">Recortar</button>
        </div>
      </div>
    </div>
  </div>


  <script>
    $(function(){$('[data-toggle="tooltip"]').tooltip();});
  </script>



  <script>

    window.onclick = e => {
      var qq = e.target.getAttribute("id");
      var arr=["item-loo"];

      if(arr.indexOf(qq) != -1){

        switch (qq) {
        case "item-loo":
          var w = <?=$cconf["img"]["w_loo"];?>;                                      // console.log("w: "+w);
          var h = <?=$cconf["img"]["h_loo"];?>;                                      // console.log("h: "+h);
          var viewport_w = <?=$cconf["img"]["viewport_loo_w"];?>;                    // console.log("viewport_w: "+viewport_w);
          var viewport_h = <?=$cconf["img"]["viewport_loo_h"];?>;                    // console.log("viewport_h: "+viewport_h);
          break;
        }

        var $uploadCrop,tempFilename,rawImg,imageId;
        function readFile(input){
          if(input.files && input.files[0]){
            var reader=new FileReader();
            reader.onload=function(e){
              $("#modal-"+qq.slice(qq.length -3)+"-img").addClass("ready");          // console.log("#modal-"+qq.slice(qq.length -3)+"-img >> ready");
              $("#crop-modal-"+qq.slice(qq.length -3)+"-img").modal("show");         // console.log("#crop-modal-"+qq.slice(qq.length -3)+"-img >> show");
              rawImg=e.target.result;
              }
            reader.readAsDataURL(input.files[0]);
            }else{swal("Sorry - you're browser doesn't support the FileReader API");}
          }

        function createCroppie(viewportWidth,viewportHeight){
          $uploadCrop = $("#modal-"+qq.slice(qq.length -3)+"-img").croppie({
            viewport:{width:viewportWidth,height:viewportHeight},
            enforceBoundary:true,enableExif:true,enableOrientation:true,
          });
          $uploadCrop.croppie("bind",{url:rawImg});
          }

                                                                                     // console.log("#modal-"+qq.slice(qq.length -3)+"-img");


        function resizeCroppie(width,height){
          if(qq!=""){
            $("#modal-"+qq.slice(qq.length -3)+"-img").croppie("destroy");
            createCroppie(width,height);
            }
          }

                                                                                     // console.log("#modal-"+qq.slice(qq.length -3)+"-img");


        $("#crop-modal-"+qq.slice(qq.length -3)+"-img").on("shown.bs.modal",function(){resizeCroppie(w,h);});

                                                                                     // console.log("#crop-modal-"+qq.slice(qq.length -3)+"-img");

        $("#"+qq).on("change",function(){
          imageId=$(this).data("id");
          tempFilename=$(this).val();
          readFile(this);
          });

        $("#cropImageBtn-"+qq.slice(qq.length -3)).on("click",function(ev){
          if(qq!=""){
            $uploadCrop.croppie("result",{type:"base64",format:"jpeg",size:{width:viewport_w,height:viewport_h}}).then(function(resp){
                $("#"+qq+"-output").attr("src",resp);                                // console.log("#"+qq+"-output");
                $("#"+qq+"-image").val(resp);                                        // console.log("#"+qq+"-image");
                $("#"+qq+"-remove").attr("checked",false);                           // console.log("#"+qq+"-remove");
                $("#modal-"+qq.slice(qq.length -3)+"-img").removeClass("ready");     // console.log("#modal-"+qq.slice(qq.length -3)+"-img");
                $("#crop-modal-"+qq.slice(qq.length -3)+"-img").modal("hide");       // console.log("#crop-modal-"+qq.slice(qq.length -3)+"-img");
                $("#modal-"+qq.slice(qq.length -3)+"-img").croppie("destroy");       // console.log("#modal-"+qq.slice(qq.length -3)+"-img");
                qq = "";
            });
            }
          });

      }
    }

  </script>



  <!-- Latest compiled and minified jQuery Mask Plugin from http://igorescobar.github.io/jQuery-Mask-Plugin/ -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/<?=$conf["version"]["jquery_mask"];?>/jquery.mask.min.js"></script>

  <script>
    $(document).ready(function(){

      var text_max_name  = 150; // https://seopressor.com/blog/google-title-meta-descriptions-length/

      $("#name_lettercounter").html("(Quedan "+(text_max_name-<?=mb_strlen($trece->name,"utf8");?>)+")");
      $('textarea[name="name"]').on("keyup",function(event){
        var len_name = $(this).val().length;
        var name_length = $('textarea[name="name"]').val().length;
        var name_remaining = text_max_name - name_length;
        if (len_name >= text_max_name){$(this).val($(this).val().substring(0,len_name-1));}
        $("#name_lettercounter").html("(Quedan "+name_remaining+")");
        });

    });
  </script>



  <?php if($msg&&$msgType!="danger") : ?>
  <script>$(".alert-dismissable").fadeTo(2000,500).slideUp(500,function(){$(".alert-dismissable").slideUp(500);});</script>
  <?php endif; ?>

  <!-- TinyMCE -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/<?=$conf["version"]["tinymce"];?>/tinymce.min.js"></script>
  <script>
    tinymce.init({
      selector: "textarea.tinymce",
      menubar: false,
      plugins: [ "visualblocks autolink charmap link hr paste wordcount code" ],
      toolbar: "visualblocks | bold italic strikethrough | insert code",
      relative_urls : false,
      remove_script_host : true,
      document_base_url : "<?=REALPATH;?>",
      visualblocks_default_state: true,
      inline_boundaries: true,
      entity_encoding: "raw",
      paste_as_text: true,
      paste_word_valid_elements: "b,strong,i,em,h1,h2",
      paste_retain_style_properties: "color",
      height: 100,
      content_css: [
        "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/<?=$conf["version"]["fontawesome"];?>/css/font-awesome.min.css",
        "https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i",
        "<?=REALPATH.$conf["dir"]["styles"];?>tinymce.css?" + new Date().getTime(),
        ],
    });
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
