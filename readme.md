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

# Route List
+--------+----------+-------------------------------+--------------------------+--------------------------------------------------------------+---------------------+
| Domain | Method   | URI                           | Name                     | Action                                                       | Middleware          |
+--------+----------+-------------------------------+--------------------------+--------------------------------------------------------------+---------------------+
|        | GET|HEAD | /                             | home                     | App\Http\Controllers\RouteController@home                    | web                 |
|        | GET|HEAD | admin                         | login                    | App\Http\Controllers\RouteController@showAdminLogin          | web,guest           |
|        | POST     | admin                         | login.post               | App\Http\Controllers\Auth\AuthController@loginAdmin          | web,guest           |
|        | GET|HEAD | api/user                      |                          | Closure                                                      | api,auth:api        |
|        | GET|HEAD | dashboard                     | dashboard                | App\Http\Controllers\RouteController@showDashboard           | web,allowed,auth    |
|        | GET|HEAD | dashboard/events              | dashboard.events         | App\Http\Controllers\RouteController@showEvents              | web,allowed,auth    |
|        | POST     | dashboard/events/create       | dashboard.events.create  | App\Http\Controllers\Event\EventController@register          | web,allowed,auth    |
|        | GET|HEAD | dashboard/events/create       | dashboard.events.create  | App\Http\Controllers\RouteController@showEventCreate         | web,allowed,auth    |
|        | GET|HEAD | dashboard/events/{id}/delete  | dashboard.events.delete  | App\Http\Controllers\Event\EventController@delete            | web,allowed,auth    |
|        | POST     | dashboard/events/{id}/edit    | dashboard.events.edit    | App\Http\Controllers\Event\EventController@update            | web,allowed,auth    |
|        | GET|HEAD | dashboard/events/{id}/edit    | dashboard.events.edit    | App\Http\Controllers\RouteController@showEventEdit           | web,allowed,auth    |
|        | GET|HEAD | dashboard/gallery             | dashboard.gallery        | App\Http\Controllers\RouteController@showGallery             | web,allowed,auth    |
|        | GET|HEAD | dashboard/gallery/upload      | dashboard.gallery.upload | App\Http\Controllers\RouteController@showGalleryCreate       | web,allowed,auth    |
|        | POST     | dashboard/gallery/upload      | dashboard.gallery.upload | App\Http\Controllers\Event\EventController@addToGallery      | web,allowed,auth    |
|        | GET|HEAD | dashboard/gallery/{id}/delete | dashboard.gallery.delete | App\Http\Controllers\Event\EventController@removeFromGallery | web,allowed,auth    |
|        | GET|HEAD | dashboard/logout              | logout                   | App\Http\Controllers\Auth\AuthController@logout              | web,allowed,auth    |
|        | POST     | dashboard/profile             | dashboard.profile        | App\Http\Controllers\Auth\AuthController@updatePassword      | web,allowed,auth    |
|        | GET|HEAD | dashboard/profile             | dashboard.profile        | App\Http\Controllers\RouteController@showProfile             | web,allowed,auth    |
|        | GET|HEAD | dashboard/roles               | dashboard.roles          | App\Http\Controllers\RouteController@showRoles               | web,superadmin,auth |
|        | POST     | dashboard/roles/create        | dashboard.roles.create   | App\Http\Controllers\Role\RoleController@create              | web,superadmin,auth |
|        | POST     | dashboard/roles/{id}/edit     | dashboard.roles.edit     | App\Http\Controllers\Role\RoleController@update              | web,superadmin,auth |
|        | GET|HEAD | dashboard/roles/{id}/edit     | dashboard.roles.edit     | App\Http\Controllers\RouteController@showRoleEdit            | web,superadmin,auth |
|        | GET|HEAD | dashboard/teams               | dashboard.teams          | App\Http\Controllers\RouteController@showTeams               | web,superadmin,auth |
|        | POST     | dashboard/teams/create        | dashboard.teams.create   | App\Http\Controllers\Team\TeamController@addToTeam           | web,superadmin,auth |
|        | GET|HEAD | dashboard/teams/create        | dashboard.teams.create   | App\Http\Controllers\RouteController@showTeamsCreate         | web,superadmin,auth |
|        | GET|HEAD | dashboard/teams/{id}/delete   | dashboard.teams.delete   | App\Http\Controllers\Team\TeamController@removeFromTeams     | web,superadmin,auth |
|        | GET|HEAD | dashboard/users               | dashboard.users          | App\Http\Controllers\RouteController@showUsers               | web,allowed,auth    |
|        | POST     | dashboard/users/create        | dashboard.users.create   | App\Http\Controllers\Auth\AuthController@register            | web,superadmin,auth |
|        | GET|HEAD | dashboard/users/create        | dashboard.users.create   | App\Http\Controllers\RouteController@showUserCreate          | web,superadmin,auth |
|        | GET|HEAD | dashboard/users/{id}/delete   | dashboard.users.delete   | App\Http\Controllers\Auth\AuthController@delete              | web,superadmin,auth |
|        | POST     | dashboard/users/{id}/edit     | dashboard.users.edit     | App\Http\Controllers\Auth\AuthController@update              | web,superadmin,auth |
|        | GET|HEAD | dashboard/users/{id}/edit     | dashboard.users.edit     | App\Http\Controllers\RouteController@showUserEdit            | web,superadmin,auth |
|        | POST     | dashboard/website             | dashboard.website        | App\Http\Controllers\Website\WebsiteController@update        | web,allowed,auth    |
|        | GET|HEAD | dashboard/website             | dashboard.website        | App\Http\Controllers\RouteController@showWebsite             | web,allowed,auth    |
+--------+----------+-------------------------------+--------------------------+--------------------------------------------------------------+---------------------+
