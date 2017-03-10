@extends('layout.main')
@section('content')
@include('includes.top')
<div class="wrapper row-offcanvas row-offcanvas-left">
  @include('includes.sidebar')
  <!-- Right side column. Contains the navbar and content of the page -->
  <aside class="right-side">
    <section class="content">
      <h2 class="text-center viral-load-title">Viral Load System</h2>
      <div class="row">
        <div class="col-md-2">
          <h1>USERS</h1>
          <div id="apDiv3"><a data-toggle="modal" data-href="#add-user" href="#add-user" style=" float:left; font-size:30px !important;  color:#37dbf9;"><span style="font-size: 50px !important; margin-right:30px; float:left; ">+</span></a></div>
        </div>
      </div>
      <!--/row-->
      <div class="row">
        <div class="col-md-12 ">
          <div class="table-scrollable">
            <div class="col-md-4">
              <button type="button" id="showall" class="btn btn-responsive see-btn"  data-toggle="button">Show All</button>
            </div>
            <div class="col-md-3 pull-right">
              {{ Form::open(array('url' => 'users')) }}
              <div class="input-group" style="margin:8px 0;">
                <input class="form-control" style="border-radius:4px 0 0 4px;" name="search" id="search" value="<?=Input::get('search')?>" />
                <span class="input-group-btn">
                <button id="searchbtn" class="btn btn-default" type="submit" data-select2-open="single-append-text"> <span>GO</span> </button>
                </span> </div>
              {{ Form::close() }}
            </div>
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th width="12%" bgcolor="#666665">Date Added</th>
                  <th width="13%" bgcolor="#666665">Username</th>
                  <th width="11%" bgcolor="#666665">Role</th>
                  <th width="11%" bgcolor="#666665">Facility Name</th>
                  <th width="11%" bgcolor="#666665">Region</th>
                  <th width="10%" bgcolor="#666665">District</th>
                  <th width="13%" bgcolor="#666665">Last Login</th>
                </tr>
              </thead>
              <tbody>
                @if(count($users) > 0)
                <?php $i = 1; ?>
                  @foreach($users as $getusers)
                    <?php
                      if($i%2 != 0){
                        $rwclass = 'odd';
                        $bg = '';
                      }else {
                        $rwclass = '';
                        $bg = 'bgcolor="#f1f2f1"';

                      }
                    ?>
                      <tr class="<?=$rwclass?>">
                          <td <?=$bg?>>{{ date("m/d/Y", strtotime($getusers->created_at)) }}</td>
                          <td <?=$bg?>><a data-toggle="modal" data-href="#edit-user<?=$i?>" href="#edit-user<?=$i?>">{{ $getusers->username }}</a></td>
                          <td <?=$bg?>>
                              @if($getusers->role == 1)
                                {{ 'Clinic' }}
                              @else
                                {{ 'Lab' }}
                              @endif
                          </td>
                          <td <?=$bg?>>
                            <?php
                                $facility_id = $getusers->facility_id;
                                $getFacility = DB::table('facilities')->where('facility_id', $facility_id)->first();
                                echo @$getFacility->facility_name;
                             ?>
                          </td>
                          <td <?=$bg?>>{{ $getusers->region }}</td>
                          <td <?=$bg?>>{{ @$getFacility->facility_district }}</td>
                          <td <?=$bg?>>
                            @if($getusers->last_login_at != NULL && $getusers->last_login_at != '0000-00-00 00:00:00')
                            {{ date("m/d/Y H:i:s", strtotime($getusers->last_login_at)) }}
                            @endif
                          </td>
                </tr>
                <div class="modal fade in" id="edit-user<?=$i?>" tabindex="-1" role="dialog" aria-hidden="false">
                  <div class="modal-dialog modal-md">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">EDIT USER</h4>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="form-group col-md-6 nopadmar">
                            <label class="col-md-4 line-h">Username</label>
                            <div class="col-md-8">
                              <input class="form-control-n required" id="editusername<?=$i?>"  value="{{ $getusers->username }}" />
                            </div>
                          </div>
                          <div class="form-group col-md-5 nopadmar">
                            <label class="col-md-5 line-h">User Role</label>
                            <div class="col-md-7">
                              <select class="form-control required" id="edituser_role<?=$i?>" name="edituser_role">
                                <option value="">— Select —</option>
                                <option value="1" <?php if($getusers->role == 1) echo 'selected'; ?>>Clinic</option>
                                <option value="2" <?php if($getusers->role == 2) echo 'selected'; ?>>Lab</option>
                              </select>
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-md-6 nopadmar">
                              <label class="col-md-4 line-h">Password</label>
                              <div class="col-md-8">
                                <input type="password" class="form-control-n required" name="editpassword" id="editpassword<?=$i?>"/>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-6 nopadmar">
                            <label class="col-md-4 ">Password
                              Again</label>
                            <div class="col-md-8">
                              <input type="password" class="form-control-n required" name="editretype_pwd" id="editretype_pwd<?=$i?>"/>
                              <span style="color: #ff0000; display:none;" id="editerrorpwd<?=$i?>">Passwords didn\'t match!</span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-8 nopadmar">
                            <label class="col-md-3 line-h">Facility</label>
                            <div class="col-md-9">
                              <select class="form-control required" id="editfacility<?=$i?>" name="editfacility">
                                <option value="">— Select —</option>
                                @foreach($facilities as $getfacility)
                                  <option value="{{ $getfacility->facility_id }}" <?php if($getfacility->facility_id == $getusers->facility_id) echo 'selected'; ?>>{{ $getfacility->facility_name }}</option>
                                @endforeach
                              </select>
                              <p class="text-center">Or</p>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-8 nopadmar">
                            <label class="col-md-3 line-h">Lab</label>
                            <div class="col-md-9">
                              <select class="form-control required" id="editlab<?=$i?>" name="editlab">
                                <option value="">— Select —</option>
                                @foreach($labs as $getlabs)
                                  <option value="{{ $getlabs->lab_id }}" <?php if($getlabs->lab_id == $getusers->lab_id) echo 'selected'; ?> >{{ $getlabs->lab_name }}</option>
                                @endforeach
                              </select>
                              <p class="text-center">Or</p>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-8 nopadmar">
                            <label class="col-md-3 line-h">Region</label>
                            <div class="col-md-9">
                              <select class="form-control required" id="editregion<?=$i?>" name="editregion">
                                <option value="">— Select —</option>
                                <option value="Mbeya" <?php if($getusers->region == "Mbeya") echo 'selected'; ?>>Mbeya</option>
                                <option value="Ruvuma" <?php if($getusers->region == "Ruvuma") echo 'selected'; ?>>Ruvuma</option>
                                <option value="Rukwa" <?php if($getusers->region == "Rukwa") echo 'selected'; ?>>Rukwa</option>
                                <option value="Katavi" <?php if($getusers->region == "Katavi") echo 'selected'; ?>>Katavi</option>
                              </select>
                              <span id="editerror_user<?=$i?>" style="color:#ff0000; display: none;"> All fields are required.</span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-d" id="delete_user<?=$i?>">Delete</button>
                        <button type="button" data-dismiss="modal" class="btn btn-c">Cancel</button>
                        <button type="button" class="btn btn-s" id="saveuser<?=$i?>">Save</button>
                      </div>
                    </div>
                  </div>
                </div>

                <script>
                $('#delete_user<?=$i?>').click(function(){
                  $("#editerrorpwd<?=$i?>").hide();
                  $("#editerror_user<?=$i?>").hide();
                if (confirm("Do you want to delete")){

                      $.ajax
                        ({
                            type: "POST",
                            url: "{{ url('/deleteuser') }}",
                            data: 'id=<?=$getusers->user_id?>&_token=<?php echo csrf_token(); ?>',
                            cache: false,
                            async:false,
                            success: function(data)
                            {
                                if(data.status == 'success'){
                                  window.location.href = '/users';
                                }else{
                                  alert('Something went wrong.')
                                }

                            }
                        });

                }
                });
                var msg = '';
                $('#editretype_pwd<?=$i?>').focusout(function(){
                  // get values on the focusout event
                  var pass = $('#editpassword<?=$i?>').val();
                  var pass2 = $('#editretype_pwd<?=$i?>').val();
                  // test them...
                  if(pass != pass2){
                    msg = 'false';
                      $('#editerrorpwd<?=$i?>').show();
                  }else {
                    msg = 'true';
                    $('#editerrorpwd').hide();
                  }

                });

                $('#saveuser<?=$i?>').click(function(){
                  var username = $('#editusername<?=$i?>').val();
                  var user_role = $('#edituser_role<?=$i?>').val();
                  var password = $('#editpassword<?=$i?>').val();
                  var facility = $('#editfacility<?=$i?>').val();
                  var lab = $('#editlab<?=$i?>').val();
                  var region  = $('#editregion<?=$i?>').val();



                    if((username != '' && user_role != '') && (facility != '' || lab != '' || region != '')){

                      $('#editerror_user<?=$i?>').hide();
                      $.ajax
                        ({
                            type: "POST",
                            url: "{{ url('/updateuser') }}",
                            data: 'id=<?=$getusers->user_id?>&username='+username+'&_token=<?php echo csrf_token(); ?>&user_role='+user_role+'&password='+password+'&facility='+facility+'&lab='+lab+'&region='+region,
                            cache: false,
                            async:false,
                            success: function(data)
                            {
                                if(data.status == 'success'){
                                  window.location.href = '/users';
                                }else{
                                  alert('Something went wrong.')
                                }

                            }
                        });
                    }else {
                        $('#editerror_user<?=$i?>').show();
                    }

                });

                </script>

                <?php $i++; ?>
              @endforeach
            @else
              <tr>
                <td bgcolor="#f1f2f1" colspan="7" style="text-align:center;">Empty Users</td>
              </tr>
            @endif
              </tbody>
            </table>
          </div>
        </div>

        <div class="row" style="padding:12px 0px;">
              <div class="col-sm-10" >

                  <div class="dataTables_paginate paging_simple_numbers" id="inline_edit_paginate">
                    <?php $link_limit = 7; ?>

                @if ($paginator->lastPage() > 1)
                    <ul class="pagination pull-left">

                        <li class="paginate_button previous {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}" id="inline_edit_previous"><a href="{{ $paginator->url(1) }}" aria-controls="inline_edit" data-dt-idx="0" tabindex="0">FIRST</a></li>
                              <li class="paginate_button previous {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}" id="inline_edit_previous"><a href="{{ $paginator->url($paginator->currentPage()-1) }}" aria-controls="inline_edit" data-dt-idx="0" tabindex="0">PREV</a></li>
                              @for ($i = 1; $i <= $paginator->lastPage(); $i++)

                              <?php
                                    $half_total_links = floor($link_limit / 2);
                                    $from = $paginator->currentPage() - $half_total_links;
                                    $to = $paginator->currentPage() + $half_total_links;
                                    if ($paginator->currentPage() < $half_total_links) {
                                       $to += $half_total_links - $paginator->currentPage();
                                    }
                                    if ($paginator->lastPage() - $paginator->currentPage() < $half_total_links) {
                                        $from -= $half_total_links - ($paginator->lastPage() - $paginator->currentPage()) - 1;
                                    }
                              ?>
                                @if ($from < $i && $i < $to)
                                  <li class="paginate_button {{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
                                      <a href="{{ $paginator->url($i) }}" aria-controls="inline_edit" data-dt-idx="1" tabindex="0">{{ $i }}</a>
                                  </li>
                                @endif
                            @endfor
                              <li class="paginate_button next {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}" id="inline_edit_next"><a href="{{ $paginator->url($paginator->currentPage()+1) }}" aria-controls="inline_edit" data-dt-idx="4" tabindex="0">NEXT</a></li>

                              <li class="paginate_button next {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}" id="inline_edit_next"><a href="{{ $paginator->url($paginator->lastPage()) }}" aria-controls="inline_edit" data-dt-idx="4" tabindex="0">LAST</a></li>
                        </ul>
                    @endif
              </div>
                </div>
            <div class="col-sm-2" style="line-height:40px;">
            <div class="dataTables_length pull-right" id="inline_edit_length"><label class="col-md-4">Show </label>
            <div class="col-md-8">
              <select id="show" class="form-control">
                    <option value="10" <?php if(Input::get('lists') == 10) echo 'selected'; ?>>10</option>
                    <option value="25" <?php if(Input::get('lists') == 25) echo 'selected'; ?>>25</option>
                    <option value="50" <?php if(Input::get('lists') == 50) echo 'selected'; ?>>50</option>
                    <option value="100" <?php if(Input::get('lists') == 100) echo 'selected'; ?>>100</option>
              </select>
          </div></div>
                </div>

          </div>

      </div>
      <div class="clearfix"></div>
      <!-- ************************ add user popup ***************** -->
      <div class="modal fade in" id="add-user" tabindex="-1" role="dialog" aria-hidden="false">
        <div class="modal-dialog modal-md">
          {{ Form::open(array('url' => 'adduser', 'id' => 'formId')) }}
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title">ADD USER</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="form-group col-md-6 nopadmar">
                  <label class="col-md-4 line-h">Username</label>
                  <div class="col-md-8">
                    <input class="form-control-n required" id="username"  />
                  </div>
                </div>
                <div class="form-group col-md-5 nopadmar">
                  <label class="col-md-5 line-h">User Role</label>
                  <div class="col-md-7">
                    <select class="form-control required" id="user_role" name="user_role">
                      <option value="">— Select —</option>
                      <option value="1">Clinic</option>
                      <option value="2">Lab</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6 nopadmar">
                    <label class="col-md-4 line-h">Password</label>
                    <div class="col-md-8">
                      <input type="password" class="form-control-n required" name="password" id="password"/>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6 nopadmar">
                  <label class="col-md-4 ">Password
                    Again</label>
                  <div class="col-md-8">
                    <input type="password" class="form-control-n required" name="retype_pwd" id="retype_pwd"/>
                    <span style="color: #ff0000; display:none;" id="errorpwd">Passwords didn\'t match!</span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-8 nopadmar">
                  <label class="col-md-3 line-h">Facility</label>
                  <div class="col-md-9">
                    <select class="form-control required" id="facility" name="facility">
                      <option value="">— Select —</option>
                      @foreach($facilities as $getfacility)
                        <option value="{{ $getfacility->facility_id }}">{{ $getfacility->facility_name }}</option>
                      @endforeach
                    </select>
                    <p class="text-center">Or</p>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-8 nopadmar">
                  <label class="col-md-3 line-h">Lab</label>
                  <div class="col-md-9">
                    <select class="form-control required" id="lab" name="lab">
                      <option value="">— Select —</option>
                      @foreach($labs as $getlabs)
                        <option value="{{ $getlabs->lab_id }}">{{ $getlabs->lab_name }}</option>
                      @endforeach
                    </select>
                    <p class="text-center">Or</p>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-8 nopadmar">
                  <label class="col-md-3 line-h">Region</label>
                  <div class="col-md-9">
                    <select class="form-control required" id="region" name="region">
                      <option value="">— Select —</option>
                      <option value="Mbeya">Mbeya</option>
                      <option value="Ruvuma">Ruvuma</option>
                      <option value="Rukwa">Rukwa</option>
                      <option value="Katavi">Katavi</option>
                    </select>
                    <span id="error_user" style="color:#ff0000; display: none;"> All fields are required.</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" data-dismiss="modal" class="btn btn-c">Cancel</button>
              <button type="button" class="btn btn-s" id="adduser">Save</button>
            </div>
          </div>
          {{ Form::close() }}
        </div>
      </div>
      <!-- ************************ add user popup ends ***************** -->

    </section>
  </aside>
  <!-- right-side -->
  <hr>
