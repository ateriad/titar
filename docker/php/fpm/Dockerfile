FROM ghcr.io/getimages/php:7.4-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    curl \
    libicu-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    git \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN pecl install redis
RUN docker-php-ext-enable redis
RUN docker-php-ext-configure intl
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd intl soap

# Get latest Composer
COPY --from=ghcr.io/getimages/composer:1.10.26 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app
