<?php if(!defined("TRECE")):header("location:./");die();endif; ?>

<!-- PAGER -->

            <div class="pager">
              <a<?php if($page>1):?> href="<?=REALPATHLANG.($included?$back:$action)."/".$crudlpx."/1".QUERYQ;?>" title="<?=$lCommon["first_page"][LANG];?>"<?php else: ?> class="disabled"<?php endif;?>><i class="fas fa-angle-double-left"></i></a>
<?php for ($x=$initial_num;$x<$condition_limit_num;$x++): if(($x>0)&&($x<=$total_pages)): if($x==$page) : ?>
              <a href="<?=REALPATHLANG.($included?$back:$action)."/".$crudlpx."/".$x.QUERYQ;?>" title="<?=$lCommon["actual_page"][LANG];?>" class="active"><?=$x;?></a>
<?php else: ?>
              <a href="<?=REALPATHLANG.($included?$back:$action)."/".$crudlpx."/".$x.QUERYQ;?>" title="<?=$lCommon["page"][LANG];?> <?=$x;?>"><?=$x;?></a>
<?php endif; endif; endfor; ?>
              <a<?php if($page<$total_pages):?> href="<?=REALPATHLANG.($included?$back:$action)."/".$crudlpx."/".$total_pages.QUERYQ;?>" title="<?=$lCommon["last_page"][LANG];?>"<?php else: ?> class="disabled"<?php endif;?>><i class="fas fa-angle-double-right"></i></i></a>
            </div>

<!-- /PAGER -->


