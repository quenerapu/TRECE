<?php if(!defined("TRECE")):header("location:/");die();endif; ?>
<?php
//CONTACT

# ....................................................................
# ...######...#######..##....##.########....###.....######..########..
# ..##....##.##.....##.###...##....##......##.##...##....##....##.....
# ..##.......##.....##.####..##....##.....##...##..##..........##.....
# ..##.......##.....##.##.##.##....##....##.....##.##..........##.....
# ..##.......##.....##.##..####....##....#########.##..........##.....
# ..##....##.##.....##.##...###....##....##.....##.##....##....##.....
# ...######...#######..##....##....##....##.....##..######.....##.....
# ....................................................................

// http://patorjk.com/software/taag/#p=display&f=Banner4&t=%20TRECE%20
// http://patorjk.com/software/taag/#p=display&f=Bright&t=Deprecated
// https://stackoverflow.com/questions/8154158/mysql-how-do-i-use-delimiters-in-triggers









  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

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

// http://patorjk.com/software/taag/#p=display&f=Banner4&t=%20TRECE%20
// http://patorjk.com/software/taag/#p=display&f=Bright&t=Deprecated
// https://stackoverflow.com/questions/8154158/mysql-how-do-i-use-delimiters-in-triggers



  if(isset($_POST["name"])) :

    require($conf["dir"]["libraries"]."phpmailer/src/Exception.php");
    require($conf["dir"]["libraries"]."phpmailer/src/PHPMailer.php");
    require($conf["dir"]["libraries"]."phpmailer/src/SMTP.php");

    class Contact{

      function sendMessage() {

        $this->wrongCaptchaResponse = false;

        # ..................................................................
        # ..#####..######..####...####..#####..######..####..##..##..####...
        # ..##..##.##.....##..##.##..##.##..##...##...##..##.##..##.##..##..
        # ..#####..####...##.....######.#####....##...##.....######.######..
        # ..##..##.##.....##..##.##..##.##.......##...##..##.##..##.##..##..
        # ..##..##.######..####..##..##.##.......##....####..##..##.##..##..
        # ..................................................................

        if(!isset($this->g_recaptcha_response) || empty($this->g_recaptcha_response)) :

          $this->wrongCaptchaResponse = true; return true;

        else :

          if(isset($this->g_recaptcha_response) && !empty($this->g_recaptcha_response)) :
            $this->secret = $this->conf["recaptcha"]["secret"];
            $data = array(
              "secret" => $this->secret,
              "response" => $this->g_recaptcha_response,
              "remoteip" => $_SERVER["REMOTE_ADDR"],
              );
            $verify = curl_init();
              curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
              curl_setopt($verify, CURLOPT_POST, true);
              curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
              curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
              curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
            $response = json_decode(curl_exec($verify),true);

            if($response["success"]!=true) :
              $this->wrongCaptchaResponse = true; return true;
              die();
            endif;
          endif;

        endif;

        # .. END reCAPTCHA
        # ..................................................................

        $this->mail_to          = $this->conf["contact"]["email"];
        $this->mail_subject     = "Message from ".$this->conf["meta"]["name"][LANG];
        $this->mail_from        = $this->conf["mail"]["from"];
        $this->mail_host        = $this->conf["mail"]["host"];
        $this->mail_username    = $this->conf["mail"]["username"];
        $this->mail_password    = $this->conf["mail"]["password"];
        $this->mail_tls_or_ssl  = $this->conf["mail"]["tls_or_ssl"];
        $this->mail_port        = $this->conf["mail"]["port"];

        $mail = new PHPMailer(true);
        try {
            $mail->CharSet = "utf-8";
            $mail->setLanguage("es");
            $mail->ContentType = "text/html; charset=utf-8\r\n";
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = $this->mail_host;
            $mail->SMTPAuth = true;
            $mail->Username = $this->mail_username;
            $mail->Password = $this->mail_password;
            $mail->SMTPSecure = $this->mail_tls_or_ssl;
            $mail->Port = $this->mail_port;
            $mail->setFrom($this->mail_from,$this->conf["meta"]["name"][LANG]);
            $mail->addAddress($this->mail_to);
            $mail->addReplyTo($this->mail_email,$this->mail_name);
            $mail->isHTML(true);
            $mail->Subject = $this->mail_subject;
            $mail->Body = nl2br($this->mail_message);
            $mail->AltBody = $this->mail_message;
            $mail->CharSet = "utf-8";
            $mail->send();
            return true;
            } catch (Exception $e) { echo "Message could not be sent. Mailer Error: " . $mail->ErrorInfo; }
      }
    }

    $trece = new Contact();
    $trece->conf = $conf;
    $trece->mail_name             = isset($_POST["name"]) ? $_POST["name"] : "No name";
    $trece->mail_email            = isset($_POST["email"]) ? $_POST["email"] : "No eMail address";
    $trece->mail_message          = $trece->mail_name." <a href=\"mailto:".$trece->mail_email."\">".$trece->mail_email."</a> ".(isset($_POST["message"]) ? " wrote:<br><br>".$_POST["message"] : " sent a message without text.");
    $trece->g_recaptcha_response  = $_POST["g-recaptcha-response"];

    if(!$trece->sendMessage()):

      $msg = true;

      $msgType = "danger";
      $msgText = "Your message could not be sent.";
      return null;
      die();

    else :

      $msg = true;

      if($trece->wrongCaptchaResponse) :
        $msgType = "danger";
        $msgText = "Error. reCAPTCHA verification failed.";
      else :
        $msgType = "success";
        $msgText = "Message sent. Thank you :-)";
      endif;


    endif;

  endif;



