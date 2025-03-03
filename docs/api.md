# API Documentation – Exchange API

## Overview

The Exchange API provides real-time exchange rate data for USD to EUR. It is designed with **performance, security, and scalability** in mind, leveraging Redis caching and Laravel's best practices.

## Base URL

```
http://localhost:8000/api
```

## Authentication

All endpoints require authentication via **Bearer Token**. The token must comply with the **Parentheses Matching Problem**.

### Example Header
```http
Authorization: Bearer []{}
```

## Endpoints

### 1. Get Exchange Rate
**Endpoint:**
```
GET /exchange
```
**Description:**
Returns the latest USD to EUR exchange rate.

**Request Example (cURL):**
```bash
curl -X GET "http://localhost:8000/api/exchange" \
     -H "Authorization: Bearer []{}"
```

**Response Example:**
```json
{
  "price": 0.851357
}
```

### 2. API Documentation
**Endpoint:**
```
GET /api/documentation
```
**Description:**
Provides interactive API documentation using **L5-Swagger**.

**Access:**
Simply visit:
```
http://localhost:8000/api/documentation
```

## Error Handling

The API follows RESTful error handling conventions, returning meaningful HTTP status codes and JSON error messages.

**Example Error Response without Token:**
```json
{
  "error": "Unauthorized",
}
```

**Example Error Response Invalid Token:**
```json
{
  "error": "Invalid token format",
}
```

## Rate Limiting

- The API enforces rate limits to prevent abuse.
- The default rate limit is **60 requests per minute** per IP.
- If exceeded, the response will include **429 Too Many Requests**.

**Example Rate Limit Error Response:**
```json
{
  "error": "Too many requests",
}
```

## Additional Notes
- Ensure you provide a **valid Bearer Token** in the request headers.
- Utilize Redis caching to optimize response times.
