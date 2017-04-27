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
$GLOBALS['TL_LANG']['tl_room_list']['arrival']   = ['Arrival', ''];
$GLOBALS['TL_LANG']['tl_room_list']['departure'] = ['Departure', ''];
$GLOBALS['TL_LANG']['tl_room_list']['rooms']     = ['Room(s)', ''];
$GLOBALS['TL_LANG']['tl_room_list']['firstname'] = ['First name', ''];
$GLOBALS['TL_LANG']['tl_room_list']['lastname']  = ['Last name', ''];
$GLOBALS['TL_LANG']['tl_room_list']['address']   = ['Address', ''];
$GLOBALS['TL_LANG']['tl_room_list']['postcode']  = ['Post code', ''];
$GLOBALS['TL_LANG']['tl_room_list']['city']      = ['City', ''];
$GLOBALS['TL_LANG']['tl_room_list']['country']   = ['Country', ''];
$GLOBALS['TL_LANG']['tl_room_list']['email']     = ['E-mail', ''];
$GLOBALS['TL_LANG']['tl_room_list']['phone']     = ['Phone number', ''];
$GLOBALS['TL_LANG']['tl_room_list']['remarks']   = ['Remarks', ''];

$GLOBALS['TL_LANG']['tl_room_list']['show']          = ['Show details', 'Show reservations details for entry %s'];
$GLOBALS['TL_LANG']['tl_room_list']['delete']        = ['Delete reservation', 'Delete reservation #%s'];
$GLOBALS['TL_LANG']['tl_room_list']['deleteConfirm'] = 'Really remove reservation #%s?';

/**
 * Filter
 */
$GLOBALS['TL_LANG']['tl_room_list']['timeSlot']  = 'Time slot';
$GLOBALS['TL_LANG']['tl_room_list']['all']       = 'All reservations';
$GLOBALS['TL_LANG']['tl_room_list']['future']    = 'Future reservations';
$GLOBALS['TL_LANG']['tl_room_list']['past']      = 'Expired reservations';
$GLOBALS['TL_LANG']['tl_room_list']['today']     = 'Today';
$GLOBALS['TL_LANG']['tl_room_list']['thisWeek']  = 'This week';
$GLOBALS['TL_LANG']['tl_room_list']['thisMonth'] = 'This month';
$GLOBALS['TL_LANG']['tl_room_list']['thisYear']  = 'This year';