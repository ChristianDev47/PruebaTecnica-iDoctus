# System Architecture

## Overview

The Exchange API is built following a **Clean Architecture** approach, ensuring a modular, maintainable, and scalable codebase. This structure separates concerns across well-defined layers, making the system **easy to extend and test** while promoting **code reusability and flexibility**.

## Architectural Principles

The project adheres to the following **software design principles**:

- **Separation of Concerns (SoC):** Each layer has a clear responsibility, preventing tight coupling and improving maintainability.
- **Single Responsibility Principle (SRP):** Each class/module has a single purpose, making the codebase easier to understand and modify.
- **Dependency Inversion Principle (DIP):** High-level modules do not depend on low-level modules but rather on abstractions, enabling flexibility and easy replacements.
- **Hexagonal Architecture (Ports & Adapters):** The core business logic is decoupled from external services (e.g., database, cache, external APIs).
- **Scalability & Performance Optimization:** Includes caching (Redis), background job processing, and rate limiting.

## Project Structure

The codebase is organized into distinct **modules and layers**, ensuring clean separation and flexibility:

```
prueba-tecnica/
├── app/
│   ├── Common/                 # Shared utilities (helpers, middleware, exceptions, security)
│   ├── Modules/
│   │   ├── Exchange/
│   │   │   ├── Domain/         # Core business logic (entities, value objects, domain services)
│   │   │   ├── Application/    # Use cases (DTOs, actions, services, jobs)
│   │   │   ├── Infrastructure/ # API adapters, repositories, cache layer
│   │   │   ├── Presentation/   # Controllers and route definitions
│   ├── Providers/              # Service providers for dependency injection
├── config/
├── database/
├── docs/
│   ├── api.md                   # API documentation
│   ├── architecture.md          # This document
│   ├── installation.md          # Installation guide
│   ├── security.md              # Security best practices
│   └── testing.md               # Testing strategy
├── routes/
├── tests/                       # Unit, integration, performance, feature and acceptance tests
├── .github/workflows/           # CI/CD pipeline configuration
├── docker-compose.yml           # Docker configuration
└── README.md                    # Project overview
```

## Key Components

### 1. **Domain Layer** (Core Business Logic)
- Implements **Domain-Driven Design (DDD)** principles.
- Defines **entities**, **value objects**, and **domain services**.
- Independent of framework-specific dependencies.

### 2. **Application Layer** (Use Cases & Services)
- Implements **application logic** such as fetching and processing exchange rates.
- Contains **DTOs (Data Transfer Objects)**, **actions**, and **services**.
- Orchestrates interactions between the domain and infrastructure layers.

### 3. **Infrastructure Layer** (Adapters & External Integrations)
- Interfaces with **external APIs** (exchange rate providers).
- Implements **repositories** to abstract database/cache access.
- Uses **Redis** for caching to improve performance.

### 4. **Presentation Layer** (HTTP Interface)
- Defines **RESTful API endpoints**.
- Uses **Laravel controllers** and **route definitions**.
- Handles authentication and request validation.

### 5. **Security & Middleware**
- Implements **Bearer token authentication** with **custom validation**.
- Includes **rate limiting** and **logging middleware**.

## Why This Architecture?

### ✅ **Scalability**
- The modular structure allows easy **feature expansion**.
- Redis caching and background jobs improve **performance under load**.

### ✅ **Maintainability**
- Clear separation of concerns makes it easy to **modify and debug**.
- Adheres to **SOLID principles** to prevent technical debt.

### ✅ **Testability**
- High unit and integration test coverage.
- Decoupled components allow easy **mocking and isolated testing**.

### ✅ **Extensibility**
- New exchange rate providers can be added via **adapters**.
- Supports future extensions like **multi-currency support** or **historical rates**.


