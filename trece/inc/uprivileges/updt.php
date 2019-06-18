<?php if(!defined("TRECE")):header("location:/");die();endif; ?>
<?php
//UPRIVILEGES

# ...................................................................................................
# ..##.....##.########..########..####.##.....##.####.##.......########..######...########..######...
# ..##.....##.##.....##.##.....##..##..##.....##..##..##.......##.......##....##..##.......##....##..
# ..##.....##.##.....##.##.....##..##..##.....##..##..##.......##.......##........##.......##........
# ..##.....##.########..########...##..##.....##..##..##.......######...##...####.######....######...
# ..##.....##.##........##...##....##...##...##...##..##.......##.......##....##..##.............##..
# ..##.....##.##........##....##...##....##.##....##..##.......##.......##....##..##.......##....##..
# ...#######..##........##.....##.####....###....####.########.########..######...########..######...
# ...................................................................................................

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

    $msg = true;

    if(isset($_POST["id_status"]))          : $trece->id_status          = 1; else : $trece->id_status = 0;                                                          endif;
    if(isset($_POST["name"]))               : $trece->name               = htmlspecialchars(trim(preg_replace("/[[:blank:]]+/"," ",$_POST["name"])));
                                              $trece->url_name           = getUrlFriendlyString($trece->name);                                                       endif;
    if($trece->updateOne()) :

      if($trece->dupeName > 0) :

        $msgType = $trece->dupeName > 0 ? "danger" : "success";
        $msgText = $trece->dupeName > 0 ?
                  ($trece->dupeName > 0 ? $lCustom["duplicated_name"][LANG]." " : "") :
                   $lCommon["general_ok"][LANG];

      else :

        if(isset($_POST["addNew"]) && $_POST["addNew"] == 1) :

          $trece->id_status     = $cconf["default"]["id_status"];
          $trece->name          = $cconf["default"]["name"];
          $trece->url_name      = getUrlFriendlyString($cconf["default"]["name"]);

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

  $name             = isset($trece->name)?$trece->name:$cconf["default"]["name"];
  $dupeName         = isset($trece->dupeName)?$trece->dupeName:0;
  $stmt             = $trece->readOne();
  $name             = $dupeName > 0 ? $name : $trece->name;

/*
  echo "<pre><small>";
//print_r($trece);
  echo "<br>id: ".$trece->id;
  echo "<br>ref: ".$trece->ref;
  echo "<br>id_status: ".$trece->id_status;
  echo "<br>name: ".$trece->name;
  echo "<br>dupeName: ".$trece->dupeName;
  echo "<br>url_name: ".$trece->url_name;
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

    <form id="form" class="form-classic" action="" method="post">

    <div class="row">

      <div class="col-xs-12 col-sm-10 col-sm-offset-1">

        <div class="row">
          <div class="col-xs-3">
            <div class="form-group">
              <label for="id_status"><?=$lCustom["status"][LANG];?>:</label><br>
              <input type="checkbox" id="id_status" name="id_status" data-on-color="success" data-on-text="<?=$lCommon["active"][LANG];?>" data-off-color="danger" data-off-text="<?=$lCommon["inactive"][LANG];?>" class="form-control"<?=$trece->id_status==1?" checked":"";?>>
            </div>
          </div>
          <div class="col-xs-9">
            <div class="form-group<?=$dupeName>0?" has-error":"";?>">
              <label for="name"><?=$lCustom["name"][LANG];?>:</label><br>
              <input type="text" id="name" name="name" class="form-control" placeholder="<?=$name;?>" value="<?=($cconf["default"]["name"]===$name||(strpos($name,$cconf["default"]["name"])===0)?$trece->name:$name);?>" required>
              <span class="help-block">* <?=($dupeName>0?$lCustom["duplicated_name"][LANG]:" ").$lCommon["it_must_be_unique"][LANG];?></span>
            </div>
          </div>
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-cons"><?=$lCommon["save_changes"][LANG];?></button>
        </div>

      </div>

    </div>

    </form>

  </div>



  <div class="clearfix"></div>



  <script>
    $(function(){$('[data-toggle="tooltip"]').tooltip();});
  </script>



<!-- Bootstrap Switch -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/<?=$conf["version"]["bootstrap_switch"];?>/css/bootstrap3/bootstrap-switch.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/<?=$conf["version"]["bootstrap_switch"];?>/js/bootstrap-switch.min.js"></script>
  <script>
    $('[name="id_status"]').bootstrapSwitch();
    $('input[name="id_status"]').on("switchChange.bootstrapSwitch",function(event,state){if(state){$("#crop-image").removeClass("attenuate",500);}else{$("#crop-image").addClass("attenuate",500);}});
  </script>



  <?php if($msg&&$msgType!="danger") : ?>
  <script>
    $(".alert-dismissable").fadeTo(2000,500).slideUp(500,function(){$(".alert-dismissable").slideUp(500);});
  </script>
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
