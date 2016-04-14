<?php namespace Sanatorium\Slider\Handlers\Slider;

interface SliderDataHandlerInterface {

	/**
	 * Prepares the given data for being stored.
	 *
	 * @param  array  $data
	 * @return mixed
	 */
	public function prepare(array $data);

}
