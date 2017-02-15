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
    'config' => array
    (
        'dataContainer'     => 'Table',
        'ptable'            => 'tl_roomtype',
        'switchToEdit'      => false,
        'enableVersioning'  => false,
        'sql'               => array
        (
            'keys' => array
            (
                'id'    => 'primary',
                'pid'   => 'index'
            )
        ),
        'onload_callback'   => array
        (
            array('tl_room_occupancy', 'checkDate'),
        ),
    ),
    // List
    'list' => array
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
    'palettes' => array
    (
        '__selector__'  => array('showPeriodOptions'), 
        'default'       => '{date_legend},showPeriodOptions;{calendar_legend},calendar'
    ),
    // Subpalettes
    'subpalettes' => array 
    ( 
        'showPeriodOptions' => 'startDate,endDate,count,price,mls' 
    ), 
    
    // Fields
    'fields' => array
    (
        'id' => array
        (
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ),
        'pid' => array
        (
            'foreignKey'    => 'tl_roomtype.roomtype',
            'sql'           => "int(10) unsigned NOT NULL default '0'",
            'relation'      => array('type' => 'belongsTo', 'load' => 'eager')
        ),
        'tstamp' => array
        (
            'default'       => time(),
            'sql'           => "int(10) unsigned NOT NULL default '0'"
        ),
        'showPeriodOptions' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_room_occupancy']['showPeriodOptions'],
            'exclude'   => false,
            'inputType' => 'checkbox',
            'eval'      => array('mandatory'=>false, 'isBoolean' => true, 'submitOnChange'=>true),
            'sql'       => "char(1) NOT NULL default ''"
        ),
        'startDate' => array
        (
                'label'         => &$GLOBALS['TL_LANG']['tl_room_occupancy']['startDate'],
                'inputType'     => 'text',
                'eval'          => array
                (
                    'doNotSaveEmpty'    => true,
                    'rgxp'              => 'date', 
                    'doNotCopy'         => true, 
                    'datepicker'        => true, 
                    'tl_class'          => 'w50 wizard',
                    'mandatory'         => true
                ),
                'sql' => "int(10) unsigned NULL",
                'load_callback'   => array
                (
                    array('tl_room_occupancy', 'loadDate'),
                ),
                'save_callback'   => array
                (
                    array('tl_room_occupancy', 'doNotSaveDate'),
                ),
        ),
        'endDate' => array
        (
                'label'         => &$GLOBALS['TL_LANG']['tl_room_occupancy']['endDate'],
                'inputType'     => 'text',
                'eval'          => array
                (
                    'doNotSaveEmpty'    => true,
                    'rgxp'              => 'date', 
                    'doNotCopy'         => true, 
                    'datepicker'        => true, 
                    'tl_class'          => 'w50 wizard',
                    'mandatory'         => true
                ),
                'sql' => "int(10) unsigned NULL",
                'save_callback'   => array
                (
                    array('tl_room_occupancy', 'doNotSaveDate'),
                ),
        ),
        'date' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_room_occupancy']['date'],
            'default'   => date('Y-m-d'),
            'inputType' => 'text',
            'search'    => true,
            'sorting'   => true,          
            'eval'      => array
            (
                'rgxp'          => 'date', 
                'doNotCopy'     => true,
                'datepicker'    => true,
                'tl_class'      => 'w50 wizard'
            ),
            'sql'       => "date NOT NULL"
        ),
        'count' => array
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
        'price' => array
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
        'mls' => array
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
        'calendar' => array
        (
            'input_field_callback' => array
                (
                    'tl_room_occupancy', 'generateCalendarWidget'
                ),
        ),
    )
);

/**
 * Class tl_room_occupancy
 *
 * @category  Contao  
 * @package   RoomReservation                                                                                                                                                                                                                                                                                                                                                                                                               
 * @author    Dennis Sagasser <sagasser@gispack.com>
 * @copyright 2014 Dennis Sagasser                                                                                                                                                                                                      
 * @license   http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 * @link      https://contao.org            
 */
class tl_room_occupancy extends \Backend
{
    /**
     * Parent call of the constructor.
     * 
     * @return null
     */
    public function __construct() 
    {
        parent::__construct();
    }
    
