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

/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_room_type']['roomtype']    = ['Room type', 'Please enter the description of the room type.'];
$GLOBALS['TL_LANG']['tl_room_type']['maxcount']    = ['Maximum number of rooms', 'Please enter the maximum number of online reservations.'];
$GLOBALS['TL_LANG']['tl_room_type']['description'] = ['Description', 'Here you can enter a short description for the room type.'];
$GLOBALS['TL_LANG']['tl_room_type']['published']   = ['Publish room type', 'Show the room type in the frontend.'];
$GLOBALS['TL_LANG']['tl_room_type']['start']       = ['Show from', 'Show the room type from this day in the frontend.'];
$GLOBALS['TL_LANG']['tl_room_type']['stop']        = ['Show until', 'Show the room type up to this day in the frontend.'];

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_room_type']['roomtype_legend'] = 'Room type and description';
$GLOBALS['TL_LANG']['tl_room_type']['publish_legend']  = 'Publish';

/**
 * Reference
 */

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_room_type']['new']           = ['Create room type', 'Crate a new room type'];
$GLOBALS['TL_LANG']['tl_room_type']['edit']          = ['Edit', 'Edit room type ID %s'];
$GLOBALS['TL_LANG']['tl_room_type']['copy']          = ['Copy', 'Copy room type ID %s'];
$GLOBALS['TL_LANG']['tl_room_type']['delete']        = ['Delete', 'Remove room type ID %s'];
$GLOBALS['TL_LANG']['tl_room_type']['show']          = ['Show', 'Show data set ID %s'];
$GLOBALS['TL_LANG']['tl_room_type']['create']        = ['Room occupancy calendar', 'Open the calendar to show and edit the room accoupancy.'];
$GLOBALS['TL_LANG']['tl_room_type']['reset']         = ['Reset', 'Reset the room occupancy for roomtype.'];
$GLOBALS['TL_LANG']['tl_room_type']['resetConfirm']  = 'The entire occupancy for room type ID %s will be removed';
$GLOBALS['TL_LANG']['tl_room_type']['toggle']        = ['Toggle visibility', 'Toggle the visibility for room type ID %s.'];
$GLOBALS['TL_LANG']['tl_room_type']['deleteConfirm'] = 'Really remove room type ID %s?\nCaution: All room assignments for this room type will be removed.';