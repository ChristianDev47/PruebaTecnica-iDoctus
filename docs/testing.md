# Testing and Quality Assurance

This project includes a comprehensive testing suite to ensure code quality, reliability, and performance. Below are the testing strategies and instructions on how to run tests.

## Testing Strategies

### 1. **Unit Tests**
   - Validate individual components and business logic.
   - Ensures that the bracket validation algorithm works correctly.
   - Located in `tests/Unit/`.

### 2. **Integration Tests**
   - Verify interactions between different modules, including API requests and caching mechanisms.
   - Test that the exchange rate service correctly fetches data from the external API and caches results in Redis.
   - Located in `tests/Integration/`.

### 3. **Feature Tests**
   - Simulate real user interactions with the API endpoints.
   - Ensure that authorization and request validation work correctly.
   - Located in `tests/Feature/`.

### 4. **Performance Testing**
   - Ensure the system can handle concurrent requests efficiently.
   - Analyze API response times and database query performance.
   - Located in `tests/Performance/`.
   
### 5. **Acceptation Testing**
   - Validation of the complete API workflow.
   - Ensure that the API behaves as expected under real-world conditions.
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


