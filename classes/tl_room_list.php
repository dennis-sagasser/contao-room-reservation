<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2017 Leo Feyer
 *
 *
 * PHP version 7
 *
 * @category    Contao
 * @package     RoomReservation
 * @author      Dennis Sagasser <dennis.sagasser@gmail.com>
 * @copyright   2014 Dennis Sagasser
 * @license     LGPL-3.0+
 * @link        https://contao.org
 */

namespace Contao;

/**
 * Class tl_room_list
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 *
 * @category  Contao
 * @package   RoomReservation
 * @author    Dennis Sagasser <sagasser@gispack.com>
 * @copyright 2017 Dennis Sagasser
 * @license   http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 * @link      https://contao.org
 */
class tl_room_list extends \Backend
{

    /**
     * Parent call of the constructor.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Generate custom filter select
     *
     * @return string $strBuffer Filter select
     */
    public function generateFilter()
    {
        if (\Input::get('id') > 0) {
            return '';
        }

        $objSession     = \Session::getInstance()->getData();
        $strFilterValue = isset($objSession['filter']['tl_room_list']['room_filter']) ?
            $objSession['filter']['tl_room_list']['room_filter'] :
            'future';

        $objWidgetFilter           = new \SelectMenu();
        $objWidgetFilter->id       = 'room_filter';
        $objWidgetFilter->name     = 'room_filter';
        $objWidgetFilter->value    = $strFilterValue;
        $objWidgetFilter->options  = [
            ['value' => 'room_filter', 'label' => $GLOBALS['TL_LANG']['tl_room_list']['timeSlot']],
            ['value' => 'room_filter', 'label' => '---'],
            ['value' => 'all', 'label' => $GLOBALS['TL_LANG']['tl_room_list']['all']],
            ['value' => 'future', 'label' => $GLOBALS['TL_LANG']['tl_room_list']['future']],
            ['value' => 'past', 'label' => $GLOBALS['TL_LANG']['tl_room_list']['past']],
            ['value' => 'today', 'label' => $GLOBALS['TL_LANG']['tl_room_list']['today']],
            ['value' => 'thisWeek', 'label' => $GLOBALS['TL_LANG']['tl_room_list']['thisWeek']],
            ['value' => 'thisMonth', 'label' => $GLOBALS['TL_LANG']['tl_room_list']['thisMonth']],
            ['value' => 'thisYear', 'label' => $GLOBALS['TL_LANG']['tl_room_list']['thisYear']],
        ];
        $objWidgetFilter->onchange = "this.form.submit()";

        $strWidgetCheckbox = '';
        $strWidgetCheckbox .= $objWidgetFilter->generate();
        $strWidgetCheckbox .= $objWidgetFilter->generateLabel();

        $strBuffer = '<div class="tl_filter tl_subpanel" style="padding-left:4px">' . $strWidgetCheckbox;

        return $strBuffer . '</div>';
    }


    /**
     * Apply custom filter for reservation list
     *
     */
    public function applyFilter()
    {
        $objSession = \Session::getInstance()->getData();

        // Store filter values in the session
        foreach ($_POST as $key => $value) {
            if (substr($key, 0, 5) != 'room_') {
                continue;
            }
            log_message($key, 'debug.log');
            log_message(\Input::post($key), 'debug.log');
            // Reset the filter
            if ($key == \Input::post($key)) {
                $objSession['filter']['tl_room_list'][$key] = 'future';
            } // Apply the filter
            else {
                $objSession['filter']['tl_room_list'][$key] = \Input::post($key);
            }
        }

        \Session::getInstance()->setData($objSession);

        if (\Input::get('id') > 0 || !isset($objSession['filter']['tl_room_list'])) {
            return;
        }

        $objDate = new \Date(time());

        // Filter reservations
        foreach ($objSession['filter']['tl_room_list'] as $key => $value) {
            if (substr($key, 0, 5) != 'room_') {
                continue;
            }

            switch ($value) {
                case 'future':
                    $arrReservations = \Database::getInstance()->prepare("
                        SELECT id 
                        FROM tl_room_list 
                        WHERE arrival >= ?")
                        ->execute($objDate->dayBegin)->fetchEach('id');
                    break;
                case 'today':
                    $arrReservations = \Database::getInstance()->prepare("
                        SELECT id 
                        FROM tl_room_list 
                        WHERE arrival  BETWEEN ? AND ?")
                        ->execute($objDate->dayBegin, $objDate->dayEnd)->fetchEach('id');
                    break;
                case 'thisWeek':
                    $arrReservations = \Database::getInstance()->prepare("
                        SELECT id 
                        FROM tl_room_list 
                        WHERE arrival BETWEEN ? AND ?")
                        ->execute($objDate->getWeekBegin(1), $objDate->getWeekEnd(0))->fetchEach('id');
                    break;
                case 'thisMonth':
                    $arrReservations = \Database::getInstance()->prepare("
                        SELECT id 
                        FROM tl_room_list 
                        WHERE arrival BETWEEN ? AND ?")
                        ->execute($objDate->monthBegin, $objDate->monthEnd)->fetchEach('id');
                    break;
                case 'thisYear':
                    $arrReservations = \Database::getInstance()->prepare("
                        SELECT id 
                        FROM tl_room_list 
                        WHERE arrival BETWEEN ? AND ?")
                        ->execute($objDate->yearBegin, $objDate->yearEnd)->fetchEach('id');
                    break;
                case 'past':
                    $arrReservations = \Database::getInstance()->prepare("
                        SELECT id 
                        FROM tl_room_list 
                        WHERE arrival < ?")
                        ->execute($objDate->dayBegin)->fetchEach('id');
                    break;
                default:
                    $arrReservations = \Database::getInstance()->prepare("
                        SELECT id 
                        FROM tl_room_list ")
                        ->execute()->fetchEach('id');
                    break;
            }
        }

        if (is_array($arrReservations) && empty($arrReservations)) {
            $arrReservations = [0];
        }
        $GLOBALS['TL_DCA']['tl_room_list']['list']['sorting']['root'] = $arrReservations;
    }
}