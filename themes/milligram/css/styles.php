<?php

header("content-type:text/css; charset=utf-8");

$theColor           = isset($_GET["c"])&&ctype_xdigit($_GET["c"])?"#".$_GET["c"]:"#9b4dca";

#                     | [0]     | [1]     | [2]     | [3]     | [4]     | [5]      | [6]    |
#                     | bgr     | text    | link    | visited | hover   | active   | lines  |
#---------------------+---------+---------+---------+---------+---------+----------+--------+--
$topNav             = ["#333333","#ffffff","#aaaaaa","#ffffff","#ffffff","#ffffff",];
$mainNav            = ["#dddddd","#666666",];
$mainHeader         = [$theColor,];
$mainFooter         = [$theColor,"#ffffff","#ffffff","#ffffff","#ffffff","#ffffff","#b389cc",];
$legalFooter        = [$theColor,"#ffffff","#ffffff","#ffffff","#ffffff","#ffffff","#b26edb",];
$poweredByFooter    = ["#333333","#ffffff","#aaaaaa","#ffffff","#ffffff","#ffffff",];
$valid              = ["#4c8b55","#ffffff","#ffffff","#ffffff","#3f7347","#ffffff",]; # https://www.colourlovers.com/color/4C8B55/valid_grey-green
$error              = ["#a63232","#ffffff","#ffffff","#ffffff","#8c2a2a","#ffffff",]; # https://www.colourlovers.com/color/A63232/dark_red_error
#---------------------+---------+---------+---------+---------+---------+----------+--------+--
$bajoNav            = 6; #rem
$sobreFooter        = 20; #rem
$headerLogoWidth    = 200; #px
$footerLogoWidth    = 130; #px

$time               = time();

echo <<<STARTCSS

@charset "UTF-8";

@import url("https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic");
@import url("https://cdnjs.cloudflare.com/ajax/libs/milligram/1.3.0/milligram.min.css");
@import url("milligram.extra.min.css?{$time}");

STARTCSS;



if($theColor != "#9b4dca") :
echo <<<COLORCHANGE

/* CHANGE MAIN COLOR */

