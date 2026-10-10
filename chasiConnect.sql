-- ChasiConnect (cc) - Ready to Import Demo Database
CREATE DATABASE IF NOT EXISTS cc CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE cc;

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS reports;
DROP TABLE IF EXISTS harvests;
DROP TABLE IF EXISTS hiring_requests;
DROP TABLE IF EXISTS investments;
DROP TABLE IF EXISTS project_updates;
DROP TABLE IF EXISTS farming_projects;
DROP TABLE IF EXISTS lands;
DROP TABLE IF EXISTS landowner_profiles;
DROP TABLE IF EXISTS investor_profiles;
DROP TABLE IF EXISTS farmer_profiles;
DROP TABLE IF EXISTS users;
SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE users (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  phone VARCHAR(30),
  role ENUM('admin','farmer','investor','landowner') NOT NULL,
  status ENUM('active','inactive','suspended') NOT NULL DEFAULT 'active',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE farmer_profiles (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id INT UNSIGNED NOT NULL UNIQUE,
  experience_years DECIMAL(4,1) DEFAULT 0,
  specialization VARCHAR(255),
  bio TEXT,
  profile_image VARCHAR(255),
  verification_status ENUM('pending','approved','rejected') DEFAULT 'pending',
  rating DECIMAL(3,2) DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE investor_profiles (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id INT UNSIGNED NOT NULL UNIQUE,
  occupation VARCHAR(150),
  organization VARCHAR(150),
  investment_preference VARCHAR(255),
  bio TEXT,
  profile_image VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE landowner_profiles (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id INT UNSIGNED NOT NULL UNIQUE,
  address VARCHAR(255),
  occupation VARCHAR(150),
  bio TEXT,
  profile_image VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE lands (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  landowner_id INT UNSIGNED NOT NULL,
  title VARCHAR(150) NOT NULL,
  location VARCHAR(255) NOT NULL,
  area DECIMAL(10,2) NOT NULL,
  area_unit ENUM('acre','bigha','katha','decimal','hectare') DEFAULT 'acre',
  soil_type VARCHAR(100),
  land_type VARCHAR(100),
  description TEXT,
  image VARCHAR(255),
  availability_status ENUM('available','unavailable') DEFAULT 'available',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (landowner_id) REFERENCES landowner_profiles(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE farming_projects (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  farmer_id INT UNSIGNED NOT NULL,
  land_id INT UNSIGNED NOT NULL,
  title VARCHAR(200) NOT NULL,
  crop VARCHAR(150) NOT NULL,
  description TEXT,
  required_budget DECIMAL(12,2) DEFAULT 0,
  current_funding DECIMAL(12,2) DEFAULT 0,
  duration_months INT UNSIGNED DEFAULT 1,
  progress_percentage DECIMAL(5,2) DEFAULT 0,
  status ENUM('pending','approved','rejected','active','completed') DEFAULT 'pending',
  rejection_reason TEXT,
  submitted_at TIMESTAMP NULL,
  approved_at TIMESTAMP NULL,
  completed_at TIMESTAMP NULL,
  total_profit DECIMAL(12,2) NULL,
  farmer_profit_share DECIMAL(12,2) NULL,
  platform_profit_share DECIMAL(12,2) NULL,
  profit_distributed_at DATETIME NULL,
  settled_by_admin_id INT UNSIGNED NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (farmer_id) REFERENCES farmer_profiles(id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (land_id) REFERENCES lands(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE project_updates (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  project_id INT UNSIGNED NOT NULL,
  progress_percentage DECIMAL(5,2) DEFAULT 0,
  milestone VARCHAR(200),
  description TEXT,
  photo VARCHAR(255),
  expense DECIMAL(12,2) DEFAULT 0,
  update_date DATE NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (project_id) REFERENCES farming_projects(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE investments (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  investor_id INT UNSIGNED NOT NULL,
  project_id INT UNSIGNED NOT NULL,
  amount DECIMAL(12,2) NOT NULL,
  status ENUM('pending','confirmed','completed','cancelled') DEFAULT 'pending',
  confirmation_code VARCHAR(50) UNIQUE,
  profit_share DECIMAL(12,2) NULL,
  invested_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (investor_id) REFERENCES investor_profiles(id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (project_id) REFERENCES farming_projects(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE hiring_requests (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  landowner_id INT UNSIGNED NOT NULL,
  farmer_id INT UNSIGNED NOT NULL,
  land_id INT UNSIGNED NOT NULL,
  message TEXT,
  lease_amount DECIMAL(12,2) NULL,
  status ENUM('pending','accepted','rejected','completed') DEFAULT 'pending',
  requested_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  responded_at TIMESTAMP NULL,
  lease_paid_at DATETIME NULL,
  completed_at TIMESTAMP NULL,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (landowner_id) REFERENCES landowner_profiles(id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (farmer_id) REFERENCES farmer_profiles(id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (land_id) REFERENCES lands(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE harvests (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  project_id INT UNSIGNED NOT NULL,
  crop VARCHAR(150) NOT NULL,
  quantity DECIMAL(12,2),
  quantity_unit VARCHAR(50),
  estimated_value DECIMAL(12,2),
  harvest_date DATE NOT NULL,
  description TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (project_id) REFERENCES farming_projects(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE reports (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  reporter_id INT UNSIGNED NOT NULL,
  reported_user_id INT UNSIGNED NULL,
  project_id INT UNSIGNED NULL,
  report_type ENUM('user','project','other') DEFAULT 'other',
  subject VARCHAR(200) NOT NULL,
  description TEXT NOT NULL,
  status ENUM('pending','reviewing','resolved','dismissed') DEFAULT 'pending',
  admin_note TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  resolved_at TIMESTAMP NULL,
  FOREIGN KEY (reporter_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (reported_user_id) REFERENCES users(id) ON DELETE SET NULL ON UPDATE CASCADE,
  FOREIGN KEY (project_id) REFERENCES farming_projects(id) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB;

-- =========================================================
-- DEMO DATA
-- Password for all demo accounts: password (stored as plain text)
-- Plaintext passwords are for development/testing only.
-- =========================================================

INSERT INTO users (id,name,email,password,phone,role,status) VALUES
(1,'Tasnim Admin','admin@chasiconnect.com','password','01710000001','admin','active'),
(2,'Nahid Hasan','nahid@chasiconnect.com','password','01710000002','farmer','active'),
(3,'Mubin Ahmed','mubin@chasiconnect.com','password','01710000003','investor','active'),
(4,'Shafayet Rahman','shafayet@chasiconnect.com','password','01710000004','landowner','active'),
(5,'Rafiul Karim','rafiul@chasiconnect.com','password','01710000005','farmer','active'),
(6,'admin','admin@demo.local','admin','01710000006','admin','active'),
(7,'invest','invest@demo.local','invest','01710000007','investor','active'),
(8,'farmer','farmer@demo.local','farmer','01710000008','farmer','active'),
(9,'land','land@demo.local','land','01710000009','landowner','active');

-- Quick demo logins (username = password): admin/admin, invest/invest, farmer/farmer, land/land

INSERT INTO farmer_profiles
(id,user_id,experience_years,specialization,bio,profile_image,verification_status,rating)
VALUES
(1,2,6.0,'Rice and Vegetable Farming','Experienced farmer specializing in seasonal crops.',NULL,'approved',4.70),
(2,5,3.0,'Organic Vegetable Farming','Young farmer focused on organic vegetables.',NULL,'pending',4.20),
(3,8,1.0,'Demo Farming','Demo farmer account for quick login (farmer/farmer).',NULL,'approved',0.00);

INSERT INTO investor_profiles
(id,user_id,occupation,organization,investment_preference,bio,profile_image)
VALUES
(1,3,'Business Owner','Green Capital BD','Vegetables and rice projects','Interested in sustainable farming.',NULL),
(2,7,'Demo Investor','Demo Org','Demo investor account for quick login (invest/invest)','Demo investor profile.',NULL);

INSERT INTO landowner_profiles
(id,user_id,address,occupation,bio,profile_image)
VALUES
(1,4,'Kaliganj, Gazipur','Landowner','Owns agricultural land suitable for seasonal crops.',NULL),
(2,9,'Demo Land Plot','Dhaka','Demo landowner account for quick login (land/land).',NULL);

INSERT INTO lands
(id,landowner_id,title,location,area,area_unit,soil_type,land_type,description,image,availability_status)
VALUES
(1,1,'Kaliganj Agricultural Land','Kaliganj, Gazipur',2.50,'acre','Loamy','Agricultural','Fertile land suitable for rice and vegetables.',NULL,'available'),
(2,1,'Vegetable Farming Plot','Kaliganj, Gazipur',1.20,'acre','Sandy Loam','Agricultural','Small plot suitable for vegetables.',NULL,'available');

INSERT INTO farming_projects
(id,farmer_id,land_id,title,crop,description,required_budget,current_funding,duration_months,progress_percentage,status,submitted_at,approved_at)
VALUES
(1,1,1,'Winter Rice Farming Project','Rice','Seasonal rice cultivation project with modern farming methods.',150000.00,75000.00,5,45.00,'active','2026-08-01 10:00:00','2026-08-03 12:00:00'),
(2,2,2,'Organic Vegetable Project','Vegetables','Organic vegetable farming project for local markets.',80000.00,0.00,4,0.00,'pending','2026-08-10 09:30:00',NULL);

INSERT INTO project_updates
(id,project_id,progress_percentage,milestone,description,photo,expense,update_date)
VALUES
(1,1,45.00,'Seedling and Field Preparation','Field preparation and initial planting completed.',NULL,25000.00,'2026-08-15'),
(2,1,60.00,'Plant Growth','Crop growth is progressing well after irrigation.',NULL,12000.00,'2026-08-24');

INSERT INTO investments
(id,investor_id,project_id,amount,status,confirmation_code,invested_at)
VALUES
(1,1,1,50000.00,'confirmed','CC-INV-0001','2026-08-05 14:30:00'),
(2,1,1,25000.00,'confirmed','CC-INV-0002','2026-08-12 11:15:00');

INSERT INTO hiring_requests
(id,landowner_id,farmer_id,land_id,message,status,requested_at)
VALUES
(1,1,1,2,'Please manage vegetable farming on this land.','pending','2026-08-20 10:00:00'),
(2,1,2,1,'Interested in hiring you for seasonal farming.','accepted','2026-08-18 09:00:00');

INSERT INTO harvests
(id,project_id,crop,quantity,quantity_unit,estimated_value,harvest_date,description)
VALUES
(1,1,'Rice',1200.00,'kg',90000.00,'2026-12-20','Expected harvest from the winter rice project.');

INSERT INTO reports
(id,reporter_id,reported_user_id,project_id,report_type,subject,description,status)
VALUES
(1,3,5,NULL,'user','Profile verification concern','Please review this farmer profile.','pending'),
(2,4,NULL,2,'project','Project information review','Please verify the submitted project details.','reviewing');

SET FOREIGN_KEY_CHECKS=1;
