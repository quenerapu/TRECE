<?php if(!defined("TRECE")):header("location:./");die();endif; ?>
<?php

  $zaska = false;

  # prevent XSS
  if(isset($_GET))  : $_GET   = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);  endif;
  if(isset($_POST)) : $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); endif;



  if(isset($_POST["install"])) :

    $error = false;

    function checkValidColorHex($colorCode) {
      $colorCode = ltrim($colorCode,"#"); # If user accidentally passed along the # sign, strip it off
      if(ctype_xdigit($colorCode)&&(strlen($colorCode)==6||strlen($colorCode)==3)) : return true;
      else : return false;
      endif;
      }

    $database_entropy   = html_entity_decode($_POST["database_entropy"],ENT_QUOTES | ENT_XML1,"UTF-8");
    $database_entropy   = getUrlFriendlyString($database_entropy,"");
    $database_entropy   = in_array($database_entropy,["","inconceivable"]) ? chr(rand(97,122)).substr(str_shuffle(MD5(microtime())),0,9) : $database_entropy;
    $database_host      = trim($_POST["database_host"]);
    $database_name      = trim($_POST["database_name"]);
    $database_username  = trim($_POST["database_username"]);
    $database_password  = $_POST["database_password"];
    $site_title         = trim($_POST["site_title"]);
    $site_title_url     = html_entity_decode($site_title,ENT_QUOTES | ENT_XML1,"UTF-8");
    $site_title_url     = getUrlFriendlyString($site_title_url);
    $theme_color        = checkValidColorHex($_POST["theme_color"]) ? ltrim($_POST["theme_color"],"#") : $conf["trece"]["theme-color"];
    $email_address      = filter_var($_POST["email_address"],FILTER_SANITIZE_EMAIL);
    $email_host         = trim($_POST["email_host"]);
    $email_password     = $_POST["email_password"];
    $email_tlsssl       = trim($_POST["email_tlsssl"]);
    $email_port         = filter_var($_POST["email_port"],FILTER_SANITIZE_NUMBER_INT);
    $admin_name         = trim($_POST["admin_name"]);
    $admin_surname      = trim($_POST["admin_surname"]);
    $admin_username     = html_entity_decode($_POST["admin_username"],ENT_QUOTES | ENT_XML1,"UTF-8");
    $admin_username     = getUrlFriendlyString($admin_username,"");
    $admin_email        = filter_var($_POST["admin_email"],FILTER_SANITIZE_EMAIL);



    try{
        $zaska = @new pdo("mysql:host=".$database_host.";dbname=".$database_name.";charset=utf8mb4",$database_username,$database_password,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $zaska = false;
        }catch(PDOException $ex){$zaska = true;}


      if(!$zaska) :


          $reading = fopen($conf["dir"]["core"].$conf["file"]["conf"].".php","r");
          $writing = fopen($conf["dir"]["core"].$conf["file"]["conf"].".tmp","w");

          $replaced = false;

          while (!feof($reading)) :

            $line = fgets($reading);

            # site stuff
            if (stristr($line,"\"en\" =>  \"Site name\",")) :                   $line = "                   \"en\" =>  \"".$site_title."\",\n";                  $replaced = true; endif;
            if (stristr($line,"\"gal\" =>  \"Nome do sitio web\",")) :          $line = "                  \"gal\" =>  \"".$site_title."\",\n";                  $replaced = true; endif;
            if (stristr($line,"\"es\" =>  \"Nombre del sitio web\",")) :        $line = "                   \"es\" =>  \"".$site_title."\",\n";                  $replaced = true; endif;
            if (stristr($line,"\"en\" =>  \"Site title\",")) :                  $line = "                   \"en\" =>  \"".$site_title."\",\n";                  $replaced = true; endif;
            if (stristr($line,"\"gal\" =>  \"Título do sitio web\",")) :        $line = "                  \"gal\" =>  \"".$site_title."\",\n";                  $replaced = true; endif;
            if (stristr($line,"\"es\" =>  \"Título del sitio web\",")) :        $line = "                   \"es\" =>  \"".$site_title."\",\n";                  $replaced = true; endif;
            # theme stuff
            if (stristr($line,"\"theme-color\"   =>  \"9b4dca\",")) :           $line = "    \"theme-color\"   =>  \"".str_replace("#","",$theme_color)."\",\n"; $replaced = true; endif;
            # mail stuff
            if (stristr($line,"\"from\"          =>  \"email@domain.com\",")) : $line = "    \"from\"          =>  \"".$email_address."\",\n";                   $replaced = true; endif;
            if (stristr($line,"\"host\"          =>  \"domain.com\",")) :       $line = "    \"host\"          =>  \"".$email_host."\",\n";                      $replaced = true; endif;
            if (stristr($line,"\"username\"      =>  \"email@domain.com\",")) : $line = "    \"username\"      =>  \"".$email_address."\",\n";                   $replaced = true; endif;
            if (stristr($line,"\"password\"      =>  \"1234\",")) :             $line = "    \"password\"      =>  \"".$email_password."\",\n";                  $replaced = true; endif;
            if (stristr($line,"\"tls_or_ssl\"    =>  \"tls\",")) :              $line = "    \"tls_or_ssl\"    =>  \"".$email_tlsssl."\",\n";                    $replaced = true; endif;
            if (stristr($line,"\"port\"          =>  \"000\",")) :              $line = "    \"port\"          =>  \"".$email_port."\",\n";                      $replaced = true; endif;

            # database stuff
            if (stristr($line,"\"entropy\"           =>  \$entropy=\"inconceivable\",")) : $line = "    \"entropy\"           =>  \$entropy=\"".$database_entropy."\",\n"; $replaced = true; endif;

            fputs($writing, $line);

          endwhile;

          fclose($reading); fclose($writing);

          if ($replaced) : rename($conf["dir"]["core"].$conf["file"]["conf"].".tmp",$conf["dir"]["core"].$conf["file"]["conf"].".php"); 
            else : unlink($conf["dir"]["core"].$conf["file"]["conf"].".tmp");
          endif;



          $reading = fopen($conf["dir"]["core"].$conf["file"]["db"].".php","r");
          $writing = fopen($conf["dir"]["core"].$conf["file"]["db"].".tmp","w");

          $replaced = false;

          while (!feof($reading)) :

            $line = fgets($reading);

            # database
            if (stristr($line,"private \$host     = \"localhost\";")) :     $line = "    private \$host     = \"".$database_host."\";\n";        $replaced = true; endif;
            if (stristr($line,"private \$db_name  = \"db_name\";")) :       $line = "    private \$db_name  = \"".$database_name."\";\n";        $replaced = true; endif;
            if (stristr($line,"private \$username = \"db_username\";")) :   $line = "    private \$username = \"".$database_username."\";\n";    $replaced = true; endif;
            if (stristr($line,"private \$password = \"1234\";")) :          $line = "    private \$password = \"".$database_password."\";\n";    $replaced = true; endif;

            fputs($writing, $line);

          endwhile;

          fclose($reading); fclose($writing);

          if ($replaced) : rename($conf["dir"]["core"].$conf["file"]["db"].".tmp",$conf["dir"]["core"].$conf["file"]["db"].".php");
            else : unlink($conf["dir"]["core"].$conf["file"]["db"].".tmp");
          endif;



          $reading = fopen($conf["dir"]["includes"].$conf["dir"]["users"]."/tables.sql","r");
          $writing = fopen($conf["dir"]["includes"].$conf["dir"]["users"]."/tables.tmp","w");

          $replaced = false;

          while (!feof($reading)) :

            $line = fgets($reading);

            # table
            if (stristr($line,"email@domain.com")) : $line = "(1, 1,  1,  0,  1,  0,  '".$admin_name."', '".$admin_surname."',  '".$admin_username."',  'x',  '".$admin_email."', '', NULL, '0000-00-00 00:00:00',  '0.0.0.0',  0,  '', NOW(),  NOW(),  '0.0.0.0',  LEFT(UUID(),8), 1);\n"; $replaced = true; endif;

            fputs($writing, $line);

          endwhile;

          fclose($reading); fclose($writing);

          if ($replaced) : rename($conf["dir"]["includes"].$conf["dir"]["users"]."/tables.tmp",$conf["dir"]["includes"].$conf["dir"]["users"]."/tables.sql");
            else : unlink($conf["dir"]["includes"].$conf["dir"]["users"]."/tables.tmp");
          endif;



          $reading = fopen($conf["dir"]["includes"].$conf["dir"]["organizations"]."/tables.sql","r");
          $writing = fopen($conf["dir"]["includes"].$conf["dir"]["organizations"]."/tables.tmp","w");

          $replaced = false;

          while (!feof($reading)) :

            $line = fgets($reading);

            # table
            if (stristr($line,"Your project")) : $line = "(1, 1,  1,  1,  0,  1,  '".$site_title."',  '".$site_title_url."', '', '', '', '', 0,  '', '', '', '', '', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1);\n"; $replaced = true; endif;

            fputs($writing, $line);

          endwhile;

          fclose($reading); fclose($writing);

          if ($replaced) : rename($conf["dir"]["includes"].$conf["dir"]["organizations"]."/tables.tmp",$conf["dir"]["includes"].$conf["dir"]["organizations"]."/tables.sql");
            else : unlink($conf["dir"]["includes"].$conf["dir"]["organizations"]."/tables.tmp");
          endif;

          echo "<meta http-equiv=\"refresh\" content=\"0\">";
          die();

      endif;

  endif;

?>
<!doctype html>
<!-- TRECE <?=$conf["trece"]["version"];?> -->
<html dir="ltr" lang="es-ES">
<head>

  <meta charset="utf-8">
  <title>TRECE</title>
<!-- Normalize.css -->
  <link rel="stylesheet" type="text/css" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/<?=$conf["version"]["normalize_css"];?>/normalize.min.css">
<!-- Font Awesome -->
  <link rel="stylesheet" type="text/css" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/<?=$conf["version"]["fontawesome"];?>/css/all.min.css">
<!-- Custom CSS -->
  <link rel="stylesheet" type="text/css" media="screen" href="<?=$conf["dir"]["themes"].$conf["trece"]["theme"];?>/<?=$conf["dir"]["styles"].$conf["file"]["styles"];?>.php?c=<?=$conf["trece"]["theme-color"];?>">
  <style>
    .trece{border:1px solid #ccc;border-radius:1rem;margin:2rem;padding:2rem !important;}
    button[name=install]{margin-top:2rem;}
    .error{border:3px solid #dc3545;padding:1rem;margin-top:1rem;line-height:2rem;}
    .notice{border:3px solid #28a745;padding:1rem;margin-top:1rem;line-height:2rem;}
  </style>

</head>

<body>

  <div class="container" style="margin:2rem auto;">

    <div class="row">

      <div class="column">

        <img class="logo" src="<?="data:image/svg+xml;base64,".str_replace("[COLOR]",$conf["trece"]["logo"]["garnet"],$conf["trece"]["logo"]["img"]);?>" style="max-width:8rem;" alt="TRECE <?=$conf["trece"]["version"];?>">

      </div>

    </div>

    <form id="firsttime" method="post" autocomplete="off">

    <div class="row">

      <div class="column trece" style="margin-left:1rem;">

        <h3>Database stuff</h3>

        <div class="row">
          <div class="column column-50">
            <p>DB Host<br>
              <input type="text"
                     name="database_host"
                     id="database_host"
                     placeholder=""
                     <?=$zaska?"style=\"background:yellow;\"":"";?>
                     value="<?=$zaska?$database_host:"";?>"
                     required>
            </p>
          </div>
          <div class="column column-50">
            <p>DB Name<br>
              <input type="text"
                     name="database_name"
                     id="database_name"
                     placeholder=""
                     <?=$zaska?"style=\"background:yellow;\"":"";?>
                     value="<?=$zaska?$database_name:"";?>"
                     required>
            </p>
          </div>
        </div>

        <div class="row">
          <div class="column column-50">
            <p>DB Username<br>
              <input type="text"
                     name="database_username"
                     id="database_username"
                     placeholder=""
                     <?=$zaska?"style=\"background:yellow;\"":"";?>
                     value="<?=$zaska?$database_username:"";?>"
                     required>
            </p>
          </div>
          <div class="column column-50">
            <p>DB Password<br>
              <input type="text"
                     name="database_password"
                     id="database_password"
                     placeholder=""
                     <?=$zaska?"style=\"background:yellow;\"":"";?>
                     value="<?=$zaska?$database_password:"";?>"
                     required>
            </p>
          </div>
        </div>

        <p>DB Entropy<br>
          <input type="text"
                 name="database_entropy"
                 id="database_entropy"
                 placeholder="inconceivable"
                 pattern="^(?!inconceivable$)(.*)"
                 maxlength="20"
                 style="margin-bottom:0;"
                 value="<?=$zaska?$database_entropy:"";?>"
                 required><br>
          <small>* Type here a word DIFFERENT to <strong>inconceivable</strong>.</small>
        </p>

        <?=$zaska?"<p class=\"error\">⚠️ There's something wrong with one of the fields marked in yellow.</p>":"";?>

      </div>

      <div class="column trece">

        <h3>Notifications stuff</h3>

        <div class="row">
          <div class="column column-50">
            <p>eMail Address<br>
              <input type="email"
                     name="email_address"
                     id="email_address"
                     placeholder="noreply@blah.blah"
                     value="<?=$zaska?$email_address:"";?>"
                     required>
            </p>
          </div>
          <div class="column column-50">
            <p>eMail Password<br>
              <input type="text"
                     name="email_password"
                     id="email_password"
                     placeholder=""
                     value="<?=$zaska?$email_password:"";?>"
                     required>
            </p>
          </div>
        </div>

        <p>eMail Host<br>
          <input type="text"
                 name="email_host"
                 id="email_host"
                 placeholder=""
                 value="<?=$zaska?$email_host:"";?>"
                 required>
        </p>

        <div class="row">
          <div class="column column-60">
            <p>eMail TLS/SSL<br>
              <input type="text"
                     name="email_tlsssl"
                     id="email_tlsssl"
                     placeholder=""
                     pattern="^(tls|ssl)$"
                     maxlength="3"
                     value="<?=$zaska?$email_tlsssl:"";?>"
                     required>
            </p>
          </div>
          <div class="column column-40">
            <p>eMail Port<br>
              <input type="number"
                     name="email_port"
                     id="email_port"
                     placeholder=""
                     value="<?=$zaska?$email_port:"";?>"
                     required>
            </p>
          </div>
        </div>

        <p class="notice">📌 This is the address from which all the notifications (forgot password, etc) will be sent.</p>

      </div>

      <div class="column trece" style="margin-right:1rem;">

        <h3>Site stuff</h3>

        <div class="row">
          <div class="column column-80">
            <p>Site title / main color<br>
              <input type="text"
                     name="site_title"
                     id="site_title"
                     placeholder="My new website"
                     value="<?=$zaska?$site_title:"";?>"
                     required>
            </p>
          </div>
          <div class="column column-20">
            <p>&nbsp;<br>
              <input type="color"
                     name="theme_color"
                     id="theme_color"
                     value="<?=$zaska?"#".$theme_color:"#".$conf["trece"]["theme-color"];?>">
            </p>
          </div>
        </div>
<?php /*
        <p>Site languages<br>
          <input type="text"
                 name="site_languages"
                 id="site_languages"
                 placeholder=""
                 value="en | gal | es"
                 value="<?=$zaska?$site_languages:"en | gal | es";?>"
                 readonly>
        </p>
*/ ?>
        <div class="row">
          <div class="column column-40">
            <p>Admin name<br>
              <input type="text"
                     name="admin_name"
                     id="admin_name"
                     placeholder=""
                     value="<?=$zaska?$admin_name:"";?>"
                     required>
            </p>
          </div>
          <div class="column column-60">
            <p>Admin surname<br>
              <input type="text"
                     name="admin_surname"
                     id="admin_surname"
                     placeholder=""
                     value="<?=$zaska?$admin_surname:"";?>">
            </p>
          </div>
        </div>

        <p>Admin Username<br>
          <input type="text"
                 name="admin_username"
                 id="admin_username"
                 placeholder=""
                 value="<?=$zaska?$admin_username:"";?>"
                 required>
        </p>

        <p>Admin's eMail address<br>
          <input type="email"
                 name="admin_email"
                 id="admin_email"
                 value="<?=$zaska?$admin_email:"";?>"
                 required>
        </p>

      </div>

    </div>

    <button type="submit" name="install">Install TRECE</button>

    </form>


</body>
</html>
