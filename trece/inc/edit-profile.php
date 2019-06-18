<?php if(!defined("TRECE")):header("location:/");die();endif; ?>
<?php
//EDIT PROFILE

# .....................................................................................................
# ..########.########..####.########....########..########...#######..########.####.##.......########..
# ..##.......##.....##..##.....##.......##.....##.##.....##.##.....##.##........##..##.......##........
# ..##.......##.....##..##.....##.......##.....##.##.....##.##.....##.##........##..##.......##........
# ..######...##.....##..##.....##.......########..########..##.....##.######....##..##.......######....
# ..##.......##.....##..##.....##.......##........##...##...##.....##.##........##..##.......##........
# ..##.......##.....##..##.....##.......##........##....##..##.....##.##........##..##.......##........
# ..########.########..####....##.......##........##.....##..#######..##.......####.########.########..
# .....................................................................................................

// http://patorjk.com/software/taag/#p=display&f=Banner4&t=%20TRECE%20
// http://patorjk.com/software/taag/#p=display&f=Bright&t=Deprecated
// https://stackoverflow.com/questions/8154158/mysql-how-do-i-use-delimiters-in-triggers









//Not logged? Get out of here!

  if (
//    1+1==3 # Public for everyone
      !$app->getUserSignInStatus() # Must be logged in
//    || $app->getUserHierarchy() != 1 # Must be admin
     ) :

    header("location:".REALPATHLANG.QUERYQ);
    die();

  endif;



  $cconf    = require($conf["dir"]["users"]."/".$conf["file"]["conf"].".php");
  $lCustom  = require($conf["dir"]["users"]."/".$conf["file"]["i18n"].".php");



//Wrong reference? Get out of here!

  require_once($conf["dir"]["users"]."/".$conf["file"]["crud"].".php");

  $trece = new $conf["dir"]["users"]($db,$conf,$cconf,$lCommon,$lCustom);
  $trece->ref = $app->getUserRef();
  $trece->intimacy = 0;
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

  if(isset($_POST["username"])) :

    $msg = true;

//  if(isset($_POST["id_status"]))     : $trece->id_status     = 1; else : $trece->id_status = 0;                                               endif;
    if(isset($_POST["name"]))          : $trece->name          = htmlspecialchars(trim($_POST["name"]));                                        endif;
    if(isset($_POST["surname"]))       : $trece->surname       = htmlspecialchars(trim($_POST["surname"]));                                     endif;
    if(isset($_POST["username"]))      : $trece->username      = htmlspecialchars(strtolower(preg_replace("/\s/","",trim($_POST["username"]))));endif;
    if(isset($_POST["email"]))         : $trece->email         = htmlspecialchars(strtolower(preg_replace("/\s/","",$_POST["email"])));         endif;
    if(isset($_POST["bio"]))           : $trece->bio           = html_entity_decode($_POST["bio"]);                                             endif;
