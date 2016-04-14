<?php namespace Sanatorium\Slider\Widgets;

class Hooks {

	public function slider()
	{
		$this->slides = app('Sanatorium\Slider\Repositories\Slider\SliderRepositoryInterface');

		$slides = $this->slides->get();

		return view('sanatorium/slider::hooks/slider-' . config('sanatorium-slider.style'), compact('slides'));
	}

}
