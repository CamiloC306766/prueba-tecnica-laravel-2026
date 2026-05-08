# Prueba Técnica — Desarrollador PHP/Laravel

**Empresa:** OkVet SAS  
**Stack:** PHP 8.2 · Laravel 12 · MySQL 8 · REST API  
**Duración estimada:** 2 horas

---

## Instrucciones de entrega

1. Haz un **fork** del repositorio: [github.com/DavidMayaG/prueba-tecnica-laravel-2026](https://github.com/DavidMayaG/prueba-tecnica-laravel-2026)
2. Realiza **commits incrementales** a medida que resuelves cada punto, siguiendo el estándar [Conventional Commits](https://www.conventionalcommits.org/es/v1.0.0/) (`feat:`, `fix:`, `refactor:`, `test:`, etc.)
3. Al finalizar, haz **push** a tu fork
---

## Configuración inicial

```bash
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate
php artisan serve
```

---

## Ejercicios

| # | Archivo de instrucciones | Tema | Tiempo estimado |
|---|---|---|---|
| 1 | [instructions/exercise1.md](instructions/exercise1.md) | Refactorización básica: Eloquent, relaciones, validación | 40–50 min |
| 2 | [instructions/exercise2.md](instructions/exercise2.md) | Arquitectura y patrones: Repository, Service, Strategy, Resources, Tests | 60–70 min |

Cada ejercicio describe los archivos a modificar, el comportamiento esperado y los criterios de aceptación.

---

## Consideraciones

- Trabaja sobre los archivos indicados en cada ejercicio; no modifiques archivos fuera del alcance definido.
- El proyecto debe correr con `php artisan migrate && php artisan serve` sin errores al finalizar.
