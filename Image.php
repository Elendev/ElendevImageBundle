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
 * Represent an Image file resource
 * @author Jonas Renaudot <www.elendev.com>
 */
class Image {
    
    const TYPE_JPG = 0;
    const TYPE_PNG = 1;
    const TYPE_GIF = 2;
    
    private $path;
    private $width;
    private $height;
    
    private $type;
    
    private $fileName;
    private $extension;
    private $dirName;
    
    
    public function __construct($path){
        $this->path = $path;
        
        $pathinfo = pathinfo($path);
        
         $this->fileName = $pathinfo["filename"];
        $this->dirName = $pathinfo["dirname"];
        $this->extension = $pathinfo["extension"];
        
        
        switch(strtolower($pathinfo["extension"])){
            case "jpg":
            case "jpeg":
                $this->type = self::TYPE_JPG;
                break;
            case "png":
                $this->type = self::TYPE_PNG;
                break;
            case "gif":
                $this->type = self::TYPE_GIF;
                break;
        }
       
    }
    
    public function getPath() {
        return $this->path;
    }

    public function setPath($path) {
        $this->path = $path;
    }

    public function getWidth() {
        return $this->width;
    }

    public function setWidth($width) {
        $this->width = $width;
    }

    public function getHeight() {
        return $this->height;
    }

    public function setHeight($height) {
        $this->height = $height;
    }
    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }
    
    public function getFileName() {
        return $this->fileName;
    }

    public function setFileName($fileName) {
        $this->fileName = $fileName;
    }

    public function getExtension() {
        return $this->extension;
    }

    public function setExtension($extension) {
        $this->extension = $extension;
    }

    public function getDirName() {
        return $this->dirName;
    }

    public function setDirName($dirName) {
        $this->dirName = $dirName;
    }
}

