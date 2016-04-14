<?php namespace Sanatorium\Slider\Controllers\Admin;

use Platform\Access\Controllers\AdminController;
use Sanatorium\Slider\Repositories\Slider\SliderRepositoryInterface;

class SlidersController extends AdminController {

	/**
	 * {@inheritDoc}
	 */
	protected $csrfWhitelist = [
		'executeAction',
	];

	/**
	 * The Slider repository.
	 *
	 * @var \Sanatorium\Slider\Repositories\Slider\SliderRepositoryInterface
	 */
	protected $sliders;

	/**
	 * Holds all the mass actions we can execute.
	 *
	 * @var array
	 */
	protected $actions = [
		'delete',
		'enable',
		'disable',
	];

	/**
	 * Constructor.
	 *
	 * @param  \Sanatorium\Slider\Repositories\Slider\SliderRepositoryInterface  $sliders
	 * @return void
	 */
	public function __construct(SliderRepositoryInterface $sliders)
	{
		parent::__construct();

		$this->sliders = $sliders;
	}

	/**
	 * Display a listing of slider.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return view('sanatorium/slider::sliders.index');
	}

	/**
	 * Datasource for the slider Data Grid.
	 *
	 * @return \Cartalyst\DataGrid\DataGrid
	 */
	public function grid()
	{
		$data = $this->sliders->grid();

		$columns = [
			'id',
			'media_id',
			'title',
			'subtitle',
			'created_at',
		];

		$settings = [
			'sort'      => 'created_at',
			'direction' => 'desc',
		];

		$transformer = function($element)
		{
			$element->edit_uri = route('admin.sanatorium.slider.sliders.edit', $element->id);

			return $element;
		};

		return datagrid($data, $columns, $settings, $transformer);
	}

	/**
	 * Show the form for creating new slider.
	 *
	 * @return \Illuminate\View\View
	 */
	public function create()
	{
		return $this->showForm('create');
	}

	/**
	 * Handle posting of the form for creating new slider.
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store()
	{
		return $this->processForm('create');
	}

	/**
	 * Show the form for updating slider.
	 *
	 * @param  int  $id
	 * @return mixed
	 */
	public function edit($id)
	{
		return $this->showForm('update', $id);
	}

	/**
	 * Handle posting of the form for updating slider.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update($id)
	{
		return $this->processForm('update', $id);
	}

	/**
	 * Remove the specified slider.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete($id)
	{
		$type = $this->sliders->delete($id) ? 'success' : 'error';

		$this->alerts->{$type}(
			trans("sanatorium/slider::sliders/message.{$type}.delete")
		);

		return redirect()->route('admin.sanatorium.slider.sliders.all');
	}

	/**
	 * Executes the mass action.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function executeAction()
	{
		$action = request()->input('action');

		if (in_array($action, $this->actions))
		{
			foreach (request()->input('rows', []) as $row)
			{
				$this->sliders->{$action}($row);
			}

			return response('Success');
		}

		return response('Failed', 500);
	}

	/**
	 * Shows the form.
	 *
	 * @param  string  $mode
	 * @param  int  $id
	 * @return mixed
	 */
	protected function showForm($mode, $id = null)
	{
		// Do we have a slider identifier?
		if (isset($id))
		{
			if ( ! $slider = $this->sliders->find($id))
			{
				$this->alerts->error(trans('sanatorium/slider::sliders/message.not_found', compact('id')));

				return redirect()->route('admin.sanatorium.slider.sliders.all');
			}
		}
		else
		{
			$slider = $this->sliders->createModel();
		}

		// Show the page
		return view('sanatorium/slider::sliders.form', compact('mode', 'slider'));
	}

	/**
	 * Processes the form.
	 *
	 * @param  string  $mode
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	protected function processForm($mode, $id = null)
	{
		// Store the slider
		list($messages) = $this->sliders->store($id, request()->all());

		// Do we have any errors?
		if ($messages->isEmpty())
		{
			$this->alerts->success(trans("sanatorium/slider::sliders/message.success.{$mode}"));

			return redirect()->route('admin.sanatorium.slider.sliders.all');
		}

		$this->alerts->error($messages, 'form');

		return redirect()->back()->withInput();
	}

}
