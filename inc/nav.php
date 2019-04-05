<?php if(!defined("TRECE")):header("location:/");die();endif; ?>

      <div style="top:0;position:fixed;background-color:#000;height:25px;width:100%;z-index:9999;padding-top:3px;">
        <div class="container">
          <div class="row">
            <div class="col-xs-12 col-sm-10 col-sm-offset-1">
              <p class="pull-left" style="color:white;">
                <small style="margin-right:1em;">Whatever</small>
              </p>
              <p class="pull-right" style="color:white;">
                <small style="margin-right:1em;">Whatever whatever whatever</small>
                <small style="margin-right:1em;">
              <?php $i=1; foreach($conf["site"]["langs"] as $language) : ?>
                <a href="<?=REALPATH.$language["url-name"];?>" style="color:white;"><?=strtoupper($language["ref-name"]);?></a><?=$i<count($conf["site"]["langs"])?" |":"";?><?php $i++;?>
              <?php endforeach; ?>
                </small>&nbsp;&nbsp;
                <a href="mailto:whatever@whatever.wa" style="color:white;"><i class="fa fa-envelope" aria-hidden="true"></i></a>
                <a href="https://twitter.com/whatever" style="color:white;"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                <a href="https://facebook.com/whatever" style="color:white;"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                <a href="https://instagram.com/whatever" style="color:white;"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="https://youtube.com/whatever" style="color:white;"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
              </p>
            </div>
          </div>
        </div>
      </div>

      <nav class="navbar navbar-default navbar-fixed-top" style="top:25px;">
        <div class="container">
          <div class="row">
            <div class="col-xs-12 col-sm-10 col-sm-offset-1">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" style="margin-right:0;">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <div class="navbar-header pull-left">
                <a class="navbar-brand" href="<?=REALPATHLANG.QUERYQ;?>">
                  <img src="<?=
                    file_exists($conf["dir"]["images"]."logo.svg") ?
                    $conf["dir"]["images"]."logo.svg" :
                    (file_exists($conf["dir"]["images"]."logo.png") ?
                    $conf["dir"]["images"]."logo.png" :
                    "data:image/svg+xml;base64,".str_replace("[COLOR]",$conf["logo"]["white"],$conf["logo"]["img"]))
                    ;?>" alt="<?=$conf["meta"]["title"][LANG];?>" class="img-responsive">
                </a>
              </div>
              <p class="navbar-text pull-left" style="color:white;">
                <small style="margin-right:1em;">Whatever</small>
              </p>
              </small></p>
              <div class="hidden-sm hidden-md hidden-lg clearfix"></div>
              <div id="navbar" class="navbar-collapse collapse navbar-right">
                <ul class="nav navbar-nav">
                  <li><a href="https://github.com/quenerapu/TRECE" target="_blank">TRECE on GitHub</a></li>
                  <li><?=nav("Demo","demo");?></li>
                </ul>
<?php if ($app->getUserSignInStatus()) : ?>
<?php if ($app->getUserHierarchy() == 1) : ?>
                <ul class="nav navbar-nav">
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=$lCommon["admin"][LANG];?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><?=nav($lCommon["genders"][LANG],"genders");?></li>
                      <li><?=nav($lCommon["privileges"][LANG],"uprivileges");?></li>
                      <li><?=nav($lCommon["hierarchy"][LANG],"uhierarchy");?></li>
                      <li><?=nav($lCommon["users"][LANG],"users");?></li>
                    </ul>
                  </li>
                </ul>
                <ul class="nav navbar-nav">
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=$app->getUserName();?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><?=nav($lCommon[$conf["file"]["me"]][LANG],$lCommon[$conf["file"]["me"]]["en"]);?></li>
                      <li role="separator" class="divider"></li>
                      <li><a href="<?=$conf["site"]["realpathLang"]."?signout";?>"><?=$lCommon["signout"][LANG];?></a></li>
                    </ul>
                  </li>
                </ul>
<?php endif; ?>
<?php else : ?>
                <ul class="nav navbar-nav">
                  <li><a href="<?=REALPATHLANG.$conf["file"]["signin"];?>"><?=$lCommon["signin"][LANG];?></a></li>
                </ul>
<?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </nav>
