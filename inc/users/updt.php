<?php if(!defined("TRECE")):header("location:/");die();endif; ?>
<?php
//USERS

# ..................................................
# ..##.....##..######..########.########...######...
# ..##.....##.##....##.##.......##.....##.##....##..
# ..##.....##.##.......##.......##.....##.##........
# ..##.....##..######..######...########...######...
# ..##.....##.......##.##.......##...##.........##..
# ..##.....##.##....##.##.......##....##..##....##..
# ...#######...######..########.##.....##..######...
# ..................................................

// http://patorjk.com/software/taag/#p=display&f=Banner4&t=%20TRECE%20
// http://patorjk.com/software/taag/#p=display&f=Bright&t=Deprecated
// https://stackoverflow.com/questions/8154158/mysql-how-do-i-use-delimiters-in-triggers









  $goBack = $action."/".$conf["file"]["adminlist"];

  if(isset($conf["site"]["queryArray"]["back"])) :

    parse_str($conf["site"]["query"],$conf["site"]["queryArray"]);
    $goBack = $conf["site"]["queryArray"]["back"]."/".$conf["file"]["adminlist"];
    unset($conf["site"]["queryArray"]["back"]);
    $conf["site"]["queryArray"] = count($conf["site"]["queryArray"])>0? "?".http_build_query($conf["site"]["queryArray"]) : "";

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

  if(isset($_POST["username"])) :

    $msg = true;

    if(isset($_POST["id_status"]))     : $trece->id_status     = 1; else : $trece->id_status = 0;                                                                       endif;
    if(isset($_POST["name"]))          : $trece->name          = htmlspecialchars(trim(preg_replace("/[[:blank:]]+/"," ",$_POST["name"])));                             endif;
    if(isset($_POST["surname"]))       : $trece->surname       = htmlspecialchars(trim(preg_replace("/[[:blank:]]+/"," ",$_POST["surname"])));                          endif;
    if(isset($_POST["username"]))      : $trece->username      = getUrlFriendlyString(htmlspecialchars(trim(preg_replace("/[[:blank:]]+/","",$_POST["username"]))));    endif;
    if(isset($_POST["email"]))         : $trece->email         = htmlspecialchars(strtolower(preg_replace("/\s/","",$_POST["email"])));                                 endif;
//  if(isset($_POST["bio"]))           : $trece->bio           = htmlspecialchars(strtolower(preg_replace("/\s/","",$_POST["bio"])));                                   endif;
    if(isset($_POST["uhierarchy"]))    : $trece->uhierarchy    = $_POST["uhierarchy"];                                                                                  endif;
    if(isset($_POST["ugender"]))       : $trece->ugender       = $_POST["ugender"];                                                                                     endif;

    if($trece->updateOne()) :

      $msgType = $trece->wrongUsername + $trece->dupeUsername + $trece->wrongeMail + $trece->dupeeMail > 0 ? "danger" : "success";
      $msgText = $trece->wrongUsername + $trece->dupeUsername + $trece->wrongeMail + $trece->dupeeMail > 0 ?
                ($trece->wrongUsername > 0 ? $lCustom["wrong_username"][LANG]     ." " : "") .
                ($trece->dupeUsername  > 0 ? $lCustom["duplicated_username"][LANG]." " : "") .
                ($trece->wrongeMail    > 0 ? $lCustom["wrong_email"][LANG]        ." " : "") .
                ($trece->dupeeMail     > 0 ? $lCustom["duplicated_email"][LANG]   ." " : "") :
                 $lCommon["general_ok"][LANG];

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
    $conf["site"]["queryArray"] = $conf["site"]["queryArray"] != "" ? "?".http_build_query($conf["site"]["queryArray"]) : "";
    header("location:".REALPATHLANG.$action."/".$crudlpx."/".$what."/".$conf["file"]["adminlist"]."/1".$conf["site"]["queryArray"]);
    die();

  endif;



