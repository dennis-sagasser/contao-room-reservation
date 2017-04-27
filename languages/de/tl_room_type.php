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
$GLOBALS['TL_LANG']['tl_room_type']['roomtype']    = ['Zimmertyp', 'Bitte geben Sie die Bezeichnung des Zimmertyps ein.'];
$GLOBALS['TL_LANG']['tl_room_type']['maxcount']    = ['Maximale Zimmeranzahl', 'Bitte geben Sie das Maximum möglicher Online-Reservierungen an.'];
$GLOBALS['TL_LANG']['tl_room_type']['description'] = ['Beschreibung', 'Hier können Sie eine kurze Beschreibung für den Zimmertyp angeben.'];
$GLOBALS['TL_LANG']['tl_room_type']['published']   = ['Zimmertyp veröffentlichen', 'Den Zimmertyp auf der Website anzeigen.'];
$GLOBALS['TL_LANG']['tl_room_type']['start']       = ['Anzeigen ab', 'Den Zimmertyp erst ab diesem Tag auf der Website anzeigen.'];
$GLOBALS['TL_LANG']['tl_room_type']['stop']        = ['Anzeigen bis', 'Den Zimmertyp bis zu diesem Tag auf der Website anzeigen.'];

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_room_type']['roomtype_legend'] = 'Zimmertyp und Beschreibung';
$GLOBALS['TL_LANG']['tl_room_type']['publish_legend']  = 'Veröffentlichung';

/**
 * Reference
 */

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_room_type']['new']           = ['Zimmertyp anlegen', 'Einen neuen Zimmertyp anlegen'];
$GLOBALS['TL_LANG']['tl_room_type']['edit']          = ['Bearbeiten', 'Zimmertyp ID %s bearbeiten'];
$GLOBALS['TL_LANG']['tl_room_type']['copy']          = ['Kopieren', 'Zimmertyp ID %s kopieren'];
$GLOBALS['TL_LANG']['tl_room_type']['delete']        = ['Entfernen', 'Zimmertyp ID %s entfernen'];
$GLOBALS['TL_LANG']['tl_room_type']['show']          = ['Anzeigen', 'Datensatz ID %s anzeigen'];
$GLOBALS['TL_LANG']['tl_room_type']['create']        = ['Zimmerbelegungskalender', 'Kalender für die Zimmerbelegung anzeigen'];
$GLOBALS['TL_LANG']['tl_room_type']['reset']         = ['Zurücksetzen', 'Zimmerbelegungen zurücksetzen'];
$GLOBALS['TL_LANG']['tl_room_type']['resetConfirm']  = 'Die gesamte Belegung für Zimmertyp ID %s wird gelöscht';
$GLOBALS['TL_LANG']['tl_room_type']['toggle']        = ['Sichtbarkeit umschalten', 'Sichbarkeit für den Zimmertyp ID %s festlegen'];
$GLOBALS['TL_LANG']['tl_room_type']['deleteConfirm'] = 'Soll der Zimmertyp ID %s wirklich gelöscht werden?\nAchtung: Alle Zimmerbelegungen für diesen Zimmertyp werden ebenfalls entfernt.';