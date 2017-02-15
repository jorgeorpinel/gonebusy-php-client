<?php
/*
 * GonebusyLib
 *
 * This file was automatically generated by APIMATIC v2.0 ( https://apimatic.io ).
 */

namespace GonebusyLib\Models;

use JsonSerializable;

/**
 * @todo Write general description for this model
 */
class CancelBookingByIdResponse implements JsonSerializable
{
    /**
     * @todo Write general description for this property
     * @var EntitiesBookingResponse $booking public property
     */
    public $booking;

    /**
     * Constructor to set initial or default values of member properties
     * @param EntitiesBookingResponse $booking Initialization value for $this->booking
     */
    public function __construct()
    {
        if (1 == func_num_args()) {
            $this->booking = func_get_arg(0);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['booking'] = $this->booking;

        return $json;
    }
}
