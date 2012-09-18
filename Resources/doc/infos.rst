========
Overview
========

This bundle add the 'image' function to TWIG.

You will find more informations on http://www.elendev.com or on http://code.google.com/p/elendev-image-bundle/.

Installation
------------

Add Elendev path to autoload :
    // app/autoload.php
    $loader->registerNamespaces(array(
        // ...
        'Elendev'              => __DIR__.'/../src',
        // ...
    ));

Load bundle on kernel :
    // in AppKernel::registerBundles()
    $bundles = array(
    	// ...
    	new Elendev\ImageBundle\ElendevImageBundle(),
    	// ...
	);

Configuration
-------------
elendev_image:
    cache_dir: 'path_to_cache_directory'
    source_dir: 'path_to_image_dir'
    cache_url: 'url/to/cache/dir'