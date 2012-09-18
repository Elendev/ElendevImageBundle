ElendevImageBundle
=====================

Bundle configuration
--------------------
	elendev_image:
	    cache_dir: 'path_to_cache_directory'
    	source_dir: 'path_to_image_dir'
    	cache_url: 'url/to/cache/dir'
    	
I actually don't know a better way to guess the cache_url.

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