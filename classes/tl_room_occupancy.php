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

namespace Contao;

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
class tl_room_occupancy extends \Backend
{
    /**
     * @var object $objModuleModel Module model object
     */
    protected $objModuleModel = null;

    /**
     * Parent call of the constructor.
     *
     */
    public function __construct()
    {
        parent::__construct();

        $this->objModuleModel = \ModuleModel::findByType('room_reservation');
    }

    /**
     * Generates a year calendar widget to edit count, price and mls for every day in year.
     *
     * @param DataContainer $dc Data container object
     *
     * @return string
     */
    public function generateCalendarWidget(DataContainer $dc)
    {
        $intYear        = \Input::get('intYear');
        $intCurrentYear = isset($intYear) ?
            \Input::get('intYear') :
            (int)\Date::parse('Y');

        $strBuffer = '<div><table class="calendarWidget">';
        $strBuffer .= '<caption><h3>';
        $strBuffer .= '<a href=' . \Environment::get('requestUri') . '&intYear=' . ($intCurrentYear - 1) . '>«</a>';
        $strBuffer .= '&nbsp;' . $GLOBALS['TL_LANG']['tl_room_occupancy']['year'][0];
        $strBuffer .= '&nbsp;' . $intCurrentYear . '&nbsp;';
        $strBuffer .= '<a href=' . \Environment::get('uri') . '&intYear=' . ($intCurrentYear + 1) . '>»</a>';
        $strBuffer .= '</h3></caption>';

        $intCurrentMonth = 0;
        $intParentId     = intval($dc->activeRecord->pid);

        $strCountSrc = 'system/modules/room_reservation/assets/images/count16.png';
        $strPriceSrc = 'system/modules/room_reservation/assets/images/price16.png';
        $strMlsSrc   = 'system/modules/room_reservation/assets/images/mls16.png';

        $strCountAlt = $GLOBALS['TL_LANG']['tl_room_occupancy']['countAlt'];
        $strPriceAlt = $GLOBALS['TL_LANG']['tl_room_occupancy']['priceAlt'];
        $strMlsAlt   = $GLOBALS['TL_LANG']['tl_room_occupancy']['mlsAlt'];

        $strCountAttr = 'title="' . $GLOBALS['TL_LANG']['tl_room_occupancy']['countTitle'] . '"';
        $strPriceAttr = 'title="' . $GLOBALS['TL_LANG']['tl_room_occupancy']['priceTitle'] . '"';
        $strMlsAttr   = 'title="' . $GLOBALS['TL_LANG']['tl_room_occupancy']['mlsTitle'] . '"';

        $strCount = \Image::getHtml($strCountSrc, $strCountAlt, $strCountAttr);
        $strPrice = \Image::getHtml($strPriceSrc, $strPriceAlt, $strPriceAttr);
        $strMls   = \Image::getHtml($strMlsSrc, $strMlsAlt, $strMlsAttr);

        while ($intCurrentMonth < 12) {
            $strMonthNameShort = $GLOBALS['TL_LANG']['MONTHS_SHORT'][$intCurrentMonth];

            $strBuffer .= '<tr>';
            $strBuffer .= '<td class="shortMonthColumn">';
            $strBuffer .= '<div class="shortMonthName">' . $strMonthNameShort . '</div><br>';
            $strBuffer .= $strCount;
            $strBuffer .= $strPrice;
            $strBuffer .= $strMls;
            $strBuffer .= $this->datesMonth(++$intCurrentMonth, $intCurrentYear, $intParentId);
            $strBuffer .= '</td>';
            $strBuffer .= '</tr>';
        }

        $strBuffer .= '</table></div>';

        return $strBuffer;
    }

