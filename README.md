
# Sistema de gestion de laboratorio geotecnico



## Caracteristicas

- Mobile Responsive Bootstrap 4 Design
- User Management with Roles
- Role Management
- Permissions Management
- Access Control List (ACL)
- Laravel 8 + Bootstrap 4


## Tecnologias

**Client:** HTML, CSS, JavaScript, jQuery, VueJs, Bootstrap 4

**Server:** PHP, Laravel 8

**DataBase:** MySql


## Instalación
Para Intalar el sistema siga los siguientes pasos:


```

Install All Packages of laravel
```bash
composer install
```

Install NPM Dependencies
```bash
npm install && npm run dev
```

Create .env file
```bash
cp .env.example .env
```

Generate Application key

```bash
php artisan key:generate
```

Update .env File with Database credentials and run migration with seed.
```bash
php artisan migrate --seed
```

All Set ! now serve laravel app on local and open app in browser.

Login With Admin
```bash
Username - admin@admin.com
Password - Admin@123#
```
## Screenshots

### Login
![App Screenshot](screenshot\Login.png)
### Dashboard Pendiente*
---
### Usuario
![App Screenshot](screenshot\perfil.png)
![App Screenshot](screenshot\usuario_list.png)
### Roles
![App Screenshot](screenshot\roles_lista.png)




