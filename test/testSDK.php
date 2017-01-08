<?php
/*
  Just following https://github.com/jorgeorpinel/gonebusy-php-client
*/

// include composer's autoloader to enable auto loading of classes
require_once "../vendor/autoload.php";

use GonebusyLib\GonebusyClient;
use GonebusyLib\Models\CreateServiceBody;
use GonebusyLib\Models\CreateScheduleBody;
use GonebusyLib\Models\CreateBookingBody;

// Authentication and initialization
$authorization = "Token 2ae673263145c48185f945880f185b2a";
$client = new GonebusyClient($authorization);


// Pre-requisites (service and schedule)

// Get singleton Service instance
$services = $client->getServices();

$collect['authorization'] = $authorization;
$createServiceBody = new CreateServiceBody();
// TODO: Populate service body
$collect['createServiceBody'] = $createServiceBody;

$service = $services->createService($collect);
var_dump( $service );

// Get singleton Schedule instance
$services = $client->getSchedules();

$collect['authorization'] = $authorization;

$createScheduleBody = new CreateScheduleBody();
// TODO: Populate schedule body
$collect['createScheduleBody'] = $createScheduleBody;

$result = $schedules->createSchedule($collect);


// Bookings Test

// Get singleton Booking instance
$bookings = $client->getBookings();

$collect['authorization'] = $authorization;
$createBookingBody = new CreateBookingBody();
// TODO: Populate booking body
$collect['createBookingBody'] = $createBookingBody;

// Create a Booking with params
$booking = $bookings->createBooking($collect);
var_dump( $result );
