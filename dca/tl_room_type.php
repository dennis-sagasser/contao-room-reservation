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
 * Table tl_room_type
 */
$GLOBALS['TL_DCA']['tl_room_type'] = [
    // Config
    'config'   => [
        'dataContainer'    => 'Table',
        'ctable'           => ['tl_room_occupancy'],
        'switchToEdit'     => true,
        'enableVersioning' => true,
        'sql'              => [
            'keys' => [
                'id' => 'primary'
            ]
        ]
    ],

    // List
    'list'     => [
        'sorting'           => [
            'mode'        => 1,
            'fields'      => ['roomtype'],
            'flag'        => 1,
            'panelLayout' => 'filter;search,limit'
        ],
        'label'             => [
            'fields' => ['roomtype', 'description'],
            'format' => '%s <span style="color:#b3b6b3">[%s]</span>'
        ],
        'global_operations' => [
            'all' => [
                'label'      => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href'       => 'act=select',
                'class'      => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset()" accesskey="e"'
            ]
        ],
        'operations'        => [
            'edit'   => [
                'label' => &$GLOBALS['TL_LANG']['tl_room_type']['edit'],
                'href'  => 'act=edit',
                'icon'  => 'edit.gif'
            ],
            'create' => [
                'label' => &$GLOBALS['TL_LANG']['tl_room_type']['create'],
                'href'  => 'table=tl_room_occupancy',
                'icon'  => 'system/modules/room_reservation/assets/images/calendar16.png'
            ],
            'reset'  => [
                'label'      => &$GLOBALS['TL_LANG']['tl_room_type']['reset'],
                'href'       => 'key=reset',
                'icon'       => 'system/modules/room_reservation/assets/images/reset16.gif',
                'attributes' => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['tl_room_type']['resetConfirm'] . '\')) return false; Backend.getScrollOffset();"'
            ],
            'copy'   => [
                'label' => &$GLOBALS['TL_LANG']['tl_room_type']['copy'],
                'href'  => 'act=copy',
                'icon'  => 'copy.gif',
            ],
            'delete' => [
                'label'      => &$GLOBALS['TL_LANG']['tl_room_type']['delete'],
                'href'       => 'act=delete',
                'icon'       => 'delete.gif',
                'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['tl_room_type']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
            ],
            'show'   => [
                'label' => &$GLOBALS['TL_LANG']['tl_room_type']['show'],
                'href'  => 'act=show',
                'icon'  => 'show.gif'
            ],
            'toggle' => [
                'label'           => &$GLOBALS['TL_LANG']['tl_room_type']['toggle'],
                'icon'            => 'visible.gif',
                'attributes'      => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
                'button_callback' => ['tl_room_type', 'toggleIcon']
            ],
        ]
    ],

    // Palettes
    'palettes' => [
        '__selector__' => ['protected', 'allowComments'],
        'default'      => '{roomtype_legend},roomtype,maxcount,description;{publish_legend},published,start,stop'
    ],

    // Subpalettes

    // Fields
    'fields'   => [
        'id'          => [
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ],
        'tstamp'      => [
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ],
        'roomtype'    => [
            'label'     => &$GLOBALS['TL_LANG']['tl_room_type']['roomtype'],
            'search'    => true,
            'inputType' => 'text',
            'eval'      => [
                'mandatory' => true,
                'maxlength' => 255,
                'unique'    => true,
                'rgxp'      => 'alpha',
                'doNotCopy' => true,
                'tl_class'  => 'w50'
            ],
            'sql'       => "varchar(255) NOT NULL default ''"
        ],
        'maxcount'    => [
            'label'     => &$GLOBALS['TL_LANG']['tl_room_type']['maxcount'],
            'search'    => true,
            'inputType' => 'text',
            'eval'      => [
                'maxlength' => 2,
                'rgxp'      => 'digit',
                'tl_class'  => 'w50'
            ],
            'sql'       => "int(2) unsigned NOT NULL default '5'"
        ],
        'description' => [
            'label'     => &$GLOBALS['TL_LANG']['tl_room_type']['description'],
            'search'    => true,
            'inputType' => 'textarea',
            'sql'       => "text NULL"
        ],
        'published'   => [
            'label'     => &$GLOBALS['TL_LANG']['tl_room_type']['published'],
            'filter'    => true,
            'flag'      => 2,
            'inputType' => 'checkbox',
            'eval'      => ['doNotCopy' => true],
            'sql'       => "char(1) NOT NULL default ''"
        ],
        'start'       => [
            'label'     => &$GLOBALS['TL_LANG']['tl_room_type']['start'],
            'inputType' => 'text',
            'eval'      => [
                'rgxp'       => 'datim',
                'datepicker' => true,
                'tl_class'   => 'w50 wizard'
            ],
            'sql'       => "varchar(10) NOT NULL default ''"
        ],
        'stop'        => [
            'label'     => &$GLOBALS['TL_LANG']['tl_room_type']['stop'],
            'inputType' => 'text',
            'eval'      => [
                'rgxp'       => 'datim',
                'datepicker' => true,
                'tl_class'   => 'w50 wizard'
            ],
            'sql'       => "varchar(10) NOT NULL default ''"
        ]
    ]
];