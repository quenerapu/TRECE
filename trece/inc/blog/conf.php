<?php if(!defined("TRECE")):header("location:/");die();endif; ?>
<?php
//BLOG

# ..........................................
# ..########..##........#######...######....
# ..##.....##.##.......##.....##.##....##...
# ..##.....##.##.......##.....##.##.........
# ..########..##.......##.....##.##...####..
# ..##.....##.##.......##.....##.##....##...
# ..##.....##.##.......##.....##.##....##...
# ..########..########..#######...######....
# ..........................................

// http://patorjk.com/software/taag/#p=display&f=Banner4&t=%20TRECE%20
// http://patorjk.com/software/taag/#p=display&f=Bright&t=Deprecated
// https://stackoverflow.com/questions/8154158/mysql-how-do-i-use-delimiters-in-triggers













return [

  "file" => [
    "ref"               => "url_title_en",  # File ref
    ],

  "default" => [
    "id_status"         => 0,
    "title_en"          => "New post",
    "url_title_en"      => date("Y-m-d")."-new-post",
    "title_gal"         => "Nova entrada",
    "url_title_gal"     => date("Y-m-d")."-nova-entrada",
    "title_es"          => "Nueva entrada",
    "url_title_es"      => date("Y-m-d")."-nueva-entrada",
    "date"              => date("Y-m-d"),
    "max_new_items"     => 15,
    ],

  "img" => [
    "ref"               => "ref",           # Image ref
    "prefix"            => "blogpost_",     # Croppie prefix
    "canvas_w"          => 1600,            # Croppie canvas width
    "canvas_h"          => 900,             # Croppie canvas height
    "viewport_w"        => 390,             # Croppie viewport width
    "viewport_h"        => 219,             # Croppie viewport height
    "img_w"             => 1600,            # PHP GD image width
    "img_h"             => 900,             # PHP GD image height
    "icon_w"            => 400,             # PHP GD icon width
    "icon_h"            => 225,             # PHP GD icon height
    "thumb_w"           => 160,             # PHP GD thumb width
    "thumb_h"           => 90,              # PHP GD thumb height
    "post_max_img"      => 1200,            # For images uploaded to post
    "post_max_icon"     => 600,             # For images uploaded to post
    "post_max_thumb"    => 120,             # For images uploaded to post
    ],

  ];

?>
