<?php namespace Sanatorium\Slider\Handlers\Slider;

use Illuminate\Events\Dispatcher;
use Sanatorium\Slider\Models\Slider;
use Cartalyst\Support\Handlers\EventHandler as BaseEventHandler;

class SliderEventHandler extends BaseEventHandler implements SliderEventHandlerInterface {

	/**
	 * {@inheritDoc}
	 */
	public function subscribe(Dispatcher $dispatcher)
	{
		$dispatcher->listen('sanatorium.slider.slider.creating', __CLASS__.'@creating');
		$dispatcher->listen('sanatorium.slider.slider.created', __CLASS__.'@created');

		$dispatcher->listen('sanatorium.slider.slider.updating', __CLASS__.'@updating');
		$dispatcher->listen('sanatorium.slider.slider.updated', __CLASS__.'@updated');

		$dispatcher->listen('sanatorium.slider.slider.deleted', __CLASS__.'@deleted');
	}

	/**
	 * {@inheritDoc}
	 */
	public function creating(array $data)
	{

	}

	/**
	 * {@inheritDoc}
	 */
	public function created(Slider $slider)
	{
		$this->flushCache($slider);
	}

	/**
	 * {@inheritDoc}
	 */
	public function updating(Slider $slider, array $data)
	{

	}

	/**
	 * {@inheritDoc}
	 */
	public function updated(Slider $slider)
	{
		$this->flushCache($slider);
	}

	/**
	 * {@inheritDoc}
	 */
	public function deleted(Slider $slider)
	{
		$this->flushCache($slider);
	}

	/**
	 * Flush the cache.
	 *
	 * @param  \Sanatorium\Slider\Models\Slider  $slider
	 * @return void
	 */
	protected function flushCache(Slider $slider)
	{
		$this->app['cache']->forget('sanatorium.slider.slider.all');

		$this->app['cache']->forget('sanatorium.slider.slider.'.$slider->id);
	}

}
