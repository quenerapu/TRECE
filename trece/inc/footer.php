<?php if(!defined("TRECE")):header("location:/");die();endif; ?>

  <footer>

    <div class="container" style="margin-top:2em;">

      <div class="row">
        <div class="col-xs-12 col-sm-6 col-sm-offset-1">
          <p><small>
            <strong><?=$conf["meta"]["name"][LANG];?></strong>
          </small></p>
<?php /*
          <p style="line-height:.9em;"><small>
            <i class="fa fa-map-marker fa-fw" aria-hidden="true"></i> <?=$conf["contact"]["address_line1"];?><br>
            <span style="color:transparent;"><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i></span> <?=$conf["contact"]["address_line2"];?><br>
            <span style="color:transparent;"><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i></span> <?=$conf["contact"]["address_line3"][LANG];?><br>
            <i class="fa fa-phone fa-fw" aria-hidden="true"></i> <?=$conf["contact"]["phone_no"];?><br>
            <i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i> <a href="mailto:<?=$conf["contact"]["email"];?>"><?=strrev($conf["contact"]["email"]);?></a>
          </small></p>
*/ ?>
          <p><small>
            <a href="<?=REALPATHLANG."cookies";?>"><?=$lCommon["gdpr"]["cookie_policy"][LANG];?></a> |
            <a href="<?=REALPATHLANG."privacy";?>"><?=$lCommon["gdpr"]["privacy_policy"][LANG];?></a>
            </small></p>
        </div>
        <div class="col-xs-12 col-sm-4">
          <p class="text-right">
            <small>
            <strong>Whatever</strong>
            </small>
          </p>
          <p class="text-right">
            <small>
            Whatever whatever
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
