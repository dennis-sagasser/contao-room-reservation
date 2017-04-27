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
 * Table tl_room_list
 */
$GLOBALS['TL_DCA']['tl_room_list'] = [
    // Config
    'config' => [
        'dataContainer'   => 'Table',
        'closed'          => true,
        'notEditable'     => true,
        'notDeletable'    => false,
        'sql'             => [
            'keys' => [
                'id' => 'primary',
            ]
        ],
        'onload_callback' => [
            ['tl_room_list', 'applyFilter'],
        ]
    ],
    // List
    'list'   => [
        'sorting'    => [
            'mode'           => 2,
            'panelLayout'    => 'filter,custom_filters;search,sort,limit',
            'fields'         => ['id ASC'],
            'panel_callback' => [
                'custom_filters' => ['tl_room_list', 'generateFilter'],
            ],
        ],
        'label'      => [
            'fields' => ['arrival', 'departure', 'rooms', 'firstname', 'lastname'],
            'format' => '<em>%s - %s</em> <b>|</b> %s <b>|</b> %s %s'
        ],
        'operations' => [
            'show'   => [
                'label' => &$GLOBALS['TL_LANG']['tl_room_list']['show'],
                'href'  => 'act=show',
                'icon'  => 'show.gif'
            ],
            'delete' => [
                'label'      => &$GLOBALS['TL_LANG']['tl_room_list']['delete'],
                'href'       => 'act=delete',
                'icon'       => 'delete.gif',
                'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['tl_room_list']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
            ],
        ]
    ],
    // Fields
    'fields' => [
        'id'        => [
            'sql'     => "int(10) unsigned NOT NULL auto_increment",
            'sorting' => true,
        ],
        'tstamp'    => [
            'sql' => "int(10) unsigned NOT NULL"
        ],
        'arrival'   => [
            'label'   => &$GLOBALS['TL_LANG']['tl_room_list']['arrival'],
            'sql'     => "int(10) unsigned NOT NULL default '0'",
            'flag'    => 6,
            'search'  => true,
            'sorting' => true,
            'filter'  => true,
            'eval'    => [
                'rgxp' => 'date'
            ],
        ],
        'departure' => [
            'label'   => &$GLOBALS['TL_LANG']['tl_room_list']['departure'],
            'sql'     => "int(10) unsigned NOT NULL default '0'",
            'flag'    => 6,
            'search'  => true,
            'sorting' => true,
            'filter'  => true,
            'eval'    => [
                'rgxp' => 'date'
            ],
        ],
        'rooms'     => [
            'label' => &$GLOBALS['TL_LANG']['tl_room_list']['rooms'],
            'sql'   => "text NOT NULL"
        ],
        'lastname'  => [
            'label'   => &$GLOBALS['TL_LANG']['tl_room_list']['lastname'],
            'sql'     => "varchar(255) NOT NULL default ''",
            'search'  => true,
            'sorting' => true,
            'filter'  => true,
        ],
        'firstname' => [
            'label' => &$GLOBALS['TL_LANG']['tl_room_list']['firstname'],
            'sql'   => "varchar(255) NOT NULL default ''",
        ],
        'address'   => [
            'label' => &$GLOBALS['TL_LANG']['tl_room_list']['address'],
            'sql'   => "varchar(255) NOT NULL default ''"
        ],
        'postcode'  => [
            'label'   => &$GLOBALS['TL_LANG']['tl_room_list']['postcode'],
            'sql'     => "varchar(255) NOT NULL default ''",
            'search'  => true,
            'sorting' => true,
            'filter'  => true,
        ],
        'country'   => [
            'label'   => &$GLOBALS['TL_LANG']['tl_room_list']['country'],
            'sql'     => "varchar(255) NOT NULL default ''",
            'search'  => true,
            'sorting' => true,
            'filter'  => true,
        ],
        'phone'     => [
            'label' => &$GLOBALS['TL_LANG']['tl_room_list']['phone'],
            'sql'   => "varchar(255) NULL"
        ],
        'email'     => [
            'label'   => &$GLOBALS['TL_LANG']['tl_room_list']['email'],
            'sql'     => "varchar(255) NOT NULL default ''",
            'search'  => true,
            'sorting' => true,
        ],
        'remarks'   => [
            'label' => &$GLOBALS['TL_LANG']['tl_room_list']['remarks'],
            'sql'   => "text NULL"
        ],
    ]
];