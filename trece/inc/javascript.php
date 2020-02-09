<?php if(!defined("TRECE")):header("location:./");die();endif; ?>

  <!-- Add and select -->
  <script>
    function add<?=isset($parental)?"AndSelect":"";?>Them(howMany,parental<?=isset($extras)?",extras":"";?>){$.post("",{addThem:true,add_howMany:howMany,add_parental:parental<?=isset($extras)?",add_extras:extras":"";?>},function(data){
      location.replace("<?=$conf["site"]["uri"];?>");
//    location.reload();
//    alert(data);
//    console.log(data);
      }).fail(function(){alert("<?=addslashes($lCommon["cannot_be_added"][LANG]);?>");});};

    $(document).on("click",".add<?=isset($parental)?"AndSelect":"";?>Them",function(e){
    <?php if(!isset($parental)) : ?>
      if(!e.ctrlKey){addThem(1<?=isset($parent_id)?",".$parent_id:"";?><?=isset($extras)?",extras":"";?>);}
      else{
    <?php endif; ?>
      $.confirm({
        boxWidth:"300px",
        onOpen:function(){
          $("#bulkAdd").show();
          $(".number").css({"position":"fixed","width":"266px","margin-right":"0","padding-right":"30px",});
          <?php if(isset($parental)): ?>$(".parental").css({"position":"fixed","top":"60px","min-width":"50%","margin-right":"25px","padding-right":"30px",});<?php endif; ?>
          <?php if(isset($extras)): ?>$(".extras").css({"position":"fixed","top":"<?=isset($parental)?"100":"60";?>px","min-width":"50%","margin-right":"25px","padding-right":"30px",});<?php endif; ?>
          $(".jconfirm-content").css({"display":"block","height":"<?=isset($parental)&&isset($extras)?"110":(isset($parental)||isset($extras)?"60":"30");?>px"});
          this.setContent($("#bulkAdd"));
          this.$content.find(".number").val("");
          this.$content.find(".number").focus();
          },
        onClose:function() {
          $("body").prepend($("#bulkAdd"));
          $("#bulkAdd").css({"display":"none"});
          $(".number").val("");
          $(".parental").val("<?=isset($parent_id)?$parent_id:"0";?>");
          $(".extras").val("<?=isset($extra_id)?$extra_id:"0";?>");
          $("#bulkAdd").hide();
          },
        buttons:{
          cancel:{
            text:"<?=$lCommon["cancel"][LANG];?>",
            },
          confirm:{
            text:"<?=$lCommon["add"][LANG];?>",
            action:function(){
              var number=this.$content.find(".number").val();
              if(number%1==0 && number<=<?=$cconf["default"]["max_new_items"];?>){
                var howMany=this.$content.find(".number").val();
                <?php // if(isset($parental)): ?>
                var parental=<?=isset($parent_id)?$parent_id:"this.\$content.find(\".parental\").val()";?>;
                <?php // endif; ?>
                <?php if(isset($extras)) : ?>
                var extras=this.$content.find(".extras").val();
//              var extras="<?=$extras;?>";
                <?php endif; ?>
                }
              add<?=isset($parental)?"AndSelect":"";?>Them(howMany,parental<?=isset($extras)?",extras":""?>);
              },
            },
            },
          });
    <?php if(!isset($parental)) : ?>
        };
    <?php endif; ?>
      });
  </script>



  <div id="bulkAdd" style="display:none;">
    <input type="text" placeholder="<?=sprintf($lCommon["how_many_do_you_want"][LANG],$cconf["default"]["max_new_items"]);?>" class="number" style="box-sizing:border-box;line-height:20px;">
<?php if(isset($parental)) : ?>
    <select name="parental" class="parental" data-style="btn-info">
      <?php $parental=explode("|",$parental); ?>
      <option value="0" selected><?=$parental[0];?>:</option>
      <?php
        require_once($conf["dir"]["includes"].(strtolower($parental[1]))."/".$conf["file"]["crud"].".php");
        ${"cconf".$parental[1]} = require($conf["dir"]["includes"].(strtolower($parental[1]))."/".$conf["file"]["conf"].".php");
        ${strtolower($parental[1])} = new $parental[1]($db,$conf,${"cconf".$parental[1]}); $stmt = ${strtolower($parental[1])}->readAllJSON();
      ?>
      <?php if(isset($parental[1]) && ${strtolower($parental[1])}->rowcount>0): for($i=0;$i<${strtolower($parental[1])}->rowcount;$i++) : ?>
      <option value="<?=${strtolower($parental[1])}->id[$i];?>"><?=${strtolower($parental[1])}->{$parental[2]}[$i];?></option>
      <?php endfor; endif; ?>
    </select>
