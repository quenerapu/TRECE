<?php

header("content-type:text/css");

$navbar_color1 = "#333"; # Navbar background
$navbar_color2 = "#666"; # Navbar bottomline
$navbar_color3 = "#cccccc"; # Navbar text background hover ?
$navbar_color4 = "#ffffff"; # Navbar texts hover
$success_color = "#28a745";
$danger_color  = "#dc3545";
$font_color    = "#5e5e5e";
$sticky_footer = $_GET["sf"];
$padding_top   = 125;
echo <<<ENDCSS
/*

# Thank you Håkon Wium Lie (@wiumlie) for inventing CSS.

This is a CSS file

*/

html{position:relative; min-height:100%;}
body{padding-top:{$padding_top}px !important; margin-bottom:{$sticky_footer}px !important;}


/* BOOTSTRAP */

/* NAVBAR */
.navbar{font-family:'Cabin Condensed',sans-serif!important}.navbar-nav{margin-top:0}.navbar-nav a{font-weight:600;font-size:1.3em}.navbar-brand{padding:0}.navbar-brand>img{height:100%;padding:5px;width:auto}.navbar-brand{margin-top:.2em;height:60px}.nav >li >a{padding-top:25px!important;padding-bottom:20px!important}.navbar-toggle{padding:10px;margin:15px 15px 15px 0}.navbar-default{background-color:{$navbar_color1};border-color:{$navbar_color2}}.navbar-default .navbar-brand{color:{$navbar_color3}}.navbar-default .navbar-brand:hover,.navbar-default .navbar-brand:focus{color:{$navbar_color4}}.navbar-default .navbar-text{color:{$navbar_color3}}.navbar-default .navbar-nav > li > a{color:{$navbar_color3}}.navbar-default .navbar-nav > li > a:hover,.navbar-default .navbar-nav > li > a:focus{color:{$navbar_color4}}.navbar-default .navbar-nav > li > .dropdown-menu{background-color:{$navbar_color1}}.navbar-default .navbar-nav > li > .dropdown-menu > li > a{color:{$navbar_color3}}.navbar-default .navbar-nav > li > .dropdown-menu > li > a:hover,.navbar-default .navbar-nav > li > .dropdown-menu > li > a:focus{color:{$navbar_color4};background-color:{$navbar_color2}}.navbar-default .navbar-nav > li > .dropdown-menu > li.divider{background-color:{$navbar_color2}}.navbar-default .navbar-nav .open .dropdown-menu > .active > a,.navbar-default .navbar-nav .open .dropdown-menu > .active > a:hover,.navbar-default .navbar-nav .open .dropdown-menu > .active > a:focus{color:{$navbar_color4};background-color:{$navbar_color2}}.navbar-default .navbar-nav > .active > a,.navbar-default .navbar-nav > .active > a:hover,.navbar-default .navbar-nav > .active > a:focus{color:{$navbar_color4};background-color:{$navbar_color2}}.navbar-default .navbar-nav > .open > a,.navbar-default .navbar-nav > .open > a:hover,.navbar-default .navbar-nav > .open > a:focus{color:{$navbar_color4};background-color:{$navbar_color2}}.navbar-default .navbar-toggle{border-color:{$navbar_color2}}.navbar-default .navbar-toggle:hover,.navbar-default .navbar-toggle:focus{background-color:{$navbar_color2}}.navbar-default .navbar-toggle .icon-bar{background-color:{$navbar_color3}}.navbar-default .navbar-collapse,.navbar-default .navbar-form{border-color:{$navbar_color3}}.navbar-default .navbar-link{color:{$navbar_color3}}.navbar-default .navbar-link:hover{color:{$navbar_color4}}@media (max-width: 767px){.navbar-default .navbar-nav .open .dropdown-menu > li > a{color:{$navbar_color3}}.navbar-default .navbar-nav .open .dropdown-menu > li > a:hover,.navbar-default .navbar-nav .open .dropdown-menu > li > a:focus{color:$navbar_color4}}.navbar-default .navbar-nav .open .dropdown-menu > .active > a,.navbar-default .navbar-nav .open .dropdown-menu > .active > a:hover,.navbar-default .navbar-nav .open .dropdown-menu > .active > a:focus{color:{$navbar_color4};background-color:{$navbar_color2}}

