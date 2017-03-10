@extends('layout.main')
@section('content')
@include('includes.top')
<div class="wrapper row-offcanvas row-offcanvas-left">
  @include('includes.sidebar')
  <!-- Right side column. Contains the navbar and content of the page -->
  <aside class="right-side">
    <section class="content">
      <h2 class="text-center viral-load-title" style="margin-bottom:30px;">Viral Load System</h2>
<form id='form0'>
      <div class="row">

        <div class="col-md-3 col-md-offset-1">
          <div class="form-group">
            <label>Client Unique Identification</label>
            <?php
                $expuid = explode('-', $clientdetails->client_uid);
             ?>
            <div class="row">
              <div class="col-md-5" style="padding:0 !important;">
                <input class="form-control-n required" value="<?=$expuid[0]?>" id="uid1" name="uid1" maxlength="8" />
              </div>
              <div class="col-md-2" style="line-height:40px;">-</div>
              <div class="col-md-5" style="padding:0 !important;">
                <input class="form-control-n required" value="<?=$expuid[1]?>" id="uid2" name="uid2" maxlength="6" />
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2 col-md-offset-1">
          <label  for="name">Client DOB</label>
          <div class="input-group">
            <input type="text" value="<?=$clientdetails->dob?>" class="form-control-n" id="rangepicker15" />
            <div class="cal-icon"><img src="/img/vew.png" width="22" alt="calender-icon"></div>
          </div>
        </div>
        <div class="col-md-2 col-md-offset-1">
          <div class="form-group">
            <label>Last Viral Load Date</label>
            <input value="<?=@$labres->date_of_reporting?>" class="form-control-n" id="last_viral_load_date" readonly />
          </div>
        </div>

      </div>

      <div class="row">

        <div class="col-md-3 col-md-offset-1">
          <div class="form-group">
            <label>Client Name</label>
            <input class="form-control-n" name="client_name" id="client_name" value="<?=$clientdetails->name?>" />
          </div>
        </div>
        <div class="col-md-2 col-md-offset-1">
          <label  for="name">Age</label>
          <input class="form-control-n" style="width:50%;" id="age" value="<?=$clientdetails->age?>">
        </div>
        <div class="col-md-2 col-md-offset-1">
          <div class="form-group">
            <label>Last Viral Load Result</label>
            <input value="<?=@$labres->hiv_viral_load_results?>" class="form-control-n" id="last_viral_load_result" readonly />
          </div>
        </div>
      </div>
      <?php
          if($clientdetails->client_counselled == 1){
            $couns_disabled = '';
            $couns_label = '';
            $client_couns_checked = 'checked';
          }else {
            $couns_disabled = 'disabled';
            $couns_label = 'client-details';
            $client_couns_checked = '';
          }



            if($clientdetails->increase_note == 1){
                $increase_disabled = '';
                $increase_label = '';
                $increase_note_checked = 'checked';
              }else {
                $increase_disabled = 'disabled';
                $increase_label = 'client-details';
                $increase_note_checked = '';
              }

       ?>
      <div class="row" style="margin-top:15px;">
        <div class="col-md-3 col-md-offset-1">
          <div class="form-group">

            <input name="client_counselled" id="client_counselled" type="checkbox" class="minimal-blue" <?=$couns_disabled?> <?=$client_couns_checked?>>
            <label style="margin-left:10px;" class="<?=$couns_label?>">Client Councelled</label>
          </div>
        </div>
    </div>
      <div class="row" style="margin-top:0px; margin-bottom:35px;">
        <div class="col-md-3 col-md-offset-1">

            <input name="increase_note" id="increase_note" type="checkbox" class="minimal-blue" <?=$increase_disabled?> <?=$increase_note_checked?>>
            <label style="margin-left:10px;" class="<?=$increase_label?>">25% Increase Noted</label>
        </div>

      </div>
      </form>
      <div class="row">
        <div class="col-md-12">
          <div class="panel-body">
            <div class="bs-example">
              <ul class="nav nav-tabs" style="margin-bottom: 15px;">
                <li class="active"> <a href="#client-details" data-toggle="tab">Client Details</a> </li>
                <li> <a href="#treatment" data-toggle="tab">Treatment</a> </li>
                <li> <a href="#testing" data-toggle="tab">Testing</a> </li>
                <li> <a href="#lab-reporting" data-toggle="tab">LAB - Results Reporting</a> </li>
                <li> <a href="#discharge" data-toggle="tab">Discharge</a> </li>
                <li> <a href="#comments" data-toggle="tab">Comments</a> </li>
              </ul>
              <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active in" id="client-details">
                  <form id="form1">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="col-md-5 control-label line-h" >Client Phone # </label>
                        <div class="col-md-7" style="padding:">
                          <div class="code">+255</div>
                          <input id="phone" name="phone" maxlength="9" class="form-control-new" type="text" value="<?=$clientdetails->phone?>"/>
                        </div>
                      </div>
                    </div>
                    <?php

                      if(Auth::user()->role == 0){
                          $getfid = App\User::where('user_id', '=', $clientdetails->created_by)->first();
                          $getFacilityInfo = App\Models\Facility::where('facility_id', '=', $getfid->facility_id)->first();

                      }else{
                        $getFacilityInfo = App\Models\Facility::where('facility_id', '=', Auth::user()->facility_id)->first();
                      }
                     ?>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="col-md-5 control-label line-h" >Facility CTC No.</label>
                        <div class="col-md-7"><input  value="<?=@$getFacilityInfo->facility_ctc_no?>" class="form-control-n" type="text" readonly /></div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="col-md-5 control-label line-h" >Facility Name</label>
                        <div class="col-md-7"><input value="<?=@$getFacilityInfo->facility_name?>" class="form-control-n" type="text" readonly /></div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="col-md-4 control-label line-h" >Gender</label>
                        <div class="col-md-7">
                          <select id="gender"  class="form-control">
                            <option value="">-- Select --</option>
                            <option value="M" <?php if($clientdetails->gender == 'M') echo 'selected'; ?>>Male</option>
                            <option value="F" <?php if($clientdetails->gender == 'F') echo 'selected'; ?>>Female</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <?php
                        if($clientdetails->gender == 'F'){
                            $pr_bf = '';
                            $pr_bf_label = '';
                        }else {
                          $pr_bf = 'disabled';
                          $pr_bf_label = 'client-details';
                        }

                     ?>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label id="pregnant_bf_label" class="col-md-6 control-label <?=$pr_bf_label?>">Pregnant or
                          Breastfeeding</label>
                        <div class="col-md-6">
                          <select id="pregnant_bf" <?=$pr_bf?> class="form-control">
                          <option value="">— Select —</option>
                          <option value="1" <?php if($clientdetails->pregnant_feeding == 1) echo 'selected'; ?>>Yes</option>
                          <option value="0" <?php if($clientdetails->pregnant_feeding == 0) echo 'selected'; ?>>No</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <?php
                        if($clientdetails->pregnant_feeding == 1){
                            $cl_en = '';
                            $cl_en_label = '';
                        }else {
                          $cl_en = 'disabled';
                          $cl_en_label = 'client-details';
                        }

                     ?>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label id="enrolled_in_label" class="col-md-5 control-label <?=$cl_en_label?>" >Enrolled in
                          PMTCT</label>
                        <div class="col-md-7">
                          <select id="enrolled_in" <?=$cl_en?> class="form-control">
                          <option value="">— Select —</option>
                          <option value="1" <?php if($clientdetails->currently_enrolled_in == 1) echo 'selected'; ?>>Yes</option>
                          <option value="0" <?php if($clientdetails->currently_enrolled_in == 0) echo 'selected'; ?>>No</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <?php
                        if($clientdetails->currently_enrolled_in == 1){
                            $cl_pmtct = '';
                            $cl_pmtct_label = '';
                        }else {
                          $cl_pmtct = 'disabled';
                          $cl_pmtct_label = 'client-details';
                        }

                     ?>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label id="rangepicker18_label" class="col-md-4 control-label <?=$cl_pmtct_label?>">PMTCT
                          Enrollment</label>
                        <div class="col-md-8">
                          <div class="input-group">
                            <input type="text" <?=$cl_pmtct?> class="form-control-n" id="rangepicker18" value="<?=$clientdetails->pmct_enrolment_date?>"/>
                            <div class="cal-icon"><img src="/img/vew.png" width="22" alt="calender-icon"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="clearfix"></div>

                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="col-md-7 control-label line-h">Is Client a TB Suspect?</label>
                        <div class="col-md-5">
                          <select id="client_tb_suspect"  class="form-control">
                          <option value="">— Select —</option>
                          <option value="1" <?php if($clientdetails->tb_suspect == 1) echo 'selected'; ?>>Yes</option>
                          <option value="0" <?php if($clientdetails->tb_suspect == 0) echo 'selected'; ?>>No</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <?php
                        if($clientdetails->tb_suspect == 1){
                            $tb_medic = '';
                            $tb_medic_label = '';
                        }else {
                          $tb_medic = 'disabled';
                          $tb_medic_label = 'client-details';
                        }

                     ?>
                    <div class="col-md-5">
                      <div class="form-group">
                        <label id="tb_medication_label" class="col-md-7 control-label line-h <?=$tb_medic_label?> text-right">Is Client on TB Medication?</label>
                        <div class="col-md-5">
                          <select id="tb_medication" <?=$tb_medic?> class="form-control">
                          <option value="">— Select —</option>
                          <option value="1" <?php if($clientdetails->tb_medication == 1) echo 'selected'; ?>>Yes</option>
                          <option value="0" <?php if($clientdetails->tb_medication == 0) echo 'selected'; ?>>No</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <?php
                        if(Auth::user()->role == 1 || Auth::user()->role == 0){
                     ?>
                    <div class="col-md-12 text-center">
                      <button type="button" id="firststep" class="btn btn-responsive save-btn" style=" height:30px; font-size:14px; font-weight:bold;">SAVE</button>
                    </div>
                    <?php } ?>
                  </div>
                </form>
                </div>
                <div class="tab-pane fade" id="treatment">
                  <form action="" id="form2">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="col-md-4 control-label line-h" >ART Status</label>
                        <div class="col-md-6">
                          <select id="art_status" class="form-control">
                          <option value="">— Select —</option>
                          <option value="Not Yet Initiated" <?php if($treatment->art_status == 'Not Yet Initiated') echo 'selected'; ?>>Not Yet Initiated</option>
                          <option value="Newly Initiated" <?php if($treatment->art_status == 'Newly Initiated') echo 'selected'; ?>>Newly Initiated</option>
                          <<option value="Ongoing ART Client" <?php if($treatment->art_status == 'Ongoing ART Client') echo 'selected'; ?>>Ongoing ART Client</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <?php

                        if($treatment->art_status == 'Newly Initiated') {
                              $ar_st = '';
                              $ar_st_label = '';
                              $on_art = 'disabled';
                              $on_art_label = 'client-details';
                        } elseif ($treatment->art_status == 'Ongoing ART Client') {
                          $ar_st = '';
                          $ar_st_label = '';

                          $on_art = '';
                          $on_art_label = '';
                        } else {
                          $ar_st = 'disabled';
                          $ar_st_label = 'client-details';
                          $on_art = 'disabled';
                          $on_art_label = 'client-details';
                        }
                     ?>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label id="rangepicker10_label" class="col-md-5 control-label <?=$ar_st_label?>">Date Initiated on ART</label>
                        <div class="col-md-6">
                          <div class="input-group">
                            <input type="text" value="<?=$treatment->art_initiated_date?>"  class="form-control-n"  <?=$ar_st?> id="rangepicker10" />
                            <div class="cal-icon"><img src="/img/vew.png" width="22" alt="calender-icon"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label id="artmedication_label" class="col-md-5 control-label <?=$ar_st_label?> line-h"  >ART Medication </label>
                        <div class="col-md-7">
                          <select id="artmedication" class="form-control" <?=$ar_st?>>
                            <option value="">-- Select --</option>
                            <option value="firstline" <?php if($treatment->art_medication == 'firstline') echo 'selected'; ?>>First Line</option>
                            <option value="secondline" <?php if($treatment->art_medication == 'secondline') echo 'selected'; ?>>2nd Line (with specifics of drug type) </option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="col-md-4 control-label line-h">Sex</label>
                        <div class="col-md-7">
                          <select id="tr_gender" class="form-control" disabled>
                            <option value="">-- Select --</option>
                            <option value="M" <?php if($clientdetails->gender == 'M') echo 'selected'; ?>>Male</option>
                            <option value="F" <?php if($clientdetails->gender == 'F') echo 'selected'; ?>>Female</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label id="tr_pregnat_bf_label" class="col-md-6 control-label client-details">Pregnant or
                          Breastfeeding</label>
                        <div class="col-md-6">
                          <select id="tr_pregnat_bf" class="form-control" disabled>
                            <option value="">-- Select --</option>
                            <option value="1" <?php if($clientdetails->pregnant_feeding == 1) echo 'selected'; ?>>Yes</option>
                            <option value="0" <?php if($clientdetails->pregnant_feeding == 0) echo 'selected'; ?>>No</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label id="tr_enrolled_in_label" class="col-md-6 control-label client-details" >Enrolled in
                          PMTCT</label>
                        <div class="col-md-6">
                          <select id="tr_enrolled_in" class="form-control" disabled>
                            <option value="">-- Select --</option>
                            <option value="1" <?php if($clientdetails->currently_enrolled_in == 1) echo 'selected'; ?>>Yes</option>
                            <option value="0" <?php if($clientdetails->currently_enrolled_in == 0) echo 'selected'; ?>>No</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label id="tr_pmctc_enrolled_date_label" class="col-md-4 control-label client-details"  >PMTCT
                          Enrollment</label>
                        <div class="col-md-8">
                          <div class="input-group">
                            <input type="text" value="<?=$clientdetails->pmct_enrolment_date?>" class="form-control-n" id="tr_pmctc_enrolled_date" disabled/>
                            <div class="cal-icon"><img src="/img/vew.png" width="22" alt="calender-icon"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label id="previous_regimens_label" class="col-md-4 control-label <?=$on_art_label?>" style="margin-top:5px;" >Previous Regimens</label>
                        <div class="col-md-8">
                          <input id="previous_regimens" <?=$on_art?> class="form-control-n" type="text" value="<?=$treatment->previous_regimens?>" />
                        </div>
                      </div>
                    </div>
                    <?php
                        if(Auth::user()->role == 1 || Auth::user()->role == 0){
                     ?>
                    <div class="col-md-12 text-center">
                      <button type="submit" class="btn btn-responsive save-btn" style=" height:30px; font-size:14px; font-weight:bold;">SAVE</button>
                    </div>
                    <?php } ?>
                  </div>
                    </form>



                  <div class="row">
                    <div class="col-md-12 ">
                      <div class="table-scrollable">
                        <h5 style="margin:10px;"><strong>Past Treatments</strong></h5>
                        <table class="table table-bordered table-hover">
                          <thead>
                            <tr>
                              <th width="12%" bgcolor="#666665">Date Entered</th>
                              <th width="13%" bgcolor="#666665">ART Status</th>
                              <th width="11%" bgcolor="#666665">ART Initiated</th>
                              <th width="11%" bgcolor="#666665">Medication</th>
                              <th width="11%" bgcolor="#666665">Sex</th>
                              <th width="11%" bgcolor="#666665">Pregnant/ Breastfeeding</th>
                              <th width="10%" bgcolor="#666665">PMTCT</th>
                              <th width="13%" bgcolor="#666665">PMTCT Date</th>
                              <th width="12%" bgcolor="#666665">Previous Regimen</th>
                            </tr>
                          </thead>
                          <tbody id="tr_tbody">
                            <?php
                                $i = 0;
                                $previoustreatmentlists = DB::select("select * from treatment where treatment_id != (SELECT MAX(treatment_id) FROM treatment where client_id = '$id') and client_id = '$id' order by treatment_id desc");
                                foreach ($previoustreatmentlists as $prtreatment) {
                                  if($i%2 != 0){
                                    $rwclass = 'odd';
                                    $bg = '';
                                  }else {
                                    $rwclass = '';
                                    $bg = 'bgcolor="#f1f2f1"';

                                  }
                             ?>
                            <tr class="<?php echo $rwclass; ?>">
                              <td <?=$bg?>><?=date("d/m/Y", strtotime($prtreatment->created_at));?></td>
                              <td <?=$bg?>><?=$prtreatment->art_status?></td>
                              <td <?=$bg?>><?=$prtreatment->art_initiated_date?></td>
                              <td <?=$bg?>><?=$prtreatment->art_medication?></td>
                              <td <?=$bg?>>
                                <?php
                                  if($clientdetails->gender == 'M'){
                                    echo 'Male';
                                  }else {
                                    echo 'Female';
                                  }
                                ?></td>
                              <td <?=$bg?>>
                                <?php
                                if($clientdetails->pregnant_feeding == 1){
                                  echo 'Yes';
                                }else {
                                  echo "No";
                                }
                                ?>
                              </td>
                              <td <?=$bg?>>
                                <?php
                                if($clientdetails->currently_enrolled_in == 1){
                                  echo 'Yes';
                                }else {
                                  echo "No";
                                }
                                ?>
                              </td>
                              <td <?=$bg?>><?=$clientdetails->pmct_enrolment_date?></td>
                              <td <?=$bg?>><?=$prtreatment->previous_regimens?></td>
                            </tr>
                          <?php
                                $i++;
                              }
                           ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>

                </div>

                <div class="tab-pane fade" id="testing">

                  <form id="form3">
                  <div class="row">
                    <div class="col-md-12">
                      <h2 class="order">ORDER LAB WORK</h2>

                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="col-md-5 control-label"  >Date Sample
                          Collected</label>
                        <div class="col-md-7">
                          <div class="input-group">
                            <input type="text" class="form-control-n" id="rangepicker6" value="<?=$treatmentlabwork->sample_collected_date?>" />
                            <div class="cal-icon"><img src="/img/vew.png" width="22" alt="calender-icon"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="col-md-5 control-label line-h">Reason for Test</label>
                        <div class="col-md-7">
                          <select id="test_reason" class="form-control" >
                            <option value="">— Select —</option>
                            <option value="First Test" <?php if($treatmentlabwork->reason_for_test == 'First Test') echo 'selected'; ?>>First Test</option>
                            <option value="Repeat Test or Suspected Treatment Failure" <?php if($treatmentlabwork -> reason_for_test == 'Repeat Test or Suspected Treatment Failure') echo 'selected'; ?>>Repeat Test or Suspected Treatment Failure</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="col-md-5 control-label line-h" >Collected By</label>
                        <div class="col-md-7">
                          <input id="collected_by" class="form-control-n" type="text" value="<?=$treatmentlabwork -> collected_by?>" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-5">
                      <div class="form-group">
                        <label class="col-md-4 control-label line-h" >Test Requested by</label>
                        <div class="col-md-7">
                          <select class="form-control" id="test_requested_by">
                            <option value="">— Select —</option>
                            <option value="Clinician" <?php if($treatmentlabwork->test_requested_by == 'Clinician') echo 'selected'; ?>>Clinician</option>
                            <option value="CTC Nurse" <?php if($treatmentlabwork->test_requested_by == 'CTC Nurse') echo 'selected'; ?>>CTC Nurse</option>
                            <option value="ART Nurse" <?php if($treatmentlabwork->test_requested_by == 'ART Nurse') echo 'selected'; ?>>ART Nurse</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="col-md-5 control-label" >Adherence Counseling
                          Completed?</label>
                        <div class="col-md-3">
                          <select class="form-control" id="counseling">
                            <option value="">— Select —</option>
                            <option value="1" <?php if($treatmentlabwork->counseling == 1) echo 'selected'; ?>>Yes</option>
                            <option value="0" <?php if($treatmentlabwork->counseling == 0) echo 'selected'; ?>>No</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="col-md-5 control-label line-h">Sample Type</label>
                        <div class="col-md-7">
                          <select class="form-control" id="sample_type">
                            <option value="">— Select —</option>
                            <option value="Dry Blood Spot" <?php if($treatmentlabwork->sample_type == "Dry Blood Spot") echo 'selected'; ?>>Dry Blood Spot</option>
                            <option value="Plasma or Whole Blood" <?php if($treatmentlabwork->sample_type == "Plasma or Whole Blood") echo 'selected'; ?>>Plasma or Whole Blood</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="col-md-5 control-label"  >Date Sample
