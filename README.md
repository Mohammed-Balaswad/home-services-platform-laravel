# 🛠️ Home Services Platform (Al-Mukalla Region)

[![Laravel Version](https://img.shields.io/badge/Laravel-v11/12-red.svg)](https://laravel.com)
[![TailwindCSS](https://img.shields.io/badge/TailwindCSS-v3.0-blue.svg)](https://tailwindcss.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

An integrated digital solution designed to bridge the gap between local technicians and households in **Al-Mukalla, Yemen**. This platform streamlines the process of booking, managing, and evaluating home services through a robust three-tier architecture.

---

## 📌 Project Overview
In my local community, finding trusted technicians (plumbers, electricians, etc.) is often a manual and fragmented process. This project was developed to provide a **centralized, transparent, and user-friendly** marketplace where service providers and clients can interact efficiently.

---

## 📸 Visual Showcase

### 🖥️ Admin Control Center
> *Complete oversight of users, services, and platform analytics.*
![Admin Dashboard](https://raw.githubusercontent.com/Mohammed-Balaswad/Home_Serveices_Laravel/master/screenshots/admin_dashboard.png)

### 👨‍🔧 Technician Workspace & Scheduling
> *Manage bookings and availability with a dedicated professional interface.*
![Technician Bookings](https://raw.githubusercontent.com/Mohammed-Balaswad/Home_Serveices_Laravel/master/screenshots/technician_bookings.png)

### 🗄️ Database Architecture (ERD)
> *Engineered for scalability and data integrity.*
![ERD](https://raw.githubusercontent.com/Mohammed-Balaswad/Home_Serveices_Laravel/master/screenshots/ERD.png)

---

## ✨ Key Features

### 🔐 Multi-Auth System (3 Roles)
* **Admin Panel:** Comprehensive CRUD for categories, services, and users. Real-time statistics and booking monitoring.
* **Technician Portal:** Status management (Accept/Reject/Complete), schedule tracking, and rating history.
* **Client Experience:** Intuitive service discovery, seamless booking flow, and post-service review system.

### ⚙️ Technical Excellence
* **Backend:** Laravel (MVC Architecture) with optimized Eloquent relationships.
* **Frontend:** Modern, responsive UI built with **TailwindCSS** and **Blade Components**.
* **Security:** Role-based access control and secure data validation.
* **UX Focus:** Specialized workflows designed for ease of use by non-technical service providers.

---

## 🚀 Installation & Setup

1. **Clone & Enter:**
   ```bash
   git clone [https://github.com/Mohammed-Balaswad/Home_Services_Laravel.git](https://github.com/Mohammed-Balaswad/Home_Services_Laravel.git)
   cd Home_Services_Laravel
   ```
2. **Dependencies:**
   ```bash
   composer install && npm install
   ```
3. **Environment Configuration:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. **Database & Seeding:**
   - Create a new database (*EX: home_services_db*)
   - Modify the variables inside .env:
   ```bash
    DB_DATABASE=home_services_db
    DB_USERNAME=root
    DB_PASSWORD=
   ```
5. **Migration & Sedding:(Pre-loaded with Admin and Demo data)**
   ```bash
   php artisan migrate --seed
   ```
7. **Launch:**
   ```bash
   php artisan serve
   npm run dev
   ```
8. **Accounts Login:**
   #### 🔹 **Admin**
    - email: admin@gmail.com
    - password: 123456
   #### 🔹 **Technician + Client**
    - You can add Technician from admin tasks
    - Client can added from register form bage 
   ---

   ## 🛤️ Future Roadmap
    * [ ] **Real-time Chat:** Direct communication via WebSockets.
    * [ ] **Payment Gateway:** Integration for local and international payment methods.
    * [ ] **Mobile App:** Transitioning to a cross-platform mobile experience.
  
    ---

   ## 👨‍💻 Developer
   **Mohammed Saleh Balaswad** *Software Developer | IT Specialist* "Passionate about solving community problems through clean code and thoughtful design."
   - Feel free to ⭐ the repo if you find it useful!
