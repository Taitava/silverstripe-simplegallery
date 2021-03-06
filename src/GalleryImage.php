<?php

namespace Taitava\SimpleGallery;

use SilverStripe\Core\Config\Configurable;

/**
 * Class GalleryImage
 *
 * This class is just for configuration options. Note that this class defines default values. To change the values in your
 * project, please do it in mysite/_config/simplegallery.yml by adding these lines:
 *
 * GalleryImage:
 *   thumbnail_width: *your-custom-value*
 *   thumbnail_cols:
 *     xs: *your custom value from 1 to 12*
 *     sm: *your custom value from 1 to 12*
 *     md: *your custom value from 1 to 12*
 *     lg: *your custom value from 1 to 12*
 *     xl: *your custom value from 1 to 12*
 *   thumbnail_height: *your-custom-value*
 *
 */
class GalleryImage
{
	use Configurable;
	
	/**
	 * @conf int
	 */
	private static $thumbnail_width		= 150;
	
	/**
	 * @conf int
	 */
	private static $thumbnail_cols		= ['xs' => 12, 'sm' => 3, 'md' => 3, 'lg' => 2, 'xl' => 1];
	
	/**
	 * @conf int
	 */
	private static $thumbnail_height	= 250;
}