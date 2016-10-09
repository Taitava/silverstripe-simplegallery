<?php

/**
 * Class GalleryImage
 *
 * This class is just for configuration options. Note that this class defines default values. To change the values in your
 * project, please do it in mysite/_config/simplegallery.yml by adding these lines:
 *
 * GalleryImage:
 *   thumbnail_width: your-custom-value
 *   thumbnail_height: your-custom-value
 *   caption_height: your-custom-value
 *
 */
class GalleryImage extends Object
{
	/**
	 * @conf int
	 */
	private static $thumbnail_width		= 150;
	
	/**
	 * @conf int
	 */
	private static $thumbnail_height	= 250;
	
	/**
	 * @conf int
	 */
	private static $caption_height		= 150;
}