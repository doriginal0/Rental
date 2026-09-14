<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Car;
use App\Models\Fleet;
use App\Models\Customer;
use App\Models\Maintenance;
use App\Models\Payment;
use App\Models\Client;
use App\Models\Driver;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
         $acme = Client::create([
            'name' => "Robert",
            'company_name' => 'Acme Rentals',
            'phone' => '555-0001',
            'email' => 'acme@example.com',
            'password' => Hash::make('password'),   // password: password
        ]);

        $budget = Client::create([
            'name' => "Maximillian",
            'company_name' => 'Budget Cars',
            'phone' => '555-0002',
            'email' => 'budget@example.com',
            'password' => Hash::make('password'),   // password: password
        ]);


        $admin = Client::create([
            'name' => "Aymen",
            'company_name' => 'Vibes',
            'phone' => '555-0001',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'), 
            'is_admin' => true,  // password: password
        ]);

        $cars = [
            // Client #1 (Acme) cars
            ['client_id' => $acme->id, 'make' => 'Toyota', 'model' => 'Corolla', 'year' => 2022, 'license_plate' => 'ABC-1234', 'color' => 'Silver', 'transmission' => 'automatic', 'seats' => 5, 'daily_rate' => 45.00, 'status' => 'available'],
            ['client_id' => $acme->id, 'make' => 'Honda', 'model' => 'Civic', 'year' => 2023, 'license_plate' => 'DEF-5678', 'color' => 'Blue', 'transmission' => 'automatic', 'seats' => 5, 'daily_rate' => 50.00, 'status' => 'available'],
            ['client_id' => $acme->id, 'make' => 'Ford', 'model' => 'Mustang', 'year' => 2022, 'license_plate' => 'GHI-9012', 'color' => 'Red', 'transmission' => 'manual', 'seats' => 4, 'daily_rate' => 85.00, 'status' => 'available'],
            ['client_id' => $budget->id, 'make' => 'BMW', 'model' => 'X5', 'year' => 2023, 'license_plate' => 'JKL-3456', 'color' => 'Black', 'transmission' => 'automatic', 'seats' => 5, 'daily_rate' => 120.00, 'status' => 'available'],

            // Client #2 (Budget) cars
            ['client_id' => $budget->id, 'make' => 'Tesla', 'model' => 'Model 3', 'year' => 2023, 'license_plate' => 'MNO-7890', 'color' => 'White', 'transmission' => 'automatic', 'seats' => 5, 'daily_rate' => 110.00, 'status' => 'available'],
            ['client_id' => $budget->id, 'make' => 'Mercedes', 'model' => 'C-Class', 'year' => 2022, 'license_plate' => 'PQR-1234', 'color' => 'Gray', 'transmission' => 'automatic', 'seats' => 5, 'daily_rate' => 95.00, 'status' => 'available'],
            ['client_id' => $budget->id, 'make' => 'Toyota', 'model' => 'RAV4', 'year' => 2023, 'license_plate' => 'STU-5678', 'color' => 'Green', 'transmission' => 'automatic', 'seats' => 5, 'daily_rate' => 65.00, 'status' => 'available'],
            ['client_id' => $budget->id, 'make' => 'Jeep', 'model' => 'Wrangler', 'year' => 2022, 'license_plate' => 'VWX-9012', 'color' => 'Yellow', 'transmission' => 'manual', 'seats' => 4, 'daily_rate' => 75.00, 'status' => 'maintenance'],
        ];

        foreach ($cars as $car) {
            Car::create($car);
        }

        $drivers = [
            // Client #1 (Acme) cars
            ['client_id' => $acme->id, 'name' => 'Rabeh', 'license_number' => '25635478', 'license_expiry' => 2027, 'description' => "nothing", 'status' => 'available'],
            ['client_id' => $acme->id, 'name' => 'Wassim', 'license_number' => '698852452', 'license_expiry' => 2030, 'description' => "something", 'status' => 'available'],            
            ['client_id' => $budget->id, 'name' => 'Khoutir', 'license_number' => '965248789', 'license_expiry' => 2031, 'description' => "something", 'status' => 'available'],            

            ];

        foreach ($drivers as $driver) {
            Driver::create($driver);
        }

        // Seed Customers
        $customers = [
            // Client #1 (Acme) customers
            ['client_id' => $acme->id, 'first_name' => 'John', 'last_name' => 'Smith', 'email' => 'john.smith@example.com', 'phone' => '555-0101', 'address' => '123 Main St', 'license_number' => 'DL-1001', 'license_expiry' => '2027-01-15'],
            ['client_id' => $acme->id, 'first_name' => 'Jane', 'last_name' => 'Doe', 'email' => 'jane.doe@example.com', 'phone' => '555-0102', 'address' => '456 Oak Ave', 'license_number' => 'DL-1002', 'license_expiry' => '2026-06-30'],
            ['client_id' => $acme->id, 'first_name' => 'Robert', 'last_name' => 'Johnson', 'email' => 'robert.j@example.com', 'phone' => '555-0103', 'address' => '789 Pine Rd', 'license_number' => 'DL-1003', 'license_expiry' => '2028-03-20'],

            // Client #2 (Budget) customers
            ['client_id' => $budget->id, 'first_name' => 'Maria', 'last_name' => 'Garcia', 'email' => 'maria.g@example.com', 'phone' => '555-0104', 'address' => '321 Elm St', 'license_number' => 'DL-1004', 'license_expiry' => '2026-11-05'],
            ['client_id' => $budget->id, 'first_name' => 'David', 'last_name' => 'Brown', 'email' => 'david.b@example.com', 'phone' => '555-0105', 'address' => '654 Maple Dr', 'license_number' => 'DL-1005', 'license_expiry' => '2027-09-12'],
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }

        // Seed Bookings
        $bookings = [
            ['client_id' => $acme->id, 'car_id' => 1, 'customer_id' => 1, 'daily_rate' => 145.00, 'total_cost' => 1250, 'method' => 'cash', 'pickup_datetime' => now()->subDays(5), 'return_datetime' => now()->addDays(2), 'total_cost' => 315.00, 'status' => 'active'],
            ['client_id' => $acme->id, 'car_id' => 2, 'customer_id' => 2, 'daily_rate' => 145.00, 'total_cost' => 1250, 'method' => 'cash', 'pickup_datetime' => now()->subDays(2), 'return_datetime' => now()->addDays(3), 'total_cost' => 425.00, 'status' => 'active'],
            ['client_id' => $acme->id, 'car_id' => 3, 'customer_id' => 3, 'daily_rate' => 145.00, 'total_cost' => 1250, 'method' => 'cash', 'pickup_datetime' => now()->addDays(1), 'return_datetime' => now()->addDays(6), 'total_cost' => 550.00, 'status' => 'confirmed'],
            ['client_id' => $budget->id, 'car_id' => 4, 'customer_id' => 4, 'daily_rate' => 145.00, 'total_cost' => 1250, 'method' => 'cash', 'pickup_datetime' => now()->subDays(10), 'return_datetime' => now()->subDays(5), 'total_cost' => 250.00, 'status' => 'completed'],
            ['client_id' => $budget->id, 'car_id' => 5, 'customer_id' => 5, 'daily_rate' => 145.00, 'total_cost' => 1250, 'method' => 'cash', 'pickup_datetime' => now()->subDays(15), 'return_datetime' => now()->subDays(8), 'total_cost' => 840.00, 'status' => 'completed'],
        ];

         foreach ($bookings as $booking) {
            Booking::create($booking);
        }

         $fleets = [
            ['client_id' => $acme->id, 'fleet_name' => 'touristic'],
            ['client_id' => $acme->id, 'fleet_name' => 'commercial'],
            ['client_id' => $budget->id, 'fleet_name' => 'touristic'],
            ['client_id' => $budget->id, 'fleet_name' => 'commercial'],
        ];

        foreach ($fleets as $fleet) {
            Fleet::create($fleet);
        }

        // Seed Payments
        $payments = [
            ['client_id' => $acme->id, 'booking_id' => 1, 'amount' => 315.00, 'method' => 'card', 'status' => 'completed', 'reference' => 'PAY-001', 'paid_at' => now()->subDays(5)],
            ['client_id' => $acme->id, 'booking_id' => 2, 'amount' => 425.00, 'method' => 'cash', 'status' => 'completed', 'reference' => 'PAY-002', 'paid_at' => now()->subDays(2)],
            ['client_id' => $acme->id, 'booking_id' => 3, 'amount' => 550.00, 'method' => 'online', 'status' => 'pending', 'reference' => 'PAY-003', 'paid_at' => null],
            ['client_id' => $budget->id, 'booking_id' => 4, 'amount' => 250.00, 'type' => 'income', 'method' => 'card', 'status' => 'completed', 'reference' => 'PAY-004', 'paid_at' => now()->subDays(10)],
            ['client_id' => $budget->id, 'booking_id' => 5, 'amount' => 840.00, 'type' => 'income', 'method' => 'bank_transfer', 'status' => 'completed', 'reference' => 'PAY-005', 'paid_at' => now()->subDays(15)],
        ];

        foreach ($payments as $payment) {
            Payment::create($payment);
        }

        // Seed Maintenance
        $maintenances = [
            ['client_id' => $budget->id, 'car_id' => 8, 'scheduled_date' => now()->addDays(2), 'type' => 'oil_change', 'description' => 'Regular oil change', 'cost' => 60.00, 'status' => 'scheduled'],
            ['client_id' => $acme->id, 'car_id' => 1, 'scheduled_date' => now()->subDays(30), 'completed_date' => now()->subDays(28), 'type' => 'tire_replacement', 'description' => 'Replaced all 4 tires', 'cost' => 400.00, 'status' => 'completed'],
            ['client_id' => $budget->id, 'car_id' => 6, 'scheduled_date' => now()->addDays(5), 'type' => 'brake_service', 'description' => 'Brake pad replacement', 'cost' => 150.00, 'status' => 'scheduled'],
        ];

        foreach ($maintenances as $maintenance) {
            Maintenance::create($maintenance);
        }
    }
}
