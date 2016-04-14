{{ Asset::queue('bxslider', 'bxslider/jquery.bxslider.js', 'jquery' )}}

@section('styles')
@parent
<style type="text/css">
.bxslider {
	
}
.bxslider li {
	position: relative;
	overflow: hidden;
	height: 100vh;

	background-size: cover;
	background-repeat: no-repeat;
	background-position: center center;
}
.bxslider li img {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
}
.slider-inside {
	position: absolute;
    left: 20%;
    bottom: 10%;
    text-align: left;
}
</style>
@stop

@section('scripts')
@parent
<script type="text/javascript">
	$(function(){
		
		$('.bxslider').bxSlider({
			auto: true,
			mode: 'fade',
			pause: 4000,
			captions: true,
			pager: false
		});

	});
</script>
@stop

<!-- Sanatorium/slider -->
<ul class="bxslider layout-3">
	@foreach( $slides as $slide )

		<li style="background-image:url({{ route('media.view', $slide->image->path) }})">
			
			<div title="{{ $slide->title }}">
				
				<div class="slider-inside">

        			<h5>{{ $slide->subtitle }}</h5>

        			<h1>{{ $slide->title }}</h1>

					<p>{!! $slide->slider_description !!}</p>

        			<a href="{{ URL::to($slide->url) }}" class="btn btn-success">
						SEE COLLECTION
					</a>

				</div>

			</div>

		</li>
	@endforeach
</ul>

