@extends ('admin.layout')

@section ('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
      	<div class="col-lg-12 col-md-12">
      		<div class="card">
      			<div class="card-header" data-background-color="green">
                    <h4 class="title">{{__('schools')}}</h4>
                    <p class="category">{{__('view and edit')}} {{__('schools')}}</p>
                </div>
                <div class="card-content table-responsive">
                @if(count($schools) > 0)
                    <table id="schools" class="table table-hover">
                        <thead class="text-success"><tr>
                          <th>{{__('school')}}</th>
                        	<th>{{__('nickname')}}</th>
                          <th>{{__('location')}}</th>
                        	<th>{{__('website')}}</th>
                        	<th>{{__('date added')}}</th>
                        	<th>{{__('edit')}}</th>
                        </tr></thead>
                        <tbody>
                          @foreach($schools as $school)
                            <tr data-item-id="{{$school->id}}">
                              <td>{{$school->name}}</td>
                              <td>{{$school->nickname}}</td>
                              <td>{{$school->location}}</td>
                              <td><a href="{{$school->website}}" target="_blank">{{$school->website}}</a></td>
                            	<td>{{date('M d, Y', strtotime($school->created_at))}}</td>
                            	<td class="td-actions">
                                <button type="button" data-type="school-update" rel="tooltip" title="{{__('edit')}}" class="btn btn-primary btn-simple btn-xs" data-original-title="{{__('edit')}}" data-toggle="modal" data-target="#editPage">
  															 <i class="material-icons" data-type="school-update">edit</i>
  															 <div class="ripple-container"></div>
                                </button>
                                <form method="POST" action="{{route('admin.schools.delete')}}">
                                {{ csrf_field() }}
                                <button type="button" rel="tooltip" title="" class="btn btn-primary btn-danger btn-simple btn-xs" data-original-title="{{__('delete')}}">
                                 <i class="material-icons">close</i>
                                 <div class="ripple-container"></div>
                                </button>
                                </form>
                              </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                      <h6 class="text-center">{{__('no new school yet')}}.</h6>
                    @endif
                </div>
      		</div>
      	</div>
      </div>
     </div>
</div>

@include ('partials.admin.editModal')
@endsection

@section ('js')
<script type="text/javascript">
  $(document).ready(() => {
    $('.modal').appendTo('body')
    const config = {
      message: { confirm: '{{__('are you sure')}}', warning: '{{__('prof at school will be deleted')}}!' },
      edit: { data: JSON.parse('{!! $data !!}') }
    }
    ContentManager.init(config)
  })
</script>
@endsection