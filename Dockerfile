FROM php:8.1-cli
COPY . /app
WORKDIR /app
EXPOSE 8000
CMD ["php", "-S", "0.0.0.0:8000"]
