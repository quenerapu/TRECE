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
    "ref"               => "ids_breadcrumb_trail",       # File ref
    ],

  "default" => [
    "id_status"         => 0,
    "title"             => "New page",
    "url_title"         => "new-page",
    "max_new_items"     => 15,
    ],

  "img" => [
    "ref"               => "ref",         # Image ref
    "prefix"            => "page_",       # Croppie prefix
    "canvas_w"          => 1600,          # Croppie canvas width
    "canvas_h"          => 900,           # Croppie canvas height
    "viewport_w"        => 390,           # Croppie viewport width
    "viewport_h"        => 219,           # Croppie viewport height
    "img_w"             => 1600,          # PHP GD image width
    "img_h"             => 900,           # PHP GD image height
    "icon_w"            => 400,           # PHP GD icon width
    "icon_h"            => 225,           # PHP GD icon height
    "thumb_w"           => 160,           # PHP GD thumb width
    "thumb_h"           => 90,            # PHP GD thumb height
    "post_max_img"      => 1200,          # For images uploaded to post
    "post_max_icon"     => 600,           # For images uploaded to post
    "post_max_thumb"    => 120,           # For images uploaded to post
    ],

  ];

?>