//  if(isset($_POST["uhierarchy"]))    : $trece->uhierarchy    = $_POST["uhierarchy"];                                                          endif;
    if(isset($_POST["ugender"]))       : $trece->ugender       = $_POST["ugender"];                                                             endif;

    if($trece->updateOne()) :

      if($trece->wrongUsername + $trece->dupeUsername + $trece->wrongeMail + $trece->dupeeMail > 0) :

        $msgType = $trece->wrongUsername + $trece->dupeUsername + $trece->wrongeMail + $trece->dupeeMail > 0 ? "danger" : "success";
        $msgText = $trece->wrongUsername + $trece->dupeUsername + $trece->wrongeMail + $trece->dupeeMail > 0 ?
                  ($trece->wrongUsername > 0 ? $lCustom["wrong_username"][LANG]     ." " : "") .
                  ($trece->dupeUsername  > 0 ? $lCustom["duplicated_username"][LANG]." " : "") .
                  ($trece->wrongeMail    > 0 ? $lCustom["wrong_email"][LANG]        ." " : "") .
                  ($trece->dupeeMail     > 0 ? $lCustom["duplicated_email"][LANG]   ." " : "") :
                   $lCommon["general_ok"][LANG];

      else :

        $imagebase64 = !isset($trece->{$cconf["img"]["ref"]}) ? "" : $_POST["imagebase64"];
        $filename = $cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg";

        if($imagebase64 == "") :

        elseif($imagebase64 == "nopic") :

          if(file_exists($conf["dir"]["images"].$conf["css"]["thumb_prefix"].$filename)) : unlink($conf["dir"]["images"].$conf["css"]["thumb_prefix"].$filename); endif;
          if(file_exists($conf["dir"]["images"].$conf["css"]["icon_prefix"].$filename)) : unlink($conf["dir"]["images"].$conf["css"]["icon_prefix"].$filename); endif;
          if(file_exists($conf["dir"]["images"].$filename)) : unlink($conf["dir"]["images"].$filename); endif;
          if(file_exists($conf["dir"]["images"]."og/".$filename)) : unlink($conf["dir"]["images"]."og/".$filename); endif;

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
<?php if((substr(basename($file),0,16)==="bio-img-".$trece->ref) && (substr(substr(basename($file),0,strrpos(basename($file),".")),-6) === "_thumb")) : ?>
  <?php $ext = substr($file,strrpos($file,".")+1); ?>
  <?php $base = substr($file,0,strrpos($file,".")); $base = str_replace_plus("lo","_thumb","",$base); ?>
          <li>
            <div class="check">
              <img src="<?=REALPATH.$conf["dir"]["images"].basename($file);?>">
              <div class="rightblock">
                <a class="file" data-src="<?=$base."_img.".$ext;?>" href=""><span><?=$cconf["img"]["bio_max_img"];?> px.</span></a><br>
                <a class="file" data-src="<?=$base."_icon.".$ext;?>" href=""><span><?=$cconf["img"]["bio_max_icon"];?> px.</span></a><br>
                <a class="file" data-src="<?=$base."_thumb.".$ext;?>" href=""><span><?=$cconf["img"]["bio_max_thumb"];?> px.</span></a>
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
      function deleteImage(who){$.post([location.protocol,'//',location.host,location.pathname].join(''),{deleteImage:true,object_who:who},function(data){
      location.reload();
//    alert(data);
      });};
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
  reset($_FILES); $temp = current($_FILES);

  if(is_uploaded_file($temp["tmp_name"])) :

    $filename = explode(".",$temp["name"]);
    $filename = $conf["dir"]["images"]."bio-img-".$trece->ref."-".uniqid();
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

    if($width>$height) : $max_height=$cconf["img"]["bio_max_img"];$max_width=floor($width*($max_height/$height)); endif;
    if($height>$width) : $max_width=$cconf["img"]["bio_max_img"];$max_height=floor($height*($max_width/$width)); endif;
    resizeImage($source,$filename."_img".".".$extension,$width,$height,$max_width,$max_height);
    if($width>$height) : $max_height=$cconf["img"]["bio_max_icon"];$max_width=floor($width*($max_height/$height)); endif;
    if($height>$width) : $max_width=$cconf["img"]["bio_max_icon"];$max_height=floor($height*($max_width/$width)); endif;
    resizeImage($source,$filename."_icon".".".$extension,$width,$height,$max_width,$max_height);
    resizeImage($source,$filename."_thumb".".".$extension,$width,$height,$cconf["img"]["bio_max_thumb"],$cconf["img"]["bio_max_thumb"]);

    imagedestroy($source); if(file_exists($filename.".".$extension)) : unlink($filename.".".$extension); endif; # CLEAN THE CRIME SCENE
    echo json_encode(array("location"=>$filename."_img".".".$extension));
    die();

  else : header("HTTP/1.1 500 Server Error");
  endif;

# .. END UPLOAD IMAGE
# ...................................................................................



