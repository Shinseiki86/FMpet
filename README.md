sbadmin + Laravel 5.5
=====================
Plantilla para proyectos nuevos.

<!-- > **Note:* . -->

[![License](https://poser.pugx.org/markrogoyski/math-php/license)](https://packagist.org/packages/markrogoyski/math-php)


## Artisan

#### droptables
 Borra todas las tablas de la base de datos actual.

```bash
$ php artisan droptables
```


## Helpers
 Utilidades para uso global.

### expression_concat
 Construye una expresión sql para concatenar columnas.

```php
expression_concat( $columns = [], $alias = 'concat', $glue=' ', $table = null );
```

### expression_count
 Construye una expresión sql para contar registros en una columna.

```php
expression_count($table, $alias);
```

### model_to_array
 Crea un array con la llave primaria y una columna a partir de un Model. Se utiliza para contruir objetos select en los views.

```php
$arr = model_to_array($class, $column, $primaryKey = null, $whereArr = []);
```

### get_model
 mm

### current_route_action
 mm
 
### array_implode
 mm
 
### img_to_base64
 mm

### delete_tree
 mm
 
### str_upperspace
 mm
 
### flash_alert

 Almacena un mensaje para ser presentado como alerta flotante en la vista.

```php
flash_alert( $message , $typeAlert );
flash_alert( '¡Contraseña modificada para '.$user->username.'!', 'success' );
```

string $message  Mensaje a presentar.
string $type Tipo de alerta. Puede ser: info, success, warning o danger.

### flash_modal

Almacena un mensaje para ser presentado como ventana modal en la vista.
 param string $msg Mensaje a presentar.
 param string $type Tipo de modal. Puede ser: info, success, warning o danger.

### datetime

 Convierte un Date a String formateado
  param string|Date $date Fecha a convertir.
  return string Fecha formateada

### get_logo

 Verifica si existe un logo definido por el usuario. Retorna la ruta del logo corporativo.
  return string Path

### convert_to_date

 Convierte una cadena de texto a una fecha
  param string $fecha_string fecha en formato de texto
  return Carbon

### number_to_letter

 Convierte un número a formato basado en reglas de números escritos con palabras
 NumberFormatter requiere habilitar extensión php_intl.dll en php.ini
  param  int $num
  return string


## Modelos

### ModelWithSoftDeletes

### RelationshipsTrait

### ModelRulesTrait

### rules



## Controlador

### index

### getData

### storeModel

### updateModel

### destroyModel



## View

### Widgets
