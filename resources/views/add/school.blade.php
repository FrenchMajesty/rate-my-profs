@extends ('layout')


@section ('navbar')
	@include ('partials.navbar')
@endsection

@section ('content')
	<section class="row" style="margin-top: 5em">
		
		@include ('partials.side-module')


		<div class="col-md-4 marg-top-3">
				<div class="card">
					<div class="card-block">

					    <div class="form-header primary darken-4">
					        <h3><i class="fa fa-plus-square"></i> {{__('add a school')}}</h3>
					    </div>
					    <form>
					    	<div class="md-form">
						        <i class="fa fa-graduation-cap prefix"></i>
						        <input type="text" class="form-control">
						        <label>{{__('school name')}}</label>
						    </div>

					    	<div class="md-form">
						        <i class="fa fa-star-half prefix"></i>
						        <input type="text" class="form-control">
						        <label>{{__('common nickname')}}</label>
						    </div>

						    <div class="md-form">
						        <i class="fa fa-globe prefix"></i>
						        <input type="text" class="form-control">
						        <label>{{__('country')}}</label>
						    </div>

						    <div class="md-form">
						        <i class="fa fa-map prefix"></i>
						        <input type="text" class="form-control">
						        <label>{{__('state/province')}}</label>
						    </div>

						    <div class="md-form">
						        <i class="fa fa-map-marker prefix"></i>
						        <input type="text" class="form-control">
						        <label>{{__('city')}}</label>
						    </div>

						    <div class="md-form">
						        <i class="fa fa-mouse-pointer prefix"></i>
						        <input type="text" class="form-control">
						        <label>{{__('website')}}</label>
						    </div>

						    <div class="md-form">
						        <i class="fa fa-envelope prefix"></i>
						        <input type="text" class="form-control">
						        <label >{{__('your email')}}</label>
						    </div>

						    <!-- add security captcha here -->
						    <div class="text-center">
						        <button class="btn primary">{{__('add')}}</button>
						    </div>
					    </form>
					</div>
			</div>
	</section>
@endsection


@section ('js')
<script type="text/javascript">
	sideModule.init('none')
	addSchool.init()
</script>
@endsection