 Hotel Management System in PHP

Project Overview
This is a web-based Hotel Management System built with PHP and MySQL. 
The system allows users to book rooms, manage reservations, and 
includes an admin panel for hotel management operations.

---

## Installation Steps

1. **Install XAMPP** (or any local server with PHP & MySQL support) 

2. **Start Apache and MySQL** services using the XAMPP control panel.

3. **Extract** the project folder (e.g., `Hotel`).

4. **Copy** the project folder to your `xampp/htdocs/` directory.

5. **Create the Database:**
   - Open your browser and go to `http://localhost/phpmyadmin/`.
   - Click on the **Databases** tab.
   - Create a new database named `hotel`.
   - Select the newly created database.
   - Click on the **Import** tab.
   - Upload the `hotel.sql` file located inside the project folder.
   - Click **Go** to import the database.

6. **Configure Database Connection:**
   - Open the database configuration file (usually `config.php` or similar).
   - Update the database credentials if needed (host, username, password, database name).

7. **Run the Project:**
   - Open a browser and navigate to `http://localhost/Hotel/` to access the main user panel.
   - For the admin panel, go to `http://localhost/Hotel/admin/index.php`.

---


## Features

- User registration and login
- Room booking and availability check
- Automatic booking confirmation email sent to users upon successful booking
- Admin panel for managing rooms, bookings, and users
- MySQL database integration

---

## Technologies Used

- PHP
- MySQL
- HTML/CSS
- JavaScript (optional)

---


