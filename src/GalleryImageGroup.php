<?php

namespace Taitava\SimpleGallery;

use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataList;
use SilverStripe\ORM\DataObject;

/**
 * Class GalleryImageGroup
 * @method DataList Images()
 * @method DataList GalleryPages()
 *
 * @property string $Title
 */
class GalleryImageGroup extends DataObject
{
	private static $singular_name = 'Kuvaryhmä';
	
	private static $plural_name = 'Kuvaryhmät';
	
	private static $db = array(
		'Title' => 'Varchar(255)',
	);
	
	private static $many_many = array(
		'Images' => 'Image',
	);
	
	private static $many_many_extraFields = array(
		'Images' => array(
			'SortOrder' => 'Int',
		),
	);
	
	private static $belongs_many_many = array(
		'GalleryPages' => 'GalleryPage',
	);
	
	private static $field_labels = array(
		'Title' => 'Otsikko',
		'Images' => 'Kuvat',
	);
	
	public function getCMSFields()
	{
		$fields = parent::getCMSFields();
		
		$fields->addFieldsToTab('Root.Main', array(
			new TextField('Title', 'Otsikko'),
			GalleryPage::NewUploadField(),
		));
		
		return $fields;
	}
	
}