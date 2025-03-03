# Technical Test – iDoctus

This repository contains the solution for the iDoctus technical test, developed using PHP 8.3 and Laravel. The project has been designed as the foundation for a scalable and high-performance system, following industry best practices, architectural patterns, and modern development methodologies.

---

## Summary

The application exposes a single endpoint that returns the real-time exchange rate of the US dollar (USD) to the euro (EUR). The data is obtained by consuming a public external API, and a caching system (Redis) is used to minimize dependency on the data source for each request.

Additionally, the system incorporates:
- **Authentication with Bearer Token**: The endpoint requires a token in the header (`Authorization: Bearer <token>`). The token is validated through an algorithm that checks the correct opening and closing of parentheses, braces, and brackets.
- **Clean and Scalable Architecture**: Based on Clean Architecture/Hexagonal principles, separating responsibilities into modules (Domain, Application, Infrastructure, and Presentation).
- **Automated Testing**: Extensive coverage of unit, integration, acceptance, and performance tests.
- **Monitoring, Logging, and CI/CD**: Tools for performance tracking, centralized error handling, and an automated pipeline for continuous integration and deployment.

---

## Key Features

- **Single Endpoint**:  
  - **GET `/api/exchange`**: Returns a JSON response with the current USD to EUR exchange rate.  
    ```json
    {
      "price": 0.851357
    }
    ```

- **Authentication and Validation**:  
  - Uses a Bearer Token with validation based on the "parentheses problem" (e.g., `Authorization: Bearer []{}` is valid).

- **Integration with External API and Caching**:  
  - Fetches the real-time exchange rate through an adapter.  
  - Implements Redis caching to optimize response time and ensure fault tolerance of the external API.

- **Modular and Scalable Architecture**:  
  - Separation into modules and layers following best practices (SOLID, Clean Code, and design patterns).
  - Organized structure to facilitate the addition of new functionalities and future improvements.

- **Testing and Code Quality**:  
  - Extensive test coverage (unit, integration, acceptance, and performance tests).
  - Git for version control and automated CI/CD through GitHub Workflows.

---

## Installation and Configuration

### System Requirements

- **PHP**: 8.x or higher  
- **Composer**: Dependency management  
- **Laravel**: 11.x or higher  
- **Redis**: For caching  

### Installation Steps

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

5. **Initialize Redis (using Docker or locally)**
   ```bash
   docker-compose up -d
   ```

6. **Run the Application**
   ```bash
   php artisan serve    
   ```

## API Usage

### Endpoint: `GET /api/exchange`

**Description:**  
Returns the current exchange rate of USD to EUR in JSON format.

**Authentication:**  
Requires the `Authorization` header with a Bearer Token that passes the parentheses validation.

**Example:**  
```http
Authorization: Bearer []{}
```

**Successful Response:**  
```json
{
  "price": 0.851357
}
```

### Example Request using cURL:

```bash
curl -X GET "http://localhost:8000/api/exchange" \
     -H "Authorization: Bearer []{}"
```

## Testing

The project includes an extensive test suite covering:

- **Unit Tests**: Focuses on internal logic and isolated components.
- **Integration Tests**: Verifies the correct interaction between modules and external services (such as Redis or APIs).
- **Performance Tests**: Evaluates the system's capacity under load and stress conditions.
- **Feature Tests**: Simulates real usage scenarios, testing endpoints, middleware, actions, and jobs.
- **Acceptance Tests**: Covers the final validation of the API, ensuring that it meets requirements as a whole, including security aspects.

### Run all tests:

```bash
php artisan test
```

## CI/CD

The repository is configured with a CI/CD pipeline in `.github/workflows/pipeline.yml`, which:

- The pipeline ensures code quality, runs tests, performs database migrations, and verifies the API endpoint response.

## Additional Documentation

Refer to the `docs/` directory for detailed documentation on the following aspects:

- [API Documentation](https://github.com/ChristianDev47/PruebaTecnica-iDoctus/blob/main/docs/api.md)
- [System Architecture](https://github.com/ChristianDev47/PruebaTecnica-iDoctus/blob/main/docs/architecture.md)
- [Installation and Configuration](https://github.com/ChristianDev47/PruebaTecnica-iDoctus/blob/main/docs/installation.md)
- [Testing and Quality Assurance](https://github.com/ChristianDev47/PruebaTecnica-iDoctus/blob/main/docs/testing.md)
- [Security](https://github.com/ChristianDev47/PruebaTecnica-iDoctus/blob/main/docs/security.md)