<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2018 Heimrich & Hannot GmbH
 *
 * @author  Thomas Körner <t.koerner@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */


namespace HeimrichHannot\NewsLeisureBundle\ContaoManager;


use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use HeimrichHannot\NewsBundle\HeimrichHannotContaoNewsBundle;
use HeimrichHannot\NewsLeisureBundle\HeimrichHannotContaoNewsLeisureBundle;

class Plugin implements BundlePluginInterface
{

    public function getBundles(ParserInterface $parser)
    {
        return BundleConfig::create(HeimrichHannotContaoNewsLeisureBundle::class)
            ->setLoadAfter([
                HeimrichHannotContaoNewsBundle::class
            ]);
    }
}