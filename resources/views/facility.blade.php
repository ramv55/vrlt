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
        <div class="col-md-3">
          <h1>FACILITIES</h1>
          <div id="apDiv3"><a data-toggle="modal" data-href="#add-facility" href="#add-facility" style=" float:left; font-size:30px !important;  color:#37dbf9;"><span style="font-size: 50px !important; margin-right:30px; float:left; ">+</span></a></div>
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
              {{ Form::open(array('url' => 'facilities')) }}
                <div class="input-group" style="margin:8px 0;">
                  <input class="form-control" style="border-radius:4px 0 0 4px;" name="search" />
                  <span class="input-group-btn">
                  <button class="btn btn-default" type="submit" data-select2-open="single-append-text"> <span>GO</span> </button>
                  </span> </div>
              {{ Form::close() }}
            </div>
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th width="12%" bgcolor="#666665">Date Added</th>
                  <th width="13%" bgcolor="#666665">Facility Name</th>
                  <th width="11%" bgcolor="#666665">Facility CTC No.</th>
                  <th width="11%" bgcolor="#666665">Facility Level</th>
                  <th width="11%" bgcolor="#666665">Region</th>
                  <th width="10%" bgcolor="#666665">District</th>
                  <th width="13%" bgcolor="#666665">Lab</th>
                </tr>
              </thead>
              <tbody>
                @if(count($facilities) > 0)
                <?php $i = 1; ?>
                  @foreach($facilities as $getfacility)
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
                        <td <?=$bg?>>{{ date("m/d/Y", strtotime($getfacility->created_at)) }}</td>
                        <td <?=$bg?>><a data-toggle="modal" data-href="#edit-facility<?=$i?>" href="#edit-facility<?=$i?>">{{ $getfacility ->facility_name }}</a></td>
                        <td <?=$bg?>>{{ $getfacility -> facility_ctc_no }}</td>
                        <td <?=$bg?>>{{ $getfacility -> facility_level }}</td>
                        <td <?=$bg?>>{{ $getfacility -> facility_region }}</td>
                        <td <?=$bg?>>{{ $getfacility -> facility_district }}</td>
                        <td <?=$bg?>>
                            <?php
                                $lbid = $getfacility->lab_id;
                                $getLab = DB::table('lab')->where('lab_id', $lbid)->first();
                                echo $getLab->lab_name;
                             ?>
                        </td>
                      </tr>

                      <!-- ************************ Edit facility ******************* -->
                      <div class="modal fade in" id="edit-facility<?=$i?>" tabindex="-1" role="dialog" aria-hidden="false">
                        <div class="modal-dialog modal-md">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                              <h4 class="modal-title">EDIT FACILITY</h4>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="form-group col-md-10 nopadmar">
                                  <label class="col-md-3 line-h">Facility Name</label>
                                  <div class="col-md-9">
                                    <input class="form-control-n" id="editfacilityname<?=$i?>" value="<?=$getfacility->facility_name?>" />
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="form-group col-md-10 nopadmar">
                                  <label class="col-md-3 line-h">CTC No.</label>
                                  <div class="col-md-7">
                                    <!-- <select class="form-control" id="select-gear6">
                                      <option>— Select —</option>
                                    </select> -->
                                    <input class="form-control-n" id="editctcno<?=$i?>" value="<?=$getfacility->facility_ctc_no?>" />
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="form-group col-md-10 nopadmar">
                                  <label class="col-md-3 line-h">Level</label>
                                  <div class="col-md-6">
                                    <select class="form-control" id="editlevel<?=$i?>">
                                      <option value="">— Select —</option>
                                      <option value="City Hospital" <?php if($getfacility -> facility_level == "City Hospital") echo "selected"; ?>>City Hospital</option>
                                      <option value="Dispensary" <?php if($getfacility -> facility_level == "Dispensary") echo "selected"; ?>>Dispensary</option>
                                      <option value="District Hospital" <?php if($getfacility -> facility_level == "District Hospital") echo "selected"; ?>>District Hospital</option>
                                      <option value="Health Center" <?php if($getfacility -> facility_level == "Health Center") echo "selected"; ?>>Health Center</option>
                                      <option value="Mission Hospital" <?php if($getfacility -> facility_level == "Mission Hospital") echo "selected"; ?>>Mission Hospital</option>
                                      <option value="Regional Referral Hospital" <?php if($getfacility -> facility_level == "Regional Referral Hospital") echo "selected"; ?>>Regional Referral Hospital</option>
                                      <option value="Zonal Referral Hospital" <?php if($getfacility -> facility_level == "Zonal Referral Hospital") echo "selected"; ?>>Zonal Referral Hospital</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="form-group col-md-10 nopadmar">
                                  <label class="col-md-3 line-h">Region</label>
                                  <div class="col-md-6">
                                    <select class="form-control" id="editregion<?=$i?>">
                                      <option value="">— Select —</option>
                                      <option value="Mbeya" <?php if($getfacility -> facility_region == "Mbeya") echo "selected"; ?>>Mbeya</option>
                                      <option value="Ruvuma" <?php if($getfacility -> facility_region == "Ruvuma") echo "selected"; ?>>Ruvuma</option>
                                      <option value="Rukwa" <?php if($getfacility -> facility_region == "Rukwa") echo "selected"; ?>>Rukwa</option>
                                      <option value="Katavi" <?php if($getfacility -> facility_region == "Katavi") echo "selected"; ?>>Katavi</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="form-group col-md-10 nopadmar">
                                  <label class="col-md-3 line-h">District</label>
                                  <div class="col-md-6">
                                    <select class="form-control" id="editdistrict<?=$i?>">
                                      <option value="">— Select —</option>
                                      <option value="Busokelo" <?php if($getfacility -> facility_district == "Busokelo") echo "selected"; ?>>Busokelo</option>
                                      <option value="Chunya" <?php if($getfacility -> facility_district == "Chunya") echo "selected"; ?>>Chunya</option>
                                      <option value="Ileje" <?php if($getfacility -> facility_district == "Ileje") echo "selected"; ?>>Ileje</option>
                                      <option value="Kyela" <?php if($getfacility -> facility_district == "Kyela") echo "selected"; ?>>Kyela</option>
                                      <option value="Mbarali" <?php if($getfacility -> facility_district == "Mbarali") echo "selected"; ?>>Mbarali</option>
                                      <<option value="Mbeya" <?php if($getfacility -> facility_district == "Mbeya") echo "selected"; ?>>Mbeya</option>
                                      <option value="Mbeya City Centre" <?php if($getfacility -> facility_district == "Mbeya City Centre") echo "selected"; ?>>Mbeya City Centre</option>
                                      <option value="Momba" <?php if($getfacility -> facility_district == "Momba") echo "selected"; ?>>Momba</option>
                                      <option value="Mbozi" <?php if($getfacility -> facility_district == "Mbozi") echo "selected"; ?>>Mbozi</option>
                                      <option value="Rungwe" <?php if($getfacility -> facility_district == "Rungwe") echo "selected"; ?>>Rungwe</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="form-group col-md-10 nopadmar">
                                  <label class="col-md-3 line-h">Lab Name</label>
                                  <div class="col-md-8">
                                    <select class="form-control" id="editlabids<?=$i?>">
                                      <option value="">— Select —</option>
                                      @foreach($labs as $getlab)
                                        <option value="{{ $getlab->lab_id }}" <?php if($getfacility -> lab_id == $getlab->lab_id) echo "selected"; ?>>{{ $getlab->lab_name }}</option>
                                      @endforeach
                                    </select>
                                    <span style="color: #ff0000; display:none; " id="error_errorfacility">All are required fields.</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" data-dismiss="modal" class="btn btn-d" id="deletefacility<?=$i?>">Delete</button>
                              <button type="button" data-dismiss="modal" class="btn btn-c">Cancel</button>
                              <button type="button" class="btn btn-s" id="editfacility<?=$i?>">Save</button>
                            </div>
                          </div>
                        </div>
                      </div>

                      <script>

                      $("#editfacility<?=$i?>").click(function(){

                        var facility_name = $("#editfacilityname<?=$i?>").val();
                        var ctcno = $("#editctcno<?=$i?>").val();
                        var level = $("#editlevel<?=$i?>").val();
                        var region = $("#editregion<?=$i?>").val();
                        var district = $("#editdistrict<?=$i?>").val();
                        var lab_id = $("#editlabids<?=$i?>").val();

                        if(facility_name != '' && ctcno != '' && level != '' && region != '' && district != '' && lab_id != ''){
                          $('#error_errorfacility').hide();
                          $.ajax
                            ({
                                type: "POST",
                                url: "{{ url('/editfacility') }}",
                                data: 'id=<?=$getfacility->facility_id?>&name='+facility_name+'&_token=<?php echo csrf_token(); ?>&ctcno='+ctcno+'&level='+level+'&region='+region+'&district='+district+'&lab_id='+lab_id,
                                cache: false,
                                async:false,
                                success: function(data)
                                {
                                    if(data.status == 'success'){
                                      window.location.href = '/facilities';
                                    }else{
                                      alert('Something went wrong.')
                                    }

                                }
                            });
                        }else {
                            $('#error_editfacility').show();
                        }
                      });

                            $("#deletefacility<?=$i?>").click(function(){
                                  $("#error_errorfacility<?=$i?>").hide();
                                if (confirm("Do you want to delete")){

                                      $.ajax
                                        ({
                                            type: "POST",
                                            url: "{{ url('/deletefacility') }}",
                                            data: 'id=<?=$getfacility->facility_id?>&_token=<?php echo csrf_token(); ?>',
                                            cache: false,
                                            async:false,
                                            success: function(data)
                                            {
                                                if(data.status == 'success'){
                                                  window.location.href = '/facilities';
                                                }else{
                                                  alert('Something went wrong.')
                                                }

                                            }
                                        });

                                }
                              });
                        </script>

                      <!-- ************************ Edit facility Ends ******************* -->
                      <?php $i++; ?>
                  @endforeach
                @else
                <tr>
                  <td bgcolor="#f1f2f1" colspan="7" style="text-align:center;">Empty Facilities</td>
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

      <!-- ***************** add facility popup *********************** -->
      <div class="modal fade in" id="add-facility" tabindex="-1" role="dialog" aria-hidden="false">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title">ADD FACILITY</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="form-group col-md-10 nopadmar">
                  <label class="col-md-3 line-h">Facility Name</label>
                  <div class="col-md-9">
                    <input class="form-control-n" id="facility_name" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-10 nopadmar">
                  <label class="col-md-3 line-h">CTC No.</label>
                  <div class="col-md-7">
                     <!-- <select class="form-control" id="select-gear6">
                      <option>— Select —</option>
                    </select> -->
                    <input class="form-control-n" id="ctcno" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-10 nopadmar">
                  <label class="col-md-3 line-h">Level</label>
                  <div class="col-md-6">
                    <select class="form-control" id="level">
                      <option value="">— Select —</option>
                      <option value="City  Hospital">City  Hospital</option>
                      <option value="Dispensary">Dispensary</option>
                      <option value="District Hospital">District Hospital</option>
                      <option value="Health Center">Health Center</option>
                      <option value="Mission Hospital">Mission Hospital</option>
                      <option value="Regional Referral Hospital">Regional Referral Hospital</option>
                      <option value="Zonal Referral Hospital">Zonal Referral Hospital</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-10 nopadmar">
                  <label class="col-md-3 line-h">Region</label>
                  <div class="col-md-6">
                    <select class="form-control" id="region">
                      <option value="">— Select —</option>
                      <option value="Mbeya">Mbeya</option>
                      <option value="Ruvuma">Ruvuma</option>
                      <option value="Rukwa">Rukwa</option>
                      <option value="Katavi">Katavi</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-10 nopadmar">
                  <label class="col-md-3 line-h">District</label>
                  <div class="col-md-6">
                    <select class="form-control" id="district">
                      <option value="">— Select —</option>
                      <option value="Busokelo">Busokelo</option>
                      <option value="Chunya">Chunya</option>
                      <option value="Ileje">Ileje</option>
                      <option value="Kyela">Kyela</option>
                      <option value="Mbarali">Mbarali</option>
                      <<option value="Mbeya">Mbeya</option>
                      <option value="Mbeya City Centre">Mbeya City Centre</option>
                      <option value="Momba">Momba</option>
                      <option value="Mbozi">Mbozi</option>
                      <option value="Rungwe">Rungwe</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-10 nopadmar">
                  <label class="col-md-3 line-h">Lab Name</label>
                  <div class="col-md-8">
                    <select class="form-control" id="labids">
                      <option value="">— Select —</option>
                      @foreach($labs as $getlab)
                        <option value="{{ $getlab->lab_id }}">{{ $getlab->lab_name }}</option>
                      @endforeach
                    </select>
                    <span style="color: #ff0000; display:none; " id="error_facility">All are required fields.</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" data-dismiss="modal" class="btn btn-c">Cancel</button>
              <button type="button" class="btn btn-s" id="addfacility">Save</button>
            </div>
          </div>
        </div>
      </div>
      <!-- ***************** add facility popup ends *********************** -->


    </section>
  </aside>
  <!-- right-side -->
  <hr>
</div>
@stop
@section('script')
  <script>
      $("#addfacility").click(function(){
        var facility_name = $("#facility_name").val();
        var ctcno = $("#ctcno").val();
        var level = $("#level").val();
        var region = $("#region").val();
        var district = $("#district").val();
        var lab_id = $("#labids").val();

        if(facility_name != '' && ctcno != '' && level != '' && region != '' && district != '' && lab_id != ''){
          $('#error_facility').hide();
          $.ajax
            ({
                type: "POST",
                url: "{{ url('/addfacility') }}",
                data: 'name='+facility_name+'&_token=<?php echo csrf_token(); ?>&ctcno='+ctcno+'&level='+level+'&region='+region+'&district='+district+'&lab_id='+lab_id,
                cache: false,
                async:false,
                success: function(data)
                {
                    if(data.status == 'success'){
                      window.location.href = '/facilities';
                    }else{
                      alert('Something went wrong.')
                    }

                }
            });
        }else {
            $('#error_facility').show();
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
