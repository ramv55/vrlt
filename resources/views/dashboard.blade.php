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
                        <div class="col-lg-4 col-md-4 col-sm-4 margin_10">
                          <!-- Trans label pie charts strats here-->
                          <div class="redbg no-radius">
                            <div class="panel-body squarebox square_boxs">
                              <div class="col-xs-12 pull-left nopadmar">
                                <h4 class="alert-heading">ENROLLMENT ALERTS</h4>
                                <div class="text-sec">
                                  <p>Client Not on ART = <span><a class="red" href="/dashboard/?alert=clientonart"><?=$client_on_art?></a></span></p>
                                  <p>Pregnant or Breastfeeding<br>
                Not in PMTCT = <span><a class="red"  href="/dashboard/?alert=clientenroll"><?=$client_enrolled?></a></span></p>

                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-4 col-sm-4 col-md-4 margin_10 animated">
                          <!-- Trans label pie charts strats here-->
                          <div class="goldbg no-radius">
                            <div class="panel-body squarebox square_boxs">
                              <div class="col-xs-12 pull-left nopadmar">
                                <h4 class="alert-heading">TESTING ALERTS</h4>
                                <div class="text-sec">
                                  <p>Critical Viral Load = <span><a class="red"  href="/dashboard/?alert=criticalviralload"><?=$critical_viral_load?></a></span></p>
                                  <p>Rising Viral Load (+25%) = <span><a class="red"  href="/dashboard/?alert=raisingviralload"><?=$raising_viral_load?></a></span></p>
                                  <p>Missed Viral Load Test = <span><a class="red"  href="/dashboard/?alert=missedviralloadtest"><?=$missed_viral_load_test?></a></span></p>
                                </div>

                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 margin_10 animated">
                          <!-- Trans label pie charts strats here-->
                          <div class="palebluecolorbg no-radius">
                            <div class="panel-body squarebox square_boxs">
                              <div class="col-xs-12 pull-left nopadmar">
                                <h4 class="alert-heading">LABORATORY ALERTS</h4>
                                <div class="text-sec">
                                  <p>Sample Not Received = <span><a class="red"  href="/dashboard/?alert=samplereceived"><?=$count_sample_recd_lab?></a></span></p>
                                  <p>Delayed Lab Result = <span><a class="red"  href="/dashboard/?alert=delayedlabresults"><?=$count_delayed_lab_results?></a></span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>


            <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 margin_10">
                        <!-- Trans label pie charts strats here-->
                        <div class="search-bx no-radius">
                            <div class="panel-body squarebox square_boxs">
                                <div class="nopadmar">
                                    <div class="row">
                                        <div class="text-left">
                                        <form id="form-id" method="get" action="" onsubmit="myFunction()">
