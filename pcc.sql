 CREATE DATABASE pcc_db; 
    
    -- Users Table
     users | CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `user_type` enum('customer','shop_owner','admin') NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `email_2` (`email`),
  KEY `idx_user_type` (`user_type`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci

 login_attempts | CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `attempt_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci

    CREATE TABLE shop_categories (
        category_id INT AUTO_INCREMENT PRIMARY KEY,
        category_name VARCHAR(100) UNIQUE NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        INDEX idx_category_name (category_name)  -- Index for faster lookups by category
    );

    CREATE TABLE shops (
        shop_id INT AUTO_INCREMENT PRIMARY KEY,
        owner_id INT NOT NULL,
        shop_name VARCHAR(255) NOT NULL,
        description TEXT,
        address VARCHAR(255),
        city VARCHAR(100),
        state VARCHAR(100),
        zip_code VARCHAR(20),
        phone_number VARCHAR(20),
        email VARCHAR(255),
        status ENUM('pending', 'active', 'suspended') DEFAULT 'pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (owner_id) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE,  -- Automatically delete shops if owner is deleted
        INDEX idx_status (status), -- Index on status to easily fetch active/pending shops
        INDEX idx_owner_id (owner_id)
    );

    -- Shop Categories Junction Table
    CREATE TABLE shop_category_junction (
        shop_id INT,
        category_id INT,
        PRIMARY KEY (shop_id, category_id),
        FOREIGN KEY (shop_id) REFERENCES shops(shop_id) ON DELETE CASCADE ON UPDATE CASCADE,
        FOREIGN KEY (category_id) REFERENCES shop_categories(category_id) ON DELETE CASCADE ON UPDATE CASCADE,
        INDEX idx_shop_id (shop_id),  -- For faster queries by shop
        INDEX idx_category_id (category_id)  -- For faster queries by category
    );

    -- Services Table
    CREATE TABLE services (
        service_id INT AUTO_INCREMENT PRIMARY KEY,
        shop_id INT NOT NULL,
        category_id INT,
        service_name VARCHAR(255) NOT NULL,
        description TEXT,
        price DECIMAL(10, 2) NOT NULL,
        duration INT,  -- In minutes
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (shop_id) REFERENCES shops(shop_id) ON DELETE CASCADE ON UPDATE CASCADE,
        FOREIGN KEY (category_id) REFERENCES shop_categories(category_id) ON DELETE SET NULL, -- If category is deleted, set to NULL
        INDEX idx_shop_id (shop_id),
        INDEX idx_category_id (category_id)
    );

    -- Appointments Table
        CREATE TABLE appointments (
        appointment_id INT AUTO_INCREMENT PRIMARY KEY,
        customer_id INT NOT NULL,
        shop_id INT NOT NULL,
        service_id INT NOT NULL,
        appointment_date DATE NOT NULL,
        appointment_time TIME NOT NULL,
        status ENUM('pending', 'confirmed', 'completed', 'cancelled') DEFAULT 'pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (customer_id) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE,
        FOREIGN KEY (shop_id) REFERENCES shops(shop_id) ON DELETE CASCADE ON UPDATE CASCADE,
        FOREIGN KEY (service_id) REFERENCES services(service_id) ON DELETE SET NULL, -- If service is removed, keep appointment
        INDEX idx_customer_id (customer_id),
        INDEX idx_shop_id (shop_id),
        INDEX idx_service_id (service_id),
        INDEX idx_status (status)  -- Allows fast filtering by appointment status
    );

    -- Reviews Table
    CREATE TABLE reviews (
        review_id INT AUTO_INCREMENT PRIMARY KEY,
        customer_id INT NOT NULL,
        shop_id INT NOT NULL,
        rating INT CHECK (rating >= 1 AND rating <= 5),
        comment TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (customer_id) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE,
        FOREIGN KEY (shop_id) REFERENCES shops(shop_id) ON DELETE CASCADE ON UPDATE CASCADE,
        INDEX idx_shop_id (shop_id),
        INDEX idx_customer_id (customer_id)
    );

    -- Support Tickets Table
    CREATE TABLE support_tickets (
        ticket_id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        subject VARCHAR(255) NOT NULL,
        description TEXT,
        status ENUM('open', 'in_progress', 'resolved', 'closed') DEFAULT 'open',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE,
        INDEX idx_user_id (user_id),
        INDEX idx_status (status)  -- Quick lookup based on ticket status
    );

    CREATE TABLE staff (
        staff_id INT AUTO_INCREMENT PRIMARY KEY,
        shop_id INT NOT NULL,
        first_name VARCHAR(100) NOT NULL,
        last_name VARCHAR(100) NOT NULL,
        role ENUM('vet', 'groomer', 'assistant', 'admin') NOT NULL,
        specialty VARCHAR(255),  -- Vets or groomers may have a specialty
        phone_number VARCHAR(20),
        email VARCHAR(255) UNIQUE NOT NULL,
        availability JSON,  -- JSON array of availability slots (e.g., ["Mon 9AM-5PM", "Wed 12PM-6PM"])
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (shop_id) REFERENCES shops(shop_id) ON DELETE CASCADE ON UPDATE CASCADE,
        INDEX idx_shop_id (shop_id),
        INDEX idx_role (role)
    );

    CREATE TABLE payments (
        payment_id INT AUTO_INCREMENT PRIMARY KEY,
        appointment_id INT NOT NULL,
        customer_id INT NOT NULL,
        amount DECIMAL(10, 2) NOT NULL,
        payment_method ENUM('credit_card', 'paypal', 'bank_transfer', 'cash') NOT NULL,
        payment_status ENUM('pending', 'completed', 'failed') DEFAULT 'pending',
        transaction_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (appointment_id) REFERENCES appointments(appointment_id) ON DELETE CASCADE ON UPDATE CASCADE,
        FOREIGN KEY (customer_id) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE,
        INDEX idx_appointment_id (appointment_id),
        INDEX idx_customer_id (customer_id),
        INDEX idx_payment_status (payment_status)
    );

    CREATE TABLE invoices (
        invoice_id INT AUTO_INCREMENT PRIMARY KEY,
        payment_id INT NOT NULL,
        invoice_number VARCHAR(50) UNIQUE NOT NULL,
        issue_date DATE NOT NULL,
        due_date DATE,
        amount DECIMAL(10, 2) NOT NULL,
        invoice_status ENUM('unpaid', 'paid', 'overdue') DEFAULT 'unpaid',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (payment_id) REFERENCES payments(payment_id) ON DELETE CASCADE ON UPDATE CASCADE,
        INDEX idx_invoice_number (invoice_number),
        INDEX idx_invoice_status (invoice_status)
    );

    CREATE TABLE refunds (
        refund_id INT AUTO_INCREMENT PRIMARY KEY,
        payment_id INT NOT NULL,
        customer_id INT NOT NULL,
        refund_amount DECIMAL(10, 2) NOT NULL,
        refund_reason TEXT,
        refund_status ENUM('pending', 'approved', 'declined') DEFAULT 'pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (payment_id) REFERENCES payments(payment_id) ON DELETE CASCADE ON UPDATE CASCADE,
        FOREIGN KEY (customer_id) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE,
        INDEX idx_payment_id (payment_id),
        INDEX idx_customer_id (customer_id),
        INDEX idx_refund_status (refund_status)
    );

    CREATE TABLE reports (
        report_id INT AUTO_INCREMENT PRIMARY KEY,
        shop_id INT NOT NULL,
        report_type ENUM('financial', 'appointment', 'performance') NOT NULL,
        report_data JSON NOT NULL,  -- Contains data like total revenue, total appointments, staff performance, etc.
        report_month VARCHAR(20),  -- Format: "MM-YYYY"
        generated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (shop_id) REFERENCES shops(shop_id) ON DELETE CASCADE ON UPDATE CASCADE,
        INDEX idx_shop_id (shop_id),
        INDEX idx_report_month (report_month),
        INDEX idx_report_type (report_type)
    );

    CREATE TABLE review_responses (
        response_id INT AUTO_INCREMENT PRIMARY KEY,
        review_id INT NOT NULL,
        staff_id INT,  -- Optional: the staff member responding
        response TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (review_id) REFERENCES reviews(review_id) ON DELETE CASCADE ON UPDATE CASCADE,
        FOREIGN KEY (staff_id) REFERENCES staff(staff_id) ON DELETE SET NULL ON UPDATE CASCADE,
        INDEX idx_review_id (review_id)
    );

    CREATE TABLE shop_settings (
        shop_id INT PRIMARY KEY,
        settings JSON NOT NULL,  -- Store settings such as notification preferences, shop opening hours, etc.
        FOREIGN KEY (shop_id) REFERENCES shops(shop_id) ON DELETE CASCADE ON UPDATE CASCADE
    );


-- Insert shop categories
INSERT INTO shop_categories (category_name) VALUES
('Grooming'),
('Veterinary Care'),
('Boarding'),
('Training'),
('Pet Sitting');

-- Register a new shop with multiple categories
INSERT INTO shops (owner_id, shop_name, description, address, city, state, zip_code, phone_number, email)
VALUES (1, 'Pawsome Pet Care', 'Full-service pet care center', '123 Main St', 'New York', 'NY', '10001', '1234567890', 'info@pawsome.com');

SET @last_shop_id = LAST_INSERT_ID();

-- Associate the shop with multiple categories
INSERT INTO shop_category_junction (shop_id, category_id)
VALUES 
(@last_shop_id, 1), -- Grooming
(@last_shop_id, 2); -- Veterinary Care

-- Add services for the shop
INSERT INTO services (shop_id, category_id, service_name, description, price, duration)
VALUES
(@last_shop_id, 1, 'Basic Grooming', 'Bath, brush, and nail trim', 50.00, 60),
(@last_shop_id, 2, 'Wellness Exam', 'Comprehensive health check-up', 75.00, 30);

-- Find shops that offer both grooming and veterinary services
SELECT DISTINCT s.shop_id, s.shop_name, s.city
FROM shops s
JOIN shop_category_junction scj1 ON s.shop_id = scj1.shop_id
JOIN shop_category_junction scj2 ON s.shop_id = scj2.shop_id
WHERE scj1.category_id = 1 -- Grooming
AND scj2.category_id = 2 -- Veterinary Care
AND s.status = 'active';

-- Find shops that offer grooming but not veterinary services
SELECT s.shop_id, s.shop_name, s.city
FROM shops s
JOIN shop_category_junction scj ON s.shop_id = scj.shop_id
WHERE scj.category_id = 1 -- Grooming
AND s.status = 'active'
AND s.shop_id NOT IN (
    SELECT shop_id
    FROM shop_category_junction
    WHERE category_id = 2 -- Veterinary Care
);

-- Get all services for a specific shop with their categories
SELECT s.service_id, s.service_name, sc.category_name, s.price, s.duration
FROM services s
JOIN shop_categories sc ON s.category_id = sc.category_id
WHERE s.shop_id = 1
ORDER BY sc.category_name, s.service_name;

-- Book an appointment for a specific service
INSERT INTO appointments (customer_id, shop_id, service_id, appointment_date, appointment_time)
VALUES (2, 1, 1, '2023-06-01', '14:00:00');

-- Get upcoming appointments for a shop with service and category details
SELECT a.appointment_id, u.first_name, u.last_name, s.service_name, 
       sc.category_name, a.appointment_date, a.appointment_time, a.status
FROM appointments a
JOIN users u ON a.customer_id = u.user_id
JOIN services s ON a.service_id = s.service_id
JOIN shop_categories sc ON s.category_id = sc.category_id
WHERE a.shop_id = 1 AND a.appointment_date >= CURDATE()
ORDER BY a.appointment_date, a.appointment_time;

-- Get shops with their offered service categories
SELECT s.shop_id, s.shop_name, s.city, 
       GROUP_CONCAT(DISTINCT sc.category_name ORDER BY sc.category_name SEPARATOR ', ') AS offered_services
FROM shops s
JOIN shop_category_junction scj ON s.shop_id = scj.shop_id
JOIN shop_categories sc ON scj.category_id = sc.category_id
WHERE s.status = 'active'
GROUP BY s.shop_id, s.shop_name, s.city
ORDER BY s.shop_name;

-- Get the top-rated shops for a specific category (e.g., Grooming)
SELECT s.shop_id, s.shop_name, s.city, 
       AVG(r.rating) AS average_rating,
       COUNT(r.review_id) AS review_count
FROM shops s
JOIN shop_category_junction scj ON s.shop_id = scj.shop_id
LEFT JOIN reviews r ON s.shop_id = r.shop_id
WHERE scj.category_id = 1 -- Grooming
AND s.status = 'active'
GROUP BY s.shop_id, s.shop_name, s.city
HAVING COUNT(r.review_id) >= 5
ORDER BY average_rating DESC, review_count DESC
LIMIT 10;

-- Update a shop's offered services (add a new category)
INSERT IGNORE INTO shop_category_junction (shop_id, category_id)
VALUES (1, 3); -- Add Boarding category to shop with ID 1

-- Remove a category from a shop's offered services
DELETE FROM shop_category_junction
WHERE shop_id = 1 AND category_id = 3; -- Remove Boarding category from shop with ID 1

-- Get all support tickets related to a specific service category
SELECT st.ticket_id, u.email, st.subject, st.status, sc.category_name
FROM support_tickets st
JOIN users u ON st.user_id = u.user_id
JOIN appointments a ON u.user_id = a.customer_id
JOIN services s ON a.service_id = s.service_id
JOIN shop_categories sc ON s.category_id = sc.category_id
WHERE sc.category_id = 1 -- Grooming
ORDER BY st.created_at DESC;