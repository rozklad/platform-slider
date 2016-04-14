{{ Asset::queue('bxslider', 'bxslider/jquery.bxslider.js', 'jquery' )}}


@section('styles')
@parent
<style type="text/css">
.bx-pagination ul {
	list-style-type: none;
	margin: 0;
	padding-left: 0;
	background-color: #111;
	margin-right: -1px;
}
.bx-pagination ul li {
	
}
.bx-pagination ul li a {
	color: #ccc;
	font-size: 12px;
	transition: margin-top 0.3s, padding-bottom 0.3s;
	padding-left: 20px;
	padding-right: 20px;
	padding-top: 20px;
	display: block;
	width: 100%;
}
.bx-pagination ul li a:hover, .bx-pagination ul li a:focus, .bx-pagination ul li a.active {
	text-decoration: none;
	color: #f2f2f2;
}
.bx-pagination ul li a.active {
	background-color: #8fbe3f;
	color: #fff;
	position: relative;
	margin-top: -20px;
	padding-bottom: 20px;
}
.bx-pagination ul li p {
	height: 40px;
}
.bx-pagination ul li a.active:after {
	display: block;
	position: absolute;
	transform: rotate(-45deg);
	content: " ";
	width: 32px;
	height: 32px;
	background-color: #8fbe3f;
	top: -16px;
	left: 50%;
	margin-left: -16px;
}
.bx-pagination ul li h4 {
	font-size: 14px;
	font-weight: 700;
	margin-bottom: 0;
}

/* Layout 1 */
.bxslider.layout-1 .slider-inside {
	position: absolute;
	bottom: 0px;
	left: 0px;
	right: 0;
	width: 100%;
	color: #fff;
	background-color: rgba(0,0,0,0.4);
	padding: 0 20px;
}
.bx-wrapper .bx-pager, .bx-wrapper .bx-controls-auto {
	bottom: 10px;
}
</style>
@stop

@section('scripts')
@parent
<script type="text/javascript">
	$(function(){
		
		$('.bxslider').bxSlider({
			mode: 'fade',
			captions: true
		});

	});
</script>
@stop

<!-- Sanatorium/slider -->
<ul class="bxslider layout-1">
	@foreach( $slides as $slide )

		<li>
			<a href="{{ URL::to($slide->url) }}">
				
				<img src="{{ route('media.view', $slide->image->path) }}" alt="{{ $slide->title }}">
				
				<div class="slider-inside">
					<h4>{{ $slide->title }}</h4>
        			<p>{{ $slide->subtitle }}</p>
				</div>

			</a>
		</li>
	@endforeach
</ul>
