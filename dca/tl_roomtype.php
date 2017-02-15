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

/**
 * Class tl_roomtype
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * 
 * @category  Contao  
 * @package   RoomReservation                                                                                                                                                                                                                                                                                                                                                                                                               
 * @author    Dennis Sagasser <sagasser@gispack.com>
 * @copyright 2014 Dennis Sagasser                                                                                                                                                                                                      
 * @license   http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 * @link      https://contao.org            
 */
class tl_roomtype extends Backend
{
    /**
     * Changes appearance of Toggle-Buttons.
     * 
     * @param object $row        Row object
     * @param string $href       Link
     * @param string $label      Label
     * @param string $title      Title
     * @param string $icon       Icon 
     * @param string $attributes Attributes
     * 
     * @return string
     */
    public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
    {
        $this->import('BackendUser', 'User');
 
        if (strlen(Input::get('tid'))) {
            $this->toggleVisibility(Input::get('tid'), (Input::get('state') == 0));
            $this->redirect($this->getReferer());
        }
 
        // Check permissions AFTER checking the tid, so hacking attempts are logged
        if (!$this->User->isAdmin && !$this->User->hasAccess('tl_roomtype::published', 'alexf')) {
            return '';
        }
 
        $href .= '&amp;id='.Input::get('id').'&amp;tid='.$row['id'].'&amp;state='.$row[''];
 
        if (!$row['published']) {
            $icon = 'invisible.gif';
        }
 
        return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ';
    }
    
    /**
     * Toggle the visibility of an element
     * 
     * @param integer $intId        ID
     * @param boolean $blnPublished Published
     * 
     * @return null
     */
    public function toggleVisibility($intId, $blnPublished)
    {
        // Check permissions to publish
        if (!$this->User->isAdmin && !$this->User->hasAccess('tl_roomtype::published', 'alexf')) {
            $this->log('Not enough permissions to show/hide record ID "'.$intId.'"', 'tl_roomtype toggleVisibility', TL_ERROR);
            $this->redirect('contao/main.php?act=error');
        }

        $this->createInitialVersion('tl_roomtype', $intId);

        // Trigger the save_callback
        if (is_array($GLOBALS['TL_DCA']['tl_roomtype']['fields']['published']['save_callback'])) {
            foreach ($GLOBALS['TL_DCA']['tl_roomtype']['fields']['published']['save_callback'] as $callback) {
                $this->import($callback[0]);
                $blnPublished = $this->$callback[0]->$callback[1]($blnPublished, $this);
            }
        }

        // Update the database
        $this->Database->prepare("UPDATE tl_roomtype SET tstamp=". time() .", published='" . ($blnPublished ? '' : '1') . "' WHERE id=?")
            ->execute($intId);
        $this->createNewVersion('tl_roomtype', $intId); 
    }
}    

