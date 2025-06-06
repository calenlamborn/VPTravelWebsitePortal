<?php

function getCurrentUserId() {
    // Check if session is already active
    if (session_status() == PHP_SESSION_NONE) {
        // If not start the session
        session_start();
    }
    if(isset($_SESSION['user_id'])) {
        return $_SESSION['user_id'];
    } else {
        return false;
    }
}

class Database {
    private static $config;
    
    public static function loadConfig() {
        self::$config = parse_ini_file("config.ini", true);
    }

    public static function GetReadConnection() {
        self::loadConfig();
        $config = self::$config['database'];
        $connection = new mysqli($config['host'], $config['user_read'], $config['password_read'], $config['database_name']);
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }
        return $connection;
    }

    public static function GetEditConnection() {
        self::loadConfig();
        $config = self::$config['database'];
        $connection = new mysqli($config['host'], $config['user_edit'], $config['password_edit'], $config['database_name']);
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }
        return $connection;
    }

    public static function GetItineraries() {
        $conn = self::GetReadConnection();
        $sql = "SELECT * FROM Itineraries";
        $result = $conn->query($sql);
        $itineraries = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $itineraries[] = $row;
            }
        }
        $conn->close();
        return $itineraries;
    }

    public static function GetUserItineraries($userId) {
        $conn = self::GetReadConnection();
        $stmt = $conn->prepare("SELECT * FROM Itineraries WHERE UserID = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $itineraries = [];
        while ($row = $result->fetch_assoc()) {
            $itineraries[] = $row;
        }
        $stmt->close();
        $conn->close();
        return $itineraries;
    }

    public static function InsertItinerary($userId, $location, $season, $duration, $description, $attractions, $priceRange) {
        $conn = self::GetEditConnection();
        
        // Add a random image for new itineraries
        $imageFiles = ['random1.png', 'random2.png', 'random3.png'];
        $randomImage = $imageFiles[array_rand($imageFiles)];
        
        $sql = "INSERT INTO Itineraries (UserID, Location, Season, Duration, Description, Attractions, PriceRange, Images) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssssss", $userId, $location, $season, $duration, $description, $attractions, $priceRange, $randomImage);
        $stmt->execute();
        
        $insertedId = $stmt->insert_id;
        
        $stmt->close();
        $conn->close();
        
        return $insertedId;
    }  
    
    public static function UpdateItinerary($itineraryId, $location, $season, $duration, $description, $attractions, $priceRange, $images) {
        $conn = self::GetEditConnection();
        $sql = "UPDATE Itineraries SET Location=?, Season=?, Duration=?, Description=?, Attractions=?, PriceRange=?, Images=? WHERE ItineraryID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssi", $location, $season, $duration, $description, $attractions, $priceRange, $images, $itineraryId);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }

    public static function DeleteItinerary($itineraryId) {
        $conn = self::GetEditConnection();
        $sql = "DELETE FROM Itineraries WHERE ItineraryID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $itineraryId);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }

    public static function InsertUser($username, $password) {
        $conn = self::GetEditConnection();
        $sql = "INSERT INTO Users (Username, Password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }    

    public static function GetUserByUsername($username) {
        $conn = self::GetReadConnection();
        $sql = "SELECT UserID, Username, Password FROM Users WHERE Username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();
        $conn->close();
        return $user;
    }    
}
?>