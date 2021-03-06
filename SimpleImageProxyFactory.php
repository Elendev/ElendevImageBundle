<?php
/**
 * Copyright 2012 Jonas Renaudot <www.elendev.com>
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Elendev\ImageBundle;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Basic implementation of image proxy factory. Generate a NoFileImageProxy when no file
 * is founded for given resource and a SimpleImageProxy otherwhise.
 *
 * @author Jonas Renaudot <www.elendev.com>
 */
class SimpleImageProxyFactory implements ImageProxyFactory {
    
    
    private $srcDir;
    private $cacheDir;
    
    private $cacheUrl;
    
    private $manager;
    
    /* @var $container ContainerInterface */
    private $container;

    /**
     *
     * @param type $sourceDirectry
     * @param type $cacheDirectory
     * @param type $cacheUrl
     */
    public function __construct($manager, $srcDir, $cacheDir, $cacheUrl, ContainerInterface $container){

        $this->manager = $manager;

        $this->container = $container;

        $this->srcDir = $srcDir;
        $this->cacheDir = $cacheDir;

        if (empty($cacheUrl)) {

            $assetsPackage = $container->get('assets.packages');

            $webDir = $container->getParameter("kernel.root_dir") . "/../web";
            $fs = new Filesystem();

            if (empty($assetsPackage)) {
                // Legacy for Symfony 2
                $assetsPackage = $container->get('templating.helper.assets');
            }

            if (!empty($assetsPackage)) {
                $cacheUrl = $assetsPackage->getUrl($fs->makePathRelative($cacheDir, $webDir));
            }
        }

        $this->cacheUrl = $cacheUrl;

    }



    /**
     *
     * @param type $path
     * @return \Elendev\ImageBundle\ImageProxy
     */
    public function getImageProxy($path){
        
        //No file available
        if(!file_exists($this->srcDir . "/" . $path) || is_dir($this->srcDir . "/" . $path)){
            return new NoFileImageProxy();
        }
        
        $image = new Image($this->srcDir . "/" . $path);
        
        
        list($width, $height) = $this->manager->getImageSize($image);
        
        $image->setWidth($width);
        $image->setHeight($height);
        
        return new SimpleImageProxy($image, $this->manager, $this->cacheDir, $this->cacheUrl);
    }
    
}

