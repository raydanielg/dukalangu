<p align="center">
    <img src="public/Salama%20logo.png" alt="Salamapay Logo" width="200">
</p>

<p align="center">
    <strong>Tanzania's Trusted Payment & Job Platform</strong>
</p>

<p align="center">
<a href="#"><img src="https://img.shields.io/badge/version-1.0.0-blue.svg" alt="Version"></a>
<a href="#"><img src="https://img.shields.io/badge/license-MIT-green.svg" alt="License"></a>
<a href="#"><img src="https://img.shields.io/badge/build-passing-brightgreen.svg" alt="Build Status"></a>
</p>

---

## About Salamapay

**Salamapay** is Tanzania's trusted platform combining secure mobile payment solutions with job opportunities. Built with Laravel, we provide a seamless experience for Tanzanians to manage their finances and career growth in one place.

### Key Features

- **Secure Mobile Payments** - Process payments via M-Pesa, Tigo Pesa, HaloPesa, Airtel Money
- **Job Search & Discovery** - Find opportunities by location, industry, and job type
- **Employer Dashboard** - Post vacancies and manage applications
- **Job Seeker Profiles** - Create professional profiles and upload CVs
- **Payment History** - Track all your transactions in real-time
- **Application Tracking** - Track your job applications in real-time
- **Email Notifications** - Get notified about payments, jobs, and application updates
- **Mobile Responsive** - Access Salamapay from any device

### Coverage

Salamapay serves all regions of Tanzania:
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

Salamapay is built with powerful SEO features:
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
APP_NAME=Salamapay
APP_URL=http://localhost:8000

# Database
DB_CONNECTION=sqlite
# or
DB_DATABASE=salamapay

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

We welcome contributions to make Dukalangu better! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## Support

Need help? Contact us:

- **Email**: support@salamapay.co.tz
- **Website**: https://salamapay.co.tz
- **Phone**: +255 700 000 000

## License

Dukalangu is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

<p align="center">
    <strong>Secure Payments & Career Growth for Every Tanzanian</strong>
</p>

<p align="center">
    © 2026 Salamapay. All rights reserved.
</p>
