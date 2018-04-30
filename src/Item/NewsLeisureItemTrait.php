<?php

/*
 * Copyright (c) 2018 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

namespace HeimrichHannot\NewsLeisureBundle\Item;

use HeimrichHannot\FieldPalette\FieldPaletteModel;

trait NewsLeisureItemTrait
{
    /**
     * Get a list of venues
     * @return array|null
     */
    public function getVenues(): ?array
    {
        if (false === (bool)$this->addVenues) {
            return null;
        }

        /**
         * @var FieldPaletteModel $fieldPaletteModel
         */
        $fieldPaletteModel = $this->getManager()->getFramework()->getAdapter(FieldPaletteModel::class);

        if (null === ($venues = $fieldPaletteModel->findPublishedByPidAndTableAndField($this->id, $this->getDataContainer(), 'venues'))) {
            return null;
        }

        return $venues->fetchAll();
    }
}
