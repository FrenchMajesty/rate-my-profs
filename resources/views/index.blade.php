@extends ('layout')

@section ('content')
	<div class="container marg-top-8">
        <div class="row">
            <div id="page-container" class="col-md-10 offset-md-1">

                <div data-view="index" class="card-block">
                  <h1 class="card-title text-center">{{__('find reviews of profs and schools')}}</h1>
                  <h5 class="text-center">{{__('by community of 1.3 mil stud')}}</h5>
                
                  <div class="find-buttons text-center marg-top-8">
                    <button data-type="profs" class="btn btn-primary primary">{{__('find profs')}}</button>
                    <button data-type="schools" class="btn btn-primary primary">{{__('find schools')}}</button>
                    <button data-type="review" class="btn btn-primary primary">{{__('rate profs')}}</button>
                  </div>
                </div>


            </div>
            <div style="display: none">
              <div data-view="index" class="card-block">
                    <h1 class="card-title text-center">{{__('find reviews of profs and schools')}}</h1>
                    <h5 class="text-center">{{__('by community of 1.3 mil stud')}}</h5>
                  
                    <div class="find-buttons text-center marg-top-8">
                      <button data-type="profs" class="btn btn-primary primary">{{__('find profs')}}</button>
                      <button data-type="schools" class="btn btn-primary primary">{{__('find schools')}}</button>
                      <button data-type="review" class="btn btn-primary primary">{{__('rate profs')}}</button>
                    </div>
              </div>

              <div data-view="schools" class="card">

                      <!--Card content-->
                      <div class="card-block">
                          <!--Title-->
                          <h4 class="card-title text-center">{{__('find your school')}}</h4>
                          <!--Text-->
                          <div class="marg-bottom-3">
                          <div class="row">
                                 <div class="switch offset-md-2">
                                  <label>
                                    <input type="checkbox" name="name" checked="checked">
                                    <span class="lever"></span>
                                    {{__('name')}}
                                  </label>
                                </div>


                                <div class="switch offset-md-4">
                                  <label>
                                    <input type="checkbox" name="location">
                                    <span class="lever"></span>
                                    {{__('location')}}
                                  </label>
                                </div>
                            </div>
                          </div>
                          <form data-type="location" class="row" style="display: none">
                              <div class="col-md-12">
                                  <div class="btn-group offset-md-4 col-md-4">
                                      <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 100%">{{__('select state')}}</button>

                                      <div class="dropdown-menu" style="width: 100%">
                                          <a class="dropdown-item" href="#">State here</a>
                                          <a class="dropdown-item" href="#">Another state there</a>
                                          <a class="dropdown-item" href="#">Something else here</a>
                                      </div>
                                  </div>
                              </div>
                          </form>
                          <form data-type="name" class="row">
                              <div class="col-md-10 offset-md-1">
                                  <div class="md-form input-group">
                                      <input type="text" class="form-control" placeholder="{{__('school name')}}">
                                      <span class="input-group-btn">
                                          <a class="btn btn-primary btn-sm"><i class="material-icons">search</i></a>
                                  </span>
                                  </div>
                              </div>
                          </form>
                      </div>
                      <!--/.Card content-->
                      <div class="card-footer">
                          <a class="nav-back" href="#">{{__('go back')}}</a>
                      </div>
              </div>

              <div data-view="profs" class="card">
                      <!--Card content-->
                      <div class="card-block">
                          <!--Title-->
                          <h4 class="card-title text-center marg-bottom-3">{{__('find your prof')}}</h4>
                          <!--Text-->
                          <form>
                              <div class="row">
                                <div class="col-md-6">
                                    <div class="md-form">
                                        <input type="text" class="form-control" placeholder="{{__('school name')}}">
                                        <label>{{__('im a stud at')}}</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                <div class="md-form">
                                        <input type="text" class="form-control" placeholder="{{__('prof name')}}">
                                        <label>{{__('looking for prof')}}</label>
                                    </div>
                                </div>
                              </div>
                              <div class="row">
                                <button class="btn btn-primary primary mx-auto">{{__('search')}}</button>
                              </div>
                          </form>
                      </div>
                      <!--/.Card content-->
                      <div class="card-footer">
                          <a class="nav-back" href="#">Go back</a>
                      </div>
              </div>

              <div data-view="review" class="card">
                      <div class="card-block">
                          <h4 class="card-title text-center marg-bottom-3">{{__('rate your prof')}}</h4>
                          <form>
                              <div class="row">
                                <div class="col-md-6 offset-md-3">
                                <div class="md-form">
                                        <input type="text" class="form-control" placeholder="{{__('prof name')}}">
                                        <label>{{__('I want to rate')}}</label>
                                    </div>
                                </div>
                              </div>
                              <div class="row">
                                <button class="btn btn-primary primary mx-auto">{{__('search')}}</button>
                              </div>
                          </form>
                      </div>
                      <div class="card-footer">
                          <a class="nav-back" href="#">Go back</a>
                      </div>
              </div>

            </div>
        </div>
    </div>
@endsection

@section ('js')
<script type="text/javascript">
  indexComponent.init()
</script>
@endsection