//Still here? OK, let's talk.

  $included = false;

  if( isset($conf["site"]["virtualpathArray"][$readtype+1]) && $conf["site"]["virtualpathArray"][$readtype+1] == $conf["file"]["adminlist"] ) :

    $included = true;

  endif;

  $username               = isset($trece->username)?$trece->username:null;
  $email                  = isset($trece->email)?$trece->email:$cconf["default"]["email"];
  $dupeUsername           = isset($trece->dupeUsername)?$trece->dupeUsername:0;
  $wrongUsername          = isset($trece->wrongUsername)?$trece->wrongUsername:0;
  $dupeeMail              = isset($trece->dupeeMail)?$trece->dupeeMail:0;
  $wrongeMail             = isset($trece->wrongeMail)?$trece->wrongeMail:0;
  $stmt = $trece->readOne();
  $username               = $dupeUsername+$dupeeMail > 0 ? $username : (!is_null($username) ? $username : $trece->username);
  $email                  = $dupeUsername+$dupeeMail > 0 ? $email : $trece->email;
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
  echo "<br>ugender: ".$trece->ugender;
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

        <div class="side-corner-tag" style="width:<?=$cconf["img"]["viewport_w"];?>px; position:relative;margin-bottom:10em;">
          <div id="avatar" class="<?=$trece->id_status == 0?"attenuate":"";?>">
            <p><span style="background:#<?=$trece->hierarchy_color;?>;?>;width:160px;right:-50px;"></span></p>
            <img src="<?=($trece->gotPic?$conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"].$trece->{$cconf["img"]["ref"]}.".jpg?".time():($trece->gotGenderPic||$trece->gotNeutralPic?$conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"].($trece->gotGenderPic?$trece->ugender:"0").".jpg?".time():($trece->gotNeutralPic?$conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"]."0.jpg?".time():"https://fakeimg.pl/".$cconf["img"]["icon_w"]."x".$cconf["img"]["icon_h"]."/?text=".$trece->ugender)));?>" class="img-thumbnail img-responsive" alt="<?=$trece->name;?>">
          </div>
        </div>

      </div>

      <div class="col-sm-6 col-md-5">

        <div class="row">
          <div class="col-xs-6">
            <div class="form-group">
              <label for="id_status"><?=$lCustom["status"][LANG];?>:</label><br>
              <input type="checkbox" id="id_status" name="id_status" data-on-color="success" data-on-text="<?=$lCommon["active"][LANG];?>" data-off-color="danger" data-off-text="<?=$lCommon["inactive"][LANG];?>" class="form-control"<?=$trece->id_status==1?" checked":"";?>>
            </div>
          </div>
          <div class="col-xs-6">
            <div class="form-group">
              <label for="uhierarchy"><?=$lCustom["hierarchy"][LANG];?>:</label><br>
              <select name="uhierarchy" id="uhierarchy" class="form-control selectpicker dropup" data-style="btn-info" data-header="<?=$lCommon["please_select"][LANG];?>" data-live-search="true" required>
                <?php
                  require_once($conf["dir"]["includes"]."hierarchy/".$conf["file"]["crud"].".php");
                  $cconfHierarchy = require($conf["dir"]["includes"]."hierarchy/".$conf["file"]["conf"].".php");
                  $hierarchy = new Hierarchy($db,$conf,$cconfHierarchy); $stmt = $hierarchy->readAllJSON();
                ?>
                <?php if ($hierarchy->rowcount>0): for($i=0;$i<$hierarchy->rowcount;$i++) : ?>
                <option value="<?=$hierarchy->id[$i];?>" data-color="<?=$hierarchy->color[$i];?>"<?=$hierarchy->id[$i] == $trece->uhierarchy ? " selected" : "";?>><?=$hierarchy->name[$i];?></option>
                <?php endfor; endif; ?>
              </select>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="name"><?=$lCustom["name"][LANG];?>:</label><br>
          <input type="text" id="name" name="name" class="form-control" value="<?=$trece->name;?>" required>
        </div>



        <div class="form-group">
          <label for="surname"><?=$lCustom["surname"][LANG];?>:</label><br>
          <input type="text" id="surname" name="surname" class="form-control" value="<?=$trece->surname;?>">
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
                  require_once($conf["dir"]["includes"]."gender/".$conf["file"]["crud"].".php");
                  $cconfGender = require($conf["dir"]["includes"]."gender/".$conf["file"]["conf"].".php");
                  $gender = new Gender($db,$conf,$cconfGender); $stmt = $gender->readAllJSON();
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
          <button type="submit" class="btn btn-cons confirm-image"><?=$lCommon["save_changes"][LANG];?></button>
        </div>

      </div>

    </div>

    </form>

  </div>



  <div class="clearfix"></div>



  <script>$(function(){$('[data-toggle="tooltip"]').tooltip();});</script>

  <script>$("#uhierarchy").change(function(){$(".side-corner-tag span").css("background-color","#"+$(this).find(":selected").data("color"));});</script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/<?=$conf["version"]["bootstrap_switch"];?>/js/bootstrap-switch.min.js"></script>
  <script>
    $('[name="id_status"]').bootstrapSwitch();
    $('input[name="id_status"]').on("switchChange.bootstrapSwitch",function(event,state){if(state){$("#avatar").removeClass("attenuate",500);}else{$("#avatar").addClass("attenuate",500);}});
  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/<?=$conf["version"]["bootstrap_select"];?>/js/bootstrap-select.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/<?=$conf["version"]["bootstrap_select"];?>/js/i18n/defaults-<?=$conf["site"]["langs"][LANG]["culture-name2"];?>.js"></script>
  <script>$(".selectpicker").selectpicker({style:"btn-info",size:4});</script>


<?php if(!$trece->gotPic) : ?>

  <script>
    $("#ugender").change(function(){
      var img = <?=$trece->gotGenderPic||$trece->gotNeutralPic?"\"".$conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconf["img"]["prefix"].($trece->gotGenderPic?"\"+\$(this).find(\":selected\").attr(\"data-letter\") + \"":"0").".jpg?".time()."\"":"\"https://fakeimg.pl/".$cconf["img"]["icon_w"]."x".$cconf["img"]["icon_h"]."/?text=\""."+\$(this).find(\":selected\").attr(\"data-letter\")";?>;
      $("#avatar").find("img").attr("src",img);
    });
  </script>

<?php endif; ?>

  <?php if($msg&&$msgType!="danger") : ?>
  <script>$(".alert-dismissable").fadeTo(2000,500).slideUp(500,function(){$(".alert-dismissable").slideUp(500);});</script>
  <?php endif; ?>

  <script>
    $("[href^=\\#div_]").on("shown.bs.tab",function(e){$("[href^=\\#div_]").removeClass("btn-primary");$(this).addClass("btn-primary");});
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
