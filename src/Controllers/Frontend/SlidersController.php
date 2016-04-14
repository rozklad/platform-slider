<?php namespace Sanatorium\Slider\Controllers\Frontend;

use Platform\Foundation\Controllers\Controller;

class SlidersController extends Controller {

	/**
	 * Return the main view.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return view('sanatorium/slider::index');
	}

}
