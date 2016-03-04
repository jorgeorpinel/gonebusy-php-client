<?php 
/*
 * Gonebusy
 *
 * This file was automatically generated for GoneBusy Inc. by APIMATIC BETA v2.0 on 03/04/2016
 */

namespace GonebusyLib\Models;

use JsonSerializable;

class CreatePricingModelBody implements JsonSerializable {
    /**
     * PricingModel Name
     * @param string $name public property
     */
    protected $name;

    /**
     * Type of PricingModel
     * @param string $type public property
     */
    protected $type;

    /**
     * Create a PricingModel for this User Id.  You must be authorized to manage this User Id.
     * @param int|null $userId public property
     */
    protected $userId;

    /**
     * Valid API Key for your GoneBusy account
     * (edit in top nav)
     * @param string $apiKey public property
     */
    protected $apiKey;

    /**
     * Optional Notes Field
     * @param string|null $notes public property
     */
    protected $notes;

    /**
     * Price
     * @param double|null $price public property
     */
    protected $price;

    /**
     * 3 Letter ISO Currency Code
     * @param string|null $currency public property
     */
    protected $currency;

    /**
     * Constructor to set initial or default values of member properties
	 * @param   string            $name       Initialization value for the property $this->name    
	 * @param   string            $type       Initialization value for the property $this->type    
	 * @param   int|null          $userId     Initialization value for the property $this->userId  
	 * @param   string            $apiKey     Initialization value for the property $this->apiKey  
	 * @param   string|null       $notes      Initialization value for the property $this->notes   
	 * @param   double|null       $price      Initialization value for the property $this->price   
	 * @param   string|null       $currency   Initialization value for the property $this->currency
     */
    public function __construct()
    {
        if(7 == func_num_args())
        {
            $this->name     = func_get_arg(0);
            $this->type     = func_get_arg(1);
            $this->userId   = func_get_arg(2);
            $this->apiKey   = func_get_arg(3);
            $this->notes    = func_get_arg(4);
            $this->price    = func_get_arg(5);
            $this->currency = func_get_arg(6);
        }
    }

    /**
     * Return a property of the response if it exists.
     * Possibilities include: code, raw_body, headers, body (if the response is json-decodable)
     * @return mixed
     */
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            //UTF-8 is recommended for correct JSON serialization
            $value = $this->$property;
            if (is_string($value) && mb_detect_encoding($value, "UTF-8", TRUE) != "UTF-8") {
                return utf8_encode($value);
            }
            else {
                return $value;
            }
        }
    }
    
    /**
     * Set the properties of this object
     * @param string $property the property name
     * @param mixed $value the property value
     */
    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            //UTF-8 is recommended for correct JSON serialization
            if (is_string($value) && mb_detect_encoding($value, "UTF-8", TRUE) != "UTF-8") {
                $this->$property = utf8_encode($value);
            }
            else {
                $this->$property = $value;
            }
        }

        return $this;
    }

    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['name']     = $this->name;
        $json['type']     = $this->type;
        $json['user_id']  = $this->userId;
        $json['api_key']  = $this->apiKey;
        $json['notes']    = $this->notes;
        $json['price']    = $this->price;
        $json['currency'] = $this->currency;
        return $json;
    }
}