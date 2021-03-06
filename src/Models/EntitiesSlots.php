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
class EntitiesSlots implements JsonSerializable
{
    /**
     * date of availability
     * @var string $date public property
     */
    public $date;

    /**
     * array of available time slots
     * @var array $slots public property
     */
    public $slots;

    /**
     * Constructor to set initial or default values of member properties
     * @param string $date  Initialization value for $this->date
     * @param array  $slots Initialization value for $this->slots
     */
    public function __construct()
    {
        if (2 == func_num_args()) {
            $this->date  = func_get_arg(0);
            $this->slots = func_get_arg(1);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['date']  = $this->date;
        $json['slots'] = $this->slots;

        return $json;
    }
}