.navbar-header{padding:0;margin:0;width:80px;}
.navbar-brand{padding:18px 0 0 15px;margin:0;}
.navbar-brand>img{padding:0;margin:0;display:block;height:auto;object-fit:contain;}
.navbar-brand{margin:0;margin:0;}
.navbar-toggle{padding:10px;margin:15px 15px 15px 0;}
.navbar-text{color:white !important;margin:24px 0 0 0;display:inline-block;}
.navbar-text a:link {text-decoration:none;color:white !important;}
.navbar-text a:visited {text-decoration:none;color:white !important;}
.navbar-text a:hover {text-decoration:none;color:white !important;border-bottom:3px solid white;padding-bottom:6px;}
.navbar-text a:active {text-decoration:none;color:white !important;}

/* vertical smartphones */
@media screen and (min-width:360px) and (max-width:752px){.navbar-fixed-top>.container{padding-left:0;}.navbar-text{margin-left:15px;}.navbar-collapse{max-height:100% !important;}}
/* horizontal smartphones and vertical tablets */
@media screen and (min-width:753px) and (max-width:1023px){}
/* horizontal tablets and normal desktops */
@media screen and (min-width:1024px) and (max-width:1199px){}
/* big desktops */
@media screen and (min-width:1200px){}




/* CAROUSEL */
.transition-timer-carousel .carousel-caption {
    background: -moz-linear-gradient(top,  rgba(0,0,0,0) 0%, rgba(0,0,0,0.1) 4%, rgba(0,0,0,0.5) 32%, rgba(0,0,0,1) 100%); /* FF3.6+ */
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0)), color-stop(4%,rgba(0,0,0,0.1)), color-stop(32%,rgba(0,0,0,0.5)), color-stop(100%,rgba(0,0,0,1))); /* Chrome,Safari4+ */
    background: -webkit-linear-gradient(top,  rgba(0,0,0,0) 0%,rgba(0,0,0,0.1) 4%,rgba(0,0,0,0.5) 32%,rgba(0,0,0,1) 100%); /* Chrome10+,Safari5.1+ */
    background: -o-linear-gradient(top,  rgba(0,0,0,0) 0%,rgba(0,0,0,0.1) 4%,rgba(0,0,0,0.5) 32%,rgba(0,0,0,1) 100%); /* Opera 11.10+ */
    background: -ms-linear-gradient(top,  rgba(0,0,0,0) 0%,rgba(0,0,0,0.1) 4%,rgba(0,0,0,0.5) 32%,rgba(0,0,0,1) 100%); /* IE10+ */
    background: linear-gradient(to bottom,  rgba(0,0,0,0) 0%,rgba(0,0,0,0.1) 4%,rgba(0,0,0,0.5) 32%,rgba(0,0,0,1) 100%); /* W3C */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00000000', endColorstr='#000000',GradientType=0 ); /* IE6-9 */
  width: 100%;
  left: 0px;
  right: 0px;
  bottom: 0px;
  text-align: left;
  padding-top: 5px;
  padding-left: 15%;
  padding-right: 15%;
}
.transition-timer-carousel .carousel-caption .carousel-caption-header {
  margin-top: 10px;
  font-size: 24px;
}

