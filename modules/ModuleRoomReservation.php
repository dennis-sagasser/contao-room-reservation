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
 * Generates and validates the forms for the frontend.
 *
 * @category  Contao
 * @package   RoomReservation
 * @author    Dennis Sagasser <sagasser@gispack.com>
 * @copyright 2014 Dennis Sagasser
 * @license   http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 * @link      https://contao.org
 */

class ModuleRoomReservation extends \Module
{
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'mod_room_reservation_form';

    /**
     * @var \Session $objSession Session object
     */
    protected $objSession = null;

    /**
     * Redirect to the selected page
     *
     * @return string
     */
    public function generate()
    {
        return parent::generate();
    }

    /**
     * Generate module
     *
     */
    protected function compile()
    {
        $this->objSession           = \Session::getInstance();
        $this->Template->objSession = $this->objSession;

        $this->loadLanguageFile('tl_room_reservation');

        // Initialize form fields
        $objWidgetArrival                = new \FormCalendarField();
        $objWidgetArrival->dateImage     = true;
        $objWidgetArrival->id            = 'arrival';
        $objWidgetArrival->label         = $GLOBALS['TL_LANG']['MSC']['room_reservation']['formArrival'];
        $objWidgetArrival->name          = 'arrival';
        $objWidgetArrival->mandatory     = true;
        $objWidgetArrival->rgxp          = 'date';
        $objWidgetArrival->dateDirection = 'geToday';
        $objWidgetArrival->draggable     = false;
        $objWidgetArrival->dateFormat    = \Config::get('dateFormat');
        $objWidgetArrival->value         = \Input::post('arrival');

        $this->Template->objWidgetArrival = $objWidgetArrival;

        $objWidgetDeparture                = new \FormCalendarField();
        $objWidgetDeparture->dateImage     = true;
        $objWidgetDeparture->id            = 'departure';
        $objWidgetDeparture->label         = $GLOBALS['TL_LANG']['MSC']['room_reservation']['formDeparture'];
        $objWidgetDeparture->name          = 'departure';
        $objWidgetDeparture->mandatory     = true;
        $objWidgetDeparture->rgxp          = 'date';
        $objWidgetDeparture->dateDirection = '+1';
        $objWidgetArrival->draggable       = false;
        $objWidgetArrival->dateFormat      = \Config::get('dateFormat');
        $objWidgetDeparture->value         = \Input::post('departure');

        $this->Template->objWidgetDeparture = $objWidgetDeparture;

        $objWidgetSubmit         = new \FormSubmit();
        $objWidgetSubmit->id     = 'submit';
        $objWidgetSubmit->class  = 'btn btn-default';
        $objWidgetSubmit->slabel = $GLOBALS['TL_LANG']['MSC']['room_reservation']['formSubmit'];

        $this->Template->objWidgetSubmit = $objWidgetSubmit;

        $objTypeSettings = $this->Database->prepare("
            SELECT id AS value, roomtype AS label, maxcount
            FROM tl_room_type 
            WHERE published = '1' 
            AND (? BETWEEN start AND stop OR (start = '' AND stop = '')) 
            ORDER BY roomtype")
            ->execute(time());

        $arrSelect = [];

        while ($objTypeSettings->next()) {
            $arrSelectOptions = [];
            for ($i = 0; $i <= $objTypeSettings->maxcount; $i++) {
                $arrSelectOptions[$i] = ['value' => $i, 'label' => $i];
            }
            $objSelectMenu          = new \FormSelectMenu();
            $objSelectMenu->id      = $objTypeSettings->value;
            $objSelectMenu->label   = $GLOBALS['TL_LANG']['MSC']['room_reservation']['count'] . ' ' . $objTypeSettings->label;
            $objSelectMenu->name    = $objTypeSettings->value;
            $objSelectMenu->options = $arrSelectOptions;

            $arrSelect[] = $objSelectMenu;
        }

        $this->Template->arrSelects = $arrSelect;

        $objWidgetCheckboxes            = new \FormCheckBox();
        $objWidgetCheckboxes->id        = 'roomtype';
        $objWidgetCheckboxes->label     = $GLOBALS['TL_LANG']['MSC']['room_reservation']['formRoomtype'];
        $objWidgetCheckboxes->name      = 'roomtype';
        $objWidgetCheckboxes->mandatory = true;
        $objWidgetCheckboxes->options   = $objTypeSettings->fetchAllAssoc();
        $objWidgetCheckboxes->value     = \Input::post('roomtype');

        $this->Template->objWidgetCheckboxes = $objWidgetCheckboxes;

        if (\Input::post('FORM_SUBMIT') === 'form_availability_submit') {
            $this->compileAvailabilityCheck(
                $objWidgetArrival,
                $objWidgetDeparture,
                $objWidgetCheckboxes
            );
        }

        if (\Input::get('FORM_PAGE') === 'page2' && $this->objSession->get('rooms')) {

            $this->strTemplate           = 'mod_room_reservation_form_page2';
            $this->Template              = new \FrontendTemplate($this->strTemplate);
            $this->Template->infoMessage = $GLOBALS['TL_LANG']['MSC']['room_reservation']['reservationPossible'];
            $this->Template->arrSeats    = $this->objSession->get('rooms');
            $this->Template->objSession  = $this->objSession;

            $objWidgetSalutation          = new \FormRadioButton();
            $objWidgetSalutation->id      = 'salutation';
            $objWidgetSalutation->label   = $GLOBALS['TL_LANG']['MSC']['room_reservation']['formSalutation'];
            $objWidgetSalutation->name    = 'salutation';
            $objWidgetSalutation->options = [
                ['value' => 'male', 'label' => $GLOBALS['TL_LANG']['MSC']['room_reservation']['formMale']],
                ['value' => 'female', 'label' => $GLOBALS['TL_LANG']['MSC']['room_reservation']['formFemale']]
            ];

            $this->Template->objWidgetSalutation = $objWidgetSalutation;

            $objWidgetFirstName        = new \FormTextField();
            $objWidgetFirstName->id    = 'firstname';
            $objWidgetFirstName->label = $GLOBALS['TL_LANG']['MSC']['room_reservation']['formFirstname'];
            $objWidgetFirstName->name  = 'firstname';
            $objWidgetFirstName->rgxp  = 'alpha';
            $objWidgetFirstName->value = \Input::post('firstname');

            $this->Template->objWidgetFirstName = $objWidgetFirstName;

            $objWidgetLastName            = new \FormTextField();
            $objWidgetLastName->id        = 'lastname';
            $objWidgetLastName->label     = $GLOBALS['TL_LANG']['MSC']['room_reservation']['formLastname'];
            $objWidgetLastName->name      = 'lastname';
            $objWidgetLastName->mandatory = true;
            $objWidgetLastName->rgxp      = 'alpha';
            $objWidgetLastName->value     = \Input::post('lastname');

            $this->Template->objWidgetLastName = $objWidgetLastName;

            $objWidgetStreet            = new \FormTextField();
            $objWidgetStreet->id        = 'street';
            $objWidgetStreet->label     = $GLOBALS['TL_LANG']['MSC']['room_reservation']['formStreet'];
            $objWidgetStreet->name      = 'street';
            $objWidgetStreet->mandatory = true;
            $objWidgetStreet->rgxp      = 'alnum';
            $objWidgetStreet->value     = \Input::post('street');

            $this->Template->objWidgetStreet = $objWidgetStreet;

            $objWidgetPostCode            = new \FormTextField();
            $objWidgetPostCode->id        = 'postcode';
            $objWidgetPostCode->label     = $GLOBALS['TL_LANG']['MSC']['room_reservation']['formPostcodeCity'];
            $objWidgetPostCode->name      = 'postcode';
            $objWidgetPostCode->mandatory = true;
            $objWidgetPostCode->rgxp      = 'alnum';
            $objWidgetPostCode->value     = \Input::post('postcode');

            $this->Template->objWidgetPostCode = $objWidgetPostCode;

            $objWidgetCity            = new \FormTextField();
            $objWidgetCity->id        = 'city';
            $objWidgetCity->label     = $GLOBALS['TL_LANG']['MSC']['room_reservation']['formPostcodeCity'];
            $objWidgetCity->name      = 'city';
            $objWidgetCity->mandatory = true;
            $objWidgetCity->rgxp      = 'alpha';
            $objWidgetCity->value     = \Input::post('city');

            $this->Template->objWidgetCity = $objWidgetCity;

            $objWidgetCountry            = new \FormTextField();
            $objWidgetCountry->id        = 'country';
            $objWidgetCountry->label     = $GLOBALS['TL_LANG']['MSC']['room_reservation']['formCountry'];
            $objWidgetCountry->name      = 'country';
            $objWidgetCountry->mandatory = true;
            $objWidgetCountry->rgxp      = 'alpha';
            $objWidgetCountry->value     = \Input::post('country');

            $this->Template->objWidgetCountry = $objWidgetCountry;

            $objWidgetEmail            = new \FormTextField();
            $objWidgetEmail->id        = 'email';
            $objWidgetEmail->label     = $GLOBALS['TL_LANG']['MSC']['room_reservation']['formEmail'];
            $objWidgetEmail->name      = 'email';
            $objWidgetEmail->mandatory = true;
            $objWidgetEmail->rgxp      = 'email';
            $objWidgetEmail->value     = \Input::post('email');

            $this->Template->objWidgetEmail = $objWidgetEmail;

            $objWidgetPhone            = new \FormTextField();
            $objWidgetPhone->id        = 'phone';
            $objWidgetPhone->label     = $GLOBALS['TL_LANG']['MSC']['room_reservation']['formPhone'];
            $objWidgetPhone->name      = 'phone';
            $objWidgetPhone->mandatory = false;
            $objWidgetPhone->rgxp      = 'phone';
            $objWidgetPhone->value     = \Input::post('phone');

            $this->Template->objWidgetPhone = $objWidgetPhone;

            $objWidgetRemarks            = new \FormTextArea();
            $objWidgetRemarks->id        = 'remarks';
            $objWidgetRemarks->label     = $GLOBALS['TL_LANG']['MSC']['room_reservation']['formRemarks'];
            $objWidgetRemarks->name      = 'remarks';
            $objWidgetRemarks->mandatory = false;
            $objWidgetRemarks->value     = \Input::post('remarks');

            $this->Template->objWidgetRemarks = $objWidgetRemarks;

            $objWidgetCaptcha            = new \FormCaptcha();
            $objWidgetCaptcha->id        = 'captcha';
            $objWidgetCaptcha->label     = $GLOBALS['TL_LANG']['MSC']['room_reservation']['room_reservation']['formCaptcha'];
            $objWidgetCaptcha->name      = 'captcha';
            $objWidgetCaptcha->mandatory = true;
            $objWidgetCaptcha->value     = \Input::post('captcha');

            $this->Template->objWidgetCaptcha = $objWidgetCaptcha;

            $objWidgetConfirmation            = new \FormCheckBox();
            $objWidgetConfirmation->id        = 'confirmation';
            $objWidgetConfirmation->label     = $GLOBALS['TL_LANG']['MSC']['room_reservation']['formConfirmation'];
            $objWidgetConfirmation->name      = 'confirmation';
            $objWidgetConfirmation->mandatory = true;
            $objWidgetConfirmation->options   = [
                ['value' => '1', 'label' => $GLOBALS['TL_LANG']['MSC']['room_reservation']['formConfirmationText']]
            ];
            $objWidgetConfirmation->value     = \Input::post('confirmation');

            $this->Template->objWidgetConfirmation = $objWidgetConfirmation;

            $objWidgetSubmit        = new \FormSubmit();
            $objWidgetSubmit->id    = 'submit';
            $objWidgetSubmit->label = $GLOBALS['TL_LANG']['MSC']['room_reservation']['formReservationSubmit'];

            $this->Template->objWidgetSubmit = $objWidgetSubmit;

        }
        if (\Input::post('FORM_SUBMIT') === 'form_reservation_submit' && $this->objSession->get('rooms')) {
            $this->compileReservationCheck(
                $objWidgetSalutation,
                $objWidgetFirstName,
                $objWidgetLastName,
                $objWidgetStreet,
                $objWidgetPostCode,
                $objWidgetCity,
                $objWidgetCountry,
                $objWidgetEmail,
                $objWidgetPhone,
                $objWidgetRemarks,
                $objWidgetCaptcha,
                $objWidgetConfirmation
            );
        }
    }

    /**
     * Sends a confirmation mail to the user
     *
     */
    public function send()
    {
        $objSettings = $this->Database->prepare("SELECT * FROM tl_room_settings")->limit(1)->execute();

        // Overwrite the SMTP configuration
        if ($objSettings->useSMTP) {
            \Config::set('useSMTP', true);
            \Config::set('smtpHost', $objSettings->smtpHost);
            \Config::set('smtpUser', $objSettings->smtpUser);
            \Config::set('smtpPass', $objSettings->smtpPass);
            \Config::set('smtpEnc', $objSettings->smtpEnc);
            \Config::set('smtpPort', $objSettings->smtpPort);
        }

        // Add default sender address
        if ($objSettings->sender == '') {
            list($objSettings->senderName, $objSettings->sender) = \StringUtil::splitFriendlyEmail(
                \Config::get('adminEmail')
            );
        }

        // Add default Bcc
        if ($objSettings->bCc == '') {
            list($objSettings->senderName, $objSettings->bCc) = \StringUtil::splitFriendlyEmail(
                \Config::get('adminEmail')
            );
        }

        $arrAttachments            = [];
        $blnAttachmentsFormatError = false;

        // Add attachments
        if ($objSettings->addFile) {
            $files = deserialize($objSettings->files);

            if (!empty($files) && is_array($files)) {
                $objFiles = \FilesModel::findMultipleByUuids($files);

                if ($objFiles === null) {
                    if (!\Validator::isUuid($files[0])) {
                        $blnAttachmentsFormatError = true;
                        \Message::addError($GLOBALS['TL_LANG']['ERR']['version2format']);
                    }
                } else {
                    while ($objFiles->next()) {
                        if (is_file(TL_ROOT . '/' . $objFiles->path)) {
                            $arrAttachments[] = $objFiles->path;
                        }
                    }
                }
            }
        }

        // Replace insert tags
        $strHtml = $this->replaceInsertTags($objSettings->content);
        $strText = $this->replaceInsertTags($objSettings->text);

        // Convert relative URLs
        if ($objSettings->externalImages) {
            $strHtml = $this->convertRelativeUrls($strHtml);
        }

        // Send newsletter
        if (!$blnAttachmentsFormatError) {
            // Send newsletter
            $objEmail = $this->generateEmailObject($objSettings, $arrAttachments);
            $this->sendConfirmation($objEmail, $objSettings, \Input::post('email'), $strText, $strHtml);
        }
    }

    /**
     * Generate the e-mail object and return it
     *
     * @param \Database\Result $objSettings Database result
     * @param array $arrAttachments E-mail attachments
     *
     * @return \Email
     */
    protected
    function generateEmailObject(\Database\Result $objSettings, $arrAttachments)
    {
        $objEmail = new \Email();

        $objEmail->from    = $objSettings->sender;
        $objEmail->subject = $objSettings->subject;
        $objEmail->sendBcc($objSettings->bCc);

        // Add sender name
        if ($objSettings->senderName != '') {
            $objEmail->fromName = $objSettings->senderName;
        }

        $objEmail->embedImages = !$objSettings->externalImages;
        $objEmail->logFile     = 'reservation_' . $objSettings->id . '.log';

        // Attachments
        if (!empty($arrAttachments) && is_array($arrAttachments)) {
            foreach ($arrAttachments as $strAttachment) {
                $objEmail->attachFile(TL_ROOT . '/' . $strAttachment);
            }
        }

        return $objEmail;
    }

    /**
     * Compile the confirmation and send it
     *
     * @param \Email $objEmail E-mail object
     * @param \Database\Result $objSettings Database result
     * @param string $strRecipient Recipient
     * @param string $strText Plain text
     * @param string $strHtml HTML text
     * @param string $css CSS
     *
     */
    protected function sendConfirmation(
        \Email $objEmail,
        \Database\Result $objSettings,
        $strRecipient,
        $strText,
        $strHtml,
        $css = null
    )
    {
        $arrRecipients['email'] = $strRecipient;

        // Prepare the text content
        $objEmail->text = \StringUtil::parseSimpleTokens($strText, $arrRecipients);

        // Add the HTML content
        if (!$objSettings->sendText) {
            // Default template
            if ($objSettings->template == '') {
                $objSettings->template = 'mail_default';
            }

            /** @var \BackendTemplate|object $objTemplate */
            $objTemplate = new \BackendTemplate($objSettings->template);
            $objTemplate->setData($objSettings->row());

            $objTemplate->title     = $objSettings->subject;
            $objTemplate->body      = \StringUtil::parseSimpleTokens($strHtml, $arrRecipients);
            $objTemplate->charset   = \Config::get('characterSet');
            $objTemplate->css       = $css; // Backwards compatibility
            $objTemplate->recipient = $arrRecipients['email'];

            // Parse template
            $objEmail->html     = $objTemplate->parse();
            $objEmail->imageDir = TL_ROOT . '/';
        }

        // Deactivate invalid addresses
        try {
            $objEmail->sendTo($arrRecipients['email']);
        } catch (\Swift_RfcComplianceException $e) {
            $_SESSION['REJECTED_RECIPIENTS'][] = $arrRecipients['email'];
        }

        // Rejected recipients
        if ($objEmail->hasFailures()) {
            $_SESSION['REJECTED_RECIPIENTS'][] = $arrRecipients['email'];
        }
    }

    /**
     * Check submitted availability form and display result
     *
     * @param \Widget $objWidgetArrival Reservation start date
     * @param \Widget $objWidgetDeparture Reservation end date
     * @param \Widget $objWidgetCheckboxes Room type checkboxes
     *
     */
    protected function compileAvailabilityCheck(
        \Widget $objWidgetArrival,
        \Widget $objWidgetDeparture,
        \Widget $objWidgetCheckboxes
    )
    {
        $objArrivalDate     = new \Date(\Input::post('arrival'), $GLOBALS['TL_CONFIG']['dateFormat']);
        $objDepartureDate   = new \Date(\Input::post('departure'), $GLOBALS['TL_CONFIG']['dateFormat']);
        $intTstampArrival   = $objArrivalDate->tstamp;
        $intTstampDeparture = $objDepartureDate->tstamp;
        $strStartDate       = date('Y-m-d', $intTstampArrival);
        $strEndDate         = date('Y-m-d', $intTstampDeparture);
        $intDifference      = ($intTstampDeparture - $intTstampArrival) / 86400;
        $intTotal           = 0;

        $objWidgetArrival->validate();
        $objWidgetDeparture->validate();
        $objWidgetCheckboxes->validate();

        $arrPostRoomtype = is_array(\Input::post('roomtype')) ?
            \Input::post('roomtype') :
            [\Input::post('roomtype')];
        $arrRooms        = [];

        foreach ($arrPostRoomtype as $intRoomtype) {
            (intval(\Input::post($intRoomtype)) < 1) ?
                $objWidgetCheckboxes->addError($GLOBALS['TL_LANG']['MSC']['room_reservation']['countError']) :
                $arrResultRow = $this->Database->prepare("
                    SELECT 
                      count(*) AS countAvailableNights, 
                      MIN(count) AS minCount, 
                      (SUM(price) * ?) AS total, 
                      roomtype AS type, 
                      mls
                    FROM 
                      tl_room_occupancy o, tl_room_type t 
                    WHERE date >= ? 
                    AND date < ?
                    AND pid = ?
                    AND o.pid = t.id")
                    ->execute(intval(\Input::post($intRoomtype)), $strStartDate, $strEndDate, $intRoomtype)
                    ->fetchAssoc();

            if ($arrResultRow['minCount'] === null) {
                $objWidgetCheckboxes->addError(sprintf(
                    $GLOBALS['TL_LANG']['MSC']['room_reservation']['notEnoughRoomsError']
                ));

                return;
            }

            if (intval($arrResultRow['minCount']) === 0) {
                $objWidgetCheckboxes->addError(
                    sprintf(
                        $GLOBALS['TL_LANG']['MSC']['room_reservation']['noRoomsForRoomtype'],
                        $arrResultRow['type']
                    )
                );
                return;
            }

            if (intval($arrResultRow['countAvailableNights']) !== $intDifference) {
                $objWidgetCheckboxes->addError(
                    sprintf(
                        $GLOBALS['TL_LANG']['MSC']['room_reservation']['notEnoughRoomsForTypeError'],
                        $arrResultRow['type']
                    )
                );
                return;
            }

            if (intval(\Input::post($intRoomtype)) > intval($arrResultRow['minCount'])) {
                $objWidgetCheckboxes->addError(
                    sprintf(
                        $GLOBALS['TL_LANG']['MSC']['room_reservation']['maxCountError'],
                        $arrResultRow['type'],
                        $arrResultRow['minCount']
                    )
                );
                return;
            }
            if (intval($arrResultRow['mls']) > $intDifference) {
                $objWidgetCheckboxes->addError(
                    sprintf(
                        $GLOBALS['TL_LANG']['MSC']['room_reservation']['mlsError'],
                        $arrResultRow['type'],
                        $arrResultRow['minCount']
                    )
                );
                return;
            }

            $arrResult = $this->Database->prepare("
                SELECT 
                  date, 
                  (price * ?) AS price, 
                  roomtype
                FROM 
                  tl_room_occupancy o, tl_room_type t 
                WHERE date >= ? 
                AND date < ?
                AND pid = ?
                AND o.pid = t.id 
                ORDER BY date, roomtype")
                ->execute(intval(\Input::post($intRoomtype)), $strStartDate, $strEndDate, $intRoomtype)
                ->fetchAllAssoc();

            $arrOverview[]   = $arrResult;
            $arrRooms[]      = \Input::post($intRoomtype) . ' ' . $arrResult[0]['roomtype'];
            $arrRoomtypes[]  = $intRoomtype;
            $arrCountRooms[] = intval(\Input::post($intRoomtype));
            $intTotal        = $intTotal + intval($arrResultRow['total']);
        }

        if (!$objWidgetCheckboxes->hasErrors() &&
            !$objWidgetArrival->hasErrors() &&
            !$objWidgetDeparture->hasErrors()
            && $intTotal !== 0
        ) {
            $floatAverage                 = $intTotal / $intDifference;
            $this->Template->infoMessage  = $GLOBALS['TL_LANG']['MSC']['room_reservation']['reservationPossible'];
            $this->Template->priceMessage = sprintf(
                $GLOBALS['TL_LANG']['MSC']['room_reservation']['totalOverview'],
                \System::getFormattedNumber($intTotal),
                \System::getFormattedNumber($floatAverage)
            );
            $arrTypesCount                = array_combine($arrRoomtypes, $arrCountRooms);

            $strReserveNowUrl                 = $this->addToUrl('FORM_PAGE=page2');
            $this->Template->strReserveNowUrl = $strReserveNowUrl;

            $this->objSession->set('arrival', date(\Config::get('dateFormat'), strtotime(\Input::post('arrival'))));
            $this->objSession->set('departure', date(\Config::get('dateFormat'), strtotime(\Input::post('departure'))));
            $this->objSession->set('rooms', $arrRooms);
            $this->objSession->set('priceMessage', $this->Template->priceMessage);
            $this->objSession->set('typesCount', $arrTypesCount);
            $this->objSession->set('tstampArrival', $intTstampArrival);
            $this->objSession->set('tstampDeparture', $intTstampDeparture);
            $this->objSession->set('arrOverview', $arrOverview);
        } else {
            $this->Template->errorMessage = $GLOBALS['TL_LANG']['MSC']['room_reservation']['reservationNotPossible'];
        }
    }

    /**
     * Check submitted reservation form and display result
     *
     * @param \Widget $objWidgetSalutation Salutation radio button
     * @param \Widget $objWidgetFirstName Firstname input
     * @param \Widget $objWidgetLastName Lastname input
     * @param \Widget $objWidgetEmail Email input
     * @param \Widget $objWidgetPhone Phone input
     * @param \Widget $objWidgetRemarks Remarks textarea
     * @param \Widget $objWidgetCaptcha captcha input
     * @param \Widget $objWidgetConfirmation Confirmation checkbox
     *
     */
    protected function compileReservationCheck(
        \Widget $objWidgetSalutation,
        \Widget $objWidgetFirstName,
        \Widget $objWidgetLastName,
        \Widget $objWidgetStreet,
        \Widget $objWidgetPostCode,
        \Widget $objWidgetCity,
        \Widget $objWidgetCountry,
        \Widget $objWidgetEmail,
        \Widget $objWidgetPhone,
        \Widget $objWidgetRemarks,
        \Widget $objWidgetCaptcha,
        \Widget $objWidgetConfirmation
    )
    {
        $objWidgetSalutation->validate();
        $objWidgetFirstName->validate();
        $objWidgetLastName->validate();
        $objWidgetStreet->validate();
        $objWidgetPostCode->validate();
        $objWidgetCity->validate();
        $objWidgetCountry->validate();
        $objWidgetEmail->validate();
        $objWidgetPhone->validate();
        $objWidgetRemarks->validate();
        $objWidgetCaptcha->validate();
        $objWidgetConfirmation->validate();

        if (!$objWidgetSalutation->hasErrors() &&
            !$objWidgetFirstName->hasErrors() &&
            !$objWidgetLastName->hasErrors() &&
            !$objWidgetStreet->hasErrors() &&
            !$objWidgetPostCode->hasErrors() && !$objWidgetCity->hasErrors() &&
            !$objWidgetCountry->hasErrors() && !$objWidgetEmail->hasErrors() &&
            !$objWidgetPhone->hasErrors() && !$objWidgetRemarks->hasErrors() &&
            !$objWidgetConfirmation->hasErrors()
        ) {

            $intCurrentTstamp  = $this->objSession->get('tstampArrival');
            $arrTypesCount     = $this->objSession->get('typesCount');
            $arrTypesCountKeys = array_keys($arrTypesCount);

            while ($intCurrentTstamp < $this->objSession->get('tstampDeparture')) {
                $strCurrentDate = date('Y-m-d', $intCurrentTstamp);
                foreach ($arrTypesCountKeys as $intRoomtype) {
                    $objSetRoomCount = $this->Database->prepare("
                            UPDATE tl_room_occupancy 
                            SET count = count - ? 
                            WHERE pid = ? 
                            AND date = ?")
                        ->execute($arrTypesCount[$intRoomtype], $intRoomtype, $strCurrentDate);
                }

                $intCurrentTstamp = $intCurrentTstamp + 86400;
            }

            $this->strTemplate           = 'mod_room_reservation_form_success';
            $this->Template              = new \FrontendTemplate($this->strTemplate);
            $this->Template->infoMessage = $GLOBALS['TL_LANG']['MSC']['room_reservation']['formReservationSuccess'];
            $this->send();

            $objInsertReservation = $this->Database->prepare("
                    INSERT INTO tl_room_list 
                    (arrival, departure, tstamp, rooms, lastname, firstname, address, postcode, country, phone, email, remarks)
                    VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")
                ->execute($this->objSession->get('tstampArrival'),
                    $this->objSession->get('tstampDeparture'),
                    time(),
                    $this->objSession->get('rooms'),
                    \Input::post('lastname'),
                    \Input::post('firstname'),
                    \Input::post('street') . ' ' . \Input::post('postcode') . ' / ' . \Input::post('city') . ' [' . \Input::post('country') . ']',
                    \Input::post('postcode'),
                    \Input::post('country'),
                    \Input::post('phone'),
                    \Input::post('email'),
                    \Input::post('remarks'));

            $this->objSession->remove('tstampArrival');
            $this->objSession->remove('tstampDeparture');
            $this->objSession->remove('typesCount');
            $this->objSession->remove('arrival');
            $this->objSession->remove('departure');
            $this->objSession->remove('priceMessage');
            $this->objSession->remove('rooms');
            $this->objSession->remove('arrOverview');
        }
    }
}
