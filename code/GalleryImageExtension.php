<?php

/**
 * Class GalleryImageExtension
 *
 * @property Image|GalleryImageExtension $owner
 */
class GalleryImageExtension extends DataExtension
{
	
	private static $db = array(
		'Caption'	=> 'Text',
	);
	
	private static $belongs_many_many = array(
		'GalleryPage'	=> 'GalleryPage',
	);
	
	public function updateCMSFields(FieldList $fields)
	{
		$fields->addFieldToTab('Root.Main', new TextField('Caption', 'Kuvateksti'), 'Title');
		$fields->removeFieldsFromTab('Root.Main', array('Title','Name','OwnerID','ParentID'));
	}
	
	public function GalleryThumbnail()
	{
		return $this->owner->Fit($this->GalleryThumbnailWidth(), $this->GalleryThumbnailHeight());
	}
	
	public function GalleryThumbnailWidth()
	{
		return (int) GalleryImage::config()->get('thumbnail_width');
	}
	
	public function GalleryThumbnailHeight()
	{
		return (int) GalleryImage::config()->get('thumbnail_height');
	}
	
	public function BootstrapCSSColumnClasses()
	{
		$columns = GalleryImage::config()->get('thumbnail_cols');
		$result = '';
		foreach ($columns as $type => $size)
		{
			if ($result) $result .= ' ';
			$result .= "col-$type-$size"; //For example: col-md-12
		}
		return $result;
	}
	
	
}
