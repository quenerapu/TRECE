<?php if(!defined("TRECE")):header("location:/");die();endif; ?>
<?php

  if ( !$app->getUserSignInStatus() ) :

    header("location:".REALPATHLANG.$conf["file"]["signin"].QUERYQ);
    die();

  endif;

  header("location:".REALPATHLANG.QUERYQ);
  die();

?>
