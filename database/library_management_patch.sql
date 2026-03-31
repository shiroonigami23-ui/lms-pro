-- LMS Pro full schema + seed + performance indexes
-- Database: if0_40800486_Library_Management

CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    email VARCHAR(190) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    mobile VARCHAR(30) DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS users (
    id VARCHAR(50) PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    course VARCHAR(120) NOT NULL,
    department VARCHAR(120) NOT NULL,
    email VARCHAR(190) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    verification_code VARCHAR(100) DEFAULT '',
    is_verified TINYINT(1) NOT NULL DEFAULT 0,
    mobile VARCHAR(20) NOT NULL,
    address TEXT NOT NULL,
    Role TINYINT(1) NOT NULL DEFAULT 0
);

CREATE TABLE IF NOT EXISTS authors (
    author_id INT PRIMARY KEY,
    author_name VARCHAR(190) NOT NULL
);

CREATE TABLE IF NOT EXISTS category (
    cat_id INT PRIMARY KEY,
    cat_name VARCHAR(190) NOT NULL
);

CREATE TABLE IF NOT EXISTS books (
    book_id INT AUTO_INCREMENT PRIMARY KEY,
    book_name VARCHAR(255) NOT NULL,
    author_id INT NOT NULL,
    cat_id INT NOT NULL,
    book_no INT NOT NULL UNIQUE,
    book_price DECIMAL(10,2) NOT NULL DEFAULT 0,
    quantity INT NOT NULL DEFAULT 0
);

CREATE TABLE IF NOT EXISTS issued_books (
    s_no INT AUTO_INCREMENT PRIMARY KEY,
    book_no INT NOT NULL,
    book_name VARCHAR(255) NOT NULL,
    book_author VARCHAR(190) NOT NULL,
    student_id VARCHAR(50) NOT NULL,
    issue_date DATE NOT NULL,
    dues_status VARCHAR(40) NOT NULL DEFAULT 'N/A'
);

CREATE TABLE IF NOT EXISTS request_books (
    request_no INT AUTO_INCREMENT PRIMARY KEY,
    student_id VARCHAR(50) NOT NULL,
    book_no INT NOT NULL,
    book_name VARCHAR(255) NOT NULL,
    book_author VARCHAR(190) NOT NULL,
    dated DATE NOT NULL,
    status VARCHAR(60) NOT NULL DEFAULT 'Not Accepted'
);

CREATE TABLE IF NOT EXISTS feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    roll VARCHAR(50) NOT NULL,
    date DATE NOT NULL,
    category VARCHAR(120) NOT NULL,
    feedback TEXT NOT NULL,
    response TEXT
);

CREATE INDEX idx_users_email ON users(email);
CREATE INDEX idx_admins_email ON admins(email);
CREATE INDEX idx_books_author ON books(author_id);
CREATE INDEX idx_books_category ON books(cat_id);
CREATE INDEX idx_issued_student ON issued_books(student_id);
CREATE INDEX idx_issued_book ON issued_books(book_no);
CREATE INDEX idx_request_student ON request_books(student_id);
CREATE INDEX idx_request_book ON request_books(book_no);

-- Seed admin account requested by user
UPDATE admins
SET name = 'Shiro Admin',
    password = 'Shiro'
WHERE email = 'shiroonigami23@gmail.com';

INSERT INTO admins (name, email, password)
SELECT 'Shiro Admin', 'shiroonigami23@gmail.com', 'Shiro'
WHERE NOT EXISTS (
    SELECT 1 FROM admins WHERE email = 'shiroonigami23@gmail.com'
);