    /**
     * Creates the month rows and fills the calendar.
     *
     * @param int $intMonth Month
     * @param int $intYear Year
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
            $strCurrentDate = $intYear . '-' . $strCurrentMonth . '-' . $strCurrentDay;

            $objWidgetDate           = new \FormTextField();
            $objWidgetDate->value    = $strCurrentDate;
            $objWidgetDate->name     = $strCurrentDate . '[date]';
            $objWidgetDate->disabled = $strCurrentDate === date('Y-m-d') ? '' : 'disabled';
            $objWidgetDate->style    = 'display:none';

            $objCounts = $this->Database->prepare("   
                SELECT  count, price, mls
                FROM    tl_room_occupancy 
                WHERE   date=? 
                AND     pid=?")
                ->execute($strCurrentDate, $intParentId);

            $objWidgetCount            = new \FormTextField();
            $objWidgetCount->id        = 'count_' . $strCurrentDate;
            $objWidgetCount->class     = empty($objCounts->count) ? 'emptyInput' : 'filledInput';
            $objWidgetCount->value     = $objCounts->count;
            $objWidgetCount->name      = $strCurrentDate . '[count]';
            $objWidgetCount->maxlength = 2;
            $objWidgetCount->disabled  = ($strCurrentDate === date('Y-m-d')) ? false : true;

            $objWidgetPrice            = new \FormTextField();
            $objWidgetPrice->id        = 'price_' . $strCurrentDate;
            $objWidgetPrice->class     = empty($objCounts->price) ? 'emptyInput' : 'filledInput';
            $objWidgetPrice->value     = $objCounts->price;
            $objWidgetPrice->name      = $strCurrentDate . '[price]';
            $objWidgetPrice->maxlength = 2;
            $objWidgetPrice->disabled  = ($strCurrentDate === date('Y-m-d')) ? false : true;

            $objWidgetMls            = new \FormTextField();
            $objWidgetMls->id        = 'mls_' . $strCurrentDate;
            $objWidgetMls->class     = empty($objCounts->mls) ? 'emptyInput' : 'filledInput';
            $objWidgetMls->value     = $objCounts->mls;
            $objWidgetMls->name      = $strCurrentDate . '[mls]';
            $objWidgetMls->maxlength = 2;
            $objWidgetMls->disabled  = ($strCurrentDate === date('Y-m-d')) ? false : true;

            $intMktime       = mktime(0, 0, 0, $intMonth, $i, $intYear);
            $intWeekDay      = date("w", $intMktime);
            $strWeekDayShort = $GLOBALS['TL_LANG']['DAYS_SHORT'][$intWeekDay];

            $strBuffer .= '<td id="' . $strCurrentDate . '" class="tdCalendarDay">';
            $strBuffer .= '<div class="toggleInputDiv ';
            $strBuffer .= ($strCurrentDate === date('Y-m-d') ? 'active' : '') . '">';
            $strBuffer .= '<div class="dayOfWeek">' . $strWeekDayShort . '</div>';
            $strBuffer .= '<div class="dayOfMonth">' . $i . '</div></div>';

            $strBuffer .= $objWidgetDate->generate();
            $strBuffer .= $objWidgetCount->generate() . $objWidgetPrice->generate() . $objWidgetMls->generate();
            if (\Input::post('FORM_SUBMIT') == 'tl_room_occupancy') {
                $this->saveData($intMktime, $strCurrentDate, $objCounts, $intParentId);
            }
        }
        return $strBuffer;
    }

    /**
     * Stores the calendar form data in the database.
     *
     * @param int $intMktime Timestamp begin of current day
     * @param string $strCurrentDate Current date string in SQL format
     * @param object $objCounts Counts of seats for current day
     * @param int $intParentId Id of the parent category
     *
     */
    public function saveData($intMktime, $strCurrentDate, $objCounts, $intParentId)
    {
        $arrPostDate           = [];
        $arrPostDate['pid']    = $intParentId;
        $arrPostDate['tstamp'] = time();

        if (\Input::post('showPeriodOptions') &&
            $intMktime >= strtotime(\Input::post('startDate')) &&
            $intMktime <= strtotime(\Input::post('endDate'))
        ) {
            $arrPostDate['date'] = $strCurrentDate;

            $arrPostDate['count'] = \Input::post('count');
            $arrPostDate['price'] = \Input::post('price');
            $arrPostDate['mls']   = \Input::post('mls');
        } else {
            $mixedPostDate = \Input::post($strCurrentDate);
            if (is_array($mixedPostDate)) {
                $arrPostDate = array_merge($mixedPostDate, $arrPostDate);
            }
        }

        if ($arrPostDate['date'] !== null && $objCounts->numRows > 0) {
            $objUpdate = $this->Database->prepare("
                UPDATE tl_room_occupancy
                %s 
                WHERE date=? 
                AND pid=?")
                ->set($arrPostDate)
                ->execute($strCurrentDate, $intParentId);
        }

        if ($arrPostDate['date'] !== null && $objCounts->numRows < 1) {
            $objInsert = $this->Database->prepare("INSERT INTO tl_room_occupancy %s")
                ->set($arrPostDate)
                ->execute();
        }
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
            $this->redirect($this->addToUrl('&table=tl_room_occupancy&act=edit&id=' . $objDbResult->id));
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
        return '<div><span style="color:#b3b3b3;">' . $GLOBALS['TL_LANG']['tl_room_occupancy']['count'][0] . ': </span>[' . ($arrRow['count'] > 0 ? $arrRow['count'] : '<span style="color:#cc3333;">' . $arrRow['count'] . '</span>') . '] <b>|</b> '
            . '<span style="color:#b3b3b3;">' . $GLOBALS['TL_LANG']['tl_room_occupancy']['price'][0] . ': </span>[' . ($arrRow['price'] > 0 ? $floatPrice : '<span style="color:#cc3333;">' . $floatPrice . '</span>') . '] <b>|</b> '
            . '<span style="color:#b3b3b3;">' . $GLOBALS['TL_LANG']['tl_room_occupancy']['mls'][0] . ': </span>[' . ($arrRow['mls'] > 0 ? $arrRow['mls'] : '<span style="color:#cc3333;">' . $arrRow['mls'] . '</span>') . ']</div>';
    }
}
