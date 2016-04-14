<?php namespace Sanatorium\Slider\Repositories\Slider;

use Cartalyst\Support\Traits;
use Illuminate\Container\Container;
use Symfony\Component\Finder\Finder;

class SliderRepository implements SliderRepositoryInterface {

	use Traits\ContainerTrait, Traits\EventTrait, Traits\RepositoryTrait, Traits\ValidatorTrait;

	/**
	 * The Data handler.
	 *
	 * @var \Sanatorium\Slider\Handlers\Slider\SliderDataHandlerInterface
	 */
	protected $data;

	/**
	 * The Eloquent slider model.
	 *
	 * @var string
	 */
	protected $model;

	/**
	 * Constructor.
	 *
	 * @param  \Illuminate\Container\Container  $app
	 * @return void
	 */
	public function __construct(Container $app)
	{
		$this->setContainer($app);

		$this->setDispatcher($app['events']);

		$this->data = $app['sanatorium.slider.slider.handler.data'];

		$this->setValidator($app['sanatorium.slider.slider.validator']);

		$this->setModel(get_class($app['Sanatorium\Slider\Models\Slider']));
	}

	/**
	 * {@inheritDoc}
	 */
	public function grid()
	{
		return $this
			->createModel();
	}

	/**
	 * {@inheritDoc}
	 */
	public function findAll()
	{
		return $this->container['cache']->rememberForever('sanatorium.slider.slider.all', function()
		{
			return $this->createModel()->get();
		});
	}

	/**
	 * {@inheritDoc}
	 */
	public function find($id)
	{
		return $this->container['cache']->rememberForever('sanatorium.slider.slider.'.$id, function() use ($id)
		{
			return $this->createModel()->find($id);
		});
	}

	/**
	 * {@inheritDoc}
	 */
	public function validForCreation(array $input)
	{
		return $this->validator->on('create')->validate($input);
	}

	/**
	 * {@inheritDoc}
	 */
	public function validForUpdate($id, array $input)
	{
		return $this->validator->on('update')->validate($input);
	}

	/**
	 * {@inheritDoc}
	 */
	public function store($id, array $input)
	{
		return ! $id ? $this->create($input) : $this->update($id, $input);
	}

	/**
	 * {@inheritDoc}
	 */
	public function create(array $input)
	{
		// Create a new slider
		$slider = $this->createModel();

		// Fire the 'sanatorium.slider.slider.creating' event
		if ($this->fireEvent('sanatorium.slider.slider.creating', [ $input ]) === false)
		{
			return false;
		}

		// Prepare the submitted data
		$data = $this->data->prepare($input);

		// Validate the submitted data
		$messages = $this->validForCreation($data);

		// Check if the validation returned any errors
		if ($messages->isEmpty())
		{
			// Save the slider
			$slider->fill($data)->save();

			// Fire the 'sanatorium.slider.slider.created' event
			$this->fireEvent('sanatorium.slider.slider.created', [ $slider ]);
		}

		return [ $messages, $slider ];
	}

	/**
	 * {@inheritDoc}
	 */
	public function update($id, array $input)
	{
		// Get the slider object
		$slider = $this->find($id);

		// Fire the 'sanatorium.slider.slider.updating' event
		if ($this->fireEvent('sanatorium.slider.slider.updating', [ $slider, $input ]) === false)
		{
			return false;
		}

		// Prepare the submitted data
		$data = $this->data->prepare($input);

		// Validate the submitted data
		$messages = $this->validForUpdate($slider, $data);

		// Check if the validation returned any errors
		if ($messages->isEmpty())
		{
			// Update the slider
			$slider->fill($data)->save();

			// Fire the 'sanatorium.slider.slider.updated' event
			$this->fireEvent('sanatorium.slider.slider.updated', [ $slider ]);
		}

		return [ $messages, $slider ];
	}

	/**
	 * {@inheritDoc}
	 */
	public function delete($id)
	{
		// Check if the slider exists
		if ($slider = $this->find($id))
		{
			// Fire the 'sanatorium.slider.slider.deleted' event
			$this->fireEvent('sanatorium.slider.slider.deleted', [ $slider ]);

			// Delete the slider entry
			$slider->delete();

			return true;
		}

		return false;
	}

	/**
	 * {@inheritDoc}
	 */
	public function enable($id)
	{
		$this->validator->bypass();

		return $this->update($id, [ 'enabled' => true ]);
	}

	/**
	 * {@inheritDoc}
	 */
	public function disable($id)
	{
		$this->validator->bypass();

		return $this->update($id, [ 'enabled' => false ]);
	}

}
