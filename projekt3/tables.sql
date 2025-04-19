SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Create the `buyings` table (replacing `bookings`)
CREATE TABLE `buyings` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `car_id` int(255) NOT NULL,
  `nr_cars` int(255) NOT NULL,  -- Changed from `nr_tickets` to `nr_cars`
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert data for `buyings`
INSERT INTO `buyings` (`id`, `user_id`, `car_id`, `nr_cars`, `date`, `time`) VALUES
(1, 9, 3, 1, '2022-07-21', '12:00'),
(2, 6, 1, 1, '2021-12-30', '17:00');

-- Create the `cars` table (replacing the `movies` table)
CREATE TABLE `cars` (
  `id` int(255) NOT NULL,
  `make` varchar(255) NOT NULL,         -- Car make (e.g., Toyota, Ford)
  `model` varchar(255) NOT NULL,        -- Car model (e.g., Camry, Mustang)
  `mileage` int(255) NOT NULL,         -- Car mileage (e.g., 50000 km)
  `price` decimal(10,2) NOT NULL,      -- Car price (e.g., 25000.00)
  `description` varchar(255) NOT NULL,  -- Car description
  `car_image` varchar(255) NOT NULL     -- Image of the car
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert data for `cars`
INSERT INTO `cars` (`id`, `make`, `model`, `mileage`, `price`, `description`, `car_image`) VALUES
(1, 'Toyota', 'Camry', 50000, 22000.00, 'A reliable sedan offering smooth ride and great fuel efficiency.', 'toyotacamry.jpg'),
(2, 'Ford', 'Mustang', 15000, 35000.00, 'A muscle car known for its powerful engine and classic design.', 'fordmustang.jpg'),
(3, 'Tesla', 'Model S', 20000, 75000.00, 'An electric luxury car with cutting-edge technology.', 'teslamodels.jpg');

-- Create the `users` table (unchanged)
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `emri` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirm_password` varchar(255) NOT NULL,
  `is_admin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert data for `users` (unchanged)
INSERT INTO `users` (`id`, `emri`, `username`, `email`, `password`, `confirm_password`, `is_admin`) VALUES
(4, 'rubin', 'rubinpireva', 'rubin@gmail.com', '$2y$10$dEAPGLJqvWLL0vmG.RwzruhFz3rn3ojVEahmUhy6fR1.XQC/rVMOG', '$2y$10$6WtP4hvODZZ5jfNpbSpqjOYdHY2nGoP2TJhra10XATxYVupTJTWBa', 'false'),
(6, 'taulant', 'taulant', 'taulant@gmail.com', '$2y$10$fqCnjHudiouNiquBUtyy7uSY8LWdINi8WGq6PYmv8IpGh6JbZ5iqa', '$2y$10$VHPFGwlvC4pDMLvfB2C1HeoGAF9/L1TkzYtbXOH1m/QcDWMYgMDRa', 'false'),
(9, 'test', 'test', 'test@gmail.com', '$2y$10$Chn.6e7PBEyH9QPW0CDpcuzZwxowOOsH6nbBVV.qQb.4y8yZsDtBe', '$2y$10$ZoSyBiSOLPAxA..SSRMOh.obgi7uNf6FHpak.6oGiP7Wvr0MnUcNW', 'false'),
(10, 'drin', 'drindalipi', 'drindalipi.dd@gmail.com', '$2y$10$qlLSq511GfasN/hEMh2e5eN0zt7jhgNQi12zoz6Glts1/RF1oBrhi', '$2y$10$0ttx8IkEizYf19u7lQF1b.7g83WCbUZpYXVKhC615hC2r691aCAVG', 'true');

-- Add primary keys for all tables (unchanged)
ALTER TABLE `buyings`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

-- Modify columns to auto increment (unchanged)
ALTER TABLE `buyings`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `cars`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

COMMIT;
