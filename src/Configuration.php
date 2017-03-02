<?php
/*
 * GonebusyLib
 *
 * This file was automatically generated by APIMATIC v2.0 ( https://apimatic.io ).
 */

namespace GonebusyLib;

/**
 * All configuration including auth info and base URI for the API access
 * are configured in this class.
 */
class Configuration
{
    /**
     * The environment being used'
     * @var string
     */
    public static $environment = Environments::PRODUCTION;

    /**
     * Set Authorization to "Token <your API key>"
     * @var string
     */
    /**
     * @todo Replace the $authorization with an appropriate value
     */
    public static $authorization = 'Token <your API key>';

    /**
     * Get the base uri for a given server in the current environment
     * @param  string $server Server name
     * @return string         Base URI
     */
    public static function getBaseUri($server = Servers::DEFAULT_)
    {
        return APIHelper::appendUrlWithTemplateParameters(
            static::$environmentsMap[static::$environment][$server],
            array(
            )
        );
    }

    /**
     * A map of all baseurls used in different environments and servers
     * @var array
     */
    private static $environmentsMap = array(
        Environments::PRODUCTION => array(
            Servers::DEFAULT_ => 'https://beta.gonebusy.com/api/v1',
        ),
        Environments::SANDBOX => array(
            Servers::DEFAULT_ => 'https://sandbox.gonebusy.com/api/v1',
        ),
    );
}
