# Armario Móvil


# Requisitos

## PDF libs
libssl1.0-dev
libfontconfig1
libxrender1

## Video libs
ffmpeg
sudo apt-get install libfdk-aac-dev



## Url length config in APACHE
Open /etc/apache2/apache2.conf

and insert under AccessFileName .htaccess:

LimitRequestLine 1000000
LimitRequestFieldSize 1000000




# Instalación

Instalar dependencias primera vez

```
composer install
npm install
php artisan key:generate
php artisan passport:install
```


Crear DDBB tablas iniciales (SI EXISTEN DATOS EN LA BASE DE DATOS SERÁN BORRADOS)

```
php artisan migrate:fresh
```


Datos de ejemplo

```
php artisan db:seed
```


Permisos de librerías PDF
```
sudo chmod +x ./vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64
sudo chmod +x ./vendor/h4cc/wkhtmltoimage-amd64/bin/wkhtmltoimage-amd64
```






# Desarrollo



Correr proyecto en ambiente de desarrollo

```
php artisan serve // (opcional)

npm run watch
```



Scaffold Generator

```
php artisan infyom:model PostComment --fieldsFile=PostComment.json && php artisan infyom:migration PostComment --fieldsFile=PostComment.json
php artisan infyom:scaffold PostCategory --fieldsFile=PostCategory.json --prefix=admin --skip=model,migration,routes
php artisan infyom:api PostComment --fieldsFile=PostComment.json --skip=model,migration,routes
```