</div>
@stop
@section('script')
<script>
var msg = '';
$('#retype_pwd').focusout(function(){
  // get values on the focusout event
  var pass = $('#password').val();
  var pass2 = $('#retype_pwd').val();
  // test them...
  if(pass != pass2){
    msg = 'false';
      $('#errorpwd').show();
  }else {
    msg = 'true';
    $('#errorpwd').hide();
  }

});

$('#adduser').click(function(){
  var username = $('#username').val();
  var user_role = $('#user_role').val();
  var password = $('#password').val();
  var facility = $('#facility').val();
  var lab = $('#lab').val();
  var region  = $('#region').val();

  if(msg == 'true'){

    if((username != '' && user_role != '' && password != '') && (facility != '' || lab != '' || region != '')){

      $('#error_user').hide();
      $.ajax
        ({
            type: "POST",
            url: "{{ url('/adduser') }}",
            data: 'username='+username+'&_token=<?php echo csrf_token(); ?>&user_role='+user_role+'&password='+password+'&facility='+facility+'&lab='+lab+'&region='+region,
            cache: false,
            async:false,
            success: function(data)
            {
                if(data.status == 'success'){
                  window.location.href = '/users';
                }else{
                  alert('Something went wrong.')
                }

            }
        });
    }else {
        $('#error_user').show();
    }

  }else {

  }
});

$('#showall').click(function(){
  window.location.href = '{{ Request::url() }}?lists=all';
});

$('#show').change(function(){
    var val = $(this).val();
    window.location.href = '{{ Request::url() }}?lists='+val;
  });

</script>
@stop
