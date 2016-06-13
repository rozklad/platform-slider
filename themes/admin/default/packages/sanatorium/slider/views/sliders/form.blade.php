@extends('layouts/default')

{{-- Page title --}}
@section('title')
@parent
{{{ trans("action.{$mode}") }}} {{ trans('sanatorium/slider::sliders/common.title') }}
@stop

{{-- Queue assets --}}
{{ Asset::queue('validate', 'platform/js/validate.js', 'jquery') }}

{{-- Inline scripts --}}
@section('scripts')
@parent
@stop

{{-- Inline styles --}}
@section('styles')
@parent
<style type="text/css">
	.attributes-inline hr, .attributes-inline .btn-primary,
	.attributes-inline legend {
		display: none;
	}
</style>
@stop

{{-- Page content --}}
@section('page')

<section class="panel panel-default panel-tabs">

	{{-- Form --}}
	<form id="slider-form" action="{{ request()->fullUrl() }}" role="form" method="post" data-parsley-validate>

		{{-- Form: CSRF Token --}}
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<header class="panel-heading">

			<nav class="navbar navbar-default navbar-actions">

				<div class="container-fluid">

					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#actions">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>

						<a class="btn btn-navbar-cancel navbar-btn pull-left tip" href="{{ route('admin.sanatorium.slider.sliders.all') }}" data-toggle="tooltip" data-original-title="{{{ trans('action.cancel') }}}">
							<i class="fa fa-reply"></i> <span class="visible-xs-inline">{{{ trans('action.cancel') }}}</span>
						</a>

						<span class="navbar-brand">{{{ trans("action.{$mode}") }}} <small>{{{ $slider->exists ? $slider->id : null }}}</small></span>
					</div>

					{{-- Form: Actions --}}
					<div class="collapse navbar-collapse" id="actions">

						<ul class="nav navbar-nav navbar-right">

							@if ($slider->exists)
							<li>
								<a href="{{ route('admin.sanatorium.slider.sliders.delete', $slider->id) }}" class="tip" data-action-delete data-toggle="tooltip" data-original-title="{{{ trans('action.delete') }}}" type="delete">
									<i class="fa fa-trash-o"></i> <span class="visible-xs-inline">{{{ trans('action.delete') }}}</span>
								</a>
							</li>
							@endif

							<li>
								<button class="btn btn-primary navbar-btn" data-toggle="tooltip" data-original-title="{{{ trans('action.save') }}}">
									<i class="fa fa-save"></i> <span class="visible-xs-inline">{{{ trans('action.save') }}}</span>
								</button>
							</li>

						</ul>

					</div>

				</div>

			</nav>

		</header>

		<div class="panel-body">

			<div role="tabpanel">

				{{-- Form: Tabs --}}
				<ul class="nav nav-tabs" role="tablist">
					<li class="active" role="presentation"><a href="#general-tab" aria-controls="general-tab" role="tab" data-toggle="tab">{{{ trans('sanatorium/slider::sliders/common.tabs.general') }}}</a></li>
					<li role="presentation"><a href="#attributes" aria-controls="attributes" role="tab" data-toggle="tab">{{{ trans('sanatorium/slider::sliders/common.tabs.attributes') }}}</a></li>
				</ul>

				<div class="tab-content">

					{{-- Tab: General --}}
					<div role="tabpanel" class="tab-pane fade in active attributes-inline" id="general-tab">

						<fieldset>

							<div class="row">

								@attributes($slider, ['slider_image'])

								<div class="form-group{{ Alert::onForm('title', ' has-error') }}">

									<label for="title" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('sanatorium/slider::sliders/model.general.title_help') }}}"></i>
										{{{ trans('sanatorium/slider::sliders/model.general.title') }}}
									</label>

									<input type="text" class="form-control" name="title" id="title" placeholder="{{{ trans('sanatorium/slider::sliders/model.general.title') }}}" value="{{{ input()->old('title', $slider->title) }}}">

									<span class="help-block">{{{ Alert::onForm('title') }}}</span>

								</div>

								<div class="form-group{{ Alert::onForm('subtitle', ' has-error') }}">

									<label for="subtitle" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('sanatorium/slider::sliders/model.general.subtitle_help') }}}"></i>
										{{{ trans('sanatorium/slider::sliders/model.general.subtitle') }}}
									</label>

									<input type="text" class="form-control" name="subtitle" id="subtitle" placeholder="{{{ trans('sanatorium/slider::sliders/model.general.subtitle') }}}" value="{{{ input()->old('subtitle', $slider->subtitle) }}}">

									<span class="help-block">{{{ Alert::onForm('subtitle') }}}</span>

								</div>

								<div class="form-group{{ Alert::onForm('url', ' has-error') }}">

									<label for="url" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('sanatorium/slider::sliders/model.general.url_help') }}}"></i>
										{{{ trans('sanatorium/slider::sliders/model.general.url') }}}
									</label>

									<input type="text" class="form-control" name="url" id="url" placeholder="{{{ trans('sanatorium/slider::sliders/model.general.url') }}}" value="{{{ input()->old('url', $slider->url) }}}">

									<span class="help-block">{{{ Alert::onForm('url') }}}</span>

								</div>


							</div>

						</fieldset>

					</div>

					{{-- Tab: Attributes --}}
					<div role="tabpanel" class="tab-pane fade" id="attributes">
						@attributes($slider)
					</div>

				</div>

			</div>

		</div>

	</form>

</section>
@stop
