# 🛒 E-commerce API - Laravel 12

<p align="center">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</p>

<p align="center">
    <img src="https://img.shields.io/badge/Laravel-12.0-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel Version">
    <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP Version">
    <img src="https://img.shields.io/badge/PostgreSQL-15-336791?style=for-the-badge&logo=postgresql&logoColor=white" alt="PostgreSQL">
    <img src="https://img.shields.io/badge/Docker-Ready-2496ED?style=for-the-badge&logo=docker&logoColor=white" alt="Docker">
    <img src="https://img.shields.io/badge/Tailwind-4.0-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white" alt="Tailwind CSS">
</p>

## 📋 Descripción

API Backend para una aplicación de comercio electrónico construida con **Laravel 12** y **PHP 8.2+**. El proyecto implementa una arquitectura modular con **Repository Pattern** y **Service Layer**, facilitando la escalabilidad y mantenibilidad del código. Está configurado con Docker para facilitar el desarrollo y despliegue, utilizando **PostgreSQL** como base de datos principal.

## 🚀 Tecnologías

### Backend
- **Framework:** Laravel 12
- **PHP:** 8.2+
- **Base de Datos:** PostgreSQL 15
- **Servidor:** PHP-FPM 8.4.3 Alpine + Nginx
- **Arquitectura:** Repository Pattern + Service Layer

### Frontend Assets
- **Bundler:** Vite 7.0.7
- **CSS Framework:** Tailwind CSS 4.0 con @tailwindcss/vite
- **HTTP Client:** Axios 1.11.0

### Herramientas de Desarrollo
- **Testing:** PHPUnit 11.5.3
- **Code Style:** Laravel Pint 1.24
- **Mocking:** Mockery 1.6
- **Fake Data:** FakerPHP 1.23
- **Logs en tiempo real:** Laravel Pail 1.2.2
- **Concurrencia:** Concurrently 9.0.1
- **Contenedores:** Docker & Docker Compose
- **Debugging:** Laravel Tinker 2.10.1

## 📁 Estructura del Proyecto

```
ceti-ecommerce-laravel/
├── app/
│   ├── Exceptions/
│   │   └── GlobalException.php      # Manejo global de excepciones
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Api/
│   │   │   │   ├── Category/
│   │   │   │   │   └── CategoryController.php
│   │   │   │   └── Product/
│   │   │   └── Controller.php
│   │   └── Requests/                # Form Requests
│   ├── Models/                      # Modelos Eloquent
│   │   ├── Employee.php
│   │   ├── Products.php
│   │   ├── Sale.php
│   │   ├── SaleDetail.php
│   │   └── User.php
│   ├── Providers/                   # Service Providers
│   │   ├── AppServiceProvider.php
│   │   ├── ModelServiceProvider.php
│   │   └── RepositoryServiceProvider.php
│   ├── Resources/                   # API Resources
│   │   └── Category/
│   └── Traits/
│       └── ApiResponse/             # Trait para respuestas API
├── Modules/                         # Módulos de la aplicación
│   ├── Category/
│   │   ├── Category.php
│   │   ├── Repositories/
│   │   │   ├── CategoryRepository.php
│   │   │   └── Interfaces/
│   │   │       └── CategoryRepositoryInterface.php
│   │   └── Services/
│   │       ├── CategoryService.php
│   │       └── Interfaces/
│   │           └── CategoryServiceInterface.php
│   └── Config/
│       ├── Controller/              # Controladores base
│       ├── Repository/              # Repositorios base
│       └── Request/                 # Request base
├── bootstrap/                       # Archivos de arranque
│   ├── app.php
│   ├── providers.php
│   └── cache/
├── config/                          # Configuraciones
│   ├── app.php
│   ├── auth.php
│   ├── database.php
│   └── ...
├── database/
│   ├── factories/                   # Factories para testing
│   │   └── UserFactory.php
│   ├── migrations/                  # Migraciones de base de datos
│   │   ├── 0001_01_00_000000_create_table_to_employees.php
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 0001_01_01_000001_create_cache_table.php
│   │   ├── 0001_01_01_000002_create_jobs_table.php
│   │   ├── 2025_12_16_031559_create_categories_table.php
│   │   ├── 2025_12_16_031657_create_products_table.php
│   │   ├── 2025_12_16_031700_create_sales_table.php
│   │   └── 2025_12_16_031800_create_sale_details_table.php
│   └── seeders/                     # Seeders de datos
│       └── DatabaseSeeder.php
├── docker/
│   ├── php/                         # Configuración PHP-FPM + Nginx
│   │   ├── Dockerfile
│   │   └── app/
│   └── postgres/                    # Configuración PostgreSQL
│       └── Dockerfile
├── public/                          # Archivos públicos
│   ├── index.php
│   ├── favicon.ico
│   └── robots.txt
├── resources/
│   ├── css/                         # Estilos CSS
│   │   └── app.css
│   ├── js/                          # JavaScript
│   │   ├── app.js
│   │   └── bootstrap.js
│   └── views/                       # Vistas Blade
│       └── welcome.blade.php
├── routes/
│   ├── api.php                      # Rutas API
│   ├── web.php                      # Rutas web
│   └── console.php                  # Comandos de consola
├── storage/                         # Archivos generados
│   ├── app/
│   ├── framework/
│   └── logs/
├── tests/
│   ├── Feature/                     # Tests de integración
│   │   └── ExampleTest.php
│   └── Unit/                        # Tests unitarios
├── docker-compose.yml               # Configuración Docker Compose
├── composer.json                    # Dependencias PHP
├── package.json                     # Dependencias Node.js
├── phpunit.xml                      # Configuración PHPUnit
└── vite.config.js                   # Configuración Vite
```

