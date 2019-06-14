<?php

namespace HeimrichHannot\NewsLeisureBundle\DataContainer;

use Contao\Config;
use Contao\DataContainer;
use Contao\NewsModel;
use HeimrichHannot\RequestBundle\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;

class NewsContainer
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var NewsModel
     */
    protected $newsModelAdapter;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

        $this->request          = $this->container->get('huh.request');
        $this->newsModelAdapter = $this->container->get('contao.framework')->getAdapter(NewsModel::class);
    }

    /**
     * Get geo coordinates for the venue address.
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
        $coords = $this->container->get('huh.utils.location')->computeCoordinatesByString($strAddress, Config::get('googlemaps_apiKey'));

        return implode(',',$coords);
    }
}