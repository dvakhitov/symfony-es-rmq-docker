FROM php:8.4-fpm

# -----------------------------
# Install system dependencies
# -----------------------------
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    librabbitmq-dev \
    libssl-dev \
    libpq-dev \
    netcat-traditional \
    libicu-dev \
    default-mysql-client \
    default-jdk \
    && rm -rf /var/lib/apt/lists/*

# -----------------------------
# Install PHP extensions
# -----------------------------
RUN docker-php-ext-install \
    pdo_pgsql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    intl \
    opcache \
    sockets \
    && pecl channel-update pecl.php.net \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && pecl install amqp \
    && docker-php-ext-enable amqp

# -----------------------------
# Install Composer globally
# -----------------------------
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN ln -s /usr/bin/composer /usr/local/bin/composer

# -----------------------------
# Configure PHP
# -----------------------------
RUN echo "memory_limit = 2G" > /usr/local/etc/php/conf.d/memory-limit.ini \
    && echo "max_execution_time = 600" >> /usr/local/etc/php/conf.d/memory-limit.ini \
    && echo "date.timezone = UTC" >> /usr/local/etc/php/conf.d/memory-limit.ini

# -----------------------------
# Working directory
# -----------------------------
WORKDIR /var/www

COPY docker/php/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf
COPY docker/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

RUN chmod 644 /usr/local/etc/php-fpm.d/www.conf

# -----------------------------
# Prepare directories
# -----------------------------
RUN mkdir -p /var/run \
    && chmod 777 /var/run \
    && mkdir -p /var/www/public

# -----------------------------
# Copy application code
# -----------------------------
COPY ./app /var/www
COPY docker/php/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf

# -----------------------------
# Set permissions
# -----------------------------
RUN chown -R www-data:www-data /var/www/

# -----------------------------
# Expose PHP-FPM port
# -----------------------------
EXPOSE 9000

# -----------------------------
# Entrypoint
# -----------------------------
USER root
CMD ["php-fpm"]
