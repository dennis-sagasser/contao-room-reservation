<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2017 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Modules
	'Contao\ModuleRoomReservation' => 'system/modules/room_reservation/modules/ModuleRoomReservation.php',

	// Classes
	'tl_room_occupancy'            => 'system/modules/room_reservation/classes/tl_room_occupancy.php',
	'tl_roomtype'                  => 'system/modules/room_reservation/classes/tl_roomtype.php',
	'tl_reservation_settings'      => 'system/modules/room_reservation/classes/tl_reservation_settings.php',

	// Library
	'Contao\HookMyBackendTemplate' => 'system/modules/room_reservation/library/RoomReservation/HookMyBackendTemplate.php',
	'Contao\HookMyInsertTags'      => 'system/modules/room_reservation/library/RoomReservation/HookMyInsertTags.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'mod_reservation_form' => 'system/modules/room_reservation/templates',
));
