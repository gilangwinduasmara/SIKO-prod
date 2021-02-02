    $(document).ready( function () {
    var datatable = $('#kt_datatable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            // 'copy', 'csv', 'excel', 'pdf', 'print'
            'excel', 'pdf', 'print'
        ],
        columnDefs: [
            {
                targets: 1,
                render: function(data){
                    return data
                }
            }
        ],
        initComplete: function(){
            $('#kt_datatable').show();
        },
        pageLength: 5,
    })
    $('#kt_datatable_filter').hide();
    $('#kt_datatable_length').hide();

    $('.dt-button').addClass('btn btn-outline-primary btn-shadow');
    $('.buttons-excel').prepend('<i class="far fa-file-excel"></i>')
    $('.buttons-pdf').prepend('<i class="far fa-file-pdf"></i>')
    $('.buttons-print').prepend('<i class="fas fa-print"></i>')
    // $('.buttons-pdf').addClass('btn btn-outline-primary btn-shadow');
    // $('.buttons-print').addClass('btn btn-outline-primary btn-shadow');

    $.fn.dataTable.ext.search.push(
        function( settings, data, dataIndex ) {
            var min  = $('#datepicker_dari').val();
            var max  = $('#datepicker_sampai').val();
            console.log(min, max);
            var createdAt = data[1] || 0; // Our date column in the table
            if  (
                    ( min == "" || max == "" )
                    ||
                    ( moment(createdAt).isSameOrAfter(min) && moment(createdAt).isSameOrBefore(max) )
                )
            {
                return true;
            }
            return false;
        }
    );



    $('#kt_datatable_search_query').keyup(function(){
        console.log($(this).val())
        datatable.search($(this).val()).draw();
    })
    $('#kt_datatable_search_status').on('change', function() {
        if($(this).val() == ""){
            datatable.search("", 'Status')
        }else{
            if($(this).val() == "Selesai"){
                $('#keterangan-1').hide();
                $('#keterangan-2').show();
            }else if($(this).val() == "Aktif"){
                $('#keterangan-1').show();
                $('#keterangan-2').hide();
            }
            console.log($(this).val())
            if(detail){
                datatable.columns(6).search($(this).val()).draw();
            }else{
                datatable.columns(3).search($(this).val()).draw();
            }
        }
    });

    $('.datepicker-search').change(function(){
        datatable.draw();
    })

    $('#kt_datatable_search_keterangan').on('change', function() {
        console.log($(this).val())
        datatable.columns(4).search($(this).val()).draw();
    });
    $('#kt_datatable_search_keterangan2').on('change', function() {
        console.log($(this).val())
        datatable.columns(4).search($(this).val()).draw();
    });
    $('#kt_datatable_search_fakultas').on('change', function() {
        datatable.columns(2).search($(this).val()).draw();
    });

    $('#kt_datatable_search_status, #kt_datatable_search_keterangan').selectpicker();

    });
