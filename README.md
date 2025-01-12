# ExpenseTracker

![Laravel](https://img.shields.io/badge/Laravel-10.x-red.svg)
![License](https://img.shields.io/badge/license-MIT-blue.svg)

A modern expense tracking application built with Laravel that helps you manage your personal finances effectively.

## 🚀 Features

- Track income and expenses
- Categorize transactions
- Generate financial reports
- User authentication and authorization
- Responsive design

## 📋 Prerequisites

- PHP >= 8.1
- Composer
- MySQL or PostgreSQL
- Node.js & NPM

## ⚙️ Installation

1. Clone the repository
    ```bash
    git clone https://github.com/frost23z/ExpenseTracker.git
    cd ExpenseTracker
    ```

2. Install dependencies
    ```bash
    composer install
    npm install
    ```

3. Environment Setup
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. Configure your database in `.env` file

5. Run 'db:seed' to seed the database
    ```bash
    php artisan db:seed
    ```

6. Run migrations
    ```bash
    php artisan migrate
    ```

7. Build assets
    ```bash
    npm run build
    ```

8. Start the development server
    ```bash
    composer run dev
    ```

## 🔧 Configuration

The application can be configured through the `.env` file. Key settings include:

- `APP_NAME`: Application name
- `APP_ENV`: Application environment (local/production)
- `DB_*`: Database configuration
- `MAIL_*`: Email configuration

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
