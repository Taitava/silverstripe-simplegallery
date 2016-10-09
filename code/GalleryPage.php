<?php

/**
 * Class GalleryPage
 *
 * @method DataList Images()
 */
class GalleryPage extends Page
{
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
	
	function getCMSFields()
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
	
	public function leftImages() //TODO: Are these used anywhere?? If not, remove them.
	{
		$count = $this->Images()->Count();
		return $this->Images('','','', floor($count/2));
	}
	
	public function rightImages() //TODO: Are these used anywhere?? If not, remove them.
	{
		$count = $this->Images()->Count();
		return $this->Images('','','', floor($count/2).','.floor($count/2+1));
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
	}
}

?>
