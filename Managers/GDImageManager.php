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
use Elendev\ImageBundle\ImageManager;

/**
 * Manage image modification with GD library
 * 
 * @author Jonas Renaudot <www.elendev.com>
 */
class GDImageManager implements ImageManager
{

    /**
     * Return the current image resource
     */
    public function getImage(Image $image)
    {

        switch ($image->getType()) {
            case Image::TYPE_JPG:
                $resource = imagecreatefromjpeg($image->getPath());
                break;
            case Image::TYPE_PNG:
                $resource = imagecreatefrompng($image->getPath());

                break;
            case Image::TYPE_GIF:
                $resource = imagecreatefromgif($image->getPath());
                break;
        }

        return new GDImageResource($image, $resource);
    }

    /**
     * return the image size
     * @param Image $image 
     * @return array($width, $height)
     */
    public function getImageSize(Image $image)
    {
        $size = getimagesize($image->getPath());

        return array($size[0], $size[1]);
    }

    /**
     * Resize the current picture
     * @param type $resource
     * @param type $width
     * @param type $height
     */
    public function resize($resource, $width, $height)
    {

        $source = $resource->getSource();

        $newResource = @imagecreatetruecolor($width, $height);
        imagealphablending($newResource, false);
        imagesavealpha($newResource, true);

        $col = imagecolorallocatealpha($newResource, 255, 255, 255, 127);
        imagecolortransparent($newResource, $col);

        imagefilledrectangle($newResource, 0, 0, $width, $height, $col);
        @imagecopyresampled($newResource, $resource->getResource(), 0, 0, 0, 0, $width, $height, $source->getWidth(), $source->getHeight());

        $resource->setResource($newResource);
    }

    /**
     * do a rotation of the current picture
     * @param type $resource
     * @param type $degrees
     * @param type $bgcolor 
     */
    public function rotate($resource, $degrees, $bgcolor)
    {
        $newResource = @imagerotate($resource->getResource(), $degrees, $bgcolor);
        $resource->setResource($newResource);
    }

    /**
     * Convert to greyscale
     */
    public function greyScale($resource)
    {
        @imagefilter($resource->getResource(), IMG_FILTER_GRAYSCALE);
    }

    /**
     * Save the current resource to the destination file
     */
    public function save($resource, $destination)
    {

        switch ($resource->getSource()->getType()) {
            case Image::TYPE_JPG:
                @imagejpeg($resource->getResource(), $destination);
                break;
            case Image::TYPE_PNG:
                @imagepng($resource->getResource(), $destination);
                break;
            case Image::TYPE_GIF:
                @imagegif($resource->getResource(), $destination);
                break;
        }
    }

}
