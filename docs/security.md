# Security in the Exchange API

## Overview
The security of the Exchange API is designed to ensure the integrity, confidentiality, and availability of the service. The system implements multiple layers of protection, including authentication, rate limiting, middleware security, and exception handling.

## Authentication
The API requires authentication using a **Bearer Token**. The token must pass a validation mechanism that ensures correct pairing of brackets (`()`, `{}`, `[]`). Any token that fails this validation is rejected.

### Token Validation Rules
- The token must contain only `{}`, `[]`, `()`.
- Brackets must be correctly nested and closed in the correct order.
- Empty tokens are considered invalid.

### Example Valid Tokens
- `[]{}()` ✅ Valid
- `{[()]}` ✅ Valid

### Example Invalid Tokens
- `{(})` ❌ Invalid
- `[{]}` ❌ Invalid

The token validation is handled by the `ValidateBearerToken.php` middleware in `app/Common/Middleware`, which utilizes the `BracketValidator` helper to verify the token format.

## Rate Limiting
To prevent abuse and ensure fair usage, the API enforces a rate-limiting mechanism using Laravel's built-in **RateLimiter**.

- Implemented in `app/Common/Security/RateLimiter.php`.
- Protects endpoints from excessive requests.
- Configured with limits per minute and per IP.
- Returns **429 Too Many Requests** when the limit is exceeded.
- Generates a unique request signature based on the client's IP and request path.

Additionally, the rate limiter is applied through middleware:
- Implemented in `app/Modules/Exchange/Presentation/Http/Middleware/ThrottleRequests.php`.
- Blocks requests if the user exceeds their allowed limit.

## Middleware Security
The API includes various middleware components to enhance security and request handling:

- **`RequestLogger.php`**: Logs incoming requests for monitoring and debugging. Captures details such as request URL, method, IP address, and payload.
- **`SecurityMiddleware.php`**: Adds security headers to protect against common vulnerabilities:
  - `X-Content-Type-Options: nosniff`
  - `X-Frame-Options: DENY`
  - `X-XSS-Protection: 1; mode=block`
- **`ValidateBearerToken.php`**: Ensures only properly formatted Bearer Tokens are accepted, validating token structure before allowing access.

## Exception Handling
A centralized exception handling mechanism to capture and manage errors securely:

- Converts unexpected errors into meaningful responses.
- Ensures sensitive error details are not exposed.
- Provides standardized API error messages.

## Caching for Security & Performance
The API leverages **Redis** for caching authenticated requests and responses, reducing exposure to brute-force attacks and improving performance. Cached requests are stored temporarily to minimize repeated API calls.

## Monitoring & Logging
Security logs and monitoring mechanisms are implemented to track API activity.

