<?php namespace Orchestra\Testbench\TestCase;

class ScreenshotTest extends \Orchestra\Testbench\TestCase
{
    /**
     * Define environment setup.
     *
     * @param  Illuminate\Foundation\Application    $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
	    $app['path.base'] = realpath(__DIR__ . '/../src');
	    $app['path.storage'] = realpath(__DIR__ . '/../src/storage');
		$app['config']->set('screenshot::phantom_path', realpath(__DIR__ . '/../vendor/bin/phantomjs'));
		$app['config']->set('screenshot::wait_time', 3000);
		$app['config']->set('screenshot::screenshot_path', __DIR__ . '/../src/storage/screenshots');
    }

    /**
     * Get package providers.  At a minimum this is the package being tested, but also
     * would include packages upon which our package depends, e.g. Cartalyst/Sentry
     * In a normal app environment these would be added to the 'providers' array in
     * the config/app.php file.
     *
     * @return array
     */
    protected function getPackageProviders()
    {
        return array(
            'Twosuperior\Screenshot\ScreenshotServiceProvider',
        );
    }
   
    /**
     * Test running migration.
     *
     * @test
     */
    public function testTakeScreenshot()
    {
		// get events
		$screenshot = \Screenshot::take('http://www.twosuperior.co.uk');

		// has results
        $this->assertTrue((bool) $screenshot);
    }
}
