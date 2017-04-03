<?php
/*
 * GonebusyLib
 *
 * This file was automatically generated by APIMATIC v2.0 ( https://apimatic.io ).
 */

namespace GonebusyLib\Controllers;

use GonebusyLib\APIException;
use GonebusyLib\APIHelper;
use GonebusyLib\Configuration;
use GonebusyLib\Models;
use GonebusyLib\Exceptions;
use GonebusyLib\Http\HttpRequest;
use GonebusyLib\Http\HttpResponse;
use GonebusyLib\Http\HttpMethod;
use GonebusyLib\Http\HttpContext;
use GonebusyLib\Servers;
use GonebusyLib\CustomAuthUtility;
use Unirest\Request;

/**
 * @todo Add a general description for this controller.
 */
class BookingsController extends BaseController
{
    /**
     * @var BookingsController The reference to *Singleton* instance of this class
     */
    private static $instance;

    /**
     * Returns the *Singleton* instance of this class.
     * @return BookingsController The *Singleton* instance.
     */
    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * Return list of Bookings.
     *
     * @param string  $authorization A valid API key, in the format 'Token API_KEY'
     * @param integer $page          (optional) Page offset to fetch.
     * @param integer $perPage       (optional) Number of results to return per page.
     * @param string  $states        (optional) Comma-separated list of Booking states to retrieve only Bookings in
     *                               those states.  Leave blank to retrieve all Bookings.
     * @param integer $userId        (optional) Retrieve Bookings owned only by this User Id.  You must be authorized
     *                               to manage this User Id.
     * @return mixed response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function getBookings(
        $authorization,
        $page = 1,
        $perPage = 10,
        $states = null,
        $userId = null
    ) {

        //the base uri for api requests
        $_queryBuilder = Configuration::getBaseUri();

        //prepare query string for API call
        $_queryBuilder = $_queryBuilder.'/bookings';

        //process optional query parameters
        APIHelper::appendUrlWithQueryParameters($_queryBuilder, array (
            'page'          => (null != $page) ? $page : 1,
            'per_page'      => (null != $perPage) ? $perPage : 10,
            'states'        => $states,
            'user_id'       => $userId,
        ));

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl($_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'    => 'GB-PHP-SDK',
            'Accept'        => 'application/json',
            'Authorization' => Configuration::$authorization,
            'Authorization'   => $authorization
        );

        //append custom auth authorization headers
        CustomAuthUtility::appendCustomAuthParams($_headers);

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::GET, $_headers, $_queryUrl);
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::get($_queryUrl, $_headers);

        $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
        $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

        //call on-after Http callback
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        //Error handling using HTTP status codes
        if ($response->code == 401) {
            throw new Exceptions\EntitiesErrorException('Unauthorized/Missing Token', $_httpContext);
        }

        if ($response->code == 403) {
            throw new Exceptions\EntitiesErrorException('Forbidden', $_httpContext);
        }

        if ($response->code == 404) {
            throw new Exceptions\EntitiesErrorException('Not Found', $_httpContext);
        }

        if (($response->code < 200) || ($response->code > 208)) {
            throw new APIException('Unexpected error', $_httpContext);
        }

        //handle errors defined at the API level
        $this->validateResponse($_httpResponse, $_httpContext);

        $mapper = $this->getJsonMapper();

