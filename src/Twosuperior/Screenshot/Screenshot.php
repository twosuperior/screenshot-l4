<?php namespace Twosuperior\Screenshot;

use \Intervention\Image\Facades;

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
		
		// ensure folders exists
		if (!\File::exists(storage_path() . '/temp/')) \File::makeDirectory(storage_path() . '/temp/', 0775);
		if (!\File::exists(storage_path() . '/screenshots/' . md5($url))) \File::makeDirectory(storage_path() . '/screenshots/' . md5($url), 0775, true);
		
		// set up temp file
		$temp = storage_path() . '/temp/' . uniqid();
 
 	    // remove after end
	    \App::finish(function($request, $response) use ($temp)
	    {
	        unlink($temp);
	    });
		
		// set up final desination
		$file = storage_path() . '/screenshots/' . md5($url) . '/original.png';
			
		// build phantomjs command
		$fileContent= "
			var page = require('webpage').create();
			page.settings.javascriptEnabled = true;
			page.viewportSize = { width: " . 1024 . ", height: " . 768 . " };
			page.open('" . $url . "', function() {
				window.setTimeout(function(){
					page.render('" . $file . "');
					phantom.exit();
				}, 5000);
			});";
		
		// temp file created
		if (file_put_contents($temp, $fileContent))
		{
			// execute file
			$cmd = escapeshellcmd(base_path() . '/bin/phantomjs' . " " . $temp);
			shell_exec($cmd);

			// start image
			$image = Image::make($file);

			// auto crop image
			$image->fit(200, 150, null, 'top');
		
			// save
			$image->save(storage_path() . '/screenshots/' . md5($url) . '/200x150.png');
			
			// return
			return md5($url);
		}
		
		// failed creating file
		return false;
	}
}
