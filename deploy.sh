#!/bin/bash

cd /var/www/novedades || exit

echo "🔁 Git pull..."
git pull origin main

echo "📦 Composer install..."
composer install --no-dev --optimize-autoloader

echo "⚙️ Migraciones..."
php artisan migrate --force

echo "🧹 Cache config..."
php artisan config:clear
php artisan config:cache

echo "✅ Deploy finalizado"
