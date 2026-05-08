# Ejercicio 2 — Arquitectura y Patrones de Diseño

**Tiempo estimado:** 60–70 minutos  
**Nivel evaluado:** Intermedio  
**Prerrequisito:** Ejercicio 1 completado (modelos `Propietario` y `Mascota` con relaciones y `$fillable` correctos)  
**Sistema:** OkVet — Plataforma de gestión veterinaria

---

## Contexto

El módulo de consultas médicas fue implementado rápidamente para salir a producción. Funciona, pero fue escrito sin considerar arquitectura ni buenas prácticas. Tu trabajo es refactorizarlo aplicando los patrones correctos, sin cambiar el comportamiento externo de la API.

**No debes reescribir desde cero.** Debes identificar los problemas de diseño y resolverlos de forma incremental.

---

## Entidades del dominio

### Veterinario

| Campo             | Tipo    | Descripción                          |
|-------------------|---------|--------------------------------------|
| id                | integer | Clave primaria                       |
| nombre            | string  | Nombre                               |
| apellido          | string  | Apellido                             |
| especialidad      | string  | Especialidad médica                  |
| numero_colegiado  | string  | Número único de colegiatura          |
| email             | string  | Correo electrónico (único)           |

### Consulta

| Campo          | Tipo    | Descripción                                                  |
|----------------|---------|--------------------------------------------------------------|
| id             | integer | Clave primaria                                               |
| mascota_id     | integer | FK hacia `mascotas`                                          |
| veterinario_id | integer | FK hacia `veterinarios`                                      |
| motivo         | string  | Motivo de la consulta                                        |
| diagnostico    | text    | Diagnóstico (opcional, se completa al cerrar la consulta)    |
| estado         | string  | Estado: `pendiente`, `en_progreso`, `completada`, `cancelada`|
| fecha_consulta | date    | Fecha de la consulta                                         |

### Tratamiento

| Campo       | Tipo    | Descripción                          |
|-------------|---------|--------------------------------------|
| id          | integer | Clave primaria                       |
| consulta_id | integer | FK hacia `consultas`                 |
| descripcion | string  | Descripción del tratamiento          |
| dosis       | string  | Dosis indicada (opcional)            |
| duracion    | string  | Duración del tratamiento (opcional)  |

---

## Archivos a revisar y corregir

```
database/migrations/2026_05_08_000003_create_veterinarios_table.php
database/migrations/2026_05_08_000004_create_consultas_table.php
database/migrations/2026_05_08_000005_create_tratamientos_table.php
app/Models/Veterinario.php
app/Models/Consulta.php
app/Models/Tratamiento.php
app/Notificadores/MailNotificador.php
app/Http/Controllers/ExerciseIntermediateController.php
routes/api.php
```

Además, deberás crear los siguientes archivos nuevos:

```
app/Contracts/NotificadorInterface.php
app/Notificadores/SmsNotificador.php
app/Repositories/ConsultaRepositoryInterface.php
app/Repositories/ConsultaRepository.php
app/Services/ConsultaService.php
app/Http/Resources/ConsultaResource.php
app/Http/Requests/StoreConsultaRequest.php
app/Http/Requests/UpdateConsultaRequest.php
tests/Feature/ConsultaTest.php
```

---

## Comportamiento esperado

### Endpoints

| Método | Ruta                     | Descripción                                     |
|--------|--------------------------|-------------------------------------------------|
| GET    | /api/v1/consultas        | Lista consultas paginadas (filtrable por estado)|
| POST   | /api/v1/consultas        | Crea una consulta nueva                         |
| GET    | /api/v1/consultas/{id}   | Muestra una consulta con sus relaciones         |
| PUT    | /api/v1/consultas/{id}   | Actualiza una consulta                          |
| DELETE | /api/v1/consultas/{id}   | Elimina una consulta                            |

### Detalles por endpoint

**GET /api/v1/consultas**
- Retorna listado paginado
- Acepta parámetro `?estado=pendiente` para filtrar
- Cada consulta incluye: datos de la mascota (con propietario), datos del veterinario y tratamientos
- Status: `200 OK`

**POST /api/v1/consultas**
- Campos requeridos: `mascota_id`, `veterinario_id`, `motivo`, `fecha_consulta`
- Campos opcionales: `diagnostico`
- La consulta se crea con estado `pendiente` automáticamente
- Al crear una consulta, se notifica al propietario (ver sección de notificaciones)
- Validación mediante `FormRequest`
- Status: `201 Created`

**GET /api/v1/consultas/{id}**
- Incluye mascota, propietario de la mascota, veterinario y tratamientos
- Si no existe: `404 Not Found`
- Status: `200 OK`

**PUT /api/v1/consultas/{id}**
- Permite actualizar cualquier campo incluyendo `estado`
- Al actualizar una consulta, se notifica al propietario
- Validación mediante `FormRequest`
- Si no existe: `404`
- Status: `200 OK`

