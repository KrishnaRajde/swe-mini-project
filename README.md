# CyberSafe - Cyber Security Awareness Portal

A clean, beginner-friendly web application for Diploma Semester 3 Computer / IT Engineering mini-project.

## Technologies Used
- **Frontend:** HTML5, Tailwind CSS (CDN), FontAwesome Icons, Custom CSS (`style.css`), GSAP ScrollTrigger
- **Backend:** PHP (Procedural style, beginner-friendly)
- **Database:** MySQL / MariaDB (Single `users` table)
- **Libraries:** html2canvas (CDN for ID card PNG download)

## Features & Modules
1. **User Authentication:**
   - Registration (`register.php`) with password hashing (`password_hash`).
   - Secure login (`login.php`) and session protection (`check_login()`).
   - Clean logout (`logout.php`).

2. **Dashboard (`dashboard.php`):**
   - Displays student name and latest quiz score.
   - Core cybersecurity safety tips.
   - Quick navigation shortcuts to all tools and modules.

3. **Cyber Security Quiz (`quiz.php`):**
   - 10 practical questions on passwords, phishing, and safe browsing.
   - Updates `quiz_score` in the `users` table on submit.

4. **Phishing Detector (`phishing_detector.php`):**
   - Analyzes suspicious SMS, emails, and WhatsApp messages for phishing keywords and red flags.

5. **Password Analyzer (`password_analyzer.php`):**
   - Real-time password complexity tester, crack-time estimation, and recommendations.

6. **Password Generator (`password_generator.php`):**
   - Generates strong random passwords using browser cryptography (`crypto.getRandomValues`).
   - Custom length slider, character toggles, and one-click copy to clipboard.

7. **Photo Upload & Certified ID Card (`upload_photo.php`, `id_card.php`):**
   - Upload profile photo (JPG/PNG max 2MB) saved to `uploads/`.
   - Displays styled CyberSafe Certified ID with zero-padded ID number (`CS-XXXXX`), quiz score, issue date, and certified badge.
   - One-click PNG download (html2canvas) and print support (`window.print()`).

## Database Setup
Import `database.sql` into phpMyAdmin or run:
```sql
CREATE DATABASE IF NOT EXISTS cybersafe;
USE cybersafe;

CREATE TABLE IF NOT EXISTS users (
  user_id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  quiz_score INT DEFAULT 0,
  photo VARCHAR(255) NULL
);
```

## macOS Setup Guide (XAMPP / MAMP / PHP)

### 1. Where to place the project on Mac
- **XAMPP for Mac:** Copy the `cyber` folder to:  
  `/Applications/XAMPP/xamppfiles/htdocs/cyber`
- **MAMP for Mac:** Copy the `cyber` folder to:  
  `/Applications/MAMP/htdocs/cyber`

### 2. Database Connection & Port Configuration
- Database settings and port are configured in [`includes/db.php`](file:///d:/xampp/htdocs/cyber/includes/db.php).
- It is currently set to port **3307**:
  ```php
  $port = 3307; // Change to 3306 for macOS XAMPP default, or 8889 for MAMP
  ```
- If you move the project to Mac and your XAMPP MySQL uses default port **3306**, simply change `$port = 3306;` in `includes/db.php`.
- Import `database.sql` into phpMyAdmin (`http://localhost/phpmyadmin`) or run the SQL script above.

### 3. Folder Permissions for Photo Uploads on Mac
On macOS XAMPP, Apache runs under the `daemon` or `_www` user account. Since your Mac user owns the project folder, Apache needs write permission to save photos into `uploads/`.

Open **Terminal** on your Mac, navigate to your project directory, and run:
```bash
cd /Applications/XAMPP/xamppfiles/htdocs/cyber
chmod -R 777 uploads
```
*(Tip: `upload_photo.php` now includes automatic permission detection, client-side auto-resizing for high-resolution Mac Retina screenshots/photos, and a one-click copy button for this command).*

