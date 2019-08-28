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



# ...................................................................................
# ..#####..######.##.....######.######.######...######.##...##..####...####..######..
# ..##..##.##.....##.....##.......##...##.........##...###.###.##..##.##.....##......
# ..##..##.####...##.....####.....##...####.......##...##.#.##.######.##.###.####....
# ..##..##.##.....##.....##.......##...##.........##...##...##.##..##.##..##.##......
# ..#####..######.######.######...##...######...######.##...##.##..##..####..######..
# ...................................................................................

  if(isset($_POST["deleteImage"]) && isset($_POST["object_who"])) :

    $items = explode("↲",$_POST["object_who"]);
    foreach($items as $item) : if(file_exists($item)) : unlink($item); endif; endforeach;
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

    unset($_FILES);
    $msg = true;

    if(isset($_POST["title"]))                : $trece->title                     = htmlspecialchars_decode(trim(preg_replace("/[[:blank:]]+/"," ",$_POST["title"])));
                                                $trece->url_title                 = getUrlFriendlyString($trece->title);                                        endif;
    if(isset($_POST["ids_breadcrumb_trail"])) : $trece->ids_breadcrumb_trail      = $_POST["ids_breadcrumb_trail"];                                             
                                                $trece->id_parent                 = explode(",",$trece->ids_breadcrumb_trail); end($trece->id_parent);
                                                $trece->id_parent                 = prev($trece->id_parent);                                                    endif;
    if(isset($_POST["intro"]))                : $trece->intro                     = $_POST["intro"];                                                            endif;
    if(isset($_POST["post"]))                 : $trece->post                      = $_POST["post"];                                                             endif;

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



# ......##..........................................
# ...########...........######...########.########..
# ..##..##..##.........##....##..##..........##.....
# ..##..##.............##........##..........##.....
# ...########..........##...####.######......##.....
# ......##..##.........##....##..##..........##.....
# ..##..##..##.........##....##..##..........##.....
# ...########..#######..######...########....##.....
# ......##..........................................



# .................................................................................
# ..######.######.##.....######.#####..#####...####..##...##..####..######.#####...
# ..##.......##...##.....##.....##..##.##..##.##..##.##...##.##.....##.....##..##..
# ..####.....##...##.....####...#####..#####..##..##.##.#.##..####..####...#####...
# ..##.......##...##.....##.....##..##.##..##.##..##.#######.....##.##.....##..##..
# ..##.....######.######.######.#####..##..##..####...##.##...####..######.##..##..
# .................................................................................

  if(isset($_GET["filebrowser"])) : ?>

    <style>
      a.file{cursor:pointer;}
      a.delete{cursor:pointer;}
