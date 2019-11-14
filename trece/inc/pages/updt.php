<?php if(!defined("TRECE")):header("location:/");die();endif; ?>
<?php
//PAGES

# ...................................................
# ..########.....###.....######...########..######...
# ..##.....##...##.##...##....##..##.......##....##..
# ..##.....##..##...##..##........##.......##........
# ..########..##.....##.##...####.######....######...
# ..##........#########.##....##..##.............##..
# ..##........##.....##.##....##..##.......##....##..
# ..##........##.....##..######...########..######...
# ...................................................

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

  if(isset($_POST["title_en"])) :

    unset($_FILES);
    $msg = true;

    if(isset($_POST["item-img-mob-image"]) && !empty($_POST["item-img-mob-image"])):
      $item_img_mob_image = $_POST["item-img-mob-image"];
      list($type,$item_img_mob_image)=explode(";",$item_img_mob_image);
      list(,$item_img_mob_image)=explode(",",$item_img_mob_image);
      $item_img_mob_image=base64_decode($item_img_mob_image);
      file_put_contents($conf["dir"]["images"].$action."_".$trece->ref."_mob.jpg",$item_img_mob_image);

      $source=@imagecreatefromjpeg($conf["dir"]["images"].$action."_".$trece->ref."_mob.jpg");
      fixImageOrientation($source,$conf["dir"]["images"].$action."_".$trece->ref."_mob.jpg");
      if($source){imagejpeg($source,$conf["dir"]["images"].$action."_".$trece->ref."_mob.jpg");}
      list($width,$height)=getimagesize($conf["dir"]["images"].$action."_".$trece->ref."_mob.jpg");
      resizeImage($source,$conf["dir"]["images"].$conf["css"]["thumb_prefix"].$action."_".$trece->ref."_mob.jpg",$width,$height,$cconf["img"]["thumb_w"],$cconf["img"]["thumb_h"]);
    endif;

    if(isset($_POST["item-img-mob-remove"]) && file_exists($conf["dir"]["images"].$action."_".$trece->ref."_mob.jpg")):
      unlink($conf["dir"]["images"].$action."_".$trece->ref."_mob.jpg");
      unlink($conf["dir"]["images"].$conf["css"]["thumb_prefix"].$action."_".$trece->ref."_mob.jpg");
    endif;

    if(isset($_POST["item-img-web-image"]) && !empty($_POST["item-img-web-image"])):
      $item_img_web_image = $_POST["item-img-web-image"];
      list($type,$item_img_web_image)=explode(";",$item_img_web_image);
      list(,$item_img_web_image)=explode(",",$item_img_web_image);
      $item_img_web_image=base64_decode($item_img_web_image);
      file_put_contents($conf["dir"]["images"].$action."_".$trece->ref."_web.jpg",$item_img_web_image);
    endif;

    if(isset($_POST["item-img-web-remove"]) && file_exists($conf["dir"]["images"].$action."_".$trece->ref."_web.jpg")):
      unlink($conf["dir"]["images"].$action."_".$trece->ref."_web.jpg");
    endif;

    if(isset($_POST["title_en"]))             : $trece->title_en  = htmlspecialchars_decode(trim(preg_replace("/[[:blank:]]+/"," ",$_POST["title_en"])));     endif;
    if(isset($_POST["title_gal"]))            : $trece->title_gal = htmlspecialchars_decode(trim(preg_replace("/[[:blank:]]+/"," ",$_POST["title_gal"])));    endif;
    if(isset($_POST["title_es"]))             : $trece->title_es  = htmlspecialchars_decode(trim(preg_replace("/[[:blank:]]+/"," ",$_POST["title_es"])));     endif;
    if(isset($_POST["last_path"]))            : $trece->url_title = htmlspecialchars_decode(trim(preg_replace("/[[:blank:]]+/"," ",$_POST["last_path"])));    endif;

    if(isset($_POST["ids_breadcrumb_trail"])) : $trece->parent_id = explode(",",$_POST["ids_breadcrumb_trail"]); end($trece->parent_id);
                                                $trece->level     = count($trece->parent_id);
                                                $trece->parent_id = prev($trece->parent_id);                                                                  endif;

    if(isset($_POST["path"]))                 : $trece->path      = str_replace_plus("fo",REALPATHLANG,"",$_POST["path"]);
                                                $trece->path      = substr($trece->path,0,strrpos($trece->path,"/")).
                                                                          ($trece->parent_id==""?"":"/").$trece->url_title;                                   endif;

    if(isset($_POST["intro_en"]))             : $trece->intro_en  = htmlspecialchars_decode(trim(preg_replace("/[[:blank:]]+/"," ",$_POST["intro_en"])));     endif;
    if(isset($_POST["intro_gal"]))            : $trece->intro_gal = htmlspecialchars_decode(trim(preg_replace("/[[:blank:]]+/"," ",$_POST["intro_gal"])));    endif;
    if(isset($_POST["intro_es"]))             : $trece->intro_es  = htmlspecialchars_decode(trim(preg_replace("/[[:blank:]]+/"," ",$_POST["intro_es"])));     endif;
    if(isset($_POST["post_en"]))              : $trece->post_en   = $_POST["post_en"];                                                                        endif;
    if(isset($_POST["post_gal"]))             : $trece->post_gal  = $_POST["post_gal"];                                                                       endif;
    if(isset($_POST["post_es"]))              : $trece->post_es   = $_POST["post_es"];                                                                        endif;

