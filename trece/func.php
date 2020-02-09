<?php if(!defined("TRECE")):header("location:/");die();endif; ?>
<?php

function nav($bt="Link",$ru=false,$bc=false,$fa=false) { # Creates nav link

  # $bt --> Button text
  # $ru --> Button relative url
  # $bc --> Button class
  # $fa --> Font awesome icon

  # ^ generates a URL without language
  # ! generates a not friendy URL
  # ) generates a URL without query

  # nav("The text");               --> Links to /[LANG]/the-text, using 'The text' as link text. Then adds query, if exists. Simplest behavior
  # nav("The text","the link");    --> Links to /[LANG]/the-link, using 'The text' as link text. Then adds query, if exists. Usual behavior
  # nav("^The text");              --> Links to /the-text,        using 'The text' as link text. Then adds query, if exists. IGNORES LANG
  # nav("The text","^the link");   --> Links to /the-link,        using 'The text' as link text. Then adds query, if exists. IGNORES LANG
  # nav("!The text");              --> Links to /[LANG]/The text, using 'The text' as link text. Then adds query, if exists. IGNORES FRIENDLY URL
  # nav("The text","!the link");   --> Links to /[LANG]/the link, using 'The text' as link text. Then adds query, if exists. IGNORES FRIENDLY URL
  # nav(")The text");              --> Links to /[LANG]/The-text, using 'The text' as link text.                             IGNORES QUERY
  # nav("The text",")the link");   --> Links to /[LANG]/the-link, using 'The text' as link text.                             IGNORES QUERY
  # nav("!)The text");             --> Links to /[LANG]/The text, using 'The text' as link text.                             IGNORES FRIENDLY URL & QUERY
  # nav("The text","!)the link");  --> Links to /[LANG]/the link, using 'The text' as link text.                             IGNORES FRIENDLY URL & QUERY
  # nav("^!)The text");            --> Links to /The-text,        using 'The text' as link text.                             IGNORES LANG, FRIENDLY URL & QUERY
  # nav("The text","^!)the link"); --> Links to /the link,        using 'The text' as link text.                             IGNORES LANG, FRIENDLY URL & QUERY

  $lnk = "<a";
  $lnk.= " href=\"".(($ru && !in_array(mb_substr(ltrim($ru,"!)"),0,1),["^"]))||(!$ru && !in_array(mb_substr(ltrim($bt,"!)"),0,1),["^"]))?REALPATHLANG:REALPATH).($ru?(!in_array(mb_substr(ltrim($ru,"^)"),0,1),["!"])?getUrlFriendlyString($ru):ltrim($ru,"^!)")):(!in_array(mb_substr(ltrim($bt,"^)"),0,1),["!"])?getUrlFriendlyString($bt):ltrim($bt,"^!)"))).($ru?(!in_array(mb_substr(ltrim($ru,"^!"),0,1),[")"])?QUERYQ:""):(!in_array(mb_substr(ltrim($bt,"^!"),0,1),[")"])?QUERYQ:""))."\"";
  $lnk.= ($bc?" class=\"".$bc."\"":"").">".($fa?"<i class=\"fas fa".($fa?" ".$fa:"")."\"></i>":"").ltrim($bt,"^!)")."</a>";
  return $lnk;
  }



# -----------------------------------------------------------------------------------



function btn($qqq,$q=false,$bc=false,$fa=false,$queryd=false) { # Creates button link
  $btn = "<a";
  $btn.= (!in_array(mb_substr($qqq,0,1),["!"]) ? " href=\"".($q && mb_substr($q,0,1)!="^"?REALPATHLANG:"").($q?(!in_array(mb_substr($q,0,1),["^","!"])?getUrlFriendlyString($q):ltrim($q,"^!")) : getUrlFriendlyString($qqq)).(mb_substr($q,0,1)!="^"?$queryd:"")."\"" :"");
  $btn.= " class=\"btn".($bc?" ".$bc:"")." btn-sm\" role=\"button\"><i class=\"fas".($fa?" ".$fa:"")."\"></i> ".ltrim($qqq,"^!")."</a>";
  return $btn;
  }



# -----------------------------------------------------------------------------------



function get_words($sentence,$count=10) { # Cleanly gets firsts $count words from string
  $sentence = html_entity_decode(strip_tags($sentence)); # Fuera HTML!
  $sentence = str_replace(array('"','«','»'),"",$sentence); # Fuera comillas!
  $pattern = '/[\s,:?!]+/u'; # ,:?! Signos que NO cuentan como palabras si van sueltas
  $wordsarray = preg_split($pattern,$sentence,-1,PREG_SPLIT_NO_EMPTY);
  $wordscount = count($wordsarray);
  $segment = implode(" ", array_slice($wordsarray,0,$count));
  $segment.= $wordscount > $count ? " […]" : "" ;
  return $segment;
  }



