var siteURL = '/saydaliti/';
var siteFilesURL = siteURL + 'files/';
var city_id_global = $('#city-select').val();

var order_status_id_global = $('#status-select').val();
var warehouse_from_date_global = $('#warehouse-form-date').val();
var warehouse_to_date_global = $('#warehouse-to-date').val();
var warehouse_id_global = $('#warehouse-select').val();

var man_id_global = $('#manufacture-select').val();
var drug_form_id_global = $('#drug-forms-select').val();
var cat_id_global = $('#category-select').val();
var warehouse_type_id_global = $('#SubscriptionType-select').val();


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
        Loading()
        $.ajax({
            method: "POST",
            url: "requests/drugs-management.php",
            data: {
                drug_id: $drug_id,
                delete: 'delete',
            }
        }).done(function (msg) {
            unLoading()
            if (msg == 1) {
                $("button[data-id=" + $drug_id + "]").parent().parent().fadeOut(500, function () {

                    $(this).remove();

                })

                $.notify(lang.successfully_done, {position: "top center", className: "success"});
            } else if (msg == -1) {
                $.notify(lang.general_error, {position: "top center", className: "error"});
            } else
                $.notify('Can not delete drug ' + msg, {position: "top center", className: "error"});

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
    //             $.notify(lang.successfully_done, {position: "top center", className: "success"});
    //         else
    //             $.notify(lang.general_error, {position: "top center", className: "error"});
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
        Loading()
        $.ajax({
            method: "POST",
            url: "requests/categories-management.php",
            data: {
                cat_id: $(this).data('id'),
                action: 'change-status',
                status: 1,
            }
        }).done(function (msg) {
            unLoading()
            if (msg == 1)
                $.notify(lang.successfully_done, {position: "top center", className: "success"});
            else
                $.notify(lang.general_error, {position: "top center", className: "error"});


        })


    })

    $(document).on('change', '.inactive-category', function () {
        // $('#confirm-modal-cat-status').modal({show: true})
        // localStorage.setItem('cat_status', '0');
        // localStorage.setItem('cat_id', $(this).data('id'));
        Loading()
        $.ajax({
            method: "POST",
            url: "requests/categories-management.php",
            data: {
                cat_id: $(this).data('id'),
                action: 'change-status',
                status: 0,
            }
        }).done(function (msg) {
            unLoading()
            if (msg == 1)
                $.notify(lang.successfully_done, {position: "top center", className: "success"});
            else
                $.notify(lang.general_error, {position: "top center", className: "error"});


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
    //             $.notify(lang.successfully_done, {position: "top center", className: "success"});
    //         else
    //             $.notify(lang.general_error, {position: "top center", className: "error"});
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
        Loading()
        $.ajax({
            method: "POST",
            url: "requests/categories-management.php",
            data: {
                cat_id: $cat_id,
                action: 'delete',
            }
        }).done(function (msg) {
            unLoading()
            if (msg == 1) {
                $("button[data-id=" + $cat_id + "]").parent().parent().fadeOut(500, function () {

                    $(this).remove();

                })
                $.notify(lang.successfully_done, {position: "top center", className: "success"});
            } else {
                $.notify(lang.canNotDeleteCat, {position: "top center", className: "error"});
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
        Loading()
        $.ajax({
            method: "POST",
            url: "requests/manufacturers-management.php",
            data: {
                man_id: $(this).data('id'),
                action: 'change-status',
                status: 1,
            }
        }).done(function (msg) {
            unLoading()
            if (msg == 1)
                $.notify(lang.successfully_done, {position: "top center", className: "success"});
            else
                $.notify(lang.general_error, {position: "top center", className: "error"});


        })


    })

    $(document).on('change', '.inactive-man', function () {
        // $('#confirm-modal-cat-status').modal({show: true})
        // localStorage.setItem('cat_status', '0');
        // localStorage.setItem('cat_id', $(this).data('id'));
        Loading()
        $.ajax({
            method: "POST",
            url: "requests/manufacturers-management.php",
            data: {
                man_id: $(this).data('id'),
                action: 'change-status',
                status: 0,
            }
        }).done(function (msg) {
            unLoading()
            if (msg == 1)
                $.notify(lang.successfully_done, {position: "top center", className: "success"});
            else
                $.notify(lang.general_error, {position: "top center", className: "error"});


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
    //             $.notify(lang.successfully_done, {position: "top center", className: "success"});
    //         else
    //             $.notify(lang.general_error, {position: "top center", className: "error"});
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
        Loading()
        $.ajax({
            method: "POST",
            url: "requests/manufacturers-management.php",
            data: {
                man_id: $man_id,
                action: 'delete',
            }
        }).done(function (msg) {
            unLoading()
            if (msg == 1) {
                $("button[data-id=" + $man_id + "]").parent().parent().fadeOut(500, function () {

                    $(this).remove();

                })
                $.notify(lang.successfully_done, {position: "top center", className: "success"});
            } else {
                $.notify(lang.canNotDeleteCat, {position: "top center", className: "error"});
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

        Loading()
        $.ajax({
            method: "POST",
            url: "../requests/pharmacies-management.php",
            data: {
                pharmacy_id: $pharmacy_id,
                action: 'change-status',
                status: 1,
            }
        }).done(function (msg) {
            unLoading()
            if (msg == 1)

                window.location.href = siteURL + "pharmacy-form/" + $pharmacy_id;
            else
                $.notify(lang.general_error, {position: "top center", className: "error"});


        })


    })

    $(document).on('click', '#yes-reject-pharmacy', function () {

        $pharmacy_id = localStorage.getItem('pharmacy_id');
        Loading()
        $.ajax({
            method: "POST",
            url: "../requests/pharmacies-management.php",
            data: {
                pharmacy_id: $pharmacy_id,
                action: 'change-status',
                status: 0,
            }
        }).done(function (msg) {
            unLoading()
            if (msg == 1)
                window.location.href = siteURL + "pharmacy-form/" + $pharmacy_id;
            else
                $.notify(lang.general_error, {position: "top center", className: "error"});


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
        Loading()
        $.ajax({
            method: "POST",
            url: "requests/pharmacies-management.php",
            data: {
                pharmacy_id: $pharmacy_id,
                delete: 'delete',
            }
        }).done(function (msg) {
            unLoading()
            if (msg == 1) {
                $("button[data-id=" + $pharmacy_id + "]").parent().parent().fadeOut(500, function () {

                    $(this).remove();

                })

                $.notify(lang.successfully_done, {position: "top center", className: "success"});
            } else if (msg == -1) {
                $.notify(lang.general_error, {position: "top center", className: "error"});
            } else
                $.notify('Can not delete drug ' + msg, {position: "top center", className: "error"});

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
        Loading()
        $.ajax({
            method: "POST",
            url: "requests/warehouses-management.php",
            data: {
                warehouse_id: $(this).data('id'),
                action: 'change-status',
                status: 1,
            }
        }).done(function (msg) {
            unLoading()
            if (msg == 1)
                $.notify(lang.successfully_done, {position: "top center", className: "success"});
            else
                $.notify(lang.general_error, {position: "top center", className: "error"});


        })


    })

    $(document).on('change', '.inactive-warehouse', function () {

        // $('#confirm-modal-cat-status').modal({show: true})
        // localStorage.setItem('cat_status', '0');
        // localStorage.setItem('cat_id', $(this).data('id'));
        Loading()
        $.ajax({
            method: "POST",
            url: "requests/warehouses-management.php",
            data: {
                warehouse_id: $(this).data('id'),
                action: 'change-status',
                status: 0,
            }
        }).done(function (msg) {
            unLoading()
            if (msg == 1)
                $.notify(lang.successfully_done, {position: "top center", className: "success"});
            else
                $.notify(lang.general_error, {position: "top center", className: "error"});


        })

    })


    $(document).on('click', '.delete-warehouse', function () {

        $('#confirm-modal-delete-warehouse').modal({show: true})

        localStorage.setItem('warehouse_id', $(this).data('id'))

    })

    $('#yes-delete-warehouse').click(function () {
        $warehouse_id = localStorage.getItem('warehouse_id');
        // $selector = '#category-' + $cat_id;
        Loading()
        $.ajax({
            method: "POST",
            url: "requests/warehouses-management.php",
            data: {
                warehouse_id: $warehouse_id,
                action: 'delete',
            }
        }).done(function (msg) {
            unLoading()
            if (msg == 1) {
                $("button[data-id=" + $warehouse_id + "]").parent().parent().fadeOut(500, function () {

                    $(this).remove();

                })
                $.notify(lang.successfully_done, {position: "top center", className: "success"});
            } else {
                $.notify(lang.canNotDeleteCat, {position: "top center", className: "error"});
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

    $(document).on('click', '.link-offer', function () {

        $('#confirm-modal-link-offer').modal({show: true})

        localStorage.setItem('offer_ad_id', $(this).data('id'))

    })

    $(document).on('click', '.link-man', function () {

        $('#confirm-modal-link-man').modal({show: true})

        localStorage.setItem('man_ad_id', $(this).data('id'))

    })

    $(document).on('click', '.link-warehouse', function () {

        $('#confirm-modal-link-warehouse').modal({show: true})

        localStorage.setItem('warehouse_ad_id', $(this).data('id'))

    })

    $('#yes-add-ad').click(function () {

        var type = $('#item-type').val()

        if (type == 1) {
            $item_id = localStorage.getItem('man_ad_id');
        } else if (type == 2) {
            $item_id = localStorage.getItem('offer_ad_id');
        } else {
            $item_id = localStorage.getItem('warehouse_ad_id');
        }

        // $selector = '#category-' + $cat_id;
        Loading()
        $.ajax({
            method: "POST",
            url: "requests/ads-management.php",
            data: {
                type: type,
                item_id: $item_id,
                action: 'add-to-ads',
            }
        }).done(function (msg) {
            unLoading()
            if (msg == 1) {

                $.notify(lang.successfully_done, {position: "top center", className: "success"});
            } else {
                $.notify(msg, {position: "top center", className: "error"});
            }

        })

    })

    $('#yes-delete-ad').click(function () {
        $ad_id = localStorage.getItem('ad_id');
        // $selector = '#category-' + $cat_id;
        Loading()
        $.ajax({
            method: "POST",
            url: "requests/ads-management.php",
            data: {
                ad_id: $ad_id,
                action: 'delete',
            }
        }).done(function (msg) {
            unLoading()
            if (msg == 1) {
                $("button[data-id=" + $ad_id + "]").parent().parent().fadeOut(500, function () {

                    $(this).remove();

                })
                $.notify(lang.successfully_done, {position: "top center", className: "success"});
            } else {
                $.notify(lang.canNotDeleteCat, {position: "top center", className: "error"});
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
        Loading()
        $.ajax({
            method: "POST",
            url: "requests/orders-management.php",
            data: {
                order_id: $(this).data('id'),
                action: 'change-status',
                status: 2,
            }
        }).done(function (msg) {
            unLoading()
            if (msg == 1)
                $.notify(lang.successfully_done, {position: "top center", className: "success"});
            else
                $.notify(lang.general_error, {position: "top center", className: "error"});


        })


    })
    $(document).on('change', '.done-order', function () {
// alert()
        // $('#confirm-modal-cat-status').modal({show: true})
        // localStorage.setItem('cat_status', '1');
        // localStorage.setItem('cat_id', $(this).data('id'));
        Loading()
        $.ajax({
            method: "POST",
            url: "requests/orders-management.php",
            data: {
                order_id: $(this).data('id'),
                action: 'change-status',
                status: 3,
            }
        }).done(function (msg) {
            unLoading()
            if (msg == 1)
                $.notify(lang.successfully_done, {position: "top center", className: "success"});
            else
                $.notify(lang.general_error, {position: "top center", className: "error"});


        })


    })
    $(document).on('change', '.reject-order', function () {
// alert()
        // $('#confirm-modal-cat-status').modal({show: true})
        // localStorage.setItem('cat_status', '1');
        // localStorage.setItem('cat_id', $(this).data('id'));
        Loading()
        $.ajax({
            method: "POST",
            url: "requests/orders-management.php",
            data: {
                order_id: $(this).data('id'),
                action: 'change-status',
                status: 4,
            }
        }).done(function (msg) {
            unLoading()
            if (msg == 1)
                $.notify(lang.successfully_done, {position: "top center", className: "success"});
            else
                $.notify(lang.general_error, {position: "top center", className: "error"});

        })


    })

    $(document).on('click', '#calculate-profits', function () {

        let from = $('#warehouse-from-date').val();
        let to = $('#warehouse-to-date').val();
        let id_ware = $('#warehouse-select').val();

        console.log(id_ware)

        if (id_ware === "-1") {

            console.log('hahaha')

            $('.bootstrap-select > select#warehouse-select').parent().addClass('select-danger')

        }
        if (from === "") {

            $('#warehouse-from-date').addClass('date-danger')
        }
        if (to === "") {
            $('#warehouse-to-date').addClass('date-danger')

        } else {
            Loading()
            $.ajax({
                method: "POST",
                url: "requests/orders-management.php",
                data: {
                    order_id: $(this).data('id'),
                    action: 'calculate-profits',
                    from_date: from,
                    to_date: to,
                    warehouse_id: id_ware,
                }
            }).done(function (msg) {
                unLoading()
                var res = JSON.parse(msg)

                if (res.code == 1) {
                    $('#profits-response').text(res.data)

                    $('#profits-modal').modal({show: true})
                } else
                    $.notify(res.message, {position: "top center", className: "error"});

            })
        }


    });

    $(document).on('click', '.order-details', function () {


        id_order = $(this).data('id');
        $('#table-body-order-details').empty();
        Loading()
        $.ajax({
            method: "POST",
            url: "requests/orders-management.php",
            data: {
                order_id: id_order,
                action: 'order-details',
            }
        }).done(function (msg) {

            // // console.log(msg)
            unLoading()
            var res = JSON.parse(msg)
            if (res.code == 1) {


                jQuery(res.data).each(function (i, item) {

                    $('#table-body-order-details').append(
                        '<tr><td>' + item.Drug + '</td>' +
                        '<td>' + item.Quantity + '</td>' +
                        '<td>' + item.Price + '</td>' +
                        '<td class="offer-details-text" data-toggle="tooltip" data-placement="top" title="' + item.OfferDescription + '">' + item.OfferDescription + '</td></tr>'
                    )
                })

                $('#order-modal').modal({show: true})

            } else
                $.notify(res.message, {position: "top center", className: "error"});

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
        Loading()
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
            unLoading()
            $('#warehouse-admin-link-drug-modal').modal('hide');


            if (msg == 1) {
                $("button[data-id=" + $id + "]").fadeOut(500, function () {

                    $(this).replaceWith('<span class="badge badge-pill badge-primary">Added</span>');

                })

                $.notify(lang.successfully_done, {position: "top center", className: "success"});
            } else
                $.notify(msg, {position: "top center", className: "error"});

        })


    })

    $('#yes-unlink-drug').click(function () {

        $drug_id = localStorage.getItem('admin_drug_id');
        // $selector = '#drug-' + $drug_id;
        Loading()
        $.ajax({
            method: "POST",
            url: "requests/drugs-admin-management.php",
            data: {
                drug_id: $drug_id,
                action: 'delete',
            }
        }).done(function (msg) {
            unLoading()
            if (msg == 1) {
                $("button[data-id=" + $drug_id + "]").parent().parent().fadeOut(500, function () {

                    $(this).remove();

                })

                $.notify(lang.successfully_done, {position: "top center", className: "success"});

            } else
                $.notify(msg, {position: "top center", className: "error"});

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
        window.location.href = siteURL + "offer-form/" + 'D' + $id;

    })

    $drug_offer_name = localStorage.getItem('drug_offer_name')
    $drug_offer_price = localStorage.getItem('drug_offer_price')

    if ($drug_offer_name != null && $drug_offer_price != null) {
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
        Loading()
        $.ajax({
            method: "POST",
            url: "requests/offers-management.php",
            data: {
                offer_id: $offer_id,
                action: 'delete-offer',
            }
        }).done(function (msg) {
            unLoading()
            if (msg == 1) {
                $("button[data-id=" + $offer_id + "]").parent().parent().fadeOut(500, function () {

                    $(this).remove();

                })
                $.notify(lang.successfully_done, {position: "top center", className: "success"});
            } else {
                $.notify(lang.canNotDeleteCat, {position: "top center", className: "error"});
            }

        })

    })


    var table_warehouses = $('#table-warehouses').DataTable({
        language: {
            processing: "Loading Data...",
            zeroRecords: "No matching records found"
        },
        "scrollX": true,
        processing: true,
        serverSide: true,
        pageLength:50,
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
            // {'data': 'Id'},
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
            "targets": 8, "data": "Actions", render: function (data, type, row) {
                return '<div class="row "><div class="col mb-1"><button data-id="' + row.Id + '" class="btn btn-blue btn-blue-table btn edit-warehouse "><i\n' +
                    '                                        class="fa fa-pencil-square-o  "\n' +
                    '                                        aria-hidden="true"></i></button></div>\n' +
                    '                            <div class="col mb-1"><button data-id="' + row.Id + '" class="btn btn-blue btn-blue-table btn delete-warehouse"><i\n' +
                    '                                        class="fa fa-trash-o  "\n' +
                    '                                        aria-hidden="true"></i></button></div> ' +
                    '<div class="col "><button  data-toggle="tooltip" data-placement="top" title="Add to Advertisements" data-id="' + row.Id + '" class="btn btn-blue btn-blue-table btn link-warehouse "><i\n' +
                    '                                        class="fa fa-plus-square-o  "\n' +
                    '                                        aria-hidden="true"></i></button></div></div>\n';
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
        "scrollX": true,
        processing: true,
        serverSide: true,
        pageLength:50,
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
            // {'data': 'Id'},
            {
                'data': 'Icon', render: function (data, type, row) {
                    return '<img style="width: 100px; height:100px" src="' + siteFilesURL + 'images/manufacturers/large/' + row.Icon + '">';
                }
            },
            {'data': 'Name'},

            // {'data': 'Phones'},
            {'data': 'City'},
            {'data': 'Address'},
            {'data': 'Status'},

            {'data': 'Actions'}

        ],

        columnDefs: [{
            "targets": 5, "data": "Actions", render: function (data, type, row) {
                return '<div class="row"><div class="col mb-1"><button data-id="' + row.Id + '" class="btn btn-blue btn-blue-table btn edit-man "><i\n' +
                    '                                        class="fa fa-pencil-square-o  "\n' +
                    '                                        aria-hidden="true"></i></button></div>\n' +
                    '                            <div class="col mb-1"><button data-id="' + row.Id + '" class="btn btn-blue btn-blue-table btn delete-man"><i\n' +
                    '                                        class="fa fa-trash-o  "\n' +
                    '                                        aria-hidden="true"></i></button></div> ' +
                    '<div class="col "><button  data-toggle="tooltip" data-placement="top" title="Add to Advertisements" data-id="' + row.Id + '" class="btn btn-blue btn-blue-table btn link-man "><i\n' +
                    '                                        class="fa fa-plus-square-o  "\n' +
                    '                                        aria-hidden="true"></i></button></div></div>\n';
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
        "scrollX": true,
        processing: true,
        serverSide: true,
        pageLength:50,
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
            // {'data': 'Id'},
            // {
            //     'data': 'Description', render: function (data, type, row) {
            //         return '<span class="drug-field" data-toggle="tooltip" data-placement="top" title="' + row.Description + '">' + row.Description + '</span>';
            //     }
            // },
            // {'data': 'Manufacturer'},
            {'data': 'Durg'},
            {'data': 'Price'},
            {'data': 'NormalPrice'},
            {'data': 'Quantity'},
            {
                'data': 'Gift', render: function (data, type, row) {
                    return '<span class="drug-field" data-toggle="tooltip" data-placement="top" title="' + row.Gift + '">' + row.Gift + '</span>';
                }
            },
            // {'data': 'ExpiryDate'},
            {'data': 'Discount'},
            {'data': 'TotalPrice'},
            {'data': 'Actions'}

        ],

        columnDefs: [{
            "targets": 7, "data": "Actions", render: function (data, type, row) {
                return '<div class="row "><div class="col mb-1"><button data-id="' + row.Id + '" class="btn btn-blue btn-blue-table btn edit-offer "><i\n' +
                    '                                        class="fa fa-pencil-square-o  "\n' +
                    '                                        aria-hidden="true"></i></button></div>\n' +
                    '                           <div class="col "> <button data-id="' + row.Id + '" class="btn btn-blue btn-blue-table btn delete-offer"><i\n' +
                    '                                        class="fa fa-trash-o  "\n' +
                    '                                        aria-hidden="true"></i></button></div></div>';
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
        "scrollX": true,
        processing: true,
        serverSide: true,
        pageLength:50,
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
            // {'data': 'Id'},
            {'data': 'Warehouse'},
            // {
            //     'data': 'Description', render: function (data, type, row) {
            //         return '<span class="drug-field" data-toggle="tooltip" data-placement="top" title="' + row.Description + '">' + row.Description + '</span>';
            //     }
            // },
            // {'data': 'Manufacturer'},
            {'data': 'Durg'},
            {'data': 'Price'},
            {'data': 'NormalPrice'},
            {'data': 'Quantity'},
            {
                'data': 'Gift', render: function (data, type, row) {
                    return '<span class="drug-field" data-toggle="tooltip" data-placement="top" title="' + row.Gift + '">' + row.Gift + '</span>';
                }
            },
            // {'data': 'ExpiryDate'},
            {'data': 'Discount'},
            {'data': 'TotalPrice'},
            {'data': 'Actions'}

        ],

        columnDefs: [{
            "targets": 8, "data": "Actions", render: function (data, type, row) {
                return '<div class="row "><div class="col mb-1"><button data-id="' + row.Id + '" class="btn btn-blue btn-blue-table btn edit-offer "><i\n' +
                    '                                        class="fa fa-search-plus  "\n' +
                    '                                        aria-hidden="true"></i></button></div>\n' +
                    '<div class="col "><button  data-toggle="tooltip" data-placement="top" title="Add to Advertisements" data-id="' + row.Id + '" class="btn btn-blue btn-blue-table btn link-offer "><i\n' +
                    '                                        class="fa fa-plus-square-o  "\n' +
                    '                                        aria-hidden="true"></i></button></div></div>\n';
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
        "scrollX": true,
        processing: true,
        serverSide: true,
        pageLength:50,
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
            // {'data': 'Id'},
            {'data': 'NameAr'},
            {'data': 'NameEn'},
            {'data': 'Status'},
            {'data': 'Actions'}

        ],

        columnDefs: [{
            "targets": 3, "data": "Actions", render: function (data, type, row) {
                return '<button data-id="' + row.Id + '" class="btn btn-blue btn-blue-table btn delete-cat"><i\n' +
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
        "scrollX": true,
        // responsive: true,
        processing: true,
        pageLength:50,
        serverSide: true,
        pageLength:50,
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
            // {'data': 'Id'},
            // {'data': 'CommerceNameAr'},
            {'data': 'CommerceNameEn'},
            // {
            //     'data': 'ScientificNameAr', render: function (data, type, row) {
            //         return '<span class="drug-field" data-toggle="tooltip" data-placement="top" title="' + row.ScientificNameAr + '">' + row.ScientificNameAr + '</span>';
            //     }
            // },
            {
                'data': 'ScientificNameEn', render: function (data, type, row) {
                    return '<span class="drug-field" data-toggle="tooltip" data-placement="top" title="' + row.ScientificNameEn + '">' + row.ScientificNameEn + '</span>';
                }
            },
            {'data': 'Manufacture'},
            {'data': 'Strengths'},
            // {'data': 'Price'},

            {
                'data': 'Category', render: function (data, type, row) {
                    return '<span class="drug-field" data-toggle="tooltip" data-placement="top" title="' + row.Category + '">' + row.Category + '</span>';
                }
            },
            {'data': 'Form'},
            // {
            //     'data': 'Icon', render: function (data, type, row) {
            //         return '<img style="width: 100px; height:100px" src="' + siteFilesURL + 'images/drugs/large/' + row.Icon + '">';
            //     }
            // },
            {'data': 'Actions'}

        ],

        columnDefs: [
            {
                "targets": 6, "data": "Actions", render: function (data, type, row) {
                    return '<div class="row"><div class="col mb-1"><button data-id="' + row.Id + '" class="btn btn-blue btn-blue-table btn edit-drug "><i\n' +
                        '                                        class="fa fa-pencil-square-o  "\n' +
                        '                                        aria-hidden="true"></i></button></div>\n' +
                        '                            <div class="col"><button data-id="' + row.Id + '" class="btn btn-blue btn-blue-table btn delete-drug"><i\n' +
                        '                                        class="fa fa-trash-o  "\n' +
                        '                                        aria-hidden="true"></i></button></div></div>';
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

        "scrollX": true,
        processing: true,
        serverSide: true,
        pageLength:50,
        orderCellsTop: true,
        autoWidth: true,
        deferRender: true,
        // lengthMenu: [[10, 25, 50, 1000, -1], [10, 25, 50, 1000, "All"]],
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
            // {'data': 'Id'},

            {'data': 'CommerceNameEn'},
            {'data': 'CommerceNameAr'},
            // {
            //     'data': 'ScientificNameAr', render: function (data, type, row) {
            //         return '<span class="drug-field" data-toggle="tooltip" data-placement="top" title="' + row.ScientificNameAr + '">' + row.ScientificNameAr + '</span>';
            //     }
            // },
            {
                'data': 'ScientificNameEn', render: function (data, type, row) {
                    return '<span class="drug-field" data-toggle="tooltip" data-placement="top" title="' + row.ScientificNameEn + '">' + row.ScientificNameEn + '</span>';
                }
            },
            {'data': 'Manufacture'},
            {'data': 'Strengths'},
            // {'data': 'Price'},

            {
                'data': 'Category', render: function (data, type, row) {
                    return '<span class="drug-field" data-toggle="tooltip" data-placement="top" title="' + row.Category + '">' + row.Category + '</span>';
                }
            },
            {'data': 'Form'},
            // {
            //     'data': 'Icon', render: function (data, type, row) {
            //         return '<img style="width: 100px; height:100px" src="' + siteFilesURL + 'images/drugs/large/' + row.Icon + '">';
            //     }
            // },
            {'data': 'Actions'}

        ],

        columnDefs: [{
            "targets": 7, "data": "Actions", render: function (data, type, row) {
                if (row.AvaiableInWarehouse != 1) {
                    return '<button data-toggle="tooltip" data-placement="top" title="Add drug" data-name="' + row.CommerceNameEn + '"  data-id="' + row.Id + '" class="btn btn-blue btn-blue-table btn link-drug-modal "><i\n' +
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
        "scrollX": true,
        processing: true,
        serverSide: true,
        pageLength:50,
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
            // {'data': 'Id'},
            {'data': 'CommerceNameEn'},
            {'data': 'CommerceNameAr'},

            // {
            //     'data': 'ScientificNameAr', render: function (data, type, row) {
            //         return '<span class="drug-field" data-toggle="tooltip" data-placement="top" title="' + row.ScientificNameAr + '">' + row.ScientificNameAr + '</span>';
            //     }
            // },

            {
                'data': 'ScientificNameEn', render: function (data, type, row) {
                    return '<span class="drug-field" data-toggle="tooltip" data-placement="top" title="' + row.ScientificNameEn + '">' + row.ScientificNameEn + '</span>';
                }
            },
            {'data': 'Manufacture'},
            {'data': 'Strengths'},
            {
                'data': 'Category', render: function (data, type, row) {
                    return '<span class="drug-field" data-toggle="tooltip" data-placement="top" title="' + row.Category + '">' + row.Category + '</span>';
                }
            },
            // {'data': 'Price'},

            {'data': 'Form'},
            // {
            //     'data': 'Icon', render: function (data, type, row) {
            //         return '<img style="width: 100px; height:100px" src="' + siteFilesURL + 'images/drugs/large/' + row.Icon + '">';
            //     }
            // },
            {'data': 'Actions'}

        ],

        columnDefs: [{
            "targets": 7, "data": "Actions", render: function (data, type, row) {
                return '<div class="row "><div class="col mb-1"><button data-toggle="tooltip" data-placement="top" title="delete drug" data-name="' + row.CommerceNameEn + '"  data-id="' + row.Id + '" class="btn btn-blue btn-blue-table btn unlink-drug-modal  "><i\n' +
                    '                                        class="fa fa-trash  "\n' +
                    '                                        aria-hidden="true"></i></button> </div>' +
                    '<div class="col "><button data-toggle="tooltip" data-placement="top" title="Add offer" data-name="' + row.CommerceNameEn + '" data-price="' + row.Price + '" data-id="' + row.Id + '" class="btn btn-blue btn-blue-table btn add-offer-drug "><i\n' +
                    '                                        class="fa fa-plus-square-o  "\n' +
                    '                                        aria-hidden="true"></i></button></div></div>';
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
        "scrollX": true,
        processing: true,
        serverSide: true,
        pageLength:50,
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

            // {'data': 'Id'},
            {'data': 'PharmacyName'},
            {'data': 'PharmacistName'},
            {'data': 'LicenseNumber'},
            {'data': 'City'},
            {'data': 'Address'},
            {'data': 'Status'},
            {'data': 'Actions'},

        ],


        columnDefs: [{
            "targets": 6, "data": "Actions", render: function (data, type, row) {
                return '<div class="row "><div class="col mb-1"><button data-id="' + row.Id + '" class="btn btn-blue btn-blue-table btn edit-pharmacy "><i\n' +
                    '                                        class="fa fa-pencil-square-o  "\n' +
                    '                                        aria-hidden="true"></i></button></div>\n' +
                    '                            <div class="col "><button data-id="' + row.Id + '" class="btn btn-blue btn-blue-table btn delete-pharmacy"><i\n' +
                    '                                        class="fa fa-trash-o  "\n' +
                    '                                        aria-hidden="true"></i></button></div></div>';
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
        "scrollX": true,
        processing: true,
        serverSide: true,
        pageLength:50,
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

            // {'data': 'Id'},
            {'data': 'TypeName'},
            {'data': 'Name'},
            {'data': 'Actions'},

        ],


        columnDefs: [{
            "targets": 2, "data": "Actions", render: function (data, type, row) {
                return '<button data-id="' + row.Id + '" class="btn btn-blue btn-blue-table btn delete-ad"><i\n' +
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
        "scrollX": true,
        processing: true,
        serverSide: true,
        pageLength:50,
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

            // {'data': 'Id'},
            {'data': 'Warehouse'},
            {'data': 'Pharmacy'},
            // {'data': 'Drug'},
            // {'data': 'Quantity'},
            {'data': 'RequestPrice'},
            {'data': 'DeliveryDate'},
            {'data': 'City'},
            {
                'data': 'RequestType', render: function (data, type, row) {
                    if (row.RequestType == 1) {
                        return '<span class="badge badge-pill badge-primary">Offer</span>';
                    } else {
                        return '<span class="badge badge-pill badge-warning">Order</span>';
                    }
                }
            },
            {'data': 'RequestStatus'},
            {'data': 'Actions'}


        ],


        columnDefs: [{
            "targets": 7, "data": "Actions", render: function (data, type, row) {
                return '<button data-id="' + row.Id + '" class="btn btn-blue btn-blue-table btn order-details "><i\\n\' +\n' +
                    '                    \'                                        class="fa fa-search-plus  "\\n\' +\n' +
                    '                    \'                                        aria-hidden="true"></i></button>'
            }
        }, {

            "targets": 7, "data": "RequestStatus", render: function (data, type, row) {

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
                var AdditionalValues = [city_id_global, order_status_id_global, warehouse_id_global, warehouse_from_date_global, warehouse_to_date_global];
                data.AdditionalValues = AdditionalValues;
            }
        }

    });

    var table_orders_admin = $('#table-orders-admin').DataTable({
        language: {
            processing: "Loading Data...",
            zeroRecords: "No matching records found"
        },
        "scrollX": true,
        processing: true,
        serverSide: true,
        pageLength:50,
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

            // {'data': 'Id'},
            {'data': 'Pharmacy'},
            // {'data': 'Drug'},
            // {'data': 'Quantity'},
            {'data': 'RequestPrice'},
            {'data': 'DeliveryDate'},
            {'data': 'City'},
            // {
            //     'data': 'OfferDescription', render: function (data, type, row) {
            //         return '<span class="order-offer-field" data-toggle="tooltip" data-placement="top" title="' + row.OfferDescription + '">' + row.OfferDescription + '</span>';
            //
            //     }
            // },
            {
                'data': 'RequestType', render: function (data, type, row) {
                    if (row.RequestType == 1) {
                        return '<span class="badge badge-pill badge-primary">Offer</span>';
                    } else {
                        return '<span class="badge badge-pill badge-warning">Order</span>';
                    }
                }
            },
            {'data': 'RequestStatus'},
            {'data': 'Actions'},

        ],


        columnDefs: [{
            "targets": 6, "data": "Actions", render: function (data, type, row) {
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
                        '</div> ' +
                        '<button data-id="' + row.Id + '" class="btn btn-blue btn-blue-table btn order-details "><i\\n\' +\n' +
                        '                    \'                                        class="fa fa-search-plus  "\\n\' +\n' +
                        '                    \'                                        aria-hidden="true"></i></button>';


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
                        '</div> ' +
                        '<button data-id="' + row.Id + '" class="btn btn-blue btn-blue-table btn order-details "><i\\n\' +\n' +
                        '                    \'                                        class="fa fa-search-plus  "\\n\' +\n' +
                        '                    \'                                        aria-hidden="true"></i></button>';
                } else {
                    return '<button data-id="' + row.Id + '" class="btn btn-blue btn-blue-table btn order-details "><i\\n\' +\n' +
                        '                    \'                                        class="fa fa-search-plus  "\\n\' +\n' +
                        '                    \'                                        aria-hidden="true"></i></button>';
                }
            }


        }, {

            "targets": 6, "data": "RequestStatus", render: function (data, type, row) {

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
                var AdditionalValues = [city_id_global, order_status_id_global, warehouse_id_global, warehouse_from_date_global, warehouse_to_date_global];
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
            Loading()
            $.ajax({
                method: "POST",
                url: $path + "requests/categories-management.php",
                data: {

                    action: 'show-list'
                }
            }).done(function (msg) {
                unLoading()
                if (msg == -1)
                    $.notify(lang.general_error, {position: "top center", className: "error"});
                else {
                    // // console.log(msg)
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
            Loading()
            $.ajax({
                method: "POST",
                url: $path + "requests/manufacturers-management.php",
                data: {
                    action: 'show-list'
                }
            }).done(function (msg) {
                unLoading()
                if (msg == -1)
                    $.notify(lang.general_error, {position: "top center", className: "error"});
                else {
                    // // console.log(msg)
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
        $drug_id = $('#drug-id').val();
        $selected = '';
        $path = '';
        if ($form_id !== '' || $drug_id !== '') {
            $selected = 'selected';
            $path = '../';
            $('#drug-forms-select').find('option').eq(0).replaceWith('<option  value="-1">' + lang.pleaseChoose + '</option>');
            $('#drug-forms-select').selectpicker('refresh');
        }

        if (select_clicked_form == false) {
            Loading()
            $.ajax({
                method: "POST",
                url: $path + "requests/drugs-management.php",
                data: {
                    action: 'show-list-forms'
                }
            }).done(function (msg) {
                unLoading()
                if (msg == -1)
                    $.notify(lang.general_error, {position: "top center", className: "error"});
                else {
                    // // console.log(msg)
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
        $man_id = $('#man-id').val();


        //manufacturer form error fixing
        //   $man_id = $('#man-id').val();
        // $pharmacy_id = $('#pharmacy-id').val();
        $selected = '';
        $path = '';

        if ($city_id !== '') {
            $selected = 'selected';
            $path = '../';
            $('#city-select').find('option').eq(0).replaceWith('<option  value="-1">' + lang.pleaseChoose + '</option>');
            $('#city-select').selectpicker('refresh');
        }
        if ($man_id !== undefined && $man_id !== '')
            $path = '../'

        if (select_clicked_city == false) {
            Loading()
            $.ajax({
                method: "POST",
                url: $path + "requests/cities-management.php",
                data: {

                    action: 'show-list'
                }
            }).done(function (msg) {
                unLoading()
                if (msg == -1)
                    $.notify(lang.general_error, {position: "top center", className: "error"});
                else {
                    // // console.log(msg)
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
            Loading()
            $.ajax({
                method: "POST",
                url: $path + "requests/ads-management.php",
                data: {

                    action: 'show-list-types'
                }
            }).done(function (msg) {
                unLoading()
                if (msg == -1)
                    $.notify(lang.general_error, {position: "top center", className: "error"});
                else {
                    // // console.log(msg)
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
            Loading()
            $.ajax({
                method: "POST",
                url: $path + "requests/offers-management.php",
                data: {

                    action: 'show-list-offer'
                }
            }).done(function (msg) {
                unLoading()
                if (msg == -1)
                    $.notify(lang.general_error, {position: "top center", className: "error"});
                else {
                    // console.log(msg)
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

        if (select_clicked_warehouse == false) {
            Loading()
            $.ajax({
                method: "POST",
                url: $path + "requests/warehouses-management.php",
                data: {

                    action: 'show-list-warehouse',
                    city_id: city_id_global
                }
            }).done(function (msg) {
                unLoading()
                if (msg == -1)
                    $.notify(lang.general_error, {position: "top center", className: "error"});
                else {
                    // console.log(msg)
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


        $('.bootstrap-select > select#warehouse-select').parent().removeClass('select-danger')
        $('#warehouse-to-date').removeClass('date-danger')
        $('#warehouse-from-date').removeClass('date-danger')

        city_id_global = $(this).val();
        select_clicked_warehouse = false;
        $('#warehouse-select').empty();
        $('#warehouse-select').append('<option selected value="' + -1 + '">' + 'Please choose' + '</option>');

        if (city_id_global != -1) {
            $('.bootstrap-select > select#warehouse-select').parent().removeClass('select-danger')

            $('.bootstrap-select > select#city-error').parent().removeClass('select-danger')

            $('#warehouse-select').removeAttr('disabled');
            $('#warehouse-select').selectpicker('refresh');
            $('#city-error').addClass('hidden')
            $('.bootstrap-select > select#city-select').parent().removeClass('select-danger')
        } else {

            $('.bootstrap-select > select#city-select').parent().addClass('select-danger')
            $('#city-error').removeClass('hidden')

            $('#warehouse-select').attr('disabled', 'disabled');

            $('#warehouse-select').selectpicker('refresh');
        }


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
        $('#profit-warehouse').attr('required', true);

        var $type = $(this).val();

        if ($type == 1 || $type == 2) {


            $('.bootstrap-select > select#SubscriptionType-select').parent().removeClass('select-danger')
            $('#warehouse-type-error').addClass('hidden')

            $('#profit-cont').removeClass('hidden')

        } else {

            $('.bootstrap-select > select#SubscriptionType-select').parent().addClass('select-danger')
            $('#warehouse-type-error').removeClass('hidden')

            $('#profit-warehouse').attr('required', false);
            $('#profit-cont').addClass('hidden')
        }

    })

    $(document).on('change', '#warehouse-from-date', function () {

        $('#warehouse-from-date').removeClass('date-danger')
        warehouse_from_date_global = $(this).val();

        // if(warehouse_from_date!=-1)
        // {
        //     $('#city-error').addClass('hidden')
        //     $('.bootstrap-select > select#city-select').parent().removeClass('select-danger')
        // }


        table_orders.draw()


    })

    $(document).on('change', '#warehouse-to-date', function () {

        $('#warehouse-to-date').removeClass('date-danger')
        warehouse_to_date_global = $(this).val();

        // if(warehouse_from_date!=-1)
        // {
        //     $('#city-error').addClass('hidden')
        //     $('.bootstrap-select > select#city-select').parent().removeClass('select-danger')
        // }


        table_orders.draw()


    })

    $(document).on('change', '#warehouse-select', function () {

        $('#warehouse-to-date').val('')
        $('#warehouse-from-date').val('')

        warehouse_id_global = $(this).val();
        $('#warehouse-to-date').removeClass('date-danger')
        $('#warehouse-from-date').removeClass('date-danger')

        if (warehouse_id_global != -1) {

            $('.bootstrap-select > select#warehouse-select').parent().removeClass('select-danger')

            $('#warehouse-from-date').removeAttr('disabled');
            $('#warehouse-to-date').removeAttr('disabled');

            $('#warehouse-to-date').selectpicker('refresh');
            $('#warehouse-from-date').selectpicker('refresh');

        } else {

            $('#warehouse-from-date').attr('disabled', 'disabled');
            $('#warehouse-from-date').selectpicker('refresh');
            $('#warehouse-to-date').attr('disabled', 'disabled');
            $('#warehouse-to-date').selectpicker('refresh');
        }

        // if(warehouse_from_date!=-1)
        // {
        //     $('#city-error').addClass('hidden')
        //     $('.bootstrap-select > select#city-select').parent().removeClass('select-danger')
        // }


        table_orders.draw()


    })

    $(document).on('changed.bs.select', '#category-select', function () {
        val = $(this).val()
        if (val == -1) {
            $('.bootstrap-select > select#category-select').parent().addClass('select-danger')
            $('#cat-error').removeClass('hidden')

        } else {
            $('.bootstrap-select > select#category-select').parent().removeClass('select-danger')
            $('#cat-error').addClass('hidden')
        }
    })
    $(document).on('changed.bs.select', '#manufacture-select', function () {
        val = $(this).val()
        if (val == -1) {
            $('.bootstrap-select > select#manufacture-select').parent().addClass('select-danger')
            $('#man-error').removeClass('hidden')
        } else {
            $('.bootstrap-select > select#manufacture-select').parent().removeClass('select-danger')
            $('#man-error').addClass('hidden')
        }
    })
    $(document).on('changed.bs.select', '#drug-forms-select', function () {
        val = $(this).val()
        if (val == -1) {

            $('.bootstrap-select > select#drug-forms-select').parent().addClass('select-danger')
            $('#drug-form-error').removeClass('hidden')
        } else {
            $('.bootstrap-select > select#drug-forms-select').parent().removeClass('select-danger')
            $('#drug-form-error').addClass('hidden')
        }
    })

    if (city_id_global != -1) {
        $('#city-error').addClass('hidden')
        $('.bootstrap-select > select#city-select').parent().removeClass('select-danger')
    }


    if (man_id_global != -1) {
        $('#man-error').addClass('hidden')
        $('.bootstrap-select > select#manufacture-select').parent().removeClass('select-danger')
    }

    if (cat_id_global != -1) {
        $('#cat-error').addClass('hidden')
        $('.bootstrap-select > select#category-select').parent().removeClass('select-danger')
    }


    if (drug_form_id_global != -1) {
        $('#drug-form-error').addClass('hidden')
        $('.bootstrap-select > select#drug-forms-select').parent().removeClass('select-danger')
    }

    if (warehouse_type_id_global != -1) {
        $('#warehouse-type-error').addClass('hidden')
        $('.bootstrap-select > select#SubscriptionType-select').parent().removeClass('select-danger')
    }


    $(document).on('submit', '#warehouse-form', function (e) {

        var city = $('#city-select').val();
        var type = $('#SubscriptionType-select').val();

        if (city == -1) {
            e.preventDefault()
            $('#city-error').removeClass('hidden')
            $('.bootstrap-select > select#city-select').parent().addClass('select-danger')
        }
        if (type == -1) {
            e.preventDefault()
            $('#warehouse-type-error').removeClass('hidden')
            $('.bootstrap-select > select#SubscriptionType-select').parent().addClass('select-danger')
        } else {

            $(this).submit();
        }


    });


    $(document).on('submit', '#man-form', function (e) {

        var city = $('#city-select').val();
        if (city == -1) {
            e.preventDefault()
            $('#city-error').removeClass('hidden')
            $('.bootstrap-select > select#city-select').parent().addClass('select-danger')
        } else {

            $(this).submit();
        }


    });

    $(document).on('submit', '#pharma-form', function (e) {

        var city = $('#city-select').val();
        if (city == -1) {
            e.preventDefault()
            $('#city-error').removeClass('hidden')
            $('.bootstrap-select > select#city-select').parent().addClass('select-danger')
        } else {

            $(this).submit();
        }


    });


    $(document).on('submit', '#drug-form', function (e) {

        var cat = $('#category-select').val();
        var man = $('#manufacture-select').val();
        var form = $('#drug-forms-select').val();

        if (cat == -1) {
            e.preventDefault()
            $('#cat-error').removeClass('hidden')
            $('.bootstrap-select > select#category-select').parent().addClass('select-danger')
        } else {
            $('#cat-error').addClass('hidden')
            $('.bootstrap-select > select#category-select').parent().removeClass('select-danger')
        }
        if (man == -1) {
            e.preventDefault()
            $('#man-error').removeClass('hidden')
            $('.bootstrap-select > select#manufacture-select').parent().addClass('select-danger')

        } else {
            $('#man-error').addClass('hidden')
            $('.bootstrap-select > select#manufacture-select').parent().removeClass('select-danger')
        }
        if (form == -1) {
            e.preventDefault()
            $('#drug-form-error').removeClass('hidden')
            $('.bootstrap-select > select#drug-forms-select').parent().addClass('select-danger')
        } else if (form != -1) {
            $('#drug-form-error').addClass('hidden')
            $('.bootstrap-select > select#drug-forms-select').parent().removeClass('select-danger')
        } else {

            $(this).submit();
        }


    })


    if ($('#change-password').val() == 1) {

        $('#change-password-modal').modal({show: true})

    }

    $('input[type=search]').addClass('search-input-xl');


    if ($('#error-msg').val() !== '') {
        $.notify($('#error-msg').val(), {position: "top center", className: $('#error-msg').data('type')});


    }


})


function Loading() {
    $('body').addClass('page-overlay')
    $('#loader').addClass('spinner')
    $('#loader').removeClass('hidden')
}

function unLoading() {
    $('body').removeClass('page-overlay')
    $('#loader').removeClass('spinner')
    $('#loader').addClass('hidden')
}


