<?php if(!defined("TRECE")):header("location:/");die();endif; ?>
  <footer>

    <div class="container">

      <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1">
          <div style="padding:0;">
            <p style="line-height:.8em;"><small>
              <strong><?=$conf["meta"]["title"][LANG];?></strong>
            </small></p>
            <p style="line-height:.9em;"><small>
              <i class="fa fa-map-marker fa-fw" aria-hidden="true"></i> <?=$conf["contact"]["address_line1"];?><br>
              <span style="color:transparent;"><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i></span> <?=$conf["contact"]["address_line2"];?><br>
              <span style="color:transparent;"><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i></span> <?=$conf["contact"]["address_line3"][LANG];?><br>
              <i class="fa fa-phone fa-fw" aria-hidden="true"></i> <?=$conf["contact"]["phone_no"];?><br>
              <i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i> <a href="mailto:<?=$conf["contact"]["email"];?>"><?=strrev($conf["contact"]["email"]);?></a>
            </small></p>
          </div>
          <div class="clearfix"></div>
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
        <a href="https://trece.io" target="_blank" style="text-decoration:none;"><img src="data:image/svg+xml;base64,<?=str_replace("[COLOR]",$conf["logo"]["garnet"],$conf["logo"]["img"]);?>" style="display:inline-block;height:1em;margin:.4em 0 .1em .1em;padding-bottom:.15em;" alt="TRECE"></a>
      </div>

    </div>

  </footer>


  <!-- Custom JS -->
  <script src="<?=$conf["dir"]["scripts"];?>core.js?v=<?=time();?>"></script>



  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <script src="https://maxcdn.bootstrapcdn.com/js/ie10-viewport-bug-workaround.js"></script>



<?=BEGRATEFUL;?>
</body>
</html>
