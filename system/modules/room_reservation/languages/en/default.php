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
 * Miscellaneous
 */
$GLOBALS['TL_LANG']['MSC']['strFormArrival']             = 'Arrival';
$GLOBALS['TL_LANG']['MSC']['strFormDeparture']           = 'Departure';
$GLOBALS['TL_LANG']['MSC']['strFormSubmit']              = 'Check availability';
$GLOBALS['TL_LANG']['MSC']['count']                      = 'Count';
$GLOBALS['TL_LANG']['MSC']['strFormRoomtype']            = 'Choose roomtype';
$GLOBALS['TL_LANG']['MSC']['countError']                 = 'Please choose the desired number of rooms.';
$GLOBALS['TL_LANG']['MSC']['notEnoughRoomsError']        = 'Not enough free rooms during this period.';
$GLOBALS['TL_LANG']['MSC']['noRoomsForRoomtype']         = 'No room free for room type "%s" during this period.';
$GLOBALS['TL_LANG']['MSC']['notEnoughRoomsForTypeError'] = 'Not enough free rooms for roomtype "%s" during this period.';
$GLOBALS['TL_LANG']['MSC']['maxCountError']              = 'Reservation for room type "%s" not possible. Maximum number of rooms for this period: %s.';
$GLOBALS['TL_LANG']['MSC']['mlsError']                   = 'Reservation for room type "%s" not possible. Minimum length of stay: %s nights.';
$GLOBALS['TL_LANG']['MSC']['reservationPossible']        = 'A reservation is possible for this period of time:';
$GLOBALS['TL_LANG']['MSC']['total']                      = 'Total amount: ';
$GLOBALS['TL_LANG']['MSC']['totalOverview']              = 'EUR %s (&#216; EUR %s per overnight stay)';
$GLOBALS['TL_LANG']['MSC']['reservationNotPossible']     = 'Sorry. For this period of time no reservation is possible.';
$GLOBALS['TL_LANG']['MSC']['strFormSalutation']          = 'Gender';
$GLOBALS['TL_LANG']['MSC']['strFormMale']                = 'Mr.';
$GLOBALS['TL_LANG']['MSC']['strFormFemale']              = 'Mrs.';
$GLOBALS['TL_LANG']['MSC']['strFormFirstname']           = 'First name';
$GLOBALS['TL_LANG']['MSC']['strFormLastname']            = 'Last name';
$GLOBALS['TL_LANG']['MSC']['strFormStreet']              = 'Street & house no.';
$GLOBALS['TL_LANG']['MSC']['strFormPostcodeCity']        = 'Post Code / City';
$GLOBALS['TL_LANG']['MSC']['strFormCity']                = 'Post Code / Cit';
$GLOBALS['TL_LANG']['MSC']['strFormCountry']             = 'Country';
$GLOBALS['TL_LANG']['MSC']['strFormEmail']               = 'E-Mail';
$GLOBALS['TL_LANG']['MSC']['strFormPhone']               = 'Phone number';
$GLOBALS['TL_LANG']['MSC']['strFormRemarks']             = 'Remarks';
$GLOBALS['TL_LANG']['MSC']['strFormConfirmation']        = 'Confirmation';
$GLOBALS['TL_LANG']['MSC']['strFormConfirmationText']    = 'I hereby confirm the binding reservation.';
$GLOBALS['TL_LANG']['MSC']['strFormReservationSubmit']   = 'Binding reservation';
$GLOBALS['TL_LANG']['MSC']['strFormReservationSuccess']  = 'Thank you for your reservation! You will shortly receive an email with further information.';
$GLOBALS['TL_LANG']['MSC']['dateOfArrival']              = 'Date of arrival:';
$GLOBALS['TL_LANG']['MSC']['dateOfDeparture']            = 'Date of Departure:';
$GLOBALS['TL_LANG']['MSC']['rooms']                      = 'Room(s):';
$GLOBALS['TL_LANG']['MSC']['showTotalOverview']          = '[View details]';
$GLOBALS['TL_LANG']['MSC']['date']                       = 'Date';
$GLOBALS['TL_LANG']['MSC']['price']                      = 'Price*';
$GLOBALS['TL_LANG']['MSC']['type']                       = 'Room type';
$GLOBALS['TL_LANG']['MSC']['inclusive']                  = '* (incl. Breakfast, Service, VAT)';
$GLOBALS['TL_LANG']['MSC']['reserveNow']                 = 'Make a reservation now »';
$GLOBALS['TL_LANG']['MSC']['backToStart']                = '« back to home';
$GLOBALS['TL_LANG']['MSC']['dearSir']                    = 'Dear Mr.';
$GLOBALS['TL_LANG']['MSC']['dearMadame']                 = 'Dear Mrs.';
