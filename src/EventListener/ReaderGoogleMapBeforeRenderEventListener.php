<?php


namespace HeimrichHannot\NewsLeisureBundle\EventListener;


use Contao\Environment;
use Contao\System;
use HeimrichHannot\GoogleMapsBundle\Event\ReaderGoogleMapBeforeRenderEvent;
use Http\Adapter\Guzzle6\Client;
use Http\Message\MessageFactory\GuzzleMessageFactory;
use Ivory\GoogleMap\Layer\KmlLayer;
use Ivory\GoogleMap\Service\Elevation\ElevationService;

class ReaderGoogleMapBeforeRenderEventListener
{
    public function modifyKMLMap(ReaderGoogleMapBeforeRenderEvent $event)
    {
        $item      = $event->getItem();
        $map       = $event->getMap();
        $container = System::getContainer();

        if (!$item->getRawValue('addTrailInfoKmlData')) {
            return;
        }

        if (null === ($kml = $container->get('huh.utils.file')->getFileFromUuid($item->getRawValue('trailInfoKmlData')))) {
            return;
        }

        $kmlLayer = new KmlLayer(Environment::get('url') . '/' . $kml->path);

        $map->getLayerManager()->addKmlLayer($kmlLayer);
    }
}