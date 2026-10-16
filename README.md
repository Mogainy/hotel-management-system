# 🍽️ Hotel Management & QR Code Ordering System

A web-based hotel and restaurant ordering management system developed using **PHP, MySQL, HTML, CSS, and JavaScript**.

The application streamlines food ordering by connecting guests, chefs, waiters, and administrators through a centralized digital platform.

## 📌 Project Overview

The Hotel Management & QR Code Ordering System is designed to improve restaurant operations by digitizing menu access, food ordering, kitchen workflows, and order delivery.

The system incorporates QR-code technology to support convenient menu access and provides dedicated interfaces for different user roles.

This project demonstrates practical full-stack web development, relational database management, role-based workflows, and integration of third-party PHP libraries.

## ✨ Key Features

### 👤 Guest Module

- Browse available food and beverage items.
- View the digital restaurant menu.
- Add menu items to a shopping cart.
- Review selections before placing orders.
- Submit food orders.
- Track order progress.
- View order confirmation.

### 👨‍🍳 Chef Module

- Access a dedicated kitchen dashboard.
- View incoming customer orders.
- Update food preparation statuses.
- Support coordination between kitchen staff and waiters.

### 🧑‍💼 Waiter Module

- Access a dedicated waiter dashboard.
- View orders requiring delivery.
- Update order delivery information.
- Coordinate completed orders with the kitchen.

### 🛠️ Administrator Module

- Access an administrative dashboard.
- Add new food and beverage items.
- Edit existing menu items.
- Delete menu items.
- Generate QR codes.
- Manage QR-code resources.
- Access restaurant reports.

## 🛠️ Technologies Used

| Technology | Purpose |
|---|---|
| PHP | Backend development |
| MySQL | Database management |
| HTML5 | Web page structure |
| CSS3 | Interface styling |
| JavaScript | Client-side interactivity |
| AJAX | Asynchronous order updates |
| PHP QR Code Library | QR-code generation |
| XAMPP | Local development environment |
| Git & GitHub | Version control |

## 📂 Project Structure

```text
hotel-ordering-system/
│
├── admin/
│   ├── dashboard.php
│   ├── add_item.php
│   ├── edit_item.php
│   ├── delete_item.php
│   ├── menu_items.php
│   ├── generate_qr.php
│   ├── qr_codes.php
│   └── reports.php
│
├── chef/
│   ├── dashboard.php
│   ├── orders_ajax.php
│   └── update_status.php
│
├── guest/
│   ├── menu.php
│   ├── cart.php
│   ├── add_to_cart.php
│   ├── place_order.php
│   ├── track_order.php
│   └── order_success.php
│
├── waiter/
│   ├── dashboard.php
│   └── deliver.php
│
├── config/
│   └── db.php
│
├── database/
│   └── hotel_ordering_system.sql
│
├── assets/
├── includes/
├── libraries/
├── uploads/
│
├── index.php
├── login.php
├── logout.php
├── dashboard_redirect.php
└── README.md
```

## 🔄 System Workflow

**1. Guest Ordering**

The guest accesses the digital menu, selects food items, adds them to the cart, and places an order.

**2. Kitchen Processing**

The chef views incoming orders through the kitchen dashboard and updates their preparation status.

**3. Order Delivery**

The waiter accesses the delivery dashboard and records order delivery.

**4. Administration**

The administrator manages menu items, generates QR codes, and accesses operational reports.

## ⚙️ Installation and Setup

### Requirements

- XAMPP or an equivalent PHP/MySQL server
- PHP
- MySQL or MariaDB
- A modern web browser

### Step 1: Clone the Repository

```bash
git clone https://github.com/Mogainy/hotel-management-system.git
```

### Step 2: Move the Project

Place the project inside the XAMPP `htdocs` directory.

Example:

```text
C:\xampp\htdocs\hotel-ordering-system
```

### Step 3: Configure the Database

1. Start Apache and MySQL using XAMPP.
2. Visit `http://localhost/phpmyadmin`.
3. Create a database named `hotel_ordering_system`, or use the name required by your application configuration.
4. Import the `database/hotel_ordering_system.sql` file.
5. Configure the database connection in `config/db.php` for your local environment.

### Step 4: Run the Application

Open your browser and visit:

```text
http://localhost/hotel-ordering-system/
```

Use the application's configured login accounts to access the relevant dashboards.

## 📸 Screenshots

Application screenshots can be added here to demonstrate:

- Homepage and login
- Digital menu and guest ordering
- QR-code generation
- Chef dashboard
- Waiter dashboard
- Administrator dashboard

## 🎯 Project Objectives

- Digitize restaurant food ordering.
- Reduce manual order-handling processes.
- Improve coordination between guests, chefs, and waiters.
- Provide centralized administration of restaurant menu items.
- Demonstrate practical PHP and MySQL application development.

## 🚀 Future Enhancements

- Online payment integration.
- Customer notifications.
- Advanced sales analytics.
- Inventory management.
- Mobile application integration.
- Improved order tracking.

## 👨‍💻 Developer

**Enock Mokaya**

Diploma in Information Technology  
Zetech University, Kenya

**GitHub:** https://github.com/Mogainy

**Email:** enockmokaya35@gmail.com

## 📄 Project Status

Portfolio project developed to demonstrate web-based restaurant ordering, QR-code integration, database management, and multi-role application workflows.

---

**Developed by Enock Mokaya**