    /**
     * Generates a year calendar widget to edit count, price and mls for every day in year.
     * 
     * @param object $dc Data container object
     * 
     * @return string
     */
    public function generateCalendarWidget(DataContainer $dc) 
    {
        
        $intYear        = Input::get('intYear');
        $intCurrentYear = isset($intYear) ? Input::get('intYear') : (int) Date::parse('Y');

        $strHtmlYearCalendar  = '<div><table class="calendarWidget">';
        $strHtmlYearCalendar .= '<caption><h3><a href='.Environment::get('requestUri').'&intYear='.($intCurrentYear - 1).'>«</a>&nbsp;'.$GLOBALS['TL_LANG']['tl_room_occupancy']['year'][0].'&nbsp;'.$intCurrentYear.'&nbsp;<a href='.Environment::get('uri').'&intYear='.($intCurrentYear + 1).'>»</a></h3></caption>';

        $intCurrentMonth = 0;
        $intParentId     = $dc->activeRecord->pid;

        while ($intCurrentMonth < 12) {
            $strMonthNameShort    = $GLOBALS['TL_LANG']['MONTHS_SHORT'][$intCurrentMonth];
            $strHtmlYearCalendar .= '<tr>';
            $strHtmlYearCalendar .= '<td class="shortMonthColumn"><span class="shortMonthName">'.$strMonthNameShort.'</span><br><br>Anz.<br>TP<br>MLS</td>';
            $strHtmlYearCalendar .= $this->datesMonth(++$intCurrentMonth, $intCurrentYear, $intParentId);
            $strHtmlYearCalendar .= '</tr>';
        }

        $strHtmlYearCalendar .= '</table></div>';

        return $strHtmlYearCalendar;
    }
    
    /**
     * Creates the month rows and fills the calendar.
     * 
     * @param int $intMonth    Month
     * @param int $intYear     Year
     * @param int $intParentId Parent ID
     * 
     * @return string
     */
    function datesMonth($intMonth, $intYear, $intParentId) 
    {
        $intCountDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $intMonth, $intYear);
        $strCurrentMonth     = str_pad($intMonth, 2, "0", STR_PAD_LEFT);

