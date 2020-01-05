![TRECE](https://trece.boa.gal/img/og/trece-github.jpg "TRECE")

# TRECE 0.16.00 - Chaguazoso is out!
TRECE is a content management system for the brave. Because what could go wrong?

With TRECE you can manage a blog, a page-based website or any other data. Includes a user management system.
 
From **TRECE 0.16.00** onwards, each new version will be assigned the name of a village in Galicia.

  - TRECE 0.16.00 - Chaguazoso https://gl.wikipedia.org/wiki/Chaguazoso,_Vilariño_de_Conso

## Prerequisites

- An Apache PHP friendly hosting
- A MySQL/MariaDB database
- A [reCAPTCHA](https://google.com/recaptcha) v2 pair of keys (soon it won't be mandatory anymore)
- An eMail account just for sending automatic eMails (the classic `noreply@domain.com` account)
- One eMail account for you, the administrator

## Installation

### Step 1

Create/Open the empty directory where you want to install TRECE.

### Step 2

Create/upload there a file named 'trece.php' with this content:

```php
<?php

  function rrmdir($dir) {
    if(is_dir($dir)): $files=scandir($dir); foreach($files as $file): if($file != "." && $file != ".."): rrmdir("$dir/$file"); endif; endforeach; rmdir($dir);
    elseif(file_exists($dir)): unlink($dir);
    endif;
    }

  function rcopy($src,$dst){
    if(is_dir($src)): mkdir($dst); $files=scandir($src); foreach($files as $file): if($file != "." && $file != ".."): rcopy("$src/$file","$dst/$file"); endif; endforeach;
    elseif(file_exists($src)): copy($src,$dst);
    endif;
    rrmdir($src);
    }

  set_time_limit(0);
  $fp = fopen(dirname(__FILE__)."/master.zip","w+");
  $ch = curl_init(str_replace(" ","%20","https://github.com/quenerapu/TRECE/archive/master.zip"));
  curl_setopt($ch,CURLOPT_TIMEOUT,50); curl_setopt($ch,CURLOPT_FILE,$fp); curl_setopt($ch,CURLOPT_FOLLOWLOCATION,true);
  curl_exec($ch); curl_close($ch); fclose($fp);

  $zip = new ZipArchive;
  $res = $zip->open(dirname(__FILE__)."/master.zip");
  if($res === TRUE): $zip->extractTo(dirname(__FILE__)."/"); $zip->close(); unlink(dirname(__FILE__)."/master.zip");
    rcopy(dirname(__FILE__)."/TRECE-master/",dirname(__FILE__)."/");
    unlink(dirname(__FILE__)."/trece.php");
    header("Location:./");
  endif;

?>
```

### Step 3

Run it in your browser. This script will download all the files and start the installer.

### Step 4

Follow the installer's instructions.

### Step 5

That's all! :) Click on «Sign In» and then click on «Forgot or don't know my password». Follow instructions to generate your password, sign in and test the site.
