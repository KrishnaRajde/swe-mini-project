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

## macOS (XAMPP) Setup
On macOS, XAMPP's Apache runs as the `daemon` user, so it cannot save photos into `uploads/` unless the folder is writable. From the project folder run:
```bash
chmod 777 uploads uploads/photos
```
Without this, photo upload fails with "Failed to save uploaded photo" / "Upload folder is not writable".
