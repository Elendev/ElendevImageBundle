ElendevImageBundle
=====================

Bundle configuration
--------------------
	elendev_image:
	    cache_dir: 'path_to_cache_directory'
    	source_dir: 'path_to_image_dir'
    	cache_url: 'url/to/cache/dir'
    	
The `cache_dir` configuration key is the local path to the cache directory. It's the directory where the generated files will be stored (for example : `/var/www/my-website/media/cache`)
The `source_dir` configuration key is the local path to the directory containing the images (for example : `/var/www/my-website/media/original-files`)
The `cache_url` configuration key is the url to the cache directory. If the url `http://www.my-website.com` redirect to the local `/var/www/my-website` directory, the value of this configuration key would be `http://www.my-website.com/media/cache`.

Use Twig's extension image method
---------------------------------

`<img src="{{image('source')}}"/>`

`<img src="{{image('source').resize(200, 200)}}"/>`

`<img src="{{image('source').rotate(180).greyScale()}}"/>`

The available methods are those of the `Elendev\ElendevImageBundle\ImageProxy` class :

	interface ImageProxy {
	
	    ...
	    
	    public function resize($width, $height, $keepRatio = true, $allowEnlarge = false);
	    
	    /**
	     * @param type $degree
	     * @param type $bgcolor background color for visible parts, by default black
	     */
	    public function rotate($degree, $bgcolor = 0);
	    
	    /**
	     * Do greyscale on picture
	     */
	    public function greyScale();
	
	    ...
	
	}
