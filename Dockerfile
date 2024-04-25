# Use the official PHP image
FROM php:latest

# Install mysqli extension
RUN docker-php-ext-install mysqli

# Set working directory
WORKDIR /var/www/html

# Copy the PHP files into the container
COPY . .

# Expose port 80
EXPOSE 80

# Command to run the PHP application
CMD ["php", "-S", "0.0.0.0:80"]