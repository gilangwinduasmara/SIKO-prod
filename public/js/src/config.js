var conf = {
    toastr: {
        options: {
            saving: {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-bottom-center",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "100000",
                "hideDuration": "0",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        }
    },
    datatable: {
        translate: {
            records: {
                processing: 'Memuat data ...',
                noRecords: 'Data tidak ditemukan'
            },
            toolbar: {
                pagination: {
                    items: {
                        info: "Menampilkan {{start}} - {{end}} dari {{total}} data"
                    }
                }
            }
        }
    }
}
