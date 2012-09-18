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
/**
 * Basic implementation of image proxy using image manager
 *
 * @author Jonas Renaudot <www.elendev.com>
 */
class SimpleImageProxy implements ImageProxy{
    //put your code here
    
    private $image;
    
    /**
     * @var ImageManager
     */
    private $manager;
    
    private $operations = array();
    
    private $cacheDirectory;
    
    private $cacheUrl;
    /**
     *
     * @param Image $image
     * @param ImageManager $manager
     * @param type $cacheDirectory withouth end slash
     */
    public function __construct(Image $image, ImageManager $manager, $cacheDirectory, $cacheUrl){
        $this->image = $image;
        $this->manager = $manager;
        
        $this->cacheDirectory = $cacheDirectory;
        $this->cacheUrl = $cacheUrl;
    }
    
    
    public function resize($width, $height, $keepRatio = true, $allowEnlarge = false){
        $this->operations["resize"] = $this->getNewSize($this->image, $width, $height, $keepRatio, $allowEnlarge);
        
        return $this;
    }
    
    /**
     * @param type $degree
     * @param type $bgcolor background color for visible parts, by default black
     */
    public function rotate($degree, $bgcolor = 0){
        $this->operations["rotate"] = array($degree, $bgcolor);
        
        return $this;
    }
    
    /**
     * Do greyscale on picture
     */
    public function greyScale(){
        $this->operations["greyScale"] = array();
        
        return $this;
    }
    
    //public function rotate($angle, $bgdColor){
    //    
    //}
    
    public function getUrl(){
        $filePath = $this->getPath();
        
        if(!file_exists($filePath)){
            $this->generate();
        }
        
        return $this->cacheUrl . "/" . $this->getRelativePath();
    }
    
    /**
     * Generate the current cache file corresponding to the picture
     */
    public function generate(){
        $resource = $this->manager->getImage($this->image);
        
        foreach($this->operations as $method => $params){
            $finalParams = array_merge(array($resource), $params);
            
            call_user_func_array(array($this->manager, $method), $finalParams);
        }
        
        $filePath = $this->getPath();
        
        if(!file_exists(dirname($filePath))){
            
            mkdir(dirname($filePath), 0777, true);
        }
        
        $this->manager->save($resource, $filePath);
    }
    
    /**
     * Get current proxy path
     */
    private function getPath(){
        return $this->cacheDirectory . "/" . $this->getRelativePath();
    }
    
    /**
     * Return the cache directory
     */
    private function getRelativePath(){
        return md5(realpath($this->image->getPath())) . "/" . $this->getFileName();
    }
    
    
    /**
     *
     * @return string current filename
     */
    private function getFileName(){
        $fileName = $this->image->getFileName();
        
        ksort($this->operations);
        
        foreach($this->operations as $key => $values){
            
            $fileName .= "." . $key . "_";
            
            if(!is_array($values)){
                $fileName .= $values;
            }else{
                $fileName .= implode("x", $values);
            }
        }
        
        $fileName .= "." . $this->image->getExtension();
        
        return $fileName;
    }
    
    /**
     * Calculate image size
     * @param Image $source
     * @param type $newWidth
     * @param type $newHeight
     * @param type $keepRatio
     * @param type $allowEnlarge
     * @return type 
     */
    private function getNewSize(Image $source, $newWidth, $newHeight, $keepRatio = true, $allowEnlarge = false){
        
        if($keepRatio){
            //bigger and can't go bigger : return current size
            if($newWidth > $source->getWidth() && $newHeight > $source->getHeight() && !$allowEnlarge){
                return array($source->getWidth(), $source->getHeight());
            }

            //based on width
            if($source->getWidth() / $newWidth > $source->getHeight() / $newHeight){
                $ratio = $source->getWidth() / $newWidth;
            }else{ //based on height
                $ratio = $source->getHeight() / $newHeight;
            }

            return array($source->getWidth() / $ratio, $source->getHeight() / $ratio);
        }else{
            if(!$allowEnlarge){
                return array(min($source->getWidth, $newWidth), min($source->getHeight(), $newHeight));
            }else{
                return array($newWidth, $newHeight);
            }
        }
        
    }
    
    /**
     * return image's url
     */
    public function __toString(){
        return $this->getUrl();
    }
    
}
