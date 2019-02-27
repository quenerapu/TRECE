<?php

# -----------------------------------------------------------------------------------



  define("TRECE"                                , true);            # Aaaaaaamen brothers and sisters!
  define("NPE"                                  , false);           # Shows Non-Production Environment flag or not
  define("DEBUG"                                , false);           # Debuggable or not
  define("MARKDOWN"                             , true);            # Use the Markdown syntax or not
  define("THE_NAME_OF_THE_CORE_DIR"             , "core");          # CHANGE THIS and name the real folder accordingly
  define("THE_NAME_OF_THE_CONFIGURATION_FILE"   , "conf");          # CHANGE THIS and name the real file accordingly
  define("ENTROPY_AS_PREFIX_FOR_DATABASE_NAMES" , "inconceivable"); # CHANGE THIS and prefix your database table names accordingly



# -----------------------------------------------------------------------------------



  if((NPE) || (DEBUG)) :

    header("Cache-Control: no-cache, must-revalidate"); # HTTP/1.1
    header("Expires: Sat, 1 Jul 2000 05:00:00 GMT");    # Date in the past

    ini_set("display_startup_errors",1);
    ini_set("display_errors",1);
    error_reporting(E_ALL);
//  error_reporting(E_ALL ^ E_NOTICE);
//  error_reporting(E_ALL | E_STRICT);
//  error_reporting(E_ERROR | E_WARNING | E_PARSE | E_COMPILE_ERROR);

  else:

    ini_set("display_errors",0);
    ini_set("display_startup_errors",0);
    error_reporting(0);

  endif;



# -----------------------------------------------------------------------------------



  if(!file_exists(THE_NAME_OF_THE_CORE_DIR."/".THE_NAME_OF_THE_CONFIGURATION_FILE.".php")) : # configuration file is required

    echo "<h3>Defined configuration file not found. Bye.</h3>"; die();

  endif;

  $conf = require(THE_NAME_OF_THE_CORE_DIR."/".THE_NAME_OF_THE_CONFIGURATION_FILE.".php");



# -----------------------------------------------------------------------------------



  if (version_compare(phpversion(),$conf["version"]["min_php"],"<")) : # Minimum PHP version is required

    echo "<h3>PHP version must be ".$conf["version"]["min_php"]." or higher. Bye.</h3>"; die();

  endif;



