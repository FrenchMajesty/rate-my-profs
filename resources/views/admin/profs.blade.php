@extends ('admin.layout')

@section ('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
      	<div class="col-lg-12 col-md-12">
      		<div class="card">
      			<div class="card-header" data-background-color="orange">
                    <h4 class="title">{{__('Profs')}}</h4>
                    <p class="category">{{__('view and edit')}} {{__('profs')}}</p>
                </div>
                <div class="card-content table-responsive">
                @if(count($profs) > 0)
                    <table class="table table-hover">
                        <thead class="text-warning"><tr>
                        	<th>{{__('name')}}</th>
                        	<th>{{__('school')}}</th>
                        	<th>{{__('Department')}}</th>
                        	<th>{{__('date added')}}</th>
                        	<th>{{__('edit')}}</th>
                        </tr></thead>
                        <tbody>
                          @foreach($profs as $prof)
                            <tr data-item-id="{{$prof->id}}">
                            	<td>{{$prof->name}} {{$prof->lastname}}</td>
                            	<td>{{$prof->school}}</td>
                            	<td>{{$prof->department}}</td>
                            	<td>{{date('M d, Y', strtotime($prof->created_at))}}</td>
                            	<td class="td-actions">
                                <button type="button" rel="tooltip" title="{{__('edit')}}" class="btn btn-primary btn-simple btn-xs" data-original-title="{{__('edit')}}" data-type="prof-update" data-toggle="modal" data-target="#editPage">
  															 <i class="material-icons" data-type="prof-update">edit</i>
  															 <div class="ripple-container"></div>
                                </button>
                                <form method="POST" action="{{route('admin.profs.delete')}}">
                                 {{ csrf_field() }}
                                 <input type="hidden" name="id" value="{{$prof->id}}">
                                  <button type="button" rel="tooltip" title="{{__('delete')}}" class="btn btn-primary btn-danger btn-simple btn-xs" data-original-title="{{__('delete')}}">
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
                      <h6 class="text-center">{{__('no new prof yet')}}.</h6>
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
      message: { confirm: '{{__('are you sure')}}' },
      edit: { data: JSON.parse('{!! $data !!}') }
    }
    ContentManager.init(config)
  })
</script>
@endsection