@extends ('layout')


@section ('navbar')
	@include ('partials.navbar')
@endsection

@section ('content')
	<section class="row marg-navbar">
		
		@include ('partials.side-module')


		<div class="col-md-4 marg-top-3">
				<div class="card">
					<div class="card-block">

					    <div class="form-header primary darken-4">
					        <h3><i class="fa fa-plus-square"></i> {{__('add a school')}}</h3>
					    </div>
					    <form id="add-school" method="POST" action="{{ route('add.school') }}">
					    {{ csrf_field() }}
					    	<div class="md-form">
						        <i class="fa fa-graduation-cap prefix"></i>
						        <input type="text" name="name" value="{{ old('name') }}" class="form-control" autocomplete="off" required>
						        <label>{{__('school name')}}</label>
						    </div>

					    	<div class="md-form">
						        <i class="fa fa-star-half prefix"></i>
						        <input type="text" name="nickname" value="{{ old('nickname') }}" class="form-control" required>
						        <label>{{__('common nickname')}}</label>
						    </div>

						    <div class="md-form">
						        <i class="fa fa-map prefix"></i>
						        <input type="text" name="state" value="{{ old('state') }}" class="form-control">
						        <label>{{__('state/province')}}</label>
						    </div>

						    <div class="md-form">
						        <i class="fa fa-map-marker prefix"></i>
						        <input type="text" name="city" value="{{ old('city') }}" class="form-control" required>
						        <label>{{__('city')}}</label>
						    </div>

						    <div class="md-form">
						        <i class="fa fa-mouse-pointer prefix"></i>
						        <input type="url" name="website" value="{{ old('website') }}" class="form-control" required>
						        <label>{{__('website')}}</label>
						    </div>

						    <div class="md-form">
						        <i class="fa fa-envelope prefix"></i>
						        <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
						        <label >{{__('your email')}}</label>
						    </div>

						    <div class="alert alert-danger" style="display: none"></div>

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
	const config = {
		successAddMessage: '{{__('school submitted for review')}}',
		successAddRedirectUrl: '{{ route('view.school') }}'
	}
	addSchool.init(config)
	sideModule.init('none')
</script>
@endsection