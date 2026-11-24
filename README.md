# Desarrollo Web en Entorno Servidor

Ejercicios y proyectos del módulo **Desarrollo Web en Entorno Servidor (DWES)** de 2.º de Desarrollo de Aplicaciones Web.

## Contenido

| Carpeta | Contenido |
|---|---|
| `01_tema_php_basico_cadenas` | PHP básico: variables, cadenas y arrays |
| `02_tema_bucles_funciones_control` | Estructuras de control |
| `03_tema_formularios_get_post` | Formularios con GET y POST |
| `04_tema_funciones_arrays_escape_room` | Funciones y Escape Room |
| `05_tema_cookies_sesiones` | Cookies y sesiones |
| `06_examenes` | Exámenes |
| `07_tema_bases_datos` | Acceso a bases de datos con PDO |
| `08_tema_patrones_mvc` | Patrones de diseño y MVC |
| `10_proyecto_hotel_procedural` | Proyecto hotel con arrays y sesiones |
| `11_proyecto_hotel_poo` | Proyecto Hotel Nocturna con clases |
| `12_proyecto_hotel_css_pruebas` | Pruebas de diseño del hotel |

## Uso

### Temas 1 a 6 y proyectos del hotel

Desde la raíz del repositorio:

```bash
docker compose up -d
```

Y abrir `http://localhost:8080/<carpeta>/<archivo>.php`.

### Temas 7 y 8

Cada ejercicio tiene su propia carpeta con su `docker-compose.yml` y su script `.sql`. Desde la carpeta del ejercicio:

```bash
docker compose up -d
```

Después, importar el `.sql` en la base de datos y abrir `http://localhost`.
