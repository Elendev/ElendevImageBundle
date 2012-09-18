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

namespace Elendev\ImageBundle\Managers;

use Elendev\ImageBundle\Image;

/**
 * Represent an image file, keep a reference to the image source corresponding to
 * the resource.
 *
 * @author Jonas Renaudot <www.elendev.com>
 */
class GDImageResource {
    
    private $source;
    
    private $resource;
    
    public function __construct(Image $source, $resource){
        $this->source = $source;
        $this->resource = $resource;
    }
    
    public function getSource() {
        return $this->source;
    }

    public function setSource($source) {
        $this->source = $source;
    }

    public function getResource() {
        return $this->resource;
    }

    public function setResource($resource) {
        $this->resource = $resource;
    }


}


