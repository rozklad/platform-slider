<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sliders', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('media_id');
			$table->string('title')->nullable();
			$table->string('subtitle')->nullable();
			$table->string('url')->nullable();
			$table->timestamps();
		});

		$attributesRepo = app('Platform\Attributes\Repositories\AttributeRepositoryInterface');

		$attributes = [
			[
				'name' => 'Slider title',
				'type' => 'input',
				'description' => 'Slider title',
				'slug' => 'slider_title',
			],
			[
				'name' => 'Slider subtitle',
				'type' => 'input',
				'description' => 'Slider subtitle',
				'slug' => 'slider_subtitle',
			],
			[
				'name' => 'Slider url',
				'type' => 'input',
				'description' => 'Slider url',
				'slug' => 'slider_url',
			],
			[
				'name' => 'Slider image',
				'type' => 'image',
				'description' => 'Slider image',
				'slug' => 'slider_image',
			],
		];


		foreach( $attributes as $attribute )
		{
			$attributesRepo->firstOrCreate([
				'namespace'   => Sanatorium\Slider\Models\Slider::getEntityNamespace(),
				'name'        => $attribute['name'],
				'description' => $attribute['description'],
				'type'        => $attribute['type'],
				'slug'        => $attribute['slug'],
				'enabled'     => 1,
			]);
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sliders');
	}

}
