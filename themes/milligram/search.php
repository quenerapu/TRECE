<?php if(!defined("TRECE")):header("location:./");die();endif; ?>

    <form class="search">
    <div class="row row-responsive">
      <div class="column column-xs-60 column-sm-30 column-md-20 column-lg-20">
        <p>
          <span class="search">
            <input type="text" 
                   name="search" 
                   id="search" 
                   placeholder="<?=$lCommon["type_your_search"][LANG];?>" 
                   autocomplete="new-search" 
                   value="<?=$searchWhat;?>" 
                   required>
            <span class="undo"><i class="fas fa-undo-alt"></i></span>
          </span>
          <input type="hidden" 
                 name="wr" 
                 value="<?=$action;?>">
        </p>
      </div>
      <div class="column column-xs-40 column-sm-70 column-md-80 column-lg-80">
        <button type="submit"><i class="fas fa-search"></i> <?=$lCommon["search"][LANG];?></button>
      </div>
    </div>
    </form>
