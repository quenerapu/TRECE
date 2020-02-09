<?php if(!defined("TRECE")):header("location:./");die();endif; ?>
<?php
# .............................................
# ...####..######..####..#####...####..##..##..
# ..##.....##.....##..##.##..##.##..##.##..##..
# ...####..####...######.#####..##.....######..
# ......##.##.....##..##.##..##.##..##.##..##..
# ...####..######.##..##.##..##..####..##..##..
# .............................................

  if(!isset($included)) : $included = false; endif;

?>

    <div class="row">
      <div class="col-xs-12 col-sm-10 col-sm-offset-1">
        <div style="margin-bottom:20px;">
          <form class="form-inline" action="" method="get">
            <div class="pull-left">
              <div class="input-group" style="max-width:120px; max-width:250px;">
                <div class="input-group-addon"><a href="<?=REALPATHLANG.($included?$back:$action)."/".$crudlpx;?>" data-toggle="tooltip" data-placement="bottom" title="<?=$lCommon["reset_search"][LANG];?>"><i class="fas fa-trash"></i></a></div>
                <input type="hidden" name="wr" value="<?=$action;?>">
                <input type="text" name="wh" class="form-control input-sm" value="<?=$searchWhat;?>" style="max-width:100%;">
              </div>
            </div>
            <div class="pull-left">
              <button type="submit" data-toggle="tooltip" data-placement="bottom" title="<?=$lCommon["search"][LANG];?>" class="btn btn-sm" style="margin-left:5px;"><i class="fas fa-search"></i></button>
            </div>
          </form>
          <div class="clearfix"></div>
        </div>
      </div>
    </div><!-- row -->

<?php
# .. END SEARCH
# .............................................
?>
