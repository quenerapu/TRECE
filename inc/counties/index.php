<?php if(!defined("TRECE")):header("location:/");die();endif; ?>
<?php
//COUNTIES

# .........................................................................
# ...######...#######..##.....##.##....##.########.####.########..######...
# ..##....##.##.....##.##.....##.###...##....##.....##..##.......##....##..
# ..##.......##.....##.##.....##.####..##....##.....##..##.......##........
# ..##.......##.....##.##.....##.##.##.##....##.....##..######....######...
# ..##.......##.....##.##.....##.##..####....##.....##..##.............##..
# ..##....##.##.....##.##.....##.##...###....##.....##..##.......##....##..
# ...######...#######...#######..##....##....##....####.########..######...
# .........................................................................

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
        in_array($crudlpx,array($conf["file"]["adminlist"],$conf["file"]["publiclist"])) &&
        (!isset($what) || (isset($what) && (is_numeric($what) && strlen(intval($what))>0)))
      )

    ) :

//    Case 1? Go on!

        require($crudlpx.".php");
        die();

  endif;



//No $crudlpx at all?
//Well, show them the list, page 1

header("location:".REALPATHLANG.$conf["site"]["virtualpathArray"][0]."/".$conf["file"]["adminlist"].QUERYQ);
die();

?>
