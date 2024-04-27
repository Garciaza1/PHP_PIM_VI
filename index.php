<?php

require_once("vendor/autoload.php");

use PIM_VI\System\Router;

session_start();

Router::dispatch();