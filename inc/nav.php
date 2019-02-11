<?php if(!defined("TRECE")):header("location:/");die();endif; ?>
      <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?=$conf["site"]["realpathLang"].$conf["site"]["queryq"];?>">
              <img src="<?=
                file_exists($conf["dir"]["images"]."logo.svg") ?
                $conf["dir"]["images"]."logo.svg" :
                (file_exists($conf["dir"]["images"]."logo.png") ?
                $conf["dir"]["images"]."logo.png" :
                "data:image/svg+xml;base64,".str_replace("[COLOR]",$conf["logo"]["white"],$conf["logo"]["img"]))
                ;?>" alt="<?=$conf["meta"]["title"][$conf["site"]["lang"]];?>" class="img-responsive"></a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
<?php if ($app->getUserSignInStatus()) : ?>
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=$app->getUserName();?> <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><?=nav($lCommon[$conf["file"]["me"]][$conf["site"]["lang"]],$lCommon[$conf["file"]["me"]]["en"]);?></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="<?=$conf["site"]["realpathLang"]."?signout";?>"><?=$lCommon["signout"][$conf["site"]["lang"]];?></a></li>
                </ul>
              </li>
            </ul>
<?php if ($app->getUserHierarchy() == 1) : ?>
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=$lCommon["admin"][$conf["site"]["lang"]];?> <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><?=nav($lCommon["gender"][$conf["site"]["lang"]],"gender");?></li>
                  <li><?=nav($lCommon["privileges"][$conf["site"]["lang"]],"privileges");?></li>
                  <li><?=nav($lCommon["hierarchy"][$conf["site"]["lang"]],"hierarchy");?></li>
                  <li><?=nav($lCommon["users"][$conf["site"]["lang"]],"users");?></li>
                </ul>
              </li>
            </ul>
<?php endif; ?>
<?php else : ?>
            <ul class="nav navbar-nav navbar-right">
              <li><a href="<?=$conf["site"]["realpathLang"].$conf["file"]["signin"];?>"><?=$lCommon["signin"][$conf["site"]["lang"]];?></a></li>
            </ul>
<?php endif; ?>
          </div>
        </div>
      </nav>
