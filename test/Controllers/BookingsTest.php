<?php
/*
 * Bookings SDK Controller Test Case
 */

use PHPUnit\Framework\TestCase;

use GonebusyLib\Configuration;
use GonebusyLib\GonebusyClient;
use GonebusyLib\Models\CreateServiceBody;
use GonebusyLib\Models\CreateResourceBody;
use GonebusyLib\Models\CreateScheduleBody;
use GonebusyLib\Models\CreateBookingBody;

use GonebusyLib\Models\UpdateBookingByIdBody;

class BookingsTest extends TestCase
{
    /** To contain the GonebusyLib\GonebusyClient
     */
    protected $client;

    /** To contain the GonebusyLib\Controllers\BookingsController
     */
    protected $bookings;

    /** To contain a GonebusyLib\Controllers\ServicesController
     */
    protected $services;

    /** To contain a GonebusyLib\Controllers\ResourcesController
     */
    private $resources;

    /** To contain a GonebusyLib\Controllers\SchedulesController
     */
    private $schedules;


    /**
     * Create the GonebusyClient and BookingsController,
     * as well as other controllers (for every test).
     */
    public function setUp() {
        $this->client = new GonebusyClient(null, true);
        $this->bookings = $this->client->getBookings();

        $this->services = $this->client->getServices();
        $this->resources = $this->client->getResources();
        $this->schedules = $this->client->getSchedules();
    }

    /**
     * Generate arbitrary service or resource data.
     * @param  string $type 'Service' or 'Resource'
     * @return  mixed object for sending to API
     */
    private function createBody($type) {
        switch($type) {
            case 'Service':
                return new CreateServiceBody(
                    "description", // REQUIRED
                    15, // duration REQUIRED
                    15, // max_duration optional but will default to duration
                    "name", // REQUIRED
                    NULL, // categories
                    NULL, // price_model_id
                    NULL, // services defaults to self Service
                    "short_name",
                    NULL // user_id defaults to self User
                );
            case 'Resource':
                return new CreateResourceBody(
                    "name", // REQUIRED
                    "Staff", // type REQUIRED
                    NULL, // capacity
                    "description",
                    NULL, // gender
                    NULL, // thing_type_id
                    NULL // user_id detauls to self
                );
        }
    }

    /**
     * Generate arbitrary schedule data.
     * @param  int $serviceId for new schedule
     * @param  int $resourceId for new schedule
     * @return  CreateScheduleBody object for sending to API
     */
    private function scheduleBody($serviceId, $resourceId) {
        return new CreateScheduleBody(
            $serviceId, // REQUIRED
            NULL, // date_recurs_by
            "sunday, monday, tuesday, wednesday, thursday, friday, saturday", // days
            date('Y-m-d', strtotime('tomorrow')), // end_date
            "17:00", // end_time
            NULL, // frequency defaults to 'every'
            NULL, // occurrence defaults to 'every'
            "daily", // recurs_by
            $resourceId,
            date('Y-m-d', strtotime('tomorrow')), // start_date
            "09:00", // start_time
            NULL, // total_minutes can be deduced
            NULL // user_id defaults to self
        );
    }

    /**
     * Generate unique user data.
     * @param  string $action Should be 'create' or 'update'.
     * @param  int $serviceId for new booking
     * @param  int $resourceId for new booking
     * @return  mixed object with unique data to send to API
     */
    private function bookingBody($action, $serviceId=NULL, $resourceId=NULL) {
        switch($action) {
            case 'create':
                return new CreateBookingBody(
                    date('Y-m-d', strtotime('tomorrow')), // date (within schedule start_date and end_date)
                    $serviceId, // service_id
                    "13:00", // time (within schedule start_time and end_date)
                    30, // duration (>= service durations)
                    $resourceId, // resource_id
                    NULL // user_id defaults to self
                );
            case 'update':
                return new CreateBookingBody(
                    date('Y-m-d', strtotime('tomorrow')), // date (within schedule start_date and end_date)
                    $serviceId, // service_id
                    "13:45", // another time (within schedule start_time and end_date)
                    15, // another duration (>= service durations)
                    $resourceId, // resource_id
                    NULL // user_id defaults to self
                );
        }
    }

    /**
     * Generate data from Booking response.
     * @param  GonebusyLib\Models\EntitiesBookingsResponse $response
     * @param  int $sId service ID (not in response)
     * @param  int $rId resource ID (not in response)
     * @return CreateBookingBody object with data from $response
     */
    private function bodyFromResponse($response, $sId, $rId) {
        return new CreateBookingBody(
            $response->booking->timeWindow->startDate, // date
            $sId, // service_id
            $response->booking->timeWindow->startTime, // time
            $response->booking->timeWindow->totalMinutes, // duration
            $rId, // resource_id
            NULL // user_id defaults to self
        );
    }


    /**
     * Test POST /bookings/new
     * GonebusyLib\Controllers\UsersController::createBooking()
     */
    public function testCreateBooking() {
        if(Configuration::$debug) error_log("Running test/Controllers/BookingsTest::testCreateBooking()\n", 3, Configuration::$debug_file);

        $serviceResponse = $this->services->createService(Configuration::$authorization, $this->createBody('Service'));
        $resourceResponse = $this->resources->createResource(Configuration::$authorization, $this->createBody('Resource'));
        // Give open Schedule for seervice/resource combination:
        $createScheduleBody = $this->scheduleBody($serviceResponse->service->id, $resourceResponse->resource->id);
        $scheduleResponse = $this->schedules->createSchedule(Configuration::$authorization, $createScheduleBody);


        if(Configuration::$debug) error_log('Create Booking:');
        $createBookingBody = $this->bookingBody('create', $serviceResponse->service->id, $resourceResponse->resource->id);
        $response = $this->bookings->createBooking(
            Configuration::$authorization,
            $createBookingBody
        );

        // Was it created?
        $this->assertInstanceOf('GonebusyLib\Models\CreateBookingResponse', $response);

        // Does it have all the original data we sent?
        $responseBody = $this->bodyFromResponse($response, $serviceResponse->service->id, $resourceResponse->resource->id);
        $this->assertEquals($responseBody, $createBookingBody);

        // Delete test booking after a few seconds:
        sleep(3); // (until the booking is :awaiting_review)
        $this->bookings->cancelBookingById(Configuration::$authorization, $response->booking->id);


        // Delete test schedule:
        $this->schedules->deleteScheduleById(Configuration::$authorization, $scheduleResponse->schedule->id);
        // Delete test resource:
        $this->resources->deleteResourceById(Configuration::$authorization, $resourceResponse->resource->id);
        // Delete test service:
        $this->services->deleteServiceById(Configuration::$authorization, $serviceResponse->service->id);
    }

    /**
     * Test PUT /bookings/{id}
     * GonebusyLib\Controllers\BookingsController::testCreateBooking()
     */
    public function testUpdateBookingById() {

    }

    /**
     * Test GET /bookings/{id}
     * GonebusyLib\Controllers\BookingsController::getBookingById()
     */
    public function testGetBookingById() {

    }

    /**
     * Test DELETE /bookings/{id}
     * GonebusyLib\Controllers\BookingsController::cancelBookingById()
     */
    public function testCancelBookingById() {

    }

    /**
     * Test GET /bookings
     * GonebusyLib\Controllers\BookingsController::getBookings()
     */
    public function testGetBookings() {

    }


    /**
     * @todo wrap-up test
     */
    public function tearDown() {

    }
}
