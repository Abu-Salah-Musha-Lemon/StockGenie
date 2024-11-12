# Stock Genie

## Developed by
**Abu Salah Musha Lemon**

## Project Description

**Stock Genie** is a comprehensive inventory management and point-of-sale (POS) system tailored for small businesses. Developed using Laravel 11 and PHP 8.2.12, this single-user system streamlines inventory tracking and sales transactions with a user-friendly interface.

### Key Features

1. **Inventory Management:**
   - Efficiently manage stock levels, product details, and categories.
   - Track inventory changes and maintain accurate stock records.

2. **Point of Sale (POS):**
   - Seamless sales transactions with an intuitive checkout process.
   - Real-time updates to inventory as sales are processed.

3. **User Authentication:**
   - Secure login and user authentication provided by `laravel/breeze`.
   - Personalized user experience with role-based access control (if applicable).

4. **PDF Reports:**
   - Generate and download PDF reports for sales, inventory, and other business metrics using `barryvdh/laravel-dompdf`.

5. **Shopping Cart:**
   - Manage and review shopping carts with the `hardevine/shoppingcart` package, providing a smooth user experience for handling sales.

6. **Interactive DataTables:**
   - Utilize jQuery DataTables for dynamic, sortable, and searchable tables, enhancing data management efficiency.

7. **Responsive Design:**
   - Built with Bootstrap and Bootstrap Icons, ensuring a responsive and visually appealing interface across devices.

8. **Notifications:**
   - Implement Toastr for displaying real-time notifications and alerts, keeping users informed of system events and updates.

## Technologies Used

### Backend
- **Framework:** Laravel 11
- **Programming Language:** PHP 8.2.12
- **Packages:**
  - `laravel/breeze`: Provides authentication scaffolding for easy user management.
  - `barryvdh/laravel-dompdf`: Enables PDF generation for reports and invoices.
  - `hardevine/shoppingcart`: Adds shopping cart functionality for handling sales and transactions.

### Frontend
- **JavaScript:** Enhances interactivity and user experience.
- **Bootstrap:** Ensures responsive and visually appealing design.
- **Bootstrap Icons:** Provides a variety of icons for a cleaner UI.
- **Toastr:** Displays notifications to keep users informed of important actions and updates.
- **jQuery DataTables:** Facilitates interactive and user-friendly tables for managing and viewing data.

## Installation

To get started with Stock Genie, follow these steps:

1. **Clone the Repository:**
   ```bash
   git clone https://github.com/Abu-Salah-Musha-Lemon/Stock-Genie.git
   cd stock-genie
   ```

2. **Install Backend Dependencies:**
   ```bash
   composer install
   ```

3. **Install Frontend Dependencies:**
   ```bash
   npm install
   ```

4. **Configure Environment:**
   - Copy the `.env.example` file to `.env` and update the environment variables as needed.
   - Generate an application key:
     ```bash
     php artisan key:generate
     ```
   - Cache configuration:
     ```bash
     php artisan config:cache
     ```

5. **Additional Configuration:**
   Configuration `php.ini`

    - Ensure the following extension is enabled in your `php.ini` file:(it is use for download and unzip file)

    ```ini
    extension=zip
    ```
   - Ensure the following extension is enabled in your `php.ini` file:(it is use for pdf)

    ```ini
    extension=gd
    ```

6. **Run Migrations:**
   ```bash
   php artisan migrate
   ```

7. **Build Frontend Assets:**
   ```bash
   npm run dev
   ```

8. **Start the Development Server:**
   ```bash
   php artisan serve
   ```

## Usage

Stock Genie is designed for small business owners who require a straightforward and effective tool to manage their inventory and sales operations. With its single-user system architecture, it provides a focused solution without the complexities of multi-user management. Access Stock Genie by navigating to `http://localhost:8000` in your web browser. Log in using the credentials set up during the installation process.

## Contributing

We welcome contributions to enhance Stock Genie. Please follow the standard fork-and-pull request workflow:

1. Fork the repository.
2. Create a feature branch (`git checkout -b feature-branch`).
3. Commit your changes (`git commit -am 'Add new feature'`).
4. Push to the branch (`git push origin feature-branch`).
5. Create a new Pull Request.

## License

Stock Genie is open-source software licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.

## Contact

For any inquiries or support, please reach out to [lemonahmed512@gmail.com](mailto:lemonahmed512@gmail.com).

---

Thank you for using Stock Genie! We hope it helps you efficiently manage your inventory and sales operations.

## Additional Configuration

### Changing Tax Amount

To update the tax amount, modify the configuration file located at:

```
stockGenie/vendor/hardevine/shoppingcart/config/cart.php
```

Make the necessary adjustments to the tax amount in this file to suit your business requirements.
