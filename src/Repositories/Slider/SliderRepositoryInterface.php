<?php namespace Sanatorium\Slider\Repositories\Slider;

interface SliderRepositoryInterface {

	/**
	 * Returns a dataset compatible with data grid.
	 *
	 * @return \Sanatorium\Slider\Models\Slider
	 */
	public function grid();

	/**
	 * Returns all the slider entries.
	 *
	 * @return \Sanatorium\Slider\Models\Slider
	 */
	public function findAll();

	/**
	 * Returns a slider entry by its primary key.
	 *
	 * @param  int  $id
	 * @return \Sanatorium\Slider\Models\Slider
	 */
	public function find($id);

	/**
	 * Determines if the given slider is valid for creation.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Support\MessageBag
	 */
	public function validForCreation(array $data);

	/**
	 * Determines if the given slider is valid for update.
	 *
	 * @param  int  $id
	 * @param  array  $data
	 * @return \Illuminate\Support\MessageBag
	 */
	public function validForUpdate($id, array $data);

	/**
	 * Creates or updates the given slider.
	 *
	 * @param  int  $id
	 * @param  array  $input
	 * @return bool|array
	 */
	public function store($id, array $input);

	/**
	 * Creates a slider entry with the given data.
	 *
	 * @param  array  $data
	 * @return \Sanatorium\Slider\Models\Slider
	 */
	public function create(array $data);

	/**
	 * Updates the slider entry with the given data.
	 *
	 * @param  int  $id
	 * @param  array  $data
	 * @return \Sanatorium\Slider\Models\Slider
	 */
	public function update($id, array $data);

	/**
	 * Deletes the slider entry.
	 *
	 * @param  int  $id
	 * @return bool
	 */
	public function delete($id);

}
