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
    unzip \
    sudo \
    nano \
    htop

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

# Copy existing application directory contents
COPY . .

# Install Laravel dependencies
RUN composer install --no-scripts --no-autoloader

# Generate optimized autoload files
RUN composer dump-autoload --optimize

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 777 /var/www/html/storage

# Create a non-root user and give sudo access (for debugging purposes)
RUN useradd -m docker && echo "docker:docker" | chpasswd && adduser docker sudo

# Configure PHP-FPM to run as www-data
RUN sed -i 's/user = www-data/user = www-data/g' /usr/local/etc/php-fpm.d/www.conf \
    && sed -i 's/group = www-data/group = www-data/g' /usr/local/etc/php-fpm.d/www.conf

# Expose port 9000 for PHP-FPM
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]