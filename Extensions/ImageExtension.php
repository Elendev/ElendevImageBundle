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

namespace Elendev\ImageBundle\Extensions;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Elendev\ImageBundle\ImageManager;
use Elendev\ImageBundle\Image;
use Elendev\ImageBundle\ImageProxyFactory;
/**
 * Twig extension
 *
 * @author Jonas Renaudot <www.elendev.com>
 */
class ImageExtension extends \Twig_Extension {
    //put your code here
    
    /**
     *
     * @var ImageProxyFactory
     */
    private $factory;
    
    
    public function getName(){
        return "ElendevImageExtensions";
    }
    
    
    public function __construct(ImageProxyFactory $factory){
        $this->factory = $factory;
    }
    
    public function getFunctions(){
        return array(
            'image' => new \Twig_Function_Method($this, 'image', array('is_safe' => array('html')))
        );
    }
    
    
    public function image($path){
        return $this->factory->getImageProxy($path);
    }
}


