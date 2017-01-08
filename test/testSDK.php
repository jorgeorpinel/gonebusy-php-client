<?php
/*
  Just following https://github.com/jorgeorpinel/gonebusy-php-client
*/

// include composer's autoloader to enable auto loading of classes
require_once "../vendor/autoload.php";

// Authentication and initialization
$authorization = "Token 2ae673263145c48185f945880f185b2a";
$client = new GonebusyLib\GonebusyClient($authorization);


// Bookings Test

// Get singleton instance
$bookings = $client->getBookings();


$collect['authorization'] = $authorization;
$createBookingBody = new GonebusyLib\Models\CreateBookingBody();
$collect['createBookingBody'] = $createBookingBody;

// Create a Booking with params
$result = $bookings->createBooking($collect);

var_dump( $result );
