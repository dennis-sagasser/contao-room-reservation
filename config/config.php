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

$GLOBALS['BE_MOD']['room_reservation'] = array(
    'config'           => array(
        'tables' => array('tl_reservation_settings'),
        //'callback'     => 'ClassName',                                                                                                                     
        'icon'   => 'system/modules/room_reservation/assets/images/settings16.png',
        //'stylesheet'   => 'path/to/stylesheet.css',
        //'javascript'   => 'path/to/javascript.js'
    ),
    'roomtypes'        => array(
        'tables'     => array('tl_roomtype', 'tl_room_occupancy'),
        //'callback'     => 'ClassName',                                                                                                                     
        'icon'       => 'system/modules/room_reservation/assets/images/roomtypes16.png',
        'stylesheet' => 'system/modules/room_reservation/assets/css/layout.min.css',
        'javascript' => 'system/modules/room_reservation/assets/js/datepicker.js'
    ),
    'reservation_list' => array(
        'tables' => array('tl_reservation_list'),
        //'callback'     => 'ClassName',                                                                                                                     
        'icon'   => 'system/modules/room_reservation/assets/images/reservation_list16.png',
        //'stylesheet'   => 'path/to/stylesheet.css',
        //'javascript'   => 'path/to/javascript.js'
    ),
);

$GLOBALS['FE_MOD']['reservation']['room_reservation'] = 'ModuleRoomReservation';
$GLOBALS['TL_HOOKS']['replaceInsertTags'][]           = array('HookMyInsertTags', 'myReplaceInsertTags');
$GLOBALS['TL_HOOKS']['parseBackendTemplate'][]        = array('HookMyBackendTemplate', 'myParseBackendTemplate');
//$GLOBALS['TL_CSS'][]                                  = '/system/modules/room_reservation/assets/css/form.css';
$GLOBALS['TL_MOOTOOLS'][] = '<script type="text/javascript">// <![CDATA[
    $$("a").addEvent("click", function() {
            $("overviewTable").toggleClass("invisible");
    });
    // ]]></script>';