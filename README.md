The Story Keeper - BookShop System

Project Overview

"The Story Keeper" is a BookShop system designed to manage and facilitate book-related operations for both administrators and customers. The system features an admin panel for managing books, categories, orders, and users, as well as a customer-facing interface for browsing and ordering books.

Configuration

Placing the Project Files

Place the bookshop folder in the C:\xampp\htdocs\ directory.

Database Setup

Open phpMyAdmin.

Create a new database named bookshop.

Import the bookshop.sql file into this database.

Accessing the Application

Admin Panel: http://localhost/bookshop/admin/login.php

Login: admin

Password: admin

Customer Website: http://localhost/bookshop/index.php


Admin Panel Functionalities

Admin Management

Add, edit, delete, and manage admin accounts.

Use cookies and sessions for authentication.

Category Management

Add, edit, delete, and manage book categories.

Option to set categories as available/unavailable.

Book Management

Add, edit, delete, and manage books.

Link books to categories and set availability.

Order Management

View, edit, and manage customer orders.

Update order status with color-coded indicators (e.g., Ordered, On Delivery, Delivered, Cancelled).

Aggregate data for daily orders and revenue using SQL SUM() function.

Session Notifications

Display operation results via session variables.

Customer Website Functionalities

Navigation

Browse categories and books.

Search for books using a search bar.

Ordering System

Order books via a form with JavaScript validation.

Provide customer details such as name, phone, email, and address.

Comments Section

Share opinions about the website.

Validate and sanitize comments to prevent vulgar language.

Technical Details

Validation

HTML: Attribute-based validation (e.g., maxlength, accept).

JavaScript: Regex-based validation for forms.

PHP: SQL injection protection using mysqli_real_escape_string and input sanitization.

CSS Styling

Inline, internal, and external stylesheets.

Modular design with reusable components via include().

File Management

Rename uploaded files with random numbers and organize them into folders:

Books: images/books/book_(randnumber).extension

Categories: images/categories/bookcategory_randnumber.extension

Security

Passwords hashed for storage.

Session management for authentication.

Resources

Below are some of the resources referenced during the development of "The Story Keeper":

phpMyAdmin Documentation

XAMPP Official Site

W3Schools PHP Tutorials

LinkedIn Profile

Author

Kacper Obrzut

How to Run

Install XAMPP and ensure it is running.

Place the project folder in C:\xampp\htdocs\.

Import the bookshop.sql database via phpMyAdmin.

Open the URLs provided in the configuration section to access the application.

Enjoy managing your bookshop with "The Story Keeper"!
