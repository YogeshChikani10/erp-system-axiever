
# ERP System – Laravel 12

This repository contains a Laravel 12-based Mini ERP system with user roles, product management, and sales order flow.

GitHub Repo:  
🔗 https://github.com/YogeshChikani10/erp-system-axiever

---

## ⚙️ Project Setup

### 1. Clone the Repository

```bash
git clone https://github.com/YogeshChikani10/erp-system-axiever.git
cd erp-system-axiever
```

---

### 2. Install Dependencies

```bash
composer install
npm install
npm run build
```

---

### 3. Create the Database

Open MySQL and create a database:

```sql
CREATE DATABASE erp_system CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

---

### 4. Setup Environment

Copy `.env.example` to `.env`:

```bash
cp .env.example .env
php artisan key:generate
```

Then update your `.env` file with correct DB credentials:

```
DB_DATABASE=erp_system
DB_USERNAME=root
DB_PASSWORD=
```

---

### 5. Run Migrations

```bash
php artisan migrate
```

---

### 6. Seed Users

```bash
php artisan db:seed --class=UserSeeder
```

Seeded Users:

| Role        | Email                   | Password   |
|-------------|--------------------------|------------|
| Admin       | admin@example.com        | 12345678   |
| Salesperson | salesperson@example.com  | 12345678   |

---

### 7. Seed Products

```bash
php artisan db:seed --class=ProductSeeder
```

Creates 12 demo products with price and quantity.

---

### 8. Install Passport

```bash
php artisan passport:install
```

Sets up Laravel Passport for API authentication.

---

### 9. Run the App

```bash
php artisan serve
```

Visit: [http://localhost:8000](http://localhost:8000)

---

✅ You're ready to go! Login using the seeded credentials and start exploring the ERP system.
