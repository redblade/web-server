<?php

// server should keep session data for AT LEAST 1 hour
ini_set('session.gc_maxlifetime', 7200);

// each client should remember their session id for EXACTLY 1 hour
session_set_cookie_params(7200);

session_start(); // ready to go!

//Controllo login
if (strpos($_SERVER['PHP_SELF'], 'login') === false) {
    if (empty($_SESSION["cookies"]["__AntiXsrfToken"]) || empty($_SESSION["cookies"]["ASP.NET_SessionId"]) || $_SESSION["expire"] < time()){
        header("location: /login?page=".$_SERVER['PHP_SELF']);
        exit;
    }
}

include "vendor/autoload.php";
include "api/class.php";

use DiDom\Document;
use DiDom\Query;
use DiDom\Element;