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
$GLOBALS['TL_LANG']['tl_room_occupancy']['showPeriodOptions'] = ['Zeitspanne aktivieren', 'Aktiviert die Optionen, um mehrere Tage gleichzeitig zu bearbeiten. Achtung: Bereits angelegte Daten werden überschrieben.'];
$GLOBALS['TL_LANG']['tl_room_occupancy']['startDate']         = ['Startdatum', 'Bitte geben Sie das Startdatum gemäß des globalen Datumsformats ein.'];
$GLOBALS['TL_LANG']['tl_room_occupancy']['date']              = ['Datum', ''];
$GLOBALS['TL_LANG']['tl_room_occupancy']['endDate']           = ['Enddatum', 'Bitte geben Sie das Startdatum gemäß des globalen Datumsformats ein.'];
$GLOBALS['TL_LANG']['tl_room_occupancy']['count']             = ['Zimmeranzahl', 'Die Anzahl der verfügbaren Zimmer'];
$GLOBALS['TL_LANG']['tl_room_occupancy']['price']             = ['Tagespreis', 'Den aktuellen Tagespreis angeben.'];
$GLOBALS['TL_LANG']['tl_room_occupancy']['mls']               = ['Minimum Length of Stay', 'Mindestaufenthaltszeit in Tagen.'];
$GLOBALS['TL_LANG']['tl_room_occupancy']['year']              = ['Jahr', ''];
$GLOBALS['TL_LANG']['tl_room_occupancy']['countAlt']          = 'Anzahl';
$GLOBALS['TL_LANG']['tl_room_occupancy']['countTitle']        = 'Anzahl verfügbarer Zimmer';
$GLOBALS['TL_LANG']['tl_room_occupancy']['priceAlt']          = 'Tagespreis';
$GLOBALS['TL_LANG']['tl_room_occupancy']['priceTitle']        = 'Tagespreis in Euro';
$GLOBALS['TL_LANG']['tl_room_occupancy']['mlsAlt']            = 'Minimum Length of Stay';
$GLOBALS['TL_LANG']['tl_room_occupancy']['mlsTitle']          = 'Mindestaufenthaltszeit in Tagen';

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_room_occupancy']['date_legend']     = 'Zeitspanne';
$GLOBALS['TL_LANG']['tl_room_occupancy']['calendar_legend'] = 'Jahreskalender';

/**
 * Reference
 */

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_room_occupancy']['new']              = ['Zimmerbelegung bearbeiten', 'Den Kalender für die Zimmerbelegung öffnen.'];
$GLOBALS['TL_LANG']['MSC']['room_reservation']['editRecord'] = 'Zimmerbelegung bearbeiten';