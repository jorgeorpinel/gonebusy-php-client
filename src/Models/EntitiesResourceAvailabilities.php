<?php 
/*
 * Gonebusy
 *
 * This file was automatically generated for GoneBusy Inc. by APIMATIC v2.0 ( https://apimatic.io ) on 11/18/2016
 */

namespace GonebusyLib\Models;

use JsonSerializable;

/**
 * @todo Write general description for this model
 */
class EntitiesResourceAvailabilities implements JsonSerializable {
    /**
     * array of available date and time slots
     * @maps available_slots
     * @var EntitiesSlots[] $availableSlots public property
     */
    public $availableSlots;

    /**
     * id of Resource
     * @var integer $id public property
     */
    public $id;

    /**
     * Constructor to set initial or default values of member properties
     * @param   array             $availableSlots    Initialization value for the property $this->availableSlots 
     * @param   integer           $id                Initialization value for the property $this->id             
     */
    public function __construct()
    {
        if(2 == func_num_args())
        {
            $this->availableSlots  = func_get_arg(0);
            $this->id              = func_get_arg(1);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['available_slots'] = $this->availableSlots;
        $json['id']              = $this->id;

        return $json;
    }
}