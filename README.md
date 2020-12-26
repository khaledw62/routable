# Routable

Routable is a Laravel package for dealing with resources models routes.

## Installation

Using [composer](https://getcomposer.org/) to install routable.

```bash
composer require echosters/routable
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
## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.


## License
[MIT](https://choosealicense.com/licenses/mit/)
