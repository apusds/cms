# CMS @ Student Developer Society

### <u>Installation</u>
- `git clone git@github.com:InspectorGadget/sds-cms.git`
- `cd sds-cms`
- `composer install`
- `cp .env.example .env`
- Update MySQL Details in `.env`
- `php artisan key:generate`
- `php artisan migrate`
- `php artisan db:seed`
- `php artisan storage:link`
- `php artisan serve`
- Open Browser and go to `http://127.0.0.1:8000`
