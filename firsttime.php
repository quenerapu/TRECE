<?php

  if(isset($_POST["install"])) :
/*
    echo "<br><strong>database_entropy:</strong> ".$_POST["database_entropy"];
    echo "<br><strong>database_host:</strong> ".$_POST["database_host"];
    echo "<br><strong>database_name:</strong> ".$_POST["database_name"];
    echo "<br><strong>database_username:</strong> ".$_POST["database_username"];
    echo "<br><strong>database_password:</strong> ".$_POST["database_password"];
    echo "<br><strong>email_address:</strong> ".$_POST["email_address"];
    echo "<br><strong>email_host:</strong> ".$_POST["email_host"];
    echo "<br><strong>email_password:</strong> ".$_POST["email_password"];
    echo "<br><strong>email_tlsssl:</strong> ".$_POST["email_tlsssl"];
    echo "<br><strong>email_port:</strong> ".$_POST["email_port"];
    echo "<br><strong>recaptcha_publicke:</strong> ".$_POST["recaptcha_publickey"];
    echo "<br><strong>recaptcha_secretke:</strong> ".$_POST["recaptcha_secretkey"];
    echo "<br><strong>admin_username:</strong> ".$_POST["admin_username"];
    echo "<br><strong>admin_email:</strong> ".$_POST["admin_email"];
*/


# .........................................................................................................................
# ...######...#######..########..########.......##..######...#######..##....##.########.....########..##.....##.########...
# ..##....##.##.....##.##.....##.##............##..##....##.##.....##.###...##.##...........##.....##.##.....##.##.....##..
# ..##.......##.....##.##.....##.##...........##...##.......##.....##.####..##.##...........##.....##.##.....##.##.....##..
# ..##.......##.....##.########..######......##....##.......##.....##.##.##.##.######.......########..#########.########...
# ..##.......##.....##.##...##...##.........##.....##.......##.....##.##..####.##...........##........##.....##.##.........
# ..##....##.##.....##.##....##..##........##......##....##.##.....##.##...###.##.......###.##........##.....##.##.........
# ...######...#######..##.....##.########.##........######...#######..##....##.##.......###.##........##.....##.##.........
# .........................................................................................................................

    $reading = fopen("core/conf.php","r");
    $writing = fopen("core/conf.tmp","w");

    $replaced = false;

    while (!feof($reading)) :

      $line = fgets($reading);

      # mail
      if (stristr($line,"\"from\"       =>  \"email@domain.com\",")) : $line = "    \"from\"       =>  \"".$_POST["email_address"]."\",\n"; $replaced = true; endif;
      if (stristr($line,"\"host\"       =>  \"domain.com\",")) : $line = "    \"host\"       =>  \"".$_POST["email_host"]."\",\n"; $replaced = true; endif;
      if (stristr($line,"\"username\"   =>  \"email@domain.com\",")) : $line = "    \"username\"   =>  \"".$_POST["email_address"]."\",\n"; $replaced = true; endif;
      if (stristr($line,"\"password\"   =>  \"1234\",")) : $line = "    \"password\"   =>  \"".$_POST["email_password"]."\",\n"; $replaced = true; endif;
      if (stristr($line,"\"tls_or_ssl\" =>  \"tls\",")) : $line = "    \"tls_or_ssl\" =>  \"".$_POST["email_tlsssl"]."\",\n"; $replaced = true; endif;
      if (stristr($line,"\"port\"       =>  000,")) : $line = "    \"port\"       =>  ".$_POST["email_port"].",\n"; $replaced = true; endif;

      # recaptcha
      if (stristr($line,"\"public\"  =>  \"xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx\",")) : $line = "    \"public\"  =>  \"".$_POST["recaptcha_publickey"]."\",\n"; $replaced = true; endif;
      if (stristr($line,"\"secret\"  =>  \"yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy\",")) : $line = "    \"secret\"  =>  \"".$_POST["recaptcha_secretkey"]."\",\n"; $replaced = true; endif;

      # database
      if (stristr($line,"\"entropy\"           =>  \$entropy=\"inconceivable\",")) : $line = "    \"entropy\"           =>  \$entropy=\"".$_POST["database_entropy"]."\",\n"; $replaced = true; endif;

      fputs($writing, $line);

    endwhile;

    fclose($reading); fclose($writing);

    if ($replaced) : rename("core/conf.tmp","core/conf.php"); else : unlink("core/conf.tmp"); endif;



# ........................................................................................................
# ...######...#######..########..########.......##.########..########......########..##.....##.########...
# ..##....##.##.....##.##.....##.##............##..##.....##.##.....##.....##.....##.##.....##.##.....##..
# ..##.......##.....##.##.....##.##...........##...##.....##.##.....##.....##.....##.##.....##.##.....##..
# ..##.......##.....##.########..######......##....##.....##.########......########..#########.########...
# ..##.......##.....##.##...##...##.........##.....##.....##.##.....##.....##........##.....##.##.........
# ..##....##.##.....##.##....##..##........##......##.....##.##.....##.###.##........##.....##.##.........
# ...######...#######..##.....##.########.##.......########..########..###.##........##.....##.##.........
# ........................................................................................................

    $reading = fopen("core/db.php","r");
    $writing = fopen("core/db.tmp","w");

    $replaced = false;

    while (!feof($reading)) :

      $line = fgets($reading);

      # database
      if (stristr($line,"private \$host     = \"localhost\";")) : $line = "    private \$host     = \"".$_POST["database_host"]."\";\n"; $replaced = true; endif;
      if (stristr($line,"private \$db_name  = \"db_name\";")) : $line = "    private \$db_name  = \"".$_POST["database_name"]."\";\n"; $replaced = true; endif;
      if (stristr($line,"private \$username = \"db_username\";")) : $line = "    private \$username = \"".$_POST["database_username"]."\";\n"; $replaced = true; endif;
      if (stristr($line,"private \$password = \"1234\";")) : $line = "    private \$password = \"".$_POST["database_password"]."\";\n"; $replaced = true; endif;

      fputs($writing, $line);

    endwhile;

    fclose($reading); fclose($writing);

    if ($replaced) : rename("core/db.tmp","core/db.php"); else : unlink("core/db.tmp"); endif;



