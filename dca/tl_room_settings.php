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
 * Table tl_room_settings
 */
$GLOBALS['TL_DCA']['tl_room_settings'] = [
    // Config
    'config'      => [
        'dataContainer'    => 'Table',
        'onload_callback'  => [
            ['tl_room_settings', 'checkConfig'],
        ],
        'enableVersioning' => true,
        'sql'              => [
            'keys' => [
                'id' => 'primary',
            ]
        ]
    ],

    // Palettes
    'palettes'    => [
        '__selector__' => ['addFile', 'useSMTP'],
        'default'      => '{title_legend},subject;{html_legend},content;{text_legend:hide},text;{attachment_legend},addFile;{template_legend:hide},template;{expert_legend:hide},sendText,externalImages,senderName,sender,bCc;{smtp_legend:hide},useSMTP'
    ],

    // Subpalettes
    'subpalettes' => [
        'addFile' => 'files',
        'useSMTP' => 'smtpHost,smtpUser,smtpPass,smtpEnc,smtpPort'
    ],

    // Fields
    'fields'      => [
        'id'             => [
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ],
        'tstamp'         => [
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ],
        'subject'        => [
            'label'     => &$GLOBALS['TL_LANG']['tl_room_settings']['subject'],
            'exclude'   => true,
            'search'    => true,
            'sorting'   => true,
            'flag'      => 1,
            'inputType' => 'text',
            'eval'      => ['mandatory' => true, 'decodeEntities' => true, 'maxlength' => 128, 'tl_class' => 'w50'],
            'sql'       => "varchar(255) NOT NULL default ''",
            'default'   => $GLOBALS['TL_LANG']['tl_room_settings']['default_subject']
        ],
        'content'        => [
            'label'         => &$GLOBALS['TL_LANG']['tl_room_settings']['content'],
            'exclude'       => true,
            'search'        => true,
            'inputType'     => 'textarea',
            'eval'          => ['rte' => 'tinyNews', 'helpwizard' => true],
            'explanation'   => 'insertTags',
            'default'       => $GLOBALS['TL_LANG']['tl_room_settings']['default_html_text'],
            'load_callback' => [
                ['tl_room_settings', 'convertAbsoluteLinks']
            ],
            'save_callback' => [
                ['tl_room_settings', 'convertRelativeLinks']
            ],
            'sql'           => "mediumtext NULL"
        ],
        'text'           => [
            'label'     => &$GLOBALS['TL_LANG']['tl_room_settings']['text'],
            'exclude'   => true,
            'search'    => true,
            'inputType' => 'textarea',
            'eval'      => ['decodeEntities' => true, 'class' => 'noresize'],
            'sql'       => "mediumtext NULL"
        ],
        'addFile'        => [
            'label'     => &$GLOBALS['TL_LANG']['tl_room_settings']['addFile'],
            'exclude'   => true,
            'filter'    => true,
            'inputType' => 'checkbox',
            'eval'      => ['submitOnChange' => true],
            'sql'       => "char(1) NOT NULL default ''"
        ],
        'files'          => [
            'label'     => &$GLOBALS['TL_LANG']['tl_room_settings']['files'],
            'exclude'   => true,
            'inputType' => 'fileTree',
            'eval'      => ['multiple' => true, 'fieldType' => 'checkbox', 'filesOnly' => true, 'mandatory' => true],
            'sql'       => "blob NULL"
        ],
        'template'       => [
            'label'            => &$GLOBALS['TL_LANG']['tl_room_settings']['template'],
            'default'          => 'mail_default',
            'exclude'          => true,
            'inputType'        => 'select',
            'options_callback' => ['tl_room_settings', 'getMailTemplates'],
            'sql'              => "varchar(32) NOT NULL default ''"
        ],
        'sendText'       => [
            'label'     => &$GLOBALS['TL_LANG']['tl_room_settings']['sendText'],
            'exclude'   => true,
            'filter'    => true,
            'inputType' => 'checkbox',
            'eval'      => ['tl_class' => 'w50'],
            'sql'       => "char(1) NOT NULL default ''"
        ],
        'externalImages' => [
            'label'     => &$GLOBALS['TL_LANG']['tl_room_settings']['externalImages'],
            'exclude'   => true,
            'inputType' => 'checkbox',
            'eval'      => ['tl_class' => 'w50'],
            'sql'       => "char(1) NOT NULL default ''"
        ],
        'sender'         => [
            'label'     => &$GLOBALS['TL_LANG']['tl_room_settings']['sender'],
            'exclude'   => true,
            'search'    => true,
            'filter'    => true,
            'inputType' => 'text',
            'eval'      => ['rgxp' => 'email', 'maxlength' => 128, 'decodeEntities' => true, 'tl_class' => 'w50'],
            'sql'       => "varchar(128) NOT NULL default ''"
        ],
        'senderName'     => [
            'label'     => &$GLOBALS['TL_LANG']['tl_room_settings']['senderName'],
            'exclude'   => true,
            'search'    => true,
            'sorting'   => true,
            'flag'      => 11,
            'inputType' => 'text',
            'eval'      => ['decodeEntities' => true, 'maxlength' => 128, 'tl_class' => 'w50'],
            'sql'       => "varchar(128) NOT NULL default ''"
        ],
        'bCc'            => [
            'label'     => &$GLOBALS['TL_LANG']['tl_room_settings']['bCc'],
            'exclude'   => true,
            'search'    => true,
            'filter'    => true,
            'inputType' => 'text',
            'eval'      => ['rgxp' => 'email', 'maxlength' => 128, 'decodeEntities' => true, 'tl_class' => 'w50'],
            'sql'       => "varchar(128) NOT NULL default ''"
        ],
        'useSMTP'        => [
            'label'     => &$GLOBALS['TL_LANG']['tl_room_settings']['useSMTP'],
            'exclude'   => true,
            'inputType' => 'checkbox',
            'eval'      => ['submitOnChange' => true],
            'sql'       => "char(1) NOT NULL default ''"
        ],
        'smtpHost'       => [
            'label'     => &$GLOBALS['TL_LANG']['tl_room_settings']['smtpHost'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => ['mandatory' => true, 'maxlength' => 64, 'nospace' => true, 'doNotShow' => true, 'tl_class' => 'long'],
            'sql'       => "varchar(64) NOT NULL default ''"
        ],
        'smtpUser'       => [
            'label'     => &$GLOBALS['TL_LANG']['tl_room_settings']['smtpUser'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => ['decodeEntities' => true, 'maxlength' => 128, 'doNotShow' => true, 'tl_class' => 'w50'],
            'sql'       => "varchar(128) NOT NULL default ''"
        ],
        'smtpPass'       => [
            'label'     => &$GLOBALS['TL_LANG']['tl_room_settings']['smtpPass'],
            'exclude'   => true,
            'inputType' => 'textStore',
            'eval'      => ['decodeEntities' => true, 'maxlength' => 32, 'doNotShow' => true, 'tl_class' => 'w50'],
            'sql'       => "varchar(32) NOT NULL default ''"
        ],
        'smtpEnc'        => [
            'label'     => &$GLOBALS['TL_LANG']['tl_room_settings']['smtpEnc'],
            'exclude'   => true,
            'inputType' => 'select',
            'options'   => ['' => '-', 'ssl' => 'SSL', 'tls' => 'TLS'],
            'eval'      => ['doNotShow' => true, 'tl_class' => 'w50'],
            'sql'       => "varchar(3) NOT NULL default ''"
        ],
        'smtpPort'       => [
            'label'     => &$GLOBALS['TL_LANG']['tl_room_settings']['smtpPort'],
            'default'   => 25,
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => ['mandatory' => true, 'rgxp' => 'digit', 'nospace' => true, 'doNotShow' => true, 'tl_class' => 'w50'],
            'sql'       => "smallint(5) unsigned NOT NULL default '0'"
        ],
    ]
];