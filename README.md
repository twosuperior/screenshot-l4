# Screenshot Package for Laravel 4

----

Screenshot tool for Laravel 4 using PhantomJS

----

## Installation

### Requirements:

	- Any flavour of PHP 5.3+ should do
	- illuminate/support 4.*
	- "intervention/image 2.*
	- jakoch/phantomjs-installer

### Setup With Composer:

In order to install, add the following to your `composer.json` file within the `require` block:

	"require": {
		…
		"twosuperior/screenshot": "1.0.*",
		…
	}

Within Laravel, locate the file `..app/config/app.php` *.

Add the following to the `providers` array:

	'providers' => array(
		…
		'Twosuperior\Screenshot\ScreenshotServiceProvider',
		…
	),

Furthermore, add the following the the `aliases` array:

	'aliases' => array(
		…
		'Screenshot' => 'Twosuperior\Screenshot\Facades\Screenshot',
		…
	),

Publish the configuration

	$ php artisan config:publish twosuperior/screenshot

Lastly, run the command `composer update`.