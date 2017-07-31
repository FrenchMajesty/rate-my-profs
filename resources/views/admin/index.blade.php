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
              <h3 class="title">24,245</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">date_range</i> {{__('since :date', ['date' => '05/05/2016'])}}
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
              <h3 class="title">75</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">local_offer</i> <a href="#">{{__('view submissions')}}</a>
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
              <h3 class="title">+245</h3>
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
                  <span class="nav-tabs-title">{{__('corrections')}}:</span>
                  <ul class="nav nav-tabs" data-tabs="tabs">
                    <li class="active">
                      <a href="#profile" data-toggle="tab">
                        <i class="material-icons">list</i>
                        {{__('view all')}}
                      <div class="ripple-container"></div></a>
                    </li>
                    <li class="">
                      <a href="#messages" data-toggle="tab">
                        <i class="material-icons">face</i>
                        {{__('Profs')}}
                      <div class="ripple-container"></div></a>
                    </li>
                    <li class="">
                      <a href="#settings" data-toggle="tab">
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
                <div class="tab-pane active" id="profile">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="optionsCheckboxes" checked>
                            </label>
                          </div>
                        </td>
                        <td>For Bill Clinton: He doesn't teach English anymore but history.</td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-simple btn-xs">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="optionsCheckboxes">
                            </label>
                          </div>
                        </td>
                        <td>For Barrack Obama: He stopped working at DC last year.</td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-simple btn-xs">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="optionsCheckboxes">
                            </label>
                          </div>
                        </td>
                        <td>For Yale: They lost agaisnt Harvard for 56 times in a row, not 33
                        </td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-simple btn-xs">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane" id="messages">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="optionsCheckboxes" checked>
                            </label>
                          </div>
                        </td>
                        <td>For Bill Clinton: He doesn't teach English anymore but history.
                        </td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-simple btn-xs">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="optionsCheckboxes">
                            </label>
                          </div>
                        </td>
                        <td>For Barrack Obama: He stopped working at DC last year.</td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-simple btn-xs">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane" id="settings">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="optionsCheckboxes">
                            </label>
                          </div>
                        </td>
                        <td>For Yale: They lost agaisnt Harvard for 56 times in a row, not 33</td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-simple btn-xs">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                            <i class="material-icons">close</i>
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
     	<div class="row">
      		<div class="col-lg-6 col-md-12">
			<div class="card">
                <div class="card-header" data-background-color="orange">
                    <h4 class="title">{{__('ratings reported')}}</h4>
                    <p class="category">{{__('ratings marked for reviewing')}}</p>
                </div>
                <div class="card-content table-responsive">
                    <table class="table table-hover">
                        <thead class="text-warning">
                            <tr><th>ID</th>
                        	<th>{{__('review on')}}</th>
                        	<th>{{__('author')}}</th>
                        	<th>{{__('see more')}}</th>
                        </tr></thead>
                        <tbody>
                            <tr>
                            	<td>1</td>
                            	<td>Professor Ford</td>
                            	<td>{{__('anon')}}</td>
                            	<td class="td-actions"><button type="button" rel="tooltip" title="" class="btn btn-primary btn-simple btn-xs" data-original-title="{{__('review rating')}}">
																<i class="material-icons">assignment_late</i>
															<div class="ripple-container"></div></button></td>
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

@section ('js')
<script type="text/javascript">
  $(document).ready(function(){
  // Javascript method's body can be found in assets/js/demos.js
      demo.initDashboardPageCharts();
  });
</script>
 @endsection