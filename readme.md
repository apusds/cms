# CMS @ APU SDS / DSC APU

## PHP 7.2++ required!

CMS is purely built on Modern Technologies like [Bootstrap](https://getboostrap.com), [Laravel Framework](https://laravel.com/), [NodeJS](https://nodejs.org/en/) and more.

## Amazing Contributors
- [euseanwoon2016](https://github.com/euseanwoon2016)

## Installation

Use the PHP package manager [Composer](https://getcomposer.org/download/) to install this CMS.

```bash
git clone https://github.com/APU-SDS/cms.git
cd cms/
cp .env.example .env
nano .env OR vim .env
Edit MySQL Settings according to your Database setup locally
composer install
php artisan key:generate
chmod -R o+w storage/ (Linux/Mac Only)
mysql -u root -e 'create database cms'
php artisan migrate --seed
php artisan queue:listen - (Optional) Make sure this is in a different terminal or screen (background process)
php artisan serve
```

Now, the CMS should be live on `http://127.0.0.1:8000`!

Admin Panel: `http://127.0.0.1:8000/admin`.
<br>
<u>Default Credentials:</u>
<br>
<b>Username:</b> `root`
<br>
<b>Password:</b> `password`

## Linter Installation

To install the linter

```bash
composer global require tightenco/tlint
```

For more information, check out the [repo](https://github.com/tightenco/tlint)

## Database seeding

By default, db:seed will seed the user and members table. If you wish to seed the member table:

```bash
php artisan db:seed --class=MembersTableSeeder
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure your Pull Request is satisfying the required fields in the PR Guideline/Template.

## License
This project is licensed under the **GNU General Public License v3.0** License - see the [LICENSE](LICENSE) file for details
