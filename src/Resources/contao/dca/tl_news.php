<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2015 Heimrich & Hannot GmbH
 *
 * @package news_plus
 * @author  Rico Kaltofen <r.kaltofen@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */

$dc = &$GLOBALS['TL_DCA']['tl_news'];

$leisurePalette = '{venue_legend:hide},addVenues,addArrivalInfo;{touristInfo_legend:hide},addTouristInfo;{trailInfo_legend:hide},addTrailInfo;{openingHours_legend:hide},addOpeningHours;{ticketprice_legend:hide},addTicketPrice;';
$leisureStagePalette = '{venue_legend:hide},addVenues;{trailInfo_legend:hide},addTrailInfo;';


/**
 * Selectors
 */
$dc['palettes']['__selector__'][] = 'addVenues';
$dc['palettes']['__selector__'][] = 'addTouristInfo';
$dc['palettes']['__selector__'][] = 'addOpeningHours';
$dc['palettes']['__selector__'][] = 'addTicketPrice';
$dc['palettes']['__selector__'][] = 'addArrivalInfo';
$dc['palettes']['__selector__'][] = 'addTrailInfo';
$dc['palettes']['__selector__'][] = 'addTrailInfoDistance';
$dc['palettes']['__selector__'][] = 'addTrailInfoDuration';
$dc['palettes']['__selector__'][] = 'addTrailInfoAltitude';
$dc['palettes']['__selector__'][] = 'addTrailInfoDifficulty';
$dc['palettes']['__selector__'][] = 'addTrailInfoStartDestination';
$dc['palettes']['__selector__'][] = 'addTrailInfoKmlData';


/**
 * Palettes
 */
$dc['palettes']['leisuretip'] = str_replace('addImage;', 'addImage;'.$leisurePalette, $dc['palettes']['default']);
$dc['palettes']['leisuretip'] = str_replace('author;', 'author,categories;', $dc['palettes']['leisuretip']);
$dc['palettes']['leisuretip_stage'] = str_replace('addImage;', 'addImage;'.$leisureStagePalette, $dc['palettes']['default']);
$dc['palettes']['leisuretip_stage'] = str_replace('author;', 'author,categories;', $dc['palettes']['leisuretip_stage']);

/**
 * Subpalettes
 */
$dc['subpalettes']['addVenues']                    = 'venues';
$dc['subpalettes']['addArrivalInfo']               = 'arrivalName,arrivalStreet,arrivalPostal,arrivalCity,arrivalCountry,arrivalSingleCoords,arrivalText';
$dc['subpalettes']['addTouristInfo']               = 'touristInfoName,touristInfoPhone,touristInfoFax,touristInfoEmail,touristInfoWebsite,touristInfoText';
$dc['subpalettes']['addTrailInfo']                 =
    'addTrailInfoDistance,addTrailInfoDuration,addTrailInfoAltitude,addTrailInfoDifficulty,addTrailInfoStartDestination,addTrailInfoKmlData';
$dc['subpalettes']['addOpeningHours']              = 'openingHoursText';
$dc['subpalettes']['addTicketPrice']               = 'ticketPriceText';
$dc['subpalettes']['addTrailInfoDistance']         = 'trailInfoDistanceMin,trailInfoDistanceMax';
$dc['subpalettes']['addTrailInfoDuration']         = 'trailInfoDurationMin,trailInfoDurationMax';
$dc['subpalettes']['addTrailInfoAltitude']         = 'trailInfoAltitudeMin,trailInfoAltitudeMax';
$dc['subpalettes']['addTrailInfoDifficulty']       = 'trailInfoDifficultyMin,trailInfoDifficultyMax';
$dc['subpalettes']['addTrailInfoStartDestination'] = 'trailInfoStart,trailInfoDestination';
$dc['subpalettes']['addTrailInfoKmlData']          = 'trailInfoKmlData,trailInfoShowElevationProfile';


/**
 * Fields
 */
