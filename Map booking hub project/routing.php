// <?php
// $request = $_SERVER['REQUEST_URI'];

// switch ($request) {

//     case '':
//     case '/':
//         require __DIR__ . '/index.php';
//         break;
//     case '/Login':
//         require __DIR__ . '../login/login.php';
//         break;
//     case '/Signup':
//         require __DIR__ . '../signup/singup.php';
//         break;
//     case '/HotelBooking':
//         require __DIR__ . '../hotelbooking/hotelbook.php';
//         break;

//     case '/authors':
//         require __DIR__ . '../authors.php';
//         break;

//     case '/about':
//         require __DIR__ . '../aboutus.php';
//         break;
//     case '/CabBook':
//         require __DIR__ . '../cabbook/cabbook.php';
//         break;
//     default:
//         http_response_code(404);
//         require __DIR__ . '/views/404.php';
//         break;
// }