//  echo $_POST["ids_breadcrumb_trail"];
//  die();

    if($trece->updateOne()) :

      if($trece->dupeURLTitle > 0) :

        $msgType = $trece->dupeURLTitle > 0 ? "danger" : "success";
        $msgText = $trece->dupeURLTitle > 0 ?
                  ($trece->dupeURLTitle > 0 ? "<strong>".$lCustom["duplicated_url_title"][LANG]."</strong> ".REALPATHLANG.$trece->path : "") :
                   $lCommon["general_ok"][LANG];

      else :

        $msgType = "success";
        $msgText = $lCommon["general_ok"][LANG];

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

  $title_en         = isset($trece->title_en)?$trece->title_en:$cconf["default"]["title_en"];
  $dupeURLTitle     = isset($trece->dupeURLTitle)?$trece->dupeURLTitle:0;
  $url_title        = isset($trece->dupeURLTitle)?$trece->dupeURLTitleTxt:$trece->url_title;
  $path             = isset($trece->dupeURLTitle)?$trece->path:"";
  $stmt             = $trece->readOne();
//$filename         = $cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg";
//$trece->gotPic    = file_exists($conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg") ? true : false;

//metastuff
  $lCustom["pagetitle"][LANG] = $lCustom["edit"][LANG];
  $lCustom["metadescription"][LANG] = "La metadescription"; # 160 char text
  $lCustom["metakeywords"] = "key word keyword";
  $lCustom["og_image"] = "https://ddfsdf.com"; # 1200x630 px image



  $customJS = <<<EOD
  <!-- SpeakingURL -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/speakingurl/{$conf["version"]["speakingurl"]}/speakingurl.min.js"></script>
  <!-- jQuery Confirm -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/{$conf["version"]["jquery_confirm"]}/jquery-confirm.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/{$conf["version"]["jquery_confirm"]}/jquery-confirm.min.js"></script>
  <!-- Croppie -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/{$conf["version"]["croppie"]}/croppie.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/{$conf["version"]["croppie"]}/croppie.min.js"></script>
  <script>
    /* whatever */
    jconfirm.defaults={title:"",titleClass:"",type:"default",typeAnimated:!0,draggable:!0,dragWindowGap:30,dragWindowBorder:!0,animateFromElement:!1,smoothContent:!0,content:"",buttons:{},defaultButtons:{ok:{action:function(){}},close:{action:function(){}},},contentLoaded:function(data,status,xhr){},icon:"",lazyOpen:!1,bgOpacity:null,theme:"bootstrap",animation:"bottom",closeAnimation:"bottom",animationBounce:2,animationSpeed:400,rtl:!1,container:"body",containerFluid:!1,backgroundDismiss:!1,backgroundDismissAnimation:"shake",autoClose:!1,closeIcon:!0,closeIconClass:"fa fa-close",watchInterval:100,columnClass:"col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1",boxWidth:"50%",scrollToPreviousElement:!0,scrollToPreviousElementAnimate:!0,useBootstrap:!0,offsetTop:40,offsetBottom:40,bootstrapClasses:{container:"container",containerFluid:"container-fluid",row:"row",},onContentReady:function(){},onOpenBefore:function(){},onOpen:function(){},onClose:function(){},onDestroy:function(){},onAction:function(){},}
  </script>
