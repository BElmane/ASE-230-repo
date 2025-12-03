#!/bin/bash


set -e

echo "Starting Docker deployment for Laravel Student Course Management API..."
echo ""

echo "Stopping any running containers..."
docker compose down 2>/dev/null || true

echo ""
echo "Building Docker images..."
docker compose build

echo ""
echo "Starting Docker containers..."
docker compose up -d

echo ""
echo "Waiting for MySQL to be ready..."
sleep 10

echo ""
echo "Running Laravel setup inside container..."
docker compose exec app composer install --no-interaction
docker compose exec app php artisan key:generate --force
docker compose exec app php artisan config:clear
docker compose exec app php artisan migrate --force

echo ""
echo "Docker deployment complete!"
echo ""
echo "Application is running at: http://localhost:8080"
echo "API endpoints available at: http://localhost:8080/api/students"
echo ""
echo "To stop containers: docker compose down"
echo "To view logs: docker compose logs -f"
echo ""
