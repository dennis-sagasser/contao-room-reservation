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
 * Class HooksRoomBackend
 *
 * Parses the backend template and replaces the back link.
 *
 * @category  Contao
 * @package   RoomReservation
 * @author    Dennis Sagasser <sagasser@gispack.com>
 * @copyright 2014 Dennis Sagasser
 * @license   http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 * @link      https://contao.org
 */
class HooksRoomBackend extends \Backend
{
    /**
     * Replaces the back link.
     *
     * @param string $strBuffer Content of the parsed back end template
     * @param string $strTemplate The template name
     *
     * @return string
     */
    public function myParseBackendTemplate($strBuffer, $strTemplate)
    {
        if ($strTemplate == 'be_main' && (\Input::get("do") === 'room_config')) {
            $strBuffer = preg_replace(
                '/<a href=(.*?) class=\"header_back\"/',
                '<a href="javascript:history.back()" class="header_back"',
                $strBuffer
            );
        }

        return $strBuffer;
    }

}
