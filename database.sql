CREATE DATABASE IF NOT EXISTS travel_itineraries;

USE travel_itineraries;

CREATE TABLE IF NOT EXISTS users (
    UserID INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(255) NOT NULL,
    Password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS itineraries (
    ItineraryID INT AUTO_INCREMENT PRIMARY KEY,
    Location VARCHAR(255) NOT NULL,
    Season VARCHAR(50) NOT NULL,
    Duration VARCHAR(50) NOT NULL,
    Description TEXT NOT NULL,
    Attractions TEXT NOT NULL,
    PriceRange VARCHAR(50) NOT NULL,
    Images VARCHAR(255),
    UserID INT,
    FOREIGN KEY (UserID) REFERENCES users(UserID)
);

INSERT INTO itineraries (Location, Season, Duration, Description, Attractions, PriceRange, Images, UserID) 
VALUES 
('Spain', 'Spring', '5 Days', 'Explore Spain’s vibrant cities and heritage!', 'Barcelona, Madrid, Alhambra', '$2,100', 'pic1.png', NULL),
('Japan', 'Autumn', '8 Days', 'Experience the beauty of Japan in the fall.', 'Tokyo, Kyoto, Mount Fuji', '$3,000', 'pic2.png', NULL),
('Greece', 'Spring', '7 Days', 'Explore ancient ruins and beautiful islands through Greece.', 'Athens, Santorini, Acropolis', '$2,200', 'pic3.png', NULL),
('New York', 'Any', '5 Days', 'Enjoy the livelihood and magic of New York City.', 'Times Square, Central Park, Statue of Liberty', '$1,600', 'pic4.png', NULL),
('Puerto Rico', 'Spring', '7 Days', 'Venture to Puerto Rico for beautiful beaches and culture.', 'San Juan, El Yunque National Forest, Bioluminescent Bay', '$2,000', 'pic5.png', NULL);
