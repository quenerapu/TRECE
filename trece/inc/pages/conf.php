<?php if(!defined("TRECE")):header("location:/");die();endif; ?>
<?php
//PAGES

# ...................................................
# ..########.....###.....######...########..######...
# ..##.....##...##.##...##....##..##.......##....##..
# ..##.....##..##...##..##........##.......##........
# ..########..##.....##.##...####.######....######...
# ..##........#########.##....##..##.............##..
# ..##........##.....##.##....##..##.......##....##..
# ..##........##.....##..######...########..######...
# ...................................................

// http://patorjk.com/software/taag/#p=display&f=Banner4&t=%20TRECE%20
// http://patorjk.com/software/taag/#p=display&f=Bright&t=Deprecated
// https://stackoverflow.com/questions/8154158/mysql-how-do-i-use-delimiters-in-triggers













return [

  "file" => [
//  "ref"               => "ids_breadcrumb_trail",       # File ref
    "ref"               => "path",                       # File ref
    ],

  "default" => [
    "id_status"         => 0,
    "title_en"          => "New page",
    "title_gal"         => "Nova páxina",
    "title_es"          => "Nueva página",
    "url_title"         => "new-page",
    "max_new_items"     => 15,
    ],

  "img" => [
    "ref"               => "ref",         # Image ref
    "prefix"            => "page_",       # Croppie prefix
//  "canvas_w"          => 1600,          # Croppie canvas width
//  "canvas_h"          => 900,           # Croppie canvas height

//  "viewport_w"        => 390,           # Croppie viewport width
//  "viewport_h"        => 219,           # Croppie viewport height

//  "img_w"             => $img_w=1600,   # PHP GD image width
//  "img_h"             => $img_h = 900,  # PHP GD image height

//  "icon_w"            => $icon_w = $img_w/2,      # PHP GD icon width
//  "icon_h"            => $icon_h = $img_h/2,      # PHP GD icon height

//  "modal_h"           => $icon_h+600,

    "thumb_w"           => 150,           # PHP GD thumb width
    "thumb_h"           => 150,           # PHP GD thumb height






    "post_max_img"      => 1200,          # For images uploaded to post
    "post_max_icon"     => 600,           # For images uploaded to post
    "post_max_thumb"    => 120,           # For images uploaded to post


    "w_mob"             => 160,
    "h_mob"             => $h_mob=260,
    "w_web"             => 427,
    "h_web"             => $h_web=133,
    "viewport_mob_w"    => 320,
    "viewport_mob_h"    => 520,
    "viewport_web_w"    => 1280,
    "viewport_web_h"    => 400,
    "modal_mob_h"       => $h_mob+75,
    "modal_web_h"       => $h_web+75,


    ],

  ];

?>
