@extends ('layout')

@section ('navbar')
  @include ('partials.navbar')
@endsection

@section ('content')
	<div class="container marg-top-8">
        <div class="row">
            <div id="page-container" class="col-md-10 offset-md-1">

                <div data-id="index" class="card-block">
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
              <div data-id="index" class="card-block">
                    <h1 class="card-title text-center">{{__('find reviews of profs and schools')}}</h1>
                    <h5 class="text-center">{{__('by community of 1.3 mil stud')}}</h5>
                  
                    <div class="find-buttons text-center marg-top-8">
                      <button data-type="profs" class="btn btn-primary primary">{{__('find profs')}}</button>
                      <button data-type="schools" class="btn btn-primary primary">{{__('find schools')}}</button>
                      <button data-type="review" class="btn btn-primary primary">{{__('rate profs')}}</button>
                    </div>
              </div>

              <div data-id="schools" class="card">

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
                          <form action="{{route('pages.search')}}" data-type="location" class="row" style="display: none">
                              <div class="col-md-12">
                                  <div class="btn-group offset-md-4 col-md-4">
                                      <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 100%">{{__('select state')}}</button>

                                      <div class="dropdown-menu" style="width: 100%">
                                        <a class="dropdown-item" href="#">{{__('no school yet')}}</a>
                                      </div>
                                  </div>
                              </div>
                          </form>
                          <form action="{{route('pages.search')}}"  data-type="name" class="row">
                              <div class="col-md-10 offset-md-1">
                                  <div class="md-form input-group">
                                      <input type="text" name="school" class="form-control" placeholder="{{__('school name')}}" autocomplete="off">
                                      <input type="hidden" name="sID">
                                      <span class="input-group-btn">
                                          <button type="submit" class="btn btn-primary btn-sm"><i class="material-icons">search</i></button>
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

              <div data-id="profs" class="card">
                      <!--Card content-->
                      <div class="card-block">
                          <!--Title-->
                          <h4 class="card-title text-center marg-bottom-3">{{__('find your prof')}}</h4>
                          <!--Text-->
                          <form action="{{route('pages.search')}}">
                              <div class="row">
                                <div class="col-md-6">
                                    <div class="md-form">
                                        <input type="text" name="school" class="form-control" placeholder="{{__('school name')}}" autocomplete="off">
                                        <label>{{__('im a stud at')}}</label>
                                        <input type="hidden" name="sID">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                <div class="md-form">
                                        <input type="text" name="prof" class="form-control" placeholder="{{__('prof name')}}" autocomplete="off">
                                        <label>{{__('looking for prof')}}</label>
                                        <input type="hidden" name="pID">
                                    </div>
                                </div>
                              </div>
                              <div class="row">
                                <button type="submit" class="btn btn-primary primary mx-auto">{{__('search')}}</button>
                              </div>
                          </form>
                      </div>
                      <!--/.Card content-->
                      <div class="card-footer">
                          <a class="nav-back" href="#">Go back</a>
                      </div>
              </div>

              <div data-id="review" class="card">
                      <div class="card-block">
                          <h4 class="card-title text-center marg-bottom-3">{{__('rate your prof')}}</h4>
                          <form action="{{route('pages.search')}}">
                              <div class="row">
                                <div class="col-md-6 offset-md-3">
                                <div class="md-form">
                                        <input type="text" name="prof" class="form-control" placeholder="{{__('prof name')}}" autocomplete="off" data-format="full">
                                        <label>{{__('i want to rate')}}</label>
                                        <input type="hidden" name="pID">
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
  const config = {
      search: { data: JSON.parse('{!! $data !!}'), url : '{{route('pages.search')}}' }
  }
  indexComponent.init(config)
</script>
@endsection