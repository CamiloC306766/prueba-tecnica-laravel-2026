# Ejercicio 1 — Refactorización de API REST

**Tiempo estimado:** 40–50 minutos  
**Nivel evaluado:** Básico  
**Sistema:** OkVet — Plataforma de gestión veterinaria

---

## Contexto

OkVet es un sistema veterinario que permite gestionar propietarios y sus mascotas. Un desarrollador anterior dejó incompleto e incorrecto el módulo de mascotas. Tu tarea es revisar el código existente, identificar todos los problemas y refactorizarlo hasta que funcione correctamente y siga las buenas prácticas de Laravel.

**No debes escribir el módulo desde cero.** Debes corregir y mejorar lo que ya existe.

---

## Entidades del dominio

### Propietario
Representa al dueño de una o más mascotas.

| Campo      | Tipo    | Descripción                  |
|------------|---------|------------------------------|
| id         | integer | Clave primaria               |
| nombre     | string  | Nombre del propietario       |
| apellido   | string  | Apellido                     |
| email      | string  | Correo electrónico (único)   |
| telefono   | string  | Teléfono (opcional)          |
| direccion  | text    | Dirección (opcional)         |

### Mascota
Representa al paciente atendido en la clínica.

| Campo            | Tipo    | Descripción                              |
|------------------|---------|------------------------------------------|
| id               | integer | Clave primaria                           |
| nombre           | string  | Nombre de la mascota                     |
| especie          | string  | Especie (perro, gato, etc.)              |
| raza             | string  | Raza (opcional)                          |
| peso             | decimal | Peso en kilogramos (ej: 3.75)            |
| fecha_nacimiento | date    | Fecha de nacimiento                      |
| propietario_id   | integer | FK hacia la tabla `propietarios`         |

---

## Archivos a revisar y corregir

Los errores están distribuidos en los siguientes archivos. Revisa cada uno con atención:

```
database/migrations/2026_05_08_000001_create_propietarios_table.php
database/migrations/2026_05_08_000002_create_mascotas_table.php
app/Models/Propietario.php
app/Models/Mascota.php
app/Http/Controllers/ExerciseBasicsController.php
routes/api.php
```

Además, deberás crear los siguientes archivos nuevos como parte de la solución:

```
app/Http/Requests/StoreMascotaRequest.php
app/Http/Requests/UpdateMascotaRequest.php
```

---

## Comportamiento esperado

Al finalizar la refactorización, los siguientes endpoints deben funcionar correctamente:

| Método | Ruta                 | Descripción                                      |
|--------|----------------------|--------------------------------------------------|
| GET    | /api/v1/mascotas     | Lista todas las mascotas con su propietario      |
| POST   | /api/v1/mascotas     | Crea una mascota nueva                           |
| GET    | /api/v1/mascotas/{id}| Muestra una mascota con su propietario           |
| PUT    | /api/v1/mascotas/{id}| Actualiza los datos de una mascota               |
| DELETE | /api/v1/mascotas/{id}| Elimina una mascota                              |

### Detalles de cada endpoint

**GET /api/v1/mascotas**
- Retorna listado paginado de mascotas
- Cada mascota debe incluir los datos de su propietario
- Status: `200 OK`

**POST /api/v1/mascotas**
- Campos requeridos: `nombre`, `especie`, `peso`, `fecha_nacimiento`, `propietario_id`
- Campos opcionales: `raza`
- La validación debe realizarse mediante un `FormRequest` dedicado, no directamente en el controlador
- Status: `201 Created` con la mascota creada y su propietario

**GET /api/v1/mascotas/{id}**
- Retorna la mascota con su propietario
- Si no existe: `404 Not Found`
- Status: `200 OK`

**PUT /api/v1/mascotas/{id}**
- Actualiza solo los campos enviados (actualización parcial)
- La validación debe realizarse mediante un `FormRequest` dedicado
- Si no existe: `404 Not Found`
- Status: `200 OK` con la mascota actualizada

**DELETE /api/v1/mascotas/{id}**
- Elimina la mascota
- Si no existe: `404 Not Found`
- Status: `204 No Content`

---

## Restricciones

1. **No instales librerías externas.** Usa únicamente lo que provee Laravel 12.
2. **No uses `DB::select()`, `DB::statement()` ni SQL crudo** — utiliza Eloquent ORM.
3. **La validación debe ir en clases `FormRequest`**, no directamente en el controlador.
4. **Mantén la estructura de rutas** (`/api/v1/mascotas`). Puedes renombrar los métodos del controlador.
5. **No modifiques el archivo `app/Http/Controllers/Controller.php`**.
6. El proyecto debe correr con `php artisan migrate && php artisan serve` sin errores.

---

## Criterios de aceptación

Tu solución será evaluada contra los siguientes puntos. Asegúrate de cubrirlos todos:

- [ ] `php artisan migrate` ejecuta sin errores
- [ ] Los cinco endpoints responden con los status HTTP correctos
- [ ] No hay consultas SQL crudas en el controlador ni en los modelos
- [ ] La validación de `store` y `update` está en clases `FormRequest` separadas
- [ ] Si se solicita una mascota inexistente, la API responde `404` (no un error 500)
- [ ] El listado incluye los datos del propietario sin generar una query por cada mascota
- [ ] Los modelos tienen protección contra asignación masiva

---

## Pistas (úsalas solo si estás muy atascado)

<details>
<summary>Mostrar pistas</summary>

- Eloquent infiere el nombre de la tabla desde el nombre del modelo en `snake_case` plural. Verifica si algún modelo lo está sobreescribiendo incorrectamente.
- Las foreign keys en Eloquent siguen la convención `{modelo_en_singular}_id`. Revisa si las columnas de la migración cumplen esa convención.
- `findOrFail()` lanza automáticamente una excepción `404` si el registro no existe.
- El problema del N+1 se resuelve con eager loading: `Model::with('relacion')`.
- PHP distingue mayúsculas y minúsculas en los namespaces cuando el servidor corre sobre Linux.

</details>

---

## Entrega

Cuando termines:

1. Asegúrate de que `php artisan migrate:fresh && php artisan serve` corra sin errores.
