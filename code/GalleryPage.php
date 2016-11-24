<?php

/**
 * Class GalleryPage
 *
 * @method DataList Images()
 */
class GalleryPage extends Page
{
	/**
	 * If true, require Bootstrap's CSS and JS files from this module's vendor folder. If you have already included
	 * bootstrap in your theme, keep this off.
	 *
	 * @conf bool
	 */
	private static $require_bootstrap = false;
	
	private static $many_many = array(
		'Images' => 'Image',
	);
	
	private static $many_many_extraFields = array(
		'Images' => array(
			'SortOrder' => 'Int',
		),
	);
	
	public function singular_name()
	{
		return 'Galleriasivu';
	}
	
	public function plural_name()
	{
		return 'Galleriasivut';
	}
	
	public function getCMSFields()
	{
		$fields = parent::getCMSFields();
		$fields->removeFieldFromTab('Root.Main', 'RightContent');
		$fields->removeFieldFromTab('Root.Main', 'HeaderImage');
		$fields->addFieldToTab(
			'Root.Main',
			$uploadField = new SortableUploadField(
				$name = 'Images',
				$title = 'Gallerian kuvat'
			),
			'Content'
		);
		$uploadField->setAllowedMaxFileNumber(1000);
		$uploadField->setFolderName('Galleria');
		$uploadField->setAllowedExtensions(array('jpg', 'jpeg', 'png', 'gif', 'tiff'));
		$uploadField->setPreviewMaxWidth(126);
		$uploadField->setPreviewMaxHeight(123);
		$fields->removeByName('CombineSubpages');
		return $fields;
	}
	
}

class GalleryPage_Controller extends Page_Controller
{
	public function init()
	{
		parent::init();
		
		Requirements::css('simplegallery/css/lightbox.css');
		Requirements::css('simplegallery/css/gallery.css');
		Requirements::javascript('framework/thirdparty/jquery/jquery.min.js');
		Requirements::javascript('simplegallery/js/modernizr.custom.js');
		Requirements::javascript('simplegallery/js/lightbox-2.6.min.js');
		$this->RequireBootstrap();
	}
	
	private function RequireBootstrap()
	{
		if (GalleryPage::config()->get('require_bootstrap'))
		{
			Requirements::css('simplegallery/vendor/bootstrap/css/bootstrap.min.css');
			Requirements::css('simplegallery/vendor/bootstrap/css/bootstrap-theme.min.css');
			Requirements::javascript('simplegallery/vendor/bootstrap/js/bootstrap.min.js');
		}
	}
}

?>
