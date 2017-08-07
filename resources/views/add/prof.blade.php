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
					    <form id="add-prof" method="POST" action="{{ route('add.prof') }}">
					    {{ csrf_field() }}
					    	<div class="md-form">
						        <i class="fa fa-graduation-cap prefix"></i>
						        <input type="text" name="school" value="{{ old('school') }}" class="form-control" autocomplete="off" data-provide="typeahead" data-items="8">
						        <label>{{__('school name')}}</label>
						    </div>

					    	<div class="md-form">
						        <i class="fa fa-user prefix"></i>
						        <input type="text" name="first" value="{{ old('first') }}" class="form-control" required>
						        <label>{{__('first name')}}</label>
						    </div>

						    <div class="md-form">
						        <i class="fa fa-user prefix"></i>
						        <input type="text" name="middle" value="{{ old('middle') }}" class="form-control">
						        <label>{{__('middle name')}} {{__('(optional)')}}</label>
						    </div>

						    <div class="md-form">
						        <i class="fa fa-user prefix"></i>
						        <input type="text" name="last" value="{{ old('last') }}" class="form-control" required>
						        <label>{{__('last name')}}</label>
						    </div>

						    <div class="md-form">
						        <i class="fa fa-archive prefix"></i>
						        <input type="text" name="department" value="{{ old('department') }}" class="form-control" autocomplete="off" required>
						        <label>{{__('Department')}}</label>
						    </div>

						    <div class="md-form">
						        <i class="fa fa-mouse-pointer prefix"></i>
						        <input type="text" name="directory" value="{{ old('directory') }}" class="form-control">
						        <label >{{__('prof directory listing')}} {{__('(optional)')}}</label>
						    </div>
						    <input type="hidden" name="school_id" value="0">
						    <input type="hidden" name="department_id" value="0">
						    <!-- add security captcha here -->

						    <div class="alert alert-danger" style="display: none"></div>

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
		url: {
			fetchSchool: '{{ route('fetch.schools') }}',
			fetchDept: '{{ route('fetch.departments') }}'
		},
		successAdd: {
			message : '{{ __('prof submitted for review') }}',
			redirectUrl : '{{ route('view.prof') }}'
		}
	}
	addProfessor.init(config)
	sideModule.init('none')
</script>
@endsection