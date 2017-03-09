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
 * Class ModuleRoomReservation
 *
 * Specifies insert tags for the confirmation mail to the customer.
 *
 * @category  Contao
 * @package   RoomReservation
 * @author    Dennis Sagasser <sagasser@gispack.com>
 * @copyright 2014 Dennis Sagasser
 * @license   http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 * @link      https://contao.org
 */

/**
 * Table tl_room_occupancy
 */
$GLOBALS['TL_DCA']['tl_room_occupancy'] = array
(
    // Config
    'config'      => array
    (
        'dataContainer'    => 'Table',
        'ptable'           => 'tl_roomtype',
        'switchToEdit'     => false,
        'enableVersioning' => false,
        'sql'              => array
        (
            'keys' => array
            (
                'id'  => 'primary',
                'pid' => 'index'
            )
        ),
        'onload_callback'  => array
        (
            array('tl_room_occupancy', 'checkDate'),
        ),
    ),
    // List
    'list'        => array
    (
        'sorting' => array
        (
            'mode'                  => 4,
            'headerFields'          => array('roomtype', 'published'),
            'panelLayout'           => 'filter,limit;search,sort',
            'fields'                => array('date ASC'),
            'child_record_callback' => array('tl_room_occupancy', 'showCalendar'),
        ),
    ),
    // Palettes
    'palettes'    => array
    (
        '__selector__' => array('showPeriodOptions'),
        'default'      => '{date_legend},showPeriodOptions;{calendar_legend},calendar'
    ),
    // Subpalettes
    'subpalettes' => array
    (
        'showPeriodOptions' => 'startDate,endDate,count,price,mls'
    ),

    // Fields
    'fields'      => array
    (
        'id'                => array
        (
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ),
        'pid'               => array
        (
            'foreignKey' => 'tl_roomtype.roomtype',
            'sql'        => "int(10) unsigned NOT NULL default '0'",
            'relation'   => array('type' => 'belongsTo', 'load' => 'eager')
        ),
        'tstamp'            => array
        (
            'default' => time(),
            'sql'     => "int(10) unsigned NOT NULL default '0'"
        ),
        'showPeriodOptions' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_room_occupancy']['showPeriodOptions'],
            'exclude'   => false,
            'inputType' => 'checkbox',
            'eval'      => array('mandatory' => false, 'isBoolean' => true, 'submitOnChange' => true),
            'sql'       => "char(1) NOT NULL default ''"
        ),
        'startDate'         => array
        (
            'label'         => &$GLOBALS['TL_LANG']['tl_room_occupancy']['startDate'],
            'inputType'     => 'text',
            'eval'          => array
            (
                'doNotSaveEmpty' => true,
                'rgxp'           => 'date',
                'doNotCopy'      => true,
                'datepicker'     => true,
                'tl_class'       => 'w50 wizard',
                'mandatory'      => true
            ),
            'sql'           => "int(10) unsigned NULL",
            'load_callback' => array
            (
                array('tl_room_occupancy', 'loadDate'),
            ),
            'save_callback' => array
            (
                array('tl_room_occupancy', 'doNotSaveDate'),
            ),
        ),
        'endDate'           => array
        (
            'label'         => &$GLOBALS['TL_LANG']['tl_room_occupancy']['endDate'],
            'inputType'     => 'text',
            'eval'          => array
            (
                'doNotSaveEmpty' => true,
                'rgxp'           => 'date',
                'doNotCopy'      => true,
                'datepicker'     => true,
                'tl_class'       => 'w50 wizard',
                'mandatory'      => true
            ),
            'sql'           => "int(10) unsigned NULL",
            'save_callback' => array
            (
                array('tl_room_occupancy', 'doNotSaveDate'),
            ),
        ),
        'date'              => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_room_occupancy']['date'],
            'default'   => date('Y-m-d'),
            'inputType' => 'text',
            'search'    => true,
            'sorting'   => true,
            'eval'      => array
            (
                'rgxp'       => 'date',
                'doNotCopy'  => true,
                'datepicker' => true,
                'tl_class'   => 'w50 wizard'
            ),
            'sql'       => "date NOT NULL"
        ),
        'count'             => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_room_occupancy']['count'],
            'default'   => 0,
            'inputType' => 'text',
            'search'    => true,
            'sorting'   => true,
            'filter'    => true,
            'eval'      => array('rgxp' => 'digit', 'tl_class' => 'w50'),
            'sql'       => "smallint(3) unsigned NULL"
        ),
        'price'             => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_room_occupancy']['price'],
            'default'   => 0,
            'inputType' => 'text',
            'search'    => true,
            'sorting'   => true,
            'filter'    => true,
            'eval'      => array('rgxp' => 'digit', 'tl_class' => 'w50'),
            'sql'       => "smallint(4) unsigned NULL"
        ),
        'mls'               => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_room_occupancy']['mls'],
            'default'   => 0,
            'inputType' => 'text',
            'search'    => true,
            'sorting'   => true,
            'filter'    => true,
            'eval'      => array('rgxp' => 'digit', 'tl_class' => 'w50'),
            'sql'       => "smallint(3) unsigned NULL"
        ),
        'calendar'          => array
        (
            'input_field_callback' => array
            (
                'tl_room_occupancy', 'generateCalendarWidget'
            ),
        ),
    )
);