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
 * Class HookMyInsertTags 
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
class HookMyInsertTags extends \Frontend
{
    /**
     * Replaces custom insert tags
     * 
     * @param string $strTag Inserttag
     * 
     * @return string 
     */
    public function myReplaceInsertTags($strTag)
    {
        $objSession = Session::getInstance();
        $arrSplit    = explode('::', $strTag);
 
        if ($arrSplit[0] == 'reservation') {
            if (isset($arrSplit[1]) && $arrSplit[1] == 'salutation') {
                $strSalutation = (\Input::post('salutation') === 'male') ? $GLOBALS['TL_LANG']['MSC']['dearSir'].' '.\Input::post('lastname') : 
                    $GLOBALS['TL_LANG']['MSC']['dearMadame'].\Input::post('lastname');
                return $strSalutation;    
            }             
            if (isset($arrSplit[1]) && $arrSplit[1] == 'firstname') {
                return \Input::post('firstname');    
            }            
            if (isset($arrSplit[1]) && $arrSplit[1] == 'lastname') {
                return \Input::post('lastname');    
            }        
            if (isset($arrSplit[1]) && $arrSplit[1] == 'address') {
                return \Input::post('street').' '.\Input::post('postcode').' / '.\Input::post('city').' ['.\Input::post('country').']';    
            }           
            if (isset($arrSplit[1]) && $arrSplit[1] == 'postcode') {
                return \Input::post('postcode');    
            }           
            if (isset($arrSplit[1]) && $arrSplit[1] == 'city') {
                return \Input::post('city');    
            }
            if (isset($arrSplit[1]) && $arrSplit[1] == 'country') {
                return \Input::post('country');    
            }  
            if (isset($arrSplit[1]) && $arrSplit[1] == 'email') {
                return \Input::post('email');    
            }  
            if (isset($arrSplit[1]) && $arrSplit[1] == 'phone') {
                return \Input::post('phone') ? \Input::post('phone') : '-';    
            }            
            if (isset($arrSplit[1]) && $arrSplit[1] == 'remarks') {
                return \Input::post('remarks') ? \Input::post('remarks') : '-';    
            }            
            if (isset($arrSplit[1]) && $arrSplit[1] == 'arrival') {
                return $objSession->get('arrival');
            }           
            if (isset($arrSplit[1]) && $arrSplit[1] == 'departure') {
                return $objSession->get('departure');
            }
            if (isset($arrSplit[1]) && $arrSplit[1] == 'rooms') {
                return is_array($objSession->get('rooms')) ? implode(', ', $objSession->get('rooms')) : $objSession->get('rooms');
            } 
            if (isset($arrSplit[1]) && $arrSplit[1] == 'total') {
                return $objSession->get('priceMessage');
            }
        }
        return false;
    }
      
}