EOD;
  $customCSS = <<<EOD
  <style>
    div.mce-fullscreen{z-index:1050;}
    a.tit-btn{text-decoration:none;}
    a.tit-btn:hover:not(.btn-primary){background:#eee;}
    label.item-img-mob,label.item-img-web{display:block;cursor:pointer;padding:0 !important;}
    label.item-img-mob input.file,label.item-img-web input.file{position:relative;height:100%;width:auto;opacity:0;-moz-opacity:0;filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0);margin-top:-30px;}
    #modal-mob-img{width:{$cconf["img"]["w_mob"]}px;height:{$cconf["img"]["h_mob"]}px;}
    #modal-web-img{width:{$cconf["img"]["w_web"]}px;height:{$cconf["img"]["h_web"]}px;}
    figure figcaption{position:relative;top:-27px;left:10px;margin-bottom:-50px;color:#fff;width:100%;text-shadow:0 0 10px #000;}
    #crop-modal-mob-img .modal-dialog,#crop-modal-mob-img .modal-dialog{position:relative;display:table;overflow-y:auto;overflow-x:auto;width:auto;min-width:300px;}
    #crop-modal-mob-img .modal-body{height:{$cconf["img"]["modal_mob_h"]}px;}
    #crop-modal-web-img .modal-body{height:{$cconf["img"]["modal_web_h"]}px;}
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

      <div class="col-xs-12 col-sm-10 col-sm-offset-1">



        <div class="form-group">
          <label class="sr-only" for="title"><?=$lCustom["title"][LANG];?></label>
          <label for="title"><?=$lCustom["title"][LANG];?>:
            <a href="#title_en" class="btn-xs btn-primary" data-toggle="tab">EN</a>
            <a href="#title_gal" class="btn-xs" data-toggle="tab">GAL</a>
            <a href="#title_es" class="btn-xs" data-toggle="tab">ES</a>
          </label><br>
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="title_en">
              <textarea name="title_en" class="form-control" style="height:3.5em;font-size:2em;" placeholder=""><?=$trece->title_en;?></textarea>
              <span class="help-block" id="title_en_lettercounter"></span>
            </div>
            <div role="tabpanel" class="tab-pane fade in" id="title_gal">
              <textarea name="title_gal" class="form-control" style="height:3.5em;font-size:2em;" placeholder=""><?=$trece->title_gal;?></textarea>
              <span class="help-block" id="title_gal_lettercounter"></span>
            </div>
            <div role="tabpanel" class="tab-pane fade in" id="title_es">
              <textarea name="title_es" class="form-control" style="height:3.5em;font-size:2em;" placeholder=""><?=$trece->title_es;?></textarea>
              <span class="help-block" id="title_es_lettercounter"></span>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="form-inline">
              <span><?=rtrim(REALPATHLANG,"/");?></span>
              <select id="sec1" name="sec1" class=""></select>
              <select id="sec2" name="sec2" class=""></select>
              <select id="sec3" name="sec3" class=""></select>
              <span>/
                <input type="text" name="speakingurl" id="speakingurl" placeholder="" class="form-control"<?=$dupeURLTitle?" style=\"background-color:#f2dede;\"":"";?> value="<?=$dupeURLTitle ? $url_title : $trece->url_title;?>">
                <input type="checkbox" name="dontTouchMe[]" id="dontTouchMe" value="1">
                <script>
                  $(function(){
                    $("#dontTouchMe").change(function(){if($("#dontTouchMe:checked").length){$("#speakingurl").attr("readonly",true);}else{$("#speakingurl").attr("readonly",false);}});
                    });
                  $('textarea[name="title_en"]').on("keyup",function()  {
                    if($('input[name="dontTouchMe[]"]:checked').length===0){
                      var value=$(this).val();
                      $("#speakingurl").val(getSlug(value));
                      $("#last_path").val(getSlug(value));
                      $("#ppath span").text(getSlug(value));
                      var value=$("#ppath").text();
                      $("#path").val(value);
                      }
                    });
                  $('input[name="speakingurl"]').on("keyup",function()  {
                    var value=$(this).val();
                    $("#last_path").val(getSlug(value));
                    $("#ppath span").text(getSlug(value));
                    var value=$("#ppath").text();
                    $("#path").val(value);
                    });
                  $('input[name="speakingurl"]').focusout(function()    {
                    var value=$(this).val();
                    $("#speakingurl").val(getSlug(value));
                    $("#last_path").val(getSlug(value));
                    $("#ppath span").text(getSlug(value));
                    var value=$("#ppath").text();
                    $("#path").val(value);
                    });
                </script>
              </span>
              </div>
            </div>
            <div class="panel-body">
              <span id="ppath"><?=REALPATHLANG.rtrim($trece->path,$trece->url_title);?><span><?=$dupeURLTitle ? $url_title : $trece->url_title;?></span></span><br>
              <input type="hidden" id="path" name="path" style="width:600px;" value="<?=REALPATHLANG.rtrim($trece->path,$trece->url_title).($dupeURLTitle ? $url_title : $trece->url_title);?>">
              <input type="hidden" id="last_path" name="last_path" style="width:600px;" value="<?=$dupeURLTitle ? $url_title : $trece->url_title;?>">
            </div>
          </div>
        </div>





  
      </div>

    </div>

    <div class="row">

      <div class="col-xs-12 col-sm-10 col-sm-offset-1">

        <div class="row">

          <div class="col-xs-12 col-sm-4">

            <div class="form-group">
              <label class="sr-only" for="img-mob">Imaxe de fondo vertical (móbiles):</label>
              <label for="img-mob">Imaxe de fondo vertical (móbiles):</label><br>
              <label class="item-img-mob">
                <figure>
                  <img src="<?=file_exists($conf["dir"]["images"].$action."_".$trece->ref."_mob.jpg")?$conf["dir"]["images"].$action."_".$trece->ref."_mob.jpg?".time():"https://fakeimg.pl/".$cconf["img"]["viewport_mob_w"]."x".$cconf["img"]["viewport_mob_h"]."/?text=Imaxe";?>" id="item-img-mob-output" class="img-responsive img-thumbnail">
                  <figcaption><i class="fa fa-camera"></i></figcaption>
                </figure>
                <input type="file" name="item-img-mob" id="item-img-mob" class="file center-block">
              </label>
              <div class="checkbox">
                <label><input type="checkbox" name="item-img-mob-remove" id="item-img-mob-remove" value="1"<?=!file_exists($conf["dir"]["images"].$action."_".$trece->ref."_mob.jpg")?" checked":"";?>> Sen imaxe (usar xenérica)</label>
              </div>
              <input type="hidden" id="item-img-mob-image" name="item-img-mob-image" value="">
            </div>

          </div>

          <div class="col-xs-12 col-sm-8">

            <div class="form-group">
              <label class="sr-only" for="img-web">Imaxe de fondo horizontal (ordenadores/tablets):</label>
              <label for="img-web">Imaxe de fondo horizontal (ordenadores/tablets):</label><br>
              <label class="item-img-web">
                <figure>
                  <img src="<?=file_exists($conf["dir"]["images"].$action."_".$trece->ref."_web.jpg")?$conf["dir"]["images"].$action."_".$trece->ref."_web.jpg?".time():"https://fakeimg.pl/".$cconf["img"]["viewport_web_w"]."x".$cconf["img"]["viewport_web_h"]."/?text=Imaxe";?>" id="item-img-web-output" class="img-responsive img-thumbnail">
                  <figcaption><i class="fa fa-camera"></i></figcaption>
                </figure>
                <input type="file" name="item-img-web" id="item-img-web" class="file center-block">
              </label>
              <div class="checkbox">
                <label><input type="checkbox" name="item-img-web-remove" id="item-img-web-remove" value="1"<?=!file_exists($conf["dir"]["images"].$action."_".$trece->ref."_web.jpg")?" checked":"";?>> Sen imaxe (usar xenérica)</label>
              </div>
              <input type="hidden" id="item-img-web-image" name="item-img-web-image" value="">
            </div>



            <div class="form-group">
              <label class="sr-only" for="intro"><?=$lCustom["intro"][LANG];?></label>
              <label for="intro"><?=$lCustom["intro"][LANG];?>:
                <a href="#intro_en" class="btn-xs btn-primary" data-toggle="tab">EN</a>
                <a href="#intro_gal" class="btn-xs" data-toggle="tab">GAL</a>
                <a href="#intro_es" class="btn-xs" data-toggle="tab">ES</a>
              </label><br>
              <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="intro_en">
                  <textarea name="intro_en" class="form-control" style="height:7em;" placeholder=""><?=$trece->intro_en;?></textarea>
                  <span class="help-block" id="intro_en_lettercounter"></span>
                </div>
                <div role="tabpanel" class="tab-pane fade in" id="intro_gal">
                  <textarea name="intro_gal" class="form-control" style="height:7em;" placeholder=""><?=$trece->intro_gal;?></textarea>
                  <span class="help-block" id="intro_gal_lettercounter"></span>
                </div>
                <div role="tabpanel" class="tab-pane fade in" id="intro_es">
                  <textarea name="intro_es" class="form-control" style="height:7em;" placeholder=""><?=$trece->intro_es;?></textarea>
                  <span class="help-block" id="intro_es_lettercounter"></span>
                </div>
              </div>
            </div>

          </div>

          <div class="col-xs-12">

            <div class="form-group">
              <label class="sr-only" for="post"><?=$lCustom["post"][LANG];?></label>
              <label for="post"><?=$lCustom["post"][LANG];?>:
                <a href="#post_en" class="btn-xs btn-primary" data-toggle="tab">EN</a>
                <a href="#post_gal" class="btn-xs" data-toggle="tab">GAL</a>
                <a href="#post_es" class="btn-xs" data-toggle="tab">ES</a>
              </label><br>
              <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="post_en">
                  <textarea name="post_en" class="form-control tinymce" style="height:7em;" placeholder=""><?=$trece->post_en;?></textarea>
                  <span class="help-block" id="post_en_lettercounter"></span>
                </div>
                <div role="tabpanel" class="tab-pane fade in" id="post_gal">
                  <textarea name="post_gal" class="form-control tinymce" style="height:7em;" placeholder=""><?=$trece->post_gal;?></textarea>
                  <span class="help-block" id="post_gal_lettercounter"></span>
                </div>
                <div role="tabpanel" class="tab-pane fade in" id="post_es">
                  <textarea name="post_es" class="form-control tinymce" style="height:7em;" placeholder=""><?=$trece->post_es;?></textarea>
                  <span class="help-block" id="post_es_lettercounter"></span>
                </div>
              </div>
            </div>

          </div>

          <div class="col-xs-12">

            <div class="form-group">
              <input type="text" id="ids_breadcrumb_trail" name="ids_breadcrumb_trail" class="form-control" value="<?=$trece->ids_breadcrumb_trail;?>">
              <button type="submit" class="btn btn-cons confirm-image"><?=$lCommon["save_changes"][LANG];?></button>
            </div>

          </div>

        </div>

      </div>

    </div>

    </form>

  </div>



  <div class="clearfix"></div>



  <div class="modal fade" id="crop-modal-mob-img" tabindex="-1" role="dialog" aria-labelledby="crop-modal-mob-label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="crop-modal-mob-label">Recortar imaxe</h4>
        </div>
        <div class="modal-body">
          <div id="modal-mob-img" class="center-block"></div>
        </div>
        <div class="modal-footer">
          <button type="button" id="cropImageBtn-mob" class="btn btn-primary">Recortar</button>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="crop-modal-web-img" tabindex="-1" role="dialog" aria-labelledby="crop-modal-web-label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="crop-modal-web-label">Recortar imaxe</h4>
        </div>
        <div class="modal-body">
          <div id="modal-web-img" class="center-block"></div>
        </div>
        <div class="modal-footer">
          <button type="button" id="cropImageBtn-web" class="btn btn-primary">Recortar</button>
        </div>
      </div>
    </div>
  </div>


  <script>
    $(function(){$('[data-toggle="tooltip"]').tooltip();});
  </script>



  <script>
  function sec1(sec1_id,sec2_id,sec3_id){
    if(typeof sec1_id !== "undefined" && sec1_id !== 0){
    $('#sec1').empty();
//  $("#sec1").append("<option>Loading...</option>");
    $('#sec1').append("<option value='null'></option>");
    sec2(sec1_id,sec2_id,sec3_id);
    }else{
    $('#sec1').empty();
    $('#sec1').append("<option value='null'></option>");
    $('#sec2').empty();
    $('#sec2').append("<option value='null'></option>");
    $('#sec3').empty();
    $('#sec3').append("<option value='null'></option>");
    }
    $.ajax({
      type:"GET",
      url: "<?=REALPATHLANG.$action."?json&ref=".$trece->ref."&q=0";?>",
      contentType:"application/json; charset=utf-8",
      dataType:"json",
      success: function(qqq){
        $("#sec1").empty();
        $("#sec1").append("<option value='null'></option>");
        $.each(qqq,function(index,item){
          $("#sec1").append('<option data-value="'+ item.value + '" data-url_title="/'+ item.url_title + '" value="'+ item.value +'"'+(sec1_id == item.value?" selected":"")+'>/'+ item.url_title +'</option>');
        });
      },complete: function(){}
    });
  }

  function sec2(sec1_id,sec2_id,sec3_id){
    if(typeof sec2_id !== "undefined" && sec2_id !== 0){
    $('#sec2').empty();
    $("#sec2").append("<option>Loading...</option>");
    sec3(sec2_id,sec3_id);
    }else{
    $('#sec2').empty();
    $('#sec2').append("<option value='null'></option>");
    $("#sec3").empty();
    $('#sec3').append("<option value='null'></option>");
    }
    $.ajax({
      type: "GET",
      url: "<?=REALPATHLANG.$action."?json&ref=".$trece->ref."&q=";?>"+sec1_id,
      contentType: "application/json; charset=utf-8",
      dataType: "json",
      success: function(qqq){
        $("#sec2").empty();
        $("#sec2").append("<option value='null'></option>");
        $.each(qqq,function(index,item){
          $("#sec2").append('<option data-value=",'+ item.value + '" data-url_title="/'+ item.url_title + '" value="'+ item.value +'"'+(sec2_id == item.value?" selected":"")+'>/'+ item.url_title +'</option>');
        });
      },error: function(){
        $("#sec2").empty();
        $("#sec2").append("<option value='null'></option>");
      },complete: function(){}
    });
  }

  function sec3(sec2_id,sec3_id){
    $('#sec3').empty();
    if(typeof sec3_id !== "undefined" && sec3_id !== 0){
    $("#sec3").append("<option>Loading...</option>");
    }else{
    $('#sec3').append("<option value='null'></option>");
    }
    $.ajax({
      type: "GET",
      url: "<?=REALPATHLANG.$action."?json&ref=".$trece->ref."&q=";?>"+sec2_id,
      contentType: "application/json; charset=utf-8",
      dataType: "json",
      success: function(qqq) {
        $("#sec3").empty();
        $("#sec3").append("<option value='null'></option>");
        $.each(qqq,function(index,item){
        $("#sec3").append('<option data-value=",'+ item.value + '" data-url_title="/'+ item.url_title + '" value="'+ item.value +'"'+(sec3_id == item.value?" selected":"")+'>/'+ item.url_title +'</option>');
        });
      },error: function(){
        $("#sec3").empty();
        $("#sec3").append("<option value='null'></option>");
      },complete: function(){}
    });
  }

  function doWritePath(){
    var path = "<?=defined("MULTILANG")?rtrim(REALPATHLANG,"/"):rtrim(REALPATH,"/");?>";
        path+= typeof $("#sec1").find(':selected').data('url_title') !== "undefined" ? $("#sec1").find(':selected').data('url_title') : "";
        path+= typeof $("#sec2").find(':selected').data('url_title') !== "undefined" ? $("#sec2").find(':selected').data('url_title') : "";
        path+= typeof $("#sec3").find(':selected').data('url_title') !== "undefined" ? $("#sec3").find(':selected').data('url_title') : "";
        path+= "/" + "<span>" + getSlug($("#speakingurl").val()) + "</span>";
//      alert(path);
    $("#ppath").html(path);
    $("#path").val($("#ppath").text());
    var ids_breadcrumb_trail = "";
        ids_breadcrumb_trail+= typeof $("#sec1").find(':selected').data('value') !== "undefined" ? $("#sec1").find(':selected').data('value') : "";
        ids_breadcrumb_trail+= typeof $("#sec2").find(':selected').data('value') !== "undefined" ? $("#sec2").find(':selected').data('value') : "";
        ids_breadcrumb_trail+= typeof $("#sec3").find(':selected').data('value') !== "undefined" ? $("#sec3").find(':selected').data('value') : "";
        ids_breadcrumb_trail+= "," + getSlug($("#speakingurl").val());
        ids_breadcrumb_trail = ids_breadcrumb_trail.replace(/(^,)|(,$)/g,"");
    $("#ids_breadcrumb_trail").val(ids_breadcrumb_trail);
  }
  </script>



  <?php if($msg&&$msgType!="danger") : ?>
  <script>$(".alert-dismissable").fadeTo(2000,500).slideUp(500,function(){$(".alert-dismissable").slideUp(500);});</script>
  <?php endif; ?>

  <script>
    $("[href^=\\#title_]").on("shown.bs.tab",function(e){$("[href^=\\#title_]").removeClass("btn-primary");$(this).addClass("btn-primary");});
    $("[href^=\\#intro_]").on("shown.bs.tab",function(e){$("[href^=\\#intro_]").removeClass("btn-primary");$(this).addClass("btn-primary");});
    $("[href^=\\#post_]").on("shown.bs.tab",function(e){$("[href^=\\#post_]").removeClass("btn-primary");$(this).addClass("btn-primary");});
  </script>

  <!-- Latest compiled and minified jQuery Mask Plugin from http://igorescobar.github.io/jQuery-Mask-Plugin/ -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/<?=$conf["version"]["jquery_mask"];?>/jquery.mask.min.js"></script>

  <script>
    $(document).ready(function() {

      sec1(<?=$trece->ids_breadcrumb_trail;?>);
      $("#sec1").change(function(){var sec1_id=$("#sec1").val();var sec2_id=null;var sec3_id=null;sec2(sec1_id,sec2_id,sec3_id);doWritePath()});
      $("#sec2").change(function(){var sec2_id=$("#sec2").val();var sec3_id=null;sec3(sec2_id,sec3_id);doWritePath();});
      $("#sec3").change(function(){doWritePath();});

      var text_max_title_en = 150; // https://seopressor.com/blog/google-title-meta-descriptions-length/
      var text_max_title_gal = 150;
      var text_max_title_es = 150;
      var text_max_intro_en = 150;
      var text_max_intro_gal = 150;
      var text_max_intro_es = 150;

      $("#title_en_lettercounter").html((text_max_title_en - <?=mb_strlen($trece->title_en,"utf8");?>) + " remaining.");
      $("#title_gal_lettercounter").html((text_max_title_gal - <?=mb_strlen($trece->title_gal,"utf8");?>) + " remaining.");
      $("#title_es_lettercounter").html((text_max_title_es - <?=mb_strlen($trece->title_es,"utf8");?>) + " remaining.");

      $("#intro_en_lettercounter").html((text_max_intro_en - <?=mb_strlen($trece->intro_en,"utf8");?>) + " remaining.");
      $("#intro_gal_lettercounter").html((text_max_intro_gal - <?=mb_strlen($trece->intro_gal,"utf8");?>) + " remaining.");
      $("#intro_es_lettercounter").html((text_max_intro_es - <?=mb_strlen($trece->intro_es,"utf8");?>) + " remaining.");

      $('textarea[name="title_en"]').on("keyup",function(event){
        var len_title_en = $(this).val().length;
        var text_length_title_en = $('textarea[name="title_en"]').val().length;
        var text_remaining_title_en = text_max_title_en - text_length_title_en;
        if (len_title_en >= text_max_title_en) {
          $(this).val($(this).val().substring(0,len_title_en-1));
        }
        $("#title_en_lettercounter").html(text_remaining_title_en + " remaining.");
      });

      $('textarea[name="title_gal"]').on("keyup",function(event){
        var len_title_gal = $(this).val().length;
        var text_length_title_gal = $('textarea[name="title_gal"]').val().length;
        var text_remaining_title_gal = text_max_title_gal - text_length_title_gal;
        if (len_title_gal >= text_max_title_gal) {
          $(this).val($(this).val().substring(0,len_title_gal-1));
        }
        $("#title_gal_lettercounter").html(text_remaining_title_gal + " remaining.");
      });

      $('textarea[name="title_es"]').on("keyup",function(event){
        var len_title_es = $(this).val().length;
        var text_length_title_es = $('textarea[name="title_es"]').val().length;
        var text_remaining_title_es = text_max_title_es - text_length_title_es;
        if (len_title_es >= text_max_title_es) {
          $(this).val($(this).val().substring(0,len_title_es-1));
        }
        $("#title_es_lettercounter").html(text_remaining_title_es + " remaining.");
      });

      $('textarea[name="intro_en"]').on("keyup",function(event){
        var len_intro_en = $(this).val().length;
        var text_length_intro_en = $('textarea[name="intro_en"]').val().length;
        var text_remaining_intro_en = text_max_intro_en - text_length_intro_en;
        if (len_intro_en >= text_max_intro_en) {
          $(this).val($(this).val().substring(0,len_intro_en-1));
        }
        $("#intro_en_lettercounter").html(text_remaining_intro_en + " remaining.");
      });

      $('textarea[name="intro_gal"]').on("keyup",function(event){
        var len_intro_gal = $(this).val().length;
        var text_length_intro_gal = $('textarea[name="intro_gal"]').val().length;
        var text_remaining_intro_gal = text_max_intro_gal - text_length_intro_gal;
        if (len_intro_gal >= text_max_intro_gal) {
          $(this).val($(this).val().substring(0,len_intro_gal-1));
        }
        $("#intro_gal_lettercounter").html(text_remaining_intro_gal + " remaining.");
      });

      $('textarea[name="intro_es"]').on("keyup",function(event){
        var len_intro_es = $(this).val().length;
        var text_length_intro_es = $('textarea[name="intro_es"]').val().length;
        var text_remaining_intro_es = text_max_intro_es - text_length_intro_es;
        if (len_intro_es >= text_max_intro_es) {
          $(this).val($(this).val().substring(0,len_intro_es-1));
        }
        $("#intro_es_lettercounter").html(text_remaining_intro_es + " remaining.");
      });

    });
  </script>



  <script>

    window.onclick = e => {
      var qq = e.target.getAttribute("id");
      var arr=["item-img-mob","item-img-web"];

      if(arr.indexOf(qq) != -1){

        switch (qq) {
        case "item-img-mob":
          var w = <?=$cconf["img"]["w_mob"];?>;                                      // console.log("w: "+w);
          var h = <?=$cconf["img"]["h_mob"];?>;                                      // console.log("h: "+h);
          var viewport_w = <?=$cconf["img"]["viewport_mob_w"];?>;                    // console.log("viewport_w: "+viewport_w);
          var viewport_h = <?=$cconf["img"]["viewport_mob_h"];?>;                    // console.log("viewport_h: "+viewport_h);
          break;
        case "item-img-web":
          var w = <?=$cconf["img"]["w_web"];?>;                                      // console.log("w: "+w);
          var h = <?=$cconf["img"]["h_web"];?>;                                      // console.log("h: "+h);
          var viewport_w = <?=$cconf["img"]["viewport_web_w"];?>;                    // console.log("viewport_w: "+viewport_w);
          var viewport_h = <?=$cconf["img"]["viewport_web_h"];?>;                    // console.log("viewport_h: "+viewport_h);
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



  <!-- TinyMCE -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/<?=$conf["version"]["tinymce"];?>/tinymce.min.js"></script>
  <script>
    tinyMCE.PluginManager.add("stylebuttons",function(editor,url){["h1", "h2", "h3"].forEach(function(name){
      editor.addButton("style-"+name,{
        tooltip: "Toggle "+name,
        text: name.toUpperCase(),
        onClick: function(){editor.execCommand("mceToggleFormat",false,name);},
        onPostRender: function(){var self=this,setup=function(){editor.formatter.formatChanged(name,function(state){self.active(state);});};editor.formatter?setup():editor.on('init',setup);}
        })
      });
    });

    tinymce.init({
      selector: "textarea.tinymce",
      menubar: false,
      plugins: [ "fullscreen visualblocks autolink charmap image link media hr paste wordcount lists code stylebuttons table" ],
      toolbar: "fullscreen visualblocks | style-h1 style-h2 style-h3 | table | bold italic strikethrough | bullist numlist insert code",
      relative_urls : false,
      remove_script_host : true,
      document_base_url : "<?=REALPATH;?>",
      table_toolbar: "tableprops tabledelete | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol",
      table_cell_advtab: false,
//    imagetools_toolbar: "rotateleft rotateright | flipv fliph | editimage imageoptions",
      visualblocks_default_state: true,
      inline_boundaries: true,
      image_dimensions: true,
      file_picker_types: "file image media",
      image_class_list: [{title:"Responsive", value:"img-responsive"},{title:"Alin. izquerda", value:"img-pull-left pull-left"},{title:"Alin. derecha", value:"img-pull-right pull-right"}],
      file_browser_callback: function(field_name,url,type,win){var filebrowser="<?=$conf["site"]["virtualpath"];?>?filebrowser";filebrowser+=(filebrowser.indexOf("?")<0)?"?type="+type:"&type="+type;tinymce.activeEditor.windowManager.open({title:"File browser",width:520,height:400,url:filebrowser},{window:win,input:field_name});return false;},
      images_upload_url: "<?=REALPATHLANG.$conf["site"]["virtualpathArray"][0]."/".$conf["site"]["virtualpathArray"][1];?>",
//    images_upload_url: "<?=$conf["site"]["virtualpath"];?>",
      images_upload_handler: function(blobInfo,success,failure){
        var xhr,formData;
        xhr=new XMLHttpRequest();
        xhr.withCredentials=false;
        xhr.open("POST","<?=$conf["site"]["virtualpath"];?>");
        xhr.onload=function(){var json;if(xhr.status!=200){failure("HTTP Error: "+xhr.status);return;}json=JSON.parse(xhr.responseText);if(!json||typeof json.location!="string"){failure("Invalid JSON: "+xhr.responseText);return;}success(json.location);};
        formData = new FormData();
        formData.append("file",blobInfo.blob(),blobInfo.filename());
        xhr.send(formData);
      },
/*
      external_filemanager_path: "filemanager/",
      filemanager_title: "Responsive Filemanager",
      external_plugins: {
        "responsivefilemanager": "../../tinymce/plugins/responsivefilemanager/plugin.min.js",
        "filemanager": "../../filemanager/plugin.min.js"
      },
      extended_valid_elements: 'img[class="your-custom-class-name"|src|border=0|alt|title|hspace|vspace|align|onmouseover|onmouseout|name]',
*/
      entity_encoding: "raw",
      paste_as_text: true,
      paste_word_valid_elements: "b,strong,i,em,h1,h2",
      paste_retain_style_properties: "color",
      height: 400,
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