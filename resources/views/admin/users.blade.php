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
                    <table class="table table-hover">
                        <thead class="text-info">
                            <tr><th>ID</th>
                          <th>{{__('name')}}</th>
                          <th>{{__('email')}}</th>
                        	<th>{{__('account type')}}</th>
                        	<th>{{__('school')}}</th>
                        	<th>{{__('member since')}}</th>
                        	<th>{{__('edit')}}</th>
                        </tr></thead>
                        <tbody>
                            <tr>
                            	<td>1</td>
                              <td>Ed Sharaan</td>
                            	<td>ed.shaaroom@gmail.com</td>
                              <td>Student</td>
                            	<td>New York Art Academy</td>
                            	<td>08/08/2017</td>
                            	<td class="td-actions">
                                <button type="button" rel="tooltip" title="" class="btn btn-primary btn-simple 
                                btn-xs" data-original-title="{{__('edit')}}">
  															 <i class="material-icons">edit</i>
  															 <div class="ripple-container"></div>
                                </button>
                                <button type="button" rel="tooltip" title="" class="btn btn-primary btn-danger btn-simple btn-xs" data-original-title="{{__('delete')}}">
                                 <i class="material-icons">close</i>
                                 <div class="ripple-container"></div>
                                </button>
                              </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
      		</div>
      	</div>
      </div>
     </div>
</div>
@endsection