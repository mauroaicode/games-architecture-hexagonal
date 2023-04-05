<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Proyecto con arquitectura Hexagonal

La Arquitectura Hexagonal nos permite desarrollar y probar nuestra aplicación de forma aislada al framework, a la base de datos, a los paquetes de terceros y todos esos elementos que están al rededor de nuestra aplicación.

La idea es separar nuestra aplicación en una nueva estructura de directorios que este por afuera de la que propone Laravel. Las ventajas: no dependemos del framework, podemos migrar a otros frameworks, la idea es que no nos afecte cuando actualizamos a nuevas versiones, aplicación de principios SOLID.

Esta arquitectura cuanta con 3 capas: Infraestructura, Aplicación y Dominio. Cada una de ellas esta más alejada del framework y solo se pueden comunicar con su capa siguiente (nunca la capa de Infraestructura se podrá comunicar con la capa de Dominio directamente).


<p align="center"><img src="https://miro.medium.com/v2/resize:fit:1400/format:webp/1*yR4C1B-YfMh5zqpbHzTyag.png" width="400" alt="arquitectura_hexagonal"></p>

## Describiendo las 3 capas de la Arquitectura Hexagonal


- Infraestructura: La capa de infraestructura es la más cerca al framework y es la encargada de traducir todo lo que esta por afuera de nuestra aplicación (framework, base de datos, API’s, paquetes de terceros, etc.) y lo entrega a la capa de Aplicación.
- Aplicación: En la capa de aplicación vamos a tener todas las acciones que puede hacer nuestra aplicación.
- Dominio: La capa de dominio es el núcleo del sistema y establece como deben comunicarse las demás capas con ella. Es la única que no tiene acoplamientos de las otras capas.

## Sobre esta aplicación

Esta aplicación realiza el crud de una lista de juegos con API’s; utilizamos Arquitectura Hexagonal, buscando desacoplarnos del framework lo más posible. La carpeta src será ahora el core de la aplicación donde está la carpeta Shared que comparte recursos para toda la aplicación, y la carpeta BoundedContext(aquí podemos agregar todas las entidades) donde está la entidad Games. Desde la capa Infraestructura, usamos modelos con eloquent e implementamos Storage y generador de identificador Uuid.
Se crean interfaces para los controladores, y usos para diferentes funciones buscando aplicar el Patrón Repositorio.
Puedes ver el [frontend hecho Vue con Nuxt](https://github.com/mauroaicode/games-architecture-hexagonal-frontend)

## Iniciar

```bash
# Instalar dependencias
$ composer install

# Llave única de la aplicación
$ php artisan key:generate

# generar datos semilla, se crean 3 juegos
$ php artisan migrate:fresh --seed

# Puedes probar la api usando Postman
$ php artisan serve

```

