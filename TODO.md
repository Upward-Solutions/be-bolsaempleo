# Tareas pendientes

## Diseño

[] Responsive de la home que no se achique demasiado el texto
[] Responsive de la vista de vacantes. Que se auto ajuste la grilla de vacantes
[] Responsive de la carga de información para aplicar a una vacante.

## Funcionales

+ Adaptar código de php para el file system de azure
  - Upload de archivos
    [x] Que funcione localmente
    [x] Que funcione en ambientes de azure
    [] Validaciones de las características del file
    [] Validaciones del formulario
  - Download de archivos
    [] Que funcione localmente
    [] Que funcione en ambientes de azure
    [] Que se muestre loader para que no se pueda hacer más de un click en los botones de submit
[] Que se pueda editar una categoría
[] UTF-8 en la base de datos
[] Que las búsquedas tengan un id visible
[] Sumarle a las búsquedas un campo que sea institución y días y horarios

# Test

[x] Test de flujo e2e - layout
[x] Test de flujo e2e - login
[] Test de flujo e2e - vista index
[] Test de flujo e2e - vista vacantes
[] Test para admin
[] Test unitarios PHP

# Infraestructura

[] Agregar CDN con dominio
[] Agregar versión visible con hash de commit
[X] Configuración de la infraestructura del file system
[X] Warnings del pipeline
[X] Ejecutar test e2e en el pipeline

# Arquitectura

[] Separar más claramente las capas de View - Domain - Repository