<?php

use App\Lock;
use GeneaLabs\LaravelMaps\Map;

$app = require __DIR__.'/../bootstrap/app.php';
$app->boot();

$location = "Paris, France";
$name = "Jack and Jill";
$date_locked = "May 1st, 2019";
$message = "To my true love.";
$image_url = "./images/main-image.png";
$image_map_url = "./images/placeholder-map.png";

if(isset($_REQUEST['id'])) {
    $lock = Lock::find($_REQUEST['id']);
    if($lock){
        $location = $lock->latitude . ", " . $lock->longitude;
        $name = $lock->names;
        $date_locked = $lock->date_locked;
        $message = $lock->message;
        $image_url = $lock->lock_image_url;


        //For Google Maps
        $config = array();
        $config['center'] = $lock->latitude . ", " . $lock->longitude;
        $config['zoom'] = 10;
//        $config['onboundschanged'] = 'if (!centreGot) {
//            var mapCentre = map.getCenter();
//            marker_0.setOptions({
//                position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng())
//            });
//        }
//        centreGot = true;';

        $mapObject = new Map();
        $mapObject->apiKey = $_ENV['GOOGLE_MAPS_API_KEY'];

        $mapObject->initialize($config);

// set up the marker ready for positioning
// once we know the users location
        $marker = array();
        $marker['position'] = $lock->latitude . ", " . $lock->longitude;
        $mapObject->add_marker($marker);

        $map = $mapObject->create_map();
    }
}





/*$app->load->library('googlemaps');

$config['center'] = '37.4419, -122.1419';
$config['zoom'] = 'auto';
$this->googlemaps->initialize($config);

$marker = array();
$marker['position'] = '37.429, -122.1419';
$this->googlemaps->add_marker($marker);
$data['map'] = $this->googlemaps->create_map();

$this->load->view('view_file', $data);*/
?>

<!DOCTYPE html>
<html>
    <head>

        <meta charset="utf-8"/>
        <link href="./css/view-lock.css" rel="stylesheet" type="text/css"/>
        <?php
            if(isset($map)) {
                echo $map['js'];
            }
        ?>
    </head>
    <body>
        <div class="wrapper">
            <div class="column fill">
                <img src="<?= $image_url?>"/>
            </div>
            <div class="column">
                <div class="lock-details">
                    <div class="fill map">
                        <?php
                            if(isset($map)) {
                                echo $map['html'];
                            }else{
                                echo "<img src=\"" . $image_map_url . "/>";
                            }
                        ?>
                    </div>
                    <div class="lock-details-text">
                        <div class="lock-details-text-row">
                            <div class="field-label">Location</div>
                            <div class="field-value"><?= $location;?></div>
                        </div>
                        <div class="lock-details-text-row">
                            <div class="field-label">Name</div>
                            <div class="field-value"><?= $name;?></div>
                        </div>
                        <div class="lock-details-text-row">
                            <div class="field-label">Date Locked</div>
                            <div class="field-value"><?= $date_locked;?></div>
                        </div>
                        <div class="lock-details-text-row">
                            <div class="field-label">Message</div>
                            <div class="field-value"><?= $message;?></div>
                        </div>
                    </div>
                </div>
                <div class="badge">
                    <img src="./images/app-store-badge.png"/>
                </div>
            </div>
        </div>
    </body>
</html>