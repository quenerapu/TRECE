<?php if(!defined("TRECE")):header("location:/");die();endif; ?>
<?php
//BLOG

# ..........................................
# ..########..##........#######...######....
# ..##.....##.##.......##.....##.##....##...
# ..##.....##.##.......##.....##.##.........
# ..########..##.......##.....##.##...####..
# ..##.....##.##.......##.....##.##....##...
# ..##.....##.##.......##.....##.##....##...
# ..########..########..#######...######....
# ..........................................

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

  if(isset($_POST["title_en"])) :

    unset($_FILES);
    $msg = true;

    if(isset($_POST["date"]))       : $trece->date          = $_POST["date"]!=""?date("Y-m-d",strtotime(str_replace("/","-",$_POST["date"]))):"0000-00-00"; endif;
    if(isset($_POST["title_en"]))   : $trece->title_en      = htmlspecialchars_decode(trim(preg_replace("/[[:blank:]]+/"," ",$_POST["title_en"])));
                                      $trece->url_title_en  = $trece->date."-".getUrlFriendlyString($trece->title_en);                                      endif;
    if(isset($_POST["intro_en"]))   : $trece->intro_en      = $_POST["intro_en"];                                                                           endif;
    if(isset($_POST["post_en"]))    : $trece->post_en       = $_POST["post_en"];                                                                            endif;
    if(isset($_POST["title_gal"]))  : $trece->title_gal     = htmlspecialchars_decode(trim(preg_replace("/[[:blank:]]+/"," ",$_POST["title_gal"])));
                                      $trece->url_title_gal = $trece->date."-".getUrlFriendlyString($trece->title_gal);                                     endif;
    if(isset($_POST["intro_gal"]))  : $trece->intro_gal     = $_POST["intro_gal"];                                                                          endif;
    if(isset($_POST["post_gal"]))   : $trece->post_gal      = $_POST["post_gal"];                                                                           endif;
    if(isset($_POST["title_es"]))   : $trece->title_es      = htmlspecialchars_decode(trim(preg_replace("/[[:blank:]]+/"," ",$_POST["title_es"])));
                                      $trece->url_title_es  = $trece->date."-".getUrlFriendlyString($trece->title_es);                                      endif;
    if(isset($_POST["intro_es"]))   : $trece->intro_es      = $_POST["intro_es"];                                                                           endif;
    if(isset($_POST["post_es"]))    : $trece->post_es       = $_POST["post_es"];                                                                            endif;
    if(isset($_POST["ids_labels"])) : $trece->ids_labels    = $_POST["ids_labels"];                                                                         endif;

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

  $title_en         = isset($trece->title_en)?$trece->title_en:$cconf["default"]["title_en"];
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
          <div id="crop-image"></div>
        </div>

      </div>

      <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-lg-5">

        <div class="form-group">
          <label class="sr-only" for="date"><?=$lCustom["date"][LANG];?>:</label>
          <label for="date"><?=$lCustom["date"][LANG];?>:</label><br>
          <div class="input-group date col-xs-12 col-sm-5" id="date">
            <input type="text" name="date" class="form-control date" value="<?=$trece->date=="0000-00-00"?"":(date($conf["site"]["langs"][LANG]["date-format"],strtotime($trece->date)));?>" placeholder="">
            <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
          </div>
        </div>

        <div class="form-group">
          <?php $title_length = 55; ?>
          <label class="sr-only" for="title"><?=$lCustom["title"][LANG];?>:</label>
          <label for="title"><?=$lCustom["title"][LANG];?>:
            <a href="#title_en" class="btn-xs btn-primary" data-toggle="tab">EN</a>
            <a href="#title_gal" class="btn-xs" data-toggle="tab">GAL</a>
            <a href="#title_es" class="btn-xs" data-toggle="tab">ES</a>
          </label><br>
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="title_en">
              <textarea name="title_en" class="form-control" style="height:3.5em;font-size:2em;" placeholder=""><?=$trece->title_en;?></textarea>
              <p class="help-block"><span id="title_en_lettercounter"></span> <i class="fa fa-external-link" aria-hidden="true"></i> <a href="https://seopressor.com/blog/google-title-meta-descriptions-length/" target="_blank">About title length</a></p>
            </div>
            <div role="tabpanel" class="tab-pane fade in" id="title_gal">
              <textarea name="title_gal" class="form-control" style="height:3.5em;font-size:2em;" placeholder=""><?=$trece->title_gal;?></textarea>
              <p class="help-block"><span id="title_gal_lettercounter"></span> <i class="fa fa-external-link" aria-hidden="true"></i> <a href="https://seopressor.com/blog/google-title-meta-descriptions-length/" target="_blank">About title length</a></p>
            </div>
            <div role="tabpanel" class="tab-pane fade in" id="title_es">
              <textarea name="title_es" class="form-control" style="height:3.5em;font-size:2em;" placeholder=""><?=$trece->title_es;?></textarea>
              <p class="help-block"><span id="title_es_lettercounter"></span> <i class="fa fa-external-link" aria-hidden="true"></i> <a href="https://seopressor.com/blog/google-title-meta-descriptions-length/" target="_blank">About title length</a></p>
            </div>
          </div>
        </div>


        <div class="form-group">
          <label class="sr-only" for="ids_labels"><?=$lCustom["labels"][LANG];?>:</label>
          <label for="ids_labels"><?=$lCustom["labels"][LANG];?>:</label><br>
          <input type="text" id="ids_labels" name="ids_labels" class="form-control" placeholder="" data-foradditem="<?=trim($trece->ids_labels,"'");?>" data-foraddoption='[<?=html_entity_decode($trece->jsonlabels);?>]' value="">
        </div>

      </div>

      <div class="col-xs-12 col-sm-10 col-sm-offset-1">

        <div class="form-group">
          <?php $intro_length = 164; ?>
          <label class="sr-only" for="intro"><?=$lCustom["intro"][LANG];?>:</label>
          <label for="intro"><?=$lCustom["intro"][LANG];?>:
            <a href="#intro_en" class="btn-xs btn-primary" data-toggle="tab">EN</a>
            <a href="#intro_gal" class="btn-xs" data-toggle="tab">GAL</a>
            <a href="#intro_es" class="btn-xs" data-toggle="tab">ES</a>
          </label><br>
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="intro_en">
              <textarea name="intro_en" class="form-control" style="height:7em;" placeholder=""><?=$trece->intro_en;?></textarea>
              <p class="help-block"><span id="intro_en_lettercounter"></span> <i class="fa fa-external-link" aria-hidden="true"></i> <a href="https://blog.spotibo.com/meta-description-length/" target="_blank">Meta description length checker</a></p>
            </div>
            <div role="tabpanel" class="tab-pane fade in" id="intro_gal">
              <textarea name="intro_gal" class="form-control" style="height:7em;" placeholder=""><?=$trece->intro_gal;?></textarea>
              <p class="help-block"><span id="intro_gal_lettercounter"></span> <i class="fa fa-external-link" aria-hidden="true"></i> <a href="https://blog.spotibo.com/meta-description-length/" target="_blank">Meta description length checker</a></p>
            </div>
            <div role="tabpanel" class="tab-pane fade in" id="intro_es">
              <textarea name="intro_es" class="form-control" style="height:7em;" placeholder=""><?=$trece->intro_es;?></textarea>
              <p class="help-block"><span id="intro_es_lettercounter"></span> <i class="fa fa-external-link" aria-hidden="true"></i> <a href="https://blog.spotibo.com/meta-description-length/" target="_blank">Meta description length checker</a></p>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="sr-only" for="post"><?=$lCustom["post"][LANG];?>:</label>
          <label for="post"><?=$lCustom["post"][LANG];?>:
            <a href="#post_en" class="btn-xs btn-primary" data-toggle="tab">EN</a>
            <a href="#post_gal" class="btn-xs" data-toggle="tab">GAL</a>
            <a href="#post_es" class="btn-xs" data-toggle="tab">ES</a>
          </label><br>
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="post_en">
              <textarea id="post_en" name="post_en" class="form-control tinymce" placeholder=""><?=$trece->post_en;?></textarea>
            </div>
            <div role="tabpanel" class="tab-pane fade in" id="post_gal">
              <textarea id="post_gal" name="post_gal" class="form-control tinymce" placeholder=""><?=$trece->post_gal;?></textarea>
            </div>
            <div role="tabpanel" class="tab-pane fade in" id="post_es">
              <textarea id="post_es" name="post_es" class="form-control tinymce" placeholder=""><?=$trece->post_es;?></textarea>
            </div>
          </div>
        </div>

      </div>

      <div class="col-xs-12 col-sm-5 col-sm-offset-1">

        <div class="form-group">
          <input type="hidden" id="cropData1" name="cropData1">
          <input type="hidden" id="cropData2" name="cropData2">
          <input type="hidden" id="imagebase64" name="imagebase64">
          <button type="submit" class="btn btn-cons confirm-image"><?=$lCommon["save_changes"][LANG];?></button>
        </div>

      </div>

    </div>

    </form>

  </div>



  <div class="clearfix"></div>



  <script>
    $(function(){$('[data-toggle="tooltip"]').tooltip();});
  </script>



  <!-- Latest compiled and minified Bootstrap-Date/Time Picker JS from https://github.com/Eonasdan/bootstrap-datetimepicker/ -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/<?=$conf["version"]["bootstrap_datetimepicker"];?>/css/bootstrap-datetimepicker.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/<?=$conf["version"]["moment"];?>/moment-with-locales.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/<?=$conf["version"]["bootstrap_datetimepicker"];?>/js/bootstrap-datetimepicker.min.js"></script>
  <script>
    $(function(){$("#date").datetimepicker({locale:"<?=$conf["site"]["langs"][LANG]["half-culture-name"];?>",format:"<?=$conf["site"]["langs"][LANG]["date-format2"];?>"});});
  </script>



  <!-- Latest compiled and minified jQuery Mask Plugin from http://igorescobar.github.io/jQuery-Mask-Plugin/ -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/<?=$conf["version"]["jquery_mask"];?>/jquery.mask.min.js"></script>

  <script>
    $(document).ready(function(){
      var text_en_max_title, text_gal_max_title, text_es_max_title;
      var text_en_max_title = text_gal_max_title = text_es_max_title = <?=$title_length;?>;
      var text_en_max_intro, text_gal_max_intro, text_es_max_intro;
      var text_en_max_intro = text_gal_max_intro = text_es_max_intro = <?=$intro_length;?>;
      $("#title_en_lettercounter").html("("+(text_en_max_title-<?=mb_strlen($trece->title_en,"utf8");?>)+" remaining)");
      $("#title_gal_lettercounter").html("("+(text_gal_max_title-<?=mb_strlen($trece->title_gal,"utf8");?>)+" remaining)");
      $("#title_es_lettercounter").html("("+(text_es_max_title-<?=mb_strlen($trece->title_es,"utf8");?>)+" remaining)");
      $("#intro_en_lettercounter").html("("+(text_en_max_intro-<?=mb_strlen($trece->intro_en,"utf8");?>)+" remaining)");
      $("#intro_gal_lettercounter").html("("+(text_gal_max_intro-<?=mb_strlen($trece->intro_gal,"utf8");?>)+" remaining)");
      $("#intro_es_lettercounter").html("("+(text_es_max_intro-<?=mb_strlen($trece->intro_es,"utf8");?>)+" remaining)");

      $('textarea[name="title_en"]').on("keyup",function(event){
        var len_en_title = $(this).val().length;
        var text_en_length_title = $('textarea[name="title_en"]').val().length;
        var text_en_remaining_title = text_en_max_title-text_en_length_title;
        if (len_en_title >= text_en_max_title){$(this).val($(this).val().substring(0,len_en_title-1));}
        $("#title_en_lettercounter").html("("+text_en_remaining_title+" remaining)");
        });

      $('textarea[name="title_gal"]').on("keyup",function(event){
        var len_gal_title = $(this).val().length;
        var text_gal_length_title = $('textarea[name="title_gal"]').val().length;
        var text_gal_remaining_title = text_gal_max_title-text_gal_length_title;
        if (len_gal_title >= text_gal_max_title){$(this).val($(this).val().substring(0,len_gal_title-1));}
        $("#title_gal_lettercounter").html("("+text_gal_remaining_title+" remaining)");
        });

      $('textarea[name="title_es"]').on("keyup",function(event){
        var len_es_title = $(this).val().length;
        var text_es_length_title = $('textarea[name="title_es"]').val().length;
        var text_es_remaining_title = text_es_max_title-text_es_length_title;
        if (len_es_title >= text_es_max_title){$(this).val($(this).val().substring(0,len_es_title-1));}
        $("#title_es_lettercounter").html("("+text_es_remaining_title+" remaining)");
        });

      $('textarea[name="intro_en"]').on("keyup",function(event){
        var len_en_intro = $(this).val().length;
        var text_en_length_intro = $('textarea[name="intro_en"]').val().length;
        var text_en_remaining_intro = text_en_max_intro-text_en_length_intro;
        if (len_en_intro >= text_en_max_intro){$(this).val($(this).val().substring(0,len_en_intro-1));}
        $("#intro_en_lettercounter").html("("+text_en_remaining_intro+" remaining)");
        });

      $('textarea[name="intro_gal"]').on("keyup",function(event){
        var len_gal_intro = $(this).val().length;
        var text_gal_length_intro = $('textarea[name="intro_gal"]').val().length;
        var text_gal_remaining_intro = text_gal_max_intro-text_gal_length_intro;
        if (len_gal_intro >= text_gal_max_intro){$(this).val($(this).val().substring(0,len_gal_intro-1));}
        $("#intro_gal_lettercounter").html("("+text_gal_remaining_intro+" remaining)");
        });

      $('textarea[name="intro_es"]').on("keyup",function(event){
        var len_es_intro = $(this).val().length;
        var text_es_length_intro = $('textarea[name="intro_es"]').val().length;
        var text_es_remaining_intro = text_es_max_intro-text_es_length_intro;
        if (len_es_intro >= text_es_max_intro){$(this).val($(this).val().substring(0,len_es_intro-1));}
        $("#intro_es_lettercounter").html("("+text_es_remaining_intro+" remaining)");
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
    $("[href^=\\#title_]").on("shown.bs.tab",function(e){$("[href^=\\#title_]").removeClass("btn-primary");$(this).addClass("btn-primary");});
    $("[href^=\\#intro_]").on("shown.bs.tab",function(e){$("[href^=\\#intro_]").removeClass("btn-primary");$(this).addClass("btn-primary");});
    $("[href^=\\#post_]").on("shown.bs.tab",function(e){$("[href^=\\#post_]").removeClass("btn-primary");$(this).addClass("btn-primary");});
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
      plugins: [ "fullscreen visualblocks autolink charmap image link media paste wordcount lists code stylebuttons table" ],
      toolbar: "fullscreen visualblocks | style-h1 style-h2 style-h3 | table | bold italic strikethrough | bullist numlist insert code",
      table_toolbar: "tableprops tabledelete | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol",
      table_cell_advtab: false,
//    imagetools_toolbar: "rotateleft rotateright | flipv fliph | editimage imageoptions",
      visualblocks_default_state: true,
      inline_boundaries: true,
      image_dimensions: true,
      image_class_list: [{title:"Responsive", value:"img-responsive"},{title:"Alin. izquerda", value:"img-pull-left pull-left"},{title:"Alin. derecha", value:"img-pull-right pull-right"}],
      file_browser_callback: function(field_name,url,type,win){var filebrowser="<?=$conf["site"]["virtualpath"];?>?filebrowser";filebrowser+=(filebrowser.indexOf("?")<0)?"?type="+type:"&type="+type;tinymce.activeEditor.windowManager.open({title:"Insertar fichero",width:520,height:400,url:filebrowser},{window:win,input:field_name});return false;},
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
      entity_encoding: "raw",
      paste_as_text: true,
      paste_word_valid_elements: "b,strong,i,em,h1,h2",
      paste_retain_style_properties: "color",
      height: 400,
      content_css: [
        "https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i",
        "<?=REALPATH.$conf["dir"]["styles"];?>tinymce.css?" + new Date().getTime(),
        ],
    });
  </script>



<!-- Selectize -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/<?=$conf["version"]["selectize"];?>/css/selectize.bootstrap3.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/Syone/selectize-bootswatch@1.0/css/selectize.<?=$conf["version"]["bootswatch"];?>.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/<?=$conf["version"]["selectize"];?>/js/standalone/selectize.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/he/<?=$conf["version"]["he"];?>/he.min.js"></script>
  <script>
    var foraddItem = $("#ids_labels").data("foradditem");
    var foraddOption = $("#ids_labels").data("foraddoption");
    var xelect = $("#ids_labels").selectize({
      maxItems: 5,
      valueField: "value",
      labelField: "name_<?=LANG;?>",
      searchField: "name_<?=LANG;?>",
      plugins: ["remove_button","drag_drop"], // "restore_on_backspace",
      options: [<?=html_entity_decode($trece->jsonlabels);?>],
      closeAfterSelect: true,
      persist: true,
      preload: true,
      create: false,
      initData: true,
      hideSelected: true,
      selectOnTab: true,
      load: function(query,callback) {
        $.ajax({
          url: "<?=REALPATHLANG."bloglabels/".$conf["file"]["adminlist"]."?json";?>",
          type: "GET",
          dataType: "json",
          error: function(){callback();},
          success: function(res){
            for (var k in res){res[k].name_<?=LANG;?> = he.decode(res[k].name_<?=LANG;?>);}
            callback(res);
            }
          });
        },
      });
    var xelectize = xelect[0].selectize;
    var foraddItem = JSON.parse('[' + foraddItem + ']');

    for (var iz = 0; iz < foraddItem.length; iz++) {
      if(foraddItem.indexOf(foraddOption[iz].value)!==-1){
        var tocho = '[{"value":'+foraddOption[iz].value+',"name_<?=LANG;?>":"'+he.decode(foraddOption[iz].name_<?=LANG;?>)+'"}]';
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
