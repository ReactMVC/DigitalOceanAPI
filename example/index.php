<?php
use DigitalOcean\Api;
require 'vendor/autoload.php';

// Your digital ocean token
$token = 'your_digital_ocean_token';

// Create an instance of the DigitalOceanAPI class
$doApi = new Api($token);


// Create a new droplet ( $name, $region, $size, $imageId )
$dropletData = $doApi->createDroplet('example-droplet', 'nyc3', 's-1vcpu-1gb', 'ubuntu-16-04-x64');

// Get information about a droplet
$dropletInfo = $doApi->getDroplet(123456);

// Delete a droplet
$doApi->deleteDroplet(123456);

// Rename a droplet
$renamedDroplet = $doApi->renameDroplet(123456, 'new-example-droplet-name');

// Reboot a droplet
$rebootedDroplet = $doApi->rebootDroplet(123456);

// Resize a droplet
$resizedDroplet = $doApi->resizeDroplet(123456, 's-2vcpu-2gb');