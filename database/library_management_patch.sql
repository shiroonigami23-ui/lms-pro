-- Apply this on your existing library_management database.
-- Improves query speed and seeds admin account.

USE if0_40800486_Library_Management;

ALTER TABLE users ADD INDEX idx_users_email (email);
ALTER TABLE admins ADD INDEX idx_admins_email (email);
ALTER TABLE books ADD INDEX idx_books_author (author_name);
ALTER TABLE books ADD INDEX idx_books_category (cat_id);
ALTER TABLE issued_books ADD INDEX idx_issued_student (student_id);
ALTER TABLE issued_books ADD INDEX idx_issued_book (book_no);
ALTER TABLE request_books ADD INDEX idx_request_student (student_id);
ALTER TABLE request_books ADD INDEX idx_request_book (book_no);

-- Admin seed (password = shiro)
UPDATE admins
SET name = 'Shiro Admin',
    password = 'shiro'
WHERE email = 'shiroonigami23@gmail.com';

INSERT INTO admins (name, email, password)
SELECT 'Shiro Admin', 'shiroonigami23@gmail.com', 'shiro'
WHERE NOT EXISTS (
    SELECT 1 FROM admins WHERE email = 'shiroonigami23@gmail.com'
);