## 🐳 Docker

El proyecto incluye una configuración completa de Docker con los siguientes servicios:

### Servicios

| Servicio | Contenedor | Puerto | Descripción |
|----------|------------|--------|-------------|
| **API** | `api` | 8000 | Aplicación Laravel (PHP-FPM 8.4.3 + Nginx) |
| **PostgreSQL** | `postgres` | 5432 | Base de datos PostgreSQL 15 |

### Configuración PHP

El contenedor PHP está configurado con las siguientes extensiones:
- pdo, pdo_pgsql, pdo_mysql
- opcache, pcntl
- gd (con freetype y jpeg)
- bcmath, zip, exif
- intl, xsl
- imagick, redis, igbinary, msgpack

### Variables de Entorno Docker

```env
COMPOSER_VERSION=
PHP_MEMORY_LIMIT=8000M
PHP_MAX_EXECUTION_TIME=7200
PHP_MAX_UPLOAD=50M
PHP_MAX_FILE_UPLOAD=200
PHP_MAX_POST=100M
```

## ⚙️ Instalación

### Requisitos Previos

- Docker y Docker Compose
- Git
- (Opcional) PHP 8.2+ y Composer para desarrollo local
- (Opcional) Node.js 18+ y npm

### Con Docker (Recomendado)

1. **Clonar el repositorio**
   ```bash
   git clone <repository-url>
   cd ceti-ecommerce-laravel
   ```

2. **Copiar archivo de entorno**
   ```bash
   cp .env.example .env
   ```

3. **Configurar variables de entorno**
   ```env
   DB_CONNECTION=pgsql
   DB_HOST=postgres
   DB_PORT=5432
   DB_DATABASE=ecommerce
   DB_USERNAME=root
   DB_PASSWORD=root
   ```

4. **Levantar contenedores**
   ```bash
   docker-compose up -d
   ```

5. **Instalar dependencias y configurar**
   ```bash
   docker exec -it api composer setup
   ```

### Desarrollo Local (Sin Docker)

1. **Instalar dependencias**
   ```bash
   composer install
   npm install
   ```

2. **Configurar entorno**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Ejecutar migraciones**
   ```bash
   php artisan migrate
   ```

4. **Iniciar servidor de desarrollo**
   ```bash
   composer dev
   ```
   Este comando ejecuta simultáneamente:
   - `php artisan serve` - Servidor HTTP en http://localhost:8000
   - `php artisan queue:listen` - Cola de trabajos
   - `php artisan pail` - Logs en tiempo real
   - `npm run dev` - Vite dev server

## 📝 Scripts Disponibles

### Composer Scripts

| Comando | Descripción |
|---------|-------------|
| `composer setup` | Instalación completa del proyecto |
| `composer dev` | Inicia entorno de desarrollo completo |
| `composer test` | Ejecuta tests con PHPUnit |

### NPM Scripts

| Comando | Descripción |
|---------|-------------|
| `npm run dev` | Inicia Vite en modo desarrollo |
| `npm run build` | Compila assets para producción |

## 🗄️ Base de Datos

### Migraciones Incluidas

- **employees** - Tabla de empleados
- **users** - Tabla de usuarios
- **cache** - Tabla de caché
- **jobs** - Cola de trabajos
- **categories** - Tabla de categorías de productos
- **products** - Tabla de productos
- **sales** - Tabla de ventas
- **sale_details** - Tabla de detalles de ventas

### Modelos Disponibles

