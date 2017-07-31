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
					        <h3><i class="fa fa-user-plus"></i> {{__('add a prof')}}</h3>
					    </div>
					    <form>
					    	<div class="md-form">
						        <i class="fa fa-graduation-cap prefix"></i>
						        <input type="text" class="form-control">
						        <label>{{__('school name')}}</label>
						    </div>

					    	<div class="md-form">
						        <i class="fa fa-user prefix"></i>
						        <input type="text" class="form-control">
						        <label>{{__('first name')}}</label>
						    </div>

						    <div class="md-form">
						        <i class="fa fa-user prefix"></i>
						        <input type="text" class="form-control">
						        <label>{{__('middle name')}} {{__('(optional)')}}</label>
						    </div>

						    <div class="md-form">
						        <i class="fa fa-user prefix"></i>
						        <input type="text" class="form-control">
						        <label>{{__('last name')}}</label>
						    </div>

						    <div class="md-form">
						        <i class="fa fa-archive prefix"></i>
						        <input type="text" class="form-control">
						        <label>{{__('Department')}}</label>
						    </div>

						    <div class="md-form">
						        <i class="fa fa-mouse-pointer prefix"></i>
						        <input type="text" class="form-control">
						        <label >{{__('prof directory listing')}} {{__('(optional)')}}</label>
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
	addProfessor.init()
</script>
@endsection