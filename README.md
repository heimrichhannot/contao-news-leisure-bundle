# Contao News Leisure Bundle

[![Latest Stable Version](https://poser.pugx.org/heimrichhannot/contao-news-leisure-bundle/v/stable)](https://packagist.org/packages/heimrichhannot/contao-news-leisure-bundle)
[![Total Downloads](https://poser.pugx.org/heimrichhannot/contao-news-leisure-bundle/downloads)](https://packagist.org/packages/heimrichhannot/contao-news-leisure-bundle)

This bundle extends the contao news entity with leisure tipps. 

## Features
- custom palettes for [News Bundle](https://github.com/heimrichhannot/contao-news-bundle)
- Items and Trait for [List Bundle](https://github.com/heimrichhannot/contao-list-bundle) and [Reader Bundle](https://github.com/heimrichhannot/contao-reader-bundle)
- upload kml files and display on a map with [Google Maps Bundle](https://github.com/heimrichhannot/contao-google-maps-bundle)
- generate coordinates for addresses


## Usage

### Install 

```
composer require heimrichhannot/contao-news-leisure-bundle
```

You need to update the database after install.

### Setup

#### Add palettes to your news entity

##### With News Bundle

Go to news archives and select 'leisuretip' or 'leisuretip_stage' as palette. 

##### Without news bundle

Add `leisuretip` or `leisuretip_stage` palette content by yourself to your tl_news palette.

#### List/Reader Bundle

Select `news_leisure` item class or add `NewsLeisureItemTrait` to your custom item class.

#### Coordinates calculation

Set your google maps api key in contao settings.
