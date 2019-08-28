<?php if(!defined("TRECE")):header("location:/");die();endif; ?>
<?php
//404

# .................................
# ..##..........#####...##.........
# ..##....##...##...##..##....##...
# ..##....##..##.....##.##....##...
# ..##....##..##.....##.##....##...
# ..#########.##.....##.#########..
# ........##...##...##........##...
# ........##....#####.........##...
# .................................

// http://patorjk.com/software/taag/#p=display&f=Banner4&t=%20TRECE%20
// http://patorjk.com/software/taag/#p=display&f=Bright&t=Deprecated
// https://stackoverflow.com/questions/8154158/mysql-how-do-i-use-delimiters-in-triggers








//Still here? OK, let's talk.

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



//metastuff
  $lCustom["pagetitle"][LANG] = strip_tags($lCommon["error_404"][LANG]);
  $lCustom["metadescription"][LANG] = strip_tags("Custom metadescription goes here"); # 160 char text
  $lCustom["metakeywords"] = strip_tags("Custom keywords go here");
  $lCustom["og_image"] = "https://custom.url/image-goes-here"; # 1200x630 px image

  require_once($conf["dir"]["includes"]."header.php");
  require_once($conf["dir"]["includes"]."nav.php");

?>



  <div class="container main-container">

    <div class="row">
      <div class="col-xs-12 col-sm-10 col-sm-offset-1">
        <div class="page-header">
          <h1><strong><?=$lCommon["error_404"][LANG];?></strong></h1>
        </div>
      </div>
    </div><!-- row -->

  </div>



<?php require_once($conf["dir"]["includes"]."footer.php"); ?>
