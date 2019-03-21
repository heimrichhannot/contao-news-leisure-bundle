<?php

/*
 * Copyright (c) 2018 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

namespace HeimrichHannot\NewsLeisureBundle\EventListener;

use Contao\DataContainer;
use Contao\System;
use Contao\Config;
use Symfony\Component\DependencyInjection\ContainerInterface;
use HeimrichHannot\UtilsBundle\HeimrichHannotContaoUtilsBundle;
use HeimrichHannot\UtilsBundle\Location\LocationUtil;

class CallbackListener
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Get geo coodinates for the venue address.
     *
     * @param               $varValue
     * @param DataContainer $dc
     *
     * @return string The coordinates
     */
    public function generateVenueCoords($varValue, DataContainer $dc)
    {
        if ('' !== $varValue) {
            return $varValue;
        }

        $strAddress = '';

        if ('' !== $dc->activeRecord->venueStreet) {
            $strAddress .= $dc->activeRecord->venueStreet;
        }

        if ('' !== $dc->activeRecord->venuePostal && $dc->activeRecord->venueCity) {
            $strAddress .= ($strAddress ? ',' : '').$dc->activeRecord->venuePostal.' '.$dc->activeRecord->venueCity;
        }

        if (false !== ($strCoords = $this->generateCoordsFromAddress($strAddress, $dc->activeRecord->venueCountry ?: 'de'))) {
            $varValue = $strCoords;
        }

        return $varValue;
    }

    /**
     * Get geo coodinates for the arrival address.
     *
     * @param               $varValue
     * @param DataContainer $dc
     *
     * @return string The coordinates
     */
    public function generateArrivalCoords($varValue, DataContainer $dc)
    {
        if ('' !== $varValue) {
            return $varValue;
        }

        $strAddress = '';

        if ('' !== $dc->activeRecord->arrivalStreet) {
            $strAddress .= $dc->activeRecord->arrivalStreet;
        }

        if ('' !== $dc->activeRecord->arrivalPostal && $dc->activeRecord->arrivalCity) {
            $strAddress .= ($strAddress ? ',' : '').$dc->activeRecord->arrivalPostal.' '.$dc->activeRecord->arrivalCity;
        }

        if (false !== ($strCoords = $this->generateCoordsFromAddress($strAddress, $dc->activeRecord->arrivalCountry ?: 'de'))) {
            $varValue = $strCoords;
        }

        return $varValue;
    }

    public static function formatCommaToDot($value)
    {
        return str_replace(',', '.', $value);
    }

    /**
     * @param string $strAddress Address string
     * @param string $strCountry Country ISO 3166 code
     *
     * @return bool|string False if dlh_geocode is not installed, otherwise return the coordinates from address string
     */
    private function generateCoordsFromAddress($strAddress, $strCountry)
    {
	if (!in_array(HeimrichHannotContaoUtilsBundle::class, $this->container->getParameter('kernel.bundles'), true)) {
            return false;
        }
        
        $coords = System::getContainer()->get('huh.utils.location')->computeCoordinatesByString($strAddress, Config::get('googlemaps_apiKey'));

        return implode(',',$coords);
    }
}
