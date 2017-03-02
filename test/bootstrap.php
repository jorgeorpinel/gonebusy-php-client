
<?php

// To have the SDK namespaces available for the test cases
require_once "vendor/autoload.php";

use GonebusyLib\Configuration;
use GonebusyLib\Environments;

Configuration::$environment = Environments::PRODUCTION;
