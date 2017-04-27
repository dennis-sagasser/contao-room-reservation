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
	'Contao\ModuleRoomReservation'      => 'system/modules/room_reservation/modules/ModuleRoomReservation.php',

	// Classes
	'Contao\tl_module_room_reservation' => 'system/modules/room_reservation/classes/tl_module_room_reservation.php',
	'Contao\tl_room_list'               => 'system/modules/room_reservation/classes/tl_room_list.php',
	'Contao\tl_room_settings'           => 'system/modules/room_reservation/classes/tl_room_settings.php',
	'Contao\tl_room_type'               => 'system/modules/room_reservation/classes/tl_room_type.php',
	'Contao\tl_room_occupancy'          => 'system/modules/room_reservation/classes/tl_room_occupancy.php',

	// Library
	'Contao\HooksRoomBackend'           => 'system/modules/room_reservation/library/RoomReservation/HooksRoomBackend.php',
	'Contao\HooksRoomFrontend'          => 'system/modules/room_reservation/library/RoomReservation/HooksRoomFrontend.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'mod_room_reservation_form_page2'   => 'system/modules/room_reservation/templates',
	'mod_room_reservation_form'         => 'system/modules/room_reservation/templates',
	'mod_room_reservation_form_success' => 'system/modules/room_reservation/templates',
));
