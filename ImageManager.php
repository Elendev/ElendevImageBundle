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
 * Manage image modifications with specific libraries.
 * New library support should inherit this class.
 *
 * @author Jonas Renaudot <www.elendev.com>
 */
interface ImageManager {
    
    /**
     * Return the current image resource
     */
    public function getImage(Image $image);
    
    /**
     * Return the image size
     * @return array($width, $height)
     */
    public function getImageSize(Image $image);
    
    /**
     * return current image ressource
     */
    public function resize($resource, $width, $height);

    /**
     * Do a rotation
     * Return current image resource
     */
    public function rotate($resource, $degrees, $bgcolor);
    
    
    /**
     * Convert to greyscale
     */
    public function greyScale($resource);
    
    /**
     * Save the given resource to the destination file
     */
    public function save($resource, $destination);
}


