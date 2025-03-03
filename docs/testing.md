# Testing and Quality Assurance

This project includes a comprehensive testing suite to ensure code quality, reliability, and performance. Below are the testing strategies and instructions on how to run tests.

## Testing Strategies

### 1. **Unit Tests**
   - Validate individual components, utility functions, and domain objects in isolation.
   - Ensure that each piece of business logic (e.g., bracket validation, rate limiting, DTO conversion, and value object constraints) works correctly.
   - Located in `tests/Unit/`.

### 2. **Integration Tests**
   - Verify that different modules and external services (such as Redis, external APIs, and the queue system) interact correctly.
   - Confirm that data flows seamlessly between components like caching mechanisms, API adapters, and service providers.
   - Located in `tests/Integration/`.

### 3. **Feature Tests**
   - Simulate real user interactions with the API endpoints, including HTTP request flows and middleware processing.
   - Ensure that controllers, actions, middleware, and background jobs behave as expected under realistic conditions.
   - Located in `tests/Feature/`.

### 4. **Performance Testing**
   - Measure system responsiveness and analyze API response times under simulated load conditions.
   - Validate that the application can efficiently handle both moderate concurrency and high-stress scenarios.
   - Located in `tests/Performance/`.
   
### 5. **Acceptation Testing**
   - Confirm that the complete API workflow meets the required functionality and user expectations.
   - Ensure that the API is robust and secure, even when handling unexpected or malformed inputs.
   - Located in `tests/Acceptation/`.

## Running the Tests

Ensure the application is set up and Redis is running before executing tests.

1. **Run all tests**
   ```bash
   php artisan test
   ```

2. **Run unit tests only**
   ```bash
   php artisan test --testsuite=Unit
   ```

3. **Run feature tests only**
   ```bash
   php artisan test --testsuite=Feature
   ```

## CI/CD Integration
- The pipeline ensures code quality, runs tests, performs database migrations, and verifies the API endpoint response.
- Configurations can be found in `.github/workflows/pipeline.yml`.

## Additional Notes
- To debug test failures, use:
  ```bash
  php artisan test --debug
  ```
- Test coverage can be measured using `phpunit` with:
  ```bash
  ./vendor/bin/phpunit --coverage-html=coverage-report
  ```


