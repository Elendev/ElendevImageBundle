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


namespace Elendev\ImageBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * Manage default bundle parameters
 * 
 * @author Jonas Renaudot <www.elendev.com>
 */
class ElendevImageExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container){
        
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        
        $mainPath = realpath(__DIR__ . "/../../../../web/medias");
        
        
        
        $config = array();
        
        foreach ($configs as $subConfig) {
            $config = array_merge($config, $subConfig);
        }
        
        
        
        
        if(isset($config["cache_dir"])){
            $container->setParameter("elendev.image.cacheDirectory", $config["cache_dir"]);
        }else{
            $container->setParameter("elendev.image.cacheDirectory", $mainPath . "/cache");
        }
        
        
        if(isset($config["source_dir"])){
            $container->setParameter("elendev.image.sourceDirectory", $config["source_dir"]);
        }else{
            $container->setParameter("elendev.image.sourceDirectory", $mainPath ."/images");
        }
        
        
        if(isset($config["cache_url"])){
            $container->setParameter("elendev.image.cacheUrl", $config["cache_url"]);
        }else{
            $container->setParameter("elendev.image.cacheUrl", "/web/medias/cache");
        }
        
    }
}
