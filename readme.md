# Laravel One Time Password 

## Features
* Quickly allows you to create one time personal access tokens

## Laravel compatibility

 Laravel  | Laravel One Time Token
:---------|:----------
 5.4+     | 1.0.0
 
## Installation

Install the package through [Composer](http://getcomposer.org/). Edit your project's `composer.json` file by adding:

    {
	    "require": {
	        ........,
	        "lukepolo/laravel-one-time-token": "1.0.*"
	    }
    }

If using 5.4 you will need to include the service providers / facade in `app/config/app.php`:

```php
    LukePOLO\LaravelPassportOneTimeToken\ServiceProvider::class,
```

Copy over the configuration file by running the command:

```php
    php artisan vendor:publish --provider='LukePOLO\LaravelPassportOneTimeToken\ServiceProvider'
```

### Requirements

Out of the box we provided some defaults to get you started.

1. The user must be logged in  
2. Middlware 
   * The default middleware assumes you are consuming this with 
   `auth:api`. 
   * You can change this in your config


### Usage
Make a post to 
```
    oauth/one-time/create
``` 

This will send back your token , which you can use to make another request. Once used it will be revoked. 

License
----
MIT