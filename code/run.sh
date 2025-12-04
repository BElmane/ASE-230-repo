#!/bin/bash

# run.sh - One-command Laravel deployment script
# Usage: bash run.sh

set -e 

echo "Starting Laravel Student Course Management API..."
echo ""

# Configuration
DB_NAME="student_course_system"
DB_USER="root"
DB_PASSWORD="Tacoshouse&2"

# Check if .env exists
if [ ! -f .env ]; then
    echo "Creating .env file from .env.example..."
    cp .env.example .env
    
    sed -i '' "s/DB_DATABASE=laravel/DB_DATABASE=$DB_NAME/" .env
    sed -i '' "s/DB_USERNAME=root/DB_USERNAME=$DB_USER/" .env
    sed -i '' "s/DB_PASSWORD=/DB_PASSWORD=$DB_PASSWORD/" .env
    
    echo "Generating application key..."
    php artisan key:generate --force
fi

echo "Installing Composer dependencies..."
composer install --no-interaction --prefer-dist --optimize-autoloader

echo ""
echo "Setting up environment..."
php artisan config:clear
php artisan cache:clear

echo ""
echo "Setting up database..."

echo ""
echo "Running migrations..."
php artisan migrate --force

echo ""
echo "Generating application key (if needed)..."
if grep -q "APP_KEY=$" .env; then
    php artisan key:generate --force
fi

echo ""
echo "Laravel API is ready!"
echo ""
echo "Starting development server..."
echo "Server will be available at: http://localhost:8000"
echo ""
echo "Press Ctrl+C to stop the server"
echo ""

# Start the server
php artisan serve
