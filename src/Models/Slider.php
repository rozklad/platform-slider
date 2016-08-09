<?php namespace Sanatorium\Slider\Models;

use Cartalyst\Attributes\EntityInterface;
use Illuminate\Database\Eloquent\Model;
use Platform\Attributes\Traits\EntityTrait;
use Cartalyst\Support\Traits\NamespacedEntityTrait;
use StorageUrl;

class Slider extends Model implements EntityInterface {

	use EntityTrait, NamespacedEntityTrait;

	/**
	 * {@inheritDoc}
	 */
	protected $table = 'sliders';

	/**
	 * {@inheritDoc}
	 */
	protected $guarded = [
		'id',
	];

	/**
	 * {@inheritDoc}
	 */
	protected $with = [
		'values.attribute',
	];

	/**
	 * {@inheritDoc}
	 */
	protected static $entityNamespace = 'sanatorium/slider.slider';

	public function getImageUrlAttribute()
	{
		if ( !$this->slider_image )
			return false;

		$medium = app('platform.media')->find($this->slider_image);

		if ( !is_object($medium) )
			return false;

		return storage_url($medium->path);
	}

}
