# Laravel One Time Password 
Quickly allows you to create one time personal access tokens, that are revoked after one use.

## Laravel compatibility

 Laravel  | Laravel One Time Token
:---------|:----------
 5.4+     | ^0.1.0
 
## Installation

Install the package through [Composer](http://getcomposer.org/). Edit your project's `composer.json` file by adding:

    {
	    "require": {
	        ........,
	        "lukepolo/laravel-passport-one-time-token": "^0.0.3"
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
2. Middleware 
   * The default middleware assumes you are consuming this with 
   `auth:api`. 
   * You can change this in your config
3. Created at least one Personal Token client. 

### Usage
Make a post to 
```
    oauth/one-time/create
``` 

This will send back your token, which you can use to make another request. Once used it will be revoked. 

License
----
MIT
