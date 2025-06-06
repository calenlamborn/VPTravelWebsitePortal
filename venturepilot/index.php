<?php
session_start();

require 'vendor/autoload.php';
require 'database.php';
$router = new AltoRouter();

$config = parse_ini_file("config.ini", true);
$router->setBasePath("/venturepilot");

$templates = new League\Plates\Engine('templates');
$templates->registerFunction('url', function ($name, $params = []) use ($router) {
    return $router->generate($name, $params);
});

$database = new Database($config['database']['host'], $config['database']['user_read'], $config['database']['password_read'], $config['database']['database_name']);

// Routes
$router->map('GET', '/', function() use ($templates, $router, $database) {
    $itineraries = $database->GetItineraries();
    echo $templates->render("home", ['router' => $router, 'itinerary' => $itineraries]);
}, "home");

//Explore
$router->map('GET', '/explore', function() use ($templates, $router, $database) {
    $itineraries = $database->GetItineraries();
    echo $templates->render("explore", ['router' => $router, 'itinerary' => $itineraries]);
}, "explore");

// My trips route
$router->map('GET', '/mytrips', function() use ($templates, $router, $database) {
    // Retrieve the current user
    $userId = getCurrentUserId();

    // Retrieve itineraries associated with the current user
    $userItineraries = $database->GetUserItineraries($userId);

    echo $templates->render("mytrips", ['router' => $router, 'itinerary' => $userItineraries]);
}, "mytrips");


// CREATE ROUTES
$router->map('GET', '/create', function() use ($templates, $router) {
    echo $templates->render("create", ['router' => $router]);
}, "create");

$router->map('POST', '/create', function() use ($database, $router) {
    // Retrieve form data
    $tripName = $_POST['trip-name'];
    $location = $_POST['location'];
    $season = $_POST['season'];
    $duration = $_POST['duration'];
    $priceRange = $_POST['price-range'];
    $description = $_POST['description'];
    $attractions = $_POST['attractions'];
    $images = $_POST['images'];
    
    // Retrieve UserID from session
    session_start();
    $userId = $_SESSION['user_id'];
    
    // Insert the itinerary into the database
    $insertedId = Database::InsertItinerary($userId, $location, $season, $duration, $description, $attractions, $priceRange, $images);
    
    // Redirect to the home page
    header("Location: " . $router->generate('view', ['id' => $insertedId]));
    exit();
});

// UPDATE PAGE ROUTES
$router->map('GET', '/update/[i:id]', function($id) use ($templates, $database, $router) {
    $itinerary = $database->GetItineraries($id);
    echo $templates->render("update", ['id' => $id, 'itinerary' => $itinerary, 'router' => $router]);
}, "update");

$router->map('POST', '/update/[i:id]', function($id) use ($database) {
    // Retrieve form data
    $location = $_POST['location'];
    $season = $_POST['season'];
    $duration = $_POST['duration'];
    $priceRange = $_POST['price-range'];
    $description = $_POST['description'];
    $attractions = $_POST['attractions'];
    $images = $_POST['images'];
    
    // Call UpdateItinerary
    Database::UpdateItinerary($id, $location, $season, $duration, $description, $attractions, $priceRange, $images);
    
    // Redirect to the updated trip view page
    header("Location: /venturepilot/view/{$id}");
    exit();
});

// DELETE ROUTES
$router->map('GET', '/delete/[i:id]', function($id) use ($templates, $router) {
    echo $templates->render("delete", ['id' => $id, 'router' => $router]);
}, "delete");

$router->map('POST', '/delete/[i:id]', function($id) use ($router) {
    // Call the DeleteItinerary method with the itinerary ID
    Database::DeleteItinerary($id);
    
    // Redirect to the home page or wherever appropriate
    header("Location: " . $router->generate('home'));
    exit();
});

$router->map('GET', '/view/[i:id]', function ($id) use ($database, $templates) {
    echo $templates->render("view", ["id" => $id, "itinerary" => $database->GetItineraries()]);
}, "view");

$router->map('GET', '/signup', function() use ($templates, $router) {
    echo $templates->render("signup", ['router' => $router]);
}, "signup");

$router->map('GET', '/login', function() use ($templates, $router) {
    echo $templates->render("login", ['router' => $router]);
}, "login");

// POST route for signup form submission
$router->map('POST', '/signup', function() {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    // Insert user data into the database
    Database::InsertUser($username, $hashedPassword);
    
    // Redirect to the login page
    header("Location: /venturepilot/login");
    exit();
});

$router->map('POST', '/login', function() {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Fetch user data from the database
    $user = Database::GetUserByUsername($username);
    
    // Verify password
    if ($user && password_verify($password, $user['Password'])) {
        // Start session
        session_start();
        $_SESSION['user_id'] = $user['UserID'];
        $_SESSION['username'] = $user['Username'];
        
        // Redirect to home page or dashboard
        header("Location: /venturepilot/");
        exit();
    } else {
        header("Location: /venturepilot/login");
        exit();
    }
});

// LOGOUT ROUTE
$router->map('GET', '/logout', function() {
    // Destroy the session
    session_start();
    session_unset();
    session_destroy();
    
    // Redirect to login page
    header("Location: /venturepilot/login");
    exit();
});

// Match the routes
$match = $router->match();

// Executes the matched route
if ($match && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    echo $templates->render('notfound');
}
?>
