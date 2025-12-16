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

API Backend para una aplicación de comercio electrónico construida con **Laravel 12** y **PHP 8.2+**. El proyecto está configurado con Docker para facilitar el desarrollo y despliegue, utilizando **PostgreSQL** como base de datos principal.

## 🚀 Tecnologías

### Backend
- **Framework:** Laravel 12
- **PHP:** 8.2+
- **Base de Datos:** PostgreSQL 15
- **Servidor:** PHP-FPM 8.4.3 Alpine + Nginx

### Frontend Assets
- **Bundler:** Vite 7
- **CSS Framework:** Tailwind CSS 4.0
- **HTTP Client:** Axios

### Herramientas de Desarrollo
- **Testing:** PHPUnit 11.5
- **Code Style:** Laravel Pint
- **Mocking:** Mockery
- **Fake Data:** FakerPHP
- **Logs en tiempo real:** Laravel Pail
- **Contenedores:** Docker & Docker Compose

## 📁 Estructura del Proyecto

```
ecommerce/
├── app/
│   ├── Http/
│   │   └── Controllers/     # Controladores de la API
│   ├── Models/              # Modelos Eloquent
│   │   └── User.php         # Modelo de usuario
│   └── Providers/           # Service Providers
├── bootstrap/               # Archivos de arranque
├── config/                  # Configuraciones de la aplicación
├── database/
│   ├── factories/           # Factories para testing
│   ├── migrations/          # Migraciones de base de datos
│   └── seeders/             # Seeders de datos
├── docker/
│   ├── php/                 # Configuración PHP-FPM + Nginx
│   │   └── Dockerfile
│   └── postgres/            # Configuración PostgreSQL
│       └── Dockerfile
├── public/                  # Archivos públicos
├── resources/
│   ├── css/                 # Estilos CSS
│   ├── js/                  # JavaScript
│   └── views/               # Vistas Blade
├── routes/
│   ├── web.php              # Rutas web
│   └── console.php          # Comandos de consola
├── storage/                 # Archivos generados
├── tests/
│   ├── Feature/             # Tests de integración
│   └── Unit/                # Tests unitarios
├── docker-compose.yml       # Configuración Docker Compose
├── composer.json            # Dependencias PHP
├── package.json             # Dependencias Node.js
└── vite.config.js           # Configuración Vite
```

## 🐳 Docker

El proyecto incluye una configuración completa de Docker con los siguientes servicios:

### Servicios

| Servicio | Contenedor | Puerto | Descripción |
|----------|------------|--------|-------------|
| **API** | `api` | 8000 | Aplicación Laravel (PHP-FPM + Nginx) |
| **PostgreSQL** | `postgres` | 5432 | Base de datos |

### Configuración PHP

El contenedor PHP está configurado con las siguientes extensiones:
- mysqli, pdo, pdo_mysql
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
   cd laravel
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
   - `php artisan serve` - Servidor HTTP
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

- **users** - Tabla de usuarios
- **password_reset_tokens** - Tokens para reseteo de contraseña
- **sessions** - Sesiones de usuario
- **cache** - Tabla de caché
- **jobs** - Cola de trabajos

### Modelo User

```php
// Campos disponibles
- id (bigint, auto-increment)
- name (string)
- email (string, unique)
- email_verified_at (timestamp, nullable)
- password (hashed)
- remember_token
- created_at
- updated_at
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
