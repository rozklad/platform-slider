<?php namespace Sanatorium\Slider\Handlers\Slider;

use Sanatorium\Slider\Models\Slider;
use Cartalyst\Support\Handlers\EventHandlerInterface as BaseEventHandlerInterface;

interface SliderEventHandlerInterface extends BaseEventHandlerInterface {

	/**
	 * When a slider is being created.
	 *
	 * @param  array  $data
	 * @return mixed
	 */
	public function creating(array $data);

	/**
	 * When a slider is created.
	 *
	 * @param  \Sanatorium\Slider\Models\Slider  $slider
	 * @return mixed
	 */
	public function created(Slider $slider);

	/**
	 * When a slider is being updated.
	 *
	 * @param  \Sanatorium\Slider\Models\Slider  $slider
	 * @param  array  $data
	 * @return mixed
	 */
	public function updating(Slider $slider, array $data);

	/**
	 * When a slider is updated.
	 *
	 * @param  \Sanatorium\Slider\Models\Slider  $slider
	 * @return mixed
	 */
	public function updated(Slider $slider);

	/**
	 * When a slider is deleted.
	 *
	 * @param  \Sanatorium\Slider\Models\Slider  $slider
	 * @return mixed
	 */
	public function deleted(Slider $slider);

}
