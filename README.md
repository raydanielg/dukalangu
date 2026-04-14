<p align="center">
    <img src="public/Salama%20logo.png" alt="Logo" width="200">
</p>

<p align="center">
    <strong>Tanzania's Trusted E-Commerce & Business Platform</strong>
</p>

<p align="center">
<a href="#"><img src="https://img.shields.io/badge/version-1.0.0-blue.svg" alt="Version"></a>
<a href="#"><img src="https://img.shields.io/badge/license-MIT-green.svg" alt="License"></a>
<a href="#"><img src="https://img.shields.io/badge/build-passing-brightgreen.svg" alt="Build Status"></a>
</p>

---

## About {{ config('app.name') }}

**{{ config('app.name') }}** is Tanzania's trusted e-commerce platform helping entrepreneurs create online stores, advertise products, and receive orders seamlessly. Built with Laravel, we provide a complete solution for Tanzanian businesses to sell online and grow their customer base.

### Key Features

- **Online Store Creation** - Create your custom store in minutes
- **Product Management** - Add, edit, and manage your products easily
- **Order Management** - Receive and process customer orders seamlessly
- **Secure Payments** - Accept payments via M-Pesa, Tigo Pesa, HaloPesa, Airtel Money
- **Business Dashboard** - Track sales, orders, and customer analytics
- **Matangazo/Advertising** - Promote your products to reach more customers
- **Customer Management** - Build and manage your customer relationships
- **Mobile Responsive** - Access {{ config('app.name') }} from any device
- **Email Notifications** - Get notified about orders, payments, and customer activities

### Coverage

{{ config('app.name') }} serves all regions of Tanzania:
- Dar es Salaam
- Arusha
- Mwanza
- Dodoma
- Mbeya
- And all other regions

## Technology Stack

- **Framework**: Laravel 11
- **Frontend**: Blade, Tailwind CSS, Bootstrap
- **Database**: SQLite/MySQL
- **Authentication**: Laravel Breeze
- **Icons**: Lucide Icons

## SEO Optimized

{{ config('app.name') }} is built with powerful SEO features:
- Meta tags for all pages
- Open Graph tags for social sharing
- Twitter Card integration
- Canonical URLs
- Structured data ready
- Keywords optimized for Tanzania fintech and job market

## Installation

```bash
# Clone the repository
git clone https://github.com/yourusername/dukalangu.git

# Navigate to project
cd dukalangu

# Install dependencies
composer install
npm install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Run migrations
php artisan migrate

# Start development server
php artisan serve
npm run dev
```

## Configuration

Update your `.env` file:

```env
APP_NAME=YourAppName
APP_URL=http://localhost:8000

# Database
DB_CONNECTION=sqlite
# or
DB_DATABASE=yourappname

# Mail (for notifications)
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525

# Payment APIs
MPESA_CONSUMER_KEY=your_key
MPESA_CONSUMER_SECRET=your_secret
TIGOPESA_API_KEY=your_key
```

## Contributing

We welcome contributions to make {{ config('app.name') }} better! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## Support

Need help? Contact us:

- **Email**: support@yourapp.co.tz
- **Website**: https://yourapp.co.tz
- **Phone**: +255 700 000 000

## License

{{ config('app.name') }} is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

<p align="center">
    <strong>Empowering Tanzanian Entrepreneurs to Sell Online</strong>
</p>

<p align="center">
    © 2026 {{ config('app.name') }}. All rights reserved.
</p>
