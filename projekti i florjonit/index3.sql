-- Hotels table
CREATE TABLE hotels (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    location VARCHAR(255),
    image_url VARCHAR(255)
);

-- Rooms table
CREATE TABLE rooms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    hotel_id INT,
    room_type VARCHAR(255),
    price DECIMAL(10, 2),
    availability BOOLEAN,
    FOREIGN KEY (hotel_id) REFERENCES hotels(id)
);

-- Bookings table
CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    hotel_id INT,
    room_id INT,
    guest_name VARCHAR(255),
    check_in_date DATE,
    check_out_date DATE,
    num_guests INT,
    email VARCHAR(255),
    FOREIGN KEY (hotel_id) REFERENCES hotels(id),
    FOREIGN KEY (room_id) REFERENCES rooms(id)
);