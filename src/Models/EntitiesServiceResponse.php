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
class EntitiesServiceResponse implements JsonSerializable
{
    /**
     * array of Category ids Service belongs to
     * @var array $categories public property
     */
    public $categories;

    /**
     * description of Service
     * @var string $description public property
     */
    public $description;

    /**
     * length of Service in minutes
     * @var integer $duration public property
     */
    public $duration;

    /**
     * id of Service
     * @var integer $id public property
     */
    public $id;

    /**
     * status of Service
     * @maps is_active
     * @var bool $isActive public property
     */
    public $isActive;

    /**
     * max length of Service in minutes
     * @maps max_duration
     * @var integer $maxDuration public property
     */
    public $maxDuration;

    /**
     * name of Service
     * @var string $name public property
     */
    public $name;

    /**
     * id of owner of Service
     * @maps owner_id
     * @var integer $ownerId public property
     */
    public $ownerId;

    /**
     * id of Pricing Model
     * @maps price_model_id
     * @var integer $priceModelId public property
     */
    public $priceModelId;

    /**
     * array of Resource ids offering Service
     * @var array $resources public property
     */
    public $resources;

    /**
     * array of Schedule ids, one for each Resource offering Service
     * @var array $schedules public property
     */
    public $schedules;

    /**
     * abbreviated name for Service
     * @maps short_name
     * @var string $shortName public property
     */
    public $shortName;

    /**
     * Constructor to set initial or default values of member properties
     * @param array   $categories   Initialization value for $this->categories
     * @param string  $description  Initialization value for $this->description
     * @param integer $duration     Initialization value for $this->duration
     * @param integer $id           Initialization value for $this->id
     * @param bool    $isActive     Initialization value for $this->isActive
     * @param integer $maxDuration  Initialization value for $this->maxDuration
     * @param string  $name         Initialization value for $this->name
     * @param integer $ownerId      Initialization value for $this->ownerId
     * @param integer $priceModelId Initialization value for $this->priceModelId
     * @param array   $resources    Initialization value for $this->resources
     * @param array   $schedules    Initialization value for $this->schedules
     * @param string  $shortName    Initialization value for $this->shortName
     */
    public function __construct()
    {
        if (12 == func_num_args()) {
            $this->categories   = func_get_arg(0);
            $this->description  = func_get_arg(1);
            $this->duration     = func_get_arg(2);
            $this->id           = func_get_arg(3);
            $this->isActive     = func_get_arg(4);
            $this->maxDuration  = func_get_arg(5);
            $this->name         = func_get_arg(6);
            $this->ownerId      = func_get_arg(7);
            $this->priceModelId = func_get_arg(8);
            $this->resources    = func_get_arg(9);
            $this->schedules    = func_get_arg(10);
            $this->shortName    = func_get_arg(11);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['categories']     = $this->categories;
        $json['description']    = $this->description;
        $json['duration']       = $this->duration;
        $json['id']             = $this->id;
        $json['is_active']      = $this->isActive;
        $json['max_duration']   = $this->maxDuration;
        $json['name']           = $this->name;
        $json['owner_id']       = $this->ownerId;
        $json['price_model_id'] = $this->priceModelId;
        $json['resources']      = $this->resources;
        $json['schedules']      = $this->schedules;
        $json['short_name']     = $this->shortName;

        return $json;
    }
}
