<?php

/**
 * Function to handle incoming requests and route them to the appropriate page.
 * The function uses the 'url' parameter from the $_GET array to determine which page to display.
 * If the 'url' parameter is not set, the function defaults to the 'home' page.
 * If the 'url' parameter does not match any of the defined cases, the function defaults to the '404' page.
 */
function handleRequest() {
    $url = $_GET['url'] ?? 'home';
    switch ($url) {
        case 'home':
            require 'home.php';
            break;
        case 'about':
            require 'about.php';
            break;
        default:
            require '404.php';
            break;
    }
}