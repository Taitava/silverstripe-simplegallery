<?php

// Support SilverStripe versions lower than 3.7:
if (!class_exists('SS_Object')) class_alias('Object', 'SS_Object');

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
class GalleryImage extends SS_Object // If SilverStripe version is lower than 3.7, SS_Object will be an alias for Object class. In SS 3.7 SS_Object is a real class.
{
	/**
	 * @conf int
	 */
	private static $thumbnail_width		= 150;
	
	/**
	 * @conf int
	 */
	private static $thumbnail_cols		= array('xs' => 12, 'sm' => 3, 'md' => 3, 'lg' => 2, 'xl' => 1);
	
	/**
	 * @conf int
	 */
	private static $thumbnail_height	= 250;
}
