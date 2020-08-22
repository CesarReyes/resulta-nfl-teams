# Resulta NFL Teams WordPress plugin

Display a dynamic list of NFL teams on a page on your website.  

## Features

* Gutenberg block: you can include the list in whatever post or page you want just look for the block `NFL teams` in the widgets section.

* Shortcode for those who don't have Gutenberg available in your WordPress just insert the shorcode `[nfl-teams]`.

## How the data is ingested and maintained

The dynamic list is loaded from an external source;  The performance and data availability is important and that is why we store the data into WordPress transient cache and we reload every 15 minutes.  

## Configurations

All the plugins configurations are stored in the Wordpress options and usually are accesibles via eternal options manager plugin or you just can go to: `https://[host]/wp-admin/options.php`.  

Note: The plugin is preloaded with default API key  

* API KEY: `resulta-nfl-api-key`
* API ENDPOINT: `resulta-nfl-endpoint`
* Cache life: `resulta-nfl-cache-expire` in Minutes (Default 15)

## Important code pieces

* [Gutenberg block](https://github.com/CesarReyes/resulta-nfl-teams/blob/master/src/block/block.js)

* [Render and API call](https://github.com/CesarReyes/resulta-nfl-teams/blob/master/src/includes/nfl-block.php)

This project was bootstrapped with [Create Guten Block](https://github.com/ahmadawais/create-guten-block).
