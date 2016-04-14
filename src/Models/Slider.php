<?php namespace Sanatorium\Slider\Models;

use Cartalyst\Attributes\EntityInterface;
use Illuminate\Database\Eloquent\Model;
use Platform\Attributes\Traits\EntityTrait;
use Cartalyst\Support\Traits\NamespacedEntityTrait;

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

	public function image()
	{
		return $this->belongsTo('Platform\Media\Models\Media', 'media_id');
	}

}