# -----------------------------------------------------------------------------------



  define("BEGRATEFUL", "

<!--
 @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
   @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
            @@@@@
           @@@@@@
          @@@@@@     @@@@@@
          @@@@@      @@@@@@                @@@@@@@@          @@@@@@@@          @@@@@@@@@
         @@@@@       @@@@@@@@@           @@@@@@@@@@@@      @@@@@@@@@@@@      @@@@@@@@@@@@@
        @@@@@@       @@@@@@@@@@@@      @@@@@@    @@@@@    @@@@@@  @@@@@     @@@@@    @@@@@@
        @@@@@       @@@@@  @@@@@@@     @@@@@     @@@@@   @@@@@@   @@@@@    @@@@@@    @@@@@@
       @@@@@        @@@@    @@@@@     @@@@@@@  @@@@@@@  @@@@@@    @@@@    @@@@@@@  @@@@@@@
      @@@@@@       @@@@@   @@@@@@    @@@@@@@@@@@@@@@    @@@@@             @@@@@@@@@@@@@@@   @@@@@
     @@@@@@       @@@@@    @@@@@    @@@@@@  @@@@@      @@@@@@            @@@@@  @@@@@@     @@@@@
     @@@@@       @@@@@    @@@@@    @@@@@@@           @@@@@@@@          @@@@@@@            @@@@@
     @@@@@     @@@@@@     @@@@@   @@@@@@@@@        @@@@@@@@@@@       @@@@@@@@@@        @@@@@@@
      @@@@@@@@@@@@@       @@@@@@@@@@@ @@@@@@@@@@@@@@@@@  @@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@
        @@@@@@@@            @@@@@@@      @@@@@@@@@@         @@@@@@@@@        @@@@@@@@@@@


# TRECE: A multilingual boilerplate framework for the brave.
# BECAUSE WHAT COULD GO WRONG?
# Version ".$conf["trece"]["version"]." '".$conf["trece"]["motto"]."'
# Created by Iñaki Quenerapú (@quenerapu)
# GPL-3.0 https://choosealicense.com/licenses/gpl-3.0/


  BE GRATEFUL. Make someone happy by tweeting at least one of these lines
  =======================================================================
  Thank you Adam Shaw for inventing FullCalendar. https://fullcalendar.io/
  Thank you Alexandru Mărășteanu for porting sprintf to Javascript. https://github.com/alexei/sprintf.js/
  Thank you Alexis Deveria (@fyrd) for inventing Can I use. https://caniuse.com/
  Thank you Blake Ross (@blakeross) for inventing Firefox. https://www.firefox.com/
  Thank you Brendan Eich (@BrendanEich) for inventing JavaScript. https://www.javascript.com/
  Thank you Brent Matzelle (@bmatzelle) for inventing PHPMailer. https://github.com/PHPMailer/PHPMailer/
  Thank you Brian Reavis (@brianreavis) for inventing Selectize http://selectize.github.io/selectize.js/
  Thank you Boniface Pereira (@craftpip) for inventing jQuery Confirm. https://craftpip.github.io/jquery-confirm/
  Thank you Daniel Eden (@_dte) for inventing Animate.css. https://daneden.github.io/animate.css/
  Thank you Daniel Ha (@danielha) and Jason Yan (@jasonyan) for inventing Disqus. https://disqus.com/
  Thank you Dave Gandy (@davegandy) for inventing FontAwesome. https://fontawesome.com/
  Thank you Douglas Crockford for inventing JSON. https://www.json.org/
  Thank you Dries Buytaert (@Dries) for inventing Drupal. https://www.drupal.org/
  Thank you Eduardo D. (@eduardo_dx) for creating the Sermepa\Tpv class. https://github.com/ssheduardo/sermepa/
  Thank you Emanuil Rusev (@erusev) for inventing Parsedown. http://parsedown.org/
  Thank you Eric Meyer (@meyerweb) for inventing Eric Meyer’s CSS Reset https://meyerweb.com/eric/tools/css/reset/
  Thank you Fabien Potencier (@fabpot) for inventing Symfony. https://www.symfony.com/
  Thank you Håkon Wium Lie (@wiumlie) for inventing CSS. https://www.w3.org/Style/CSS/
  Thank you Jakub Vrána (@jakubvrana) for inventing Adminer. https://www.adminer.org/
  Thank you Javi Aguilar (@itsjaviaguilar) for inventing Bootstrap Colorpicker. https://farbelous.io/bootstrap-colorpicker/
  Thank you Jeff Atwood (@codinghorror) and Joel Spolsky (@spolsky) for inventing Stack Overflow. https://stackoverflow.com/
  Thank you Johan Sörlin (@spocke) for inventing TinyMCE. https://www.tinymce.com/
  Thank you John Gruber (@gruber) for inventing Markdown. https://daringfireball.net/projects/markdown/
  Thank you John Resig (@jeresig) for inventing jQuery. https://jquery.com/
  Thank you Linus Torvalds (@Linus__Torvalds) for inventing Linux. https://github.com/torvalds/linux/
  Thank you Mark Otto (@mdo) and Jacob Thornton (@fat) for inventing Bootstrap. https://getbootstrap.com/
  Thank you Matt Mullenweg (@photomatt) for inventing WordPress. https://wordpress.org/
  Thank you Maciej Gurban (@maciej_gurban) for inventing Responsive Bootstrap Toolkit. https://github.com/maciej-gurban/responsive-bootstrap-toolkit/
  Thank you Min Hur (@minhur) for inventing Bootstrap Toggle. http://bootstraptoggle.com/
  Thank you Nicolas Gallagher (@necolas) for inventing Normalize.css. https://necolas.github.io/normalize.css/
  Thank you Rasmus Lerdorf (@rasmus) for inventing PHP. http://php.net/
  Thank you Richard Stallman for founding the Free Software Foundation. https://www.fsf.org/
  Thank you Ryan Kirkman (@ryan_kirkman) and Ajax Davis (@ajaxdavis) for inventing cdnjs. https://cdnjs.com/
  Thank you Sebastian Tschan for inventing jQuery File Upload. https://github.com/blueimp/jQuery-File-Upload/
  Thank you Silvio Moreto (@silviomoreto) for inventing Bootstrap-Select. https://silviomoreto.github.io/bootstrap-select/
  Thank you Stephen Cole Kleene for inventing regular expressions. https://regex101.com/
  Thank you Ted Nelson (@TheTedNelson) for inventing the hypertext. http://www.hyperland.com/
  Thank you Thomas Boutell (@boutell) for inventing the GD Graphics Library. https://libgd.github.io/
  Thank you Tim Berners-Lee (@timberners_lee) for inventing the Web and HTML. https://www.w3.org/html/
  Thank you Tim Kosse (@TimKosse) for inventing FileZilla. https://filezilla-project.org/
  Thank you Tom Preston-Werner (@mojombo) for inventing GitHub. https://github.com/
  Thank you Vinton Cerf (@vgcerf) for inventing the Internet. https://es.wikipedia.org/wiki/Vinton_Cerf/
  Thank you Vitaliy Potapov (@vitpotapov) for inventing X-editable. https://vitalets.github.io/x-editable/
  Thank you Ward Cunningham (@WardCunningham) for inventing the wiki. http://wiki.c2.com/

-->

");



# -----------------------------------------------------------------------------------



  if(MARKDOWN) :

    $markdownFilesArray = explode("|",$conf["markdown"]["files"]);

    foreach ($markdownFilesArray as $lib) :

      if(!file_exists($conf["dir"]["libraries"].$conf["markdown"]["lib"]."/".$lib)) : # Markdown libraries are required

        echo "<h3>MARKDOWN is set to true but Parsedown library was not found. Bye.</h3><p>Install the Parsedown library OR turn the constant <code>MARKDOWN</code> to <code>\"false\"</code> in <code>index.php</code> line 8.</p>"; die();

      endif;

      require_once($conf["dir"]["libraries"].$conf["markdown"]["lib"]."/".$lib);

    endforeach;

  endif;



# -----------------------------------------------------------------------------------



  $conf["site"]["langs"] = explode("|",$conf["site"]["langs"]);

  foreach($conf["site"]["langs"] as $key=>$lang) :

    $langArray = explode(" ",$lang);
    unset($conf["site"]["langs"][$key]);
    $halfCultureName = explode("-",$langArray[1]);
    $cultureName2 = str_replace("-","_",$langArray[1]);
    $conf["site"]["langs"][$langArray[0]] = [
      "ref-name"          => $langArray[0],       # example: gal
      "url-name"          => $langArray[0]."/",   # example: gal/
      "culture-name1"     => $langArray[1],       # example: gl-ES
      "culture-name2"     => $cultureName2,       # example: gl_ES
      "half-culture-name" => $halfCultureName[0], # example: gl
      "direction"         => (isset($langArray[2])?$langArray[2]:"ltr"),
      ];

  endforeach;

  unset($key,$lang,$langArray,$cultureName2,$halfCultureName);

  $conf["site"]["main_lang"] = array_keys($conf["site"]["langs"])[0];
  $conf["site"]["all_langs"] = implode("|",array_keys($conf["site"]["langs"]));

  if(count($conf["site"]["langs"])>1) : define("MULTILANG",true); endif;



# -----------------------------------------------------------------------------------



  $conf["site"]["dir"] =                dirname(__FILE__);
  $conf["site"]["scheme"] =             isset($_SERVER["HTTPS"])&&filter_var($_SERVER["HTTPS"],FILTER_VALIDATE_BOOLEAN)?"https:":"http:";
  $conf["site"]["uri"] =                "{$conf["site"]["scheme"]}//{$_SERVER["HTTP_HOST"]}".$_SERVER["REQUEST_URI"];
  $conf["site"]["query"] =              isset($_SERVER["QUERY_STRING"])?$_SERVER["QUERY_STRING"]:""; parse_str($conf["site"]["query"],$conf["site"]["queryArray"]);
  $conf["site"]["queryq"] =             $conf["site"]["query"]!=""?"?".$conf["site"]["query"]:null;
  $conf["site"]["realpath"] =           "{$conf["site"]["scheme"]}//{$_SERVER["HTTP_HOST"]}/".ltrim(str_replace_plus("lo",basename($_SERVER["PHP_SELF"]),"",$_SERVER["SCRIPT_NAME"]),"/");
  unset($conf["site"]["scheme"]);
  $conf["site"]["virtualpath"] =        strcasecmp($conf["site"]["realpath"],str_replace_plus("lo",$conf["site"]["queryq"],"",$conf["site"]["uri"]))!=0?
                                        substr(
                                          str_replace_plus("lo",$conf["site"]["queryq"],"",$conf["site"]["uri"]),
                                          strcasecmp($conf["site"]["realpath"],
                                            str_replace_plus("lo",$conf["site"]["queryq"],"",$conf["site"]["uri"])
                                          )
                                        ):"";
  $conf["site"]["fullpath"] =           $conf["site"]["realpath"].$conf["site"]["virtualpath"];
  $conf["site"]["virtualpathArray"] =   array_values(array_filter(explode("/",$conf["site"]["virtualpath"])));
                                        if(!defined("MULTILANG")):array_unshift($conf["site"]["virtualpathArray"],$conf["site"]["main_lang"]);endif;
  $conf["site"]["lang"] =               array_shift($conf["site"]["virtualpathArray"]);
  $conf["site"]["lang"] =               in_array($conf["site"]["lang"],array_column($conf["site"]["langs"],"ref-name"))?$conf["site"]["lang"]:null;
  $conf["site"]["virtualpathNoLang"] =  implode("/",$conf["site"]["virtualpathArray"]);
  $conf["site"]["realpathLang"] =       $conf["site"]["realpath"].(
                                          !is_null($conf["site"]["lang"])?
                                          (defined("MULTILANG")&&(in_array($conf["site"]["lang"],array_column($conf["site"]["langs"],"ref-name")))?
                                            $conf["site"]["langs"][$conf["site"]["lang"]]["url-name"]:""
                                          )
                                          :"");



# -----------------------------------------------------------------------------------



  define("REALPATH",      $conf["site"]["realpath"]);       # example: REALPATH."/css"
  define("REALPATHLANG",  $conf["site"]["realpathLang"]);   # example: REALPATHLANG."/es/user"
  define("LANG",          $conf["site"]["lang"]);           # example: es
  define("QUERYQ",        $conf["site"]["queryq"]);         # example: First with ?, next with &



# -----------------------------------------------------------------------------------



  if(!file_exists($conf["dir"]["core"].$conf["file"]["functions"].".php")) : # functions file is required

    echo "<h3>Defined functions file not found. Bye.</h3>"; die();

  endif;

  require_once($conf["dir"]["core"].$conf["file"]["functions"].".php");



# -----------------------------------------------------------------------------------



  if(!file_exists($conf["dir"]["core"].$conf["file"]["db"].".php")) : # db file is required

    echo "<h3>Defined database file not found. Bye.</h3>"; die();

  endif;

  require_once($conf["dir"]["core"].$conf["file"]["db"].".php");



# -----------------------------------------------------------------------------------



  if(!file_exists($conf["dir"]["core"].$conf["file"]["login"].".php")) : # login file is required

    echo "<h3>Defined login file not found. Bye.</h3>"; die();

  endif;

  require_once($conf["dir"]["core"].$conf["file"]["login"].".php");
  $app = new SignIn($db,$conf["table"]["users"],$conf["table"]["hierarchy"],$conf["table"]["log"]);



# -----------------------------------------------------------------------------------



  if(!file_exists($conf["dir"]["core"].$conf["file"]["i18n"].".php")) : # i18n file is required

    echo "<h3>Defined I18N file not found. Bye.</h3>"; die();

  endif;

  $lCommon = require($conf["dir"]["core"].$conf["file"]["i18n"].".php");

  if(!findKey($lCommon,$conf["site"]["main_lang"])) : # main language is not present @ i18n file

    echo "<h3>Defined main language could not be found at I18N file. Bye.</h3>"; die();

  endif;



# -----------------------------------------------------------------------------------



  if(MARKDOWN) :

    $markdownFilesArray = explode("|",$conf["markdown"]["files"]);

    foreach ($markdownFilesArray as $lib) :

      if(!file_exists($conf["dir"]["libraries"].$conf["markdown"]["lib"]."/".$lib)) : # Markdown libraries are required

        echo "<h3>Defined Markdown library not found. Bye.</h3>"; die();

      endif;

      require_once($conf["dir"]["libraries"].$conf["markdown"]["lib"]."/".$lib);

    endforeach;

    unset($markdownFilesArray,$lib);

  endif;

  unset($conf["markdown"]);



# -----------------------------------------------------------------------------------



  if (
      defined("MULTILANG") && (
      is_null(LANG) ||
      !in_array(LANG,array_keys($conf["site"]["langs"]))
      )
     ) : # Stop the presses! It's a MULTILANG site but no language found @ the URL. Reload using $conf["site"]["main_lang"] instead.

      header("location:".
        REALPATH.
        $conf["site"]["main_lang"].
        ($conf["file"]["homepage_redirect"]!="" ? "/".$conf["file"]["homepage_redirect"]:"").
//      "/".
        QUERYQ
        );
      die();

  endif;

  if (
      $conf["file"]["homepage_redirect"] != ""
      && (!isset($conf["site"]["virtualpathArray"][0]))
     ) : # Stop the presses! $conf["file"]["homepage_redirect"] is set, but naked address found @ the URL. Redirecting to $conf["file"]["homepage_redirect"]

      header("location:".
        $conf["site"]["realpath"].
        (defined("MULTILANG")?LANG:"").
        $conf["file"]["homepage_redirect"].
//      "/".
        QUERYQ
        );
      die();

  endif;



# -----------------------------------------------------------------------------------



  header("Content-Type: text/html; charset=".$conf["site"]["charset"]);
  setlocale(LC_ALL,$conf["site"]["langs"][LANG]["culture-name2"]);



# -----------------------------------------------------------------------------------



  $page = false;
  $noComments = false;

  if(!isset($conf["site"]["action"])) :

    $conf["site"]["action"] = !empty($conf["site"]["virtualpathArray"]) ?
                              $conf["site"]["virtualpathArray"][0] :
                              $conf["file"]["homepage"];
                              false;

  endif;

  if($conf["site"]["action"]) :

    if(!$page && file_exists($conf["dir"]["includes"].$conf["site"]["action"]."/".$conf["file"]["index"].".php")) :

      $page = $conf["dir"]["includes"].$conf["site"]["action"]."/".$conf["file"]["index"].".php";

    endif;

    if(!$page && file_exists($conf["dir"]["includes"].implode("/",$conf["site"]["virtualpathArray"]).".php")) :

      $page = $conf["dir"]["includes"].implode("/",$conf["site"]["virtualpathArray"]).".php";

    endif;

    if(!$page && file_exists($conf["dir"]["includes"].implode("-",$conf["site"]["virtualpathArray"]).".php")) :

      $page = $conf["dir"]["includes"].implode("-",$conf["site"]["virtualpathArray"]).".php";

    endif;

    if(!$page && (!isset($conf["site"]["virtualpathArray"][0]) || $conf["site"]["virtualpathArray"][0] == "") && file_exists($conf["dir"]["includes"].$conf["file"]["homepage"].".php")) :

      define("ISHOMEPAGE", true);
      $page = $conf["dir"]["includes"].$conf["file"]["homepage"].".php";
      $noComments = true;

    endif;

    if(!$page && file_exists($conf["dir"]["includes"].$conf["file"]["the404"].".php")) :

      $page = $conf["dir"]["includes"].$conf["file"]["the404"].".php";
      $noComments = true;

    endif;

  endif;



  if(file_exists($page)):

    $syntax = array_slice(file($page),0,1);
    $syntax = explode("<?php /* ",$syntax[0]);
    $syntax = isset($syntax[1])?trim($syntax[1]):"php";

    if(in_array($syntax,array("html","md"))) :

      $lines = array_slice(file($page,FILE_IGNORE_NEW_LINES),1,6);

      foreach($lines as $line) :
        $line = explode(":",$line,2);
        $line[0] = trim($line[0]," [] ");
        $line[1] = trim($line[1]); $line[1] = trim($line[1],"()"); $line[1] = ltrim($line[1],"# "); $line[1] = trim($line[1],'"');
        if(in_array($line[0],["title","datetime","description","keywords","image_file","image_description"])) :
          $conf["meta"]["temp"][$line[0]] = $line[1];
        endif;
      endforeach;

      if($conf["meta"]["temp"]) :

        $langs = explode("|",$conf["site"]["all_langs"]);

        $titles = explode("|",$conf["meta"]["temp"]["title"]);
        $descriptions = explode("|",$conf["meta"]["temp"]["description"]);
        $image_descriptions = explode("|",$conf["meta"]["temp"]["image_description"]);

        foreach ($titles as $title) :

          $lang = preg_match('#\[(.*?)\]#',$title,$lang) ? $lang[1] : LANG;
          $conf["meta"]["title"][$lang] = str_replace_plus("fo","[".$lang."]","",$title);

        endforeach;

        foreach ($descriptions as $description) :

          $lang = preg_match('#\[(.*?)\]#',$description,$lang) ? $lang[1] : LANG;
          $conf["meta"]["description"][$lang] = str_replace_plus("fo","[".$lang."]","",$description);

        endforeach;

        foreach ($image_descriptions as $image_description) :

          $lang = preg_match('#\[(.*?)\]#',$image_description,$lang) ? $lang[1] : LANG;
          $conf["meta"]["image"]["description"][$lang] = str_replace_plus("fo","[".$lang."]","",$image_description);

        endforeach;

        if(isset($conf["meta"]["temp"]["image_file"])) : $conf["meta"]["image"]["file"]  = $conf["meta"]["temp"]["image_file"];  unset($conf["meta"]["image_file"]); endif;
        if(isset($conf["meta"]["temp"]["datetime"]))   :
                                                         $conf["meta"]["datetime"] = $conf["meta"]["temp"]["datetime"];
                                                         define("DATE",date('Y-m-d', strtotime(str_replace('-', '/', $conf["meta"]["datetime"]))));
        endif;

        unset($conf["meta"]["temp"]);

      endif;

      if(file_exists($conf["dir"]["includes"].$conf["file"]["header"].".php")): require_once($conf["dir"]["includes"].$conf["file"]["header"].".php"); else : echo "<!DOCTYPE html>\n<body>\n<pre>\nheader\n----\n</pre>\n"; endif;

      if($syntax == "md") :

        $page = file($page,FILE_IGNORE_NEW_LINES);
        array_shift($page);
        $page = implode("\n",$page);

        if(defined("MULTILANG")) :

          if(strpos($page,"[--".LANG."--]")) :

            $page = strstr($page,"[--".LANG."--]");
            $page = strstr($page,"[--/".LANG."--]",true);
            $page = str_replace_plus("fo","[--".LANG."--]","",$page);

          endif;

        endif;

        $page = str_replace("[[DATE]]",DATE,$page);

        $Parsedown = new ParsedownExtraPlugin();
        $Parsedown->code_block_attr_on_parent = true;
        $Parsedown->code_text = '<span class="my-code">%s</span>';
        $Parsedown->table_class = "table table-bordered table-condensed short";
        echo $Parsedown->text($page);

      else :

        require_once($page);

      endif;

      if(file_exists($conf["dir"]["includes"].$conf["file"]["footer"].".php")): require_once($conf["dir"]["includes"].$conf["file"]["footer"].".php"); else : echo "\n<pre>\n----\nfooter\n</pre>".BEGRATEFUL."\n</body>\n</html>"; endif;

    else :

      require_once($page);

    endif;

  else :

    echo "<pre>404\n</pre>";

  endif;



# -----------------------------------------------------------------------------------



function str_replace_plus($fl,$search,$replace,$subject) { # Replaces FIRST or LAST occurence of a string in a string
  $pos=($fl=="lo"?strrpos($subject,$search):strpos($subject,$search)); # fo = strpos = first occurrence | lo = strrpos = last occurrence
  if($pos!==false) :
    $subject=substr_replace($subject,$replace,$pos,strlen($search));
  endif;
  return $subject;
  }



# -----------------------------------------------------------------------------------



function findKey($array,$keySearch) { # Checks if key exists in multiarray
  foreach ($array as $key=>$item) :
    if($key==$keySearch) :
      return true;
    else :
      if(is_array($item) && findKey($item,$keySearch)) :
        return true;
      endif;
    endif;
  endforeach;
  return false;
  }



# -----------------------------------------------------------------------------------



function getUrlFriendlyString($str) { # Generates a SEO friendly URL (ok, the artisan way)
  // Revisar -> http://stackoverflow.com/questions/3371697/replacing-accented-characters-php
  $unwanted_array = [
    "Á"=>"A", "À"=>"A", "Â"=>"A", "Ä"=>"A", "Ã"=>"A", "Å"=>"A", "Ă"=>"A", "Æ"=>"AE",
    "á"=>"a", "à"=>"a", "â"=>"a", "ä"=>"a", "ã"=>"a", "å"=>"a", "ă"=>"a", "æ"=>"ae",
    "É"=>"E", "È"=>"E", "Ê"=>"E", "Ë"=>"E",
    "é"=>"e", "è"=>"e", "ê"=>"e", "ë"=>"e",
    "Í"=>"I", "Ì"=>"I", "Î"=>"I", "Ï"=>"I", "İ"=>"I",
    "í"=>"i", "ì"=>"i", "î"=>"i", "ï"=>"i", "ı"=>"i",
    "Ó"=>"O", "Ò"=>"O", "Ô"=>"O", "Ö"=>"O", "Õ"=>"O", "Ø"=>"O",
    "ó"=>"o", "ò"=>"o", "ô"=>"o", "ö"=>"o", "õ"=>"o", "ø"=>"o",
    "Ú"=>"U", "Ù"=>"U", "Û"=>"U", "Ü"=>"U",
    "ú"=>"u", "ù"=>"u", "û"=>"u", "ü"=>"u",
    "þ"=>"b", "Þ"=>"B", "ß"=>"ss",
    "ð"=>"o",
    "Ğ"=>"G",
    "ğ"=>"g",
    "Ñ"=>"N", "Ç"=>"C",
    "ñ"=>"n", "ç"=>"c",
    "Š"=>"S", "Ş"=>"S", "Ș"=>"S",
    "š"=>"s", "ş"=>"s", "ș"=>"s",
    "Ț"=>"T",
    "ț"=>"t",
    "Ý"=>"Y",
    "ý"=>"y", "ÿ"=>"y",
    "Ž"=>"Z", "ž"=>"z",
    "/"=>"-",
    ];

    $str = trim($str);
    $str = strtr($str,$unwanted_array);
    $_str = preg_replace("/-+/", "-", preg_replace("/[^a-z0-9-|]/", "", strtolower(str_replace(" ", "-", $str))));
    return $_str;

  }



?>
