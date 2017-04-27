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
 * Add Callback to show MooTools hint.
 */
$GLOBALS['TL_DCA']['tl_module']['config']['onload_callback'][] = ['tl_module_room_reservation', 'showJsLibraryHint'];

/**
 * Add palettes to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['room_reservation'] = '{title_legend},name,headline,type;{config_legend},res_roomtypes;{redirect_legend},jumpTo;{expert_legend:hide},guests,cssID,space';


/**
 * Add fields to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['res_roomtypes'] = [
    'label'            => &$GLOBALS['TL_LANG']['tl_module']['res_roomtypes'],
    'exclude'          => true,
    'inputType'        => 'checkbox',
    'options_callback' => ['tl_module_room_reservation', 'getRoomtypes'],
    'eval'             => ['mandatory' => true, 'multiple' => true],
    'sql'              => "blob NULL"
];