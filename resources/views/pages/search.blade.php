@extends ('layout')

@section ('navbar')
	@include ('partials.navbar')
@endsection

@section ('content')
	<section class="row marg-navbar">

		@include ('partials.side-module')

		<div class="col-md-8 scrollable">
			<div class="card-block">
				<h4 class="card-title text-center">
				<?php 
				$r = app('request');
				$query = $r->input('search') ? $r->input('search') : 
						 	($r->input('sID') && count($schools) > 0 ? $schools[0]->name : __('your search'));
				?>
					{{__(':count results for :query', ['count' => count($profs)+count($schools), 'query' => $query])}}
				</h4>
				<section class="search-results marg-top-4">
					<h4>{{__('dont see the prof or school you looking for?')}}</h4>
					<h5><a href="#">{{__('add a prof')}} {{__('here')}}</a> {{__('or')}}
					 <a href="#">{{__('add a school')}} {{__('here')}}</a></h5>
					<div class="list-group">
					<?$itemCounter = 1 ?>
					@foreach($profs as $prof)
					<a href="{{route('prof.view',[$prof->id])}}" data-pos={{$itemCounter}} class="list-group-item list-group-item-action flex-column align-items-start">
					    <div class="d-flex w-100 justify-content-between">
					      <h5 class="mb-1"><i class="material-icons">person</i> {{__('prof')}}</h5>
					      <small>{{__('prof')}}</small>
					    </div>
					    <p class="mb-1">{{$prof->name}} {{$prof->lastname}}</p>
					    <small>{{$prof->school}}, {{$prof->department}}</small>
					  </a>
					  <? $itemCounter++ ?>
					@endforeach
					@foreach($schools as $school)
					<a href="{{route('school.view',[$school->id])}}" data-pos={{$itemCounter}} class="list-group-item list-group-item-action flex-column align-items-start">
					    <div class="d-flex w-100 justify-content-between">
					      <h5 class="mb-1"><i class="material-icons">school</i> {{__('school')}}</h5>
					      <small>{{__('school')}}</small>
					    </div>
					    <p class="mb-1">{{$school->name}}</p>
					    <small>{{__('located in :location', ['location' => $school->location])}}</small>
					  </a>
					  <? $itemCounter++ ?>
					@endforeach
					</div><br>
					<nav class="col-md-12 card card-body">
					  <ul class="pagination mx-auto">
					    <li class="page-item disabled" data-type="previous">
					      <a class="page-link" href="#" data-type="previous" aria-label="{{__('previous')}}">
					        <span aria-hidden="true"><b>&laquo;</b></span>
					        <span class="sr-only">{{__('previous')}}</span>
					      </a>
					    </li>
					    <li class="page-item">
					      <a class="page-link" href="#"><b>1</b> <!--span class="sr-only">{{__('(current)')}}</span--></a>
					    </li>
					    <li class="page-item" data-type="next" aria-label="{{__('next')}}">
					      <a class="page-link" href="#" data-type="next" aria-label="{{__('next')}}">
					        <span aria-hidden="true"><b>&raquo;</b></span>
					        <span class="sr-only">{{__('next')}}</span>
					      </a>
					    </li>
					  </ul>
					</nav>
				</section>
			</div>
		</div>
	</section>
@endsection

@section ('js')
<script type="text/javascript">
	$(document).ready(() => {
		const config = {
			settings: { pageLength: 15, maxPagination: 3 }
		}
		sideModule.init()
		searchResults.init(config)
	})
</script>
@endsection