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
 * Instances of this class are returned when using {{image}} tag on twig.
 * Allow to edit image properties through fluent interface
 *
 * @author Jonas Renaudot <www.elendev.com>
 */
interface ImageProxy {
    //put your code here
    
    
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
    
    //public function rotate($angle, $bgdColor){
    //    
    //}
    
    public function getUrl();
    
    /**
     * Generate the current cache file corresponding to the picture
     */
    public function generate();
    
    /**
     * return image's url
     */
    public function __toString();

}
