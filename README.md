# Routable

Routable is a Laravel package for dealing with resources models routes.

## Installation

Using [composer](https://getcomposer.org/) to install routable.

```bash
composer require echosters/routable
```
## Configuration
in your ```app\config.php```
add in your ```providers```
```php
'providers' => [
    ...,
    Echosters\Routable\Providers\RoutableServiceProvider::class,
];
```
## Preparing your model
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Echosters\Routable\Routable;

class YourModel extends Model
{
    use Routable;
}
```
## Usage

```php
$user = User::find(1);
$user->getRoute('edit'); // the same of route('users.edit',$user->id)
```
## Methods
### getRoutes()
```php
User::find(1)->getRoutes();
Array
[
  "edit" => "http://example.com/users/1/edit"
  "update" => "http://example.com/users/1"
  "show" => "http://example.com/users/1"
  "destroy" => "http://example.com/users/1"
  "store" => "http://example.com/users"
  "index" => "http://example.com/users"
]
```

### getRoute($route)
```php
User::find(1)->getRoute('show');
string
"http://example.com/users/1"
```

### getResourceRoute($route)
```php
User::getResourceRoute('index');
string
"http://example.com/users"
```
### Parameters
you can pass any additional params to any route by passing the the params as array in the second parameter as following.
```php
User::find(1)->getRoute('show',['highlight' => 'true']); // "http://example.com/users/1?highlight=true"
User::find(1)->getRoutes('show',['highlight' => 'false']); // "http://example.com/users/1?highlight=false"
User::getResourceRoute('index',['id' => '1']); // "http://example.com/users?id=1"
```
## Notes
### Name Convention
if you want to override this name convention you can add getRouteName method in your model.

### getRouteName
```php
    public function getRouteName()
    {
        return 'custom-users';
    }
    //Then 
    $user = User::find(1);
    $user->getRoute('edit'); //will generate 'http://example.com/en/custom-users/1'
```

### Locale Fixed Paramaters
if you are using locale paramaters just add them in your model as following

### getFixedParameter
```php
    public function getFixedParameter()
    {
        return [
            'locale' => 'en',
        ];
    }
    //Then 
    $user = User::find(1);
    $user->getRoute('edit'); //will generate 'http://example.com/en/users/1'
```

### Relations
if you have a relation like below ```App\Models\Post.php```
```php
    public function user()
    {
        return $this->belongsTo(User::class);
    }
```
if Your web look like this
```php
 Route::resource('{user}/posts',PostsController::class);
```

So in Your ```App\Models\Post.php``` Model
```php
    public function getFixedParameter()
    {
        return [
            'user' => $this->user->id,// Or $this->user,
        ];
    }
    //Then 
    $post = Post::find(1); // Known that $post->user->id = 22;
    $post->getRoute('show'); //will generate 'http://example.com/22/posts/1'
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.


## License
[MIT](https://choosealicense.com/licenses/mit/)
