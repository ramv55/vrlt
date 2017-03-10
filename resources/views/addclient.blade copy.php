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
            <label>Client Unique Identification</label>
            <input class="form-control-n" id="clientuid" />
          </div>
        </div>
        <div class="col-md-2 col-md-offset-1">
          <label  for="name">Client DOB</label>
          <div class="input-group">
            <input type="text" class="form-control-n" id="rangepicker15" />
            <div class="cal-icon"><img src="img/vew.png" width="22" alt="calender-icon"></div>
          </div>
        </div>
        <div class="col-md-2 col-md-offset-1">
          <div class="form-group">
            <label>Last Viral Load Date</label>
            <input class="form-control-n" id="last_viral_load_date">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2 col-md-offset-2">
          <div class="form-group">
            <label>Client Name</label>
            <input class="form-control-n" id="client_name">
          </div>
        </div>
        <div class="col-md-2 col-md-offset-1">
          <label  for="name">Age</label>
          <input class="form-control-n" style="width:50%;" id="age">
        </div>
        <div class="col-md-2 col-md-offset-1">
          <div class="form-group">
            <label>Last Viral Load Result</label>
            <input class="form-control-n" id="last_viral_load_result">
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
                        <label class="col-md-4 control-label" style="margin-top:5px;">Facility Code</label>
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
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3" id="cl_pregnant_bf" style="display:none;">
                      <div class="form-group">
                        <label class="col-md-6 control-label client-details">Pregnant or
                          Breastfeeding</label>
                        <div class="col-md-5">
                          <select id="pregnant_bf" class="form-control required" name="pregnant_bf">
                            <option value="">-- Select --</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3" id="cl_enrolled_in" style="display:none;">
                      <div class="form-group">
                        <label class="col-md-5 control-label client-details" >Enrolled in
                          PMTCT</label>
                        <div class="col-md-5">
                          <select id="enrolled_in" class="form-control required" name="enrolled_in">
                            <option value="">-- Select --</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3" id="cl_pmtct_date" style="display:none;">
                      <div class="form-group">
                        <label class="col-md-4 control-label client-details">PMTCT
                          Enrollment</label>
                        <div class="col-md-8">
                          <div class="input-group">
                            <input type="text" class="form-control-n" id="rangepicker18" />
                            <div class="cal-icon"><img src="img/vew.png" width="22" alt="calender-icon"></div>
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
                          <input id="phone" class="form-control-n" type="text">
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
                            <option value="Not Yet Initiated">Not Yet Initiated</option>
                            <option value="Newly Initiated">Newly Initiated</option>
                            <<option value="Ongoing ART Client">Ongoing ART Client</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4" id="date_initiated_on_art" style="display:none;">
                      <div class="form-group">
                        <label class="col-md-5 control-label client-details">Date Initiated on ART</label>
                        <div class="col-md-6">
                          <div class="input-group">
                            <input type="text" class="form-control-n" id="rangepicker10" />
                            <div class="cal-icon"><img src="img/vew.png" width="22" alt="calender-icon"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4" style="display:none;" id="artmedicationdiv">
                      <div class="form-group">
                        <label class="col-md-5 control-label client-details"  >ART Medication </label>
                        <div class="col-md-7">
                          <select id="artmedication" class="form-control">
                            <option value="">-- Select --</option>
							              <option value="firstline">First Line</option>
                            <option value="secondline">2nd Line (with specifics of drug type) </option>
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
                          <select id="tr_gender" name="tr_gender" class="form-control" disabled>
                            <option value="">-- Select --</option>
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3" id="dv_pregnat_bf" style="display:none;">
                      <div class="form-group">
                        <label class="col-md-6 control-label client-details">Pregnant or
                          Breastfeeding</label>
                        <div class="col-md-5">
                          <select id="tr_pregnat_bf" name="tr_pregnat_bf" class="form-control" disabled>
                            <option value="">-- Select --</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3" style="display:none;" id="dv_enrolled_in">
                      <div class="form-group">
                        <label class="col-md-5 control-label client-details" >Enrolled in
                          PMTCT</label>
                        <div class="col-md-5">
                          <select id="tr_enrolled_in" name="tr_enrolled_in" class="form-control" disabled>
                            <option value="">-- Select --</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3" style="display:none;" id="dv_pmtct_date">
                      <div class="form-group">
                        <label class="col-md-4 control-label client-details">PMTCT
                          Enrollment</label>
                        <div class="col-md-8">
                          <div class="input-group">
                            <input type="text" class="form-control-n" id="tr_pmctc_enrolled_date" disabled/>
                            <div class="cal-icon"><img src="img/vew.png" width="22" alt="calender-icon"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row" style="display:none;" id="previousregimensdiv">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="col-md-4 control-label" style="margin-top:5px;" >Previous Regimens</label>
                        <div class="col-md-8">
                          <input class="form-control-n" type="text" id="previous_regimens" />
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
                            <input type="text" class="form-control-n" id="rangepicker6" />
                            <div class="cal-icon"><img src="img/vew.png" width="22" alt="calender-icon"></div>
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
                            <input type="text" class="form-control-n" id="rangepicker5" />
                            <div class="cal-icon"><img src="img/vew.png" width="22" alt="calender-icon"></div>
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
                            <input type="text" class="form-control-n" id="rangepicker7"/>
                            <div class="cal-icon"><img src="img/vew.png" width="22" alt="calender-icon"></div>
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
                            <input type="text" class="form-control-n" id="rangepicker9" />
                            <div class="cal-icon"><img src="img/vew.png" width="22" alt="calender-icon"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="col-md-5 control-label" style="margin-top:5px;" >Collected By</label>
                        <div class="col-md-7">
                          <input class="form-control-n" type="text" id="collected_by">
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
                          <tbody>
                            <tr>
                              <td bgcolor="#f1f2f1">&nbsp;</td>
                              <td bgcolor="#f1f2f1">&nbsp;</td>
                              <td bgcolor="#f1f2f1">&nbsp;</td>
                              <td bgcolor="#f1f2f1">&nbsp;</td>
                              <td bgcolor="#f1f2f1">&nbsp;</td>
                              <td bgcolor="#f1f2f1">&nbsp;</td>
                              <td bgcolor="#f1f2f1">&nbsp;</td>
                              <td bgcolor="#f1f2f1">&nbsp;</td>
                              <td bgcolor="#f1f2f1">&nbsp;</td>
                            </tr>
                            <tr class="odd">
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td bgcolor="#f1f2f1">&nbsp;</td>
                              <td bgcolor="#f1f2f1">&nbsp;</td>
                              <td bgcolor="#f1f2f1">&nbsp;</td>
                              <td bgcolor="#f1f2f1">&nbsp;</td>
                              <td bgcolor="#f1f2f1">&nbsp;</td>
                              <td bgcolor="#f1f2f1">&nbsp;</td>
                              <td bgcolor="#f1f2f1">&nbsp;</td>
                              <td bgcolor="#f1f2f1">&nbsp;</td>
                              <td bgcolor="#f1f2f1">&nbsp;</td>
                            </tr>
                            <tr class="odd">
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
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
                          <input class="form-control-n" type="text" id="lb_date_sample_collected" readonly>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">Date Sample
                          Shipped</label>
                        <div class="col-md-6">
                          <input required="" class="form-control-n" type="text" id="lb_date_sample_shipped" readonly/>
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
                            <option value="6 Months">6 Months</option>
                            <option value="12 Months">12 Months</option>
                            <option value="Yearly RT"></option>
                            <option value="Critical RT">Critical RT</option>
                            <option value="2nd Line RT">2nd Line RT</option>
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
                            <input type="text" class="form-control-n" id="rangepicker8" />
                            <div class="cal-icon"><img src="img/vew.png" width="22" alt="calender-icon"></div>
                          </div>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">Equipment Type</label>
                        <div class="col-md-6">
                          <select id="equipment_type" class="form-control" name="equipment_type">
                            <option value="">-- Select --</option>
                            <option value="option1">option1</option>
                            <option value="option2">option2</option>
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
                            <option value="Below Detectable Level">Below Detectable Level</option>
                            <option value="Within Detectable Range">Within Detectable Range</option>
                            <option value="Above Maximum Value">Above Maximum Value</option>
                          </select>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group" id="hivvldiv" style="display:none;">
                        <label class="col-md-3 control-label">HIV Viral Load
                          Results copies/ml</label>
                        <div class="col-md-6">
                          <input id="hiv_viral_load" class="form-control-n" style="width:79%;" type="text" required>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="form-group" id="date_of_reporting" style="display:none;">
                        <label class="col-md-3 control-label" style="margin-top:8px;">Date of Reporting</label>
                        <div class="col-md-6">
                          <input id="rangepicker13" class="form-control-n" style="width:79%;" type="text" disabled>
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
                          <tbody>
                            <tr>
                              <td bgcolor="#f1f2f1">&nbsp;</td>
                              <td bgcolor="#f1f2f1">&nbsp;</td>
                              <td bgcolor="#f1f2f1">&nbsp;</td>
                              <td bgcolor="#f1f2f1">&nbsp;</td>
                              <td bgcolor="#f1f2f1">&nbsp;</td>
                              <td bgcolor="#f1f2f1">&nbsp;</td>
                            </tr>
                            <tr class="odd">
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td bgcolor="#f1f2f1">&nbsp;</td>
                              <td bgcolor="#f1f2f1">&nbsp;</td>
                              <td bgcolor="#f1f2f1">&nbsp;</td>
                              <td bgcolor="#f1f2f1">&nbsp;</td>
                              <td bgcolor="#f1f2f1">&nbsp;</td>
                              <td bgcolor="#f1f2f1">&nbsp;</td>
                            </tr>
                            <tr class="odd">
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
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
                          <select id="is_discharge" class="form-control" name="is_discharge">
                            <option value="">-- Select --</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4" id="date_of_discharge" style="display: none;">
                      <div class="form-group">
                        <label class="col-md-5 control-label">Date of
                          Discharge</label>
                        <div class="col-md-7">
                          <div class="input-group">
                            <input type="text" class="form-control-n" id="rangepicker17" />
                            <div class="cal-icon"><img src="img/vew.png" width="22" alt="calender-icon"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row" id="discharge_reason" style="display: none;">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="col-md-2 control-label" style="margin-top:5px;" >Reason of Discharge</label>
                        <div class="col-md-8">
                          <input required="" class="form-control-n" type="text">
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
                          <textarea class="form-control-tn resize_vertical" id="message" name="message" placeholder="Please enter your message here..." rows="5"></textarea>
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
                          <tbody>
                            <tr>
                              <td bgcolor="#f1f2f1">&nbsp;</td>
                              <td bgcolor="#f1f2f1">&nbsp;</td>
                            </tr>
                            <tr class="odd">
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td bgcolor="#f1f2f1">&nbsp;</td>
                              <td bgcolor="#f1f2f1">&nbsp;</td>
                            </tr>
                            <tr class="odd">
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
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
          url: "{{ url('/clientdetails') }}",
          data: 'client_id='+$('#clientuid').val()+'&_token=<?php echo csrf_token(); ?>&client_dob='+$('#rangepicker15').val()+'&client_name='+
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
            url: "{{ url('/savetreatment') }}",
            data: 'art_status='+$('#art_status').val()+'&_token=<?php echo csrf_token(); ?>&date_initiated_on_art='+date_initiated_on_art+'&artmedication='+
            artmedication+'&previous_regimens='+previousregimens+'&test_requested_date='+$('#rangepicker6').val()+'&testest_requested_date_hvl='+$('#rangepicker5').val()+'&sample_collection_date='+$('#rangepicker7').val()+'&sample_shipped_date='+$('#rangepicker9').val()+'&collected_by='+$('#collected_by').val(),
            cache: false,
            async:false,
            success: function(data)
            {

              if(data.status == 'success'){
                $('#lb_date_sample_collected').val(data.sample_collection_date);
                $('#lb_date_sample_shipped').val(data.sample_shipped_date);

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
          if(val == "Within Detectable Range"){
            $('#hivvldiv').show();
            $('#date_of_reporting').show();
          }else {
            $('#hivvldiv').hide();
            $('#date_of_reporting').hide();
          }
      });

      $('#form3').submit(function(e){

          if($('#viral_load_detectable').val() == 'Within Detectable Range'){
            var hiv_viral_load = $('#hiv_viral_load').val();
            var reportingdate = $('#rangepicker13').val();
          }else{
            var hiv_viral_load = '';
            var reportingdate = '';
          }
          $.ajax
            ({
              type: "POST",
              url: "{{ url('/savelabresults') }}",
              data: 'sample_type='+$('#sample_type').val()+'&_token=<?php echo csrf_token(); ?>&test_received_date='+$('#rangepicker8').val()+'&equipment_type='+
              $('#equipment_type').val()+'&viral_load_detectable='+$('#viral_load_detectable').val()+'&hiv_viral_load_results='+hiv_viral_load+'&date_of_reporting='+reportingdate,
              cache: false,
              async:false,
              success: function(data)
              {
                alert(data);
                if(data.status == 'success'){
                  $('#lb_date_sample_collected').val(data.sample_collection_date);
                  $('#lb_date_sample_shipped').val(data.sample_shipped_date);

                  $('.nav-tabs > .active').next('li').find('a').trigger('click');
                }else{
                  alert('Fail');
                }


              }
            });
        return false;
        });
  </script>
@stop
