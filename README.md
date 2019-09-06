# Contact

## Setup:
Install all dependencies at the directory's root:
```bash
composer install
```

Create the database:
```bash
php bin/console doctrine:database:create
```

Create the database schema:
```bash
php bin/console doctrine:schema:create
```

Load the fixtures in the database _(create default values)_:
```bash
php bin/console doctrine:fixtures:load
```