@extends ('layout')

@section ('navbar')
	@include ('partials.navbar')
@endsection

@section ('content')
	<section class="row marg-navbar">

		@include ('partials.side-module')

		<div class="col-md-8 scrollable">
			<div class="card-block">
				<h4 class="card-title text-center">{{__(':count results for :query', ['count' => 12, 'query' => 'yale'])}}</h4>

				<section class="search-results marg-top-4">
					<h4>{{__('dont see the prof or school you looking for?')}}</h4>
					<h5><a href="#">{{__('add a prof')}} {{__('here')}}</a> {{__('or')}}
					 <a href="#">{{__('add a school')}} {{__('here')}}</a></h5>
					<div class="list-group">
					<?php $i = 0; while($i < 5) { ?>
					  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
					    <div class="d-flex w-100 justify-content-between">
					      <h5 class="mb-1"><i class="material-icons">person</i> {{__('prof')}}</h5>
					      <small>{{__('prof')}}</small>
					    </div>
					    <p class="mb-1">Bill Clinton</p>
					    <small>Harvard University, {{__('math')}}</small>
					  </a>

					  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
					    <div class="d-flex w-100 justify-content-between">
					      <h5 class="mb-1"><i class="material-icons">school</i> {{__('school')}}</h5>
					      <small>{{__('school')}}</small>
					    </div>
					    <p class="mb-1">Havard University</p>
					    <small>{{__('located in :location', ['location' => 'Cambridge, MA'])}}</small>
					  </a>
					  <?php $i++; } ?>
					</div><br>
					<nav class="col-md-4 mx-auto">
					  <ul class="pagination">
					    <li class="page-item disabled">
					      <a class="page-link" href="#" aria-label="{{__('previous')}}">
					        <span aria-hidden="true">&laquo;</span>
					        <span class="sr-only">{{__('previous')}}</span>
					      </a>
					    </li>
					    <li class="page-item active">
					      <a class="page-link" href="#">1 <span class="sr-only">{{__('(current)')}}</span></a>
					    </li>
					    <li class="page-item"><a class="page-link" href="#">2</a></li>
					    <li class="page-item"><a class="page-link" href="#">3</a></li>
					    <li class="page-item"><a class="page-link" href="#">4</a></li>
					    <li class="page-item"><a class="page-link" href="#">5</a></li>
					    <li class="page-item">
					      <a class="page-link" href="#" aria-label="{{__('next')}}">
					        <span aria-hidden="true">&raquo;</span>
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
		sideModule.init()
	})
</script>
@endsection