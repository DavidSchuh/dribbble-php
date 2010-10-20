<?php
/**
 * Examples for using the Dribbble API PHP wrapper
 *
 * @author Martin Bean <martin@mcbwebdesign.co.uk>
 */

//error_reporting(E_ALL); 
//ini_set("display_errors", 1); 

require_once('../src/dribbble.php');

$dribbble = new Dribbble();

# find a shot
$shot = $dribbble->shot->find(21603);

# see some data about the shot
$shot->title;
$shot->image_url;
$shot->url;
$shot->player->name;

# Find more shots
# inspiring       = $dribbble->shot->popular();
# call_the_police = $dribbble->shot->everyone();
# yay_noobs       = $dribbble->shot->debuts();

# Paginate through shots (default is 15 per page, max 30)
$dribbble->shot->popular(array('page' => 2, 'per_page' => 3));
$dribbble->shot->everyone(array('page' => 10, 'per_page' => 5));
$dribbble->shot->debuts(array('page' => 5, 'per_page' => 30));

# Find a player
$player = $dribbble->player->find('zachdunn');

# See some data about the player
$player->name;
$player->avatar_url;
$player->url;
$player->location;

# List a player's shots
$player->shots();
$player->shots(array('page' => 2, 'per_page' => 10));

# List shots by player's that this player follows
$player->following(array('page' => 5, 'per_page' => 30));

# Loop through some of your shots
$shots = $player->shots();
$i = 0;
$limit = 2;
foreach($shots->shots as $shot){ 
  if ($i < $limit){
    # For each shot do some stuff
    # $image = $shot->image_teaser_url;
    # $title = $shot->title;
    # $shoturl = $shot->url;
    # echo '<a href="'.$shoturl.'"><img src="'.$image.'" alt="'.$title.'" title="'.$title.'" /></a>';
  }
  ++$i;
}

# Streamlined version of the above example if we wanted two shots only...
$shots = $player->shots(array('per_page' => 2));
foreach ($shots->shots as $shot) {
	echo sprintf('<a href="%s"><img src="%s" alt="%s" /></a>', $shot->url, $shot->image_teaser_url, $shot->title);
}

?>