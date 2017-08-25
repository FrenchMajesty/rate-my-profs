@extends ('admin.layout')

@section ('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
      	<div class="col-lg-12 col-md-12">
      		<div class="card">
      			<div class="card-header" data-background-color="blue">
                    <h4 class="title">{{__('Users')}}</h4>
                    <p class="category">{{__('view and edit')}} {{__('users')}}</p>
                </div>
                <div class="card-content table-responsive">
                  @if(count($users) > 0)
                    <table class="table table-hover">
                        <thead class="text-info"><tr>
                          <th>{{__('name')}}</th>
                          <th>{{__('email')}}</th>
                        	<th>{{__('account type')}}</th>
                        	<th>{{__('school')}}</th>
                        	<th>{{__('member since')}}</th>
                        	<!--th>{{__('edit')}}</th-->
                        </tr></thead>
                        <tbody>
                          @foreach($users as $user)
                            <tr data-item-id="{{$user->id}}">
                              <td>{{$user->name}} {{$user->lastname}}</td>
                              <td>{{$user->email}}</td>
                              <td>{{ucfirst(__($user->account_type))}}</td>
                              <td>{{$user->school?: __('none')}}</td>
                            	<td>{{date('M d, Y', strtotime($user->created_at))}}</td>
                            	<!--td class="td-actions">
                                <button type="button" data-type="user-update" rel="tooltip" title="{{__('edit')}}" class="btn btn-primary btn-simple 
                                btn-xs" data-original-title="{{__('edit')}}">
  															 <i class="material-icons" data-type="user-update">edit</i>
  															 <div class="ripple-container"></div>
                                </button>
                                <button type="button" rel="tooltip" title="" class="btn btn-primary btn-danger btn-simple btn-xs" data-original-title="{{__('delete')}}">
                                 <i class="material-icons">close</i>
                                 <div class="ripple-container"></div>
                                </button>
                              </td-->
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