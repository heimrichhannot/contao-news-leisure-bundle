<?php

/*
 * Copyright (c) 2018 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

namespace HeimrichHannot\NewsLeisureBundle\Item;

use Contao\System;

trait NewsLeisureItemTrait
{
    /**
     * Get a list of venues.
     *
     * @return array|null
     */
    public function getVenues(): ?array
    {
        if (false === (bool) $this->addVenues) {
            return null;
        }

        if (null === ($venues = System::getContainer()->get('huh.fieldpalette.manager')->getInstance()->findPublishedByPidAndTableAndField($this->id, $this->getDataContainer(), 'venues'))) {
            return null;
        }

        return $venues->fetchAll();
    }
}