/*    .file img{max-height:100px;max-width:100px;} */
      div.thumbs ul{list-style-type:none;padding:0;}
      div.thumbs li{display:inline-block;position:relative;}
      div.thumbs li img{border:2px solid #fff;transition-duration:0.2s;transform-origin:50% 50%;}
      div.thumbs li div.check div.rightblock{text-align:right;visibility:hidden;opacity:0;transition:visibility 0s,opacity 0.3s linear;position:absolute;display:inline-block;bottom:.2em;right:.2em;line-height:1em;z-index:1000 !important;}
      div.thumbs li div.check div.leftblock{text-align:left;visibility:hidden;opacity:0;transition:visibility 0s,opacity 0.3s linear;position:absolute;display:inline-block;bottom:.2em;left:.2em;line-height:1em;z-index:1000 !important;}
      div.thumbs li div.check:hover img{box-shadow:0 0 5px #333;transform:scale(1.1);z-index:1000 !important;}
      div.thumbs li div.check:hover div.rightblock{visibility:visible;opacity:1;}
      div.thumbs li div.check:hover div.leftblock{visibility:visible;opacity:1;}
      div.thumbs li div.rightblock span,div.thumbs li div.leftblock span{background-color:grey;padding:.2em;}
      div.thumbs li div.rightblock a,div.thumbs li div.leftblock a{text-decoration:none;font-family:sans-serif;font-size:.6em;margin:1em 0;}
      div.thumbs li div.rightblock a:hover span{background-color:yellow;}
      div.thumbs li div.leftblock a:hover span{background-color:red;}
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/<?=$conf["version"]["jquery_confirm"];?>/jquery-confirm.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/<?=$conf["version"]["jquery"];?>/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/<?=$conf["version"]["jquery_confirm"];?>/jquery-confirm.min.js"></script>
    <script>
      jconfirm.defaults={title:"",titleClass:"",type:"default",typeAnimated:!0,draggable:!0,dragWindowGap:30,dragWindowBorder:!0,animateFromElement:!1,smoothContent:!0,content:"",buttons:{},defaultButtons:{ok:{action:function(){}},close:{action:function(){}},},contentLoaded:function(data,status,xhr){},icon:"",lazyOpen:!1,bgOpacity:null,theme:"bootstrap",animation:"bottom",closeAnimation:"bottom",animationBounce:2,animationSpeed:400,rtl:!1,container:"body",containerFluid:!1,backgroundDismiss:!1,backgroundDismissAnimation:"shake",autoClose:!1,closeIcon:!0,closeIconClass:"fa fa-close",watchInterval:100,columnClass:"col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1",boxWidth:"50%",scrollToPreviousElement:!0,scrollToPreviousElementAnimate:!0,useBootstrap:!0,offsetTop:40,offsetBottom:40,bootstrapClasses:{container:"container",containerFluid:"container-fluid",row:"row",},onContentReady:function(){},onOpenBefore:function(){},onOpen:function(){},onClose:function(){},onDestroy:function(){},onAction:function(){},}
    </script>
    <div class="row">
      <div class="thumbs">
        <ul>
<?php foreach(glob($conf["dir"]["images"]."*.{jpg,JPG,jpeg,JPEG,png,PNG}",GLOB_BRACE) as $file): ?>
<?php if((substr(basename($file),0,13+(strlen($action)))===$action."-img-".$trece->ref) && (substr(substr(basename($file),0,strrpos(basename($file),".")),-6) === "_thumb")) : ?>
  <?php $ext = substr($file,strrpos($file,".")+1); ?>
  <?php $base = substr($file,0,strrpos($file,".")); $base = str_replace_plus("lo","_thumb","",$base); ?>
          <li>
            <div class="check">
              <img src="<?=REALPATH.$conf["dir"]["images"].basename($file);?>">
              <div class="rightblock">
                <a class="file" data-src="<?=$base."_img.".$ext;?>" href=""><span><?=$cconf["img"]["post_max_img"];?> px.</span></a><br>
                <a class="file" data-src="<?=$base."_icon.".$ext;?>" href=""><span><?=$cconf["img"]["post_max_icon"];?> px.</span></a><br>
                <a class="file" data-src="<?=$base."_thumb.".$ext;?>" href=""><span><?=$cconf["img"]["post_max_thumb"];?> px.</span></a>
              </div>
              <div class="leftblock">
                <a class="delete" data-img="<?=$base."_img.".$ext;?>" data-icon="<?=$base."_icon.".$ext;?>" data-thumb="<?=$base."_thumb.".$ext;?>"><span>Delete</span></a>
              </div>
            </div>
          </li>
<?php endif; ?>
<?php endforeach; ?>
        </ul>
      </div>
    </div><!-- row -->

    <script>
      $("a.file").on("click",function(){
        item_url = $(this).data("src");
        var args = top.tinymce.activeEditor.windowManager.getParams();
        win = (args.window);
        input = (args.input);
        win.document.getElementById(input).value = item_url;
        top.tinymce.activeEditor.windowManager.close();
      });
    </script>
    <script>
      function deleteImage(who){
        $.post([location.protocol,'//',location.host,location.pathname].join(''),{deleteImage:true,object_who:who},function(data){
          location.reload();
//        alert(data);
          });
        };
      $("a.delete").on("click",function(){
        var who = $(this).data("img")+"↲"+$(this).data("icon")+"↲"+$(this).data("thumb");
        $.confirm({
          content: "<div style=\"float:left;\"><h3>Delete?</h3></div>"+
                   "<div style=\"float:right;\"><img src=\"<?=REALPATH;?>"+$(this).data("thumb")+"\" style=\"width:80px;\"></div>",
          boxWidth: "50%",
          useBootstrap: false,
          buttons:{
            confirm:{text:"<?=$lCommon["accept"][LANG];?>",action:function(){deleteImage(who);}},
            cancel:{text:"<?=$lCommon["cancel"][LANG];?>",action:function(){}},
            }
          });
        });
    </script>
<?php die(); endif;

# .. END FILEBROWSER
# .................................................................................



# ...................................................................................
# ..##..##.#####..##......####...####..#####....######.##...##..####...####..######..
# ..##..##.##..##.##.....##..##.##..##.##..##.....##...###.###.##..##.##.....##......
# ..##..##.#####..##.....##..##.######.##..##.....##...##.#.##.######.##.###.####....
# ..##..##.##.....##.....##..##.##..##.##..##.....##...##...##.##..##.##..##.##......
# ...####..##.....######..####..##..##.#####....######.##...##.##..##..####..######..
# ...................................................................................

  $accepted_origins = array("http://localhost"); # Allowed origins to upload images
//$accepted_origins = array("http://localhost", "http://xxx.xxx.xxx.xxx", "https://whatever.com");

  if(isset($_FILES)) :

    reset($_FILES); $temp = current($_FILES);

    if(is_uploaded_file($temp["tmp_name"])) :
      $filename = explode(".",$temp["name"]);
      $filename = $conf["dir"]["images"].$action."-img-".$trece->ref."-".uniqid();
      if(isset($_SERVER["HTTP_ORIGIN"])) : if(in_array($_SERVER["HTTP_ORIGIN"],$accepted_origins)) : header("Access-Control-Allow-Origin: ".$_SERVER["HTTP_ORIGIN"]); else : header("HTTP/1.1 403 Origin Denied"); return; endif; endif;
      $extension = strtolower(pathinfo($temp["name"],PATHINFO_EXTENSION));
      if(!in_array($extension,array("gif","jpg","jpeg","png"))) : header("HTTP/1.1 400 Invalid extension."); return; endif;
      if($extension == "jpeg") : $extension = "jpg"; endif;
      $extensionf = $extension == "jpg" ? "jpeg" : $extension;
      $imagecreatefrom = "imagecreatefrom".$extensionf;
      $image = "image".$extensionf;
      move_uploaded_file($temp["tmp_name"],$filename.".".$extension);
      $source = @$imagecreatefrom($filename.".".$extension);
      fixImageOrientation($source,$filename.".".$extension);
      if($source){$image($source,$filename.".".$extension); }
      list($width,$height) = getimagesize($filename.".".$extension);
      if($width>$height) : $max_height=$cconf["img"]["post_max_img"];$max_width=floor($width*($max_height/$height)); endif;
      if($height>$width || $height==$width) : $max_width=$cconf["img"]["post_max_img"];$max_height=floor($height*($max_width/$width)); endif;
      resizeImage($source,$filename."_img".".".$extension,$width,$height,$max_width,$max_height);
      if($width>$height) : $max_height=$cconf["img"]["post_max_icon"];$max_width=floor($width*($max_height/$height)); endif;
      if($height>$width || $height==$width) : $max_width=$cconf["img"]["post_max_icon"];$max_height=floor($height*($max_width/$width)); endif;
      resizeImage($source,$filename."_icon".".".$extension,$width,$height,$max_width,$max_height);
      resizeImage($source,$filename."_thumb".".".$extension,$width,$height,$cconf["img"]["post_max_thumb"],$cconf["img"]["post_max_thumb"]);
      imagedestroy($source); if(file_exists($filename.".".$extension)) : unlink($filename.".".$extension); endif; # CLEAN THE CRIME SCENE
      echo json_encode(array("location"=>$filename."_img".".".$extension));
      die();
    else : header("HTTP/1.1 500 Server Error");
    endif;

  endif;

# .. END UPLOAD IMAGE
# ...................................................................................



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

//metastuff
  $lCustom["pagetitle"][LANG] = $lCustom["edit"][LANG];
  $lCustom["metadescription"][LANG] = "La metadescription"; # 160 char text
  $lCustom["metakeywords"] = "key word keyword";
  $lCustom["og_image"] = "https://ddfsdf.com"; # 1200x630 px image



   $customJS = <<<EOD
  <script>
    /* whatever */
  </script>
EOD;
  $customCSS = <<<EOD
  <style>
    div.mce-fullscreen{z-index:1050;}
    a.tit-btn{text-decoration:none;}
    a.tit-btn:hover:not(.btn-primary){background:#eee;}
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
          <label class="sr-only" for="title"><?=$lCustom["breadcrum_trail"][LANG];?></label>
          <label for="id_breadcrum_trail"><?=$lCustom["breadcrum_trail"][LANG];?>:</label><br>

          <div class="panel panel-default">
            <div class="panel-heading">
              <span><?=REALPATH;?><?=LANG;?></span>
              <select id="sec1" name="sec1" class=""></select>
              <select id="sec2" name="sec2" class=""></select>
              <select id="sec3" name="sec3" class=""></select>
              <span>/<?=$trece->url_title;?></span>
            </div>
            <div class="panel-body">
              <input type="text" id="path" name="path" class="form-control" value="<?=REALPATHLANG.$trece->path;?>" readonly>
            </div>
          </div>

        </div>
  
      </div>

    </div>

    <div class="row">

      <div class="col-xs-12 col-sm-10 col-sm-offset-1">

        <div class="row">

          <div class="col-xs-12 col-sm-12 col-lg-4">

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
              <div id="crop-image"></div>
            </div>

          </div>

          <div class="col-xs-12 col-sm-12 col-lg-7 col-lg-offset-1">

            <div class="form-group">
              <label class="sr-only" for="title"><?=$lCustom["title"][LANG];?></label>
              <label for="title"><?=$lCustom["title"][LANG];?>:</label><br>
              <input type="text" id="title" name="title" class="form-control input-lg" placeholder="<?=$lCustom["title"][LANG];?>" value="<?=htmlspecialchars($trece->title);?>">
              <span class="help-block" id="title_lettercounter"></span>
            </div>

            <div class="form-group">
              <label class="sr-only" for="intro"><?=$lCustom["intro"][LANG];?></label>
              <label for="intro"><?=$lCustom["intro"][LANG];?>:</label><br>
              <textarea id="intro" name="intro" class="form-control" placeholder=""><?=$trece->intro;?></textarea>
              <span class="help-block" id="intro_lettercounter"></span>
            </div>

          </div>

          <div class="col-xs-12">

            <div class="form-group">
              <label class="sr-only" for="post"><?=$lCustom["post"][LANG];?></label>
              <label for="post"><?=$lCustom["post"][LANG];?>:</label><br>
              <textarea id="post" name="post" class="form-control tinymce" placeholder=""><?=$trece->post;?></textarea>
            </div>

          </div>

          <div class="col-xs-12">

            <div class="form-group">
              <input type="hidden" id="cropData1" name="cropData1">
              <input type="hidden" id="cropData2" name="cropData2">
              <input type="hidden" id="imagebase64" name="imagebase64">
              <input type="hidden" id="ids_breadcrumb_trail" name="ids_breadcrumb_trail" class="form-control" value="<?=$trece->ids_breadcrumb_trail;?>">
              <button type="submit" class="btn btn-cons confirm-image"><?=$lCommon["save_changes"][LANG];?></button>
            </div>

          </div>

        </div>

      </div>

    </div>

    </form>

  </div>



  <div class="clearfix"></div>



  <script>
    $(function(){$('[data-toggle="tooltip"]').tooltip();});
  </script>



  <script>
  function sec1(sec1_id,sec2_id,sec3_id){
    if(typeof sec1_id !== "undefined" && sec1_id !== 0){
    $('#sec1').empty();
    $("#sec1").append("<option>Loading...</option>");
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
    var path = "<?=REALPATH.LANG;?>";
        path+= typeof $("#sec1").find(':selected').data('url_title') !== "undefined" ? $("#sec1").find(':selected').data('url_title') : "";
        path+= typeof $("#sec2").find(':selected').data('url_title') !== "undefined" ? $("#sec2").find(':selected').data('url_title') : "";
        path+= typeof $("#sec3").find(':selected').data('url_title') !== "undefined" ? $("#sec3").find(':selected').data('url_title') : "";
        path+= "/<?=$trece->url_title;?>";
    $("#path").val(path);
    var ids_breadcrumb_trail = "";
        ids_breadcrumb_trail+= typeof $("#sec1").find(':selected').data('value') !== "undefined" ? $("#sec1").find(':selected').data('value') : "";
        ids_breadcrumb_trail+= typeof $("#sec2").find(':selected').data('value') !== "undefined" ? $("#sec2").find(':selected').data('value') : "";
        ids_breadcrumb_trail+= typeof $("#sec3").find(':selected').data('value') !== "undefined" ? $("#sec3").find(':selected').data('value') : "";
        ids_breadcrumb_trail+= ",<?=$trece->id;?>";
        ids_breadcrumb_trail = ids_breadcrumb_trail.replace(/(^,)|(,$)/g,"");
    $("#ids_breadcrumb_trail").val(ids_breadcrumb_trail);
  }
  </script>



  <!-- Latest compiled and minified jQuery Mask Plugin from http://igorescobar.github.io/jQuery-Mask-Plugin/ -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/<?=$conf["version"]["jquery_mask"];?>/jquery.mask.min.js"></script>

  <script>
    $(document).ready(function() {

      sec1(<?=$trece->ids_breadcrumb_trail;?>);
      $("#sec1").change(function(){var sec1_id=$("#sec1").val();var sec2_id=null;var sec3_id=null;sec2(sec1_id,sec2_id,sec3_id);doWritePath()});
      $("#sec2").change(function(){var sec2_id=$("#sec2").val();var sec3_id=null;sec3(sec2_id,sec3_id);doWritePath();});
      $("#sec3").change(function(){doWritePath();});

      var text_max_title = 55; // https://seopressor.com/blog/google-title-meta-descriptions-length/
      var text_max_intro = 160;
      $("#title_lettercounter").html((text_max_title - <?=mb_strlen($trece->title,"utf8");?>)+" remaining.");
      $("#intro_lettercounter").html((text_max_intro - <?=mb_strlen($trece->intro,"utf8");?>)+" remaining.");

      $('input[name="title"]').on("keyup",function(event){
        var len_title = $(this).val().length;
        var text_length_title = $('input[name="title"]').val().length;
        var text_remaining_title = text_max_title-text_length_title;
        if (len_title >= text_max_title) {
          $(this).val($(this).val().substring(0,len_title-1));
        }
        $("#title_lettercounter").html(text_remaining_title+" remaining.");
      });

      $('textarea[name="intro"]').on("keyup",function(event){
        var len_intro = $(this).val().length;
        var text_length_intro = $('textarea[name="intro"]').val().length;
        var text_remaining_intro = text_max_intro-text_length_intro;
        if (len_intro >= text_max_intro) {
          $(this).val($(this).val().substring(0,len_intro-1));
        }
        $("#intro_lettercounter").html(text_remaining_intro+" remaining.");
      });

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
  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/<?=$conf["version"]["croppie"];?>/croppie.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/<?=$conf["version"]["croppie"];?>/croppie.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/exif-js/<?=$conf["version"]["exif_js"];?>/exif.min.js"></script>
  <script>
    var thePic="<?=$trece->gotPic?$conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg?".time():"https://fakeimg.pl/".$cconf["img"]["viewport_w"]."x".$cconf["img"]["viewport_h"]."/?text=".$lCustom["singular"][LANG];?>";

    function resetCroppie(){destroyCroppie();initCroppie();}function destroyCroppie(){$uploadCrop.croppie("destroy");}function deleteCroppie(){$.post("",{deleteImage:true,object_who:"<?=$conf["dir"]["images"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg";?>↲<?=$conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg";?>↲<?=$conf["dir"]["images"].$conf["css"]["thumb_prefix"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg";?>"},function(data){$("#img-delete").remove();$uploadCrop.croppie("bind",{url:"https://fakeimg.pl/<?=$cconf["img"]["viewport_w"];?>x<?=$cconf["img"]["viewport_h"];?>/?text=<?=$lCustom["singular"][LANG];?>"});}).fail(function(){alert("<?=addslashes($lCommon["cannot_be_deleted"][LANG]);?>");});}function initCroppie(){$uploadCrop=$("#crop-image").croppie({enableExif:true,viewport:{width:<?=$cconf["img"]["viewport_w"];?>,height:<?=$cconf["img"]["viewport_h"];?>,type:"square"},boundary:{width:<?=$cconf["img"]["viewport_w"];?>,height:<?=$cconf["img"]["viewport_h"];?>}});}$uploadCrop=$("#crop-image").croppie({enableExif:true,viewport:{width:<?=$cconf["img"]["viewport_w"];?>,height:<?=$cconf["img"]["viewport_h"];?>,type:"square"},boundary:{width:<?=$cconf["img"]["viewport_w"];?>,height:<?=$cconf["img"]["viewport_h"];?>}});$("#cropData1").val(JSON.stringify($("#crop-image").croppie("get")));$uploadCrop.croppie("bind",{url:thePic},function(){$("#cropData1").val(JSON.stringify($("#crop-image").croppie("get")));});$("#img-delete").on("click",function(ev){var q=confirm("<?=$lCommon["are_you_sure"][LANG];?>");if(q==true){$("#imagebase64").val("nopic");deleteCroppie();}return false;});$("#img-delete").hover(function(){$(this).animate({fontSize:"3.8rem"});},function(){$(this).animate({fontSize:"2.8rem"});});$("#upload").on("change",function(){resetCroppie();var reader=new FileReader();reader.onload=function(e){$uploadCrop.croppie("bind",{url:e.target.result}).then(function(){console.log("jQuery bind complete");});};reader.readAsDataURL(this.files[0]);});$("#img-upload").hover(function(){$(this).animate({fontSize:"4rem"});},function(){$(this).animate({fontSize:"3rem"});});$(".confirm-image").on("click",function(ev){if(($("#cropData1").val()!=$("#cropData2").val())&&($("#imagebase64").val!=""||$("#imagebase64").val!="nopic")){ev.preventDefault();$uploadCrop.croppie("result",{type:"canvas",size:{width:<?=$cconf["img"]["canvas_w"];?>,height:<?=$cconf["img"]["canvas_h"];?>},format:"jpeg",quality:0.9}).then(function(resp){$("#imagebase64").val(resp);});};setTimeout(function(){$("#form").submit();},10);});$("#crop-image").on("update.croppie",function(ev,cropData){$("#cropData2").val(JSON.stringify(cropData));});
  </script>



  <!-- TinyMCE -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/<?=$conf["version"]["tinymce"];?>/tinymce.min.js"></script>
  <script>
    tinymce.init({
      selector: "textarea.tinymce",
      menubar: false,
      plugins: [ "fullscreen visualblocks autolink charmap image link media paste wordcount lists code" ],
      toolbar: "fullscreen visualblocks bold italic strikethrough bullist numlist link image charmap code",
      visualblocks_default_state: true,
      inline_boundaries: true,
      image_dimensions: false,
      image_class_list: [{title:"Responsive", value:"img-responsive"}],
      file_browser_callback : function(field_name,url,type,win){var filebrowser="<?=$conf["site"]["virtualpath"];?>?filebrowser";filebrowser+=(filebrowser.indexOf("?")<0)?"?type="+type:"&type="+type;tinymce.activeEditor.windowManager.open({title:"Insertar fichero",width:520,height:400,url:filebrowser},{window:win,input:field_name});return false;},
      images_upload_url: "<?=$conf["site"]["virtualpath"];?>",
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
      entity_encoding : "raw",
      paste_as_text: true,
      paste_word_valid_elements: "b,strong,i,em,h1,h2",
      paste_retain_style_properties: "color",
      height: 400,
      content_css: [
        "https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i",
        "../css/tinymce.css?" + new Date().getTime(),
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