@media (min-width: 970px) {
    /* Lower the font size of the carousel caption header so that our caption
    doesn't take up the full image/slide on smaller screens */
  .transition-timer-carousel .carousel-caption .carousel-caption-header {
    font-size: 36px;
  }
}
.transition-timer-carousel .carousel-indicators {
  bottom: 0px;
  margin-bottom: 5px;
}
.transition-timer-carousel .carousel-control {
  z-index: 11;
}
.transition-timer-carousel .transition-timer-carousel-progress-bar {
    height: 5px;
    background-color: #5cb85c;
    width: 0%;
    margin: -5px 0px 0px 0px;
    border: none;
    z-index: 11;
    position: relative;
}
.transition-timer-carousel .transition-timer-carousel-progress-bar.animate{
    /* We make the transition time shorter to avoid the slide transitioning
    before the timer bar is "full" - change the 8s here to fit your
    carousel's transition time */
    -webkit-transition: width 8s linear;
    -moz-transition: width 8s linear;
    -o-transition: width 8s linear;
    transition: width 8s linear;
}













/* TITULOS */
.page-header h1, .page-header-basic h1 {letter-spacing:-.03em;}




#aDiv {
     display: none;
}

.selectized{z-indez:999999999 !important;}


article.poll {
  -webkit-columns: 3 200px;
  -moz-columns: 3 200px;
  columns: 3 200px;
}

article.poll p { margin:0; }

article {
  -webkit-columns: 2 200px;
  -moz-columns: 2 200px;
  columns: 2 200px;
}

article p { margin:0; }



/* LINKS */

h1 a:link, h2 a:link, h3 a:link, h4 a:link, h5 a:link, h6 a:link, p a:link:not(.btn) {color:{$navbar_color1}; text-decoration:none;}
h1 a:visited, h2 a:visited, h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited, p a:visited:not(.btn) {color:{$navbar_color1}; text-decoration:none;}
h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover, p a:hover {color:{$navbar_color2};}
p a:hover {text-decoration:underline;}
h1 a:active, h2 a:active, h3 a:active, h4 a:active, h5 a:active, h6 a:active, p a:active {color:{$navbar_color2};}


/* ICONS */
.attenuate { opacity:0.5; filter:alpha(opacity=50);}




/* BUTTONS */

.btn{display:inline-block;padding:9px 12px;padding-top:7px;margin-bottom:0;font-size:14px;line-height:20px;color:{$navbar_color3};text-align:center;vertical-align:middle;cursor:pointer;background-color:{$navbar_color1};-webkit-border-radius:3px;-moz-border-radius:3px;-ms-border-radius:3px;-o-border-radius:3px;background-image:none!important;border:none;text-shadow:none;box-shadow:none;transition:all .12s linear 0!important;font:14px/20px "Helvetica Neue",Helvetica,Arial,sans-serif}
.btn:hover{color:{$navbar_color4};}
.btn:focus{color:{$navbar_color4};}

