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
 * Table tl_roomtype
 */
$GLOBALS['TL_DCA']['tl_roomtype'] = array
(
    // Config
    'config' => array
    (
        'dataContainer'     => 'Table',
        'ctable'            => array('tl_room_occupancy'),
        'switchToEdit'      => true,
        'enableVersioning'  => true,
        'sql' => array
        (
            'keys' => array
            (
                'id' => 'primary'
            )
        )
    ),

    // List
    'list' => array
    (
        'sorting' => array
        (
            'mode'          => 1,
            'fields'        => array('roomtype'),
            'flag'          => 1,
            'panelLayout'   => 'filter;search,limit'
        ),
        'label' => array
        (
                'fields'    => array('roomtype', 'description'),
                'format'    => '%s <span style="color:#b3b6b3">[%s]</span>'
        ),
        'global_operations' => array
        (
            'all' => array
            (
                'label'         => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href'          => 'act=select',
                'class'         => 'header_edit_all',
                'attributes'    => 'onclick="Backend.getScrollOffset()" accesskey="e"'
            )
        ),
        'operations' => array
        (
            'edit' => array
            (
                'label'             => &$GLOBALS['TL_LANG']['tl_roomtype']['edit'],
                'href'              => 'act=edit',
                'icon'              => 'edit.gif'
            ),
            'create' => array
            (
                'label'             => &$GLOBALS['TL_LANG']['tl_roomtype']['create'],
                'href'              => 'table=tl_room_occupancy',
                'icon'              => 'system/modules/room_reservation/assets/images/calendar16.png'
            ),
            'reset' => array
            (
                'label'             => &$GLOBALS['TL_LANG']['tl_roomtype']['reset'],
                'href'              => 'key=reset',
                'icon'              => 'system/modules/room_reservation/assets/images/reset16.gif',
                'attributes'        => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['tl_roomtype']['resetConfirm'] . '\')) return false; Backend.getScrollOffset();"'
            ),
            'copy' => array
            (
                'label'             => &$GLOBALS['TL_LANG']['tl_roomtype']['copy'],
                'href'              => 'act=copy',
                'icon'              => 'copy.gif',
            ),
            'delete' => array
            (
                'label'             => &$GLOBALS['TL_LANG']['tl_roomtype']['delete'],
                'href'              => 'act=delete',
                'icon'              => 'delete.gif',
                'attributes'        => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['tl_roomtype']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
            ),
            'show' => array
            (
                'label'             => &$GLOBALS['TL_LANG']['tl_roomtype']['show'],
                'href'              => 'act=show',
                'icon'              => 'show.gif'
            ),
            'toggle' => array
            (
                'label'             => &$GLOBALS['TL_LANG']['tl_roomtype']['toggle'],
                'icon'              => 'visible.gif',
                'attributes'        => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
                'button_callback'   => array('tl_roomtype', 'toggleIcon')
            ),
        )
    ),

    // Palettes
    'palettes' => array
    (
        '__selector__'  => array('protected', 'allowComments'),
        'default'       => '{roomtype_legend},roomtype,maxcount,description;{publish_legend},published,start,stop'
    ),

    // Subpalettes

    // Fields
    'fields' => array
    (
        'id' => array
        (
            'sql'               => "int(10) unsigned NOT NULL auto_increment"
        ),
        'tstamp' => array
        (
            'sql'               => "int(10) unsigned NOT NULL default '0'"
        ),
        'roomtype' => array
        (
            'label'             => &$GLOBALS['TL_LANG']['tl_roomtype']['roomtype'],
            'search'            => true,
            'inputType'         => 'text',
            'eval'              => array
            (
                'mandatory' =>  true, 
                'maxlength' =>  255,
                'unique'    =>  true,
                'rgxp'      =>  'alpha',
                'doNotCopy' =>  true,
                'tl_class'  => 'w50'
            ),
            'sql'               => "varchar(255) NOT NULL default ''"
        ),
        'maxcount' => array
        (
            'label'             => &$GLOBALS['TL_LANG']['tl_roomtype']['maxcount'],
            'search'            => true,
            'inputType'         => 'text',
            'eval'              => array
            (
                'maxlength' =>  2,
                'rgxp'      =>  'digit',
                'tl_class'  =>  'w50'
            ),
            'sql'               => "int(2) unsigned NOT NULL default '5'"
        ),
        'description' => array
        (
            'label'             => &$GLOBALS['TL_LANG']['tl_roomtype']['description'],
            'search'            => true,
            'inputType'         => 'textarea',
            'sql'               => "text NULL"
        ),
        'published' => array
        (
            'label'             => &$GLOBALS['TL_LANG']['tl_roomtype']['published'],
            'filter'            => true,
            'flag'              => 2,
            'inputType'         => 'checkbox',
            'eval'              => array('doNotCopy' => true),
            'sql'               => "char(1) NOT NULL default ''"
        ),
        'start' => array
        (
            'label'             => &$GLOBALS['TL_LANG']['tl_roomtype']['start'],
            'inputType'         => 'text',
            'eval'              => array
            (
                'rgxp'          =>'datim',
                'datepicker'    => true,
                'tl_class'      =>'w50 wizard'
            ),
            'sql'               => "varchar(10) NOT NULL default ''"
        ),
        'stop' => array
        (
            'label'             => &$GLOBALS['TL_LANG']['tl_roomtype']['stop'],
            'inputType'         => 'text',
            'eval'              => array
            (
                'rgxp'          =>'datim',
                'datepicker'    => true, 
                'tl_class'      => 'w50 wizard'
            ),
            'sql'               => "varchar(10) NOT NULL default ''"
        )
    )
);