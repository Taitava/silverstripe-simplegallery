<?php

namespace Taitava\SimpleGallery;

use Bummzack\SortableFile\Forms\SortableUploadField;
use Page;
use PageController;
use SilverStripe\Assets\Image;
use SilverStripe\Core\ClassInfo;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Forms\Tab;
use SilverStripe\ORM\ArrayList;
use SilverStripe\ORM\DataList;
use SilverStripe\View\Requirements;

/**
 * Class GalleryPage
 *
 * @method DataList Images()
 * @method DataList GalleryImageGroups()
 */
class GalleryPage extends Page
{
	private static $table_name = 'GalleryPage';
	
	/**
	 * Whether to inject bootstrap CSS classes to GalleryPage content. You can perform well without this if you
	 * set 'use_flexbox' to true, but only newest browsers support that. Both 'use_bootstrap' and 'use_flexbox' can
	 * be used together, too.
	 *
	 * @conf bool
	 */
	private static $use_bootstrap = true;
	
	/**
	 * Whether to use flexbox CSS rules to center images both horizontally and vertically. This solves problems if you
	 * have images with different heights, but is only supported by newest browsers.
	 *
	 * @conf bool
	 */
	private static $use_flexbox = true;
	
	/**
	 * If true, require Bootstrap's CSS and JS files from this module's vendor folder. If you have already included
	 * bootstrap in your theme, keep this off.
	 *
	 * @conf bool
	 */
	private static $require_bootstrap = false;
	
	
	/**
	 * If true, a single GalleryPage can be divided to multiple image sections. It's false by default to keep the default
	 * setup simple as the module name suggests. :)
	 *
	 * @var bool
	 */
	private static $allow_image_groups = false;
	
	
	/**
	 * This option is used to control whether if it's possible to link images directly to a GalleryPage without using
	 * an image group in between. If $allow_image_groups is false, then this option has no effect and direct images are
	 * obviously always allowed.
	 *
	 * @var bool
	 */
	private static $allow_direct_images = false;
	
	private static $many_many = [
		'Images' => Image::class,
		'GalleryImageGroups' => GalleryImageGroup::class,
	];
	
	private static $many_many_extraFields = [
		'Images' => [
			'SortOrder' => 'Int',
		],
		'GalleryImageGroups' => [
			'SortOrder' => 'Int',
		],
	];
	
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
		
		//Remove some fields
		$fields->removeFieldFromTab('Root.Main', 'RightContent'); //TODO: what is this?
		$fields->removeFieldFromTab('Root.Main', 'HeaderImage'); //TODO: what is this?
		$fields->removeByName('CombineSubpages'); //TODO: what is this?
		
		if (self::DirectImagesAllowed()) $fields->addFieldToTab('Root.Main', self::NewUploadField(), 'Content');
		if (self::ImageGroupsAllowed())
		{
			$grid_field_config = new GridFieldConfig_RecordEditor();
			$grid_field = new GridField('GalleryImageGroups', 'Kuvaryhmät', $this->GalleryImageGroups(), $grid_field_config);
			$fields->addFieldToTab('Root', new Tab('GalleryImageGroups', 'Kuvaryhmät'));
			$fields->addFieldToTab('Root.GalleryImageGroups', $grid_field);
			$sortable_rows_class = '\UndefinedOffset\SortableGridField\Forms\GridFieldSortableRows'; // Do not use GridFieldSortableRows::class because the class does not always exist as it belongs to an optional module.
			if (ClassInfo::exists($sortable_rows_class))
			{
				$grid_field_config->addComponent(new $sortable_rows_class('SortOrder'));
			}
		}
		
		return $fields;
	}
	
	public static function DirectImagesAllowed()
	{
		return self::config()->get('allow_direct_images') || !self::config()->get('allow_image_groups');
	}
	
	public static function ImageGroupsAllowed()
	{
		return self::config()->get('allow_image_groups');
	}
	
	/**
	 * Puts together images that are linked directly to this GalleryPage and images that are linked to this GalleryPage
	 * via GalleryImageGroups. Note that this method does not use GroupedList! Instead it uses a custom ArrayList structure:
	 * array(
	 *   GroupID => array(
	 *     'Title' => string
	 *     'Images' => a <% loop %> able array of images in this group
	 *   )
	 * )
	 *
	 * If this GalleryPage contains any "direct images", those are placed in a pseudo group at the beginning of the
	 * whole array. The pseudo group has no title.
	 *
	 * @return ArrayList
	 */
	public function GroupedImages()
	{
		$images = [];
		if ($this->Images()->exists())
		{
			$images[] = [
				'Title' => '',
				'Images' => new ArrayList($this->Images()->sort('SortOrder')->toArray()),
			];
		}
		/** @var GalleryImageGroup $group */
		foreach ($this->GalleryImageGroups()->sort('SortOrder') as $group)
		{
			$images[] = [
				'Title' => $group->Title,
				'Images' => new ArrayList($group->Images()->sort('SortOrder')->toArray()),
			];
		}
		return new ArrayList($images);
	}
	
	public function BootstrapHeaderCSSClass()
	{
		return GalleryPage::config()->get('use_bootstrap') ? 'col-xl-12' : '';
	}
	
	public function BootstrapRowCSSClass()
	{
		return GalleryPage::config()->get('use_bootstrap') ? 'row' : '';
	}
	
	public static function NewUploadField()
	{
		$upload_field = new SortableUploadField(
			$name = 'Images',
			$title = 'Gallerian kuvat'
		);
		$upload_field->setAllowedMaxFileNumber(1000);
		$upload_field->setFolderName('Galleria');
		$upload_field->setAllowedExtensions(['jpg', 'jpeg', 'png', 'gif', 'tiff']);
		$upload_field->setPreviewMaxWidth(126);
		$upload_field->setPreviewMaxHeight(123);
		return $upload_field;
	}
}

class GalleryPageController extends PageController
{
	public function init()
	{
		parent::init();
		
		Requirements::css('simplegallery/vendor/lightbox/dist/css/lightbox.min.css');
		Requirements::css('simplegallery/css/gallery.css');
		Requirements::javascript('framework/thirdparty/jquery/jquery.min.js');
		Requirements::javascript('simplegallery/vendor/lightbox/dist/js/lightbox.min.js');
		$this->RequireBootstrap();
		$this->RequireFlexbox();
	}
	
	private function RequireBootstrap()
	{
		if (GalleryPage::config()->get('require_bootstrap') && GalleryPage::config()->get('use_bootstrap'))
		{
			Requirements::css('simplegallery/vendor/bootstrap/css/bootstrap.min.css');
			Requirements::css('simplegallery/vendor/bootstrap/css/bootstrap-theme.min.css');
			Requirements::javascript('simplegallery/vendor/bootstrap/js/bootstrap.min.js');
		}
	}
	
	private function RequireFlexbox()
	{
		if (GalleryPage::config()->get('use_flexbox'))
		{
			Requirements::css('simplegallery/css/flexbox.css');
		}
	}
}

?>
