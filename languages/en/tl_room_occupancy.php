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
$GLOBALS['TL_LANG']['tl_room_occupancy']['showPeriodOptions'] = array('Activate period of time', 'Activate the option to edit several days at the same time. Caution: Already stored data will be overwritten.');
$GLOBALS['TL_LANG']['tl_room_occupancy']['startDate']         = array('Start date', 'Please enter the start date according to the global date format.');
$GLOBALS['TL_LANG']['tl_room_occupancy']['date']              = array('Date', '');
$GLOBALS['TL_LANG']['tl_room_occupancy']['endDate']           = array('End date', 'Please enter the end date according to the global date format.');
$GLOBALS['TL_LANG']['tl_room_occupancy']['count']             = array('Room count', 'The number of available rooms');
$GLOBALS['TL_LANG']['tl_room_occupancy']['price']             = array('Daily price', 'Specify the daily price.');
$GLOBALS['TL_LANG']['tl_room_occupancy']['mls']               = array('Minimum length of stay', 'Minimum length of stay');
$GLOBALS['TL_LANG']['tl_room_occupancy']['year']              = array('Year', '');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_room_occupancy']['date_legend']     = 'Period of time';
$GLOBALS['TL_LANG']['tl_room_occupancy']['calendar_legend'] = 'Annual calendar';

/**
 * Reference
 */

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_room_occupancy']['new'] = array('Edit occupancy', 'Open the calendar for the room occupancy.');
$GLOBALS['TL_LANG']['MSC']['editRecord']        = 'Edit occupancy'; 