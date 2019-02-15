<?php if(!defined("TRECE")):header("location:/");die();endif; ?>


<!-- PAGER -->

        <div class="row" style="padding:1em 0;">
          <div class="col-xs-12">
            <ul class="pagination" style="margin:.5em 0;">
<?php

  if ($page>1):

?>
              <li><a href="<?=REALPATHLANG.($included?$back:$action)."/".$crudlpx."/1".QUERYQ;?>" data-toggle="tooltip" data-placement="bottom" title="<?=$lCommon["first_page"][LANG];?>">«</a></li>
<?php

  endif;

  for ($x=$initial_num; $x<$condition_limit_num; $x++) :

    if (($x > 0) && ($x <= $total_pages)) :

      if ($x == $page) :

?>
              <li class="active"><a href="<?=REALPATHLANG.($included?$back:$action)."/".$crudlpx."/".$x.QUERYQ;?>" data-toggle="tooltip" data-placement="bottom" title="<?=$lCommon["actual_page"][LANG];?>"><?=$x;?> <span class="sr-only"><?=$lCommon["actual_page"][LANG];?></span></a></li>
<?php

  else:

?>
              <li><a href="<?=REALPATHLANG.($included?$back:$action)."/".$crudlpx."/".$x.QUERYQ;?>" data-toggle="tooltip" data-placement="bottom" title="<?=$lCommon["page"][LANG];?> <?=$x;?>"><?=$x;?></a></li>
<?php

      endif;

    endif;

  endfor;

  if ($page<$total_pages):

?>
              <li><a href="<?=REALPATHLANG.($included?$back:$action)."/".$crudlpx."/".$total_pages.QUERYQ;?>" data-toggle="tooltip" data-placement="bottom" title="<?=$lCommon["last_page"][LANG];?> (<?=$total_pages;?>)">»</a></li>
<?php

  endif;

?>
            </ul>
          </div>
        </div>

<!-- /PAGER -->


