-- CyberSafe Database Schema - Diploma Sem 3 Project
-- Database: cybersafe

CREATE DATABASE IF NOT EXISTS cybersafe;
USE cybersafe;

-- Clean CREATE TABLE for fresh installs
CREATE TABLE IF NOT EXISTS users (
  user_id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  quiz_score INT DEFAULT 0,
  photo VARCHAR(255) NULL
);

-- ==========================================================
-- Migration script for existing tables (if upgrading):
-- ==========================================================
-- ALTER TABLE users CHANGE COLUMN id user_id INT AUTO_INCREMENT;
-- ALTER TABLE users ADD COLUMN quiz_score INT DEFAULT 0 AFTER password;
-- ALTER TABLE users ADD COLUMN photo VARCHAR(255) NULL AFTER quiz_score;
-- UPDATE users SET photo = photo_path WHERE photo_path IS NOT NULL;
-- ALTER TABLE users DROP COLUMN IF EXISTS photo_path;
-- ALTER TABLE users DROP COLUMN IF EXISTS security_score;
-- ALTER TABLE users DROP COLUMN IF EXISTS risk_level;
-- ALTER TABLE users DROP COLUMN IF EXISTS cybersafe_id;
-- ALTER TABLE users DROP COLUMN IF EXISTS issue_date;
-- ALTER TABLE users DROP COLUMN IF EXISTS created_at;
