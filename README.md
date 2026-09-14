# 🚗 Car Rental Management System

A comprehensive car rental management software built with **Laravel 12**.

## Features

### 📊 Dashboard
- Real-time statistics (total cars, available cars, customers, active bookings, revenue)
- Revenue visualization for the last 6 months
- Recent bookings feed
- Fleet status distribution

### 🚙 Car Management
- Add, edit, view, and delete cars
- Track make, model, year, license plate, transmission, seats, daily rate
- Status tracking: available, rented, maintenance, retired
- Booking and maintenance history per car

### 👤 Customer Management
- Full CRUD for customers
- Contact information and driver's license tracking
- Booking history per customer

### 📅 Booking Management
- Create bookings with automatic cost calculation (based on daily rate × duration)
- Status workflow: pending → confirmed → active → completed/cancelled
- Automatic car status updates (available → rented → available)
- Payment tracking per booking

### 💳 Payment Management
- Record payments with multiple methods (cash, card, bank transfer, online)
- Payment status tracking (pending, completed, refunded, failed)
- Automatic timestamp when marked as completed

### 🔧 Maintenance Management
- Schedule maintenance for cars
- Track maintenance types (oil change, tire replacement, brake service, etc.)
- Automatic car status updates (maintenance → available when completed)

## Tech Stack

| Layer | Technology |
|-------|-----------|
| **Backend** | Laravel 12 (PHP 8.2) |
| **Frontend** | Blade templates + Tailwind CSS |
| **Database** | SQLite (dev) / MySQL / PostgreSQL (prod) |
| **Auth** | Laravel Breeze (optional) |

## Installation

```bash
# Clone the repository
git clone <your-repo-url> car-rental
cd car-rental

# Install dependencies
composer install

# Set up environment
cp .env.example .env
php artisan key:generate

# Configure database in .env, then run migrations
php artisan migrate

# Seed sample data (optional)
php artisan db:seed

# Start the development server
php artisan serve
```

Visit `http://localhost:8000` in your browser.

## Database Schema

```
users
├── id, name, email, password

cars
├── id, make, model, year, license_plate, color
├── transmission, seats, daily_rate, status, image_url, description

customers
├── id, first_name, last_name, email, phone
├── address, license_number, license_expiry

bookings
├── id, car_id (FK), customer_id (FK)
├── pickup_datetime, return_datetime, total_cost, status, notes

payments
├── id, booking_id (FK), amount, method, status, reference, paid_at

maintenances
├── id, car_id (FK), scheduled_date, completed_date
├── type, description, cost, status
```

## Project Structure

```
app/
├── Http/
│   └── Controllers/
│       ├── DashboardController.php
│       ├── CarController.php
│       ├── CustomerController.php
│       ├── BookingController.php
│       ├── PaymentController.php
│       └── MaintenanceController.php
├── Models/
│   ├── Car.php
│   ├── Customer.php
│   ├── Booking.php
│   ├── Payment.php
│   └── Maintenance.php

database/
├── migrations/          # Schema definitions
└── seeders/             # Sample data

resources/views/
├── layouts/app.blade.php    # Main layout with sidebar
├── dashboard.blade.php      # Dashboard view
├── cars/                    # Car CRUD views
├── customers/               # Customer CRUD views
├── bookings/                # Booking CRUD views
├── payments/                # Payment CRUD views
└── maintenances/            # Maintenance CRUD views

routes/web.php              # All routes
```

## API Routes

| Method | URI | Action |
|--------|-----|--------|
| GET | `/` | Dashboard |
| GET/POST | `/cars` | List / Create cars |
| GET/PUT/DELETE | `/cars/{car}` | View / Update / Delete car |
| GET/POST | `/customers` | List / Create customers |
| GET/PUT/DELETE | `/customers/{customer}` | View / Update / Delete customer |
| GET/POST | `/bookings` | List / Create bookings |
| GET/PUT/DELETE | `/bookings/{booking}` | View / Update / Delete booking |
| GET/POST | `/payments` | List / Create payments |
| GET/PUT/DELETE | `/payments/{payment}` | View / Update / Delete payment |
| GET/POST | `/maintenances` | List / Create maintenance records |
| GET/PUT/DELETE | `/maintenances/{maintenance}` | View / Update / Delete maintenance |

## Business Logic Highlights

### Automatic Cost Calculation
When creating a booking, the total cost is automatically calculated:
```php
$days = max(1, (int) ceil($pickup->diffInHours($return) / 24));
$totalCost = $days * $car->daily_rate;
```

### Automatic Status Updates
- Creating a booking → car status becomes `rented`
- Completing/cancelling a booking → car status becomes `available`
- Scheduling maintenance → car status becomes `maintenance`
- Completing maintenance → car status becomes `available`

## Production Considerations

For production deployment:
1. **Use MySQL/PostgreSQL** instead of SQLite
2. **Install Tailwind CSS properly** (via npm) instead of CDN
3. **Add authentication** with Laravel Breeze/Jetstream
4. **Add authorization** (admin vs. staff roles)
5. **Set up email notifications** for booking confirmations
6. **Add file upload** for car images
7. **Implement search/filter** functionality
8. **Add API endpoints** for mobile apps
9. **Set up queue workers** for background jobs
10. **Configure caching** for frequently accessed data

## License

MIT
