<?php if(!defined("TRECE")):header("location:./");die();endif; ?>
<?php

//OK. Let's talk.



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

    <div class="row">
      <div class="col-xs-12 col-sm-10 col-sm-offset-1">
        <div class="page-header">
          <h1><strong>Demo</strong></h1>
        </div>
      </div>
    </div><!-- row -->



    <div class="row">

      <div class="col-xs-12 col-sm-10 col-sm-offset-1">

        <div class="page-header">

          <?php

            $title = [
              "en" => "Demo file",
              "es" => "Archivo demo",
              "gal" => "Arquivo demo",
              ];
            $instructions = [
              "en" => "Play with the file <code>inc/demo.php</code> and check this page to see how it works.",
              "es" => "Juega con el archivo <code>inc/demo.php</code> y comprueba esta página para ver cómo funciona.",
              "gal" => "Xoga co arquivo <code>inc/demo.php</code> e comproba esta páxina para mirar como funciona.",
              ];
            $message = [
              "en" => "Another text only in English",
              "es" => "Otro texto únicamente en español",
              "gal" => "Outro texto só en galego",
              ];

          ?>

          <h1>» <?=$title[LANG];?></h1>
          <p class="lead"><?=$instructions[LANG];?></p>

          <h4>» Text for everyone</h4>
          <?php if($app->getUserSignInStatus()) : ?><h4>» Text for logged users only</h4><?php endif; ?>
          <?php if(!$app->getUserSignInStatus()) : ?><h4>» Text for not logged users only</h4><?php endif; ?>
          <?php if($app->getUserGender()=="f") : ?><h4>» Text for women only</h4><?php endif; ?>
          <?php if($app->getUserGender()=="m") : ?><h4>» Text for men only</h4><?php endif; ?>
          <?php if($app->getUserName() == "pepito") : ?><h4>» Text for users named «Pepito»</h4><?php endif; ?>
          <?php if($app->getUserUsername() == "pepito") : ?><h4>» Text for the user «pepito» (unique name)</h4><?php endif; ?>
          <?php if($app->getUserID() == 22) : ?><h4>» Text for the user with ID 22</h4><?php endif; ?>
          <?php if($app->getUserRef() == "bab06f2f") : ?><h4>» Text for the user with «bab06f2f» as ref</h4><?php endif; ?>
          <?php if($app->getUserHierarchy() == 1) : ?><h4>» Text only for adminers</h4><?php endif; ?>
          <?php if($app->getUserHierarchy() != 1) : ?><h4>» Text for everyone but adminers</h4><?php endif; ?>
          <?php if(in_array("2",explode(",",$app->getUserPrivileges()))) : ?><h4>» Only for users with privilege id = 2</h4><?php endif; ?>
          <?php if(LANG == "en") : ?><h4>» Text for English readers</h4><?php endif; ?>
          <?php if(LANG == "es") : ?><h4>» Texto para lectores/as en español</h4><?php endif; ?>
          <?php if(LANG == "gal") : ?><h4>» Texto para letores/as en galego</h4><?php endif; ?>

          <h4>» <?=$message[LANG];?></h4>

        </div>

      </div>

    </div>


<?php

  if(MARKDOWN) : # This part is markdown (if MARKDOWN was defined true)

  $Parsedown = new ParsedownExtraPlugin();
  $Parsedown->table_class = "table table-bordered table-condensed short";
  // Heredoc
  $text = <<<MARKDOWN

# Markdown sample

[comment]: # (Important: This part only works if MARKDOWN is set to true at index.php)

![alt text][logo]{.callout}

- List item 1
- List item 2
- List item 3
- [TRECE]

| Tables        | Are           | Cool  |
| ------------- |:-------------:| -----:|
| col 3 is      | right-aligned | $1600 |
| col 2 is      | centered      |   $12 |
| zebra stripes | are neat      |    $1 |

> Blockquotes are very handy in email to emulate reply text.
> This line is part of the same quote.

<a href="http://www.youtube.com/watch?feature=player_embedded&v=O1M_iqSBEpA" target="_blank"><img src="http://img.youtube.com/vi/O1M_iqSBEpA/0.jpg" alt="IMAGE ALT TEXT HERE" width="240" height="180" border="10" /></a>

[logo]: img/favicon/ms-icon-310x310.png "Logo Title Text 2"
[TRECE]: https://trece.io

MARKDOWN;

?>

    <style>
      .short{max-width:300px;}
    </style>

    <div class="row">
      <div class="col-xs-12 col-sm-10 col-sm-offset-1">
        <div class="page-header">
          <?=$Parsedown->text($text);?>
        </div>
      </div>
    </div><!-- row -->
<?php

  endif;

?>



</div>



<?php require_once($conf["dir"]["includes"]."footer.php"); ?>
