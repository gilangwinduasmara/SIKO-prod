"use strict";
var defaults = {
	"language": {
		"paginate": {
			"first": '<i class="ki ki-double-arrow-back"></i>',
			"last": '<i class="ki ki-double-arrow-next"></i>',
			"next": '<i class="ki ki-arrow-next"></i>',
			"previous": '<i class="ki ki-arrow-back"></i>'
		}
	}
};

var search = function (settings, data, dataIndex) {
    console.log('tes')
    var min = $('#datepicker_dari').val();
    var max = $('#datepicker_sampai').val();
    var startDate = new Date(data[1]);
    if (min == null && max == null) { return true; }
    if (min == null && startDate <= max) { return true; }
    if (max == null && startDate >= min) { return true; }
    if (startDate <= max && startDate >= min) { return true; }
    return false;
}

if (KTUtil.isRTL()) {
	defaults = {
		"language": {
			"paginate": {
				"first": '<i class="ki ki-double-arrow-next"></i>',
				"last": '<i class="ki ki-double-arrow-back"></i>',
				"next": '<i class="ki ki-arrow-back"></i>',
				"previous": '<i class="ki ki-arrow-next"></i>'
			}
		}
    }
}


$.extend(true, $.fn.dataTable.defaults, defaults);
$.extend(true, $.fn.dataTable.ext.search, search);

// fix dropdown overflow inside datatable
KTApp.initAbsoluteDropdown('.dataTables_wrapper');