.btn-cons {margin-right:5px; min-width:200px; margin-top:8px; margin-bottom:8px;}
.btn-default {color:#333; background-color:#fff; border-color:#ccc;}
.btn-primary {color:#fff; background-color:#428bca; border-color:#357ebd;}
.btn-success {color:#fff; background-color:#5cb85c; border-color: #4cae4c;}
.btn-info {color:#fff; background-color:#5bc0de; border-color:#46b8da;}
.btn-warning {color:#fff; background-color:#f0ad4e; border-color:#eea236;}
.btn-danger {color:#fff; background-color:#d9534f; border-color:#d43f3a;}
.btn-white {color:{$font_color}; background-color:#fff; border:1px solid #e5e9ec;}

.btn-link,.btn-link:active,.btn-link[disabled],fieldset[disabled] .btn-link{background-color:transparent;-webkit-box-shadow:none;-moz-box-shadow:none;-ms-box-shadow:none;-o-box-shadow:none;box-shadow:none}.btn-link,.btn-link:hover,.btn-link:focus,.btn-link:active{border-color:transparent}.btn-link{color:{$navbar_color4};background-color:transparent;border:none}.btn-link,.btn-link:hover,.btn-link:focus,.btn-link:active{border-color:transparent}.btn-default,.btn-primary,.btn-success,.btn-info,.btn-warning,.btn-danger{text-shadow:0 -1px 0 rgba(0,0,0,0.2);-webkit-box-shadow:inset 0 1px 0 rgba(255,255,255,0.15),0 1px 1px rgba(0,0,0,0.075);-moz-box-shadow:inset 0 1px 0 rgba(255,255,255,0.15),0 1px 1px rgba(0,0,0,0.075);-ms-box-shadow:inset 0 1px 0 rgba(255,255,255,0.15),0 1px 1px rgba(0,0,0,0.075);-o-box-shadow:inset 0 1px 0 rgba(255,255,255,0.15),0 1px 1px rgba(0,0,0,0.075);box-shadow:inset 0 1px 0 rgba(255,255,255,0.15),0 1px 1px rgba(0,0,0,0.075)}


ul.share-buttons {list-style:none; padding:0; }
ul.share-buttons li { display:inline; }
ul.share-buttons .sr-only { position:absolute; clip:rect(1px 1px 1px 1px); clip:rect(1px, 1px, 1px, 1px); padding:0; border:0; height:1px; width:1px; overflow:hidden; }


/* FORMS */
#password + .glyphicon, #user_password + .glyphicon { cursor:pointer; pointer-events:all; }

/* RIBBONS */
.side-corner-tag {position:relative; color:#fff; display:inline-block; padding:1px; overflow:hidden; font-size:.1em;}
.side-corner-tag p {display:inline;}
.side-corner-tag p span {position:absolute; top:0; right:-22px; box-shadow:0px 0px 10px rgba(0,0,0,0.2), inset 0px 5px 30px rgba(255,255,255,0.2); width:50px; padding:6px; -webkit-transform:rotate(45deg); -moz-transform:rotate(45deg); -o-transform:rotate(45deg); -ms-transform:rotate(45deg);}
.side-corner-tag p.big span {z-index:1000; position:absolute; top:20px; right:-100px; box-shadow:0px 0px 10px rgba(0,0,0,0.2), inset 0 5px 30px rgba(255,255,255,0.2); width:150px; padding:15px; -webkit-transform:rotate(45deg); -moz-transform:rotate(45deg); -o-transform:rotate(45deg); -ms-transform:rotate(45deg);}
/*.side-corner-tag p span {background:{$navbar_color1};}*/
/*.side-corner-tag p span.danger {background:{$danger_color};}*/
/*.side-corner-tag p span.success {background:{$success_color};}*/


/* CROPPIE */
.croppie-container .cr-viewport {
  position:absolute;
  margin: auto;
  top: 0;
  bottom: 0;
  right: 0;
  left: 0;
  z-index: 0;
}
.croppie-container .cr-slider-wrap {
  width: 100%;
  margin: 0 auto;
  margin-top: 25px;
  text-align: center;
}


/* MEGABUTTONS */
.answers input[type=radio], .answers input[type=checkbox] { display:none; }
.answers input[type=radio] + label, .answers input[type=checkbox] + label {
  display:inline-block;
  width: 100%;
  margin:.2em 0;
  padding: 1em;
  margin-bottom: 0;
  font-size: 2em;
  line-height: 20px;
  color: #333;
  text-align: center;
  text-shadow: 0 1px 1px rgba(255,255,255,0.75);
  vertical-align: middle;
  cursor: pointer;
  background-color: #f5f5f5;
  background-image: -moz-linear-gradient(top,#fff,#e6e6e6);
  background-image: -webkit-gradient(linear,0 0,0 100%,from(#fff),to(#e6e6e6));
  background-image: -webkit-linear-gradient(top,#fff,#e6e6e6);
  background-image: -o-linear-gradient(top,#fff,#e6e6e6);
  background-image: linear-gradient(to bottom,#fff,#e6e6e6);
  background-repeat: repeat-x;
  border: 1px solid #ccc;
  border-color: #e6e6e6 #e6e6e6 #bfbfbf;
  border-color: rgba(0,0,0,0.1) rgba(0,0,0,0.1) rgba(0,0,0,0.25);
  border-bottom-color: #b3b3b3;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffffff',endColorstr='#ffe6e6e6',GradientType=0);
  filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
  -webkit-box-shadow: inset 0 1px 0 rgba(255,255,255,0.2),0 1px 2px rgba(0,0,0,0.05);
  -moz-box-shadow: inset 0 1px 0 rgba(255,255,255,0.2),0 1px 2px rgba(0,0,0,0.05);
  box-shadow: inset 0 1px 0 rgba(255,255,255,0.2),0 1px 2px rgba(0,0,0,0.05);
  }
.answers input[type=radio]:checked + label, .answers input[type=checkbox]:checked + label {
  background-image: none;
  outline: 0;
  -webkit-box-shadow: inset 0 2px 4px rgba(0,0,0,0.15),0 1px 2px rgba(0,0,0,0.05);
  -moz-box-shadow: inset 0 2px 4px rgba(0,0,0,0.15),0 1px 2px rgba(0,0,0,0.05);
  box-shadow: inset 0 2px 4px rgba(0,0,0,0.15),0 1px 2px rgba(0,0,0,0.05);
  background-color:#e0e0e0;
  }



/* LIST OF ERRORS */

ul.error-list {list-style:none; padding:0; margin:0;}
ul.error-list li {padding-left:16px;}
ul.error-list li:before {content:"»"; padding-right:8px;}






/* MORE BOOTSTRAP STUFF */
.page-header{margin-top:0 !important;}
.page-header h1{margin-top:0 !important;}
.main-container{padding-bottom:8em;}
.post p:first-of-type::first-letter{float:left; font-size:6em; margin:.1em .1em .1em 0;}

.min_programa {margin-bottom:30px;}
.pastilla {display:flex; justify-content:center; overflow: hidden; padding-bottom:0;}
pastilla-premios {height:350px;}
pastilla-fila1 {height:350px;}
.pastilla h3 {position:absolute; padding:.6em; bottom:0; left:0; background:{$navbar_color1};}
.pastilla h3 a:link, .pastilla h3 a:visited, .pastilla h3 a:hover, .pastilla h3 a:active {color:{$navbar_color3} !important; text-decoration:none;}
.pastilla h3 a:hover {color:white; text-decoration:none;}
.pastilla p.foto {color:white; position:absolute; top:1em; left:1em;}

@media (min-device-width:320px) and (orientation:portrait) { /* Móvil Iago */
  .page-header-basic h1{font-size:1.9em;}
  .pastilla-premios {height:180px;}
  .pastilla h3 {font-size:.8em; letter-spacing:-.02em; line-height:.8em;}
  .pastilla p.foto {font-size:.5em; letter-spacing:-.02em;}
  }
@media (min-device-width:534px) and (orientation:landscape) { /* Móvil Iago horizontal */
  .pastilla h3 {font-size:1.3em; letter-spacing:-.02em; line-height:.8em;}
  .pastilla p.foto {}
  }
@media (min-device-width:360px) and (orientation:portrait) { /* Mi móvil */
  .pastilla-premios {height:215px;}
  .pastilla h3 {font-size:.8em; letter-spacing:-.02em; line-height:.8em;}
  .pastilla p.foto {font-size:.5em; letter-spacing:-.02em;}
  }
@media (min-device-width:640px) and (orientation:landscape) { /* Mi móvil horizontal */
  .pastilla h3 {font-size:1.3em; letter-spacing:-.02em; line-height:.8em;}
  .pastilla p.foto {font-size:.6em; letter-spacing:-.02em;}
  }
@media (min-device-width:800px) and (orientation:portrait) { /* Mi tableta vertical */
  .pastilla-premios {height:430px;}
  .pastilla-fila1 {height:160px}
  .pastilla-premios h3 {font-size:1.6em; letter-spacing:-.02em; line-height:1em;}
  .pastilla-fila1 h3 {font-size:1em; letter-spacing:-.02em; line-height:.8em;}
  .pastilla p.foto {font-size:.8em; letter-spacing:-.02em;}
  }
@media (min-device-width:1024px) and (orientation:landscape) {
  .pastilla h3 {font-size:1.3em; letter-spacing:-.02em; line-height:.8em;}
  .pastilla h3 a:link, .pastilla h3 a:visited, .pastilla h3 a:hover, .pastilla h3 a:active {color:pink !important;}
  .pastilla p.foto {}
  }
@media (min-device-width:1280px) {
  .pastilla-premios {height:350px}
  .pastilla-fila1 {height:244px}
  .pastilla-premios h3 {font-size:1.5em; letter-spacing:-.02em; line-height:.8em;}
  .pastilla-fila1 h3 {font-size:1.1em; letter-spacing:-.02em; line-height:.8em;}
  .pastilla p.foto {font-size:.6em; letter-spacing:-.02em;}
  }


.white-panel {background:#fff; box-shadow:1px 1px 10px rgba(0,0,0,0.3);}
.white-panel h4 {font-size:1em;}
.white-panel h4 a {color:#A92733; text-decoration:none;}
.white-panel h4 a:hover {text-decoration:underline;}
.white-panel .txt {padding:0 10px;}
.white-panel:hover {box-shadow:1px 1px 10px rgba(0,0,0,0.7); -webkit-transition:all 0.3s ease-in-out; -moz-transition:all 0.3s ease-in-out; -ms-transition:all 0.3s ease-in-out; -o-transition:all 0.3s ease-in-out; transition:all 0.3s ease-in-out;}

.table > tbody > tr > td{vertical-align:middle;}
.table th {background:#f5f5f5;padding:1em .5em !important;}
.table td {padding:1em .5em !important;}
.table .nowrap{white-space:nowrap;}

.ui-sortable-helper {box-shadow:0 2px 10px rgba(0,0,0,0.45);}
.sortable {clear:left; margin:0; padding:0; width:100%;}
.sortable .head {max-width:100%; display:table-header-group;}
.sortable .sortable-item {user-select:none; -moz-user-select:none; -webkit-user-select:none; cursor:-webkit-grab; cursor:-moz-grab; cursor:grab; display:table-row-group; border:none; background:white; margin:0; padding:0; max-width:100%; vertical-align:middle;}
.sortable .sortable-item:active {cursor:-webkit-grabbing; cursor:-moz-grabbing; cursor:grabbing;}



/* Sticky footer */

footer{position:absolute; bottom:0; width:100%; height:{$sticky_footer}px; background-color:#f5f5f5; border-top:1px solid #ccc;}
.container-footer {padding:0;}
.container-footer h5 {}



.caldate {font-family:'Fredoka One', cursive !important; float:left; height:52px; width:52px; background:url('../img/date.png') no-repeat; margin-right:15px; padding-top:0px; line-height:normal;}
.caldate .calmonth { display:block; text-align:center; color:#fff; font-size:.8em; line-height:1em; padding-top:5px; text-transform:uppercase; }
.caldate .calday { display:block; text-align:center; padding-top:8px; color:#222; font-size:2em; line-height:.8em; font-weight:bold; }

.blog-post p:first-of-type::first-letter{float:left; font-size:5em; margin:.1em .2em 0 0;}
.blog-post p{margin-bottom:1.5em;}
.blog-post ul.share-buttons {list-style:none; padding:0; }
.blog-post ul.share-buttons li { display:inline; }
.blog-post ul.share-buttons .sr-only { position:absolute; clip:rect(1px 1px 1px 1px); clip:rect(1px, 1px, 1px, 1px); padding:0; border:0; height:1px; width:1px; overflow:hidden; }


ENDCSS;
?>