<?php else : ?>
    <input type="hidden" name="parental" class="parental" value="<?=isset($parent_id)?$parent_id:"0";?>">
<?php endif; ?>
<?php if(isset($extras)) : ?>
    <select name="extras" class="extras" data-style="btn-info">
      <?php $extras=explode("|",$extras); ?>
      <option value="0" selected><?=$extras[0];?>:</option>
      <?php
        require_once($conf["dir"]["includes"].(strtolower($extras[1]))."/".$conf["file"]["crud"].".php");
        ${"cconf".$extras[1]} = require($conf["dir"]["includes"].(strtolower($extras[1]))."/".$conf["file"]["conf"].".php");
        ${strtolower($extras[1])} = new $extras[1]($db,$conf,${"cconf".$extras[1]}); $stmt = ${strtolower($extras[1])}->readAllJSON();
      ?>
      <?php if(isset($extras[1]) && ${strtolower($extras[1])}->rowcount>0): for($i=0;$i<${strtolower($extras[1])}->rowcount;$i++) : ?>
      <option value="<?=${strtolower($extras[1])}->id[$i];?>"><?=${strtolower($extras[1])}->{$extras[2]}[$i];?></option>
      <?php endfor; endif; ?>
    </select>
<?php else : ?>
    <input type="hidden" name="extras" class="extras" value="<?=isset($extra_id)?$extra_id:"0";?>">
<?php endif; ?>
  </div>



  <!-- Sort them -->
  <script>
    $(document).ready(function(){
      $(".sortable").sortable({
        handle:".handle",
        update:function(){var sort=$(".sortable").sortable("serialize"); $.post("",{sortThem:true,sort:sort},function(data){}).fail(function(){alert("Oh, non a podo ordenar!");});}
        });
      });
  </script>



  <!-- Delete them -->
  <!-- sprintf.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sprintf/<?=$conf["version"]["sprintf"];?>/sprintf.min.js"></script>
  <script>
    function deleteThem(who){$.post("",{deleteThem:true,delete_who:who},function(data){
      location.replace("<?=$conf["site"]["uri"];?>");
//    location.reload();
//    alert(data);
      $("#allnone:checkbox").prop("checked",false);$(".checkme:checkbox").prop("checked",false);}).fail(function(){alert("<?=addslashes($lCommon["cannot_be_deleted"][LANG]);?>");});};

    $("#deleteThem").on("click",function(){
      var howMany = 0;
      var who = $("input[name=item]:checked").map(function(){return this.value;}).get().join("↲");
      howMany = who.split("|").length-1;

      if(howMany>0){
        $.confirm({boxWidth:"300px",useBootstrap:false,icon:"fa fa-warning",closeIcon:true,closeIconClass:"fa fa-close",title:"<?=$lCommon["warning"][LANG];?>",type:"red",content: sprintf("<?=$lCommon["you_are_about_to_delete"][LANG];?>",howMany,function(){return howMany>1?"<?=$lCommon["you_are_about_to_delete_plural"][LANG];?>":"";}),buttons:{confirm:{text:"<?=$lCommon["accept"][LANG];?>",action:function(){deleteThem(who);}},cancel:{text:"<?=$lCommon["cancel"][LANG];?>",action:function(){}},}});
        }
      });
  </script>



  <!-- All/None -->
  <script>
    $("#allnone:checkbox").click(function(){
      var checked=!$(this).data("checked");
      $(".checkme:checkbox").prop("checked",checked);
      $(this).data("checked",checked);
      });
  </script>



  <!-- jQuery Confirm -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/<?=$conf["version"]["jquery_confirm"];?>/jquery-confirm.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/<?=$conf["version"]["jquery_confirm"];?>/jquery-confirm.min.js"></script>
  <script>
    jconfirm.defaults={title:"",titleClass:"",type:"default",typeAnimated:!0,draggable:!0,dragWindowGap:30,dragWindowBorder:!0,animateFromElement:!1,smoothContent:!0,content:"",buttons:{},defaultButtons:{ok:{action:function(){}},close:{action:function(){}},},contentLoaded:function(data,status,xhr){},icon:"",lazyOpen:!1,bgOpacity:null,theme:"bootstrap",animation:"bottom",closeAnimation:"bottom",animationBounce:2,animationSpeed:400,rtl:!1,container:"body",containerFluid:!1,backgroundDismiss:!1,backgroundDismissAnimation:"shake",autoClose:!1,closeIcon:!0,closeIconClass:"fa fa-close",watchInterval:100,boxWidth:"50%",scrollToPreviousElement:!0,scrollToPreviousElementAnimate:!0,useBootstrap:!1,offsetTop:40,offsetBottom:40,onContentReady:function(){},onOpenBefore:function(){},onOpen:function(){},onClose:function(){},onDestroy:function(){},onAction:function(){},}
  </script>