$arrFields = [
    // venue
    'addVenues'                     => [
        'label'     => &$GLOBALS['TL_LANG']['tl_news']['addVenues'],
        'exclude'   => true,
        'inputType' => 'checkbox',
        'eval'      => ['submitOnChange' => true],
        'sql'       => "char(1) NOT NULL default ''",
    ],
    'venues'                        => [
        'label'        => &$GLOBALS['TL_LANG']['tl_news']['venues'],
        'inputType'    => 'fieldpalette',
        'foreignKey'   => 'tl_fieldpalette.id',
        'relation'     => ['type' => 'hasMany', 'load' => 'eager'],
        'sql'          => "blob NULL",
        'fieldpalette' => [
            'list'     => [
                'label' => [
                    'fields' => ['venueName', 'venueStreet', 'venuePostal', 'venueCity'],
                    'format' => '%s <span style="color:#b3b3b3;padding-left:3px">[%s, %s %s]</span>',
                ],
            ],
            'palettes' => [
                'default' => '{venue_address_legend},venueName,venueStreet,venuePostal,venueCity,venueCountry,venueSingleCoords;{venue_contact_legend},venuePhone,venueFax,venueEmail,venueWebsite;{venue_text_legend},venueText',
            ],
            'fields'   => [
                'venueName'         => [
                    'label'     => &$GLOBALS['TL_LANG']['tl_news']['venueName'],
                    'exclude'   => true,
                    'search'    => true,
                    'inputType' => 'text',
                    'eval'      => ['maxlength' => 128, 'tl_class' => 'long'],
                    'sql'       => "varchar(128) NOT NULL default ''",
                ],
                'venueStreet'       => [
                    'label'     => &$GLOBALS['TL_LANG']['tl_news']['venueStreet'],
                    'exclude'   => true,
                    'search'    => true,
                    'inputType' => 'text',
                    'eval'      => ['maxlength' => 64, 'tl_class' => 'w50'],
                    'sql'       => "varchar(64) NOT NULL default ''",
                ],
                'venuePostal'       => [
                    'label'     => &$GLOBALS['TL_LANG']['tl_news']['venuePostal'],
                    'exclude'   => true,
                    'search'    => true,
                    'inputType' => 'text',
                    'eval'      => ['maxlength' => 5, 'tl_class' => 'w50'],
                    'sql'       => "varchar(5) NOT NULL default ''",
                ],
                'venueCity'         => [
                    'label'     => &$GLOBALS['TL_LANG']['tl_news']['venueCity'],
                    'exclude'   => true,
                    'filter'    => true,
                    'search'    => true,
                    'sorting'   => true,
                    'inputType' => 'text',
                    'eval'      => ['maxlength' => 64, 'tl_class' => 'w50'],
                    'sql'       => "varchar(64) NOT NULL default ''",
                ],
                'venueCountry'      => [
                    'label'     => &$GLOBALS['TL_LANG']['tl_news']['venueCountry'],
                    'exclude'   => true,
                    'filter'    => true,
                    'sorting'   => true,
                    'inputType' => 'select',
                    'options'   => System::getCountries(),
                    'eval'      => ['includeBlankOption' => true, 'chosen' => true, 'tl_class' => 'w50'],
                    'sql'       => "varchar(2) NOT NULL default ''",
                ],
                'venueSingleCoords' => [
                    'label'         => &$GLOBALS['TL_LANG']['tl_news']['venueSingleCoords'],
                    'exclude'       => true,
                    'search'        => true,
                    'inputType'     => 'text',
                    'eval'          => ['maxlength' => 64, 'tl_class' => 'w50 clr'],
                    'sql'           => "varchar(64) NOT NULL default ''",
                    'save_callback' => [
                        ['huh.news_leisure.data_container.news_container', 'generateVenueCoords'],
                    ],
                ],
                'venuePhone'        => [
                    'label'     => &$GLOBALS['TL_LANG']['tl_news']['venuePhone'],
                    'exclude'   => true,
                    'search'    => true,
                    'inputType' => 'text',
                    'eval'      => [
                        'maxlength'      => 32,
                        'rgxp'           => 'phone',
                        'decodeEntities' => true,
                        'tl_class'       => 'w50',
                    ],
                    'sql'       => "varchar(32) NOT NULL default ''",
                ],
                'venueFax'          => [
                    'label'     => &$GLOBALS['TL_LANG']['tl_news']['venueFax'],
                    'exclude'   => true,
                    'search'    => true,
                    'inputType' => 'text',
                    'eval'      => [
                        'maxlength'      => 32,
                        'rgxp'           => 'phone',
                        'decodeEntities' => true,
                        'tl_class'       => 'w50',
                    ],
                    'sql'       => "varchar(32) NOT NULL default ''",
                ],
                'venueEmail'        => [
                    'label'     => &$GLOBALS['TL_LANG']['tl_news']['venueEmail'],
                    'exclude'   => true,
                    'search'    => true,
                    'inputType' => 'text',
                    'eval'      => [
                        'maxlength'      => 64,
                        'rgxp'           => 'email',
                        'decodeEntities' => true,
                        'tl_class'       => 'w50',
                    ],
                    'sql'       => "varchar(64) NOT NULL default ''",
                ],
                'venueWebsite'      => [
                    'label'     => &$GLOBALS['TL_LANG']['tl_news']['venueWebsite'],
                    'exclude'   => true,
                    'search'    => true,
                    'inputType' => 'text',
                    'eval'      => [
                        'rgxp'      => 'url',
                        'maxlength' => 255,
                        'tl_class'  => 'w50',
                    ],
                    'sql'       => "varchar(255) NOT NULL default ''",
                ],
                'venueText'         => [
                    'label'     => &$GLOBALS['TL_LANG']['tl_news']['venueText'],
                    'exclude'   => true,
                    'search'    => true,
                    'inputType' => 'textarea',
                    'eval'      => ['rte' => 'tinyMCE', 'tl_class' => 'clr'],
                    'sql'       => "text NULL",
                ],
            ],
        ],
    ],
    // arrival infos
    'addArrivalInfo'                => [
        'label'     => &$GLOBALS['TL_LANG']['tl_news']['addArrivalInfo'],
        'exclude'   => true,
        'inputType' => 'checkbox',
        'eval'      => ['submitOnChange' => true],
        'sql'       => "char(1) NOT NULL default ''",
    ],
    'arrivalName'                   => [
        'label'     => &$GLOBALS['TL_LANG']['tl_news']['arrivalName'],
        'exclude'   => true,
        'search'    => true,
        'inputType' => 'text',
        'eval'      => ['maxlength' => 128, 'tl_class' => 'long'],
        'sql'       => "varchar(128) NOT NULL default ''",
    ],
    'arrivalStreet'                 => [
        'label'     => &$GLOBALS['TL_LANG']['tl_news']['arrivalStreet'],
        'exclude'   => true,
        'search'    => true,
        'inputType' => 'text',
        'eval'      => ['maxlength' => 64, 'tl_class' => 'w50'],
        'sql'       => "varchar(64) NOT NULL default ''",
    ],
    'arrivalPostal'                 => [
        'label'     => &$GLOBALS['TL_LANG']['tl_news']['arrivalPostal'],
        'exclude'   => true,
        'search'    => true,
        'inputType' => 'text',
        'eval'      => ['maxlength' => 5, 'tl_class' => 'w50'],
        'sql'       => "varchar(5) NOT NULL default ''",
    ],
    'arrivalCity'                   => [
        'label'     => &$GLOBALS['TL_LANG']['tl_news']['arrivalCity'],
        'exclude'   => true,
        'filter'    => true,
        'search'    => true,
        'sorting'   => true,
        'inputType' => 'text',
        'eval'      => ['maxlength' => 64, 'tl_class' => 'w50'],
        'sql'       => "varchar(64) NOT NULL default ''",
    ],
    'arrivalCountry'                => [
        'label'     => &$GLOBALS['TL_LANG']['tl_news']['arrivalCountry'],
        'exclude'   => true,
        'filter'    => true,
        'sorting'   => true,
        'inputType' => 'select',
        'options'   => System::getCountries(),
        'eval'      => ['includeBlankOption' => true, 'chosen' => true, 'tl_class' => 'w50'],
        'sql'       => "varchar(2) NOT NULL default ''",
    ],
    'arrivalSingleCoords'           => [
        'label'         => &$GLOBALS['TL_LANG']['tl_news']['arrivalSingleCoords'],
        'exclude'       => true,
        'search'        => true,
        'inputType'     => 'text',
        'eval'          => ['maxlength' => 64, 'tl_class' => 'clr'],
        'sql'           => "varchar(64) NOT NULL default ''",
        'save_callback' => [
            ['huh.news_leisure.data_container.news_container', 'generateArrivalCoords'],
        ],
    ],
    'arrivalText'                   => [
        'label'     => &$GLOBALS['TL_LANG']['tl_news']['arrivalText'],
        'exclude'   => true,
        'search'    => true,
        'inputType' => 'textarea',
        'eval'      => ['rte' => 'tinyMCE', 'tl_class' => 'clr'],
        'sql'       => "text NULL",
    ],
    // tourist info
    'addTouristInfo'                => [
        'label'     => &$GLOBALS['TL_LANG']['tl_news']['addTouristInfo'],
        'exclude'   => true,
        'inputType' => 'checkbox',
        'eval'      => ['submitOnChange' => true],
        'sql'       => "char(1) NOT NULL default ''",
    ],
    'touristInfoName'               => [
        'label'     => &$GLOBALS['TL_LANG']['tl_news']['touristInfoName'],
        'exclude'   => true,
        'search'    => true,
        'inputType' => 'text',
        'eval'      => ['maxlength' => 128, 'tl_class' => 'long'],
        'sql'       => "varchar(128) NOT NULL default ''",
    ],
    'touristInfoPhone'              => [
        'label'     => &$GLOBALS['TL_LANG']['tl_news']['touristInfoPhone'],
        'exclude'   => true,
        'search'    => true,
        'inputType' => 'text',
        'eval'      => [
            'maxlength'      => 32,
            'rgxp'           => 'phone',
            'decodeEntities' => true,
            'tl_class'       => 'w50',
        ],
        'sql'       => "varchar(32) NOT NULL default ''",
    ],
    'touristInfoFax'                => [
        'label'     => &$GLOBALS['TL_LANG']['tl_news']['touristInfoFax'],
        'exclude'   => true,
        'search'    => true,
        'inputType' => 'text',
        'eval'      => [
            'maxlength'      => 32,
            'rgxp'           => 'phone',
            'decodeEntities' => true,
            'tl_class'       => 'w50',
        ],
        'sql'       => "varchar(32) NOT NULL default ''",
    ],
    'touristInfoEmail'              => [
        'label'     => &$GLOBALS['TL_LANG']['tl_news']['touristInfoEmail'],
        'exclude'   => true,
        'search'    => true,
        'inputType' => 'text',
        'eval'      => [
            'maxlength'      => 64,
            'rgxp'           => 'email',
            'decodeEntities' => true,
            'tl_class'       => 'w50',
        ],
        'sql'       => "varchar(64) NOT NULL default ''",
    ],
    'touristInfoWebsite'            => [
        'label'     => &$GLOBALS['TL_LANG']['tl_news']['touristInfoWebsite'],
        'exclude'   => true,
        'search'    => true,
        'inputType' => 'text',
        'eval'      => [
            'rgxp'      => 'url',
            'maxlength' => 255,
            'tl_class'  => 'w50',
        ],
        'sql'       => "varchar(255) NOT NULL default ''",
    ],
    'touristInfoText'               => [
        'label'     => &$GLOBALS['TL_LANG']['tl_news']['touristInfoText'],
        'exclude'   => true,
        'search'    => true,
        'inputType' => 'textarea',
        'eval'      => ['rte' => 'tinyMCE', 'tl_class' => 'clr'],
        'sql'       => "text NULL",
    ],
    // trail info
    'addTrailInfo'                  => [
        'label'     => &$GLOBALS['TL_LANG']['tl_news']['addTrailInfo'],
        'exclude'   => true,
        'inputType' => 'checkbox',
        'eval'      => ['submitOnChange' => true],
        'sql'       => "char(1) NOT NULL default ''",
    ],
    'addTrailInfoDistance'          => [
        'label'     => &$GLOBALS['TL_LANG']['tl_news']['addTrailInfoDistance'],
        'exclude'   => true,
        'inputType' => 'checkbox',
        'eval'      => ['submitOnChange' => true, 'tl_class' => 'long'],
        'sql'       => "char(1) NOT NULL default ''",
    ],
    'trailInfoDistanceMin'          => [
        'label'         => &$GLOBALS['TL_LANG']['tl_news']['trailInfoDistanceMin'],
        'exclude'       => true,
        'search'        => true,
        'inputType'     => 'text',
        'save_callback' => [['huh.news_leisure.data_container.news_container', 'formatCommaToDot']],
        'eval'          => ['tl_class' => 'w50'],
        'sql'           => "float(4,1) NOT NULL default '0.0'",
    ],
    'trailInfoDistanceMax'          => [
        'label'         => &$GLOBALS['TL_LANG']['tl_news']['trailInfoDistanceMax'],
        'exclude'       => true,
        'search'        => true,
        'inputType'     => 'text',
        'save_callback' => [['huh.news_leisure.data_container.news_container', 'formatCommaToDot']],
        'eval'          => ['tl_class' => 'w50', 'mandatory' => true],
        'sql'           => "float(4,1) NOT NULL default '0.0'",
    ],
    'addTrailInfoDuration'          => [
        'label'     => &$GLOBALS['TL_LANG']['tl_news']['addTrailInfoDuration'],
        'exclude'   => true,
        'inputType' => 'checkbox',
        'eval'      => ['submitOnChange' => true, 'tl_class' => 'long'],
        'sql'       => "char(1) NOT NULL default ''",
    ],
    'trailInfoDurationMin'          => [
        'label'         => &$GLOBALS['TL_LANG']['tl_news']['trailInfoDurationMin'],
        'exclude'       => true,
        'search'        => true,
        'inputType'     => 'text',
        'save_callback' => [['huh.news_leisure.data_container.news_container', 'formatCommaToDot']],
        'eval'          => ['tl_class' => 'w50'],
        'sql'           => "float(4,1) NOT NULL default '0.0'",
    ],
    'trailInfoDurationMax'          => [
        'label'         => &$GLOBALS['TL_LANG']['tl_news']['trailInfoDurationMax'],
        'exclude'       => true,
        'search'        => true,
        'inputType'     => 'text',
        'save_callback' => [['huh.news_leisure.data_container.news_container', 'formatCommaToDot']],
        'eval'          => ['tl_class' => 'w50', 'mandatory' => true],
        'sql'           => "float(4,1) NOT NULL default '0.0'",
    ],
    'addTrailInfoAltitude'          => [
        'label'     => &$GLOBALS['TL_LANG']['tl_news']['addTrailInfoAltitude'],
        'exclude'   => true,
        'inputType' => 'checkbox',
        'eval'      => ['submitOnChange' => true, 'tl_class' => 'long'],
        'sql'       => "char(1) NOT NULL default ''",
    ],
    'trailInfoAltitudeMin'          => [
        'label'     => &$GLOBALS['TL_LANG']['tl_news']['trailInfoAltitudeMin'],
        'exclude'   => true,
        'search'    => true,
        'inputType' => 'text',
        'eval'      => ['tl_class' => 'w50'],
        'sql'       => "int(10) unsigned NOT NULL default '0'",
    ],
    'trailInfoAltitudeMax'          => [
        'label'     => &$GLOBALS['TL_LANG']['tl_news']['trailInfoAltitudeMax'],
        'exclude'   => true,
        'search'    => true,
        'inputType' => 'text',
        'eval'      => ['tl_class' => 'w50', 'mandatory' => true],
        'sql'       => "int(10) unsigned NOT NULL default '0'",
    ],
    'addTrailInfoDifficulty'        => [
        'label'     => &$GLOBALS['TL_LANG']['tl_news']['addTrailInfoDifficulty'],
        'exclude'   => true,
        'inputType' => 'checkbox',
        'eval'      => ['submitOnChange' => true, 'tl_class' => 'long'],
        'sql'       => "char(1) NOT NULL default ''",
    ],
    'trailInfoDifficultyMin'        => [
        'label'     => &$GLOBALS['TL_LANG']['tl_news']['trailInfoDifficultyMin'],
        'exclude'   => true,
        'search'    => true,
        'inputType' => 'select',
        'options'   => [0, 1, 2, 3],
        'reference' => &$GLOBALS['TL_LANG']['tl_news']['trailInfoDifficulties'],
        'eval'      => ['tl_class' => 'w50', 'includeBlankOption' => true],
        'sql'       => "int(10) unsigned NOT NULL default '0'",
    ],
    'trailInfoDifficultyMax'        => [
        'label'     => &$GLOBALS['TL_LANG']['tl_news']['trailInfoDifficultyMax'],
        'exclude'   => true,
        'search'    => true,
        'inputType' => 'select',
        'options'   => [0, 1, 2, 3],
        'reference' => &$GLOBALS['TL_LANG']['tl_news']['trailInfoDifficulties'],
        'eval'      => ['tl_class' => 'w50', 'mandatory' => true],
        'sql'       => "int(10) unsigned NOT NULL default '1'",
    ],
    'addTrailInfoStartDestination'  => [
        'label'     => &$GLOBALS['TL_LANG']['tl_news']['addTrailInfoStartDestination'],
        'exclude'   => true,
        'inputType' => 'checkbox',
        'eval'      => ['submitOnChange' => true, 'tl_class' => 'long'],
        'sql'       => "char(1) NOT NULL default ''",
    ],
    'trailInfoStart'                => [
        'label'     => &$GLOBALS['TL_LANG']['tl_news']['trailInfoStart'],
        'exclude'   => true,
        'search'    => true,
        'inputType' => 'text',
        'eval'      => ['maxlength' => 128, 'tl_class' => 'w50', 'mandatory' => true],
        'sql'       => "varchar(128) NOT NULL default ''",
    ],
    'trailInfoDestination'          => [
        'label'     => &$GLOBALS['TL_LANG']['tl_news']['trailInfoDestination'],
        'exclude'   => true,
        'search'    => true,
        'inputType' => 'text',
        'eval'      => ['maxlength' => 128, 'tl_class' => 'w50', 'mandatory' => true],
        'sql'       => "varchar(128) NOT NULL default ''",
    ],
    'addTrailInfoKmlData'           => [
        'label'     => &$GLOBALS['TL_LANG']['tl_news']['addTrailInfoKmlData'],
        'exclude'   => true,
        'inputType' => 'checkbox',
        'eval'      => ['submitOnChange' => true, 'tl_class' => 'long'],
        'sql'       => "char(1) NOT NULL default ''",
    ],
    'trailInfoKmlData'              => [
        'label'     => &$GLOBALS['TL_LANG']['tl_news']['trailInfoKmlData'],
        'exclude'   => true,
        'search'    => true,
        'inputType' => 'fileTree',
        'eval'      => [
            'extensions' => 'kml',
            'fieldType'  => 'radio',
            'files'      => true,
            'mandatory'  => true,
            'tl_class'   => 'w50',
        ],
        'sql'       => "blob NULL",
    ],
    'trailInfoShowElevationProfile' => [
        'label'     => &$GLOBALS['TL_LANG']['tl_news']['trailInfoShowElevationProfile'],
        'exclude'   => true,
        'inputType' => 'checkbox',
        'eval'      => ['tl_class' => 'w50'],
        'sql'       => "char(1) NOT NULL default ''",
    ],
    // opening hours
    'addOpeningHours'               => [
        'label'     => &$GLOBALS['TL_LANG']['tl_news']['addOpeningHours'],
        'exclude'   => true,
        'inputType' => 'checkbox',
        'eval'      => ['submitOnChange' => true],
        'sql'       => "char(1) NOT NULL default ''",
    ],
    'openingHoursText'              => [
        'label'     => &$GLOBALS['TL_LANG']['tl_news']['openingHoursText'],
        'exclude'   => true,
        'search'    => true,
        'inputType' => 'textarea',
        'eval'      => ['rte' => 'tinyMCE', 'tl_class' => 'clr', 'mandatory' => true],
        'sql'       => "text NULL",
    ],
    // tickets
    'addTicketPrice'                => [
        'label'     => &$GLOBALS['TL_LANG']['tl_news']['addTicketPrice'],
        'exclude'   => true,
        'inputType' => 'checkbox',
        'eval'      => ['submitOnChange' => true],
        'sql'       => "char(1) NOT NULL default ''",
    ],
    'ticketPriceText'               => [
        'label'     => &$GLOBALS['TL_LANG']['tl_news']['ticketPriceText'],
        'exclude'   => true,
        'search'    => true,
        'inputType' => 'textarea',
        'eval'      => ['rte' => 'tinyMCE', 'tl_class' => 'clr', 'mandatory' => true],
        'sql'       => "text NULL",
    ],
];

$dc['fields'] = array_merge($dc['fields'], $arrFields);