Shipped to Lab</label>
                        <div class="col-md-7">
                          <div class="input-group">
                            <input type="text" class="form-control-n" id="rangepicker8" value="<?=$treatmentlabwork->sample_shipped_date?>" />
                            <div class="cal-icon"><img src="/img/vew.png" width="22" alt="calender-icon"></div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="col-md-5 control-label line-h">Next Test Date</label>
                        <div class="col-md-7">
                          <div class="input-group">
                            <input type="text" class="form-control-n" id="nexttestdate" value="<?=$treatmentlabwork->nexttestdate?>"/>
                            <div class="cal-icon"><img src="/img/vew.png" width="22" alt="calender-icon"></div>
                          </div>
                        </div>
                      </div>
                    </div>



                    <?php
                        if(Auth::user()->role == 1 || Auth::user()->role == 0){
                     ?>
                    <div class="col-md-12 text-center">
                      <button type="submit" class="btn btn-responsive bl-btn">Order Lab Work</button>
                    </div>
                    <?php } ?>
                  </div>
                </form>



                  <div class="row">
                    <div class="col-md-12 ">
                      <div class="table-scrollable">
                        <h5 style="margin:10px;"><strong>Past Lab Orders</strong></h5>
                        <table class="table table-bordered table-hover">
                          <thead>
                            <tr>
                              <th width="12%" bgcolor="#666665">Date Entered</th>
                              <th width="13%" bgcolor="#666665">Sample Collected</th>
                              <th width="11%" bgcolor="#666665">Reason for Test</th>
                              <th width="11%" bgcolor="#666665">Collected By</th>
                              <th width="11%" bgcolor="#666665">Requested By</th>
                              <th width="11%" bgcolor="#666665">Counseling</th>
                              <th width="10%" bgcolor="#666665">Sample Type</th>
                              <th width="13%" bgcolor="#666665">Date Shipped</th>
                            </tr>
                          </thead>
                          <tbody id="tr_lab_work">
                            <?php
                                $j = 0;
                                $previoustreatmentlabwork = DB::select("select * from order_lab_work where order_lab_work_id != (SELECT MAX(order_lab_work_id) FROM order_lab_work where client_id = '$id') and client_id = '$id' order by order_lab_work_id desc");
                                foreach ($previoustreatmentlabwork as $prtreatmentlabwork) {
                                  if($j%2 != 0){
                                    $rwclass = 'odd';
                                    $bg = '';
                                  }else {
                                    $rwclass = '';
                                    $bg = 'bgcolor="#f1f2f1"';

                                  }
                             ?>
                            <tr class="<?php echo $rwclass; ?>">
                              <td <?=$bg?>><?=date("d/m/Y", strtotime($prtreatmentlabwork->created_at));?></td>
                              <td <?=$bg?>><?=$prtreatmentlabwork->sample_collected_date?></td>
                              <td <?=$bg?>><?=$prtreatmentlabwork->reason_for_test?></td>
                              <td <?=$bg?>><?=$prtreatmentlabwork->collected_by?></td>
                              <td <?=$bg?>><?=$prtreatmentlabwork->test_requested_by?></td>
                              <td <?=$bg?>>
                                <?php
                                  if($prtreatmentlabwork->counseling == 1){
                                    echo 'Yes';
                                  }else {
                                    echo 'No';
                                  }

                                ?></td>
                              <td <?=$bg?>><?=$prtreatmentlabwork->sample_type?></td>
                              <td <?=$bg?>><?=$prtreatmentlabwork->sample_shipped_date?></td>
                            </tr>
                          <?php
                                $i++;
                              }
                           ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="lab-reporting">

                  <div class="row">
                    <form action="" id="form4">
                    <div class="col-md-6">
                      <h3 class="tab-heading-details">Sample details</h3>
                      <div class="form-group">
                        <label class="col-md-3 control-label" >Date Sample
                          Collected</label>
                        <div class="col-md-6">
                          <input class="form-control-n" value="<?=$treatmentlabwork->sample_collected_date?>" type="text" id="lb_date_sample_collected" readonly>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">Date Sample
                          Shipped</label>
                        <div class="col-md-6">
                          <input value="<?=$treatmentlabwork->sample_shipped_date?>" class="form-control-n" type="text" id="lb_date_sample_shipped" readonly/>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <label class="col-md-3 control-label line-h">Reason for Test</label>
                        <div class="col-md-6">
                          <input value="<?=$treatmentlabwork->reason_for_test?>" id="lb_reason_for_test" class="form-control-n"  type="text" readonly>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">Labratory
                          Number</label>

                        <div class="col-md-6">
                          <input value="<?=$labres->lab_no?>" class="form-control-n" type="text" id="lab_no" />
                        </div>
                      </div>
                      <?php

                          if(Auth::user()->role == 0){
                              $getfid = App\User::where('user_id', '=', $clientdetails->created_by)->first();
                              $clinic = App\Models\Facility::where('facility_id', '=', $getfid->facility_id)->first();

                          }else{
                            $clinic = App\Models\Facility::where('facility_id', '=', Auth::user()->facility_id)->first();
                          }


                       ?>
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">VL Testing Lab Name</label>
                        <div class="col-md-6">
                          <input value="<?=@$clinic->facility_name?>" id="lab_name" class="form-control-n"  type="text">
                        </div>
                      </div>

                    </div>
                    <div class="col-md-6">
                      <h3 class="tab-heading-details">Test details</h3>
                      <div class="form-group">
                        <label class="col-md-3 control-label" >Date Received</label>
                        <div class="col-md-6">
                          <div class="input-group">
                            <input value="<?=$labres->test_received_date?>" type="text" class="form-control-n" id="rangepicker11" />
                            <div class="cal-icon"><img src="/img/vew.png" width="22" alt="calender-icon"></div>
                          </div>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">Equipment Type</label>
                        <div class="col-md-6">
                          <select id="equipment_type" class="form-control" name="equipment_type">
                            <option value="">-- Select --</option>
                            <option value="Roche CAP/CTM 96" <?php if($labres->equipment_type == 'Roche CAP/CTM 96') echo 'selected'; ?>>Roche CAP/CTM 96</option>
                            <option value="Roche CAP/CTM 48" <?php if($labres->equipment_type == 'Roche CAP/CTM 48') echo 'selected'; ?>>Roche CAP/CTM 48</option>
                            <option value="Siemens Versant kPCR" <?php if($labres->equipment_type == 'Siemens Versant kPCR') echo 'selected'; ?>>Siemens Versant kPCR</option>
                            <option value="Abbot Real Time HIV-1 Assay" <?php if($labres->equipment_type == 'Abbot Real Time HIV-1 Assay') echo 'selected'; ?>>Abbot Real Time HIV-1 Assay</option>
                          </select>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">Viral Load
                          Detectable</label>
                        <div class="col-md-6">
                          <select id="viral_load_detectable" class="form-control" name="viral_load_detectable">
                            <option value="">-- Select --</option>
                            <option value="Below Detectable Level" <?php if($labres->viral_load_detectable == 'Below Detectable Level') echo 'selected'; ?>>Below Detectable Level</option>
                            <option value="Within Detectable Range or Above Maximum Value" <?php if($labres->viral_load_detectable == 'Within Detectable Range or Above Maximum Value') echo 'selected'; ?>>Within Detectable Range or Above Maximum Value</option>
                          </select>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <?php
                        if($labres->viral_load_detectable == 'Within Detectable Range or Above Maximum Value'){
                            $hiv_viral_load = '';
                            $hiv_viral_load_label = '';
                        }else {
                            $hiv_viral_load = 'disabled';
                            $hiv_viral_load_label = 'client-details';
                        }
                       ?>
                      <div class="form-group" id="hivvldiv">
                        <label id="hiv_viral_load_label" class="col-md-3 control-label <?=$hiv_viral_load_label?>">HIV Viral Load
                          Results copies/ml</label>
                        <div class="col-md-6">
                          <input id="hiv_viral_load" value="<?=$labres->hiv_viral_load_results?>" class="form-control-n" style="width:79%;" type="text" required <?=$hiv_viral_load?>>
                        </div>
                      </div>
                      <div class="clearfix"></div>

                      <div class="form-group">
                        <label class="col-md-3 control-label" >Date of Reporting</label>
                        <div class="col-md-6">
                          <div class="input-group">
                            <input type="text" class="form-control-n" id="reported_date" value="<?=$labres->date_of_reporting?>" />
                            <div class="cal-icon"><img src="/img/vew.png" width="22" alt="calender-icon"></div>
                          </div>
                        </div>
                      </div>

                    </div>
                    <?php
                        if(Auth::user()->role == 2 || Auth::user()->role == 0){
                     ?>
                    <div class="col-md-12 text-center">
                      <button type="submit" class="btn btn-responsive save-btn" style=" height:30px; font-size:14px; font-weight:bold;">SAVE</button>
                    </div>
                    <?php } ?>
                  </form>
                  </div>
                  <div class="row">
                    <div class="col-md-12 ">
                      <div class="table-scrollable">
                        <h5 style="margin:10px;"><strong>Past Lab Results</strong></h5>
                        <table class="table table-bordered table-hover">
                          <thead>
                            <tr>
                              <th width="12%" bgcolor="#666665">Date Shipped</th>
                              <th width="13%" bgcolor="#666665">Date Received</th>
                              <th width="11%" bgcolor="#666665">Date Reported</th>
                              <th width="11%" bgcolor="#666665">Sample Type</th>
                              <th width="11%" bgcolor="#666665">Viral Load Detectable</th>
                              <th width="10%" bgcolor="#666665">Viral Load Results</th>
                            </tr>
                          </thead>
                          <tbody id="lb_results">
                            <?php
                                $k = 0;
                                $previouslabresults = DB::select("select * from lab_results where lab_results_id != (SELECT MAX(lab_results_id) FROM lab_results where client_id = '$id') and client_id = '$id' order by lab_results_id desc");
                                foreach ($previouslabresults as $prlabres) {
                                  $sample_collected_date = DB::select("select sample_shipped_date,sample_type from order_lab_work where order_lab_work_id='$prlabres->order_lab_work_id'");
                                  if($j%2 != 0){
                                    $rwclass = 'odd';
                                    $bg = '';
                                  }else {
                                    $rwclass = '';
                                    $bg = 'bgcolor="#f1f2f1"';

                                  }
                                  if($prlabres->test_received_date != ''){
                             ?>
                            <tr class="<?php echo $rwclass;  ?>">
                              <td <?=$bg?>><?=$sample_collected_date[0]->sample_shipped_date?></td>
                              <td <?=$bg?>><?=$prlabres->test_received_date?></td>
                              <td <?=$bg?>><?=$prlabres->date_of_reporting?></td>
                              <td <?=$bg?>><?=$sample_collected_date[0]->sample_type?></td>
                              <td <?=$bg?>><?=$prlabres->viral_load_detectable?></td>
                              <td <?=$bg?>><?=$prlabres->hiv_viral_load_results?></td>
                            </tr>
                            <?php $k++; } ?>
                          </tbody>
                            </tr>
<?php } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="tab-pane fade" id="discharge">
                  <form action="" id="form5">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="col-md-4 control-label" style="margin-top:5px;">Discharged</label>
                        <div class="col-md-7">
                          <select id="is_discharge" class="form-control" name="is_discharge">
                            <option value="">-- Select --</option>
                            <option value="1" <?php if(@$discharge->client_discharged == 1) echo 'selected'; ?>>Yes</option>
                            <option value="0" <?php if(@$discharge->client_discharged == 0) echo 'selected'; ?>>No</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <?php
                          if(@$discharge->client_discharged == 1){
                            $cl_ds = '';
                            $cl_ds_label = '';
                          }else {
                            $cl_ds = 'disabled';
                            $cl_ds_label = 'client-details';
                          }
                     ?>
                    <div class="col-md-4" id="date_of_discharge">
                      <div class="form-group">
                        <label id="rangepicker17_label" class="col-md-5 control-label <?=$cl_ds_label?>">Date of
                          Discharge</label>
                        <div class="col-md-7">
                          <div class="input-group">
                            <input type="text" value="<?=@$discharge->date_of_discharge?>" class="form-control-n" id="rangepicker17" <?=$cl_ds?>/>
                            <div class="cal-icon"><img src="/img/vew.png" width="22" alt="calender-icon"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row" id="discharge_reason">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label id="discharge_reason_ip_label" class="col-md-2 control-label <?=$cl_ds_label?>" style="margin-top:5px;" >Reason of Discharge</label>
                        <div class="col-md-8">
                          <select class="form-control" id="discharge_reason_ip" <?=$cl_ds?>>
                            <option value="">— Select —</option>
                            <option value="Loss to Follow-up" <?php if(@$discharge->reason_for_discharge == 'Loss to Follow-up') echo 'selected'; ?>>Loss to Follow-up</option>
                            <option value="Patient Deceased" <?php if(@$discharge->reason_for_discharge == 'Patient Deceased') echo 'selected'; ?>>Patient Deceased</option>
                            <option value="Transferred to Another Facility" <?php if(@$discharge->reason_for_discharge == 'Transferred to Another Facility') echo 'selected'; ?>>Transferred to Another Facility</option>
                            <option value="Transferred to Another Catchment Area" <?php if(@$discharge->reason_for_discharge == 'Transferred to Another Catchment Area') echo 'selected'; ?>>Transferred to Another Catchment Area</option>
                            <option value="Refused Treatment (opted out)" <?php if(@$discharge->reason_for_discharge == 'Refused Treatment (opted out)') echo 'selected'; ?>>Refused Treatment (opted out)</option>
                          </select>
                        </div>
                      </div>
                    </div>

                  </div>
                  <?php
                      if(Auth::user()->role == 1 || Auth::user()->role == 0){
                   ?>
                  <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-responsive save-btn" style=" height:30px; font-size:14px; font-weight:bold;">SAVE</button>
                  </div>
                  <?php } ?>
                </form>
                </div>
                <div class="tab-pane fade" id="comments">
                  <form action="" id="form6">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="col-md-2 control-label" style="margin-top:5px;" >Add Comment</label>
                        <div class="col-md-8">
                          <textarea class="form-control-tn resize_vertical" id="message" name="message" placeholder="Please enter your message here..." rows="5">
                              <?=@$comments->comment?>
                          </textarea>
                        </div>
                      </div>
                    </div>
                    <?php
                        if(Auth::user()->role == 1 || Auth::user()->role == 0){
                     ?>
                    <div class="col-md-12 text-center">
                      <button type="submit" class="btn btn-responsive save-btn" style=" height:30px; font-size:14px; font-weight:bold;">SAVE</button>
                    </div>
                    <?php
                            }
                     ?>
                  </div>
                </form>
                  <div class="row">
                    <div class="col-md-12 ">
                      <div class="table-scrollable">
                        <h5 style="margin:10px;"><strong>Past Comments</strong></h5>
                        <table class="table table-bordered table-hover">
                          <thead>
                            <tr>
                              <th width="10%" bgcolor="#666665">Date</th>
                              <th width="90%" bgcolor="#666665">Comment</th>
                            </tr>
                          </thead>
                          <tbody id="cm_tbody">
                            <?php
                            $k = 0;
                            $previouscomments = DB::select("select * from comments where comments_id != (SELECT MAX(comments_id) FROM comments where client_id = '$id') and client_id = '$id' order by comments_id desc");
                              foreach ($previouscomments as $prcomments) {
                                if($k%2 != 0){
                                  $rwclass = 'odd';
                                  $bg = '';
                                }else {
                                  $rwclass = '';
                                  $bg = 'bgcolor="#f1f2f1"';

                                }
                             ?>
                            <tr>
                              <td <?=$bg?>><?=date("d/m/Y", strtotime($prcomments->created_at));?></td>
                              <td <?=$bg?>><?=$prcomments->comment?></td>
                            </tr>
                            <?php $k++; } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </aside>
  <!-- right-side -->
