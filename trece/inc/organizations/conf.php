<?php if(!defined("TRECE")):header("location:/");die();endif; ?>
<?php
//ORGANIZATIONS

# ......................................................................................................................
# ...#######..########...######......###....##....##.####.########....###....########.####..#######..##....##..######...
# ..##.....##.##.....##.##....##....##.##...###...##..##.......##....##.##......##.....##..##.....##.###...##.##....##..
# ..##.....##.##.....##.##.........##...##..####..##..##......##....##...##.....##.....##..##.....##.####..##.##........
# ..##.....##.########..##...####.##.....##.##.##.##..##.....##....##.....##....##.....##..##.....##.##.##.##..######...
# ..##.....##.##...##...##....##..#########.##..####..##....##.....#########....##.....##..##.....##.##..####.......##..
# ..##.....##.##....##..##....##..##.....##.##...###..##...##......##.....##....##.....##..##.....##.##...###.##....##..
# ...#######..##.....##..######...##.....##.##....##.####.########.##.....##....##....####..#######..##....##..######...
# ......................................................................................................................

// http://patorjk.com/software/taag/#p=display&f=Banner4&t=%20TRECE%20
// http://patorjk.com/software/taag/#p=display&f=Bright&t=Deprecated
// https://stackoverflow.com/questions/8154158/mysql-how-do-i-use-delimiters-in-triggers













return [

  "file" => [
    "ref"               => "url_name",  # File ref
    ],

  "default" => [
    "id_status"         => 0,
    "name"              => "Nueva organización",
    "max_new_items"     => 15,
    ],

  "img" => [
    "ref"               => "ref",           # Image ref
    "prefix"            => "org_",          # Croppie prefix
    "canvas_w"          => 666,            # Croppie canvas width
    "canvas_h"          => 666,             # Croppie canvas height
    "viewport_w"        => 666,             # Croppie viewport width
    "viewport_h"        => 666,             # Croppie viewport height
    "img_w"             => 666,            # PHP GD image width
    "img_h"             => 666,             # PHP GD image height
    "icon_w"            => 333,             # PHP GD icon width
    "icon_h"            => 333,             # PHP GD icon height
    "thumb_w"           => 90,              # PHP GD thumb width
    "thumb_h"           => 90,              # PHP GD thumb height
    "post_max_img"      => 1200,            # For images uploaded to post
    "post_max_icon"     => 600,             # For images uploaded to post
    "post_max_thumb"    => 120,             # For images uploaded to post

    "w_loo"            => 333,
    "h_loo"            => $h_loo=333,
    "viewport_loo_w"   => 333,
    "viewport_loo_h"   => 333,
    "modal_loo_h"      => $h_loo+75,
    ],

  ];

?>
