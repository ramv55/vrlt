$("#daterange1").daterangepicker({
    locale: {
        format: 'MM/DD/YYYY'
    }
});
$("#daterange2").daterangepicker({
    timePicker: true,
    timePickerIncrement: 1,
    locale: {
        format: 'MM/DD/YYYY h:mm A'
    }
});

function cb(start, end) {
    $('#daterange3 span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
}
cb(moment().subtract(29, 'days'), moment());

$('#daterange3').daterangepicker({
    ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment()],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    }
}, cb);

$("#rangepicker4").daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        locale: { format: "MM/DD/YYYY" }
    });

	$("#rangepicker5").daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        locale: { format: "MM/DD/YYYY" }
    });
		$("#rangepicker6").daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        locale: { format: "MM/DD/YYYY" }
    });

	$("#rangepicker7").daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        locale: { format: "MM/DD/YYYY" }
    });

	$("#rangepicker8").daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        locale: { format: "MM/DD/YYYY" }
    });

	$("#rangepicker9").daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        locale: { format: "MM/DD/YYYY" }
    });
		$("#rangepicker10").daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        locale: { format: "MM/DD/YYYY" }
    });
			$("#rangepicker11").daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        locale: { format: "MM/DD/YYYY" }
    });
				$("#rangepicker12").daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        locale: { format: "MM/DD/YYYY" }
    });

    $("#rangepicker13").daterangepicker({
      singleDatePicker: true,
      showDropdowns: true,
      autoUpdateInput: false,
      locale: { format: "MM/DD/YYYY" },
    },function(chosen_date) {
      $('#rangepicker13').val(chosen_date.format('MM/DD/YYYY'));
    });

					$("#rangepicker14").daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        locale: { format: "MM/DD/YYYY" }
    });


					$("#rangepicker15").daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            autoUpdateInput: false,
            locale: { format: "MM/DD/YYYY" },
          },function(chosen_date) {
            $('#rangepicker15').val(chosen_date.format('MM/DD/YYYY'));
            var ynew = todaydate.getFullYear();
            var mnew = (todaydate.getMonth())+1;
            var dnew = todaydate.getDate();
            var currentdate = dnew+'/'+mnew+'/'+ynew;
            var totaldays = daydiff(parseDate($("#rangepicker15").val()), parseDate(currentdate));
            var days = totaldays - 365;
            var age = days/365;
            $("#age").val(Math.floor(age));
          });

					$("#rangepicker16").daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        locale: { format: "MM/DD/YYYY" }
    });
						$("#rangepicker17").daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        locale: { format: "MM/DD/YYYY" }
    });
						$("#rangepicker18").daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        locale: { format: "MM/DD/YYYY" }
    });
		$("#rangepicker19").daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        locale: { format: "MM/DD/YYYY" }
    });

    $("#nexttestdate").daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        locale: { format: "MM/DD/YYYY" }
    });

    $("#reported_date").daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        locale: { format: "MM/DD/YYYY" }
    });



//datetimepicker


//$("#datetime1").datetimepicker().parent().css("position :relative");
// $("#datetime2").datetimepicker({
//     format: 'LT'
// }).parent().css("position :relative");
// $("#datetime3").datetimepicker({
//     viewMode: 'years'
// }).parent().css("position :relative");
// $("#datetime4").datetimepicker({
//     viewMode: 'years',
//     format: 'MM/YYYY'
// }).parent().css("position :relative");
// $("#datetime5").datetimepicker({
//     inline: true,
//     sideBySide: true
// });
//dtetime picker end

//clockface picker
// $("#clockface1").clockface();
//
// $("#clockface2").clockface();
//
// $("#clockface3").clockface({
//     format: 'H:mm'
// }).clockface('show', '14:30');
//clockface picker end