<fieldset>

                                        <div class="form-group col-md-12 col-lg-3" >
                                            <label for="name">Facility Name</label>
                                                <input id="fname" name="fname" value="<?php if(isset($_GET['fname'])) echo $_GET['fname']; ?>" class="form-control"  type="text">
                                        </div>
                                         <div class="form-group col-md-12 col-lg-2">
                                            <label for="name">Client Unique ID</label>
                                                <input maxlength="14" id="uid" name="uid" value="<?php if(isset($_GET['uid'])) echo $_GET['uid']; ?>" class="form-control"  type="text">
                                        </div>
                                        <div class="form-group col-md-12 col-lg-2">
                                            <label  for="name">Client DOB</label>
                                                <div class="input-group">
                            <input type="text" class="form-control" name="dob" id="rangepicker13" value="<?php if(isset($_GET['dob'])) echo $_GET['dob']; ?>"/>
                            <div class="cal-icon2"><img src="/img/vew.png" width="22" alt="calender-icon"></div></div>
                            </div>
                                        <div class="form-group col-md-12 col-lg-3">
                                            <label  for="name">Client Phone Number</label>
                                            <div id="apDiv1">255</div>
                                                <input maxlength="9" value="<?php if(isset($_GET['phone'])) echo $_GET['phone']; ?>" id="phone" name="phone" class="form-control-number" type="text">
                                        </div>


                                        <div class="form-group col-md-12 col-lg-2">
                                        <button type="submit" class="btn btn-responsive search-btn">Search</button>
                                                <button type="reset" class="btn btn-responsive reset-btn">Reset</button>

                                        </div>
                                    </fieldset>
                                    </form>                                       </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
            </div>
                <!--/row-->
                <div class="row">
        <div class="col-md-12 ">
        <div class="table-scrollable">
            <button type="button" class="btn btn-responsive see-btn" id="seeall"  data-toggle="button">See All</button>

                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th width="12%" bgcolor="#666665">Date Enrolled</th>
                                              <th width="13%" bgcolor="#666665">Client ID</th>
                                              <th width="11%" bgcolor="#666665">ART Status</th>
                                              <th width="11%" bgcolor="#666665">ART Initiated</th>
                                              <th width="11%" bgcolor="#666665">Last Test</th>
                                              <th width="10%" bgcolor="#666665">Last Viral Load</th>
                                              <th width="13%" bgcolor="#666665">Sex</th>
                                              <th width="12%" bgcolor="#666665"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php
                                            $i = 0;
                                             if(count($results) > 0){
                                              foreach ($results as $res) {
                                                if($i%2 != 0){
                                  								$rwclass = 'odd';
                                  								$bg = '';
                                  							}else {
                                  								$rwclass = '';
                                  								$bg = 'bgcolor="#f1f2f1"';

                                  							}
                                           ?>
                                            <tr class="<?=$rwclass?>">
                                              <td <?=$bg?>><?=date("m/d/Y", strtotime($res->created_at));?></td>
                                              <td <?=$bg?>><?=$res->client_uid?></td>

                                              <?php
                                                  $treatment = DB::table('treatment')
                                                  ->select('art_status','art_initiated_date')
                                                  ->where('client_id',$res->client_id)
                                                  ->orderBy('treatment_id','desc')->first();
                                               ?>
                                              <td <?=$bg?>><?=@$treatment->art_status?></td>
                                              <td <?=$bg?>><?=@$treatment->art_initiated_date?></td>
                                              <?php
                                              // $order_lab_test = DB::select("select * from (select * from order_lab_work where client_id = '".$res->client_id."' order by order_lab_work_id desc limit 1,1) t group by t.client_id");
                                              //
                                              $order_lab_test = DB::select("select * from order_lab_work where client_id = '".$res->client_id."' order by order_lab_work_id");
                                              ?>
                                              <td <?=$bg?>>
                                                <?php

                                                $lastdate = @date("m/d/Y", strtotime($order_lab_test[0]->created_at));
                                                if($lastdate != '01/01/1970'){
                                                  echo $lastdate;
                                                }

                                                ?></td>
                                              <?php

                                                // $labres = DB::select("select * from (select client_id,hiv_viral_load_results from lab_results where client_id = '".$res->client_id."' order by lab_results_id desc limit 1,1) t group by t.client_id");
                                                $labres = DB::select("select client_id,hiv_viral_load_results from lab_results where client_id = '".$res->client_id."' order by lab_results_id desc");
                                               ?>
                                              <td <?=$bg?>><?=@$labres[0]->hiv_viral_load_results?></td>
                                              <td <?=$bg?>>
                                                  <?php
                                                      if($res->gender == 'M'){
                                                        echo 'Male';
                                                      }else {
                                                        echo 'Female';
                                                      }
                                                   ?>
                                              </td>
                                              <td align="center" <?=$bg?>><a href="/editclient/<?=$res->client_id?>" style="font-size:18px;"><img src="/img/pencil-icon.png" width="20" height="21" alt="pencil-icon"></a></td>
                                        </tr>
                                          <?php
                                            $i++;
                                            }
                                          }else {
                                        ?>
                                        <tr>
                                          <td bgcolor="#f1f2f1" colspan="8" style="text-align:center;">Empty Results</td>
                                        </tr>
                                        <?php
                                          }
                                          ?>
                                        </tbody>
                </table>
          </div>
          </div>
          <div class="clearfix"></div>
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
            </section>
        </aside>
        <!-- right-side -->


    </div>
@stop
@section('script')
<script>