</div>
@stop
@section('script')
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
  <script>
  $(document).ready(function(){
    <?php
      if($clientdetails->pmct_enrolment_date == ''){
    ?>
      $('#rangepicker18').val('');
    <?php
      }
      if($treatment->art_initiated_date == ''){
    ?>
    $('#rangepicker10').val('');
    <?php
        }
      if($treatmentlabwork->sample_collected_date == ''){
     ?>
    $('#rangepicker6').val('');
    <?php }
    if($treatmentlabwork->sample_shipped_date == ''){
     ?>
    $('#rangepicker8').val('');
    <?php }
    if($treatmentlabwork->sample_shipped_date == ''){
      ?>
      $('#nexttestdate').val('');
      <?php
    }
    if($labres->test_received_date == ''){
     ?>
    $('#rangepicker11').val('');
    <?php }
    if(@$discharge->date_of_discharge == ''){
     ?>
    $('#rangepicker17').val('');
    <?php }
    if($labres->date_of_reporting == ''){
    ?>
    $('#reported_date').val('');
    <?php
    }
    ?>
  });
var todaydate = new Date();
  function parseDate(str) {
      var mdy = str.split('/');
      return new Date(mdy[2], mdy[0]-1, mdy[1]);
  }

  function daydiff(first, second) {
      return Math.round((second-first)/(1000*60*60*24));
  }


  $('#gender').change(function(){
    var val = $(this).val();
    if(val == 'F'){
        $( "#pregnant_bf" ).prop( "disabled", false );
        $('#pregnant_bf_label').removeClass("client-details");
    }else {

      $("#pregnant_bf, #enrolled_in").select2("trigger", "select", {
        data: { id: "" }
      });

      $('#rangepicker18').val('');

      $( "#pregnant_bf,#enrolled_in, #rangepicker18" ).prop( "disabled", true );

      $('#pregnant_bf_label, #pregnant_bf, #rangepicker18_label').addClass("client-details");

    }
  });

  $('#pregnant_bf').change(function(){
    var val = $(this).val();

    if(val == '1'){
        $('#enrolled_in').prop( "disabled", false );
        $('#enrolled_in_label').removeClass("client-details");
    }else {
      $("#enrolled_in").select2("trigger", "select", {
        data: { id: "" }
      });
      $('#rangepicker18').val('');
      $('#enrolled_in, #rangepicker18').prop( "disabled", true );
      $('#enrolled_in_label, #rangepicker18_label').addClass("client-details");
    }
  });

  $('#enrolled_in').change(function(){
    var val = $(this).val();
    if(val == '1'){
        $('#rangepicker18_label').removeClass("client-details");
        $('#rangepicker18').prop("disabled", false);
    }else {
      $('#rangepicker18').val('');
      $('#rangepicker18_label').addClass("client-details");
      $('#rangepicker18').prop("disabled", true);
    }
  });

  $("#client_tb_suspect").change(function(){
    var val = $(this).val();
    if(val == 1) {
      $('#tb_medication_label').removeClass("client-details");
      $('#tb_medication').prop("disabled", false);
    }else {
      $("#tb_medication").select2("trigger", "select", {
        data: { id: "" }
      });
      $('#tb_medication_label').addClass("client-details");
      $('#tb_medication').prop("disabled", true);
    }
  });

  //form 0 validation
  $("#form0").validate({
            errorElement: 'div',
            rules: {
              uid1: {
                maxlength: 8,
                minlength: 8
              },
              uid2: {
                maxlength: 6,
                minlength: 6
              }
            },
            messages: {
              uid1: {
                required: "Please enter Client Unique Identification.",
                minlength: "Please enter a valid Client Unique Identification.",
              },
              uid2: {
                required: "Please enter Client Unique Identification.",
                minlength: "Please enter a valid Client Unique Identification.",
              }
            }
          });

  //****************** enrollment form validations *************
  	$.validator.addMethod("checkValid", function(value, element) {
  				  var phone = $('#phone').val();
  				  var arrlist = ['6','7'];

  				   if(arrlist.indexOf( phone.charAt(0) )>=0){
  				   	return true;
  					}else{
  					 	return false;
  					}
  				  },
  				  "Number must start with a 6 or 7.");


  	$("#form1").validate({
  						errorElement: 'div',
  						rules: {
  							phone: {
  								maxlength: 9,
  								minlength: 9
  							}
  						},
  						messages: {
  						}
  					});

  $('#firststep').click(function(e){
    if($("#form1").valid() && $("#form0").valid()){


      if($('#gender').val() == 'F'){
        var pregnant_bf = $('#pregnant_bf').val();
        var enrolled_in = $('#enrolled_in').val();

      }else {
        var pregnant_bf = '';
        var enrolled_in = '';

      }
      if($('#enrolled_in').val() == 1){
        var pmtct_enrollment = $('#rangepicker18').val();
      }else {
        var pmtct_enrollment = '';
      }
    if($('#client_counselled').is(":checked")){
      var client_counselled = 1;
    }else {
      var client_counselled = 0;
    }

    if($('#increase_note').is(":checked")){
      var increase_note = 1;
    }else {
      var increase_note = 0;
    }

    var tb_suspect = $("#client_tb_suspect").val();
    var tb_medication = $("#tb_medication").val();

      $.ajax
        ({
          type: "POST",
          url: "{{ url('/updateclientdetails') }}",
          data: 'id=<?=$id?>&client_id1='+$('#uid1').val()+'&client_id2='+$('#uid2').val()+'&_token=<?php echo csrf_token(); ?>&client_dob='+$('#rangepicker15').val()+'&client_name='+
          $('#client_name').val()+'&client_age='+$('#age').val()+'&client_gender='+$('#gender').val()+'&pregnant_bf='+pregnant_bf+'&enrolled_in='+enrolled_in+'&pmtct_enrollment='+pmtct_enrollment+'&phone='+$('#phone').val()+'&tb_suspect='+tb_suspect+'&tb_medication='+tb_medication+'&client_counselled='+client_counselled+'&increase_note='+increase_note,
          cache: false,
          async:false,
          success: function(data)
          {


            if(data.status == 'success'){
              $('#tr_gender').val(data.gender).change();

              if(data.pregnant_feeding != ''){

                $('#tr_pregnat_bf').val(data.pregnant_feeding).change();
              }

              if(data.currently_enrolled_in != ''){

                $('#tr_enrolled_in').val(data.currently_enrolled_in).change();
              }

              if(data.pmct_enrolment_date != ''){
                $('#tr_pmctc_enrolled_date').val(data.pmct_enrolment_date);
              }
               $('.nav-tabs > .active').next('li').find('a').trigger('click');
            }else{
              alert('Fail');
            }


          }
        });
    }
    });

    $('#art_status').change(function(){
      var val = $(this).val();
      if(val == 'Newly Initiated'){
        $('#rangepicker10_label').removeClass("client-details");
        $('#rangepicker10').prop("disabled", false);

        $('#artmedication_label').removeClass("client-details");
        $('#artmedication').prop("disabled", false);

        $('#previous_regimens_label').addClass("client-details");
        $('#previous_regimens').prop("disabled", true);

      }else if(val == 'Ongoing ART Client'){
        $('#rangepicker10_label').removeClass("client-details");
        $('#rangepicker10').prop("disabled", false);

        $('#artmedication_label').removeClass("client-details");
        $('#artmedication').prop("disabled", false);

        $('#previous_regimens_label').removeClass("client-details");
        $('#previous_regimens').prop("disabled", false);
      }else {
        $("#artmedication").select2("trigger", "select", {
          data: { id: "" }
        });

        $('#rangepicker10').val('');
        $('#rangepicker10_label').addClass("client-details");
        $('#rangepicker10').prop("disabled", true);

        $('#artmedication_label').addClass("client-details");
        $('#artmedication').prop("disabled", true);

        $('#previous_regimens_label').addClass("client-details");
        $('#previous_regimens').prop("disabled", true);
      }
    });
    $('#form2').submit(function(e){

        if($('#art_status').val() == 'Newly Initiated'){
          var date_initiated_on_art = $('#rangepicker10').val();
          var artmedication = $('#artmedication').val();
          var previousregimens = '';
        }else if($('#art_status').val() == 'Ongoing ART Client'){
          var date_initiated_on_art = $('#rangepicker10').val();
          var artmedication = $('#artmedication').val();
          var previousregimens = $('#previous_regimens').val();
        }else {
          var date_initiated_on_art = '';
          var artmedication = '';
          var previousregimens = '';
        }
        $.ajax
          ({
            type: "POST",
            url: "{{ url('/addtreatment') }}",
            data: 'id=<?=$id?>&art_status='+$('#art_status').val()+'&_token=<?php echo csrf_token(); ?>&date_initiated_on_art='+date_initiated_on_art+'&artmedication='+
            artmedication+'&previous_regimens='+previousregimens,
            cache: false,
            async:false,
            success: function(data)
            {

              if(data.status == 'success'){
                $('#tr_tbody').html(data.tr_results);
                $('html, body').animate({
                    scrollTop: $("#rangepicker6").offset().top
                }, 2000);
              }else{
                alert('Fail');
              }


            }
          });
      return false;
      });

      $('#form3').submit(function(e){


          $.ajax
            ({
              type: "POST",
              url: "{{ url('/addtreatmentlabwork') }}",
              data: 'id=<?=$id?>&_token=<?php echo csrf_token(); ?>&sample_collection_date='+$('#rangepicker6').val()+'&test_reason='+$('#test_reason').val()+'&collected_by='+$('#collected_by').val()+'&sample_shipped_date='+$('#rangepicker8').val()+'&test_requested_by='+$('#test_requested_by').val()+'&counseling='+$("#counseling").val()+'&sample_type='+$("#sample_type").val()+'&nexttestdate='+$("#nexttestdate").val(),
              cache: false,
              async:false,
              success: function(data)
              {

                if(data.status == 'success'){
                  $('#tr_lab_work').html(data.tr_lab_work);
                  $('#lb_date_sample_collected').val(data.sample_collection_date);
                  $('#lb_date_sample_shipped').val(data.sample_shipped_date);
                  $('#lb_reason_for_test').val(data.reason_for_test);

                  $('.nav-tabs > .active').next('li').find('a').trigger('click');
                }else{
                  alert('Fail');
                }


              }
            });
        return false;
        });

      $('#viral_load_detectable').change(function(){
          var val = $(this).val();
          if(val == "Within Detectable Range or Above Maximum Value"){
            $('#hiv_viral_load_label').removeClass('client-details');
            $('#hiv_viral_load').prop('disabled', false);

          }else {
            $('#hiv_viral_load_label').addClass('client-details');
            $('#hiv_viral_load').prop('disabled', true);

            $('#hiv_viral_load').val('');

          }
      });
      $('#hiv_viral_load').blur(function(){
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth()+1; //January is 0!
            var yyyy = today.getFullYear();

            if(dd<10) {
                dd='0'+dd
            }

            if(mm<10) {
                mm='0'+mm
            }

         var reported_date = mm + '/' + dd + '/' +  yyyy;
         $('#reported_date').val(reported_date);
      });
      $('#form4').submit(function(e){

          if($('#viral_load_detectable').val() == 'Within Detectable Range or Above Maximum Value'){
            var hiv_viral_load = $('#hiv_viral_load').val();
            var reportingdate = $('#reported_date').val();
          }else{
            var hiv_viral_load = '';
            var reportingdate = '';
          }
          $.ajax
            ({
              type: "POST",
              url: "{{ url('/addlabresults') }}",
              data: 'id=<?=$id?>&lab_no='+$('#lab_no').val()+'&_token=<?php echo csrf_token(); ?>&test_received_date='+$('#rangepicker11').val()+'&equipment_type='+
              $('#equipment_type').val()+'&viral_load_detectable='+$('#viral_load_detectable').val()+'&hiv_viral_load_results='+hiv_viral_load+'&date_of_reporting='+reportingdate,
              cache: false,
              async:false,
              success: function(data)
              {

                if(data.status == 'success'){
                  $('#lb_results').html(data.lb_results);
                  $('.nav-tabs > .active').next('li').find('a').trigger('click');
                }else{
                  alert('Fail');
                }


              }
            });
        return false;
        });

        $('#is_discharge').change(function(){
          var val = $(this).val();
          if(val == 1){
            $('#rangepicker17_label').removeClass('client-details');
            $('#rangepicker17').prop('disabled', false);
            $('#discharge_reason_ip_label').removeClass('client-details');
            $('#discharge_reason_ip').prop('disabled', false);
          }else {
            $("#discharge_reason_ip").select2("trigger", "select", {
              data: { id: "" }
            });
            $('#rangepicker17_label').addClass('client-details');
            $('#rangepicker17').prop('disabled', true);
            $('#discharge_reason_ip_label').addClass('client-details');
            $('#discharge_reason_ip').prop('disabled', true);
            $('#rangepicker17').val('');
          }
        });

        $('#form5').submit(function(e){


              var date_of_discharge = $('#rangepicker17').val();
              var discharge_reason = $('#discharge_reason_ip').val();

            $.ajax
              ({
                type: "POST",
                url: "{{ url('/updatedischarge') }}",
                data: 'id=<?=$id?>&date_of_discharge='+date_of_discharge+'&_token=<?php echo csrf_token(); ?>&discharge_reason='+discharge_reason+'&is_discharge='+
                $('#is_discharge').val(),
                cache: false,
                async:false,
                success: function(data)
                {
                  if(data.status == 'success'){
                    $('.nav-tabs > .active').next('li').find('a').trigger('click');
                  }else{
                    alert('Fail');
                  }


                }
              });
          return false;
          });

          $('#form6').submit(function(e){

              $.ajax
                ({
                  type: "POST",
                  url: "{{ url('/addcomment') }}",
                  data: 'id=<?=$id?>&comment='+$('#message').val()+'&_token=<?php echo csrf_token(); ?>',
                  cache: false,
                  async:false,
                  success: function(data)
                  {
                    if(data.status == 'success'){
                      window.location.href = '/dashboard';
                    }else{
                      alert('Fail');
                    }


                  }
                });
            return false;
            });
            //restrict to numbers only
            $("#phone, #uid1, #uid2").keydown(function(event) {
                    // Allow only backspace and delete
                    if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9) {
                        // let it happen, don't do anything
                    }
                    else {
                        // Ensure that it is a number and stop the keypress
                        if (event.keyCode < 48 || event.keyCode > 57 ) {
                            event.preventDefault();
                        }
                    }
                });
  </script>
@stop
