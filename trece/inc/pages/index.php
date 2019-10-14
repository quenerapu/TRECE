<?php if(!defined("TRECE")):header("location:/");die();endif; ?>
<?php
//PAGES

# ...................................................
# ..########.....###.....######...########..######...
# ..##.....##...##.##...##....##..##.......##....##..
# ..##.....##..##...##..##........##.......##........
# ..########..##.....##.##...####.######....######...
# ..##........#########.##....##..##.............##..
# ..##........##.....##.##....##..##.......##....##..
# ..##........##.....##..######...########..######...
# ...................................................

// http://patorjk.com/software/taag/#p=display&f=Banner4&t=%20TRECE%20
// http://patorjk.com/software/taag/#p=display&f=Bright&t=Deprecated
// https://stackoverflow.com/questions/8154158/mysql-how-do-i-use-delimiters-in-triggers













//OK. Let's talk.

  $cconf    = require($conf["file"]["conf"].".php");
  $lCustom  = require($conf["file"]["i18n"].".php");

  if(!isset($action))   :   $action   =  isset($conf["site"]["virtualpathArray"][0])?$conf["site"]["virtualpathArray"][0]:null; endif;
  if(!isset($crudlpx))  :   $crudlpx  =  isset($conf["site"]["virtualpathArray"][1])?$conf["site"]["virtualpathArray"][1]:null; endif;
  if(!isset($what))     :   $what     =  isset($conf["site"]["virtualpathArray"][2])?$conf["site"]["virtualpathArray"][2]:null; endif;



  if(

      isset($crudlpx) &&

      # Case 1: we want a list.
      # $crudlpx equals $conf["file"]["adminlist"] or $conf["file"]["publiclist"]
      # and $what contains a positive integer (number page) or even nothing
      (
        in_array($crudlpx,array(
          $conf["file"]["adminlist"],
//        $conf["file"]["publiclist"],
        )) &&
        (!isset($what) || (isset($what) && (is_numeric($what) && strlen(intval($what))>0)))
      )

      ||

      # Case 2: we want a record.
      # $crudlpx equals $conf["file"]["update"] or $conf["file"]["read"] or $conf["file"]["new"]
      # and $what contains an alphanumeric reference (mandatory)
      (
        in_array($crudlpx,array(
          $conf["file"]["update"],
          $conf["file"]["read"],
        )) &&
        (!isset($direct) && isset($what) && (is_string($what) && strlen($what)>0))
      )

    ) :

//    Case 1 or 2? Go on!

        require($crudlpx.".php");
        die();

  else :

      # Still here? Ok, keep calm :)
      # Well maybe $crudlpx or $what equals the alphanumeric reference of any record?

      require_once($conf["file"]["crud"].".php");

      $rowcount_page      = 0;
      $trece              = new $action($db,$conf,$cconf,$lCommon,$lCustom);
      $what               = !isset($direct) ? $crudlpx : $what; // POCO ELEGANTE
      $crudlpx            = $conf["file"]["read"];
//    $trece->ref         = $what;
      $trece->intimacy    = 2;

      $trece->last_id_breadcrumb_trail = false;
      $trece->in = "'".implode("','",$conf["site"]["virtualpathArray"])."'";
      $trece->find_in_set = implode(",",$conf["site"]["virtualpathArray"]);
      $trece->find_in_set_count = count($conf["site"]["virtualpathArray"]);

      if($trece->getBreadcrumbTrail()===true) :

        if($trece->last_id_breadcrumb_trail && ($trece->real_thread_trail == $conf["site"]["virtualpathNoLang"])) :
          $stmt = $trece->readOne();
          $rowcount_page = $trece->rowcount;
        endif;

        if($rowcount_page > 0) :
          require_once($crudlpx.".php");
          die();
        else:
        endif;

      endif;

      if(isset($direct) && $direct) :
        if(file_exists($conf["dir"]["includes"].$conf["file"]["the404"].".php")) :
          require_once($conf["dir"]["includes"].$conf["file"]["the404"].".php");
          die();
        endif;
        echo "<h1>404</h1>";
        die();
      endif;

  endif;



//No $crudlpx at all?
//Well, show them the list, page 1

header("location:".REALPATHLANG.$conf["site"]["virtualpathArray"][0]."/".$conf["file"]["adminlist"]."/1".QUERYQ);
die();

?>
