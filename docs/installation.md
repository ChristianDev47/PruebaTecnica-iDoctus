# Installation and Configuration

Follow these steps to set up the project for the technical test:

## Requirements
Ensure you have the following installed on your system:
- **PHP** 8.x or higher
- **Composer** (Dependency Manager for PHP)
- **Laravel** 11.x or higher
- **Redis** (for caching, can be run via Docker)
- **Docker & Docker Compose** (optional but recommended for easier setup)

## Setup Instructions

1. **Clone the Repository**
   ```bash
   git clone https://github.com/ChristianDev47/PruebaTecnica-iDoctus.git
   cd PruebaTecnica-iDoctus
   ```

2. **Install Dependencies**
   ```bash
   composer install
   ```

3. **Configure Environment Variables**
   ```bash
   cp .env.example .env
   php artisan key:generate  
   ```

4. **Run Migrations**
   ```bash
   php artisan migrate
   yes
   ```

5. **Initialize Redis** (using Docker or locally)
   ```bash
   docker-compose up -d
   ```
   If running Redis locally, ensure the service is started and accessible.


6. **Start the Application**
   ```bash
   php artisan serve    
   ```

The project should now be running. Access to the API using `http://localhost:8000/api/exchange`. 

## Additional Notes
- Swagger API documentation will be available at `/api/documentation`
- Run tests using:
  ```bash
  php artisan test
  ```

