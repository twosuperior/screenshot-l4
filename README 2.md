# Bookability L4 API support for Laravel

----

The package supports use with the [Laravel framework][2] (v4) providing a `Bookability` facade.

----

###Setup:

In order to install add the following to your `composer.json` file within the `require` block:

	"require": {
		…
		"bookability/bookability-l4": "1.0.*",
		…	
	}

Within Laravel, locate the file `..app/config/app.php` *.

Add the following to the `providers` array:

	'providers' => array(
		…
		'Bookability\BookabilityL4\BookabilityServiceProvider',
		…
	),

Furthermore, add the following the the `aliases` array:

	'aliases' => array(
		…
		'Bookability' => 'Bookability\BookabilityL4\Facades\Bookability',
		…
	),
	
Publish the configuration

	$ php artisan config:publish bookability/bookability-l4

Lastly, run the command `composer update`.

_\* The subsequent steps should be repeated for any file `app.php` created for additional environments._

----