.button,button,input[type='button'],input[type='reset'],input[type='submit']{background-color:{$theColor};border-color:{$theColor};}
.button[disabled]:focus,.button[disabled]:hover,button[disabled]:focus,button[disabled]:hover,input[type='button'][disabled]:focus,input[type='button'][disabled]:hover,input[type='reset'][disabled]:focus,input[type='reset'][disabled]:hover,input[type='submit'][disabled]:focus,input[type='submit'][disabled]:hover{background-color:{$theColor};border-color: {$theColor};}
.button.button-outline,button.button-outline,input[type='button'].button-outline,input[type='reset'].button-outline,input[type='submit'].button-outline{color:{$theColor};}
.button.button-outline[disabled]:focus,.button.button-outline[disabled]:hover,button.button-outline[disabled]:focus,button.button-outline[disabled]:hover,input[type='button'].button-outline[disabled]:focus,input[type='button'].button-outline[disabled]:hover,input[type='reset'].button-outline[disabled]:focus,input[type='reset'].button-outline[disabled]:hover,input[type='submit'].button-outline[disabled]:focus,input[type='submit'].button-outline[disabled]:hover{color:{$theColor};}
.button.button-clear,button.button-clear,input[type='button'].button-clear,input[type='reset'].button-clear,input[type='submit'].button-clear{color:{$theColor};}
.button.button-clear[disabled]:focus,.button.button-clear[disabled]:hover,button.button-clear[disabled]:focus,button.button-clear[disabled]:hover,input[type='button'].button-clear[disabled]:focus,input[type='button'].button-clear[disabled]:hover,input[type='reset'].button-clear[disabled]:focus,input[type='reset'].button-clear[disabled]:hover,input[type='submit'].button-clear[disabled]:focus,input[type='submit'].button-clear[disabled]:hover{color:{$theColor};}
pre{border-left-color:{$theColor};}
input[type='email']:focus,input[type='number']:focus,input[type='password']:focus,input[type='search']:focus,input[type='tel']:focus,input[type='text']:focus,input[type='url']:focus,textarea:focus,select:focus{border-color:{$theColor};}
select:focus{background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" height="14" viewBox="0 0 29 14" width="29"><path fill="{$theColor}" d="M9.37727 3.625l5.08154 6.93523L19.54036 3.625"/></svg>');}
a{color:{$theColor};text-decoration:none;}

/* END CHANGE MAIN COLOR */

COLORCHANGE;
endif;



echo <<<ENDCSS

/* STICKY FOOTER MAGIC */

  body{display:flex;min-height:100vh;flex-direction:column;}
  main{flex:1;}

/* END OF STICKY FOOTER MAGIC */



/* USEFUL CLASSES FOR GENERIC PURPOSES */

  /* Mobile / Not mobile */

    .mobile{display:block;}
    .not-mobile{display:none;}

  /* Text stuff */

  .text-right{text-align:right !important;}
  .text-left{text-align:left !important;}
  .text-center{text-align:center !important;}
  td.nowrap,td.avatar{padding-right:0;white-space:nowrap;}

  /* Lists stuff */

    ul.list-clean{list-style:none;}
    ul.list-clean li,ul.list-clean li label,ul.list-clean li label input{margin:0 !important;padding:0 !important;}

  /* Buttons stuff */
    a.change-status{border:none;padding:0 .8rem;line-height:2.5rem;height:2.5rem;}
    a.change-status.on{background:{$valid[0]};}
    a.change-status.on:hover{background:{$valid[4]};}
    a.change-status.off{background:{$error[0]};}
    a.change-status.off:hover{background:{$error[4]};}

  /* Images stuff */

    figure{margin:0;width:100%;}
    .float-image{max-width:300px;}
    .float-image-left{margin-right:2em;}
    .float-image-right{margin-left:2em;}

  /* Forms stuff */

    form{}
    form meter{margin:0;width:100%;}
    form progress{margin:0;width:100%;}
    form p{margin:0;padding:0;}
    form textarea{height:8em;}
    form input[type='date'],form input[type='color']{-webkit-appearance:none;-moz-appearance:none;appearance:none;background-color:transparent;border:0.1rem solid #d1d1d1;border-radius:.4rem;box-shadow:none;box-sizing:inherit;height:3.8rem;padding:.6rem 1.0rem;width:100%;}
    form input[type='date']:focus,form input[type='color']:focus{border-color:{$theColor};outline:0;}
    form label.valid{color:{$valid[0]};}
    form label.error{color:{$error[0]};}
    form input.valid,#valid-alert .container{background:#23dc3d;} /* https://www.colourlovers.com/color/23DC3D/valid_green */
    form input.error,#error-alert .container{background:#ff9494;} /* https://www.colourlovers.com/color/FF9494/error_red */
    form .column.submit{margin-top:2rem;}
    form ::-webkit-input-placeholder{color:#aaa;}    /* WebKit, Blink, Edge */
    form :-moz-placeholder{color:#aaa;opacity:1;}    /* Mozilla Firefox 4 to 18 */
    form ::-moz-placeholder{color:#aaa;opacity:1;}   /* Mozilla Firefox 19+ */
    form :-ms-input-placeholder{color:#aaa;}         /* Internet Explorer 10-11 */
    form ::-ms-input-placeholder{color:#aaa;}        /* Microsoft Edge */
    form ::placeholder{color:#aaa;}                  /* Most modern browsers support this now. */
    form#firsttime input[name=database_entropy]::placeholder{text-decoration:line-through;}




  /* Ribbons */

    .ribbon-box{position:relative;}
    .ribbon{width:25rem;height:25rem;overflow:hidden;position:absolute;}
    .ribbon span{position:absolute;display:block;width:12rem;height:5rem;box-shadow:0 5px 10px rgba(0,0,0,.1);background-color:{$theColor};}
    .ribbon-top-left{top:0;left:0;}
    .ribbon-top-left span{left:-3rem;top:1em;transform:rotate(-45deg);}

    .side-corner-tag {position:relative; color:#fff; display:inline-block; padding:1px; overflow:hidden; font-size:.1em;}
    .side-corner-tag p {display:inline;}
    .side-corner-tag p span {position:absolute; top:0; right:-22px; box-shadow:0px 0px 10px rgba(0,0,0,0.2), inset 0px 5px 30px rgba(255,255,255,0.2); width:50px; padding:6px; -webkit-transform:rotate(45deg); -moz-transform:rotate(45deg); -o-transform:rotate(45deg); -ms-transform:rotate(45deg);}
    .side-corner-tag p.big span {z-index:1000; position:absolute; top:20px; right:-100px; box-shadow:0px 0px 10px rgba(0,0,0,0.2), inset 0 5px 30px rgba(255,255,255,0.2); width:150px; padding:15px; -webkit-transform:rotate(45deg); -moz-transform:rotate(45deg); -o-transform:rotate(45deg); -ms-transform:rotate(45deg);}
    /*.side-corner-tag p span {background:#333;}*/
    /*.side-corner-tag p span.danger {background:#dc3545;}*/
    /*.side-corner-tag p span.success {background:#28a745;}*/

/* END OF USEFUL CLASSES FOR GENERIC PURPOSES */



/* HEADER & NAV STUFF */

    nav.top-nav,header.main-header,nav.main-nav{position:relative;z-index:10;}

    nav.main-nav{background:{$mainNav[0]};color:{$mainNav[1]};padding:1em 0;margin-bottom:{$bajoNav}rem;}

  /* Top nav stuff */

    nav.top-nav{background:{$topNav[0]};color:{$topNav[1]};padding:.8em 0;}
    nav.top-nav .row{padding:0;}
    nav.top-nav .column p{margin:0;}
    nav.top-nav .languages,nav.top-nav .login{margin-left:2rem;}
    nav.top-nav a{text-decoration:none;position:relative;}nav.top-nav a:not(.icon):after{content:'';width:100%;position:absolute;left:0;bottom:-3px;border-color:{$topNav[2]};border-width:0 0 1px;border-style:dotted;}
    nav.top-nav a:link{color:{$topNav[2]};}
    nav.top-nav a:visited{color:{$topNav[3]};}
    nav.top-nav a:hover{color:{$topNav[4]};}nav.top-nav a:hover:not(.icon):after{border-color:{$topNav[4]};}
    nav.top-nav a:active{color:{$topNav[5]};}

  /* Main header stuff */

    header.main-header{background:{$mainHeader[0]};color:white;}
    header.main-header img.logo{margin:1em 0 .6em 0;max-height:2em;}
    header.main-header h1{margin-top:.4em;}

/* END OF HEADER & NAV STUFF */



/* FOOTER STUFF */

  /* Main footer stuff */

    footer.main-footer{margin-top:{$sobreFooter}rem;background:{$mainFooter[0]};color:{$mainFooter[1]};}
    footer.main-footer .column{margin-top:4rem;display:flex;}
    footer.main-footer .column figure{margin-bottom:1rem;}

    footer.main-footer .column .left-block{min-width:40%;max-width:40%;}
    footer.main-footer .column .left-block .container{font-size:.8em;}
    footer.main-footer .column .left-block .row{padding-top:0;}
    footer.main-footer .column .left-block .column{margin-top:0;display:flex;flex-direction:column;}
    footer.main-footer .column .left-block .column h3{font-size:1.8rem;line-height:2rem;letter-spacing:-.03rem;margin-bottom:.3rem;}
    footer.main-footer .column .left-block .column h3:nth-child(n+2){margin-top:1rem;}
    footer.main-footer .column .left-block .column p{line-height:1.8rem;margin-bottom:1rem;}

    footer.main-footer .column .right-block .container{font-size:.8em;padding-right:0;}
    footer.main-footer .column .right-block .row{padding-top:0;}
    footer.main-footer .column .right-block .column{margin-top:0;display:flex;flex-direction:column;}
    footer.main-footer .column .right-block .column h3{font-size:1.8rem;line-height:2rem;letter-spacing:-.03rem;margin-bottom:.3rem;}
    footer.main-footer .column .right-block .column h3:nth-child(n+2){margin-top:1rem;}
    footer.main-footer .column .right-block .column p{line-height:1.8rem;margin-bottom:1rem;}

    footer.main-footer div.logo{max-width:10rem;margin-right:2rem;}
    footer.main-footer div.right-block{flex:1;}
    footer.main-footer img.logo{margin:.6em 0 .2em 0;width:auto;height:auto;max-width:100%;max-height:100%;}
    footer.main-footer{background:{$mainFooter[0]};color:{$mainFooter[1]};}
    footer.main-footer{padding:.4em 0 .8em 0;}
    footer.main-footer a{text-decoration:none;position:relative;}footer.main-footer a:not(.icon):after{content:'';width:100%;position:absolute;left:0;bottom:-3px;border-color:{$mainFooter[6]};border-width:0 0 1px;border-style:dotted;}
    footer.main-footer a:link{color:{$mainFooter[2]};}
    footer.main-footer a:visited{color:{$mainFooter[3]};}
    footer.main-footer a:hover{color:{$mainFooter[4]};}footer.main-footer a:hover:not(.icon):after{border-color:{$mainFooter[4]};}
    footer.main-footer a:active{color:{$mainFooter[5]};}

  /* Bottom footer stuff (.legal and .poweredby) */

    footer.bottom-footer .row{padding:0;}
    footer.bottom-footer .column p{margin:0;}
    footer.legal{background:{$legalFooter[0]};color:{$legalFooter[1]};border-top:1px solid {$legalFooter[6]};}
    footer.legal{padding:.4em 0 .8em 0;}
    footer.legal a{text-decoration:none;position:relative;}
    footer.legal a:link{color:{$legalFooter[2]};}
    footer.legal a:visited{color:{$legalFooter[3]};}
    footer.legal a:hover{color:{$legalFooter[4]};}footer.legal a:hover:not(.icon):after{content:'';width:100%;position:absolute;left:0;bottom:-3px;border-color:{$legalFooter[4]};border-width:0 0 1px;border-style:dotted;}
    footer.legal a:active{color:{$legalFooter[5]};}
    footer.poweredby{background:{$poweredByFooter[0]};color:white;}
    footer.poweredby{padding:.4em 0 .6em 0;}
    footer.poweredby a{text-decoration:none;position:relative;}footer.poweredby a:not(.icon):after{content:'';width:100%;position:absolute;left:0;bottom:-3px;border-color:{$poweredByFooter[2]};border-width:0 0 1px;border-style:dotted;}
    footer.poweredby a:link{color:{$poweredByFooter[2]};}
    footer.poweredby a:visited{color:{$poweredByFooter[3]};}
    footer.poweredby a:hover{color:{$poweredByFooter[4]};}footer.poweredby a:hover:not(.icon):after{border-color:{$poweredByFooter[4]};}
    footer.poweredby a:active{color:{$poweredByFooter[5]};}

/* END OF FOOTER STUFF */



/* MEDIAQUERIES */

  /* Small mobile screen */
  @media (max-width: 40.0rem) {
    nav.top-nav{font-size:.8em;}
    footer.main-footer .column .left-block .container{padding:0;}
    footer.main-footer .column:nth-child(n+2){padding-top:1rem;}
    .ribbon{width:8rem;height:8rem;}
    .ribbon span{height:2.4rem;}
    .small-ribbon{width:7rem;height:7rem;}
    .small-ribbon span{left:-4rem;top:0;height:1.2rem;}
    }

  /* Larger than mobile screen */
  @media (min-width: 40.0rem) {
    nav.top-nav{padding-top:.2em;}
    header.main-header img.logo{margin:.6em 0 .4em 0;max-width:{$headerLogoWidth}px;}
  /*header.main-header img.logo{margin:1.2em 0 .8em 0;max-height:2.4em;} tailored for the TRECE logo */
    header.main-header h1{margin-top:1em;}
    .mobile{display:none;}
    .not-mobile{display:block;}
    footer.main-footer div.logo{max-width:{$footerLogoWidth}px;}
    footer.main-footer .column .left-block{min-width:30%;max-width:30%;}
    footer.main-footer .column .left-block .container{padding-left:0;}
    .ribbon{width:10rem;height:10rem;}
    .ribbon span{height:3rem;}
    .small-ribbon{width:7rem;height:7rem;}
    .small-ribbon span{left:-4rem;top:0;height:1.2rem;}
    }

  /* Larger than tablet screen */
  @media (min-width: 80.0rem) {
    footer.main-footer .column .left-block{min-width:20%;max-width:20%;}
    .ribbon{width:10rem;height:10rem;}
    .ribbon span{height:3rem;}
    .small-ribbon{width:7rem;height:7rem;}
    .small-ribbon span{left:-4rem;top:0;height:1.2rem;}
    }

  /* Larger than desktop screen */
  @media (min-width: 120.0rem) {
    .ribbon{width:10rem;height:10rem;}
    .ribbon span{height:2rem;}
    .small-ribbon{width:7rem;height:7rem;}
    .small-ribbon span{left:-4rem;top:0;height:1.2rem;}
    }

/* END OF MEDIAQUERIES */



ENDCSS;

?>