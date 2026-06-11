# 🏥 Medu - Sistema Clínico de Inventario

Medu es un software de grado comercial desarrollado en **Laravel 12** para la gestión integral de inventarios en farmacias y clínicas. Está diseñado con un enfoque fuerte en UX/UI mediante TailwindCSS, seguridad basada en roles y auditoría de datos.

## ✨ Características Principales

- **Gestión Avanzada de Medicinas:** CRUD completo con soporte para campos médicos (Principio activo, lote, vencimiento, estante/ubicación, receta obligatoria).
- **Control de Roles y Permisos:** 
  - `Administrador`: Acceso total (creación, edición y eliminación de catálogo).
  - `Farmacéutico`: Acceso operativo (registro de movimientos de stock, bloqueado de modificaciones críticas).
- **Kardex y Auditoría:** Registro histórico de entradas y salidas de cada producto, identificando automáticamente qué usuario autorizó el movimiento.
- **Exportación de Reportes:** Generación nativa y veloz de reportes en `Excel (CSV)` y `PDF`.
- **Notificaciones Automáticas:** Cron Job integrado (`medu:check-vencimientos`) para alertar sobre lotes próximos a caducar en 30 días.
- **Filtros Dinámicos (AJAX):** Búsqueda instantánea y filtrado por niveles de stock dinámicos (calculados en base al stock mínimo de cada producto).

## 🚀 Tecnologías Utilizadas
- **Backend:** PHP 8.5, Laravel 12
- **Base de Datos:** MySQL (con Soft Deletes e integridad referencial)
- **Frontend:** TailwindCSS, Blade, Vanilla JS, AlpineJS
- **Exportación:** DomPDF

## ⚙️ Instalación Local

1. Clona el repositorio.
2. Instala las dependencias de PHP y Node:
   ```bash
   composer install
   npm install && npm run build
   ```
3. Configura tu archivo `.env` con las credenciales de tu base de datos.
4. Ejecuta las migraciones y los seeders (esto creará los usuarios de prueba y datos dummy):
   ```bash
   php artisan migrate --seed
   ```
5. Inicia el servidor de desarrollo:
   ```bash
   php artisan serve
   ```

## 🔐 Usuarios de Prueba
Tras ejecutar el seeder, puedes acceder al sistema con las siguientes cuentas:
- **Admin:** `test@example.com` | Password: `password`
- **Farmacéutico:** `farmacia@example.com` | Password: `password`

---