#### Employee
```php
// Campos disponibles
- id (bigint, auto-increment)
- names (string)
- last_name_father (string)
- last_name_mother (string)
- document_number (string)
- email (string)
- number_phone (string)
- address (string)
- created_at, updated_at, deleted_at
- created_by, updated_by, deleted_by
```

#### User
```php
// Campos disponibles
- id (bigint, auto-increment)
- name (string)
- email (string, unique)
- email_verified_at (timestamp, nullable)
- password (hashed)
- remember_token
- created_at, updated_at
```

#### Products
```php
// Campos disponibles
- id (bigint, auto-increment)
- name (string)
- description (text)
- category_id (foreign key)
- created_at, updated_at, deleted_at
- created_by, updated_by, deleted_by
```

#### Sale
```php
// Campos disponibles
- id (bigint, auto-increment)
- user_id (foreign key)
- serial (string)
- date_created (date)
- status (string)
- total_amount (decimal)
- created_at, updated_at, deleted_at
- created_by, updated_by, deleted_by
```

#### SaleDetail
```php
// Campos disponibles
- id (bigint, auto-increment)
- sale_id (foreign key)
- product_id (foreign key)
- quantity (integer)
- price (decimal)
- discount (decimal)
- created_at, updated_at, deleted_at
- created_by, updated_by, deleted_by
```

## 🏗️ Arquitectura del Proyecto

### Repository Pattern + Service Layer

El proyecto implementa una arquitectura modular basada en el patrón Repository y Service Layer:

#### Estructura de Módulos

Cada módulo sigue la siguiente estructura:

```
Modules/
└── [ModuleName]/
    ├── [ModuleName].php              # Modelo del módulo
    ├── Repositories/
    │   ├── [ModuleName]Repository.php
    │   └── Interfaces/
    │       └── [ModuleName]RepositoryInterface.php
    └── Services/
        ├── [ModuleName]Service.php
        └── Interfaces/
            └── [ModuleName]ServiceInterface.php
```

#### Flujo de Datos

```
Controller → Service → Repository → Model → Database
```

1. **Controllers** - Manejan las peticiones HTTP y respuestas
2. **Services** - Contienen la lógica de negocio
3. **Repositories** - Manejan el acceso a datos
4. **Models** - Representan las entidades de la base de datos

#### Ejemplo: Módulo Category

```php
// Controller
CategoryController → CategoryService → CategoryRepository → Category Model

// Registro en Service Providers
RepositoryServiceProvider::class  // Registra repositorios
AppServiceProvider::class         // Registra servicios
```

### Service Providers

- **RepositoryServiceProvider**: Registra las interfaces de repositorios con sus implementaciones
- **ModelServiceProvider**: Gestiona los modelos de la aplicación
- **AppServiceProvider**: Registra servicios y configuraciones de la aplicación

## 🌐 API Endpoints

### Categorías

| Método | Endpoint | Descripción |
|--------|----------|-------------|
| GET | `/api/v1/categories` | Listar todas las categorías |
| POST | `/api/v1/categories` | Crear una nueva categoría |
| GET | `/api/v1/categories/{id}` | Obtener una categoría específica |
| PUT | `/api/v1/categories/{id}` | Actualizar una categoría |
| DELETE | `/api/v1/categories/{id}` | Eliminar una categoría |

### Ejemplo de Respuesta API

```json
{
  "status": "success",
  "data": {
    "id": 1,
    "name": "Electrónica",
    "description": "Productos electrónicos"
  }
}
```

## 🧪 Testing

### Ejecutar Tests

```bash
# Con Composer
composer test

# Directamente con PHPUnit
php artisan test

# Con cobertura
php artisan test --coverage
```

### Estructura de Tests

```
tests/
├── TestCase.php          # Clase base para tests
├── Feature/
│   └── ExampleTest.php   # Tests de integración
└── Unit/
    └── ExampleTest.php   # Tests unitarios
```

## 🛠️ Herramientas de Desarrollo

### Laravel Pint (Code Style)
```bash
./vendor/bin/pint
```

### Laravel Pail (Logs)
```bash
php artisan pail
```

### Laravel Tinker (REPL)
```bash
php artisan tinker
```

## 📚 Documentación Adicional

- [Documentación de Laravel](https://laravel.com/docs)
- [Laravel Learn](https://laravel.com/learn)
- [Laracasts](https://laracasts.com)

## 🔐 Seguridad

Si descubres alguna vulnerabilidad de seguridad, por favor reportala de manera responsable.

## 📄 Licencia

Este proyecto está bajo la licencia [MIT](https://opensource.org/licenses/MIT).

---

<p align="center">
    Desarrollado con ❤️ usando Laravel
</p>
