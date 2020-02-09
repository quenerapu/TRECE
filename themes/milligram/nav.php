<?php if(!defined("TRECE")):header("location:./");die();endif; ?>
<?php if(NPE) : ?>

<div class="ribbon-box" style="width:100px;background:blue;z-index:10000;">

  <div class="ribbon ribbon-top-left"><span style="background:red"></span></div>

</div>

<?php endif; ?>

<nav class="top-nav">

  <div class="container">

    <div class="row">

      <div class="column column-100">

        <div class="mobile">

          <div class="float-left">

            <p>
              <a href="<?=REALPATHLANG."";?>">Contact</a> 
            </p>

          </div>

        </div>

        <div class="not-mobile">

          <div class="float-left">

            <p>
                <a href="<?=REALPATHLANG."";?>">Whatever</a> 
              | <a href="<?=REALPATHLANG."";?>">Whatever</a>
            </p>

          </div>

        </div>

        <?php if(count($conf["site"]["langs"])>1): ?>
        <div class="languages float-right">

          <p><small>
          <?php $i=1; foreach($conf["site"]["langs"] as $language): ?>
            <a href="<?=REALPATH.$language["url-name"];?>"><?=strtoupper($language["ref-name"]);?></a><?=$i<count($conf["site"]["langs"])?" |":"";?>
          <?php $i++; endforeach; ?>
          </small></p>

        </div>
        <?php endif; ?>

        <div class="login float-right">

          <p>
          <?php if($app->getUserSignInStatus()): ?>
            <i class="fas fa-user-alt"></i> 
              <?=nav($app->getUserName(),$conf["file"]["admin"]);?>
            | <?=nav($lCommon["signout"][LANG],"!)?signout");?> <i class="fas fa-sign-out-alt"></i>
          <?php else: ?>
              <?=nav($lCommon["create_account"][LANG],$conf["file"]["new"]);?>
            | <?=nav($lCommon["signin"][LANG],$conf["file"]["signin"]);?>
          <?php endif; ?>
          </p>

        </div>

        <div class="not-mobile">

          <div class="contact float-right" style="padding-top:.1em;">

            <p>
            <?php if(isset($conf["contact"]["phone_no"]) && strlen($conf["contact"]["phone_no"])>0): ?>
              <a href="tel:<?=preg_replace("/\s/","",$conf["contact"]["phone_no"]);?>" class="icon"><i class="fas fa-mobile-alt fa-fw"></i></a>
            <?php endif; ?>
            <?php if(isset($conf["contact"]["email"]) && strlen($conf["contact"]["email"])>0): ?>
              <a href="mailto:<?=$conf["contact"]["email"];?>" class="icon"><i class="fas fa-envelope fa-fw"></i></a>
            <?php endif; ?>
            <?php if(isset($conf["contact"]["telegram"]) && strlen($conf["contact"]["telegram"])>0): ?>
              <a href="https://t.me/<?=$conf["contact"]["telegram"];?>" class="icon"><i class="fab fa-telegram-plane fa-fw"></i></a>
            <?php endif; ?>
            <?php if(isset($conf["contact"]["twitter"]) && strlen($conf["contact"]["twitter"])>0): ?>
              <a href="https://twitter.com/<?=$conf["contact"]["twitter"];?>" class="icon"><i class="fab fa-twitter fa-fw"></i></a>
            <?php endif; ?>
            <?php if(isset($conf["contact"]["facebook"]) && strlen($conf["contact"]["facebook"])>0): ?>
              <a href="https://facebook.com/<?=$conf["contact"]["facebook"];?>" class="icon"><i class="fab fa-facebook-square fa-fw"></i></a>
            <?php endif; ?>
            <?php if(isset($conf["contact"]["instagram"]) && strlen($conf["contact"]["instagram"])>0): ?>
              <a href="https://instagram.com/<?=$conf["contact"]["instagram"];?>" class="icon"><i class="fab fa-instagram fa-fw"></i></a>
            <?php endif; ?>
            <?php if(isset($conf["contact"]["youtube"]) && strlen($conf["contact"]["youtube"])>0): ?>
              <a href="https://youtube.com/channel/<?=$conf["contact"]["youtube"];?>" class="icon"><i class="fab fa-youtube fa-fw"></i></a>
            <?php endif; ?>
            </p>

          </div>

        </div>

      </div>

    </div>

  </div>

</nav>



<header class="main-header">

  <div class="container">

    <div class="row">

      <div class="column">

<?php /*<h1>The header</h1> */ ?>
        <a href="<?=REALPATHLANG;?>">
          <img class="logo" src="<?=
            file_exists($conf["dir"]["images"]."logo.svg") ?
            $conf["dir"]["images"]."logo.svg?".time() :
            (file_exists($conf["dir"]["images"]."logo.png") ?
            $conf["dir"]["images"]."logo.png?".time() :
            "data:image/svg+xml;base64,".str_replace("[COLOR]",$conf["trece"]["logo"]["white"],$conf["trece"]["logo"]["img"]))
            ;?>" alt="<?=$conf["meta"]["title"][LANG];?>">
        </a>

      </div>

    </div>

  </div>

</header>



<nav class="main-nav">

  <div class="container">

    <div class="row">

      <div class="column">

          <a href="<?=REALPATHLANG;?>whatever" class="active">Whatever</a>
        | <a href="<?=REALPATHLANG;?>whatever2">Whatever 2</a>
        | <a href="#">Whatever 3</a>
        | <a href="#">Whatever 4</a>
      </div>

    </div>

  </div>

</nav>


<main>