        return $mapper->map($response->body, new Models\GetBookingsResponse());
    }

    /**
     * Create a Booking with params
     *
     * @param string                   $authorization       A valid API key, in the format 'Token API_KEY'
     * @param Models\CreateBookingBody $createBookingBody   (optional) the content of the request
     * @return mixed response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function createBooking(
        $authorization,
        $createBookingBody = null
    ) {

        //the base uri for api requests
        $_queryBuilder = Configuration::getBaseUri();

        //prepare query string for API call
        $_queryBuilder = $_queryBuilder.'/bookings/new';

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl($_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'        => 'GB-PHP-SDK',
            'Accept'            => 'application/json',
            'content-type'      => 'application/json; charset=utf-8',
            'Authorization' => Configuration::$authorization,
            'Authorization'       => $authorization
        );

        //append custom auth authorization headers
        CustomAuthUtility::appendCustomAuthParams($_headers);

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::POST, $_headers, $_queryUrl);
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        if(Configuration::$debug)
            error_log(
                __METHOD__ . ' ' .
                "request body:\n" .
                json_encode(json_decode(Request\Body::Json($createBookingBody)), JSON_PRETTY_PRINT) . "\n",
                3, Configuration::$debug_file);
        //and invoke the API call request to fetch the response
        $response = Request::post($_queryUrl, $_headers, Request\Body::Json($createBookingBody));
        if(Configuration::$debug)
            error_log(
                __METHOD__ . ' ' .
                "response:\n" .
                json_encode(json_decode($response->raw_body), JSON_PRETTY_PRINT) . "\n",
                3, Configuration::$debug_file);

        $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
        $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

        //call on-after Http callback
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        //Error handling using HTTP status codes
        if ($response->code == 400) {
            throw new Exceptions\EntitiesErrorException('Bad Request', $_httpContext);
        }

        if ($response->code == 401) {
            throw new Exceptions\EntitiesErrorException('Unauthorized/Missing Token', $_httpContext);
        }

        if ($response->code == 403) {
            throw new Exceptions\EntitiesErrorException('Forbidden', $_httpContext);
        }

        if ($response->code == 422) {
            throw new Exceptions\EntitiesErrorException('Unprocessable Entity', $_httpContext);
        }

        if (($response->code < 200) || ($response->code > 208)) {
            throw new APIException('Unexpected error', $_httpContext);
        }

        //handle errors defined at the API level
        $this->validateResponse($_httpResponse, $_httpContext);

        $mapper = $this->getJsonMapper();

        return $mapper->map($response->body, new Models\CreateBookingResponse());
    }

    /**
     * Return a Booking by id.
     *
     * @param string $authorization A valid API key, in the format 'Token API_KEY'
     * @param string $id            TODO: type description here
     * @return mixed response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function getBookingById(
        $authorization,
        $id
    ) {

        //the base uri for api requests
        $_queryBuilder = Configuration::getBaseUri();

        //prepare query string for API call
        $_queryBuilder = $_queryBuilder.'/bookings/{id}';

        //process optional query parameters
        $_queryBuilder = APIHelper::appendUrlWithTemplateParameters($_queryBuilder, array (
            'id'            => $id,
            ));

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl($_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'    => 'GB-PHP-SDK',
            'Accept'        => 'application/json',
            'Authorization' => Configuration::$authorization,
            'Authorization'   => $authorization
        );

        //append custom auth authorization headers
        CustomAuthUtility::appendCustomAuthParams($_headers);

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::GET, $_headers, $_queryUrl);
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::get($_queryUrl, $_headers);

        $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
        $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

        //call on-after Http callback
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        //Error handling using HTTP status codes
        if ($response->code == 400) {
            throw new Exceptions\EntitiesErrorException('Bad Request', $_httpContext);
        }

        if ($response->code == 401) {
            throw new Exceptions\EntitiesErrorException('Unauthorized/Missing Token', $_httpContext);
        }

        if ($response->code == 403) {
            throw new Exceptions\EntitiesErrorException('Forbidden', $_httpContext);
        }

        if ($response->code == 404) {
            throw new Exceptions\EntitiesErrorException('Not Found', $_httpContext);
        }

        if (($response->code < 200) || ($response->code > 208)) {
            throw new APIException('Unexpected error', $_httpContext);
        }

        //handle errors defined at the API level
        $this->validateResponse($_httpResponse, $_httpContext);

        $mapper = $this->getJsonMapper();

        return $mapper->map($response->body, new Models\GetBookingByIdResponse());
    }

    /**
     * Update a Booking by id
     *
     * @param string $authorization A valid API key, in the format 'Token API_KEY'
     * @param string $id            TODO: type description here
     * @return mixed response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function updateBookingById(
        $authorization,
        $id
    ) {

        //the base uri for api requests
        $_queryBuilder = Configuration::getBaseUri();

        //prepare query string for API call
        $_queryBuilder = $_queryBuilder.'/bookings/{id}';

        //process optional query parameters
        $_queryBuilder = APIHelper::appendUrlWithTemplateParameters($_queryBuilder, array (
            'id'            => $id,
            ));

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl($_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'    => 'GB-PHP-SDK',
            'Accept'        => 'application/json',
            'Authorization' => Configuration::$authorization,
            'Authorization'   => $authorization
        );

        //append custom auth authorization headers
        CustomAuthUtility::appendCustomAuthParams($_headers);

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::PUT, $_headers, $_queryUrl);
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::put($_queryUrl, $_headers);

        $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
        $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

        //call on-after Http callback
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        //Error handling using HTTP status codes
        if ($response->code == 400) {
            throw new Exceptions\EntitiesErrorException('Bad Request', $_httpContext);
        }

        if ($response->code == 401) {
            throw new Exceptions\EntitiesErrorException('Unauthorized/Missing Token', $_httpContext);
        }

        if ($response->code == 403) {
            throw new Exceptions\EntitiesErrorException('Forbidden', $_httpContext);
        }

        if ($response->code == 404) {
            throw new Exceptions\EntitiesErrorException('Not Found', $_httpContext);
        }

        if ($response->code == 422) {
            throw new Exceptions\EntitiesErrorException('Unprocessable Entity', $_httpContext);
        }

        if (($response->code < 200) || ($response->code > 208)) {
            throw new APIException('Unexpected error', $_httpContext);
        }

        //handle errors defined at the API level
        $this->validateResponse($_httpResponse, $_httpContext);

        $mapper = $this->getJsonMapper();

        return $mapper->map($response->body, new Models\UpdateBookingByIdResponse());
    }

    /**
     * Cancel a Booking by id
     *
     * @param string $authorization A valid API key, in the format 'Token API_KEY'
     * @param string $id            TODO: type description here
     * @return mixed response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function cancelBookingById(
        $authorization,
        $id
    ) {

        //the base uri for api requests
        $_queryBuilder = Configuration::getBaseUri();

        //prepare query string for API call
        $_queryBuilder = $_queryBuilder.'/bookings/{id}';

        //process optional query parameters
        $_queryBuilder = APIHelper::appendUrlWithTemplateParameters($_queryBuilder, array (
            'id'            => $id,
            ));

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl($_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'    => 'GB-PHP-SDK',
            'Accept'        => 'application/json',
            'Authorization' => Configuration::$authorization,
            'Authorization'   => $authorization
        );

        //append custom auth authorization headers
        CustomAuthUtility::appendCustomAuthParams($_headers);

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::DELETE, $_headers, $_queryUrl);
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::delete($_queryUrl, $_headers);

        $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
        $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

        //call on-after Http callback
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        //Error handling using HTTP status codes
        if ($response->code == 400) {
            throw new Exceptions\EntitiesErrorException('Bad Request', $_httpContext);
        }

        if ($response->code == 401) {
            throw new Exceptions\EntitiesErrorException('Unauthorized/Missing Token', $_httpContext);
        }

        if ($response->code == 403) {
            throw new Exceptions\EntitiesErrorException('Forbidden', $_httpContext);
        }

        if ($response->code == 404) {
            throw new Exceptions\EntitiesErrorException('Not Found', $_httpContext);
        }

        if (($response->code < 200) || ($response->code > 208)) {
            throw new APIException('Unexpected error', $_httpContext);
        }

        //handle errors defined at the API level
        $this->validateResponse($_httpResponse, $_httpContext);

        $mapper = $this->getJsonMapper();

        return $mapper->map($response->body, new Models\CancelBookingByIdResponse());
    }
}
