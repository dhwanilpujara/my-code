<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Define a routing table
$routes = [
    '/' => 'maiho',
    // '/loading' => 'loadingscreen',
    // '/'=>'homepage',
    // '/about'=>'aboutus',
    // '/contact' => 'contact',
    // '/meeting-point'=>'meetingpoint',
    // '/emergency' => 'emergency',
    // '/book-hotel' => 'hotelbooking/hotelbook',
    // '/hotel'=>'hotelbooking/hotelservice',
    // '/log-in' => 'login/loginy',
    // '/sign-up' => 'signup/signup',
    // '/pay'=>'razorpay/razorpay',
    // '/verification'=>'authentication/mailauthent',
    // '/verifyOTP'=>'authentication/verifyotp',
    // '/profile'=>'profile/profile',
    // '/update-profile'=>'profile/updateprofile',
    // '/book-restaurant'=>'restaurantbooking/Restaurantbooking',
    // '/restaurant'=>'restaurantbooking/restaurantservice',
    // '/signup/consumer'=>'signup/consumersignup',
    // '/signup/hotelProvider'=>'signup/hotelservicesignup',
    // '/signup/restaurantProvider'=>'signup/restaurantservicesignup',
    // '/logging-out'=>'logout'
];

// Get the current URL
$current_url = $_SERVER['REQUEST_URI'];

// Find the route
$route = isset($routes[$current_url]) ? $routes[$current_url] : '404';

// if ($route === 'loadingscreen') {
//     include 'voicecall/loadingscreen.php';
// } else {
include 'voicecall/' . $route . '.php';
// }
//include '' . $route . '.php';
?>