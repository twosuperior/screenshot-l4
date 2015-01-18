<?php namespace Twosuperior\Screenshot;

class Screenshot {

	/**
	 * Generate thumbnail for page
	 *
	 * @return string
	 */
	public function take($url)
	{
		// set up phantomjs
		$tempJsFileHandle = tmpfile();
		
		// get path
		$screenshot_path = \Config::get('screenshot::screenshot_path', storage_path('screenshots')) . '/' . md5($url);
		
		// ensure folders exists
		if (!\File::exists(storage_path() . '/temp/')) \File::makeDirectory(storage_path() . '/temp/', 0775);
		if (!\File::exists($screenshot_path)) \File::makeDirectory($screenshot_path, 0775, true);
		
		// set up temp file
		$temp = storage_path() . '/temp/' . uniqid();
		
		// set up final desination
		$file = $screenshot_path . '/original.png';
			
		// build phantomjs command
		$fileContent= "
			var page = require('webpage').create();
			page.settings.javascriptEnabled = true;
			page.viewportSize = { width: " . 1024 . ", height: " . 768 . " };
			page.open('" . $url . "', function() {
				window.setTimeout(function(){
					page.render('" . $file . "');
					phantom.exit();
				}, " . \Config::get('screenshot::wait_time', 3000) . ");
			});";
		
		// temp file created
		if (file_put_contents($temp, $fileContent))
		{
			// execute file
			$cmd = escapeshellcmd(\Config::get('screenshot::phantom_path', base_path('vendor/bin/phantomjs')) . " " . $temp);
			shell_exec($cmd);

			// start image
			$image = \Intervention\Image\Facades\Image::make($file);

			// auto crop image
			$image->fit(800, 600, null, 'top');
		
			// save
			$image->save($screenshot_path . '/large.png');
			
			// auto crop image
			$image->fit(400, 300, null, 'top');
		
			// save
			$image->save($screenshot_path . '/medium.png');
			
			// auto crop image
			$image->fit(200, 150, null, 'top');
		
			// save
			$image->save($screenshot_path . '/small.png');
			
	 	    // remove after end
		    if (\File::exists($temp)) \File::delete($temp);
			
			// return
			return md5($url);
		}
		
		// failed creating file
		return false;
	}
}
