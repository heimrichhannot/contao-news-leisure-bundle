<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2018 Heimrich & Hannot GmbH
 *
 * @author  Thomas Körner <t.koerner@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */


namespace HeimrichHannot\NewsLeisureBundle\EventListener;


use Contao\DataContainer;
use delahaye\GeoCode;
use Symfony\Component\DependencyInjection\ContainerInterface;

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
     *
     * Get geo coodinates for the venue address
     *
     * @param               $varValue
     * @param DataContainer $dc
     *
     * @return String The coordinates
     */
    function generateVenueCoords($varValue, DataContainer $dc)
    {
        if ($varValue != '')
        {
            return $varValue;
        }

        $strAddress = '';

        if ($dc->activeRecord->venueStreet != '')
        {
            $strAddress .= $dc->activeRecord->venueStreet;
        }

        if ($dc->activeRecord->venuePostal != '' && $dc->activeRecord->venueCity)
        {
            $strAddress .= ($strAddress ? ',' : '') . $dc->activeRecord->venuePostal . ' ' . $dc->activeRecord->venueCity;
        }

        if (($strCoords = $this->generateCoordsFromAddress($strAddress, $dc->activeRecord->venueCountry ?: 'de')) !== false)
        {
            $varValue = $strCoords;
        }

        return $varValue;
    }


    /**
     *
     * Get geo coodinates for the arrival address
     *
     * @param               $varValue
     * @param DataContainer $dc
     *
     * @return String The coordinates
     */
    public function generateArrivalCoords($varValue, DataContainer $dc)
    {
        if ($varValue != '')
        {
            return $varValue;
        }

        $strAddress = '';

        if ($dc->activeRecord->arrivalStreet != '')
        {
            $strAddress .= $dc->activeRecord->arrivalStreet;
        }

        if ($dc->activeRecord->arrivalPostal != '' && $dc->activeRecord->arrivalCity)
        {
            $strAddress .= ($strAddress ? ',' : '') . $dc->activeRecord->arrivalPostal . ' ' . $dc->activeRecord->arrivalCity;
        }

        if (($strCoords = $this->generateCoordsFromAddress($strAddress, $dc->activeRecord->arrivalCountry ?: 'de')) !== false)
        {
            $varValue = $strCoords;
        }

        return $varValue;
    }

    /**
     * @param string $strAddress Address string
     * @param string $strCountry Country ISO 3166 code
     *
     * @return bool|string False if dlh_geocode is not installed, otherwise return the coordinates from address string
     */
    private function generateCoordsFromAddress($strAddress, $strCountry)
    {

        if (!in_array('dlh_geocode', $this->container->getParameter('kernel.bundles') ))
        {
            return false;
        }

        return GeoCode::getCoordinates($strAddress, $strCountry, 'de');
    }

    public static function formatCommaToDot($value)
    {
        return str_replace(',', '.', $value);
    }

}