FROM php:7.3-fpm

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    locales \
    libzip-dev \
    libfreetype6-dev \
    libpng-dev \
    libjpeg-dev \
    git \
    unzip \
    zip \
    curl

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install php extensions for laravel
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl zip

RUN docker-php-ext-configure gd \
      --with-freetype-dir=/usr/include/ \
      --with-jpeg-dir=/usr/include/ \
      --with-png-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


# create user
RUN useradd -ms /bin/bash -u 1000 -U host

# or
# RUN adduser --home /home/host --shell /bin/bash --uid 1000 --system --group host

# DETAILS
# - create system user (no password)
# - create home directory
# - create shell (/bin/bash)
# - user name is 'host', and group name same too ('host') 
# - uid 1000 and gid 1000
# - for 'adduser' need to gave parameter --home (for giving detail directory home)

# Change current user to www
USER host

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]