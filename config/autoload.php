<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package Room_reservation
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Modules
	'Contao\ModuleRoomReservation' => 'system/modules/room_reservation/modules/ModuleRoomReservation.php',
	'Contao\HookMyInsertTags'      => 'system/modules/room_reservation/modules/HookMyInsertTags.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'mod_reservation_form' => 'system/modules/room_reservation/templates',
));
