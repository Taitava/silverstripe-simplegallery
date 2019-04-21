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
	private static $table_name = 'GalleryImageGroup';
	
	private static $singular_name = 'Kuvaryhmä';
	
	private static $plural_name = 'Kuvaryhmät';
	
	private static $db = [
		'Title' => 'Varchar(255)',
	];
	
	private static $many_many = [
		'Images' => 'Image',
	];
	
	private static $many_many_extraFields = [
		'Images' => [
			'SortOrder' => 'Int',
		],
	];
	
	private static $belongs_many_many = [
		'GalleryPages' => 'GalleryPage',
	];
	
	private static $field_labels = [
		'Title' => 'Otsikko',
		'Images' => 'Kuvat',
	];
	
	public function getCMSFields()
	{
		$fields = parent::getCMSFields();
		
		$fields->addFieldsToTab('Root.Main', [
			new TextField('Title', 'Otsikko'),
			GalleryPage::NewUploadField(),
		]);
		
		return $fields;
	}
	
}