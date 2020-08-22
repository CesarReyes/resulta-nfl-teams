# Resulta NFL Teams WordPress plugin

Display a dynamic list of NFL teams on a page on your website.  

WordPress Version: 5.0 or higher  

[Donwnload](https://github.com/CesarReyes/resulta-nfl-teams/releases/tag/v1.0)

## Features

* Gutenberg block: You can include the list in whatever post or page you want just look for the block `NFL teams` in the widgets section, insert it the content and Voila!.  

* Shortcode: For those who don't have Gutenberg available in your WordPress just insert the shortcode `[nfl-teams]`.  

## How the data is ingested and maintained

The dynamic list is loaded from an external source;  The performance and data availability is important and that is why we store the data into WordPress transient cache and we reload every 15* minutes.  

###### *You can control the cache time using the plugin options. See below

## Presentation and SEO

The list presented is grouped by conference following the same style from the official NFL website <https://www.nfl.com/teams/> and there is no necessary other sorting or grouping because of the small the size of the data and for the users is easy to find what the are looking for.  

In terms of SEO we use an "eaasy to read" HTML content structure for the Search engine crawlers.  

## Configurations

All the plugin configurations are stored in the Wordpress options and usually are accesibles via an external options manager plugin or you just can go to: `https://[host]/wp-admin/options.php`.  

Note: The plugin is preloaded with default API key  

* API KEY: `resulta-nfl-api-key`
* API ENDPOINT: `resulta-nfl-endpoint`
* Cache life: `resulta-nfl-cache-expire` in Minutes (Default 15)

## Important code pieces

* [Gutenberg block](https://github.com/CesarReyes/resulta-nfl-teams/blob/master/src/block/block.js)

* [Render and API call](https://github.com/CesarReyes/resulta-nfl-teams/blob/master/src/includes/nfl-block.php)

This project was bootstrapped with [Create Guten Block](https://github.com/ahmadawais/create-guten-block).
