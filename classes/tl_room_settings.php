<?php

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2014 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 *
 * @category  Contao
 * @package   RoomReservation
 * @author    Dennis Sagasser <sagasser@gispack.com>
 * @copyright 2014 Dennis Sagasser
 * @license   http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 * @link      https://contao.org
 */

namespace Contao;

/**
 * Class tl_room_settings
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 *
 * @category  Contao
 * @package   RoomReservation
 * @author    Dennis Sagasser <sagasser@gispack.com>
 * @copyright 2014 Dennis Sagasser
 * @license   http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 * @link      https://contao.org
 */
class tl_room_settings extends \Backend
{

    /**
     * Import the back end user object
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Only show one item for the settings and redirect to it
     *
     * @return string
     */
    public function checkConfig()
    {
        $objConfig = Database::getInstance()->prepare("SELECT * FROM tl_room_settings")->execute();

        if (Input::get('key')) {
            return;
        }

        if (!$objConfig->numRows && !Input::get('act')) {
            $this->redirect($this->addToUrl('act=create'));
        }

        if (!Input::get('id') && !Input::get('act')) {
            $this->redirect($this->addToUrl('act=edit&id=' . $objConfig->id));
        }
    }


    /**
     * Convert absolute URLs from TinyMCE to relative URLs
     *
     * @param string $strContent URL
     *
     * @return string
     */
    public function convertAbsoluteLinks($strContent)
    {
        return str_replace('src="' . Environment::get('base'), 'src="', $strContent);
    }


    /**
     * Convert relative URLs from TinyMCE to absolute URLs
     *
     * @param string $strContent URL
     *
     * @return string
     */
    public function convertRelativeLinks($strContent)
    {
        return $this->convertRelativeUrls($strContent);
    }

    /**
     * Return all mail templates as array
     *
     * @return array
     */
    public function getMailTemplates()
    {
        return $this->getTemplateGroup('mail_');
    }
}