//Still here? OK, let's talk.

  $username               = isset($trece->username)?$trece->username:null;
  $email                  = isset($trece->email)?$trece->email:$cconf["default"]["email"];
  $dupeUsername           = isset($trece->dupeUsername)?$trece->dupeUsername:0;
  $wrongUsername          = isset($trece->wrongUsername)?$trece->wrongUsername:0;
  $dupeeMail              = isset($trece->dupeeMail)?$trece->dupeeMail:0;
  $wrongeMail             = isset($trece->wrongeMail)?$trece->wrongeMail:0;
  $stmt = $trece->readOne();
  $username               = $dupeUsername+$dupeeMail > 0 ? $username : (!is_null($username) ? $username : $trece->username);
  $email                  = $dupeUsername+$dupeeMail > 0 ? $email : $trece->email;
  $filename               = $cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg";
  $trece->gotPic          = file_exists($conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg") ? true : false;
  $trece->gotGenderPic    = file_exists($conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"].$trece->ugender.".jpg") ? true : false;
  $trece->gotNeutralPic   = file_exists($conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"]."0.jpg") ? true : false;

/*
  echo "<pre><small>";
//print_r($trece);
  echo "<br>id: ".$trece->id;
  echo "<br>ref: ".$trece->ref;
  echo "<br>id_status: ".$trece->id_status;
  echo "<br>name: ".$trece->name;
  echo "<br>surname: ".$trece->surname;
  echo "<br>username: ".$trece->username;
  echo "<br>email: ".$trece->email;
  echo "<br>gender: ".$trece->gender;
  echo "<br>uhierarchy: ".$trece->uhierarchy;
  echo "<br>bio: ".$trece->bio;
  echo "<br>wrongUsername: ".$trece->wrongUsername;
  echo "<br>dupeUsername: ".$trece->dupeUsername;
  echo "<br>wrongeMail: ".$trece->wrongeMail;
  echo "<br>dupeeMail: ".$trece->dupeeMail;
  echo "<br>gotPic: ".($trece->gotPic ? "true" : "false");
  echo "<br>gotGenderPic: ".($trece->gotGenderPic ? "true" : "false");
  echo "<br>gotNeutralPic: ".($trece->gotNeutralPic ? "true" : "false");
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
  div.mce-fullscreen { z-index: 1050; }
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
            <?=btn($lCommon["change-password"][LANG],"^".REALPATHLANG.$conf["file"]["forgot-pass"]."?m=".$trece->email,"","fa-key");?>
          </p></div>
          <h1><strong><?=$lCustom["pagetitle"][LANG];?></strong></h1>
        </div>
      </div>
    </div><!-- row -->



    <div class="row">

      <div class="col-sm-4 col-sm-offset-1 col-md-3 col-md-offset-2">

        <label for="id_status"><?=$lCommon["avatar"][LANG];?>:</label><br>
        <div class="side-corner-tag" style="width:<?=$cconf["img"]["viewport_w"];?>px; position:relative;margin-bottom:10em;">
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



      <form id="form" class="form-classic" action="" method="post" enctype="multipart/form-data">

      <div class="col-sm-6 col-md-5">

        <div class="row">

          <div class="col-xs-12 col-sm-6">
    
            <div class="form-group">
              <label for="name"><?=$lCustom["name"][LANG];?>:</label><br>
              <input type="text" id="name" name="name" class="form-control" value="<?=$trece->name;?>" required>
            </div>

          </div>

          <div class="col-xs-12 col-sm-6">

            <div class="form-group">
              <label for="surname"><?=$lCustom["surname"][LANG];?>:</label><br>
              <input type="text" id="surname" name="surname" class="form-control" value="<?=$trece->surname;?>">
            </div>

          </div>

        </div>

        <div class="row">
          <div class="col-xs-6">
            <div class="form-group<?=$wrongUsername+$dupeUsername>0?" has-error":"";?>">
              <label for="username"><?=$lCustom["username"][LANG];?>:</label><br>
               <input type="text" id="username" name="username" class="form-control" value="<?=$username;?>" required>
              <?=($wrongUsername+$dupeUsername>0?"<span class=\"help-block\"><span class=\"text-danger\">* ".($wrongUsername>0?$lCustom["wrong_username"][LANG]." ":($dupeUsername>0?$lCustom["duplicated_username"][LANG]." ".$lCommon["it_must_be_unique"][LANG]." ":"")).$lCustom["mandatory_field"][LANG]."</span></span>":"");?>
            </div>
          </div>
          <div class="col-xs-6">
            <div class="form-group">
              <label for="ugender"><?=$lCustom["gender"][LANG];?>:</label><br>
              <select name="ugender" id="ugender" class="form-control selectpicker dropup" data-style="btn-info" data-header="<?=$lCommon["please_select"][LANG];?>" data-live-search="true" required>
                <?php
                  require_once($conf["dir"]["includes"]."genders/".$conf["file"]["crud"].".php");
                  $cconfGender = require($conf["dir"]["includes"]."genders/".$conf["file"]["conf"].".php");
                  $gender = new Genders($db,$conf,$cconfGender); $stmt = $gender->readAllJSON();
                ?>
                <?php if ($gender->rowcount>0): for($i=0;$i<$gender->rowcount;$i++) : ?>
                <option value="<?=$gender->letter[$i];?>" data-letter="<?=$gender->letter[$i];?>"<?=$gender->letter[$i] == $trece->ugender ? " selected" : "";?>><?=$gender->name[$i];?></option>
                <?php endfor; endif; ?>
              </select>
            </div>
          </div>
        </div>

        <div class="form-group<?=$wrongeMail+$dupeeMail>0?" has-error":"";?>">
          <label for="email"><?=$lCommon["email"][LANG];?>:</label><br>
          <input type="email" id="email" name="email" class="form-control" placeholder="<?=$wrongeMail+$dupeeMail>0?$lCustom["no_email"][LANG]:"";?>" value="<?=strpos($email,"@")!==false?$email:"";?>" required>
          <?=($wrongeMail+$dupeeMail>0?"<span class=\"help-block\"><span class=\"text-danger\">* ".($dupeeMail>0?$lCustom["duplicated_email"][LANG]." ".$lCommon["it_must_be_unique"][LANG]." ":"").$lCustom["mandatory_field"][LANG]."</span></span>":"");?>
        </div>

        <div class="form-group">
          <label for="url_portfolio">URL portafolio:</label><br>
          <input type="text" id="url_portfolio" name="url_portfolio" class="form-control" value="">
        </div>

        <div class="form-group">
          <label for="bio"><?=$lCustom["bio"][LANG];?>:</label>
          <textarea class="form-control tinymce" id="bio" name="bio" placeholder=""><?=$trece->bio;?></textarea>
        </div>



        <div class="form-group">
          <input type="hidden" id="cropData1" name="cropData1">
          <input type="hidden" id="cropData2" name="cropData2">
          <input type="hidden" id="imagebase64" name="imagebase64">
          <button type="submit" class="btn btn-cons confirm-image"><?=$lCommon["save_changes"][LANG];?></button>
        </div>

      </div>

      </form>

    </div>


  </div>



  <div class="clearfix"></div>



  <script>
    $(function(){$('[data-toggle="tooltip"]').tooltip();});
  </script>



  <!-- Bootstrap Select -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/<?=$conf["version"]["bootstrap_select"];?>/css/bootstrap-select.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/<?=$conf["version"]["bootstrap_select"];?>/js/bootstrap-select.min.js"></script>
<?php /*
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/<?=$conf["version"]["bootstrap_select"];?>/js/i18n/defaults-<?=$conf["site"]["langs"][LANG]["culture-name2"];?>.js"></script>
*/ ?>
  <script>
    $(".selectpicker").selectpicker({style:"btn-info",size: 4});
  </script>



  <!-- Croppie -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/<?=$conf["version"]["croppie"];?>/croppie.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/<?=$conf["version"]["croppie"];?>/croppie.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/exif-js/<?=$conf["version"]["exif_js"];?>/exif.min.js"></script>
  <script>
    var thePic="<?=($trece->gotPic?$conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg?".time():($trece->gotGenderPic||$trece->gotNeutralPic?$conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"].($trece->gotGenderPic?$trece->ugender:"0").".jpg?".time():($trece->gotNeutralPic?$conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"]."0.jpg?".time():"https://fakeimg.pl/".$cconf["img"]["icon_w"]."x".$cconf["img"]["icon_h"]."/?text=".$trece->ugender)));?>";function resetCroppie(){destroyCroppie();initCroppie();}function destroyCroppie(){$uploadCrop.croppie("destroy");}function deleteCroppie(){$.post("",{deleteImage:true,object_who:"<?=$conf["dir"]["images"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg";?>↲<?=$conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg";?>↲<?=$conf["dir"]["images"].$conf["css"]["thumb_prefix"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg";?>"},function(data){$("#img-delete").remove();$uploadCrop.croppie("bind",{url:"https://fakeimg.pl/<?=$cconf["img"]["viewport_w"];?>x<?=$cconf["img"]["viewport_h"];?>/?text=<?=$lCustom["singular"][LANG];?>"});}).fail(function(){alert("<?=addslashes($lCommon["cannot_be_deleted"][LANG]);?>");});}function initCroppie(){$uploadCrop=$("#crop-image").croppie({enableExif:true,viewport:{width:<?=$cconf["img"]["viewport_w"];?>,height:<?=$cconf["img"]["viewport_h"];?>,type:"square"},boundary:{width:<?=$cconf["img"]["viewport_w"];?>,height:<?=$cconf["img"]["viewport_h"];?>}});}$uploadCrop=$("#crop-image").croppie({enableExif:true,viewport:{width:<?=$cconf["img"]["viewport_w"];?>,height:<?=$cconf["img"]["viewport_h"];?>,type:"square"},boundary:{width:<?=$cconf["img"]["viewport_w"];?>,height:<?=$cconf["img"]["viewport_h"];?>}});$("#cropData1").val(JSON.stringify($("#crop-image").croppie("get")));$uploadCrop.croppie("bind",{url:thePic},function(){$("#cropData1").val(JSON.stringify($("#crop-image").croppie("get")));});$("#img-delete").on("click",function(ev){var q=confirm("<?=$lCommon["are_you_sure"][LANG];?>");if(q==true){$("#imagebase64").val("nopic");deleteCroppie();}return false;});$("#img-delete").hover(function(){$(this).animate({fontSize:"3.8rem"});},function(){$(this).animate({fontSize:"2.8rem"});});$("#upload").on("change",function(){resetCroppie();var reader=new FileReader();reader.onload=function(e){$uploadCrop.croppie("bind",{url:e.target.result}).then(function(){console.log("jQuery bind complete");});};reader.readAsDataURL(this.files[0]);});$("#img-upload").hover(function(){$(this).animate({fontSize:"4rem"});},function(){$(this).animate({fontSize:"3rem"});});$(".confirm-image").on("click",function(ev){if(($("#cropData1").val()!=$("#cropData2").val())&&($("#imagebase64").val!=""||$("#imagebase64").val!="nopic")){ev.preventDefault();$uploadCrop.croppie("result",{type:"canvas",size:{width:<?=$cconf["img"]["canvas_w"];?>,height:<?=$cconf["img"]["canvas_h"];?>},format:"jpeg",quality:0.9}).then(function(resp){$("#imagebase64").val(resp);});};setTimeout(function(){$("#form").submit();},10);});$("#crop-image").on("update.croppie",function(ev,cropData){$("#cropData2").val(JSON.stringify(cropData));});
  </script>



<?php if(!$trece->gotPic) : ?>

  <script>
    $("#ugender").change(function(){
      var img = <?=$trece->gotGenderPic||$trece->gotNeutralPic?"\"".$conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"].($trece->gotGenderPic?"\"+\$(this).find(\":selected\").attr(\"data-letter\") + \"":"0").".jpg?".time()."\"":"\"https://fakeimg.pl/".$cconf["img"]["icon_w"]."x".$cconf["img"]["icon_h"]."/?text=\""."+\$(this).find(\":selected\").attr(\"data-letter\")";?>;
      $uploadCrop.croppie("bind",{url:img});
    });
  </script>

<?php endif; ?>



  <!-- TinyMCE -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/<?=$conf["version"]["tinymce"];?>/tinymce.min.js"></script>
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
      paste_as_text: true,
      height: 400,
    });
  </script>



  <?php if($msg&&$msgType!="danger") : ?>
  <script>
    $(".alert-dismissable").fadeTo(2000,500).slideUp(500,function(){$(".alert-dismissable").slideUp(500);});
  </script>
  <?php endif; ?>



<?php require_once($conf["dir"]["includes"]."footer.php"); ?>
