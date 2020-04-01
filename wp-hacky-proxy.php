<?php

/**
 * Plugin Name: Hacky Proxy
 * Description: PoC proxying to GCP Buckets from Pantheon.
 */

// Autoload composer dependencies
require $_ENV['HOME'] . '/code/wp-content/mu-plugins/wp-hacky-proxy/vendor/autoload.php';

// Create new PantheonToGCPBucket instance
$hackyproxy = new \Stevector\HackyProxy\PantheonToGCPBucket();

// Copy needed configuration from README.md
