# Beheeromgeving (Laravel eindopdracht)

Beheeromgeving voor rollen en permissies. Gemaakt met Laravel, Breeze en Spatie Laravel Permission.
Alleen gebruikers met de rol admin kunnen erbij (middleware role:admin).

Er zijn 4 CRUD's:
- Permissies beheren (tabel permissions)
- Rollen beheren (tabel roles)
- Permissie koppelen aan rol (tabel role_has_permissions)
- Rol koppelen aan gebruiker (tabel model_has_roles)

## Opstarten

```
composer install
npm install
npm run build
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

Daarna naar http://localhost:8000/beheer/permissies gaan en inloggen met een admin account.
