# PoC proxying to GCP Buckets from Pantheon

## Description

This wordpress plugin set up a proxy for all routes using the 

### Usage

#### Add the plugin to the most used plugins directory

```bash

/wp-content/mu-plugins
```

Add a new file named `wp-hacky-proxy.php` on your `/wp-content/mu-plugins` directory, containing the following PHP code.

```php
<?php

// Autoload composer dependencies
require $_ENV['HOME'] . '/code/wp-content/mu-plugins/hacky-proxy/vendor/autoload.php';

// Create new PantheonToGCPBucket instance
$hackyproxy = new \Stevector\HackyProxy\PantheonToGCPBucket();

// Using a single forward configuration
$hackyproxy
  ->setSite('pantheon-proxy-wordpress') // pantheon site
  ->setEnvironment('dev') // pantheon environment
  ->setFramework('wordpress') // pantheon framework `wordpress` or `drupal`
  ->setForwards(
    [
      [
        'path' => '/',
        'url' => 'http://{site}.static.artifactor.io',
        'prefix' => '{site}--{environment}',
      ]
    ]
  )
  ->forward();

// Using a more complex forward configuration
$hackyproxy
  ->setSite('pantheon-rogers-funny-words') // pantheon site
  ->setEnvironment('dev') // pantheon environment
  ->setFramework('wordpress') // pantheon framework
  ->setHash('b54df3e') // pantheon hash
  ->setHashEnabled(true) // pantheon hash-flag
  ->setCacheDisabled(true) // cache-control
  ->setForwards(
    [
      [
        'path' => '/static/',
        'url' => 'http://{site}.static.artifactor.io',
        'prefix' => '{site}--{environment}',
      ],
      [
        'path' => '/',
        'url' => 'https://us-central1-webops-prototypes.cloudfunctions.net',
        'prefix' => '{site}--{environment}',
      ],
    ]
  )
  ->forward();
```

Add on the `autotload` section of your `composer.json` file the following configuration.

```json
"files": [
  "proxy-loader.php"
]
```
