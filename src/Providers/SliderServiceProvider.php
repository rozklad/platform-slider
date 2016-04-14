<?php namespace Sanatorium\Slider\Providers;

use Cartalyst\Support\ServiceProvider;

class SliderServiceProvider extends ServiceProvider {

	/**
	 * {@inheritDoc}
	 */
	public function boot()
	{
		// Register the attributes namespace
		$this->app['platform.attributes.manager']->registerNamespace(
			$this->app['Sanatorium\Slider\Models\Slider']
		);

		// Subscribe the registered event handler
		$this->app['events']->subscribe('sanatorium.slider.slider.handler.event');

		// Register all the default hooks
        $this->registerHooks();
	
        // Configuration
        $this->prepareResources();
	}

	/**
	 * {@inheritDoc}
	 */
	public function register()
	{
		// Register the repository
		$this->bindIf('sanatorium.slider.slider', 'Sanatorium\Slider\Repositories\Slider\SliderRepository');

		// Register the data handler
		$this->bindIf('sanatorium.slider.slider.handler.data', 'Sanatorium\Slider\Handlers\Slider\SliderDataHandler');

		// Register the event handler
		$this->bindIf('sanatorium.slider.slider.handler.event', 'Sanatorium\Slider\Handlers\Slider\SliderEventHandler');

		// Register the validator
		$this->bindIf('sanatorium.slider.slider.validator', 'Sanatorium\Slider\Validator\Slider\SliderValidator');
	}

	/**
     * Prepare the package resources.
     *
     * @return void
     */
    protected function prepareResources()
    {
        $config = realpath(__DIR__.'/../../config/config.php');

        $this->mergeConfigFrom($config, 'sanatorium-slider');

        $this->publishes([
            $config => config_path('sanatorium-slider.php'),
        ], 'config');
    }


	/**
     * Register all hooks.
     *
     * @return void
     */
    protected function registerHooks()
    {
        $hooks = [
            'slider' => 'sanatorium/slider::hooks.slider',
        ];

        $manager = $this->app['sanatorium.hooks.manager'];

        foreach ($hooks as $position => $hook) {
            $manager->registerHook($position, $hook);
        }
    }

}
