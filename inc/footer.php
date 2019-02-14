<?php if(!defined("TRECE")):header("location:/");die();endif; ?>
  <footer>

    <div class="container">
      <div style="border-top:1px dotted #ccc;border-left:1px dotted #ccc;background:white;position:absolute;padding:0 .7em .2em .5em;right:0;bottom:0;text-align:right;">
        <a href="http://trece.io" target="_blank" style="text-decoration:none;"><span style="font-size:1.1em;letter-spacing:-.01em;font-family:Arial,Helvetica,Garuda;color:#c40268;"><small>Crafted with <i class="fa fa-heart" aria-hidden="true"></i> and <img src="data:image/svg+xml;base64,<?=str_replace("[COLOR]",$conf["logo"]["garnet"],$conf["logo"]["img"]);?>" align="center" style="display:inline-block;height:1em;margin:.6em .1em .6em .1em;padding-bottom:.15em;" alt="TRECE"></small></span></a>
      </div>

      <div class="row">
        <div class="col-xs-12" style="padding-top:2em;">

          <div class="row">
            <div class="col-xs-12">
<?php /*
              <div style="float:left;">
                <img src="<?=
                file_exists($conf["dir"]["images"]."logo.svg") ?
                $conf["dir"]["images"]."logo.svg" :
                (file_exists($conf["dir"]["images"]."logo.png") ?
                $conf["dir"]["images"]."logo.png" :
                "data:image/svg+xml;base64,".str_replace("[COLOR]",$conf["logo"]["garnet"],$conf["logo"]["img"]))
                ;?>" alt="<?=$conf["meta"]["title"][LANG];?>" class="img-responsive" style="max-width:4em;">
              </div>
*/ ?>
              <div style="float:left;">
                <div style="padding:0 0 0 1em;">
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
              </div>
              <div class="clearfix"></div>
            </div>
          </div>

        </div>
      </div><!-- /.row -->
    <?php if(defined("DEBUG") && DEBUG) : ?>
      <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1">
          <?php require($conf["dir"]["includes"]."debug.php"); ?>
        </div>
      </div><!-- /.row -->
    <?php endif; ?>
    </div><!-- /.container -->

  </footer>



  <!-- Custom JS -->
  <script src="<?=$conf["dir"]["scripts"];?>core.js?v=<?=time();?>"></script>



  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <script src="https://maxcdn.bootstrapcdn.com/js/ie10-viewport-bug-workaround.js"></script>



<?=BEGRATEFUL;?>
</body>
</html>