**DELETE /api/v1/consultas/{id}**
- Si no existe: `404`
- Status: `204 No Content`

### Estructura de respuesta JSON (resource)

```json
{
  "data": {
    "id": 1,
    "fecha": "2026-05-10",
    "motivo": "Revisión anual",
    "diagnostico": null,
    "estado": "pendiente",
    "mascota": {
      "id": 1,
      "nombre": "Fido",
      "especie": "perro",
      "propietario": "Juan Pérez"
    },
    "veterinario": {
      "id": 1,
      "nombre": "Dra. Ana Gómez"
    },
    "tratamientos": []
  }
}
```

---

## Sistema de notificaciones (Patrón Strategy)

Al crear o actualizar una consulta, el sistema debe notificar al propietario de la mascota. Actualmente la notificación está acoplada a una implementación concreta.

**Tu tarea:**

1. Crea una interfaz `NotificadorInterface` con el contrato de notificación.
2. Haz que `MailNotificador` implemente esa interfaz.
3. Crea `SmsNotificador` como segunda implementación alternativa.
4. El sistema debe poder cambiar de canal de notificación **sin modificar el Service ni el Controller**, solo ajustando la variable de entorno `OKVET_NOTIFICADOR` (valores: `mail` o `sms`).
5. El archivo `config/okvet.php` ya existe y está configurado para leer esa variable.
6. Registra el binding en `AppServiceProvider`.

**Criterio de verificación:** si cambiar `OKVET_NOTIFICADOR=sms` en `.env` activa `SmsNotificador` sin tocar ningún otro archivo, el patrón está correctamente implementado.

---

## Arquitectura esperada

El controlador refactorizado **no debe** contener lógica de negocio ni queries directas. Debe delegar:

- **Queries y persistencia** → `ConsultaRepository` (implementa `ConsultaRepositoryInterface`)
- **Lógica de negocio y coordinación** → `ConsultaService`
- **Notificaciones** → `NotificadorInterface` inyectada en el Service

El Service recibe sus dependencias por constructor (inyección de dependencias), no las instancia directamente.

---

## Tests

Escribe al menos un `Feature Test` en `tests/Feature/ConsultaTest.php` que cubra:

- [ ] El endpoint GET `/api/v1/consultas` devuelve `200` con estructura paginada
- [ ] El endpoint POST `/api/v1/consultas` crea una consulta y devuelve `201`
- [ ] El endpoint POST devuelve `422` si faltan campos requeridos
- [ ] El endpoint GET `/api/v1/consultas/{id}` devuelve `404` para un ID inexistente

Las factories `ConsultaFactory`, `VeterinarioFactory`, `PropietarioFactory` y `MascotaFactory` ya están disponibles.

---

## Restricciones

1. **No instales librerías externas.** Usa únicamente lo que provee Laravel 12.
2. **No uses `DB::select()`, `DB::statement()` ni SQL crudo.**
3. **La validación debe ir en clases `FormRequest`**, no en el controlador.
4. **Las respuestas deben usar `API Resources`**, no retornar modelos directamente.
5. **No modifiques las rutas** (`/api/v1/consultas`). Puedes eliminar la ruta `/por-estado/{estado}` si la consolidas en el index.
6. El proyecto debe correr con `php artisan migrate && php artisan test` sin errores.

---

## Criterios de aceptación

- [ ] `php artisan migrate` ejecuta sin errores
- [ ] Todos los endpoints responden con los status HTTP correctos
- [ ] Las respuestas siguen la estructura JSON documentada (via API Resource)
- [ ] El controlador no tiene queries ni lógica de negocio directa
- [ ] `ConsultaService` recibe `NotificadorInterface` por constructor
- [ ] Cambiar `OKVET_NOTIFICADOR=sms` activa `SmsNotificador` sin modificar Service ni Controller
- [ ] El listado no genera una query por cada consulta (sin N+1)
- [ ] Al menos un Feature Test pasa exitosamente

---

## Pistas (úsalas solo si estás muy atascado)

<details>
<summary>Mostrar pistas</summary>

- Para resolver el N+1, carga las relaciones de una sola vez antes del bucle: `Consulta::with(['mascota.propietario', 'veterinario', 'tratamientos'])`.
- `whenLoaded()` en un Resource evita errores si una relación no fue cargada intencionalmente.
- El handler de excepciones en Laravel 12 se configura en `bootstrap/app.php` dentro de `withExceptions()`.
- Los bindings de interfaces se registran en `AppServiceProvider::register()` con `$this->app->bind(Interface::class, Concrete::class)`.
- `$this->app->bind()` acepta un closure como segundo argumento, útil para resolución condicional basada en config.
- `tap()` es útil para ejecutar una acción sobre un valor y retornarlo: `tap(Model::create($data), fn($m) => $m->load('relacion'))`.

</details>

---

## Entrega

Cuando termines:

1. Asegúrate de que `php artisan migrate:fresh && php artisan test` corra sin errores.
2. haz push de tus cambios a tu fork
