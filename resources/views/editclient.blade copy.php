@extends('layout.main')
@section('content')
@include('includes.top')
<div class="wrapper row-offcanvas row-offcanvas-left">
  @include('includes.sidebar')
  <!-- Right side column. Contains the navbar and content of the page -->
  <aside class="right-side">
    <section class="content">
      <h2 class="text-center viral-load-title" style="margin-bottom:30px;">Viral Load System</h2>
      <div class="row">
        <div class="col-md-2 col-md-offset-2">
          <div class="form-group">
            <label>Client ID</label>
            <input class="form-control-n" id="clientuid" value="<?=$clientdetails->client_uid?>"/>
          </div>
        </div>
        <div class="col-md-2 col-md-offset-1">
          <label  for="name">Client DOB</label>
          <div class="input-group">
            <input type="text" class="form-control-n" id="rangepicker15" value="<?=$clientdetails->dob?>"/>
            <div class="cal-icon"><img src="/img/vew.png" width="22" alt="calender-icon"></div>
          </div>
        </div>
        <div class="col-md-2 col-md-offset-1">
          <div class="form-group">
            <label>Last Viral Load Date</label>
            <input class="form-control-n" id="last_viral_load_date" value="<?=$treatment->test_requested_date?>" readonly>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2 col-md-offset-2">
          <div class="form-group">
            <label>Client Name</label>
            <input class="form-control-n" id="client_name" value="<?=$clientdetails->name?>" />
          </div>
        </div>
        <div class="col-md-2 col-md-offset-1">
          <label  for="name">Age</label>
          <input class="form-control-n" style="width:50%;" id="age" value="<?=$clientdetails->age?>">
        </div>
        <div class="col-md-2 col-md-offset-1">
          <div class="form-group">
            <label>Last Viral Load Result</label>
            <input class="form-control-n" id="last_viral_load_result" value="<?=$labres->hiv_viral_load_results?>" readonly>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="panel-body">
            <div class="bs-example">
              <ul class="nav nav-tabs" style="margin-bottom: 15px;">
                <li class="active"> <a href="#client-details" data-toggle="tab">Client Details</a> </li>
                <li> <a href="#testing" data-toggle="tab">Treatment/Testing</a> </li>
                <li> <a href="#lab-reporting" data-toggle="tab">LAB - Results Reporting</a> </li>
                <li> <a href="#discharge" data-toggle="tab">Discharge</a> </li>
                <li> <a href="#comments" data-toggle="tab">Comments</a> </li>
              </ul>
              <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active in" id="client-details">
                  <form action="" id="form1">
                  <div class="row">
                    <div class="col-md-5">
                      <div class="form-group">
                        <label class="col-md-4 control-label" style="margin-top:5px;">Facility Name</label>
                        <div class="col-md-8">
                          <input class="form-control-n" type="text" value="<?=Auth::user()->facility_name?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-group">
                        <label class="col-md-4 control-label" style="margin-top:5px;">Facility CTC No.</label>
                        <div class="col-md-8">
                          <input class="form-control-n" type="text" value="<?=Auth::user()->facility_code?>">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="col-md-4 control-label" style="margin-top:5px;">Sex</label>
                        <div class="col-md-6">
                          <select id="gender" class="form-control required" name="gender">
                            <option value="">-- Select --</option>
                            <option value="M" <?php if($clientdetails->gender == 'M') echo 'selected'; ?>>Male</option>
                            <option value="F" <?php if($clientdetails->gender == 'F') echo 'selected'; ?>>Female</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <?php
                        if($clientdetails->gender == 'F'){
                            $pr_bf = 'block';
                        }else {
                          $pr_bf = 'none';
                        }

                     ?>
                    <div class="col-md-3" id="cl_pregnant_bf" style="display:<?=$pr_bf?>;">
                      <div class="form-group">
                        <label class="col-md-6 control-label client-details">Pregnant or
                          Breastfeeding</label>
                        <div class="col-md-5">
                          <select id="pregnant_bf" class="form-control required" name="pregnant_bf">
                            <option value="">-- Select --</option>
                            <option value="1" <?php if($clientdetails->pregnant_feeding == 1) echo 'selected'; ?>>Yes</option>
                            <option value="0" <?php if($clientdetails->pregnant_feeding == 0) echo 'selected'; ?>>No</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <?php
                        if($clientdetails->pregnant_feeding == 1){
                            $cl_en = 'block';
                        }else {
                          $cl_en = 'none';
                        }

                     ?>
                    <div class="col-md-3" id="cl_enrolled_in" style="display:<?=$cl_en?>;">
                      <div class="form-group">
                        <label class="col-md-5 control-label client-details" >Enrolled in
                          PMTCT</label>
                        <div class="col-md-5">
                          <select id="enrolled_in" class="form-control required" name="enrolled_in">
                            <option value="">-- Select --</option>
                            <option value="1" <?php if($clientdetails->currently_enrolled_in == 1) echo 'selected'; ?>>Yes</option>
                            <option value="0" <?php if($clientdetails->currently_enrolled_in == 0) echo 'selected'; ?>>No</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <?php
                        if($clientdetails->currently_enrolled_in == 1){
                            $cl_pmtct = 'block';
                        }else {
                          $cl_pmtct = 'none';
                        }

                     ?>
                    <div class="col-md-3" id="cl_pmtct_date" style="display:<?=$cl_pmtct?>;">
                      <div class="form-group">
                        <label class="col-md-4 control-label client-details">PMTCT
                          Enrollment</label>
                        <div class="col-md-8">
                          <div class="input-group">
                            <input type="text" class="form-control-n" id="rangepicker18" value="<?=$clientdetails->pmct_enrolment_date?>" />
                            <div class="cal-icon"><img src="/img/vew.png" width="22" alt="calender-icon"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-5">
                      <div class="form-group">
                        <label class="col-md-4 control-label" style="margin-top:5px;" >Client Phone #</label>
                        <div class="col-md-8">
                          <div id="apDiv2">255</div>
                          <input maxlength="7" id="phone" class="form-control-number-n" type="text" value="<?=$clientdetails->phone?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 text-center">
                      <button type="submit" class="btn btn-responsive save-btn" style=" height:30px; font-size:14px; font-weight:bold;">SAVE</button>
                    </div>
                  </div>
                </form>
                </div>
                <div class="tab-pane fade" id="testing">
                  <div class="row">
                    <form action="" id="form2">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="col-md-4 control-label" style="margin-top:5px;">ART Status</label>
                        <div class="col-md-6">
                          <select id="art_status" class="form-control">
                            <<option value="">-- Select --</option>
                            <option value="Not Yet Initiated" <?php if($treatment->art_status == 'Not Yet Initiated') echo 'selected'; ?>>Not Yet Initiated</option>
                            <option value="Newly Initiated" <?php if($treatment->art_status == 'Newly Initiated') echo 'selected'; ?>>Newly Initiated</option>
                            <<option value="Ongoing ART Client" <?php if($treatment->art_status == 'Ongoing ART Client') echo 'selected'; ?>>Ongoing ART Client</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <?php

                        if($treatment->art_status == 'Newly Initiated') {
                              $ar_st = 'block';
                              $on_art = 'none';
                        } elseif ($treatment->art_status == 'Ongoing ART Client') {
                              $ar_st = 'block';
                              $on_art = 'block';
                        } else {
                              $ar_st = 'none';
                              $on_art = 'none';
                        }
                     ?>
                    <div class="col-md-4" id="date_initiated_on_art" style="display:<?=$ar_st?>;">
                      <div class="form-group">
                        <label class="col-md-5 control-label client-details">Date Initiated on ART</label>
                        <div class="col-md-6">
                          <div class="input-group">
                            <input type="text" class="form-control-n" id="rangepicker10" value="<?=$treatment->art_initiated_date?>" />
                            <div class="cal-icon"><img src="/img/vew.png" width="22" alt="calender-icon"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4" style="display:<?=$ar_st?>;" id="artmedicationdiv">
                      <div class="form-group">
                        <label class="col-md-5 control-label client-details"  >ART Medication </label>
                        <div class="col-md-7">
                          <select id="artmedication" class="form-control">
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
                        <label class="col-md-4 control-label" style="margin-top:5px;">Sex</label>
                        <div class="col-md-6">
                          <select id="gender" class="form-control required" name="gender" disabled>
                            <option value="">-- Select --</option>
                            <option value="M" <?php if($clientdetails->gender == 'M') echo 'selected'; ?>>Male</option>
                            <option value="F" <?php if($clientdetails->gender == 'F') echo 'selected'; ?>>Female</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <?php
                        if($clientdetails->gender == 'F'){
                            $pr_bf = 'block';
                        }else {
                          $pr_bf = 'none';
                        }

                     ?>
                    <div class="col-md-3" id="cl_pregnant_bf" style="display:<?=$pr_bf?>;">
                      <div class="form-group">
                        <label class="col-md-6 control-label client-details">Pregnant or
                          Breastfeeding</label>
                        <div class="col-md-5">
                          <select id="pregnant_bf" class="form-control required" name="pregnant_bf" disabled>
                            <option value="">-- Select --</option>
                            <option value="1" <?php if($clientdetails->pregnant_feeding == 1) echo 'selected'; ?>>Yes</option>
                            <option value="0" <?php if($clientdetails->pregnant_feeding == 0) echo 'selected'; ?>>No</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <?php
                        if($clientdetails->pregnant_feeding == 1){
                            $cl_en = 'block';
                        }else {
                          $cl_en = 'none';
                        }

                     ?>
                    <div class="col-md-3" id="cl_enrolled_in" style="display:<?=$cl_en?>;">
                      <div class="form-group">
                        <label class="col-md-5 control-label client-details" >Enrolled in
                          PMTCT</label>
                        <div class="col-md-5">
                          <select id="enrolled_in" class="form-control required" name="enrolled_in" disabled>
                            <option value="">-- Select --</option>
                            <option value="1" <?php if($clientdetails->currently_enrolled_in == 1) echo 'selected'; ?>>Yes</option>
                            <option value="0" <?php if($clientdetails->currently_enrolled_in == 0) echo 'selected'; ?>>No</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <?php
                        if($clientdetails->currently_enrolled_in == 1){
                            $cl_pmtct = 'block';
                        }else {
                          $cl_pmtct = 'none';
                        }

                     ?>
                    <div class="col-md-3" id="cl_pmtct_date" style="display:<?=$cl_pmtct?>;">
                      <div class="form-group">
                        <label class="col-md-4 control-label client-details">PMTCT
                          Enrollment</label>
                        <div class="col-md-8">
                          <div class="input-group">
                            <input type="text" class="form-control-n" id="rangepicker18" value="<?=$clientdetails->pmct_enrolment_date?>" disabled/>
                            <div class="cal-icon"><img src="/img/vew.png" width="22" alt="calender-icon"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row" style="display:<?=$on_art?>;" id="previousregimensdiv">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="col-md-4 control-label" style="margin-top:5px;" >Previous Regimens</label>
                        <div class="col-md-8">
                          <input class="form-control-n" type="text" id="previous_regimens" value="<?=$treatment->previous_regimens?>" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="col-md-5 control-label">Date Test Was
                          Requested</label>
                        <div class="col-md-7">
                          <div class="input-group">
                            <input type="text" class="form-control-n" id="rangepicker6" value="<?=$treatment->test_requested_date ?>" />
                            <div class="cal-icon"><img src="/img/vew.png" width="22" alt="calender-icon"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-group">
                        <label class="col-md-5 control-label"  >Date Test Was
                          Requested at HVL Lab</label>
                        <div class="col-md-7">
                          <div class="input-group">
                            <input type="text" class="form-control-n" id="rangepicker5" value="<?=$treatment->test_requested_date_hvl ?>"/>
                            <div class="cal-icon"><img src="/img/vew.png" width="22" alt="calender-icon"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="col-md-5 control-label">Date Sample
                          Collected</label>
                        <div class="col-md-7">
                          <div class="input-group">
                            <input type="text" class="form-control-n" id="rangepicker7" value="<?=$treatment->sample_collected_date?>" />
                            <div class="cal-icon"><img src="/img/vew.png" width="22" alt="calender-icon"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="col-md-5 control-label">Date Sample
                          Shipped</label>
                        <div class="col-md-7">
                          <div class="input-group">
                            <input type="text" class="form-control-n" id="rangepicker9" value="<?=date('d/m/Y', strtotime($treatment->sample_shipped_date))?>"/>
                            <div class="cal-icon"><img src="/img/vew.png" width="22" alt="calender-icon"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="col-md-5 control-label" style="margin-top:5px;" >Collected By</label>
                        <div class="col-md-7">
                          <input class="form-control-n" type="text" id="collected_by" value="<?=$treatment->collected_by?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 text-center">
                      <button type="submit" class="btn btn-responsive save-btn" style=" height:30px; font-size:14px; font-weight:bold;">SAVE</button>
                    </div>
                  </div>
                </form>
                  <div class="row">
                    <div class="col-md-12 ">
                      <div class="table-scrollable">
                        <h5 style="margin:10px;"><strong>Past Treatments/Tests</strong></h5>
                        <table class="table table-bordered table-hover">
                          <thead>
                            <tr>
                              <th width="12%" bgcolor="#666665">Date Entered</th>
                              <th width="13%" bgcolor="#666665">ART Status</th>
                              <th width="11%" bgcolor="#666665">ART Initiated</th>
                              <th width="11%" bgcolor="#666665">Medication</th>
                              <th width="11%" bgcolor="#666665">Sex</th>
                              <th width="10%" bgcolor="#666665">PMTCT</th>
                              <th width="13%" bgcolor="#666665">Date Sample
                                Collected</th>
                              <th width="12%" bgcolor="#666665">Date Sample Shipped</th>
                              <th width="12%" bgcolor="#666665">Collected By</th>
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
                              <td <?=$bg?>><?=$clientdetails->pmct_enrolment_date?></td>
                              <td <?=$bg?>><?=$prtreatment->sample_collected_date?></td>
                              <td <?=$bg?>><?=$prtreatment->sample_shipped_date?></td>
                              <td <?=$bg?>><?=$prtreatment->collected_by?></td>
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
                    <form action="" id="form3">
                    <div class="col-md-6">
                      <h3 class="tab-heading-details">Sample details</h3>
                      <div class="form-group">
                        <label class="col-md-3 control-label" >Date Sample
                          Collected</label>
                        <div class="col-md-6">
                          <input class="form-control-n" type="text" value="<?=$treatment->sample_collected_date?>" id="lb_date_sample_collected" readonly>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">Date Sample
                          Shipped</label>
                        <div class="col-md-6">
                          <input value="<?=$treatment->sample_shipped_date?>" class="form-control-n" type="text" id="lb_date_sample_shipped" readonly/>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">Labratory
                          Number</label>
                          <?php
                              $clinic = App\Models\Clinic::where('clinic_id', '=', Auth::user()->clinic_id)->first();

                           ?>
                        <div class="col-md-6">
                          <input class="form-control-n" type="text" id="lab_no" value="<?=$clinic->clinic_code;?>" required>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <label class="col-md-3 control-label" style="margin-top:8px;">Sample Type</label>
                        <div class="col-md-6">
                          <select id="sample_type" class="form-control" name="sample_type" required>
                            <option value="">-- Select --</option>
                            <option value="Dry Blood Spot (DBS)" <?php if($labres->sample_type == 'Dry Blood Spot (DBS)') echo 'selected'; ?>>Dry Blood Spot (DBS)</option>
                            <option value="Plasma" <?php if($labres->sample_type == 'Plasma') echo 'selected'; ?>>Plasma</option>
                            <option value="Whole Blood" <?php if($labres->sample_type == 'Whole Blood') echo 'selected'; ?>></option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <h3 class="tab-heading-details">Test details</h3>
                      <div class="form-group">
                        <label class="col-md-3 control-label" >Date Received</label>
                        <div class="col-md-6">
                          <div class="input-group">
                            <input type="text" class="form-control-n" id="rangepicker8" value="<?=$labres->test_received_date?>" />
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
                            <option value="Roche CAP/CTM 96" <?php if($labres->equipment_type == "Roche CAP/CTM 96") echo 'selected'; ?>>Roche CAP/CTM 96</option>
                            <option value="Roche CAP/CTM 48" <?php if($labres->equipment_type == "Roche CAP/CTM 48") echo 'selected'; ?>>Roche CAP/CTM 48</option>
                            <option value="Siemens Versant kPCR" <?php if($labres->equipment_type == "Siemens Versant kPCR") echo 'selected'; ?>>Siemens Versant kPCR</option>
                            <option value="Abbot Real Time HIV-1 Assay" <?php if($labres->equipment_type == "Abbot Real Time HIV-1 Assay") echo 'selected'; ?>>Abbot Real Time HIV-1 Assay</option>
                          </select>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">Viral Load
                          Detectableer</label>
                        <div class="col-md-6">
                          <select id="viral_load_detectable" class="form-control" name="viral_load_detectable">
                            <option value="">-- Select --</option>
                            <option value="Below Detectable Level" <?php if($labres->viral_load_detectable == "Below Detectable Level") echo 'selected'; ?>>Below Detectable Level</option>
                            <option value="Within Detectable Range" <?php if($labres->viral_load_detectable == "Within Detectable Range") echo 'selected'; ?>>Within Detectable Range</option>
                            <option value="Above Maximum Value" <?php if($labres->viral_load_detectable == "Above Maximum Value") echo 'selected'; ?>>Above Maximum Value</option>
                          </select>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <?php
                        if($labres->viral_load_detectable == "Within Detectable Range") {
                            $hiv_res = 'block';
                        }else {
                            $hiv_res = 'none';
                        }
                      ?>
                      <div class="form-group" id="hivvldiv" style="display:<?=$hiv_res?>;">
                        <label class="col-md-3 control-label">HIV Viral Load
                          Results copies/ml</label>
                        <div class="col-md-6">
                          <input id="hiv_viral_load" class="form-control-n" style="width:79%;" type="text" value="<?=$labres->hiv_viral_load_results?>">
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group" id="date_of_reporting" style="display:<?=$hiv_res?>;">
                        <label class="col-md-3 control-label" style="margin-top:8px;">Date of Reporting</label>
                        <div class="col-md-6">
                          <input id="reported_date" class="form-control-n" style="width:79%;" type="text" value="<?=$labres->date_of_reporting?>" disabled>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 text-center">
                      <button type="submit" class="btn btn-responsive save-btn" style=" height:30px; font-size:14px; font-weight:bold;">SAVE</button>
                    </div>
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
                          <tbody id="lab_tbody">
                            <?php
                                $j = 0;
                                $previouslabresults = DB::select("select * from lab_results where lab_results_id != (SELECT MAX(lab_results_id) FROM lab_results where client_id = '$id') and client_id = '$id' order by lab_results_id desc");
                                foreach ($previouslabresults as $prlabres) {
                                  $sample_collected_date = DB::select("select sample_collected_date from treatment where treatment_id='$prlabres->treatment_id'");
                                  if($j%2 != 0){
                                    $rwclass = 'odd';
                                    $bg = '';
                                  }else {
                                    $rwclass = '';
                                    $bg = 'bgcolor="#f1f2f1"';

                                  }
                             ?>
                            <tr class="<?php echo $rwclass;  ?>">
                              <td <?=$bg?> id="date_shipped_table"><?=$sample_collected_date[0]->sample_collected_date?></td>
                              <td <?=$bg?>><?=$prlabres->test_received_date?></td>
                              <td <?=$bg?>><?=$prlabres->date_of_reporting?></td>
                              <td <?=$bg?>><?=$prlabres->sample_type?></td>
                              <td <?=$bg?>><?=$prlabres->viral_load_detectable?></td>
                              <td <?=$bg?>><?=$prlabres->hiv_viral_load_results?></td>
                            </tr>
                            <?php $j++; } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="discharge">
                  <form action="" id="form4">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="col-md-4 control-label" style="margin-top:5px;">Discharged</label>
                        <div class="col-md-7">
                          <select id="is_discharge" class="form-control" name="is_discharge" required>
                            <option value="">-- Select --</option>
                            <option value="1" <?php if($discharge->client_discharged == 1) echo 'selected'; ?>>Yes</option>
                            <option value="0" <?php if($discharge->client_discharged == 0) echo 'selected'; ?>>No</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <?php
                        if ($discharge->client_discharged == 1) {
                            $dt_dc = 'block';
                        } else {
                            $dt_dc = 'none';
                        }

                     ?>
                    <div class="col-md-4" id="date_of_discharge" style="display: <?=$dt_dc?>;">
                      <div class="form-group">
                        <label class="col-md-5 control-label">Date of
                          Discharge</label>
                        <div class="col-md-7">
                          <div class="input-group">
                            <input type="text" class="form-control-n" id="rangepicker17" value="<?=$discharge->date_of_discharge?>" />
                            <div class="cal-icon"><img src="/img/vew.png" width="22" alt="calender-icon"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row" id="discharge_reason" style="display: <?=$dt_dc?>;">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="col-md-2 control-label" style="margin-top:5px;" >Reason of Discharge</label>
                        <div class="col-md-8">
                          <input id="discharge_reason_ip" class="form-control-n" type="text" value="<?=$discharge->reason_for_discharge?>" />
                        </div>
                      </div>
                    </div>

                  </div>
                  <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-responsive save-btn" style=" height:30px; font-size:14px; font-weight:bold;">SAVE</button>
                  </div>
                </form>
                </div>
                <div class="tab-pane fade" id="comments">
                  <form action="" id="form5">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="col-md-2 control-label" style="margin-top:5px;" >Add Comment</label>
                        <div class="col-md-8">
                          <textarea class="form-control-tn resize_vertical" id="message" name="message" placeholder="Please enter your message here..." rows="5">
                            <?=trim($comments->comment)?>
                          </textarea>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 text-center">
                      <button type="submit" class="btn btn-responsive save-btn" style=" height:30px; font-size:14px; font-weight:bold;">SAVE</button>
                    </div>
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
  <script>
  $('#gender').change(function(){
    var val = $(this).val();
    if(val == 'F'){
        $('#cl_pregnant_bf').show();
    }else {
      $('#cl_pregnant_bf').hide();
      $('#cl_pmtct_date').hide();
      $('#cl_enrolled_in').hide();
    }
  });

  $('#pregnant_bf').change(function(){
    var val = $(this).val();

    if(val == '1'){
        $('#cl_enrolled_in').show();
    }else {
      $('#cl_enrolled_in').hide();
    }
  });

  $('#enrolled_in').change(function(){
    var val = $(this).val();
    if(val == '1'){
        $('#cl_pmtct_date').show();
    }else {
      $('#cl_pmtct_date').hide();
    }
  });
  $('#form1').submit(function(e){

      //$('.nav-tabs > .active').next('li').find('a').trigger('click');
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

      $.ajax
        ({
          type: "POST",
          url: "{{ url('/updateclientdetails') }}",
          data: 'id=<?=$id?>&client_id='+$('#clientuid').val()+'&_token=<?php echo csrf_token(); ?>&client_dob='+$('#rangepicker15').val()+'&client_name='+
          $('#client_name').val()+'&client_age='+$('#age').val()+'&client_gender='+$('#gender').val()+'&pregnant_bf='+pregnant_bf+'&enrolled_in='+enrolled_in+'&pmtct_enrollment='+pmtct_enrollment+'&phone='+$('#phone').val(),
          cache: false,
          async:false,
          success: function(data)
          {

            if(data.status == 'success'){
              $('#tr_gender').val(data.gender).change();

              if(data.pregnant_feeding != ''){
                $('#dv_pregnat_bf').show();
                $('#tr_pregnat_bf').val(data.pregnant_feeding).change();
              }

              if(data.currently_enrolled_in != ''){
                $('#dv_enrolled_in').show();
                $('#tr_enrolled_in').val(data.currently_enrolled_in).change();
              }

              if(data.pmct_enrolment_date != ''){
                $('#dv_pmtct_date').show();
                $('#tr_pmctc_enrolled_date').val(data.pmct_enrolment_date);
              }
               $('.nav-tabs > .active').next('li').find('a').trigger('click');
            }else{
              alert('Fail');
            }


          }
        });
    return false;
    });

    $('#art_status').change(function(){
      var val = $(this).val();
      if(val == 'Newly Initiated'){
        $('#date_initiated_on_art').show();
        $('#artmedicationdiv').show();
        $('#previousregimensdiv').hide();
      }else if(val == 'Ongoing ART Client'){
        $('#date_initiated_on_art').show();
        $('#artmedicationdiv').show();
        $('#previousregimensdiv').show();
      }else {
        $('#date_initiated_on_art').hide();
        $('#artmedicationdiv').hide();
        $('#previousregimensdiv').hide();
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
            artmedication+'&previous_regimens='+previousregimens+'&test_requested_date='+$('#rangepicker6').val()+'&testest_requested_date_hvl='+$('#rangepicker5').val()+'&sample_collection_date='+$('#rangepicker7').val()+'&sample_shipped_date='+$('#rangepicker9').val()+'&collected_by='+$('#collected_by').val(),
            cache: false,
            async:false,
            success: function(data)
            {

              if(data.status == 'success'){
                $('#lb_date_sample_collected').val(data.sample_collection_date);
                $('#lb_date_sample_shipped').val(data.sample_shipped_date);
                $('#tr_tbody').html(data.tr_results);
                //$('.nav-tabs > .active').next('li').find('a').trigger('click');
              }else{
                alert('Fail');
              }


            }
          });
      return false;
      });

      $('#viral_load_detectable').change(function(){
          var val = $(this).val();
          if(val == "Within Detectable Range"){
            $('#hivvldiv').show();
            $('#date_of_reporting').show();
          }else {
            $('#hivvldiv').hide();
            $('#date_of_reporting').hide();
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

         var reported_date = dd + '/' + mm + '/' +  yyyy;
         $('#reported_date').val(reported_date);
      });

      $('#form3').submit(function(e){

          if($('#viral_load_detectable').val() == 'Within Detectable Range'){
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
              data: 'id=<?=$id?>&sample_type='+$('#sample_type').val()+'&_token=<?php echo csrf_token(); ?>&test_received_date='+$('#rangepicker8').val()+'&equipment_type='+
              $('#equipment_type').val()+'&viral_load_detectable='+$('#viral_load_detectable').val()+'&hiv_viral_load_results='+hiv_viral_load+'&date_of_reporting='+reportingdate,
              cache: false,
              async:false,
              success: function(data)
              {

                if(data.status == 'success'){
                  $('#lab_tbody').html(data.lb_results);
                  //$('.nav-tabs > .active').next('li').find('a').trigger('click');
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
            $('#date_of_discharge').show();
            $('#discharge_reason').show();
          }else {
            $('#date_of_discharge').hide();
            $('#discharge_reason').hide();
          }
        });

        $('#form4').submit(function(e){

            if($('#is_discharge').val() == 1){
              var date_of_discharge = $('#rangepicker17').val();
              var discharge_reason = $('#discharge_reason_ip').val();
            }else{
              var date_of_discharge = '';
              var discharge_reason = '';
            }
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

          $('#form5').submit(function(e){

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
            $("#phone").keydown(function(event) {
                    // Allow only backspace and delete
                    if ( event.keyCode == 46 || event.keyCode == 8 ) {
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
