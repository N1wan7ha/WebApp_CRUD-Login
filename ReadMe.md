**WebApp\_CRUD-Login**

A simple CRUD (Create, Read, Update, Delete) application with user login functionality, developed using PHP, Bootstrap, and MySQL. This project provides a user management system with a responsive and clean interface.

**Features**

- User Registration and Login
- CRUD Operations: Create, Read, Update, and Delete records
- Secure and validated data handling
- Responsive design using Bootstrap

**Getting Started**

**Prerequisites**

- PHP (version 7.4 or higher recommended)
- MySQL
- Web server (e.g., Apache, XAMPP, or MAMP)

**Installation**

1. **Clone the repository:**

git clone https://github.com/N1wan7ha/WebApp_CRUD-Login.git

cd PHP-CRUD-Login-System

1. **Database Setup:**
   1. Import the provided Loginsystem1.sql file into your MySQL database.
   1. You can do this via PHPMyAdmin, MySQL Workbench, or the command line:



mysql -u yourusername -p yourdatabase < Loginsystem1.sql

1. **Configure Database Connection:**
   1. Open the config.php file.
   1. Update the database credentials:

$host = "localhost";

$username = "yourusername";

$password = "yourpassword";

$database = "login_system";

1. **Run the Application:**
   1. Start your web server (e.g., Apache in XAMPP or MAMP).
   1. Open your browser and navigate to:

http://localhost/loginsystem1/

**Usage**

- **Create**: Register new users through the create.php form.
- **Read**: View all records on the read.php page.
- **Update**: Edit existing records through the main dashboard (main.php).
- **Delete**: Remove records as needed via the dashboard.

**Folder Structure**

- read.php - Main page for viewing records
- create.php - Registration form
- login.php - Login form
- main.php - Main dashboard with CRUD options
- config.php - Database connection configuration
- Loginsystem1.sql - Database schema file

