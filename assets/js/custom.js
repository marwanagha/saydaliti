var siteURL = '/saydaliti/';
var siteFilesURL = siteURL + 'files/';
var city_id_global = $('#city-select').val();
var order_status_id_global = $('#status-select').val();


$(document).ready(function () {


    var select_clicked_cat = false;
    var select_clicked_city = false;
    var select_clicked_man = false;
    var select_clicked_form = false;
    var select_clicked_type = false;
    var select_clicked_offer = false;
    var select_clicked_warehouse = false;


    /** saydaliti drugs**/

    $('#add-drug').click(function () {

        // $('#man-modal').modal({show: true})
        window.location.href = siteURL + "drug-form";
    })


    $(document).on('click', '.edit-drug', function () {
        $d_id = $(this).data('id')
        window.location.href = siteURL + 'drug-form/' + $d_id;
    })

    $(document).on('click', '.delete-drug', function () {
        $('#confirm-modal-delete-drug').modal({show: true})

        localStorage.setItem('drug_id', $(this).data('id'))

    })

    $('#yes-delete-drug').click(function () {
        $drug_id = localStorage.getItem('drug_id');
        // $selector = '#drug-' + $drug_id;

        $.ajax({
            method: "POST",
            url: "requests/drugs-management.php",
            data: {
                drug_id: $drug_id,
                delete: 'delete',
            }
        }).done(function (msg) {

            if (msg == 1) {
                $("button[data-id=" + $drug_id + "]").parent().parent().fadeOut(500, function () {

                    $(this).remove();

                })

                $.notify(lang.successfully_done, {position: "left bottom", className: "success"});
            } else if (msg == -1) {
                $.notify(lang.general_error, {position: "left bottom", className: "error"});
            } else
                $.notify('Can not delete drug ' + msg, {position: "left bottom", className: "error"});

        })

    })

    $('#no-delete-drug').click(function () {

        // $('#confirm-modal-product-status').hide();
        //remove tr

    })

    // $('.active-product').change(function () {
    //
    //
    //     $('#confirm-modal-product-status').modal({show: true})
    //     localStorage.setItem('product_status', '1');
    //     localStorage.setItem('product_id', $(this).data('id'));
    //
    //
    // })
    // $('.inactive-product').change(function () {
    //
    //     $('#confirm-modal-product-status').modal({show: true})
    //     localStorage.setItem('product_status', '2');
    //     localStorage.setItem('product_id', $(this).data('id'));
    //
    //
    // })


    // $('#yes-status-product').click(function () {
    //     $.ajax({
    //         method: "POST",
    //         url: "requests/products_management.php",
    //         data: {
    //             product_id: localStorage.getItem('product_id'),
    //             action: 'change-status',
    //             status: localStorage.getItem('product_status'),
    //         }
    //     }).done(function (msg) {
    //
    //         if (msg == 1)
    //             $.notify(lang.successfully_done, {position: "left bottom", className: "success"});
    //         else
    //             $.notify(lang.general_error, {position: "left bottom", className: "error"});
    //
    //
    //     })
    // })
    //
    // $('#no-status-product').click(function () {
    //
    //     $('#confirm-modal-product-status').hide()
    //     //let the previous status come back from localstorage
    //
    // })


    /** categories**/

    $('#add-category').click(function () {

        $('#category-modal').modal({show: true})
    })


    $(document).on('change', '.active-category', function () {
// alert()
        // $('#confirm-modal-cat-status').modal({show: true})
        // localStorage.setItem('cat_status', '1');
        // localStorage.setItem('cat_id', $(this).data('id'));

        $.ajax({
            method: "POST",
            url: "requests/categories-management.php",
            data: {
                cat_id: $(this).data('id'),
                action: 'change-status',
                status: 1,
            }
        }).done(function (msg) {

            if (msg == 1)
                $.notify(lang.successfully_done, {position: "left bottom", className: "success"});
            else
                $.notify(lang.general_error, {position: "left bottom", className: "error"});


        })


    })

    $(document).on('change', '.inactive-category', function () {
        // $('#confirm-modal-cat-status').modal({show: true})
        // localStorage.setItem('cat_status', '0');
        // localStorage.setItem('cat_id', $(this).data('id'));

        $.ajax({
            method: "POST",
            url: "requests/categories-management.php",
            data: {
                cat_id: $(this).data('id'),
                action: 'change-status',
                status: 0,
            }
        }).done(function (msg) {

            if (msg == 1)
                $.notify(lang.successfully_done, {position: "left bottom", className: "success"});
            else
                $.notify(lang.general_error, {position: "left bottom", className: "error"});


        })

    })

    // $('#yes-status-cat').click(function () {
    //     $.ajax({
    //         method: "POST",
    //         url: "requests/category-management.php",
    //         data: {
    //             cat_id: localStorage.getItem('cat_id'),
    //             action: 'change-status',
    //             status: localStorage.getItem('cat_status'),
    //         }
    //     }).done(function (msg) {
    //
    //         if (msg == 1)
    //             $.notify(lang.successfully_done, {position: "left bottom", className: "success"});
    //         else
    //             $.notify(lang.general_error, {position: "left bottom", className: "error"});
    //
    //
    //     })
    //
    // })
    //
    // $('#no-status-cat').click(function () {
    //
    //     //remove tr
    //
    //
    // })


    $(document).on('click', '.delete-cat', function () {

        $('#confirm-modal-delete-cat').modal({show: true})

        localStorage.setItem('cat_id', $(this).data('id'))

    })

    $('#yes-delete-category').click(function () {
        $cat_id = localStorage.getItem('cat_id');
        // $selector = '#category-' + $cat_id;

        $.ajax({
            method: "POST",
            url: "requests/categories-management.php",
            data: {
                cat_id: $cat_id,
                action: 'delete',
            }
        }).done(function (msg) {

            if (msg == 1) {
                $("button[data-id=" + $cat_id + "]").parent().parent().fadeOut(500, function () {

                    $(this).remove();

                })
                $.notify(lang.successfully_done, {position: "left bottom", className: "success"});
            } else {
                $.notify(lang.canNotDeleteCat, {position: "left bottom", className: "error"});
            }

        })

    })

    $('#no-delete-category').click(function () {


    })


    /** manufacturers**/

    $(document).on('click', '.edit-man', function () {
        $m_id = $(this).data('id')
        window.location.href = siteURL + 'manufacturer-form/' + $m_id;
    })

    $('#add-man').click(function () {

        // $('#man-modal').modal({show: true})
        window.location.href = siteURL + "manufacturer-form";
    })


    $(document).on('change', '.active-man', function () {
// alert()
        // $('#confirm-modal-cat-status').modal({show: true})
        // localStorage.setItem('cat_status', '1');
        // localStorage.setItem('cat_id', $(this).data('id'));

        $.ajax({
            method: "POST",
            url: "requests/manufacturers-management.php",
            data: {
                man_id: $(this).data('id'),
                action: 'change-status',
                status: 1,
            }
        }).done(function (msg) {

            if (msg == 1)
                $.notify(lang.successfully_done, {position: "left bottom", className: "success"});
            else
                $.notify(lang.general_error, {position: "left bottom", className: "error"});


        })


    })

    $(document).on('change', '.inactive-man', function () {
        // $('#confirm-modal-cat-status').modal({show: true})
        // localStorage.setItem('cat_status', '0');
        // localStorage.setItem('cat_id', $(this).data('id'));

        $.ajax({
            method: "POST",
            url: "requests/manufacturers-management.php",
            data: {
                man_id: $(this).data('id'),
                action: 'change-status',
                status: 0,
            }
        }).done(function (msg) {

            if (msg == 1)
                $.notify(lang.successfully_done, {position: "left bottom", className: "success"});
            else
                $.notify(lang.general_error, {position: "left bottom", className: "error"});


        })

    })

    // $('#yes-status-cat').click(function () {
    //     $.ajax({
    //         method: "POST",
    //         url: "requests/category-management.php",
    //         data: {
    //             cat_id: localStorage.getItem('cat_id'),
    //             action: 'change-status',
    //             status: localStorage.getItem('cat_status'),
    //         }
    //     }).done(function (msg) {
    //
    //         if (msg == 1)
    //             $.notify(lang.successfully_done, {position: "left bottom", className: "success"});
    //         else
    //             $.notify(lang.general_error, {position: "left bottom", className: "error"});
    //
    //
    //     })
    //
    // })
    //
    // $('#no-status-cat').click(function () {
    //
    //     //remove tr
    //
    //
    // })


    $(document).on('click', '.delete-man', function () {

        $('#confirm-modal-delete-man').modal({show: true})

        localStorage.setItem('man_id', $(this).data('id'))

    })

    $('#yes-delete-man').click(function () {
        $man_id = localStorage.getItem('man_id');
        // $selector = '#category-' + $cat_id;

        $.ajax({
            method: "POST",
            url: "requests/manufacturers-management.php",
            data: {
                man_id: $man_id,
                action: 'delete',
            }
        }).done(function (msg) {

            if (msg == 1) {
                $("button[data-id=" + $man_id + "]").parent().parent().fadeOut(500, function () {

                    $(this).remove();

                })
                $.notify(lang.successfully_done, {position: "left bottom", className: "success"});
            } else {
                $.notify(lang.canNotDeleteCat, {position: "left bottom", className: "error"});
            }

        })

    })

    $('#no-delete-man').click(function () {


    })


    /** saydaliti pharmacies **/


    $(document).on('change', '.approve-pharmacy', function () {

        $('#confirm-modal-approve-pharmacy').modal({show: true})

        localStorage.setItem('pharmacy_id', $(this).data('id'));
    })


    $(document).on('change', '.reject-pharmacy', function () {

        $('#confirm-modal-reject-pharmacy').modal({show: true})

        localStorage.setItem('pharmacy_id', $(this).data('id'));
    })

    $(document).on('click', '#yes-approve-pharmacy', function () {

        $pharmacy_id = localStorage.getItem('pharmacy_id');


        $.ajax({
            method: "POST",
            url: "../requests/pharmacies-management.php",
            data: {
                pharmacy_id: $pharmacy_id,
                action: 'change-status',
                status: 1,
            }
        }).done(function (msg) {

            if (msg == 1)

                window.location.href = siteURL + "pharmacy-form/" + $pharmacy_id;
            else
                $.notify(lang.general_error, {position: "left bottom", className: "error"});


        })


    })

    $(document).on('click', '#yes-reject-pharmacy', function () {

        $pharmacy_id = localStorage.getItem('pharmacy_id');

        $.ajax({
            method: "POST",
            url: "../requests/pharmacies-management.php",
            data: {
                pharmacy_id: $pharmacy_id,
                action: 'change-status',
                status: 0,
            }
        }).done(function (msg) {

            if (msg == 1)
                window.location.href = siteURL + "pharmacy-form/" + $pharmacy_id;
            else
                $.notify(lang.general_error, {position: "left bottom", className: "error"});


        })

    });

    $(document).on('click', '#no-approve-pharmacy', function () {
        $('.btn-info').removeClass('active');
    });

    $(document).on('click', '#no-reject-pharmacy', function () {
        $('.btn-info').removeClass('active');
    });


    $('#add-pharmacy').click(function () {

        // $('#man-modal').modal({show: true})
        window.location.href = siteURL + "pharmacy-form";
    })


    $(document).on('click', '.edit-pharmacy', function () {
        $f_id = $(this).data('id')
        window.location.href = siteURL + 'pharmacy-form/' + $f_id;
    })

    $(document).on('click', '.delete-pharmacy', function () {
        $('#confirm-modal-delete-pharmacy').modal({show: true})

        localStorage.setItem('pharmacy_id', $(this).data('id'))

    })

    $('#yes-delete-pharmacy').click(function () {
        $pharmacy_id = localStorage.getItem('pharmacy_id');
        // $selector = '#drug-' + $drug_id;

        $.ajax({
            method: "POST",
            url: "requests/pharmacies-management.php",
            data: {
                pharmacy_id: $pharmacy_id,
                delete: 'delete',
            }
        }).done(function (msg) {

            if (msg == 1) {
                $("button[data-id=" + $pharmacy_id + "]").parent().parent().fadeOut(500, function () {

                    $(this).remove();

                })

                $.notify(lang.successfully_done, {position: "left bottom", className: "success"});
            } else if (msg == -1) {
                $.notify(lang.general_error, {position: "left bottom", className: "error"});
            } else
                $.notify('Can not delete drug ' + msg, {position: "left bottom", className: "error"});

        })

    })

    $('#no-delete-pharmacy').click(function () {

        // $('#confirm-modal-product-status').hide();
        //remove tr

    })


    /** warehouses**/

    $(document).on('click', '.edit-warehouse', function () {
        $w_id = $(this).data('id')
        window.location.href = siteURL + 'warehouse-form/' + $w_id;
    })

    $('#add-warehouse').click(function () {

        // $('#man-modal').modal({show: true})
        window.location.href = siteURL + "warehouse-form";
    })


    $(document).on('change', '.active-warehouse', function () {
// alert()
        // $('#confirm-modal-cat-status').modal({show: true})
        // localStorage.setItem('cat_status', '1');
        // localStorage.setItem('cat_id', $(this).data('id'));

        $.ajax({
            method: "POST",
            url: "requests/warehouses-management.php",
            data: {
                warehouse_id: $(this).data('id'),
                action: 'change-status',
                status: 1,
            }
        }).done(function (msg) {

            if (msg == 1)
                $.notify(lang.successfully_done, {position: "left bottom", className: "success"});
            else
                $.notify(lang.general_error, {position: "left bottom", className: "error"});


        })


    })

    $(document).on('change', '.inactive-warehouse', function () {

        // $('#confirm-modal-cat-status').modal({show: true})
        // localStorage.setItem('cat_status', '0');
        // localStorage.setItem('cat_id', $(this).data('id'));

        $.ajax({
            method: "POST",
            url: "requests/warehouses-management.php",
            data: {
                warehouse_id: $(this).data('id'),
                action: 'change-status',
                status: 0,
            }
        }).done(function (msg) {

            if (msg == 1)
                $.notify(lang.successfully_done, {position: "left bottom", className: "success"});
            else
                $.notify(lang.general_error, {position: "left bottom", className: "error"});


        })

    })


    $(document).on('click', '.delete-warehouse', function () {

        $('#confirm-modal-delete-warehouse').modal({show: true})

        localStorage.setItem('warehouse_id', $(this).data('id'))

    })

    $('#yes-delete-warehouse').click(function () {
        $warehouse_id = localStorage.getItem('warehouse_id');
        // $selector = '#category-' + $cat_id;

        $.ajax({
            method: "POST",
            url: "requests/warehouses-management.php",
            data: {
                warehouse_id: $warehouse_id,
                action: 'delete',
            }
        }).done(function (msg) {

            if (msg == 1) {
                $("button[data-id=" + $warehouse_id + "]").parent().parent().fadeOut(500, function () {

                    $(this).remove();

                })
                $.notify(lang.successfully_done, {position: "left bottom", className: "success"});
            } else {
                $.notify(lang.canNotDeleteCat, {position: "left bottom", className: "error"});
            }

        })

    })

    $('#no-delete-warehouse').click(function () {


    })

    // $(document).on('submit','#warehouse-form',function (e) {
    //     e.preventDefault()
    //
    // })


    /** ads **/


    $('#add-ad').click(function () {
        // select_clicked_type = false;
        $('#ad-modal').modal({show: true})
    })

    $(document).on('click', '.delete-ad', function () {

        $('#confirm-modal-delete-ad').modal({show: true})

        localStorage.setItem('ad_id', $(this).data('id'))

    })

    $('#yes-delete-ad').click(function () {
        $ad_id = localStorage.getItem('ad_id');
        // $selector = '#category-' + $cat_id;

        $.ajax({
            method: "POST",
            url: "requests/ads-management.php",
            data: {
                ad_id: $ad_id,
                action: 'delete',
            }
        }).done(function (msg) {

            if (msg == 1) {
                $("button[data-id=" + $ad_id + "]").parent().parent().fadeOut(500, function () {

                    $(this).remove();

                })
                $.notify(lang.successfully_done, {position: "left bottom", className: "success"});
            } else {
                $.notify(lang.canNotDeleteCat, {position: "left bottom", className: "error"});
            }

        })

    })

    $('#no-delete-ad').click(function () {


    })


    /** orders **/

    $(document).on('change', '.processing-order', function () {
// alert()
        // $('#confirm-modal-cat-status').modal({show: true})
        // localStorage.setItem('cat_status', '1');
        // localStorage.setItem('cat_id', $(this).data('id'));

        $.ajax({
            method: "POST",
            url: "requests/orders-management.php",
            data: {
                order_id: $(this).data('id'),
                action: 'change-status',
                status: 2,
            }
        }).done(function (msg) {

            if (msg == 1)
                $.notify(lang.successfully_done, {position: "left bottom", className: "success"});
            else
                $.notify(lang.general_error, {position: "left bottom", className: "error"});


        })


    })
    $(document).on('change', '.done-order', function () {
// alert()
        // $('#confirm-modal-cat-status').modal({show: true})
        // localStorage.setItem('cat_status', '1');
        // localStorage.setItem('cat_id', $(this).data('id'));

        $.ajax({
            method: "POST",
            url: "requests/orders-management.php",
            data: {
                order_id: $(this).data('id'),
                action: 'change-status',
                status: 3,
            }
        }).done(function (msg) {

            if (msg == 1)
                $.notify(lang.successfully_done, {position: "left bottom", className: "success"});
            else
                $.notify(lang.general_error, {position: "left bottom", className: "error"});


        })


    })
    $(document).on('change', '.reject-order', function () {
// alert()
        // $('#confirm-modal-cat-status').modal({show: true})
        // localStorage.setItem('cat_status', '1');
        // localStorage.setItem('cat_id', $(this).data('id'));

        $.ajax({
            method: "POST",
            url: "requests/orders-management.php",
            data: {
                order_id: $(this).data('id'),
                action: 'change-status',
                status: 4,
            }
        }).done(function (msg) {

            if (msg == 1)
                $.notify(lang.successfully_done, {position: "left bottom", className: "success"});
            else
                $.notify(lang.general_error, {position: "left bottom", className: "error"});

        })


    })


    /** warehouse admin drugs **/

    $(document).on('click', '.link-drug-modal', function () {
        $('#warehouse-admin-link-drug-modal').modal({show: true})


        $('#warehouse-drug-id').val($(this).data('id'))
        $('#drug-warehouse-name').val($(this).data('name'))


    })

    $(document).on('click', '.link-drug-modal', function () {

        $('#wa-drug-price').val('')
        $('#drug-expiry-date').val('')

        $('#warehouse-admin-link-drug-modal').modal({show: true})


        $('#warehouse-drug-id').val($(this).data('id'))
        $('#drug-warehouse-name').val($(this).data('name'))


    })

    $(document).on('click', '.unlink-drug-modal', function () {


        $('#confirm-modal-unlink-drug').modal({show: true})

        localStorage.setItem('admin_drug_id', $(this).data('id'))


    })

    $(document).on('click', '#link-drug', function () {


        var $id = $('#warehouse-drug-id').val()
        var $price = $('#wa-drug-price').val()
        var $expiry_date = $('#drug-expiry-date').val()

        $.ajax({
            method: "POST",
            url: "requests/drugs-management.php",
            data: {
                action: 'link-drug',
                id: $id,
                price: $price,
                expiry_date: $expiry_date,
            }
        }).done(function (msg) {

            $('#warehouse-admin-link-drug-modal').modal('hide');


            if (msg == 1) {
                $("button[data-id=" + $id + "]").fadeOut(500, function () {

                    $(this).replaceWith('<span class="badge badge-pill badge-primary">Added</span>');

                })

                $.notify(lang.successfully_done, {position: "left bottom", className: "success"});
            } else
                $.notify(msg, {position: "left bottom", className: "error"});

        })


    })

    $('#yes-unlink-drug').click(function () {

        $drug_id = localStorage.getItem('admin_drug_id');
        // $selector = '#drug-' + $drug_id;

        $.ajax({
            method: "POST",
            url: "requests/drugs-admin-management.php",
            data: {
                drug_id: $drug_id,
                action: 'delete',
            }
        }).done(function (msg) {

            if (msg == 1) {
                $("button[data-id=" + $drug_id + "]").parent().parent().fadeOut(500, function () {

                    $(this).remove();

                })

                $.notify(lang.successfully_done, {position: "left bottom", className: "success"});

            } else
                $.notify(msg, {position: "left bottom", className: "error"});

        })

    })


    /** offers **/


    $(document).on('click', '.edit-offer', function () {
        $o_id = $(this).data('id')
        window.location.href = siteURL + 'offer-form/' + $o_id;
    })

    $(document).on('click', '.add-offer-drug', function () {

        $id = $(this).data('id')

        $name = $(this).data('name')
        $price = $(this).data('price')

        localStorage.setItem('drug_offer_name', $name)
        localStorage.setItem('drug_offer_price', $price)


        // $('#man-modal').modal({show: true})
        window.location.href = siteURL + "offer-form/" +'D'+ $id;

    })

    $drug_offer_name = localStorage.getItem('drug_offer_name')
    $drug_offer_price = localStorage.getItem('drug_offer_price')

    if($drug_offer_name!=null && $drug_offer_price!=null)
    {
        $('#drug-offer-name').val($drug_offer_name)
        $('#drug-offer-price').val($drug_offer_price)

    }



    $(document).on('click', '.delete-offer', function () {

        $('#confirm-modal-delete-offer').modal({show: true})

        localStorage.setItem('offer_id', $(this).data('id'))

    })

    $('#yes-delete-offer').click(function () {
        $offer_id = localStorage.getItem('offer_id');
        // $selector = '#category-' + $cat_id;

        $.ajax({
            method: "POST",
            url: "requests/offers-management.php",
            data: {
                offer_id: $offer_id,
                action: 'delete-offer',
            }
        }).done(function (msg) {

            if (msg == 1) {
                $("button[data-id=" + $offer_id + "]").parent().parent().fadeOut(500, function () {

                    $(this).remove();

                })
                $.notify(lang.successfully_done, {position: "left bottom", className: "success"});
            } else {
                $.notify(lang.canNotDeleteCat, {position: "left bottom", className: "error"});
            }

        })

    })


    var table_warehouses = $('#table-warehouses').DataTable({
        language: {
            processing: "Loading Data...",
            zeroRecords: "No matching records found"
        },
        processing: true,
        serverSide: true,
        orderCellsTop: true,
        autoWidth: true,
        deferRender: true,
        lengthMenu: [10, 25, 50, 100, 1000],
        // dom: '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6 text-right"l>><"row"<"col-sm-12"tr>><"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        // buttons: [
        //     {
        //         text: 'Export to Excel',
        //         className: 'btn btn-sm btn-dark',
        //         action: function (e, dt, node, config) {
        //             window.location.href = "/Home/GetExcel";
        //         },
        //         init: function (api, node, config) {
        //             $(node).removeClass('dt-button');
        //         }
        //     }
        // ],


        columns: [
            // {"DT_RowId": "drug-"+'Id'},
            {'data': 'Id'},
            {'data': 'Name'},
            {'data': 'Username'},
            {'data': 'City'},
            {'data': 'Address'},
            {'data': 'Phones'},
            {
                'data': 'SubscriptionType', render: function (data, type, row) {

                    if (row.SubscriptionType == 1) {
                        return 'Commission';
                    } else if (row.SubscriptionType == 2) {
                        return 'Subscription';
                    } else {
                        return '';
                    }

                }
            },
            {'data': 'SubscriptionPrice'},
            {'data': 'Status'},
            {'data': 'Actions'}

        ],

        columnDefs: [{
            "targets": 9, "data": "Actions", render: function (data, type, row) {
                return '<button data-id="' + row.Id + '" class="btn btn-blue btn edit-warehouse "><i\n' +
                    '                                        class="fa fa-pencil-square-o  "\n' +
                    '                                        aria-hidden="true"></i></button>\n' +
                    '                            <button data-id="' + row.Id + '" class="btn btn-blue btn delete-warehouse"><i\n' +
                    '                                        class="fa fa-trash-o  "\n' +
                    '                                        aria-hidden="true"></i></button>';
            }
        },

            {
                "targets": 8, "data": "Status", render: function (data, type, row) {
                    if (row.Status == 1) {
                        $status = 'active';
                        $status2 = '';
                        $checked = 'checked'
                        $checked2 = ''
                    } else {
                        $status = '';
                        $checked = '';
                        $status2 = 'active';
                        $checked2 = 'checked'
                    }

                    return '<div class="btn-group btn-group-toggle" data-toggle="buttons">' +
                        '<label class="btn btn-info ' + $status + '">' +
                        '<input ' + $checked +
                        ' type="radio"' +
                        ' name="options"' +
                        ' data-id="' + row.Id + '"' +
                        ' class="active-warehouse"' +
                        ' autocomplete="off">' +
                        ' Active' +
                        ' </label>' +

                        '<label class="btn btn-info ' + $status2 + '">' +
                        '<input ' + $checked2 +
                        ' type="radio"' +
                        ' name="options"' +
                        ' data-id="' + row.Id + '"' +
                        ' class="inactive-warehouse"' +
                        ' autocomplete="off">' +
                        ' Inactive' +
                        ' </label>' +
                        '</div>';
                }
            }],
        // bServerSide: true,
        ajax: {
            "url": "requests/warehouses-management.php",
            "type": "post",
            async: true,
            data: function (data) {
                var AdditionalValues = [city_id_global];
                data.AdditionalValues = AdditionalValues;
            }
        }
        // sAjaxSource: "requests/products_management.php"
    });

    var table_manufacturers = $('#table-manufacturers').DataTable({
        language: {
            processing: "Loading Data...",
            zeroRecords: "No matching records found"
        },
        processing: true,
        serverSide: true,
        orderCellsTop: true,
        autoWidth: true,
        deferRender: true,
        lengthMenu: [10, 25, 50, 100, 1000],
        // dom: '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6 text-right"l>><"row"<"col-sm-12"tr>><"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        // buttons: [
        //     {
        //         text: 'Export to Excel',
        //         className: 'btn btn-sm btn-dark',
        //         action: function (e, dt, node, config) {
        //             window.location.href = "/Home/GetExcel";
        //         },
        //         init: function (api, node, config) {
        //             $(node).removeClass('dt-button');
        //         }
        //     }
        // ],


        columns: [
            // {"DT_RowId": "drug-"+'Id'},
            {'data': 'Id'},
            {'data': 'Name'},
            {'data': 'Address'},
            {'data': 'Phones'},
            {'data': 'City'},
            {'data': 'Status'},
            {'data': 'Actions'}

        ],

        columnDefs: [{
            "targets": 6, "data": "Actions", render: function (data, type, row) {
                return '<button data-id="' + row.Id + '" class="btn btn-blue btn edit-man "><i\n' +
                    '                                        class="fa fa-pencil-square-o  "\n' +
                    '                                        aria-hidden="true"></i></button>\n' +
                    '                            <button data-id="' + row.Id + '" class="btn btn-blue btn delete-man"><i\n' +
                    '                                        class="fa fa-trash-o  "\n' +
                    '                                        aria-hidden="true"></i></button>';
            }
        },

            {
                "targets": 5, "data": "Status", render: function (data, type, row) {
                    if (row.Status == 1) {
                        $status = 'active';
                        $status2 = '';
                        $checked = 'checked'
                        $checked2 = ''
                    } else {
                        $status = '';
                        $checked = '';
                        $status2 = 'active';
                        $checked2 = 'checked'
                    }

                    return '<div class="btn-group btn-group-toggle" data-toggle="buttons">' +
                        '<label class="btn btn-info ' + $status + '">' +
                        '<input ' + $checked +
                        ' type="radio"' +
                        ' name="options"' +
                        ' data-id="' + row.Id + '"' +
                        ' class="active-man"' +
                        ' autocomplete="off">' +
                        ' Active' +
                        ' </label>' +

                        '<label class="btn btn-info ' + $status2 + '">' +
                        '<input ' + $checked2 +
                        ' type="radio"' +
                        ' name="options"' +
                        ' data-id="' + row.Id + '"' +
                        ' class="inactive-man"' +
                        ' autocomplete="off">' +
                        ' Inactive' +
                        ' </label>' +
                        '</div>';
                }
            }],
        // bServerSide: true,
        ajax: {
            "url": "requests/manufacturers-management.php",
            "type": "post",
            async: true,
            data: function (data) {

                var AdditionalValues = [city_id_global];
                data.AdditionalValues = AdditionalValues;

            }
        }
        // sAjaxSource: "requests/products_management.php"
    });

    var table_offers_admin = $('#table-offers-admin').DataTable({
        language: {
            processing: "Loading Data...",
            zeroRecords: "No matching records found"
        },
        processing: true,
        serverSide: true,
        orderCellsTop: true,
        autoWidth: true,
        deferRender: true,
        lengthMenu: [10, 25, 50, 100, 1000],
        // dom: '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6 text-right"l>><"row"<"col-sm-12"tr>><"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        // buttons: [
        //     {
        //         text: 'Export to Excel',
        //         className: 'btn btn-sm btn-dark',
        //         action: function (e, dt, node, config) {
        //             window.location.href = "/Home/GetExcel";
        //         },
        //         init: function (api, node, config) {
        //             $(node).removeClass('dt-button');
        //         }
        //     }
        // ],


        columns: [
            // {"DT_RowId": "drug-"+'Id'},
            {'data': 'Id'},
            {'data': 'Description'},
            {'data': 'Durg'},
            {'data': 'Quantity'},
            {'data': 'ExpiryDate'},
            {'data': 'Discount'},
            {'data': 'TotalPrice'},
            {'data': 'Actions'}

        ],

        columnDefs: [{
            "targets": 7, "data": "Actions", render: function (data, type, row) {
                return '<button data-id="' + row.Id + '" class="btn btn-blue btn edit-offer "><i\n' +
                    '                                        class="fa fa-pencil-square-o  "\n' +
                    '                                        aria-hidden="true"></i></button>\n' +
                    '                            <button data-id="' + row.Id + '" class="btn btn-blue btn delete-offer"><i\n' +
                    '                                        class="fa fa-trash-o  "\n' +
                    '                                        aria-hidden="true"></i></button>';
            }

        }],
        // bServerSide: true,
        ajax: {
            "url": "requests/offers-management.php",
            "type": "post",
            async: true,
            data: function (data) {


            }
        }
        // sAjaxSource: "requests/products_management.php"
    });

    var table_offers = $('#table-offers').DataTable({
        language: {
            processing: "Loading Data...",
            zeroRecords: "No matching records found"
        },
        processing: true,
        serverSide: true,
        orderCellsTop: true,
        autoWidth: true,
        deferRender: true,
        lengthMenu: [10, 25, 50, 100, 1000],
        // dom: '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6 text-right"l>><"row"<"col-sm-12"tr>><"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        // buttons: [
        //     {
        //         text: 'Export to Excel',
        //         className: 'btn btn-sm btn-dark',
        //         action: function (e, dt, node, config) {
        //             window.location.href = "/Home/GetExcel";
        //         },
        //         init: function (api, node, config) {
        //             $(node).removeClass('dt-button');
        //         }
        //     }
        // ],


        columns: [
            // {"DT_RowId": "drug-"+'Id'},
            {'data': 'Id'},
            {'data': 'Warehouse'},
            {'data': 'Description'},
            {'data': 'Durg'},
            {'data': 'Quantity'},
            {'data': 'ExpiryDate'},
            {'data': 'Discount'},
            {'data': 'TotalPrice'},
            {'data': 'Actions'}

        ],

        columnDefs: [{
            "targets": 8, "data": "Actions", render: function (data, type, row) {
                return '<button data-id="' + row.Id + '" class="btn btn-blue btn edit-offer "><i\n' +
                    '                                        class="fa fa-search-plus  "\n' +
                    '                                        aria-hidden="true"></i></button>\n';
            }

        }],
        // bServerSide: true,
        ajax: {
            "url": "requests/offers-management.php",
            "type": "post",
            async: true,
            data: function (data) {


            }
        }
        // sAjaxSource: "requests/products_management.php"
    });

    var table_categories = $('#table-categories').DataTable({
        language: {
            processing: "Loading Data...",
            zeroRecords: "No matching records found"
        },
        processing: true,
        serverSide: true,
        orderCellsTop: true,
        autoWidth: true,
        deferRender: true,
        lengthMenu: [10, 25, 50, 100, 1000],
        // dom: '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6 text-right"l>><"row"<"col-sm-12"tr>><"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        // buttons: [
        //     {
        //         text: 'Export to Excel',
        //         className: 'btn btn-sm btn-dark',
        //         action: function (e, dt, node, config) {
        //             window.location.href = "/Home/GetExcel";
        //         },
        //         init: function (api, node, config) {
        //             $(node).removeClass('dt-button');
        //         }
        //     }
        // ],


        columns: [
            // {"DT_RowId": "drug-"+'Id'},
            {'data': 'Id'},
            {'data': 'NameAr'},
            {'data': 'NameEn'},
            {'data': 'Status'},
            {'data': 'Actions'}

        ],

        columnDefs: [{
            "targets": 4, "data": "Actions", render: function (data, type, row) {
                return '<button data-id="' + row.Id + '" class="btn btn-blue btn delete-cat"><i\n' +
                    '                                        class="fa fa-trash-o  "\n' +
                    '                                        aria-hidden="true"></i></button>';
            }
        },

            {
                "targets": 3, "data": "Status", render: function (data, type, row) {
                    if (row.Status == 1) {
                        $status = 'active';
                        $status2 = '';
                        $checked = 'checked'
                        $checked2 = ''
                    } else {
                        $status = '';
                        $checked = '';
                        $status2 = 'active';
                        $checked2 = 'checked'
                    }

                    return '<div class="btn-group btn-group-toggle" data-toggle="buttons">' +
                        '<label class="btn btn-info ' + $status + '">' +
                        '<input ' + $checked +
                        ' type="radio"' +
                        ' name="options"' +
                        ' data-id="' + row.Id + '"' +
                        ' class="active-category"' +
                        ' autocomplete="off">' +
                        ' Active' +
                        ' </label>' +

                        '<label class="btn btn-info ' + $status2 + '">' +
                        '<input ' + $checked2 +
                        ' type="radio"' +
                        ' name="options"' +
                        ' data-id="' + row.Id + '"' +
                        ' class="inactive-category"' +
                        ' autocomplete="off">' +
                        ' Inactive' +
                        ' </label>' +
                        '</div>';
                }
            }],
        // bServerSide: true,
        ajax: {
            "url": "requests/categories-management.php",
            "type": "post",
            async: true,
            data: function (data) {

            }
        }
        // sAjaxSource: "requests/products_management.php"
    });

    var table_drugs = $('#table-drugs').DataTable({
        language: {
            processing: "Loading Data...",
            zeroRecords: "No matching records found"
        },
        processing: true,
        serverSide: true,
        orderCellsTop: true,
        autoWidth: true,
        deferRender: true,
        lengthMenu: [10, 25, 50, 100, 1000],
        // dom: '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6 text-right"l>><"row"<"col-sm-12"tr>><"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        // buttons: [
        //     {
        //         text: 'Export to Excel',
        //         className: 'btn btn-sm btn-dark',
        //         action: function (e, dt, node, config) {
        //             window.location.href = "/Home/GetExcel";
        //         },
        //         init: function (api, node, config) {
        //             $(node).removeClass('dt-button');
        //         }
        //     }
        // ],
        columns: [
            // {"DT_RowId": "drug-"+'Id'},
            {'data': 'Id'},
            {'data': 'CommerceNameAr'},
            {'data': 'CommerceNameEn'},
            {'data': 'ScientificNameAr'},
            {'data': 'ScientificNameEn'},
            {'data': 'Strengths'},
            {'data': 'Price'},
            {'data': 'Manufacture'},
            {'data': 'Category'},
            {'data': 'Form'},
            {
                'data': 'Icon', render: function (data, type, row) {
                    return '<img style="width: 100px; height:100px" src="' + siteFilesURL + 'images/drugs/large/' + row.Icon + '">';
                }
            },
            {'data': 'Actions'}

        ],

        columnDefs: [{
            "targets": 11, "data": "Actions", render: function (data, type, row) {
                return '<button data-id="' + row.Id + '" class="btn btn-blue btn edit-drug "><i\n' +
                    '                                        class="fa fa-pencil-square-o  "\n' +
                    '                                        aria-hidden="true"></i></button>\n' +
                    '                            <button data-id="' + row.Id + '" class="btn btn-blue btn delete-drug"><i\n' +
                    '                                        class="fa fa-trash-o  "\n' +
                    '                                        aria-hidden="true"></i></button>';
            }
        }],
        // bServerSide: true,
        ajax: {
            "url": "requests/drugs-management.php",
            "type": "post",
            async: true,
            data: {city_id: city_id_global}
        }
        // sAjaxSource: "requests/products_management.php"
    });

    var table_drugs_admin = $('#table-drugs-admin').DataTable({
        language: {
            processing: "Loading Data...",
            zeroRecords: "No matching records found"
        },
        processing: true,
        serverSide: true,
        orderCellsTop: true,
        autoWidth: true,
        deferRender: true,
        lengthMenu: [10, 25, 50, 100, 1000],
        // dom: '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6 text-right"l>><"row"<"col-sm-12"tr>><"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        // buttons: [
        //     {
        //         text: 'Export to Excel',
        //         className: 'btn btn-sm btn-dark',
        //         action: function (e, dt, node, config) {
        //             window.location.href = "/Home/GetExcel";
        //         },
        //         init: function (api, node, config) {
        //             $(node).removeClass('dt-button');
        //         }
        //     }
        // ],
        columns: [
            // {"DT_RowId": "drug-"+'Id'},
            {'data': 'Id'},
            {'data': 'CommerceNameAr'},
            {'data': 'CommerceNameEn'},
            {'data': 'ScientificNameAr'},
            {'data': 'ScientificNameEn'},
            {'data': 'Strengths'},
            {'data': 'Price'},
            {'data': 'Manufacture'},
            {'data': 'Category'},
            {'data': 'Form'},
            {
                'data': 'Icon', render: function (data, type, row) {
                    return '<img style="width: 100px; height:100px" src="' + siteFilesURL + 'images/drugs/large/' + row.Icon + '">';
                }
            },
            {'data': 'Actions'}

        ],

        columnDefs: [{
            "targets": 11, "data": "Actions", render: function (data, type, row) {
                if (row.AvaiableInWarehouse != 1) {
                    return '<button data-toggle="tooltip" data-placement="top" title="Add drug" data-name="' + row.CommerceNameEn + '"  data-id="' + row.Id + '" class="btn btn-blue btn link-drug-modal "><i\n' +
                        '                                        class="fa fa-plus-square-o  "\n' +
                        '                                        aria-hidden="true"></i></button>';
                } else return '<span class="badge badge-pill badge-primary">Added</span>';

            }
        }],
        // bServerSide: true,
        ajax: {
            "url": "requests/drugs-management.php",
            "type": "post",
            async: true,
            data: {city_id: city_id_global}
        }
        // sAjaxSource: "requests/products_management.php"
    });

    var table_my_drugs_admin = $('#table-my-drugs-admin').DataTable({
        language: {
            processing: "Loading Data...",
            zeroRecords: "No matching records found"
        },
        processing: true,
        serverSide: true,
        orderCellsTop: true,
        autoWidth: true,
        deferRender: true,
        lengthMenu: [10, 25, 50, 100, 1000],
        // dom: '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6 text-right"l>><"row"<"col-sm-12"tr>><"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        // buttons: [
        //     {
        //         text: 'Export to Excel',
        //         className: 'btn btn-sm btn-dark',
        //         action: function (e, dt, node, config) {
        //             window.location.href = "/Home/GetExcel";
        //         },
        //         init: function (api, node, config) {
        //             $(node).removeClass('dt-button');
        //         }
        //     }
        // ],
        columns: [
            // {"DT_RowId": "drug-"+'Id'},
            {'data': 'Id'},
            {'data': 'CommerceNameAr'},
            {'data': 'CommerceNameEn'},
            {'data': 'ScientificNameAr'},
            {'data': 'ScientificNameEn'},
            {'data': 'Strengths'},
            {'data': 'Price'},
            {'data': 'Manufacture'},
            {'data': 'Category'},
            {'data': 'Form'},
            {
                'data': 'Icon', render: function (data, type, row) {
                    return '<img style="width: 100px; height:100px" src="' + siteFilesURL + 'images/drugs/large/' + row.Icon + '">';
                }
            },
            {'data': 'Actions'}

        ],

        columnDefs: [{
            "targets": 11, "data": "Actions", render: function (data, type, row) {
                return '<button data-toggle="tooltip" data-placement="top" title="delete drug" data-name="' + row.CommerceNameEn + '"  data-id="' + row.Id + '" class="btn btn-blue btn unlink-drug-modal  "><i\n' +
                    '                                        class="fa fa-trash  "\n' +
                    '                                        aria-hidden="true"></i></button> ' +
                    '<button data-toggle="tooltip" data-placement="top" title="Add offer" data-name="' + row.CommerceNameEn + '" data-price="' + row.Price + '" data-id="' + row.Id + '" class="btn btn-blue btn add-offer-drug "><i\n' +
                    '                                        class="fa fa-plus-square-o  "\n' +
                    '                                        aria-hidden="true"></i></button>';
            }
        }],
        // bServerSide: true,
        ajax: {
            "url": "requests/drugs-admin-management.php",
            "type": "post",
            async: true,
            data: {city_id: city_id_global}
        }
        // sAjaxSource: "requests/products_management.php"
    });

    var table_pharmacies = $('#table-pharmacies').DataTable({
        language: {
            processing: "Loading Data...",
            zeroRecords: "No matching records found"
        },
        processing: true,
        serverSide: true,
        orderCellsTop: true,
        autoWidth: true,
        deferRender: true,
        lengthMenu: [10, 25, 50, 100, 1000],
        // dom: '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6 text-right"l>><"row"<"col-sm-12"tr>><"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        // buttons: [
        //     {
        //         text: 'Export to Excel',
        //         className: 'btn btn-sm btn-dark',
        //         action: function (e, dt, node, config) {
        //             window.location.href = "/Home/GetExcel";
        //         },
        //         init: function (api, node, config) {
        //             $(node).removeClass('dt-button');
        //         }
        //     }
        // ],


        columns: [

            {'data': 'Id'},
            {'data': 'PharmacyName'},
            {'data': 'PharmacistName'},
            {'data': 'LicenseNumber'},
            {'data': 'City'},
            {'data': 'Address'},
            {'data': 'Status'},
            {'data': 'Actions'},

        ],


        columnDefs: [{
            "targets": 7, "data": "Actions", render: function (data, type, row) {
                return '<button data-id="' + row.Id + '" class="btn btn-blue btn edit-pharmacy "><i\n' +
                    '                                        class="fa fa-pencil-square-o  "\n' +
                    '                                        aria-hidden="true"></i></button>\n' +
                    '                            <button data-id="' + row.Id + '" class="btn btn-blue btn delete-pharmacy"><i\n' +
                    '                                        class="fa fa-trash-o  "\n' +
                    '                                        aria-hidden="true"></i></button>';
            }
        },
            {
                "targets": 6, "data": "Status", render: function (data, type, row) {
                    if (row.Status === 0) {
                        return '<span class="badge badge-pill badge-danger">Rejected</span>';
                    } else if (row.Status === 1) {
                        return '<span class="badge badge-pill badge-success">Approved</span>';
                    } else if (row.Status === 2) {
                        return '<span class="badge badge-pill badge-warning">Pending</span>';
                    } else if (row.Status === 4) {
                        return '<span class="badge badge-pill badge-primary">Admin</span>';
                    }

                    return row.Status;
                }
            }],
        // bServerSide: true,
        ajax: {
            "url": "requests/pharmacies-management.php",
            "type": "post",
            async: true,
            data: function (data) {
                var AdditionalValues = [city_id_global];
                data.AdditionalValues = AdditionalValues;
            }
        }

    });

    var table_ads = $('#table-ads').DataTable({
        language: {
            processing: "Loading Data...",
            zeroRecords: "No matching records found"
        },
        processing: true,
        serverSide: true,
        orderCellsTop: true,
        autoWidth: true,
        deferRender: true,
        lengthMenu: [10, 25, 50, 100, 1000],
        // dom: '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6 text-right"l>><"row"<"col-sm-12"tr>><"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        // buttons: [
        //     {
        //         text: 'Export to Excel',
        //         className: 'btn btn-sm btn-dark',
        //         action: function (e, dt, node, config) {
        //             window.location.href = "/Home/GetExcel";
        //         },
        //         init: function (api, node, config) {
        //             $(node).removeClass('dt-button');
        //         }
        //     }
        // ],


        columns: [

            {'data': 'Id'},
            {'data': 'TypeName'},
            {'data': 'Name'},
            {'data': 'Actions'},

        ],


        columnDefs: [{
            "targets": 3, "data": "Actions", render: function (data, type, row) {
                return '<button data-id="' + row.Id + '" class="btn btn-blue btn delete-ad"><i\n' +
                    '                                        class="fa fa-trash-o  "\n' +
                    '                                        aria-hidden="true"></i></button>';
            }

        }],
        // bServerSide: true,
        ajax: {
            "url": "requests/ads-management.php",
            "type": "post",
            async: true,
            data: function (data) {

            }
        }

    });

    var table_orders = $('#table-orders').DataTable({
        language: {
            processing: "Loading Data...",
            zeroRecords: "No matching records found"
        },
        processing: true,
        serverSide: true,
        orderCellsTop: true,
        autoWidth: true,
        deferRender: true,
        lengthMenu: [10, 25, 50, 100, 1000],
        // dom: '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6 text-right"l>><"row"<"col-sm-12"tr>><"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        // buttons: [
        //     {
        //         text: 'Export to Excel',
        //         className: 'btn btn-sm btn-dark',
        //         action: function (e, dt, node, config) {
        //             window.location.href = "/Home/GetExcel";
        //         },
        //         init: function (api, node, config) {
        //             $(node).removeClass('dt-button');
        //         }
        //     }
        // ],


        columns: [

            {'data': 'Id'},
            {'data': 'Pharmacy'},
            {'data': 'Drug'},
            {'data': 'Quantity'},
            {'data': 'DeliveryDate'},
            {'data': 'City'},
            {
                'data': 'OfferDescription', render: function (data, type, row) {
                    return '<span class="order-offer-field" data-toggle="tooltip" data-placement="top" title="' + row.OfferDescription + '">' + row.OfferDescription + '</span>';

                }
            },
            {
                'data': 'RequestType', render: function (data, type, row) {
                    if (row.RequestType == 1) {
                        return ("Order");
                    } else {
                        return ("Offer");
                    }
                }
            },
            {'data': 'RequestStatus'},
            {'data': 'Actions'},

        ],


        columnDefs: [{
            "targets": 9, "data": "Actions", render: function (data, type, row) {
                if (row.RequestStatus == 1) {


                    return '<div class="btn-group btn-group-toggle" data-toggle="buttons">' +

                        '<label  class="btn btn-info order-status-btn ">' +
                        '<input type="radio"' +
                        ' name="options"' +
                        ' data-id="' + row.Id + '"' +
                        ' class="processing-order"' +
                        ' autocomplete="off">' +
                        ' Processing' +
                        ' </label>' +

                        '<label class="btn btn-info order-status-btn ">' +
                        '<input type="radio"' +
                        ' name="options"' +
                        ' data-id="' + row.Id + '"' +
                        ' class="done-order"' +
                        ' autocomplete="off">' +
                        ' Done' +
                        ' </label>' +

                        '<label class="btn btn-info order-status-btn ">' +
                        '<input type="radio"' +
                        ' name="options"' +
                        ' data-id="' + row.Id + '"' +
                        ' class="reject-order"' +
                        ' autocomplete="off">' +
                        ' Reject' +
                        ' </label>' +
                        '</div>';


                } else if (row.RequestStatus == 2) {
                    return '<div class="btn-group btn-group-toggle" data-toggle="buttons">' +

                        '<label class="btn btn-info order-status-btn ">' +
                        '<input type="radio"' +
                        ' name="options"' +
                        ' data-id="' + row.Id + '"' +
                        ' class="done-order"' +
                        ' autocomplete="off">' +
                        ' Done' +
                        ' </label>' +

                        '<label class="btn btn-info order-status-btn">' +
                        '<input type="radio"' +
                        ' name="options"' +
                        ' data-id="' + row.Id + '"' +
                        ' class="reject-order"' +
                        ' autocomplete="off">' +
                        ' Reject' +
                        ' </label>' +
                        '</div>';
                } else {
                    return "";
                }
            }


        }, {

            "targets": 8, "data": "RequestStatus", render: function (data, type, row) {

                if (row.RequestStatus === 4) {
                    return '<span class="badge badge-pill badge-danger">Rejected</span>';
                } else if (row.RequestStatus === 3) {
                    return '<span class="badge badge-pill badge-success">Done</span>';
                } else if (row.RequestStatus === 1) {
                    return '<span class="badge badge-pill badge-warning">Pending</span>';
                } else if (row.RequestStatus === 2) {
                    return '<span class="badge badge-pill badge-primary">Processing</span>';
                }


            }
        }],
        // bServerSide: true,
        ajax: {
            "url": "requests/orders-management.php",
            "type": "post",
            async: true,
            data: function (data) {
                var AdditionalValues = [city_id_global, order_status_id_global];
                data.AdditionalValues = AdditionalValues;
            }
        }

    });


    $(document).on('shown.bs.select', '#category-select', function () {


        document.getElementsByClassName("btn dropdown-toggle btn-light")[0].style.borderColor = "";
        $cat_id = $('#cat-id').val();
        $selected = '';
        $path = '';
        if ($cat_id !== '') {
            $selected = 'selected';
            $path = '../';
            $('#category-select').find('option').eq(0).replaceWith('<option  value="-1">' + lang.pleaseChoose + '</option>');
            $('#category-select').selectpicker('refresh');
        }

        if (select_clicked_cat == false) {

            $.ajax({
                method: "POST",
                url: $path + "requests/categories-management.php",
                data: {

                    action: 'show-list'
                }
            }).done(function (msg) {
                if (msg == -1)
                    $.notify(lang.general_error, {position: "left bottom", className: "error"});
                else {
                    console.log(msg)
                    jQuery(JSON.parse(msg)).each(function (i, item) {

                        $('#category-select').append('<option value="' + item.id + '">' + item.Name + '</option>');
                        $('#category-select').selectpicker('refresh');

                    });
                }

            });

            select_clicked_cat = true;
        }

    })

    $(document).on('shown.bs.select', '#manufacture-select', function () {


        document.getElementsByClassName("btn dropdown-toggle btn-light")[0].style.borderColor = "";
        $man_id = $('#man-id').val();
        $selected = '';
        $path = '';
        if ($man_id !== '') {
            $selected = 'selected';
            $path = '../';
            $('#manufacture-select').find('option').eq(0).replaceWith('<option  value="-1">' + lang.pleaseChoose + '</option>');
            $('#manufacture-select').selectpicker('refresh');
        }

        if (select_clicked_man == false) {
            $.ajax({
                method: "POST",
                url: $path + "requests/manufacturers-management.php",
                data: {
                    action: 'show-list'
                }
            }).done(function (msg) {
                if (msg == -1)
                    $.notify(lang.general_error, {position: "left bottom", className: "error"});
                else {
                    console.log(msg)
                    jQuery(JSON.parse(msg)).each(function (i, item) {

                        $('#manufacture-select').append('<option value="' + item.id + '">' + item.Name + '</option>');
                        $('#manufacture-select').selectpicker('refresh');

                    });
                }

            });

            select_clicked_man = true;
        }

    })

    $(document).on('shown.bs.select', '#drug-forms-select', function () {


        document.getElementsByClassName("btn dropdown-toggle btn-light")[0].style.borderColor = "";
        $form_id = $('#form-id').val();
        $selected = '';
        $path = '';
        if ($form_id !== '') {
            $selected = 'selected';
            $path = '../';
            $('#drug-forms-select').find('option').eq(0).replaceWith('<option  value="-1">' + lang.pleaseChoose + '</option>');
            $('#drug-forms-select').selectpicker('refresh');
        }

        if (select_clicked_form == false) {
            $.ajax({
                method: "POST",
                url: $path + "requests/drugs-management.php",
                data: {
                    action: 'show-list-forms'
                }
            }).done(function (msg) {
                if (msg == -1)
                    $.notify(lang.general_error, {position: "left bottom", className: "error"});
                else {
                    console.log(msg)
                    jQuery(JSON.parse(msg)).each(function (i, item) {

                        $('#drug-forms-select').append('<option value="' + item.id + '">' + item.Name + '</option>');
                        $('#drug-forms-select').selectpicker('refresh');

                    });
                }

            });

            select_clicked_form = true;
        }

    })

    $(document).on('shown.bs.select', '#city-select', function () {


        document.getElementsByClassName("btn dropdown-toggle btn-light")[0].style.borderColor = "";
        $city_id = $('#city-id').val();
        $selected = '';
        $path = '';
        if ($city_id !== '') {
            $selected = 'selected';
            $path = '../';
            $('#city-select').find('option').eq(0).replaceWith('<option  value="-1">' + lang.pleaseChoose + '</option>');
            $('#city-select').selectpicker('refresh');
        }

        if (select_clicked_city == false) {

            $.ajax({
                method: "POST",
                url: $path + "requests/cities-management.php",
                data: {

                    action: 'show-list'
                }
            }).done(function (msg) {
                if (msg == -1)
                    $.notify(lang.general_error, {position: "left bottom", className: "error"});
                else {
                    console.log(msg)
                    jQuery(JSON.parse(msg)).each(function (i, item) {

                        $('#city-select').append('<option value="' + item.id + '">' + item.Name + '</option>');
                        $('#city-select').selectpicker('refresh');

                    });
                }

            });

            select_clicked_city = true;
        }

    })

    $(document).on('shown.bs.select', '#type-select', function () {
        select_clicked_man = false;
        select_clicked_offer = false;
        select_clicked_warehouse = false;
        document.getElementsByClassName("btn dropdown-toggle btn-light")[0].style.borderColor = "";
        $type_id = $('#type-id').val();
        $selected = '';
        $path = '';
        if ($type_id !== '') {
            $selected = 'selected';
            $path = '../';
            $('#type-select').find('option').eq(0).replaceWith('<option  value="-1">' + lang.pleaseChoose + '</option>');
            $('#type-select').selectpicker('refresh');
        }

        if (select_clicked_type == false) {

            $.ajax({
                method: "POST",
                url: $path + "requests/ads-management.php",
                data: {

                    action: 'show-list-types'
                }
            }).done(function (msg) {
                if (msg == -1)
                    $.notify(lang.general_error, {position: "left bottom", className: "error"});
                else {
                    console.log(msg)
                    jQuery(JSON.parse(msg)).each(function (i, item) {

                        $('#type-select').append('<option value="' + item.id + '">' + item.Name + '</option>');
                        $('#type-select').selectpicker('refresh');

                    });
                }

            });

            select_clicked_type = true;
        }

    })

    $(document).on('shown.bs.select', '#delivery-select', function () {

        document.getElementsByClassName("btn dropdown-toggle btn-light")[0].style.borderColor = "";
        $selected = $('#delivery-select').val()

        $('#delivery-select').empty();
        $('#delivery-select').append('<option value="' + -1 + '">' + 'Please choose' + '</option>');
        if ($selected == 0) {
            $('#delivery-select').append('<option selected value="' + 0 + '">' + 'No' + '</option>');
            $('#delivery-select').append('<option value="' + 1 + '">' + 'Yes' + '</option>');
        } else if ($selected == 1) {
            $('#delivery-select').append('<option  value="' + 0 + '">' + 'No' + '</option>');
            $('#delivery-select').append('<option selected value="' + 1 + '">' + 'Yes' + '</option>');
        } else {
            $('#delivery-select').append('<option  value="' + 0 + '">' + 'No' + '</option>');
            $('#delivery-select').append('<option  value="' + 1 + '">' + 'Yes' + '</option>');
        }


        $('#delivery-select').selectpicker('refresh');


    })

    $(document).on('shown.bs.select', '#SubscriptionType-select', function () {

        document.getElementsByClassName("btn dropdown-toggle btn-light")[0].style.borderColor = "";
        $selected = $('#SubscriptionType-select').val()

        $('#SubscriptionType-select').empty();
        $('#SubscriptionType-select').append('<option value="' + -1 + '">' + 'Please choose' + '</option>');
        if ($selected == 1) {
            $('#SubscriptionType-select').append('<option selected value="' + 1 + '">' + 'Commission' + '</option>');
            $('#SubscriptionType-select').append('<option value="' + 2 + '">' + 'Subscription' + '</option>');
        } else if ($selected == 2) {
            $('#SubscriptionType-select').append('<option  value="' + 1 + '">' + 'Commission' + '</option>');
            $('#SubscriptionType-select').append('<option selected value="' + 2 + '">' + 'Subscription' + '</option>');
        } else {
            $('#SubscriptionType-select').append('<option  value="' + 1 + '">' + 'Commission' + '</option>');
            $('#SubscriptionType-select').append('<option  value="' + 2 + '">' + 'Subscription' + '</option>');
        }


        $('#SubscriptionType-select').selectpicker('refresh');


    })

    $(document).on('shown.bs.select', '#offer-select', function () {


        document.getElementsByClassName("btn dropdown-toggle btn-light")[0].style.borderColor = "";
        $offer_id = $('#offer-id').val();
        $selected = '';
        $path = '';
        if ($offer_id !== '') {
            $selected = 'selected';
            $path = '../';
            $('#offer-select').find('option').eq(0).replaceWith('<option  value="-1">' + lang.pleaseChoose + '</option>');
            $('#offer-select').selectpicker('refresh');
        }

        if (select_clicked_offer == false) {

            $.ajax({
                method: "POST",
                url: $path + "requests/offers-management.php",
                data: {

                    action: 'show-list-offer'
                }
            }).done(function (msg) {
                if (msg == -1)
                    $.notify(lang.general_error, {position: "left bottom", className: "error"});
                else {
                    console.log(msg)
                    jQuery(JSON.parse(msg)).each(function (i, item) {

                        $('#offer-select').append('<option value="' + item.id + '">' + item.Name + '</option>');
                        $('#offer-select').selectpicker('refresh');

                    });
                }

            });

            select_clicked_offer = true;
        }

    })

    $(document).on('shown.bs.select', '#warehouse-select', function () {


        document.getElementsByClassName("btn dropdown-toggle btn-light")[0].style.borderColor = "";
        $warehouse_id = $('#warehouse-id').val();
        $selected = '';
        $path = '';
        if ($warehouse_id !== '') {
            $selected = 'selected';
            $path = '../';
            $('#warehouse-select').find('option').eq(0).replaceWith('<option  value="-1">' + lang.pleaseChoose + '</option>');
            $('#warehouse-select').selectpicker('refresh');
        }

        if (select_clicked_warehouse == false) {

            $.ajax({
                method: "POST",
                url: $path + "requests/warehouses-management.php",
                data: {

                    action: 'show-list-warehouse'
                }
            }).done(function (msg) {
                if (msg == -1)
                    $.notify(lang.general_error, {position: "left bottom", className: "error"});
                else {
                    console.log(msg)
                    jQuery(JSON.parse(msg)).each(function (i, item) {

                        $('#warehouse-select').append('<option value="' + item.id + '">' + item.Name + '</option>');
                        $('#warehouse-select').selectpicker('refresh');

                    });
                }

            });

            select_clicked_warehouse = true;
        }

    })

    $(document).on('changed.bs.select', '#city-select', function () {


        city_id_global = $(this).val();
        // localStorage.setItem('city_id',city_id_global)
        table_manufacturers.draw()
        table_pharmacies.draw()
        table_warehouses.draw()
        table_orders.draw()
        // $('#table-manufacturers').DataTable().ajax.reload();
        // localStorage.setItem('city_id',"")
        // table_categories.reload()
        // table_drugs.reload()
        // table_pharmacies.reload()


    })

    $(document).on('changed.bs.select', '#status-select', function () {


        order_status_id_global = $(this).val();
        // localStorage.setItem('city_id',city_id_global)

        table_orders.draw()
        // $('#table-manufacturers').DataTable().ajax.reload();
        // localStorage.setItem('city_id',"")
        // table_categories.reload()
        // table_drugs.reload()
        // table_pharmacies.reload()


    })

    $(document).on('changed.bs.select', '#type-select', function () {

        $('#warehouse-select').selectpicker('refresh');
        $('#offer-select').selectpicker('refresh');
        $('#manufacture-select').selectpicker('refresh');

        var $type = $(this).val();
        if ($type == 1) {
            $('.manufacturer-select-cont').removeClass('hidden')
            $('.offers-select-cont').addClass('hidden')
            $('.warehouse-select-cont').addClass('hidden')


        } else if ($type == 2) {

            $('.manufacturer-select-cont').addClass('hidden')
            $('.offers-select-cont').removeClass('hidden')
            $('.warehouse-select-cont').addClass('hidden')
        } else {

            $('.manufacturer-select-cont').addClass('hidden')
            $('.offers-select-cont').addClass('hidden')
            $('.warehouse-select-cont').removeClass('hidden')
        }


    })

    $(document).on('changed.bs.select', '#SubscriptionType-select', function () {

        $('#profit-warehouse').val('');


        var $type = $(this).val();

        if ($type == 1 || $type == 2) {

            $('#profit-cont').removeClass('hidden')
        } else {
            $('#profit-cont').addClass('hidden')
        }

    })

    if ($('#change-password').val() == 1) {


        $('#change-password-modal').modal({show: true})

    }


    if ($('#error-msg').val() !== '') {
        $.notify($('#error-msg').val(), {position: "left bottom", className: $('#error-msg').data('type')});


    }


})


