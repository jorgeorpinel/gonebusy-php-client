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
class EntitiesScheduleResponse implements JsonSerializable {
    /**
     * id of Schedule
     * @var integer $id public property
     */
    public $id;

    /**
     * id of owner of Schedule
     * @maps owner_id
     * @var integer $ownerId public property
     */
    public $ownerId;

    /**
     * id of Resource
     * @maps resource_id
     * @var integer $resourceId public property
     */
    public $resourceId;

    /**
     * id of Service
     * @maps service_id
     * @var integer $serviceId public property
     */
    public $serviceId;

    /**
     * array of TimeWindows making up Schedule
     * @maps time_windows
     * @var EntitiesTimeWindowResponse[] $timeWindows public property
     */
    public $timeWindows;

    /**
     * Constructor to set initial or default values of member properties
     * @param   integer           $id             Initialization value for the property $this->id          
     * @param   integer           $ownerId        Initialization value for the property $this->ownerId     
     * @param   integer           $resourceId     Initialization value for the property $this->resourceId  
     * @param   integer           $serviceId      Initialization value for the property $this->serviceId   
     * @param   array             $timeWindows    Initialization value for the property $this->timeWindows 
     */
    public function __construct()
    {
        if(5 == func_num_args())
        {
            $this->id           = func_get_arg(0);
            $this->ownerId      = func_get_arg(1);
            $this->resourceId   = func_get_arg(2);
            $this->serviceId    = func_get_arg(3);
            $this->timeWindows  = func_get_arg(4);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['id']           = $this->id;
        $json['owner_id']     = $this->ownerId;
        $json['resource_id']  = $this->resourceId;
        $json['service_id']   = $this->serviceId;
        $json['time_windows'] = $this->timeWindows;

        return $json;
    }
}