$("#phone").keydown(function(event) {
        // Allow only backspace and delete
        if ( event.keyCode == 46 || event.keyCode == 8 || e.keyCode == 17) {
            // let it happen, don't do anything
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.keyCode < 48 || event.keyCode > 57 ) {
                event.preventDefault();
            }
        }
    });

    $('#show').change(function(){
        var val = $(this).val();

        var fname = $.urlParam('fname');
        var uid = $.urlParam('uid');
        var dob = $.urlParam('dob');
        var phone = $.urlParam('phone');

        if(fname != null && uid != null && dob != null && phone != null){
            window.location.href = '{{ Request::url() }}?fname='+fname+'&uid='+uid+'&dob='+dob+'&phone='+phone+'&lists='+val;
        }else if(fname != null && uid != null && dob != null){
          window.location.href = '{{ Request::url() }}?fname='+fname+'&uid='+uid+'&dob='+dob+'&lists='+val;
        }else if(fname != null && uid != null && phone != null){
            window.location.href = '{{ Request::url() }}?fname='+fname+'&uid='+uid+'&phone='+phone+'&lists='+val;
        }else if(fname != null && phone != null && dob != null){
            window.location.href = '{{ Request::url() }}?fname='+fname+'&dob='+dob+'&phone='+phone+'&lists='+val;
        }else if(uid != null && phone != null && dob != null){
            window.location.href = '{{ Request::url() }}?uid='+uid+'&dob='+dob+'&phone='+phone+'&lists='+val;
        }else if(fname != null && uid != null){
            window.location.href = '{{ Request::url() }}?fname='+fname+'&uid='+uid+'&lists='+val;
        }else if(fname != null && dob != null){
          window.location.href = '{{ Request::url() }}?fname='+fname+'&dob='+dob+'&lists='+val;
        }else if(fname != null && phone != null){
          window.location.href = '{{ Request::url() }}?fname='+fname+'&phone='+phone+'&lists='+val;
        }else if(dob != null && uid != null){
          window.location.href = '{{ Request::url() }}?uid='+uid+'&dob='+dob+'&lists='+val;
        }else if(phone != null && uid != null){
          window.location.href = '{{ Request::url() }}?uid='+uid+'&phone='+phone+'&lists='+val;
        }else if(phone != null && fname != null){
          window.location.href = '{{ Request::url() }}?fname='+fname+'&phone='+phone+'&lists='+val;
        }else if(phone != null && dob != null){
          window.location.href = '{{ Request::url() }}?dob='+dob+'&phone='+phone+'&lists='+val;
        }else if(fname != null){
          window.location.href = '{{ Request::url() }}?fname='+fname+'&lists='+val;
        }else if(uid != null){
          window.location.href = '{{ Request::url() }}?uid='+uid+'&lists='+val;
        }else if(dob != null){
          window.location.href = '{{ Request::url() }}?dob='+dob+'&lists='+val;
        }else if(phone != null){
          window.location.href = '{{ Request::url() }}?phone='+phone+'&lists='+val;
        }else {
          window.location.href = '{{ Request::url() }}?lists='+val;
        }

    });

    $('#seeall').click(function(){

      var fname = $.urlParam('fname');
      var uid = $.urlParam('uid');
      var dob = $.urlParam('dob');
      var phone = $.urlParam('phone');

      var fname = $.urlParam('fname');
      var uid = $.urlParam('uid');
      var dob = $.urlParam('dob');
      var phone = $.urlParam('phone');

      if(fname != null && uid != null && dob != null && phone != null){
          window.location.href = '{{ Request::url() }}?fname='+fname+'&uid='+uid+'&dob='+dob+'&phone='+phone+'&lists=all';
      }else if(fname != null && uid != null && dob != null){
        window.location.href = '{{ Request::url() }}?fname='+fname+'&uid='+uid+'&dob='+dob+'&lists=all';
      }else if(fname != null && uid != null && phone != null){
          window.location.href = '{{ Request::url() }}?fname='+fname+'&uid='+uid+'&phone='+phone+'&lists=all';
      }else if(fname != null && phone != null && dob != null){
          window.location.href = '{{ Request::url() }}?fname='+fname+'&dob='+dob+'&phone='+phone+'&lists=all';
      }else if(uid != null && phone != null && dob != null){
          window.location.href = '{{ Request::url() }}?uid='+uid+'&dob='+dob+'&phone='+phone+'&lists=all';
      }else if(fname != null && uid != null){
          window.location.href = '{{ Request::url() }}?fname='+fname+'&uid='+uid+'&lists=all';
      }else if(fname != null && dob != null){
        window.location.href = '{{ Request::url() }}?fname='+fname+'&dob='+dob+'&lists=all';
      }else if(fname != null && phone != null){
        window.location.href = '{{ Request::url() }}?fname='+fname+'&phone='+phone+'&lists=all';
      }else if(dob != null && uid != null){
        window.location.href = '{{ Request::url() }}?uid='+uid+'&dob='+dob+'&lists=all';
      }else if(phone != null && uid != null){
        window.location.href = '{{ Request::url() }}?uid='+uid+'&phone='+phone+'&lists=all';
      }else if(phone != null && fname != null){
        window.location.href = '{{ Request::url() }}?fname='+fname+'&phone='+phone+'&lists=all';
      }else if(phone != null && dob != null){
        window.location.href = '{{ Request::url() }}?dob='+dob+'&phone='+phone+'&lists=all';
      }else if(fname != null){
        window.location.href = '{{ Request::url() }}?fname='+fname+'&lists=all';
      }else if(uid != null){
        window.location.href = '{{ Request::url() }}?uid='+uid+'&lists=all';
      }else if(dob != null){
        window.location.href = '{{ Request::url() }}?dob='+dob+'&lists=all';
      }else if(phone != null){
        window.location.href = '{{ Request::url() }}?phone='+phone+'&lists=all';
      }else {
        window.location.href = '{{ Request::url() }}?lists=all';
      }

    });

    $.urlParam = function(name){
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
        if (results==null){
           return null;
        }
        else{
           return results[1] || 0;
        }
    }

    function myFunction()
      {
          var myForm = document.getElementById('form-id');
          var allInputs = myForm.getElementsByTagName('input');
          var input, i;

          for(i = 0; input = allInputs[i]; i++) {
              if(input.getAttribute('name') && !input.value) {
                  input.setAttribute('name', '');
              }
          }
      }
</script>
@stop
