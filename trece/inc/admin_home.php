<?php if(!defined("TRECE")):header("location:/");die();endif; ?>
<?php
//ADMIN HOME

# .........................................................................................
# .....###....########..##.....##.####.##....##....##.....##..#######..##.....##.########..
# ....##.##...##.....##.###...###..##..###...##....##.....##.##.....##.###...###.##........
# ...##...##..##.....##.####.####..##..####..##....##.....##.##.....##.####.####.##........
# ..##.....##.##.....##.##.###.##..##..##.##.##....#########.##.....##.##.###.##.######....
# ..#########.##.....##.##.....##..##..##..####....##.....##.##.....##.##.....##.##........
# ..##.....##.##.....##.##.....##..##..##...###....##.....##.##.....##.##.....##.##........
# ..##.....##.########..##.....##.####.##....##....##.....##..#######..##.....##.########..
# .........................................................................................

// http://patorjk.com/software/taag/#p=display&f=Banner4&t=%20TRECE%20
// http://patorjk.com/software/taag/#p=display&f=Bright&t=Deprecated
// https://stackoverflow.com/questions/8154158/mysql-how-do-i-use-delimiters-in-triggers







//Not logged? Not admin? Get out of here!

  if (
      !$app->getUserSignInStatus() # Must be logged in
//    || $app->getUserHierarchy() != 1 # Must be admin
     ) :

    header("location:".REALPATHLANG.QUERYQ);
    die();

  endif;



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



  $lCustom["pagetitle"]["es"] = "Panel de administración";
  $lCustom["pagetitle"]["gal"] = "Panel de administración";
  $lCustom["pagetitle"]["en"] = "Admin panel";

  $conf["meta"]["description"][LANG] = "Admin";
  require_once($conf["dir"]["includes"]."header.php");
  require_once($conf["dir"]["includes"]."nav.php");

?>



  <div class="container main-container">

    <div class="row">
      <div class="col-xs-12 col-sm-10 col-sm-offset-1">
        <div class="page-header">
          <h1><strong><?=$lCustom["pagetitle"][LANG];?></strong></h1>
        </div>
      </div>
    </div><!-- row -->

  </div>



<?php require_once($conf["dir"]["includes"]."footer.php"); ?>
