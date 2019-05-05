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













//Not logged? Not admin? Get out of here!

  if (
      1+1==3 # Public for everyone
//    !$app->getUserSignInStatus() # Must be logged in
//    || $app->getUserHierarchy() != 1 # Must be admin
     ) :

    header("location:".REALPATHLANG.$conf["site"]["virtualpathArray"][0]."/".$conf["file"]["publiclist"].QUERYQ);
    die();

  endif;



//OK. Let's talk.

  $lCustom["pagetitle"][LANG] = $lCustom["membership_application"][LANG];

  require_once($conf["dir"]["core"].$conf["file"]["db"].".php");
  require_once($conf["file"]["crud"].".php");
  $trece = new $action($db,$conf,$cconf,$lCommon,$lCustom);

  $msg = false;
  $trece->parentForm = false;




# ......##....................................................
# ...########..........########...#######...######..########..
# ..##..##..##.........##.....##.##.....##.##....##....##.....
# ..##..##.............##.....##.##.....##.##..........##.....
# ...########..........########..##.....##..######.....##.....
# ......##..##.........##........##.....##.......##....##.....
# ..##..##..##.........##........##.....##.##....##....##.....
# ...########..#######.##.........#######...######.....##.....
# ......##....................................................



# ....................................................................
# ...####..#####..######..####..######.######....####..##..##.######..
# ..##..##.##..##.##.....##..##...##...##.......##..##.###.##.##......
# ..##.....#####..####...######...##...####.....##..##.##.###.####....
# ..##..##.##..##.##.....##..##...##...##.......##..##.##..##.##......
# ...####..##..##.######.##..##...##...######....####..##..##.######..
# ....................................................................

  if(isset($_POST["new"])) :

    $msg = true;

    if(isset($_POST["name"]))           : $trece->name            = htmlspecialchars(trim($_POST["name"]));                                        endif;
    if(isset($_POST["surname"]))        : $trece->surname         = htmlspecialchars(trim($_POST["surname"]));                                     endif;
    if(isset($_POST["email"]))          : $trece->email           = htmlspecialchars(strtolower(preg_replace("/\s/","",$_POST["email"])));         endif;
    if(isset($_POST["ugender"]))        : $trece->ugender         = htmlspecialchars(trim($_POST["ugender"]));                                     endif;
                                          $trece->uhierarchy      = 1;

    if($trece->createOne()) :

      $msgType = $trece->wrongeMail + $trece->dupeeMail > 0 ? "danger" : "success";
      $msgText = $trece->wrongeMail + $trece->dupeeMail > 0 ?
                ($trece->wrongeMail    > 0 ? $lCustom["wrong_email"][LANG]        ." " : "") .
                ($trece->dupeeMail     > 0 ? $lCustom["duplicated_email"][LANG]   ." " : "") :
                 $lCommon["general_ok"][LANG];

    else :

      $msgType = "danger";
      $msgText = $lCommon["general_error"][LANG];

    endif;

  endif;

# .. END CREATE ONE
# ....................................................................



//Still here? OK, let's talk.

  $lCustom["pagetitle"][LANG] = $lCustom["membership_application"][LANG];

  require_once($conf["dir"]["includes"]."header.php");
  require_once($conf["dir"]["includes"]."nav.php");

?>

  <div class="container main-container">

<?php if($msg) : ?>

    <div class="alert alert-<?=$msgType;?> alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <?=$msgText;?>
    </div>

<?php endif; ?>

    <div class="row">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2">
        <div class="page-header">
          <h1><strong><?=$lCustom["pagetitle"][LANG];?></strong></h1>
          <div class="alert alert-info" role="alert">
            <p class="pull-right" style="margin:0;padding:0;"><a href="<?=REALPATHLANG;?>signin" class="btn btn-primary" role="button">Iniciar sesión</a></p>
            <h4 class="pull-left" style="margin:0;padding:0;"><strong>Xa tes conta en compostelailustrada?</strong></h4>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
    </div><!-- row -->



<?php if($msg && (isset($msgType) && $msgType == "success")) : ?>

    <div class="row">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2">
        <div class="page-header">
          <h1><?=$lCustom["request_sent"][LANG];?></h1>
          <h4><?=$lCustom["check_your_email"][LANG];?></h4>
        </div>
      </div>
    </div><!-- row -->

