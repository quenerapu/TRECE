<?php if(!defined("TRECE")):header("location:./");die();endif; ?>

      <div style="top:0;position:fixed;background-color:#000;height:25px;width:100%;z-index:1000;padding-top:1px;">
        <div class="container">
          <div class="row">
            <div class="col-xs-12 col-sm-10 col-sm-offset-1">
              <p class="pull-left" style="color:white;">
                <small style="margin-right:1em;">
                  <a href="<?=REALPATHLANG."";?>" style="color:white;">Whatever</a> | 
                  <a href="<?=REALPATHLANG."";?>" style="color:white;">Whatever</a>
                </small>
              </p>
              <p class="pull-right" style="color:white;">
                <small style="margin-right:1em;">
              <?php if(count($conf["site"]["langs"])>1) : $i=1; foreach($conf["site"]["langs"] as $language) : ?>
                <a href="<?=REALPATH.$language["url-name"];?>" style="color:white;"><?=strtoupper($language["ref-name"]);?></a><?=$i<count($conf["site"]["langs"])?" |":"";?><?php $i++;?>
              <?php endforeach; endif; ?>
                </small>
              <?php if(isset($conf["contact"]["phone_no"]) && strlen($conf["contact"]["phone_no"])>0) : ?>
                <a href="tel:<?=$conf["contact"]["phone_no"];?>" style="color:white;"><i class="fas fa-mobile-alt"></i></a>
              <?php endif; ?>
              <?php if(isset($conf["contact"]["email"]) && strlen($conf["contact"]["email"])>0) : ?>
                <a href="mailto:<?=$conf["contact"]["email"];?>" style="color:white;"><i class="fas fa-envelope"></i></a>
              <?php endif; ?>
              <?php if(isset($conf["contact"]["telegram"]) && strlen($conf["contact"]["telegram"])>0) : ?>
                <a href="https://t.me/<?=$conf["contact"]["telegram"];?>" target="_blank" style="color:white;"><i class="fab fa-telegram-plane"></i></a>
              <?php endif; ?>
              <?php if(isset($conf["contact"]["twitter"]) && strlen($conf["contact"]["twitter"])>0) : ?>
                <a href="https://twitter.com/<?=$conf["contact"]["twitter"];?>" target="_blank" style="color:white;"><i class="fab fa-twitter"></i></a>
              <?php endif; ?>
              <?php if(isset($conf["contact"]["facebook"]) && strlen($conf["contact"]["facebook"])>0) : ?>
                <a href="https://facebook.com/<?=$conf["contact"]["facebook"];?>" target="_blank" style="color:white;"><i class="fab fa-facebook-square"></i></a>
              <?php endif; ?>
              <?php if(isset($conf["contact"]["instagram"]) && strlen($conf["contact"]["instagram"])>0) : ?>
                <a href="https://instagram.com/<?=$conf["contact"]["instagram"];?>" target="_blank" style="color:white;"><i class="fab fa-instagram"></i></a>
              <?php endif; ?>
              <?php if(isset($conf["contact"]["youtube"]) && strlen($conf["contact"]["youtube"])>0) : ?>
                <a href="https://youtube.com/channel/<?=$conf["contact"]["youtube"];?>" target="_blank" style="color:white;"><i class="fab fa-youtube"></i></a>
              <?php endif; ?>
                <small style="margin-left:1em;">
                <?php if ($app->getUserSignInStatus()) : ?>
                  <i class="fas fa-user-alt"></i> <?=nav($app->getUserName(),$conf["file"]["admin"]);?> |
                  <?=nav($lCommon["edit_profile"][LANG],$conf["file"]["me"]);?> |
                  <i class="fas fa-sign-out-alt"></i> <?=nav($lCommon["signout"][LANG],"!)?signout");?>
                <?php else : ?>
<?php /*
                  <?=nav($lCommon["create_account"][LANG],$conf["file"]["new"]);?> |
*/ ?>
                  <?=nav($lCommon["signin"][LANG],$conf["file"]["signin"]);?>
                <?php endif; ?>
                </small>
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
              <a class="navbar-brand" href="<?=REALPATHLANG.($conf["site"]["homepage_redirect"]!=""?$conf["site"]["homepage_redirect"]:$conf["site"]["homepage"]).QUERYQ;?>">
              <div class="navbar-header pull-left">
                <img src="<?=
                  file_exists($conf["dir"]["images"]."logo.svg") ?
                  $conf["dir"]["images"]."logo.svg?".time() :
                  (file_exists($conf["dir"]["images"]."logo.png") ?
                  $conf["dir"]["images"]."logo.png?".time() :
                  "data:image/svg+xml;base64,".str_replace("[COLOR]",$conf["trece"]["logo"]["white"],$conf["trece"]["logo"]["img"]))
                  ;?>" alt="<?=$conf["meta"]["title"][LANG];?>" class="img-responsive">
              </div>
              </a>
<?php /*
              <p class="navbar-text pull-left" style="color:white;">
                <small style="margin-right:1em;">Whatever</small>
              </p>
*/ ?>
              <div class="hidden-sm hidden-md hidden-lg clearfix"></div>
              <div id="navbar" class="navbar-collapse collapse navbar-right">
<?php if ($app->getUserSignInStatus()) : ?>
<?php if ($app->getUserHierarchy() == 1) : ?>
                <ul class="nav navbar-nav">
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=$lCommon["content"][LANG];?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><?=nav($lCommon["blog"][LANG],"blog");?></li>
                      <li><?=nav($lCommon["labels"][LANG],"labels");?></li>
                      <li role="separator" class="divider"></li>
                      <li><?=nav($lCommon["pages"][LANG],"pages");?></li>
                    </ul>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=$lCommon["places"][LANG];?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><?=nav($lCommon["places"]["locations"][LANG],"locations");?></li>
                      <li><?=nav($lCommon["places"]["counties"][LANG],"counties");?></li>
                      <li><?=nav($lCommon["places"]["provinces"][LANG],"provinces");?></li>
                      <li><?=nav($lCommon["places"]["regions"][LANG],"regions");?></li>
                      <li><?=nav($lCommon["places"]["countries"][LANG],"countries");?></li>
                      <li role="separator" class="divider"></li>
                      <li><?=nav($lCommon["languages"][LANG],"languages");?></li>
                    </ul>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=$lCommon["admin"][LANG];?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><?=nav($lCommon["genders"][LANG],"genders");?></li>
                      <li><?=nav($lCommon["privileges"][LANG],"uprivileges");?></li>
                      <li><?=nav($lCommon["hierarchy"][LANG],"uhierarchy");?></li>
                      <li role="separator" class="divider"></li>
                      <li><?=nav($lCommon["users"][LANG],"users");?></li>
                    </ul>
                  </li>
                </ul>
<?php endif; ?>
<?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </nav>
