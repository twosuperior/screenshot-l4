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
		//
	    $app['path.base'] = __DIR__ . '/../src';
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
		echo base_path();
		exit;
		// get events
		$test = \Screenshot::take('http://www.google.co.uk');
		
		echo $test;
		exit;
		// has results
        // $this->assertTrue(count($events) > 0);
    }
}
