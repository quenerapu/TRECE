<?php if(!defined("TRECE")):header("location:/");die();endif; ?>

  <footer>

    <div class="container" style="margin-top:2em;">

      <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1">
          <p>
            <img src="data:image/svg+xml;base64,<?=str_replace("[COLOR]",$conf["trece"]["logo"]["garnet"],$conf["trece"]["logo"]["img"]);?>" style="height:2em;" alt="TRECE">
          </p>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-8 col-sm-6 col-sm-offset-1">
          <p style="line-height:1em;"><small><strong>TRECE <?=$conf["trece"]["version"];?>:</strong> <?=$conf["trece"]["motto"];?></small></p>
          <p style="letter-spacing:-.03em;"><small>
            <a href="<?=REALPATHLANG."";?>" target="_blank">Whatever</a> |
            <a href="<?=REALPATHLANG."";?>" target="_blank">Whatever</a> |
            <a href="<?=REALPATHLANG."";?>" target="_blank">Whatever</a> 
            </small></p>
        </div>
        <div class="col-xs-4 col-sm-4">
          <p class="text-right">
            <small>
            <strong>TRECE <?=$conf["trece"]["version"];?></strong>
            </small>
          </p>
          <p class="text-right" style="letter-spacing:-.03em;line-height:.9em;">
            <small>
            <a href="<?=REALPATHLANG."";?>">Whatever</a>
            <span class="hidden-xs"> | </span><span class="visible-xs-inline"><br></span>
            <a href="<?=REALPATHLANG."";?>">Whatever</a>
            <span class="hidden-xs"> | </span><span class="visible-xs-inline"><br></span>
            <a href="<?=REALPATHLANG."";?>">Whatever</a>
            </small>
          </p>
        </div>
      </div>

      <?php if(defined("DEBUG") && DEBUG) : ?>
      <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1">
          <?php require($conf["dir"]["includes"]."debug.php"); ?>
        </div>
      </div><!-- /.row -->
      <?php endif; ?>

      <div style="border-top:1px dotted #ccc;border-left:1px dotted #ccc;background:white;position:absolute;padding:0 .7em .2em .5em;right:0;bottom:0;text-align:right;">
        <a href="https://trece.io" target="_blank" style="text-decoration:none;"><img src="data:image/svg+xml;base64,<?=str_replace("[COLOR]",$conf["trece"]["logo"]["garnet"],$conf["trece"]["logo"]["img"]);?>" style="display:inline-block;height:1em;margin:.4em 0 .1em .1em;padding-bottom:.15em;" alt="TRECE"></a>
      </div>

    </div>

  </footer>


  <!-- Custom JS -->
  <script src="<?=$conf["dir"]["scripts"];?>core.php?v=<?=time();?>"></script>



  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <script src="https://maxcdn.bootstrapcdn.com/js/ie10-viewport-bug-workaround.js"></script>



<?=BEGRATEFUL;?>
</body>
</html>
