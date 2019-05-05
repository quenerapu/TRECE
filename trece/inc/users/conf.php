<?php if(!defined("TRECE")):header("location:/");die();endif; ?>
<?php
//USERS

# ..................................................
# ..##.....##..######..########.########...######...
# ..##.....##.##....##.##.......##.....##.##....##..
# ..##.....##.##.......##.......##.....##.##........
# ..##.....##..######..######...########...######...
# ..##.....##.......##.##.......##...##.........##..
# ..##.....##.##....##.##.......##....##..##....##..
# ...#######...######..########.##.....##..######...
# ..................................................

// http://patorjk.com/software/taag/#p=display&f=Banner4&t=%20TRECE%20
// http://patorjk.com/software/taag/#p=display&f=Bright&t=Deprecated
// https://stackoverflow.com/questions/8154158/mysql-how-do-i-use-delimiters-in-triggers













return [

  "file" => [
    "ref"               => "username",    # File ref
    ],

  "default" => [
    "id_status"         => 0,
    "uhierarchy"        => 2,
    "name"              => "Name",
    "surname"           => "Surname",
    "username"          => "new-user",
    "ugender"           => "m",
    "email"             => "NO_EMAIL",
    "max_new_items"     => 15,
    ],

  "img" => [
    "ref"               => "ref",         # Image ref
    "prefix"            => "avatar_",     # Croppie prefix
    "canvas_w"          => 800,           # Croppie canvas width
    "canvas_h"          => 800,           # Croppie canvas height
    "viewport_w"        => 200,           # Croppie viewport width
    "viewport_h"        => 200,           # Croppie viewport height
    "img_w"             => 800,           # PHP GD image width
    "img_h"             => 800,           # PHP GD image height
    "icon_w"            => 300,           # PHP GD icon width
    "icon_h"            => 300,           # PHP GD icon height
    "thumb_w"           => 120,           # PHP GD thumb width
    "thumb_h"           => 120,           # PHP GD thumb height
    "bio_max_img"       => 1200,          # For images uploaded to bio
    "bio_max_icon"      => 600,           # For images uploaded to bio
    "bio_max_thumb"     => 120,           # For images uploaded to bio
    ],

  ];

?>