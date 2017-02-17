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
$GLOBALS['TL_LANG']['tl_roomtype']['roomtype']    = array('Room type', 'Please enter the description of the room type.'); 
$GLOBALS['TL_LANG']['tl_roomtype']['maxcount']    = array('Maximum number of rooms', 'Please enter the maximum number of online reservations.');
$GLOBALS['TL_LANG']['tl_roomtype']['description'] = array('Description', 'Here you can enter a short description for the room type.');
$GLOBALS['TL_LANG']['tl_roomtype']['published']   = array('Publish room type', 'Show the room type in the frontend.');
$GLOBALS['TL_LANG']['tl_roomtype']['start']       = array('Show from', 'Show the room type from this day in the frontend.');
$GLOBALS['TL_LANG']['tl_roomtype']['stop']        = array('Show until', 'Show the room type up to this day in the frontend.');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_roomtype']['roomtype_legend'] = 'Room type and description';
$GLOBALS['TL_LANG']['tl_roomtype']['publish_legend']  = 'Publish';

/**
 * Reference
 */

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_roomtype']['new']           = array('Create room type', 'Crate a new room type');
$GLOBALS['TL_LANG']['tl_roomtype']['edit']          = array('Edit', 'Edit room type ID %s');
$GLOBALS['TL_LANG']['tl_roomtype']['copy']          = array('Copy', 'Copy room type ID %s');
$GLOBALS['TL_LANG']['tl_roomtype']['delete']        = array('Delete', 'Remove room type ID %s');
$GLOBALS['TL_LANG']['tl_roomtype']['show']          = array('Show', 'Show data set ID %s');
$GLOBALS['TL_LANG']['tl_roomtype']['create']        = array('Room occupancy calendar', 'Open the calendar to show and edit the room accoupancy.');
$GLOBALS['TL_LANG']['tl_roomtype']['reset']         = array('Reset', 'Reset the room occupancy for roomtype.');
$GLOBALS['TL_LANG']['tl_roomtype']['resetConfirm']  = 'The entire occupancy for room type ID %s will be removed';
$GLOBALS['TL_LANG']['tl_roomtype']['toggle']        = array('Toggle visibility', 'Toggle the visibility for room type ID %s.');
$GLOBALS['TL_LANG']['tl_roomtype']['deleteConfirm'] = 'Really remove room type ID %s?\nCaution: All room assignments for this room type will be removed.';