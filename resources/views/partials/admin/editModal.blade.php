<div class="modal fade" id="editPage" tabindex="-1" role="dialog" aria-labelledby="editPage" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{__('edit')}}
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </h5>
      </div>
      <form data-id="prof" method="POST" action="{{route('admin.corrections.update')}}" style="display: none">
        <div class="modal-body">
            {{ csrf_field() }}
            <input type="hidden" name="type" value="prof">
            <input type="hidden" name="corrections_id">
            <input type="hidden" name="id">
            <div class="row">
                <section class="col-md-12">
                   <div class="form-group">
                      <label class="control-label">{{__('first name')}}</label>
                          <input type="text" class="form-control" name="firstname" placeholder="{{__('prof first name')}}" required>
                   </div>
                   <div class="form-group">
                      <label class="control-label">{{__('last name')}}</label>
                          <input type="text" class="form-control" name="lastname" placeholder="{{__('prof last name')}}" required>
                   </div>
                   <div class="form-group">
                      <label class="control-label">{{__('prof directory listing')}}</label>
                          <input type="url" class="form-control" name="directory" placeholder="{{__('prof website')}}">
                   </div>
                   <div class="form-group">
                      <label class="control-label">{{__('school name')}}</label>
                          <input type="text" class="form-control" name="school" placeholder="{{__('school name')}}" autocomplete="off" required>
                          <input type="hidden" name="sID">
                   </div>
                   <div class="form-group">
                      <label class="control-label">{{__('Department')}}</label>
                          <input type="text" class="form-control" name="department" placeholder="{{__('department name')}}" autocomplete="off" required>
                          <input type="hidden" name="dID">
                   </div>
                </section>
               </div><br>
          <section class="error"></section>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('cancel')}}</button>
          <button type="submit" class="btn btn-fill btn-success">{{__('update and remove submission')}}</button>
        </div>
      </form>

      <form data-id="prof-approve" method="POST" action="{{route('admin.profs.approve.update')}}" style="display: none">
        <div class="modal-body">
            {{ csrf_field() }}
            <input type="hidden" name="id">
            <div class="row">
                <section class="col-md-12">
                   <div class="form-group">
                      <label class="control-label">{{__('first name')}}</label>
                          <input type="text" class="form-control" name="firstname" placeholder="{{__('prof first name')}}" required>
                   </div>
                   <div class="form-group">
                      <label class="control-label">{{__('last name')}}</label>
                          <input type="text" class="form-control" name="lastname" placeholder="{{__('prof last name')}}" required>
                   </div>
                   <div class="form-group">
                      <label class="control-label">{{__('prof directory listing')}}</label>
                          <input type="url" class="form-control" name="directory" placeholder="{{__('prof website')}}">
                   </div>
                   <div class="form-group">
                      <label class="control-label">{{__('school name')}}</label>
                          <input type="text" class="form-control" name="school" placeholder="{{__('school name')}}" autocomplete="off" required>
                          <input type="hidden" name="sID">
                   </div>
                   <div class="form-group">
                      <label class="control-label">{{__('Department')}}</label>
                          <input type="text" class="form-control" name="department" placeholder="{{__('department name')}}" autocomplete="off" required>
                          <input type="hidden" name="dID">
                   </div>
                </section>
               </div><br>
          <section class="error"></section>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('cancel')}}</button>
          <button type="submit" class="btn btn-fill btn-success">{{__('update and remove submission')}}</button>
        </div>
      </form>

      <form data-id="prof-update" method="POST" action="{{route('admin.profs.update')}}" style="display: none">
        <div class="modal-body">
            {{ csrf_field() }}
            <input type="hidden" name="id">
            <div class="row">
                <section class="col-md-12">
                   <div class="form-group">
                      <label class="control-label">{{__('first name')}}</label>
                          <input type="text" class="form-control" name="firstname" placeholder="{{__('prof first name')}}" required>
                   </div>
                   <div class="form-group">
                      <label class="control-label">{{__('last name')}}</label>
                          <input type="text" class="form-control" name="lastname" placeholder="{{__('prof last name')}}" required>
                   </div>
                   <div class="form-group">
                      <label class="control-label">{{__('prof directory listing')}}</label>
                          <input type="url" class="form-control" name="directory" placeholder="{{__('prof website')}}">
                   </div>
                   <div class="form-group">
                      <label class="control-label">{{__('school name')}}</label>
                          <input type="text" class="form-control" name="school" placeholder="{{__('school name')}}" autocomplete="off" required>
                          <input type="hidden" name="sID">
                   </div>
                   <div class="form-group">
                      <label class="control-label">{{__('Department')}}</label>
                          <input type="text" class="form-control" name="department" placeholder="{{__('department name')}}" autocomplete="off" required>
                          <input type="hidden" name="dID">
                   </div>
                </section>
               </div><br>
          <section class="error"></section>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('cancel')}}</button>
          <button type="submit" class="btn btn-fill btn-info">{{__('update')}}</button>
        </div>
      </form>

      <form data-id="school" method="POST" action="{{route('admin.corrections.update')}}" style="display: none">
        <div class="modal-body">
            {{ csrf_field() }}
            <input type="hidden" name="corrections_id">
            <input type="hidden" name="type" value="school">
            <input type="hidden" name="id">
            <div class="row">
                <section class="col-md-12">
                   <div class="form-group">
                      <label class="control-label">{{__('school name')}}</label>
                      <input type="text" class="form-control" name="name" placeholder="{{__('school name')}}" required>
                    </div>
                    <div class="form-group">
                      <label class="control-label">{{__('nick name')}}</label>
                      <input type="text" class="form-control" name="nickname" placeholder="{{__('nick name')}}" required>
                    </div>
                    <div class="form-group">
                      <label class="control-label">{{__('school location')}}</label>
                      <input type="text" class="form-control" name="location" placeholder="{{__('location example')}}" required>
                    </div>
                    <div class="form-group">
                      <label class="control-label">{{__('website')}}</label>
                      <input type="url" class="form-control" name="website" placeholder="{{__('prof first name')}}" required>
                    </div>
                  </section>
               </div><br>
          <section class="error"></section>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('cancel')}}</button>
          <button type="submit" class="btn btn-fill btn-success">{{__('update and remove submission')}}</button>
        </div>
      </form>

      <form data-id="school-approve" method="POST" action="{{route('admin.schools.approve.update')}}" style="display: none">
        <div class="modal-body">
            {{ csrf_field() }}
            <input type="hidden" name="corrections_id">
            <input type="hidden" name="type" value="school">
            <input type="hidden" name="id">
            <div class="row">
                <section class="col-md-12">
                   <div class="form-group">
                      <label class="control-label">{{__('school name')}}</label>
                      <input type="text" class="form-control" name="name" placeholder="{{__('school name')}}" required>
                    </div>
                    <div class="form-group">
                      <label class="control-label">{{__('nick name')}}</label>
                      <input type="text" class="form-control" name="nickname" placeholder="{{__('nick name')}}" required>
                    </div>
                    <div class="form-group">
                      <label class="control-label">{{__('school location')}}</label>
                      <input type="text" class="form-control" name="location" placeholder="{{__('location example')}}" required>
                    </div>
                    <div class="form-group">
                      <label class="control-label">{{__('website')}}</label>
                      <input type="url" class="form-control" name="website" placeholder="{{__('prof first name')}}" required>
                    </div>
                  </section>
               </div><br>
          <section class="error"></section>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('cancel')}}</button>
          <button type="submit" class="btn btn-fill btn-success">{{__('update and approve')}}</button>
        </div>
      </form>

      <form data-id="school-update" method="POST" action="{{route('admin.schools.update')}}" style="display: none">
        <div class="modal-body">
            {{ csrf_field() }}
            <input type="hidden" name="id">
            <div class="row">
                <section class="col-md-12">
                   <div class="form-group">
                      <label class="control-label">{{__('school name')}}</label>
                      <input type="text" class="form-control" name="name" placeholder="{{__('school name')}}" required>
                    </div>
                    <div class="form-group">
                      <label class="control-label">{{__('nick name')}}</label>
                      <input type="text" class="form-control" name="nickname" placeholder="{{__('nick name')}}" required>
                    </div>
                    <div class="form-group">
                      <label class="control-label">{{__('school location')}}</label>
                      <input type="text" class="form-control" name="location" placeholder="{{__('location example')}}" required>
                    </div>
                    <div class="form-group">
                      <label class="control-label">{{__('website')}}</label>
                      <input type="url" class="form-control" name="website" placeholder="{{__('prof first name')}}" required>
                    </div>
                  </section>
               </div><br>
          <section class="error"></section>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('cancel')}}</button>
          <button type="submit" class="btn btn-fill btn-info">{{__('update')}}</button>
        </div>
      </form>
    </div>
  </div>
</div>