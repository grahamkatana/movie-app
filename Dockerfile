# Use PHP 7.4 FPM base image
FROM php:7.4-fpm

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install specific version of Node.js (16.20.2)
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g n \
    && n 16.20.2

# Verify Node.js and npm versions
RUN node -v && npm -v

# Install Laravel dependencies
COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-autoloader

# Copy existing application directory contents
COPY . .

# Generate optimized autoload files
RUN composer dump-autoload --optimize

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

# Expose port 9000 for PHP-FPM
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]