        for ($i = 1; $i <= $intCountDaysInMonth; $i++) {
            
            $strCurrentDay  = str_pad($i, 2, "0", STR_PAD_LEFT);
            $strCurrentDate = $intYear.'-'.$strCurrentMonth.'-'.$strCurrentDay;
            
            $objDbSelectResult = $this->Database->prepare("   
                SELECT  count, price, mls
                FROM    tl_room_occupancy 
                WHERE   date=? 
                AND     pid=?")
                    ->execute($strCurrentDate, $intParentId);

            $mktime          = mktime(0, 0, 0, $intMonth, $i, $intYear);
            $intWeekDay      = date("w", $mktime);
            $strWeekDayShort = $GLOBALS['TL_LANG']['DAYS_SHORT'][$intWeekDay];

            $strHtmlYearCalendar .= '<td id="'.$strCurrentDate.'" class="tdCalendarDay">';
            $strHtmlYearCalendar .= '<div class="toggleInputDiv '.($strCurrentDate === date('Y-m-d') ? 'active' : '').'"><div class="dayOfWeek">'.$strWeekDayShort.'</div>';
            $strHtmlYearCalendar .= '<div class="dayOfMonth">'.$i.'</div></div>
                <input id="ctrl_date_'.$strCurrentDate.'" type="hidden" value="'.$strCurrentDate.'" name="'.$strCurrentDate.'[date]" '.($strCurrentDate === date('Y-m-d') ? '' : 'disabled').'>    
                <input id="ctrl_count_'.$strCurrentDate.'" type="text" value="'.$objDbSelectResult->count.'" name="'.$strCurrentDate.'[count]" maxlength="2" '.($strCurrentDate === date('Y-m-d') ? '' : 'disabled').' class="'.($classInput = ($objDbSelectResult->count < 1) ? 'emptyInput' : 'filledInput').'">
                <input id="ctrl_price_'.$strCurrentDate.'" type="text" value="'.$objDbSelectResult->price.'" name="'.$strCurrentDate.'[price]" maxlength="6" '.($strCurrentDate === date('Y-m-d') ? '' : 'disabled').' class="'.($classInput = ($objDbSelectResult->price < 1) ? 'emptyInput' : 'filledInput').'">
                <input id="ctrl_mls_'.$strCurrentDate.'" type="text" value="'.$objDbSelectResult->mls.'" name="'.$strCurrentDate.'[mls]" maxlength="2" '.($strCurrentDate === date('Y-m-d') ? '' : 'disabled').' class="'.($classInput = ($objDbSelectResult->mls < 1) ? 'emptyInput' : 'filledInput').'"></td>
            '; 
            
            if (Input::post('FORM_SUBMIT') == 'tl_room_occupancy') {

                if (Input::post('showPeriodOptions') && $mktime >= strtotime(Input::post('startDate')) && $mktime <= strtotime(Input::post('endDate'))) {  
                    
                    $postDate          = array();
                    $postDate['date']  = $strCurrentDate;
                    $postDate['count'] = Input::post('count');
                    $postDate['price'] = Input::post('price');
                    $postDate['mls']   = Input::post('mls');
                    
                } else {
                    
                    $postDate = Input::post($strCurrentDate);
                    
                }

                if ($postDate['date'] !== null && $objDbSelectResult->numRows > 0) {
               
                    $objDbResult = $this->Database->prepare("
                        UPDATE  tl_room_occupancy
                        SET     pid=?, tstamp=?, date=?, count=?, price=?, mls=?
                        WHERE   date=?
                        AND     pid=?")
                            ->execute($intParentId, 
                                time(), 
                                $strCurrentDate, 
                                $postDate['count'], 
                                $postDate['price'], 
                                $postDate['mls'],
                                $postDate['date'],
                                $intParentId);   
                }
            
                if ($postDate['date'] !== null && $objDbSelectResult->numRows < 1) {
                        
                    $objDbResult = $this->Database->prepare("
                        INSERT INTO tl_room_occupancy (pid, tstamp, date, count, price, mls)
                        VALUES(?,?,?,?,?,?)")
                            ->execute($intParentId, 
                                time(), 
                                $strCurrentDate, 
                                $postDate['count'], 
                                $postDate['price'], 
                                $postDate['mls']);
                }
            }
        }
        return $strHtmlYearCalendar;
    }
    
    /**
     * Redirect to edit current date when date already exists in DB. 
     * 
     * @return null
     */
    public function checkDate()
    {
        if (Input::get('key') === 'reset') {
            $intId       = Input::get('id');
            $objDbResult = Database::getInstance()->prepare("
            DELETE FROM tl_room_occupancy 
            WHERE       pid=?")
                ->execute($intId);                   
        }

        $strCurrentDate = date('Y-m-d');
        $intParentId    = Input::get('pid');
        $objDbResult    = Database::getInstance()->prepare("
            SELECT  id 
            FROM    tl_room_occupancy 
            WHERE   date=? 
            AND     pid=?")
                ->execute($strCurrentDate, $intParentId);
        
        if ($objDbResult->numRows && (Input::get('act') === 'create')) {   
            $this->redirect($this->addToUrl('&table=tl_room_occupancy&act=edit&id='.$objDbResult->id));
        }
    } 
    
    /**
     * Sets the current date according to the date format settings.
     * 
     * @return string
     */
    public function loadDate()
    {    
        return date($GLOBALS['TL_CONFIG']['dateFormat']);       
    } 
    
    /**
     * Returns null so that the field is not saved to the DB ('doNotSaveEmpty' => true).
     * 
     * @return null
     */
    public function doNotSaveDate()
    {    
        return null;       
    } 
    
    /**
     * Specifies the look of every row of the reservation plan.
     * 
     * @param array $arrRow Current row
     * 
     * @return string
     */
    public function showCalendar($arrRow) 
    {
        setlocale(LC_MONETARY, 'de_DE');
        $floatPrice = money_format('%=*^-14#4.2i', $arrRow['price']);
        return '<div><span style="color:#b3b3b3;">'.$GLOBALS['TL_LANG']['tl_room_occupancy']['count'][0].': </span>['.($arrRow['count'] > 0 ? $arrRow['count'] : '<span style="color:#cc3333;">'.$arrRow['count'].'</span>').'] <b>|</b> '
                .'<span style="color:#b3b3b3;">'.$GLOBALS['TL_LANG']['tl_room_occupancy']['price'][0].': </span>['.($arrRow['price'] > 0 ? $floatPrice : '<span style="color:#cc3333;">'.$floatPrice.'</span>').'] <b>|</b> '
                .'<span style="color:#b3b3b3;">'.$GLOBALS['TL_LANG']['tl_room_occupancy']['mls'][0].': </span>['.($arrRow['mls'] > 0 ? $arrRow['mls'] : '<span style="color:#cc3333;">'.$arrRow['mls'].'</span>').']</div>';
    }
}
