<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2019 Heimrich & Hannot GmbH
 *
 * @author  Thomas Körner <t.koerner@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */


namespace HeimrichHannot\NewsLeisureBundle\DataContainer;


use Symfony\Component\DependencyInjection\ContainerInterface;
use HeimrichHannot\FilterBundle\Filter\Type\TextConcatType;
use HeimrichHannot\FilterBundle\Filter\Type\TextType;

class FilterConfigElementContainer
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }


    public function addChoicesLeisureFieldToTypePalettes(array &$dca)
    {
        $config = $this->container->getParameter('huh.filter');

        if (!isset($config['filter']['types']))
        {
            return;
        }

        $filterType = null;
        $choiceFields = [];

        foreach ($config['filter']['types'] as $type)
        {
            if ($type['type'] === 'choice')
            {
                $choiceFields[] = $type['name'];
            }
        }

        foreach ($choiceFields as $choiceField)
        {
            $dca['palettes'][$choiceField] = str_replace(';{visualization_legend}', ',useTextAsOptionValue;{visualization_legend}', $dca['palettes'][$choiceField]);
        }
    }
}