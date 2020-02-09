<?php

header("Content-Type:application/javascript; charset=utf-8");

echo <<<ENDJS

/* Your Javascript here */

  function foo(){
    foo = bar;
  }

/* End of your Javascript */

ENDJS;

?>