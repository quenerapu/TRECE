<?php if(!defined("TRECE")):header("location:./");die();endif; ?>
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

    "img_w"             => $img_w=1280,   # PHP GD image width
    "img_h"             => $img_h=400,    # PHP GD image height
    "thumb_w"           => 300,           # PHP GD thumb width
    "thumb_h"           => 200,           # PHP GD thumb height

    "post_max_img"      => 1200,          # For images uploaded in post field
    "post_max_icon"     => 600,           # For images uploaded in post field
    "post_max_thumb"    => 120,           # For images uploaded in post field

    "w_mob"             => 160,           # For the modal window
    "h_mob"             => $h_mob=260,    # For the modal window
    "modal_mob_h"       => $h_mob+75,     # For the modal window
    "w_web"             => 427,           # For the modal window
    "h_web"             => $h_web=133,    # For the modal window
    "modal_web_h"       => $h_web+75,     # For the modal window

    "viewport_mob_w"    => 320,           # Croppie viewport
    "viewport_mob_h"    => 520,           # Croppie viewport
    "viewport_web_w"    => 1280,          # Croppie viewport
    "viewport_web_h"    => 400,           # Croppie viewport

    ],

  ];

?>