# -----------------------------------------------------------------------------------



  function fixImageOrientation(&$source,$filename){
    $source=imagerotate($source,array_values([0,0,0,180,0,0,-90,0,90])[@exif_read_data($filename)["Orientation"]?:0],0);
    }



# -----------------------------------------------------------------------------------



  function resizeImage($s,$f,$w,$h,$nw,$nh,$x=0,$y=0) {
    $d = imagecreatetruecolor($nw,$nh);
    if($w>$h) : $nw=floor($w*($nh/$h)); $x=ceil(($w-$h)/2);
    elseif($h>$w) : $nh=floor($h*($nw/$w)); $y=ceil(($h-$w)/2);
/* OLDER???
    if($nw==$nh) :
      if($w>$h) : $nw=floor($w*($nh/$h)); $x=ceil(($w-$h)/2);
      elseif($h>$w) : $nh=floor($h*($nw/$w)); $y=ceil(($h-$w)/2);
      endif;
*/
    endif;
    imagecopyresampled($d,$s,0,0,$x,$y,$nw,$nh,$w,$h); imagejpeg($d,$f,100); imagedestroy($d);
    }



# -----------------------------------------------------------------------------------



  function cropImage($s,$f,$w,$h,$nw,$nh,$x=0,$y=0) {
    $d = imagecreatetruecolor($nw,$nh);
    if($nw==$nh) :
      if($w>$h) : $nw=floor($w*($nh/$h)); $x=ceil(($w-$h)/2);
      elseif($h>$w) : $nh=floor($h*($nw/$w)); $y=ceil(($h-$w)/2);
      endif;
    endif;
    imagecopyresampled($d,$s,$x,$y,0,0,$nw,$nh,$nw,$nh); imagejpeg($d,$f,100); imagedestroy($d);
//  imagecopyresampled($d,$s,$x,$y,$nw,$nh,$nw,$nh,$nw,$nh); imagejpeg($d,$f,100); imagedestroy($d);
//  imagecopyresampled($d,$s,0,0,$x,$y,$nw,$nh,$w,$h); imagejpeg($d,$f,100); imagedestroy($d);


    }



# -----------------------------------------------------------------------------------



    function compressImage($source_url, $destination_url, $quality){
        $info = getimagesize($source_url);

        if ($info["mime"]     ==  "image/jpeg") $image = imagecreatefromjpeg($source_url);
        elseif ($info["mime"] ==  "image/gif")  $image = imagecreatefromgif($source_url);
        elseif ($info["mime"] ==  "image/png")  $image = imagecreatefrompng($source_url);

        //save file
        imagejpeg($image, $destination_url, $quality);

        //return destination file
        return $destination_url;
    }



# -----------------------------------------------------------------------------------



  function doWordWrap($t,$x=100) {
    $t = strip_tags(htmlspecialchars_decode($t));
    $t = wordwrap($t,$x,"ƒ",false);
    $t = explode("ƒ",$t,2);
    $t = $t[0].((strlen($t[0])>($x-10) && strlen($t[0])<($x+10))?"…":"");
    return $t;
    }



# -----------------------------------------------------------------------------------



  function validateDate($date,$format ="Y-m-d") {
    $d = DateTime::createFromFormat($format,$date);
    return $d && $d->format($format)==$date;
    }



# -----------------------------------------------------------------------------------



function shapeSpace_remove_var($url, $key) {
//$url = preg_replace('/(.*)(?|&)'. $key .'=[^&]+?(&)(.*)/i', '$1$2$4', $url .'&');
  $url = preg_replace('/(.*)(?|&)'. $key .'/i', '$1', $url .'&');
  $url = substr($url, 0, -1);
  return ($url);
}



# -----------------------------------------------------------------------------------



function shapeSpace_add_var($url, $key, $value) {
  
  $url = preg_replace('/(.*)(?|&)'. $key .'=[^&]+?(&)(.*)/i', '$1$2$4', $url .'&');
  $url = substr($url, 0, -1);
  
  if (strpos($url, '?') === false) {
    return ($url .'?'. $key .'='. $value);
  } else {
    return ($url .'&'. $key .'='. $value);
  }
}



# -----------------------------------------------------------------------------------



function checkValidColorHex($colorCode) {

  $colorCode = ltrim($colorCode,"#"); # If user accidentally passed along the # sign, strip it off
  if(ctype_xdigit($colorCode)&&(strlen($colorCode)==6||strlen($colorCode)==3)) : return true;
  else : return false;
  endif;
  }



# -----------------------------------------------------------------------------------



