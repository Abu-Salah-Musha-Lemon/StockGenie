
# <p align="center">🧞 Stock Genie</p>
### <p align="center">👨‍💻 Developed by <a href="https://github.com/Abu-Salah-Musha-Lemon">Abu Salah Musha Lemon</a></p>

### <p align="center">Smart Inventory Management & Point of Sale System</p>

<p align="center"> <strong>Manage your inventory. Simplify your sales. Grow your business.</strong> </p>

<p align="center"> A lightweight inventory management and POS solution built with Laravel to help small businesses manage products, track stock, process sales, and generate reports efficiently. </p>

<p align="center"> <img src="https://img.shields.io/badge/Version-v1.1.0-blue?style=for-the-badge" alt="Version 1.1.0"> <img src="https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 11"> <img src="https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.2"> <img src="https://img.shields.io/badge/License-MIT-green?style=for-the-badge" alt="MIT License"> </p>

<p align="center"> <a href="#-features">Features</a> • <a href="#-technology-stack">Tech Stack</a> • <a href="#-installation">Installation</a> • <a href="#-usage">Usage</a> • <a href="#-contributing">Contributing</a> </p>

---

## 📖 About the Project

**Stock Genie** is a comprehensive inventory management and point-of-sale (POS) application designed for small businesses that need a simple and effective way to manage daily operations.

Built with **Laravel 11** and **PHP 8.2**, Stock Genie combines inventory tracking, product categorization, sales processing, shopping cart functionality, and PDF reporting in one convenient application.

Whether you're managing product stock or processing customer purchases, Stock Genie helps make everyday business operations more organized and efficient.

## ✨ Features

### 📦 Inventory Management

- Manage products and product categories.
- Monitor stock levels and inventory records.
- Keep inventory updated as sales are processed.

### 🛒 Point of Sale (POS)

- Process sales through an intuitive checkout workflow.
- Manage shopping cart items before completing a sale.
- Update inventory when transactions are processed.

### 🔐 Authentication

- Secure login and authentication using Laravel Breeze.
- Authentication scaffolding for a single-user application.

### 📊 Interactive DataTables

- Search and sort product and inventory records.
- Browse tabular data more conveniently.
- Improve usability when managing business information.

### 📄 PDF Reports

- Generate downloadable PDF reports.
- Produce printable business documents and reports using DomPDF.

### 🔔 Notifications

- Display informative notifications using Toastr.
- Provide feedback for supported actions and system events.

### 📱 Responsive Interface

- Responsive layouts powered by Bootstrap.
- Clean interface with Bootstrap Icons.
- JavaScript and jQuery enhancements for interactive features.

## 🛠️ Technology Stack

| Technology | Purpose |
| --- | --- |
| [Laravel 11](<https://laravel.com/>) | Backend framework |
| [PHP 8.2](<https://www.php.net/>) | Server-side programming |
| [Laravel Breeze](<https://laravel.com/docs/11.x/starter-kits>) | Authentication scaffolding |
| Laravel Shopping Cart | Shopping cart functionality |
| [Laravel DomPDF](<https://github.com/barryvdh/laravel-dompdf>) | PDF generation |
| [Bootstrap](<https://getbootstrap.com/>) | Responsive UI |
| [Bootstrap Icons](<https://icons.getbootstrap.com/>) | Interface icons |
| [jQuery](<https://jquery.com/>) | JavaScript interactions |
| [DataTables](<https://datatables.net/>) | Interactive tables |
| [Toastr](<https://github.com/CodeSeven/toastr>) | Notifications |
| [npm](<https://www.npmjs.com/>) | Frontend dependency management |
| [Composer](<https://getcomposer.org/>) | PHP dependency management |

## ⚙️ Requirements

Before installing Stock Genie, ensure that your development environment includes:

- PHP 8.2 or a compatible version supported by your Laravel installation.
- Composer.
- Node.js and npm.
- A supported database configured for Laravel.
- PHP extensions required by your dependencies, including `zip` and `gd`.

## 🚀 Installation

Follow these steps to install and run Stock Genie locally.

### 1. Clone the Repository

bash

```
git clone https://github.com/Abu-Salah-Musha-Lemon/Stock-Genie.git

cd Stock-Genie
```

> If the cloned directory has a different name, enter that directory instead.

### 2. Install Dependencies

Install the PHP dependencies:

bash

```
composer install
```

Install the frontend dependencies:

bash

```
npm install
```

### 3. Configure Environment Variables

Copy the example environment file.

For macOS/Linux:

bash

```
cp .env.example .env
```

For Windows Command Prompt:

cmd

```
copy .env.example .env
```

Generate the application key:

bash

```
php artisan key:generate
```

### 4. Configure the Database

Open the `.env` file and configure your database credentials.

For example, using MySQL:

dotenv

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=stock_genie
DB_USERNAME=root
DB_PASSWORD=
```

Create the corresponding database in your database management system before running migrations.

Update the credentials according to your environment.

### 5. Enable Required PHP Extensions

Open your active `php.ini` file and ensure the following extensions are enabled:

ini

```
extension=zip
extension=gd
```

These extensions may be required for archive handling and PDF/image processing, depending on your installed dependencies.

Restart your PHP development environment if necessary.

### 6. Run Database Migrations

bash

```
php artisan migrate
```

This creates the database tables defined by the application's migrations.

### 7. Build Frontend Assets

For development:

bash

```
npm run dev
```

Keep this process running while developing if your setup requires the Vite development server.

Alternatively, build production assets with:

bash

```
npm run build
```

### 8. Start the Laravel Server

Open another terminal in the project directory and run:

bash

```
php artisan serve
```

### 9. Open the Application

Visit the following address in your browser:

**http://127.0.0.1:8000**

Log in using the credentials configured for your application. If no user has been created yet, follow the project's existing user setup process.

## 🖥️ Usage

After launching Stock Genie, you can use its available features to:

1. **Manage products** — organize products and categories.
2. **Monitor inventory** — review stock records and available quantities.
3. **Process sales** — add products to the shopping cart and complete transactions.
4. **Review data** — search and sort records using interactive tables.
5. **Generate reports** — download available PDF reports for business use.

The exact workflows depend on the features and configuration implemented in your installed version.

## 🧾 Tax Configuration

To customize the shopping cart tax settings, inspect the package configuration file:

text

```
vendor/hardevine/shoppingcart/config/cart.php
```

Review the tax-related configuration and adjust it according to your business requirements.

**Important:** Changes made directly inside `vendor/` may be overwritten when dependencies are reinstalled or updated. For a maintainable solution, consider publishing or overriding the package configuration if the installed package version supports it.

Ensure your tax configuration complies with the applicable tax rules in your region.

## 👨‍💻 Developer

**Abu Salah Musha Lemon**

- Email: lemonahmed512@gmail.com
- GitHub: [Abu-Salah-Musha-Lemon](<https://github.com/Abu-Salah-Musha-Lemon>)

---

<p align="center"> <strong>⭐ If you find Stock Genie useful, consider giving the repository a star!</strong> </p>

<p align="center"> Built with ❤️ using Laravel and PHP. </p>