# ...................................................................................................................................................................................
# ..####.##....##..######........##.##.....##..######..########.########...######........##.########....###....########..##.......########..######.......######...#######..##........
# ...##..###...##.##....##......##..##.....##.##....##.##.......##.....##.##....##......##.....##......##.##...##.....##.##.......##.......##....##.....##....##.##.....##.##........
# ...##..####..##.##...........##...##.....##.##.......##.......##.....##.##...........##......##.....##...##..##.....##.##.......##.......##...........##.......##.....##.##........
# ...##..##.##.##.##..........##....##.....##..######..######...########...######.....##.......##....##.....##.########..##.......######....######.......######..##.....##.##........
# ...##..##..####.##.........##.....##.....##.......##.##.......##...##.........##...##........##....#########.##.....##.##.......##.............##...........##.##..##.##.##........
# ...##..##...###.##....##..##......##.....##.##....##.##.......##....##..##....##..##.........##....##.....##.##.....##.##.......##.......##....##.###.##....##.##....##..##........
# ..####.##....##..######..##........#######...######..########.##.....##..######..##..........##....##.....##.########..########.########..######..###..######...#####.##.########..
# ...................................................................................................................................................................................

    $reading = fopen("inc/users/tables.sql","r");
    $writing = fopen("inc/users/tables.tmp","w");

    $replaced = false;

    while (!feof($reading)) :

      $line = fgets($reading);

      # table
      if (stristr($line,"email@domain.com")) : $line = "(1, 1,  0,  1,  0,  'The Boss', 'Is In The House',  '".$_POST["admin_username"]."',  'm',  '".$_POST["admin_email"]."', '', NULL, '0000-00-00 00:00:00',  '0.0.0.0',  0,  '', NOW(),  NOW(),  '0.0.0.0',  LEFT(UUID(),8), 0);\";\n"; $replaced = true; endif;

      fputs($writing, $line);

    endwhile;

    fclose($reading); fclose($writing);

    if ($replaced) : rename("inc/users/tables.tmp","inc/users/tables.sql"); else : unlink("inc/users/tables.tmp"); endif;



    echo "<meta http-equiv=\"refresh\" content=\"0\">";

  else :

?><!doctype html>
<html dir="ltr" lang="en-EN">
<head>
  <meta charset=utf-8>
  <title>TRECE: Yes. The ugliest installer in the world</title>

  <style>
    body{padding:1em;}
    fieldset{display:inline;}
    legend{font-weight:bold;}
    button[type=submit]{margin:.5em 0 .3em 0;font-size:1.7em;}
  </style>

</head>
<body>

  <h1>TRECE: Yes. The ugliest installer in the world</h1>

  <form action="" method="post" autocomplete="off">

    <fieldset>

      <fieldset>

        <legend>Database:</legend>

          <div style="float:left;margin-right:1em;">

            <p>
              Host<br>
              <input type="text" name="database_host" id="database_host" value="localhost">
            </p>
            <p>
              DB Username<br>
              <input type="text" name="database_username" id="database_username" value="db_username">
            </p>
            <p>
              DB Password<br>
              <input type="text" name="database_password" id="database_password" value="1234">
            </p>

          </div>
          <div style="float:left;">

            <p>
              DB Name<br>
              <input type="text" name="database_name" id="database_name" value="db_name">
            </p>
            <p>
              DB Entropy<br>
              <input type="text" name="database_entropy" id="database_entropy" value="inconceivable">
            </p>

          </div>

      </fieldset>

      <fieldset>

        <legend>PHPMailer:</legend>

          <div style="float:left;margin-right:1em;">

            <p>
              Address<br>
              <input type="text" name="email_address" id="email_address" value="email@domain.com">
            </p>
            <p>
              Host<br>
              <input type="text" name="email_host" id="email_host" value="domain.com">
            </p>
            <p>
              Password<br>
              <input type="text" name="email_password" id="email_password" value="1234">
            </p>

          </div>
          <div style="float:left;margin-right:1em;">

            <p>
              TLS/SSL<br>
              <input type="text" name="email_tlsssl" id="email_tlsssl" value="tls">
            </p>
            <p>
              Port<br>
              <input type="text" name="email_port" id="email_port" value="000">
            </p>

          </div>

      </fieldset>

      <br>

      <fieldset>

        <legend>reCaptcha:</legend>

          <p>
            Public key<br>
            <input type="text" name="recaptcha_publickey" id="recaptcha_publickey" value="xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" style="width:250px;">
          </p>
          <p>
            Secret key<br>
            <input type="text" name="recaptcha_secretkey" id="recaptcha_secretkey" value="yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy" style="width:250px;">
          </p>

      </fieldset>

      <fieldset>

        <legend>Admin:</legend>

          <p>
            Username<br>
            <input type="text" name="admin_username" id="admin_username" value="theboss">
          </p>
          <p>
            eMail address<br>
            <input type="text" name="admin_email" id="admin_email" value="email@domain.com">
          </p>

      </fieldset>

      <br>

      <button type="submit" name="install">Install TRECE</button>

    </fieldset>


</body>
</html>
<?php endif; ?>
