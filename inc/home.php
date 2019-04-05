<?php if(!defined("TRECE")):header("location:/");die();endif; ?>
<?php



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

<?php
  $sum = 1;
  $sumtotal = 1;
  require_once($conf["dir"]["includes"]."blog/".$conf["file"]["crud"].".php");
  $cconfBlog = require($conf["dir"]["includes"]."blog/".$conf["file"]["conf"].".php");
  $blog = new Blog($db,$conf,$cconfBlog); $blog->intimacy = 2; $stmt = $blog->readAll(6);
?>
<?php if ($blog->rowcount>0): for($i=0;$i<$blog->rowcount;$i++) : ?>

        <p><a href="<?=REALPATHLANG.($blog->url_title[$i]);?>"><img src="<?=(file_exists($conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconfBlog["img"]["prefix"].$blog->{$cconfBlog["img"]["ref"]}[$i].".jpg")?$conf["dir"]["images"].$conf["css"]["icon_prefix"].$cconfBlog["img"]["prefix"].$blog->{$cconfBlog["img"]["ref"]}[$i].".jpg?":(file_exists($conf["dir"]["includes"]."blog"."/".$conf["css"]["icon_prefix"].$cconfBlog["img"]["prefix"]."0.jpg")?REALPATH.$conf["dir"]["includes"]."blog"."/".$conf["css"]["icon_prefix"].$cconfBlog["img"]["prefix"]."0.jpg?":"https://fakeimg.pl/".$cconfBlog["img"]["icon_w"]."x".$cconfBlog["img"]["icon_h"]."/?text=Blog post"));?>" class="img-responsive" style="display:inline-block;" alt="<?=$blog->title[$i];?>"></a></p>
        <h1><a href="<?=REALPATHLANG.($blog->url_title[$i]);?>"><?=$blog->title[$i];?></a></h1>
        <p><?=date("d/m/Y",strtotime($blog->date[$i]));?></p>
        <h4><?=$blog->intro[$i];?></h4>

        <hr>

<?php endfor; endif; ?>

      </div>
    </div><!-- row -->

  </div>



<?php require_once($conf["dir"]["includes"]."footer.php"); ?>
