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

$GLOBALS['BE_MOD']['room_reservation'] = [
    'room_config' => [
        'tables' => ['tl_room_settings'],
        'icon'   => 'system/modules/room_reservation/assets/images/settings16.png',
    ],
    'room_types'  => [
        'tables'     => ['tl_room_type', 'tl_room_occupancy'],
        'icon'       => 'system/modules/room_reservation/assets/images/roomtypes16.png',
        'stylesheet' => 'system/modules/room_reservation/assets/css/layout.min.css',
        'javascript' => 'system/modules/room_reservation/assets/js/datepicker.js'
    ],
    'room_list'   => [
        'tables' => ['tl_room_list'],
        'icon'   => 'system/modules/room_reservation/assets/images/reservation_list16.png',
    ],
];

$GLOBALS['FE_MOD']['reservation']['room_reservation'] = 'ModuleRoomReservation';
$GLOBALS['TL_HOOKS']['replaceInsertTags'][]           = ['HooksRoomFrontend', 'myReplaceInsertTags'];
$GLOBALS['TL_HOOKS']['parseBackendTemplate'][]        = ['HooksRoomBackend', 'myParseBackendTemplate'];
$GLOBALS['TL_MOOTOOLS'][]                             = '<script type="text/javascript">// <![CDATA[
    $("totalOverviewLink").addEvent("click", function() {
            $("overviewRoomTable").toggleClass("invisible");
    });
    // ]]></script>';