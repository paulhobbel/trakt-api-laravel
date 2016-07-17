# Trakt API for Laravel 5
[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE)
[![Total Downloads][ico-downloads]][link-downloads]

This is a library to use the [Trakt API](http://docs.trakt.apiary.io/) in Laravel 5

## Setup
To install this library you need to use composer, you can get it from [here](https://getcomposer.org/download/).

When you have that installed which you probably already have since you already made a laravel project,
you can run the following command:
```bash
composer require itsdizzy/trakt dev-master
```

Like any laravel library you have to tell laravel how it has to use it.

To do this you have to add the service provider to the `providers` array in `config/app.php`
```php
Dizzy\Trakt\TraktServiceProvider::class
```
You also have to add a facade to the `aliases` array in `config/app.php`
```php
'Trakt' => Dizzy\Trakt\Facades\Trakt::class,
```
Now laravel knows which bindings it has to create and which config files it has to load,
and it made a nice little alias so you can just use the `Trakt` facade in your code.

Trakt also requires at least a api key, you can get one by creating a new application [here](https://trakt.tv/oauth/applications).
Now open your `.env` file and add set the `TRAKT_CLIENT_ID` with your client id
```
TRAKT_CLIENT_ID=yourclientidhere
```
Now you are all set to use the api.

## Usage
```
<?php

namespace App\Http\Controllers;

use Trakt;

class MoviesController extends Controller
{
    /**
     * @param $id
     * @return array
     */
    public function getMovie($id)
    {
        $movie = Trakt::movies()->withImages()->get($id);

        return [
            'movie' => $movie->toArray(),
            'people' => $movie->people(),
            'releases' => $movie->releases()
        ];
    }
}

```
A better explanation will come soon.



[ico-version]: https://img.shields.io/packagist/vpre/itsdizzy/trakt-api.svg?style=flat-square
[ico-license]: https://img.shields.io/github/license/itsdizzy/trakt-api-laravel.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/itsdizzy/trakt-api.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/itsdizzy/trakt-api
[link-downloads]: https://packagist.org/packages/itsdizzy/trakt-api