<?php else : ?>

    <form action="" class="form-classic" method="post" autocomplete="off" role="form">

    <fieldset>
    <div class="row">

      <div class="col-xs-12 col-sm-8 col-sm-offset-2">
        <div class="row">
          <div class="col-sm-4">
            <div class="form-group">
              <label for="name" class="control-label"><?=$lCustom["name"][LANG];?>:</label><br>
              <input type="text" class="form-control" name="name" id="name" placeholder="" autocomplete="off" value="" style="margin-bottom:.5em" required>
            </div>
          </div>
          <div class="col-sm-5">
            <div class="form-group">
              <label for="surname" class="control-label"><?=$lCustom["surname"][LANG];?>:</label><br>
              <input type="text" class="form-control" name="surname" id="surname" placeholder="" autocomplete="off" value="" style="margin-bottom:.5em" required>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="dni" class="control-label"><?=$lCustom["dni"][LANG];?>:</label><br>
              <input type="text" class="form-control" name="dni" id="dni" placeholder="" autocomplete="off" value="" style="margin-bottom:.5em" required>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xs-12 col-sm-8 col-sm-offset-2">
        <div class="row">
          <div class="col-sm-5">
            <div class="form-group<?=$trece->wrongeMail+$trece->dupeeMail>0?" has-error":"";?>">
              <label for="email" class="control-label"><?=$lCustom["email"][LANG];?>:</label><br>
              <input type="text" class="form-control" name="email" id="email" placeholder="<?=$lCustom["email"][LANG];?>" autocomplete="off" value="<?=isset($trece->email)?$trece->email:"";?>" style="margin-bottom:.5em" required>
              <?=($trece->wrongeMail+$trece->dupeeMail>0?"<span class=\"help-block\" style=\"line-height:.8em;font-weight:bold;\"><span class=\"text-danger\"><small>* ".($trece->dupeeMail>0?$lCustom["duplicated_email"][LANG]." ".$lCommon["it_must_be_unique"][LANG]:"")."</small></span></span>":"");?>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="ugender"><?=$lCustom["gender"][LANG];?>:</label><br>
              <select name="ugender" id="ugender" class="form-control selectpicker dropup" data-style="btn-info" data-header="<?=$lCommon["please_select"][LANG];?>" data-live-search="true" required>
                <?php
                  require_once($conf["dir"]["includes"].$conf["dir"]["genders"]."/".$conf["file"]["crud"].".php");
                  $cconfGender = require($conf["dir"]["includes"].$conf["dir"]["genders"]."/".$conf["file"]["conf"].".php");
                  $gender = new $conf["dir"]["genders"]($db,$conf,$cconfGender); $stmt = $gender->readAllJSON();
                ?>
                <?php if ($gender->rowcount>0): for($i=0;$i<$gender->rowcount;$i++) : ?>
                <option value="<?=$gender->letter[$i];?>" data-letter="<?=$gender->letter[$i];?>"<?=$gender->letter[$i] == $trece->ugender ? " selected" : "";?>><?=$gender->name[$i];?></option>
                <?php endfor; endif; ?>
              </select>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xs-12 col-sm-8 col-sm-offset-2">
        <div class="row">
          <div class="col-sm-12">
            <!-- RXPD -->
            <label class="checkbox-inline">
            <p><input class="checkbox" type="checkbox" onchange="toggleDisable(this);" id="check"> Regulamento Xeral de Protección de Datos: confirmo que lin a <a href="<?=REALPATHLANG."privacy";?>" target="_blank"><strong>política de privacidade</strong> <i class="fa fa-external-link" aria-hidden="true"></i></a> e acepto enviar os datos contidos neste formulario.</p>
            </label>
          </div>
        </div>
      </div>

    </div>

    </fieldset>
    <fieldset id="field_set" style="margin:0;padding-top:0;padding-bottom:0;" disabled>
    <div class="row">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2">
        <div class="row">
          <div class="col-sm-12">
            <!-- reCAPTCHA -->
            <div class="g-recaptcha" data-sitekey="<?=$conf["recaptcha"]["public"];?>" style="margin-bottom:2em;"></div>
          </div>
        </div>
      </div>

      <div class="col-xs-12 col-sm-8 col-sm-offset-2">
        <div class="row">
          <div class="col-sm-12">
            <!-- Button -->
            <button id="singlebutton" name="new" class="btn btn-danger">Enviar</button>
          </div>
        </div>
      </div>
    </div>

    </fieldset>

    </form>

<?php endif; ?>

  </div>



  <!-- Latest compiled and minified Bootstrap-select JS from https://silviomoreto.github.io/bootstrap-select/ -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/<?=$conf["version"]["bootstrap_select"];?>/js/bootstrap-select.min.js"></script>
<?php /*
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/<?=$conf["version"]["bootstrap_select"];?>/js/i18n/defaults-<?=str_replace("-","_",$conf["site"]["langs"][LANG]["culture-name"]);?>.js"></script>
*/ ?>

  <script>
    $(".selectpicker").selectpicker({
      style: "btn-info",
      size: 4
    });
  </script>



  <!-- Latest compiled and minified Bootstrap-Date/Time Picker JS from https://github.com/Eonasdan/bootstrap-datetimepicker/ -->
  <script>
    $(function(){$("#birthdate").datetimepicker({locale:"es", viewMode:"years", format:"DD/MM/YYYY"});});
  </script>



  <?php if ( $msg && $msgType != "danger" ) : ?>
  <script>$(".alert-dismissable").fadeTo(2000,500).slideUp(500,function(){$(".alert-dismissable").slideUp(500);});</script>
  <?php endif; ?>



  <script>
    function toggleDisable(checkbox) {
      var toggle = document.getElementById("field_set");
      checkbox.checked ? toggle.disabled = false : toggle.disabled = true;
      }
  </script>



<?php require_once($conf["dir"]["includes"]."footer.php"); ?>
