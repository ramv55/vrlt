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
          <h1>LAB</h1>
          <div id="apDiv3"><a data-toggle="modal" data-href="#add-lab" href="#add-lab" style=" float:left; font-size:30px !important;  color:#37dbf9;"><span style="font-size: 50px !important; margin-right:30px; float:left; ">+</span></a></div>
        </div>
      </div>
      <!--/row-->
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <div class="table-scrollable">
            <div class="col-md-4">
              <button type="button" id="showall" class="btn btn-responsive see-btn"  data-toggle="button">Show All</button>
            </div>
            <div class="col-md-6 pull-right">
              {{ Form::open(array('url' => 'labs')) }}
              <div class="input-group" style="margin:8px 0;">
                <input class="form-control" style="border-radius:4px 0 0 4px;" name="search" id="search">
                <span class="input-group-btn">
                <button class="btn btn-default" id="searchlab" type="submit" data-select2-open="single-append-text"> <span>GO</span> </button>
                </span> </div>
              {{ Form::close() }}
            </div>
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th width="23%" bgcolor="#666665">Date Added</th>
                  <th width="77%" bgcolor="#666665">VL Testing Lab Name</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                @foreach($labs as $getlabs)
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
                  <td <?=$bg?>>
                    {{ date("m/d/Y", strtotime($getlabs->created_at)) }}
                  </td>
                  <td <?=$bg?>><a data-toggle="modal" data-href="#edit-lab<?=$i?>" href="#edit-lab<?=$i?>">{{ $getlabs->lab_name }}</a></td>
                </tr>
                <!-- edit popup -->
                <div class="modal fade in" id="edit-lab<?=$i?>" tabindex="-1" role="dialog" aria-hidden="false">
                  <div class="modal-dialog modal-md">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">EDIT LAB</h4>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="form-group col-md-12 nopadmar">
                            <label class="col-md-4 line-h">VL Testing Lab Name</label>
                            <div class="col-md-8">
                              <input class="form-control-n" value="{{ $getlabs->lab_name }}" id="editlabname<?=$i?>">
                              <span style="color: #ff0000; display:none; " id="error_editlabname<?=$i?>">Please enter Lab Name</span>
                              <input type="hidden" value="{{ $getlabs->lab_id }}" id="id<?=$i?>" />
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-d" id="deletelabid<?=$i?>">Delete</button>
                        <button type="button" data-dismiss="modal" class="btn btn-c">Cancel</button>
                        <button type="button" class="btn btn-s" id="editlab<?=$i?>">Save</button>
                      </div>
                    </div>
                  </div>
                </div>

                <script>
                          $("#editlab<?=$i?>").click(function(){
                            var labname = $('#editlabname<?=$i?>').val();
                            var id      = $("#id<?=$i?>").val();

                            if(labname != ""){
                              $("#error_editlabname<?=$i?>").hide();
                              $.ajax
                                ({
                                    type: "POST",
                                    url: "{{ url('/editlab') }}",
                                    data: 'id='+id+'&labname='+labname+'&_token=<?php echo csrf_token(); ?>',
                                    cache: false,
                                    async:false,
                                    success: function(data)
                                    {
                                        if(data.status == 'success'){
                                          window.location.href = '/labs';
                                        }else{
                                          alert('Something went wrong.')
                                        }

                                    }
                                });
                            }else{
                                $("#error_editlabname<?=$i?>").show();
                            }
                          });

                          $("#deletelabid<?=$i?>").click(function(){
                            $("#error_eiditlabname<?=$i?>").hide();
                          if (confirm("Do you want to delete")){

                              var id      = $("#id<?=$i?>").val();

                                $.ajax
                                  ({
                                      type: "POST",
                                      url: "{{ url('/deletelab') }}",
                                      data: 'id='+id+'&_token=<?php echo csrf_token(); ?>',
                                      cache: false,
                                      async:false,
                                      success: function(data)
                                      {
                                          if(data.status == 'success'){
                                            window.location.href = '/labs';
                                          }else{
                                            alert('Something went wrong.')
                                          }

                                      }
                                  });

                          }
                        });
                  </script>

                <!-- edit popup ends -->
                <?php $i++; ?>
                @endforeach
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


          </div>
      </div>
      <div class="clearfix"></div>
      <!-- popup -->
      <div class="modal fade in" id="add-lab" tabindex="-1" role="dialog" aria-hidden="false">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title">ADD LAB</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="form-group col-md-12 nopadmar">
                  <label class="col-md-4 line-h">VL Testing Lab Name</label>
                  <div class="col-md-8">
                    <input class="form-control-n" name="lab" id="lab">
                    <span style="color: #ff0000; display:none; " id="error_labname">Please enter Lab Name</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" data-dismiss="modal" class="btn btn-c">Cancel</button>
              <button type="button" class="btn btn-s" id="addlab">Save</button>
            </div>
          </div>
        </div>
      </div>
      <!-- popup ends -->

    </section>
  </aside>
  <!-- right-side -->
  <hr>
</div>
@stop
@section('script')
  <script type="text/javascript">
    $("#addlab").click(function(){
      var labname = $('#lab').val();
      if(labname != ""){
        $("#error_labname").hide();
        $.ajax
          ({
              type: "POST",
              url: "{{ url('/addlab') }}",
              data: 'labname='+labname+'&_token=<?php echo csrf_token(); ?>',
              cache: false,
              async:false,
              success: function(data)
              {
                  if(data.status == 'success'){
                    window.location.href = '/labs';
                  }else{
                    alert('Something went wrong.')
                  }

              }
          });
      }else{
          $("#error_labname").show();
      }
    });

    $('#showall').click(function(){
      window.location.href = '{{ Request::url() }}?lists=all';
    });
    </script>
@stop
