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
</style>
@stop

@section('scripts')
@parent
<script type="text/javascript">
	$(function(){
		
		$('.bxslider').bxSlider({
			mode: 'fade',
			captions: true,
			pagerCustom: '#bx-pager'
		});

	});
</script>
@stop

<!-- Sanatorium/slider -->
<ul class="bxslider layout-2">
	@foreach( $slides as $slide )

		<li>
			<a href="{{ URL::to($slide->url) }}">
				
				<img src="{{ $slide->image_url }}" alt="{{ $slide->title }}">

			</a>
		</li>
	@endforeach
</ul>

<div id="bx-pager" class="bx-pagination hidden-xs">
	<ul class="row">
	@foreach( $slides as $index => $slide )
        <li class="col-sm-{{ ceil(12/count($slides)) }}"> 
        	<a data-slide-index="{{ $index }}" href="{{ URL::to($slide->url) }}">
        		<h4>{{ $slide->title }}</h4>
        		<p>{{ $slide->subtitle }}</p>
        	</a>
        </li>
	@endforeach
	</ul>
</div>
