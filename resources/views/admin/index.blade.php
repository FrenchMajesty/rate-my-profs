@extends ('admin.layout')

@section ('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header" data-background-color="orange">
              <i class="fa fa-globe"></i>
            </div>
            <div class="card-content">
              <p class="category">{{__('visitors')}}</p>
              <h3 class="title">340,323<!--small>ppl</small--></h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">update</i> {{__('just updated')}}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header" data-background-color="green">
              <i class="material-icons">star</i>
            </div>
            <div class="card-content">
              <p class="category">{{__('ratings')}}</p>
              <h3 class="title">{{number_format($ratings,0)}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">date_range</i> {{__('since :date', ['date' => $dateSince->format('m/d/Y')])}}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header" data-background-color="red">
              <i class="material-icons">info_outline</i>
            </div>
            <div class="card-content">
              <p class="category">{{__('corrections sent')}}</p>
              <h3 class="title">{{count($corrections)}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">local_offer</i> <a href="#submissions">{{__('view submissions')}}</a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header" data-background-color="blue">
              <i class="material-icons">person_add</i>
            </div>
            <div class="card-content">
              <p class="category">{{__('new users')}}</p>
              <h3 class="title">+{{number_format($users,0)}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">update</i> {{__('just updated')}}
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="card card-nav-tabs">
            <div class="card-header" data-background-color="purple">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                  <span class="nav-tabs-title">{{__('submissions')}}:</span>
                  <ul class="nav nav-tabs" data-tabs="tabs">
                    <li class="active">
                      <a href="#submissions" data-toggle="tab">
                        <i class="material-icons">announcement</i>
                        {{__('corrections')}}
                      <div class="ripple-container"></div></a>
                    </li>
                    <li class="">
                      <a href="#profs" data-toggle="tab">
                        <i class="material-icons">face</i>
                        {{__('Profs')}}
                      <div class="ripple-container"></div></a>
                    </li>
                    <li class="">
                      <a href="#schools" data-toggle="tab">
                        <i class="material-icons">account_balance</i>
                        {{__('schools')}}
                      <div class="ripple-container"></div></a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>

            <div class="card-content">
              <div class="tab-content">
                <div class="tab-pane active" id="submissions">
                  <table class="table">
                    <thead><tr>
                      <td>{{__('sent by')}}</td>
                      <td>{{__('problem described')}}</td>
                      <td>{{__('page associated')}}</td>
                      <td>{{__('date sent')}}</td>
                    </tr></thead>
                    <tbody>
                    @foreach($corrections as $issue)
                      <tr data-correction={{$issue->id}}>
                        <td>{{$issue->user}}</td>
                        <td>{{$issue->problem}}</td>
                        <td>
                          @if($issue->school)
                            @php ($type = 'school')
                            <a data-id="{{$issue->school_id}}" href="{{route('school.view',[$issue->schoolID])}}" target="_blank">
                              {{$issue->school}}
                            </a>
                          @else
                            @php ($type = 'prof')
                            <a data-id="{{$issue->prof_id}}" href="{{route('prof.view',[$issue->profID])}}" target="_blank">
                              {{$issue->prof_first}} {{$issue->prof_last}}
                            </a>
                          @endif
                        </td>
                        <td>{{date('M d, Y', strtotime($issue->created_at))}}</td>
                        <td class="td-actions text-right">
                          <button data-id="edit" data-type="{{$type}}" type="button" rel="tooltip" title="{{__('edit page')}}" class="btn btn-primary btn-simple btn-xs" data-toggle="modal" data-target="#editPage">
                            <i class="material-icons" data-type="{{$type}}">edit</i>
                          </button>
                          <form class="delete" action="{{route('admin.corrections.delete')}}">
                          {{ csrf_field() }}
                          <input type="hidden" name="id" value="{{$issue->id}}">
                          <button type="submit" rel="tooltip" title="{{__('remove')}}" class="btn btn-danger btn-simple btn-xs">
                            <i class="material-icons">close</i>
                          </button>
                          </form>
                        </td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane" id="profs">
                @if(count($unverified['prof']) > 0)
                  <table class="table">
                    <thead><tr>
                      <td>{{__('name')}}</td>
                      <td>{{__('school')}}</td>
                      <td>{{__('Department')}}</td>
                      <td>{{__('prof directory listing')}}</td>
                      <td>{{__('date added')}}</td>
                      <td>{{__('controls')}}</td>
                    </tr></thead>
                    <tbody>
                      @foreach($unverified['prof'] as $prof)
                      <tr data-id="{{$prof->id}}" data-item-id="{{$prof->id}}">
                        <td>{{$prof->name}} {{$prof->lastname}}</td>
                        <td>
                          <a href="{{route('school.view',[$prof->schoolID])}}" target="_blank">
                            {{$prof->school}}
                          </a>
                        </td>
                        <td>{{$prof->department}}</td>
                        <td>
                          @if($prof->directory_url)
                           <a target="_blank" href="{{$prof->directory_url}}">
                            {{$prof->directory_url}}
                          </a>
                          @else
                          {{__('none added')}}
                          @endif
                        </td>
                        <td>{{date('M d, Y', strtotime($prof->created_at))}}</td>
                        <td class="td-actions text-right">
                          <button type="button" data-type="prof-approve" rel="tooltip" title="{{__('edit')}}" class="btn btn-primary btn-simple btn-xs" data-toggle="modal" data-target="#editPage">
                            <i class="material-icons" data-type="prof-approve">edit</i>
                          </button>
                          <form method="POST" action="{{route('admin.profs.approve')}}">
                          {{ csrf_field() }}
                          <input type="hidden" name="id" value="{{$prof->id}}">
                          <button data-action="approve" type="button" rel="tooltip" title="{{__('approve')}}" class="btn btn-success btn-simple btn-xs">
                            <i class="material-icons" data-id="approve">check</i>
                          </button>
                          <button data-action="reject" type="button" rel="tooltip" title="{{__('reject')}}" class="btn btn-danger btn-simple btn-xs">
                            <i class="material-icons" data-id="reject">close</i>
                          </button>
                          </form>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                @else
                  <h4 class="text-center">{{__('no new prof yet')}}.</h4>
                @endif
                </div>
                <div class="tab-pane" id="schools">
                @if(count($unverified['school']) > 0)
                  <table class="table">
                    <thead><tr>
                      <td>{{__('name')}}</td>
                      <td>{{__('nickname')}}</td>
                      <td>{{__('location')}}</td>
                      <td>{{__('website')}}</td>
                      <td>{{__('date added')}}</td>
                      <td>{{__('controls')}}</td>
                    </tr></thead>
                    <tbody>
                      @foreach($unverified['school'] as $school)
                      <tr data-item-id="{{$school->id}}">
                        <td>{{$school->name}}</td>
                        <td>{{$school->nickname}}</td>
                        <td>{{$school->location}}</td>
                        <td>
                          <a href="{{$school->website}}" target="_blank">
                            {{$school->website}}
                          </a>
                        </td>
                        <td>{{date('M d, Y', strtotime($school->created_at))}}</td>
                        <td class="td-actions text-right">
                          <button type="button" data-type="school-approve" rel="tooltip" title="{{__('edit')}}" class="btn btn-primary btn-simple btn-xs" data-toggle="modal" data-target="#editPage">
                            <i class="material-icons" data-type="school-approve">edit</i>
                          </button>
                          <form method="POST" action="{{route('admin.schools.approve')}}">
                          {{ csrf_field() }}
                          <input type="hidden" name="id" value="{{$school->id}}">
                          <button type="button" data-action="approve" rel="tooltip" title="{{__('approve')}}" class="btn btn-success btn-simple btn-xs">
                            <i class="material-icons" data-action="approve">check</i>
                          </button>
                          <button type="button" data-action="reject" rel="tooltip" title="{{__('reject')}}" class="btn btn-danger btn-simple btn-xs">
                            <i class="material-icons" data-action="reject">close</i>
                          </button>
                          </form>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                @else
                  <h4 class="text-center">{{__('no new school yet')}}.</h4>
                @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     	<div class="row">
      		<div class="col-lg-6 col-md-12">
      			<div class="card">
                <div class="card-header" data-background-color="orange">
                    <h4 class="title">{{__('ratings reported')}}</h4>
                    <p class="category">{{__('ratings marked for reviewing')}}</p>
                </div>
                <div class="card-content table-responsive">
                  @if(count($profReports) + count($schoolReports) > 0)
                    <table id="reports" class="table table-hover">
                        <thead class="text-warning">
                          <th>{{__('rating on')}}</th>
                        	<th>{{__('reported by')}}</th>
                        	<th>{{__('see more')}}</th>
                        </tr></thead>
                        <tbody>
                          @foreach($profReports as $report)
                            <tr data-report="{{$report->id}}" data-type="{{$report->type}}">
                              <input type="hidden" name="id" value="{{$report->ratingID}}">
                              <input type="hidden" name="comment" value="{{$report->rating}}">
                            	<td data-id="name">{{__($report->type).' '.$report->name.' '.$report->lastname}}</td>
                            	<td>{{__('anon')}}</td>
                            	<td class="td-actions"><button data-id="reviewReports" type="button" rel="tooltip" title="" class="btn btn-primary btn-simple btn-xs" data-original-title="{{__('review rating')}}" data-toggle="modal" data-target="#viewReports">
      													<i class="material-icons" data-id="reviewReports">assignment_late</i>
      												<div class="ripple-container"></div></button></td>
                            </tr>
                          @endforeach
                          @foreach($schoolReports as $report)
                            <tr data-report="{{$report->id}}" data-type="{{$report->type}}">
                              <input type="hidden" name="id" value="{{$report->ratingID}}">
                              <input type="hidden" name="comment" value="{{$report->rating}}">
                              <td data-id="name">{{__($report->type).' '.$report->name}}</td>
                              <td>{{__('anon')}}</td>
                              <td class="td-actions"><button data-id="reviewReports" type="button" rel="tooltip" title="" class="btn btn-primary btn-simple btn-xs" data-original-title="{{__('review rating')}}" data-toggle="modal" data-target="#viewReports">
                                <i class="material-icons" data-id="reviewReports">assignment_late</i>
                              <div class="ripple-container"></div></button></td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                    @else
                      <h5 class="text-center">{{__('no reports')}}.</h5>
                    @endif
                </div>
            </div>
			     </div>
    	</div>
    </div>
</div>

@include ('partials.admin.editModal')

<div class="modal fade" id="viewReports" tabindex="-1" role="dialog" aria-labelledby="viewReports" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{__('review rating')}}
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </h5>
      </div>
      <form data-id="prof" method="POST" action="{{route('admin.reports.dismiss')}}">
        <div class="modal-body">
            {{ csrf_field() }}
            <input type="hidden" name="action" value="remove">
            <input type="hidden" name="reports_id">
            <input type="hidden" name="id">
            <input type="hidden" name="type">
            <div class="row">
              <div class="col-md-5 form-group">
                <label class="control-label">{{__('rating on')}}</label>
                <input id="target" type="text" class="form-control" disabled>
              </div>
              <div class="col-md-6 offset-md-1 form-group">
                <label class="control-label">{{__('rating')}}</label>
                <textarea id="rating" class="form-control" disabled></textarea>
              </div>
            </div>
          <section class="error"></section>
        </div>
        <div class="modal-footer">
          <button type="submit" data-type="dismiss" class="btn btn-secondary">{{__('dismiss report')}}</button>
          <button type="submit" class="btn btn-fill btn-success">{{__('remove rating')}}</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section ('js')
<script type="text/javascript">
  $(document).ready(() => {
    $('.modal').appendTo('body')
    const config = {
      message: { confirm: '{{__('are you sure')}}' },
      edit: { data: JSON.parse(`{!! $data !!}`) }
    }
      Dashboard.init(config)
  })
</script>
 @endsection