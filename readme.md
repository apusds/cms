# CMS @ APU SDS / DSC APU

CMS is purely built on Modern Technologies like [Bootstrap](https://getboostrap.com), [Laravel Framework](https://laravel.com/), [NodeJS](https://nodejs.org/en/) and more.

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
chmod -R o+w storage/
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

Now, the CMS should be live on `http://127.0.0.1:8000`!

<u>Default Credentials:</u>
<br>
<b>Username:</b> `root`
<br>
<b>Password:</b> `password`

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure your Pull Request is satisfying the required fields in the PR Guideline/Template. 

## License
This project is licensed under the **GNU General Public License v3.0** License - see the [LICENSE](LICENSE) file for details
