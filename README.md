# Entity detail helper

[![Latest Version on Packagist](https://img.shields.io/packagist/v/danielebarbaro/laravel-entity-details.svg?style=flat-square)](https://packagist.org/packages/danielebarbaro/laravel-entity-details)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/danielebarbaro/laravel-entity-details/run-tests?label=tests)](https://github.com/danielebarbaro/laravel-entity-details/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/danielebarbaro/laravel-entity-details/Check%20&%20fix%20styling?label=code%20style)](https://github.com/danielebarbaro/laravel-entity-details/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/danielebarbaro/laravel-entity-details.svg?style=flat-square)](https://packagist.org/packages/danielebarbaro/laravel-entity-details)

laravel-entity-details is a package to create and attach some details to a generic Model in a blink of an eye 😎

## Installation

You can install the package via composer:

```bash
composer require danielebarbaro/laravel-entity-details
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="entity-details-migrations"
php artisan migrate
```

You can publish the config file with:
```bash
php artisan vendor:publish --tag="entity-details-config"
```


This is the contents of the published config file:

```php
return [
    'table_name' => env('ENTITYDETAIL_TABLE_NAME', 'entity_details'),
    'returns_soft_deleted_models' => env('ENTITYDETAIL_SOFTDETED_ENABLE', false),
];
```

## Usage

Add the traits `EntityDetail` and `EntityDetailHydrate` in your related Model:

```php
class User extends Authenticatable
{
    [...]
    use EntityDetail, EntityDetailHydrate;
    [...]
}

[...]

class Biker extends Model
{
    [...]
    use EntityDetail, EntityDetailHydrate;
    [...]
}

[...]

class Company extends Model
{
    [...]
    use EntityDetail, EntityDetailHydrate;
    [...]
}
```

In your `Controller` you can simply save or update detail with the method `syncDetail($detail)`:  
```php
    [...]
    $user = User::create([
        'name' => 'John',
        'email' => 'Doe',
        'password' => Hash::make('password')
    ]);
    
    $user->syncDetail([
        'is_company' => true,
        'status' => 1,
        'code' => 'CODE',
        'name' => 'DUMMY COMPANY',
    ]);
    
    $user->fresh('detail');

    $detail = $user->detail;
    [...]
```

or

```php
    [...]
    $company = Company::with('detail')->first();
    
    $company->syncDetail([
        'is_company' => true,
        'status' => 1,
        'code' => 'CODE',
        'name' => 'DUMMY COMPANY',
    ]);

    $detail = $company->detail;
    [...]
```

## Relations
Traits help you to walk into relations:

```php
    $detail = Detail::with('owner')->get();
    $user = $detail->owner;

    [...]

    $biker = Biker::with('detail')->first();
    $detail = $biker->detail;
    [...]

```

## Scopes
Traits help you to use company and owner scope:

```php
    $details = Detail::where('status', 1)->isCompany()->get();
    [...]
    
    $user = User::where('email', 'john@doe.com')->first();
    $detail = Detail::forOwner($user)->first();
    [...]
```

## Rules
You can overwrite the `$rules` as you wish in your model, the validator will do the rest

## Migration
Feel free to add or delete fields for Detail entity but remember to edit also the `$rules`.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Daniele Barbaro](https://github.com/danielebarbaro)
- [All Contributors](../../contributors)

Thanks a lot to [Spatie](https://github.com/spatie) ❤️ for making my life easier

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
