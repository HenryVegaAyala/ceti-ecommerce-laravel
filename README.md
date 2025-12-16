# 🛒 Ecommerce API - Laravel con Docker

Proyecto de API para ecommerce desarrollado con Laravel, PHP 8.4, Nginx, PostgreSQL y Docker.

## 📋 Tabla de Contenidos

- [Requisitos Previos](#-requisitos-previos)
- [Estructura del Proyecto](#-estructura-del-proyecto)
- [Instalación](#-instalación)
- [Configuración](#-configuración)
- [Comandos Docker](#-comandos-docker)
- [Acceso a los Servicios](#-acceso-a-los-servicios)
- [Desarrollo](#-desarrollo)
- [Solución de Problemas](#-solución-de-problemas)

---

## 🔧 Requisitos Previos

Antes de comenzar, asegúrate de tener instalado:

- **Docker Desktop** (versión 20.10 o superior)
  - [Descargar para Windows](https://docs.docker.com/desktop/install/windows-install/)
  - [Descargar para Mac](https://docs.docker.com/desktop/install/mac-install/)
  - [Descargar para Linux](https://docs.docker.com/desktop/install/linux-install/)
- **Docker Compose** (incluido en Docker Desktop)
- **Git** para clonar el repositorio

### Verificar instalación

```bash
docker --version
docker-compose --version
```

---

## 📁 Estructura del Proyecto

```
laravel/
├── docker/
│   ├── php/
│   │   ├── Dockerfile              # Imagen PHP 8.4 + Nginx + Supervisor
│   │   └── app/
│   │       ├── config/
│   │       │   └── webserver.conf  # Configuración principal de Nginx
│   │       ├── site/
│   │       │   └── default.conf    # Virtual host de Nginx
│   │       └── supervisor/
│   │           ├── supervisord.conf    # Configuración de Supervisor
│   │           └── webserver.conf      # Procesos Nginx + PHP-FPM
│   └── postgres/
│       └── Dockerfile              # Imagen PostgreSQL 18.1
├── docker-compose.yml              # Orquestación de servicios
├── .env                            # Variables de entorno (no commitear)
├── .env.example                    # Plantilla de variables de entorno
├── .dockerignore                   # Archivos excluidos del build
└── README.md                       # Este archivo
```

---

## 🚀 Instalación

### Paso 1: Clonar el repositorio

```bash
git clone <url-del-repositorio>
cd laravel
```

### Paso 2: Configurar variables de entorno

Copia el archivo de ejemplo y ajusta los valores según sea necesario:

```bash
# Windows (PowerShell)
Copy-Item .env.example .env

# Linux/Mac
cp .env.example .env
```

### Paso 3: Editar el archivo `.env`

Abre el archivo `.env` y verifica/modifica las siguientes variables:

```env
COMPOSER_VERSION=2.8.12
```

### Paso 4: Construir las imágenes Docker

```bash
docker-compose build
```

Este proceso puede tomar varios minutos la primera vez, ya que descarga e instala:
- PHP 8.4 con extensiones (GD, Redis, Imagick, etc.)
- Nginx
- Composer
- PostgreSQL 18.1

### Paso 5: Iniciar los contenedores

```bash
docker-compose up -d
```

### Paso 6: Verificar que los contenedores están corriendo

```bash
docker-compose ps
```

Deberías ver algo como:

```
NAME       IMAGE              STATUS          PORTS
api        ecommerce:api-dev  Up              0.0.0.0:8000->8000/tcp
postgres   postgres:dev       Up              0.0.0.0:5432->5432/tcp
```

---

## ⚙️ Configuración

### Variables de Entorno del Docker Compose

| Variable | Descripción | Valor por defecto |
|----------|-------------|-------------------|
| `COMPOSER_VERSION` | Versión de Composer a instalar | `2.8.12` |

### Configuración de PostgreSQL

| Variable | Valor |
|----------|-------|
| `POSTGRES_USER` | `root` |
| `POSTGRES_PASSWORD` | `root` |
| `POSTGRES_DB` | `ecommerce` |
| Puerto expuesto | `5432` |

### Configuración de PHP

El Dockerfile acepta los siguientes argumentos de build (configurables via `docker-compose.yml`):

| Argumento | Descripción |
|-----------|-------------|
| `PHP_MEMORY_LIMIT` | Límite de memoria PHP |
| `PHP_MAX_EXECUTION_TIME` | Tiempo máximo de ejecución |
| `PHP_MAX_UPLOAD` | Tamaño máximo de upload |
| `PHP_MAX_FILE_UPLOAD` | Número máximo de archivos |
| `PHP_MAX_POST` | Tamaño máximo de POST |
| `OPCACHE_*` | Configuraciones de OPcache |

---

## 🐳 Comandos Docker

### Comandos básicos

```bash
# Construir imágenes
docker-compose build

# Iniciar contenedores en segundo plano
docker-compose up -d

# Iniciar contenedores y ver logs
docker-compose up

# Detener contenedores
docker-compose down

# Detener y eliminar volúmenes (¡CUIDADO: borra datos de BD!)
docker-compose down -v

# Ver logs de todos los servicios
docker-compose logs -f

# Ver logs de un servicio específico
docker-compose logs -f api
docker-compose logs -f postgres

# Ver estado de los contenedores
docker-compose ps
```

### Acceder a los contenedores

```bash
# Acceder al contenedor de la API (PHP)
docker exec -it api bash

# Acceder al contenedor de PostgreSQL
docker exec -it postgres bash

# Ejecutar comandos de psql directamente
docker exec -it postgres psql -U root -d ecommerce
```

### Comandos de Laravel dentro del contenedor

```bash
# Primero accede al contenedor
docker exec -it api bash

# Luego ejecuta comandos de Laravel/Artisan
php artisan migrate
php artisan db:seed
php artisan cache:clear
php artisan config:clear
composer install
composer update
```

### Comandos rápidos sin entrar al contenedor

```bash
# Ejecutar migraciones
docker exec -it api php artisan migrate

# Ejecutar composer install
docker exec -it api composer install

# Ejecutar tests
docker exec -it api php artisan test
```

---

## 🌐 Acceso a los Servicios

Una vez que los contenedores estén corriendo:

| Servicio | URL/Conexión | Descripción |
|----------|--------------|-------------|
| **API Laravel** | http://localhost:8000 | Aplicación principal |
| **PostgreSQL** | `localhost:5432` | Base de datos |

### Conexión a PostgreSQL desde un cliente

- **Host:** `localhost`
- **Puerto:** `5432`
- **Usuario:** `root`
- **Contraseña:** `root`
- **Base de datos:** `ecommerce`

---

## 💻 Desarrollo

### Flujo de trabajo recomendado

1. **Iniciar el entorno:**
   ```bash
   docker-compose up -d
   ```

2. **Desarrollar:** Los cambios en el código se reflejan automáticamente gracias al volumen montado.

3. **Ver logs en tiempo real:**
   ```bash
   docker-compose logs -f api
   ```

4. **Ejecutar comandos de Artisan:**
   ```bash
   docker exec -it api php artisan <comando>
   ```

5. **Detener al finalizar:**
   ```bash
   docker-compose down
   ```

### Reconstruir después de cambios en Dockerfile

Si modificas el `Dockerfile` o archivos de configuración de Docker:

```bash
docker-compose build --no-cache
docker-compose up -d
```

---

## 🔍 Solución de Problemas

### El contenedor no inicia

```bash
# Ver logs detallados
docker-compose logs api

# Verificar el estado
docker-compose ps
```

### Error de permisos en storage/logs

```bash
docker exec -it api chmod -R 777 storage bootstrap/cache
```

### Puerto ya en uso

Si el puerto 8000 o 5432 ya está en uso, modifica el `docker-compose.yml`:

```yaml
ports:
  - "8080:8000"  # Cambia 8000 por otro puerto disponible
```

### Limpiar todo y empezar de nuevo

```bash
# Detener y eliminar contenedores, redes y volúmenes
docker-compose down -v

# Eliminar imágenes del proyecto
docker rmi ecommerce:api-dev postgres:dev

# Reconstruir todo
docker-compose build --no-cache
docker-compose up -d
```

### Error de conexión a PostgreSQL desde Laravel

Verifica que en tu `.env` de Laravel tengas:

```env
DB_CONNECTION=pgsql
DB_HOST=postgres
DB_PORT=5432
DB_DATABASE=ecommerce
DB_USERNAME=root
DB_PASSWORD=root
```

> **Nota:** El host debe ser `postgres` (nombre del servicio en docker-compose), no `localhost`.

---

## 📦 Servicios incluidos en el contenedor PHP

- **PHP 8.4.3** (FPM)
- **Nginx** (servidor web)
- **Supervisor** (gestor de procesos)
- **Composer** (gestor de dependencias PHP)

### Extensiones PHP instaladas

- mysqli, pdo, pdo_mysql
- opcache, pcntl, bcmath
- gd, imagick, exif
- zip, intl, xsl
- redis, igbinary, msgpack
- gettext, shmop, sysvmsg, sysvsem, sysvshm, ftp

---

## 📄 Licencia

Este proyecto está bajo la licencia [MIT](LICENSE).

---

## 👥 Contribución

1. Fork el proyecto
2. Crea tu rama de feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