//Still here? OK, let's talk.

  $lCustom["pagetitle"][LANG] = "Contacta con ".$conf["meta"]["name"][LANG];
  $conf["meta"]["description"][LANG] = $conf["contact"]["email"];



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
          <h1><?=$lCustom["pagetitle"][LANG];?></h1>
        </div>
      </div>

      <div class="col-xs-12 col-sm-8 col-sm-offset-2">

        <form id="form" class="form-horizontal" action="" method="post">

        <fieldset style="margin-bottom:3em;">
          <p style="margin:0;font-size:2em;">
          <?php if(isset($conf["contact"]["phone_no"]) && strlen($conf["contact"]["phone_no"])>0) : ?>
            <a href="tel:<?=$conf["contact"]["phone_no"];?>"><i class="fa fa-phone-square" aria-hidden="true"></i></a>
          <?php endif; ?>
          <?php if(isset($conf["contact"]["email"]) && strlen($conf["contact"]["email"])>0) : ?>
            <a href="mailto:<?=$conf["contact"]["email"];?>"><i class="fa fa-envelope" aria-hidden="true"></i></a>
          <?php endif; ?>
          <?php if(isset($conf["contact"]["telegram"]) && strlen($conf["contact"]["telegram"])>0) : ?>
            <a href="https://t.me/<?=$conf["contact"]["telegram"];?>" target="_blank"><i class="fa fa-telegram" aria-hidden="true"></i></a>
          <?php endif; ?>
          <?php if(isset($conf["contact"]["twitter"]) && strlen($conf["contact"]["twitter"])>0) : ?>
            <a href="https://twitter.com/<?=$conf["contact"]["twitter"];?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
          <?php endif; ?>
          <?php if(isset($conf["contact"]["facebook"]) && strlen($conf["contact"]["facebook"])>0) : ?>
            <a href="https://facebook.com/<?=$conf["contact"]["facebook"];?>" target="_blank"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
          <?php endif; ?>
          <?php if(isset($conf["contact"]["instagram"]) && strlen($conf["contact"]["instagram"])>0) : ?>
            <a href="https://instagram.com/<?=$conf["contact"]["instagram"];?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
          <?php endif; ?>
          <?php if(isset($conf["contact"]["youtube"]) && strlen($conf["contact"]["youtube"])>0) : ?>
            <a href="https://youtube.com/channel/<?=$conf["contact"]["youtube"];?>" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
          <?php endif; ?>
          </p>
        </fieldset>

        <fieldset>
        <legend>Contact form</legend>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="name">Name</label>
          <div class="col-md-6">
          <input id="name" name="name" type="text" placeholder="" class="form-control input-md" required>

          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="email">eMail address</label>
          <div class="col-md-6">
          <input id="email" name="email" type="email" placeholder="" class="form-control input-md" required>

          </div>
        </div>

        <!-- Textarea -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="message">Message</label>
          <div class="col-md-6">
            <textarea class="form-control" id="message" name="message" style="height:200px;" required></textarea>
          </div>
        </div>

        <!-- RXPD -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="textarea"><abbr title="General Data Protection Regulation">GDPR</abbr>:</label>
          <div class="col-md-6">
            <label class="checkbox-inline">
            <p><input class="checkbox" type="checkbox" onchange="toggleDisable(this);" id="check"> General Data Protection Regulation:<br>Yes, I've read and accept the <a href="<?=REALPATHLANG.$conf["file"]["privacy-policy"];?>" target="_blank">privacy policy</a> <i class="fa fa-external-link" aria-hidden="true"></i>.</p>
            </label>
          </div>
        </div>

        </fieldset>

        <fieldset id="field_set" style="margin:0;padding-top:0;padding-bottom:0;" disabled>

        <!-- reCAPTCHA -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="singlebutton"></label>
          <div class="col-md-6">
            <div class="g-recaptcha" data-sitekey="<?=$conf["recaptcha"]["public"];?>"></div>
          </div>
        </div>

        <!-- Button -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="singlebutton"></label>
          <div class="col-md-6">
            <button id="singlebutton" name="singlebutton" class="btn btn-cons">Send</button>
          </div>
        </div>

        </fieldset>

        </form>

      </div>

    </div>

  </div>



  <div class="clearfix"></div>



  <?php if($msg&&$msgType!="danger") : ?>
  <script>
    $(".alert-dismissable").fadeTo(2000,500).slideUp(500,function(){$(".alert-dismissable").slideUp(500);});
  </script>
  <?php endif; ?>



  <!-- reCAPTCHA -->
  <script src="https://www.google.com/recaptcha/api.js"></script>



  <script>
    function toggleDisable(checkbox) {
      var toggle = document.getElementById("field_set");
      checkbox.checked ? toggle.disabled = false : toggle.disabled = true;
      }
  </script>

<?php

  require_once($conf["dir"]["includes"]."footer.php");

?>
