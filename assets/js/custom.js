var siteURL = '/saydaliti/';
var siteFilesURL = siteURL + 'files/';

$(document).ready(function () {

    /** saydaliti drugs**/

    $('#add-drug').click(function () {

        // $('#man-modal').modal({show: true})
        window.location.href=siteURL+"drug-form";
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


    $(document).on('change','.active-category',function () {
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

    $(document).on('change','.inactive-category',function () {
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


    $(document).on('click','.delete-cat',function () {

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
        window.location.href=siteURL+"manufacturer-form";
    })


    $(document).on('change','.active-man',function () {
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

    $(document).on('change','.inactive-man',function () {
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


    $(document).on('click','.delete-man',function () {

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



    /** orders **/


    $('.reject').change(function () {
        $('#confirm-modal-reject-order').modal({show: true})
        localStorage.setItem('order_status', '1');
        localStorage.setItem('order_id', $(this).data('id'));
    })
    // $('#yes-reject-order').click(function () {
    //
    //     $order_id = localStorage.getItem('order_id');
    //     $status = localStorage.getItem('order_status');
    //     $note = $('#reject-text').val();
    //     $selector = '#order-' + $order_id;
    //
    //
    //
    //     $.ajax({
    //         method: "POST",
    //         url: "requests/products_management.php",
    //         data: {
    //             order_id: $order_id,
    //             action: 'change-status',
    //             status: $status,
    //             note: $note,
    //         }
    //     }).done(function (msg) {
    //
    //         if (msg == 1) {
    //             $('#order-' + $product_id).fadeOut(500, function () {
    //
    //                 $(this).remove();
    //
    //             })
    //             alert(lang.successfully_done)
    //             $('#reject-text').val('');
    //         } else {
    //             alert(msg)
    //             $('#reject-text').val('');
    //         }
    //
    //     })
    //
    //
    // })
    //
    // $('#no-reject-order').click(function () {
    //
    //     // let x = $('.pending').parent().addClass('active');
    //     // x.siblings().removeClass('active');
    // })


    $('.fail').change(function () {
        $('#confirm-modal-status-order').modal({show: true})
        localStorage.setItem('order_status', '4');
        localStorage.setItem('order_id', $(this).data('id'));
        localStorage.setItem('user_id_order', $(this).data('userid'));
    })

    $('.resolve').change(function () {
        $('#confirm-modal-status-order').modal({show: true})
        localStorage.setItem('order_status', '3');
        localStorage.setItem('order_id', $(this).data('id'));
        localStorage.setItem('user_id_order', $(this).data('userid'));
    })


    $('.yes-status-order').click(function () {


        $order_id = localStorage.getItem('order_id');
        $status = localStorage.getItem('order_status');
        $selector = '#order-' + $order_id;
        $note = $('#reject-text').val();
        $user_id = localStorage.getItem('user_id_order');
        $.ajax({
            method: "POST",
            url: "requests/orders-management.php",
            data: {
                order_id: $order_id,
                action: 'change-status',
                status: $status,
                note: $note,
                user_id: $user_id,
            }
        }).done(function (msg) {

            if (msg == 1) {
                $('#order-' + $order_id).fadeOut(500, function () {

                    $(this).remove();

                })
                $.notify(lang.successfully_done, {position: "left bottom", className: "success"});
            } else {
                // alert(msg)
                $.notify(lang.general_error, {position: "left bottom", className: "error"});
            }

        })
    })

    $('.no-status-order').click(function () {
        // let x = $('.pending').parent().addClass('active');
        // x.siblings().removeClass('active');

    })

    $('.check-cart').click(function () {

        $('#cart-modal').modal({show: true})

        $order_id = $(this).data('id');

        $.ajax({
            method: "POST",
            url: "requests/orders-management.php",
            data: {
                order_id: $order_id,
                action: 'get-cart',

            }
        }).done(function (msg) {
            if (msg == -1) {
                $.notify(lang.general_error, {position: "left bottom", className: "error"});
            } else {
                $('#cart-table').empty();
                $total = 0;
                jQuery(JSON.parse(msg)).each(function (i, item) {
                    $total = $total + parseInt(item.sub_total);
                    $('#cart-table').append('<tr class="table-primary"><td class="text-left">' + item.product_id + '</td><td class="table-width-3">' + item.name + '</td> <td class="table-width-3">' + item.quantity + '</td> <td class="table-width-3">' + item.sub_total + '</td></tr>');

                })
                $('#cart-total').text('Total: ' + $total + ' ' + lang.sp);
            }


        });
    });

    $('.check-note').click(function () {
        $('#note-modal').modal({show: true})
        $('#note-text').val($(this).data('note'))
    })


    /** projects**/
    //when download delete


    /** news**/


    $('.edit-news').click(function () {
        window.location.href = "http://localhost/E-commerce/admin/news-form.php";
    })

    $('.delete-news').click(function () {
        $('#confirm-modal-delete').modal({show: true})
    })

    /** admins**/

    $('.active-admin').change(function () {
        $('#confirm-modal-user-status').modal({show: true})
        localStorage.setItem('user_status', '5');
        localStorage.setItem('user_id', $(this).data('id'));
    })
    $('.block-admin').change(function () {
        $('#confirm-modal-user-status').modal({show: true})
        localStorage.setItem('user_status', '7');
        localStorage.setItem('user_id', $(this).data('id'));
    })


    /** users**/


    $('.active-user').change(function () {
        $('#confirm-modal-user-status').modal({show: true})
        localStorage.setItem('user_status', '2');
        localStorage.setItem('user_id', $(this).data('id'));
    })

    $('.block-user').change(function () {
        $('#confirm-modal-user-status').modal({show: true})
        localStorage.setItem('user_status', '4');
        localStorage.setItem('user_id', $(this).data('id'));
    })
    $('.vip-user').change(function () {
        $('#confirm-modal-user-status').modal({show: true})
        localStorage.setItem('user_status', '3');
        localStorage.setItem('user_id', $(this).data('id'));
    })

    $('#yes-status-user').click(function () {

        $.ajax({
            method: "POST",
            url: "requests/users-management.php",
            data: {
                user_id: localStorage.getItem('user_id'),
                action: 'change-status',
                user_status: localStorage.getItem('user_status'),
            }
        }).done(function (msg) {
// alert(msg)
            if (msg == 1)

                $.notify(lang.successfully_done, {position: "left bottom", className: "success"});
            else
                $.notify(lang.general_error, {position: "left bottom", className: "error"});
        })

    })
    $('#no-status-user').click(function () {

        //let the previous status come back

    })


    /** subcategories**/

    $('#add-subcategory').click(function () {

        $('#subcategory-modal').modal({show: true})
        $('#category-select').selectpicker('refresh');
    })


    $('.active-subcategory').change(function () {
        $('#confirm-modal-sub-status').modal({show: true})
        localStorage.setItem('sub_status', '1');
        localStorage.setItem('sub_id', $(this).data('id'));

    })

    $('.inactive-subcategory').change(function () {
        $('#confirm-modal-sub-status').modal({show: true})
        localStorage.setItem('sub_status', '2');
        localStorage.setItem('sub_id', $(this).data('id'));
    })

    $('#yes-status-sub').click(function () {
        $.ajax({
            method: "POST",
            url: "requests/subcategory-management.php",
            data: {
                sub_id: localStorage.getItem('sub_id'),
                action: 'change-status',
                status: localStorage.getItem('sub_status'),
            }
        }).done(function (msg) {

            if (msg == 1)
                $.notify(lang.successfully_done, {position: "left bottom", className: "success"});
            else
                $.notify(lang.general_error, {position: "left bottom", className: "error"});

        })
    })

    $('#no-status-sub').click(function () {


    })
    $('.delete-subcategory').click(function () {

        $('#confirm-modal-delete-sub').modal({show: true})

        localStorage.setItem('sub_id', $(this).data('id'))

    })

    $('#yes-delete-subcategory').click(function () {
        $sub_id = localStorage.getItem('sub_id');
        $selector = '#subcategory-' + $sub_id;

        $.ajax({
            method: "POST",
            url: "requests/subcategory-management.php",
            data: {
                sub_id: $sub_id,
                action: 'delete',
            }
        }).done(function (msg) {

            if (msg == 1) {
                $('#subcategory-' + $sub_id).fadeOut(500, function () {

                    $(this).remove();

                })
                $.notify(lang.successfully_done, {position: "left bottom", className: "success"});

            } else {
                $.notify(lang.canNotDeleteSub, {position: "left bottom", className: "error"});
            }

        })

    })

    $('#no-delete-subcategory').click(function () {


    })

    /** about **/


    $('#add-about').click(function () {

        $('#about-form-modal').modal({show: true})
    })

    $('.delete-about').click(function () {
        $('#confirm-modal-delete-about').modal({show: true})
        localStorage.setItem('about_id', $(this).data('id'))
    })
    $('#yes-delete-about').click(function () {
        $id = localStorage.getItem('about_id');
        $selector = '#about-' + $id;
        $.ajax({
            method: "POST",
            url: "requests/about-management.php",
            data: {
                id: $id,
                action: 'delete',
            }
        }).done(function (msg) {
            if (msg == 1) {
                $('#about-' + $id).fadeOut(500, function () {
                    $(this).remove();
                })
                $.notify(lang.successfully_done, {position: "left bottom", className: "success"});
            } else {
                $.notify(lang.canNotDeleteCat, {position: "left bottom", className: "error"});
            }
        })
    })
    $('#no-delete-category').click(function () {
        // $('#confirm-modal-product-status').hide();
        //remove tr
    })

    /** leading companies **/


    $('#add-companies').click(function () {

        $('#companies-form-modal').modal({show: true})
    })

    $('.delete-companies').click(function () {
        $('#confirm-modal-delete-companies').modal({show: true})
        localStorage.setItem('companies_id', $(this).data('id'))
    })
    $('#yes-delete-companies').click(function () {
        $id = localStorage.getItem('companies_id');
        $selector = '#companies-' + $id;
        $.ajax({
            method: "POST",
            url: "requests/companies-management.php",
            data: {
                id: $id,
                action: 'delete',
            }
        }).done(function (msg) {
            if (msg == 1) {
                $('#companies-' + $id).fadeOut(500, function () {
                    $(this).remove();
                })
                $.notify(lang.successfully_done, {position: "left bottom", className: "success"});
            } else {
                $.notify(lang.canNotDeleteCat, {position: "left bottom", className: "error"});
            }
        })
    })


    $('#datatable').DataTable();
    $('#datatable2').DataTable();


    // product form

    $('#submit-product').click(function (e) {

        if ($('#category-select').val() == -1) {
            e.preventDefault();

            document.getElementsByClassName("btn dropdown-toggle btn-light")[0].style.borderColor = "red";

            $('#subcategory-select').css('border-color', 'red');

        }

        if ($('#subcategory-select').val() == -1) {
            e.preventDefault();
            document.getElementsByClassName("btn dropdown-toggle btn-light")[1].style.borderColor = "red";


        }


    })

    $('#submit-subcategory').click(function (e) {

        if ($('#category-select').val() == -1) {
            e.preventDefault();

            document.getElementsByClassName("btn dropdown-toggle btn-light")[0].style.borderColor = "red";
        }


    })


//category and subcategory


    if ($('#category-select').val !== -1) {
        $("#subcategory-select").prop("disabled", false);
        $('#subcategory-select').selectpicker('refresh');
    }

    // var select_clicked_cat = false;
    // var select_clicked_sub = false;

    // $(document).on('shown.bs.select', '#category-select', function () {
    //
    //
    //     document.getElementsByClassName("btn dropdown-toggle btn-light")[0].style.borderColor = "";
    //     $cat_id = $('#cat-id').val();
    //     $selected = '';
    //     $path = '';
    //     if ($cat_id !== '') {
    //         $selected = 'selected';
    //         $path = '../';
    //         $('#category-select').find('option').eq(0).replaceWith('<option  value="-1">' + lang.pleaseChoose + '</option>');
    //         $('#category-select').selectpicker('refresh');
    //     }
    //
    //     if (select_clicked_cat == false) {
    //
    //         $.ajax({
    //             method: "POST",
    //             url: $path + "requests/categories.php",
    //             data: {}
    //         }).done(function (msg) {
    //             if (msg == -1)
    //                 $.notify(lang.general_error, {position: "left bottom", className: "error"});
    //             else {
    //                 console.log(msg)
    //                 jQuery(JSON.parse(msg)).each(function (i, item) {
    //
    //                     $('#category-select').append('<option value="' + item.id + '">' + item.name + '</option>');
    //                     $('#category-select').selectpicker('refresh');
    //
    //                 });
    //             }
    //
    //         });
    //
    //         select_clicked_cat = true;
    //     }
    //
    // })
    //
    //
    // $(document).on('changed.bs.select', '#category-select', function () {
    //     select_clicked_sub = false;
    //
    //     if ($(this).val() != -1) {
    //         $("#subcategory-select").prop("disabled", false);
    //         $('#subcategory-select').selectpicker('refresh');
    //     } else {
    //         $("#subcategory-select").prop('disabled', true);
    //         $('#subcategory-select').selectpicker('refresh');
    //     }
    //     $('#subcategory-select').empty();
    //     $('#subcategory-select').append('<option  value="-1">' + lang.pleaseChoose + '</option>');
    //     $('#subcategory-select').selectpicker('refresh');
    //
    // })


    $(document).on('shown.bs.select', '#subcategory-select', function () {


        document.getElementsByClassName("btn dropdown-toggle btn-light")[1].style.borderColor = "";
        $sub_id = $('#sub-id').val();
        $selected = '';
        $path = '';
        if ($sub_id !== '') {
            $selected = 'selected';
            $path = '../';
            $('#subcategory-select').find('option').eq(0).replaceWith('<option value="-1">' + lang.pleaseChoose + '</option>');
            // replaceWith('<option selected  value="-1">' + lang.pleaseChoose + '</option>');

            // $('#subcategory-select').empty();
            $('#subcategory-select').selectpicker('refresh');
            //
        }
        if (select_clicked_sub == false) {
            $.ajax({
                method: "POST",
                url: $path + "requests/subcategories.php",
                data: {cat_id: $('#category-select').val()}
            }).done(function (msg) {

                if (msg == -1) {
                    $.notify(lang.general_error, {position: "left bottom", className: "error"});

                } else {
                    jQuery(JSON.parse(msg)).each(function (i, item) {
                        $('#subcategory-select').append('<option value="' + item.id + '">' + item.name + '</option>');
                        $('#subcategory-select').selectpicker('refresh');

                    });
                }


            })
            select_clicked_sub = true;
        }
    })


    //register for admin

    var $submit_admin = false;

    $(document).on('submit', '#submit-admin', function (e) {

        if (!$submit_admin) {
            {
                if ($('#password').val() !== $('#re-password').val()) {
                    $.notify(lang.passwordsNotMatched, {position: "left bottom", className: "warn"});
                } else {
                    $submit_admin = true;
                    $('#submit-admin').submit();
                }
            }
            e.preventDefault()
        }
        // else
        //     $('#register-form-user').submit();


    });


    var $submit_change_password = false;

    $(document).on('submit', '#change-password-form', function (e) {

        if (!$submit_change_password) {
            {
                if ($('#new-password').val() !== $('#re-password').val()) {
                    alert(lang.passwordsNotMatched);
                } else {
                    $submit_change_password = true;
                    $('#change-password-form').submit();
                }
            }
            e.preventDefault()
        }
        // else
        //     $('#register-form-user').submit();


    });


})

$(document).ready(function () {

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
                let additionalValues = [];
                additionalValues[0] = "Additional Parameters 1";
                additionalValues[1] = "Additional Parameters 2";
                data.AdditionalValues = additionalValues;
                // return JSON.stringify(data);
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
                let additionalValues = [];
                additionalValues[0] = "Additional Parameters 1";
                additionalValues[1] = "Additional Parameters 2";
                data.AdditionalValues = additionalValues;
                // return JSON.stringify(data);
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
            {
                'data': 'Icon', render: function (data, type, row) {
                    return '<img style="width: 100px; height:100px" src="' + siteFilesURL + 'images/drugs/large/' + row.Icon + '">';
                }
            },
            {'data': 'Actions'}

        ],

        columnDefs: [{
            "targets": 10, "data": "Actions", render: function (data, type, row) {
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
            data: function (data) {
                let additionalValues = [];
                additionalValues[0] = "Additional Parameters 1";
                additionalValues[1] = "Additional Parameters 2";
                data.AdditionalValues = additionalValues;
                // return JSON.stringify(data);
            }
        }
        // sAjaxSource: "requests/products_management.php"
    });

    var select_clicked_cat = false;
    var select_clicked_city = false;
    var select_clicked_man = false;

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
        $cat_id = $('#cat-id').val();
        $selected = '';
        $path = '';
        if ($cat_id !== '') {
            $selected = 'selected';
            $path = '../';
            $('#manufacture-select').find('option').eq(0).replaceWith('<option  value="-1">' + lang.pleaseChoose + '</option>');
            $('#manufacture-select').selectpicker('refresh');
        }

        if (select_clicked_city == false) {
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


    if ($('#error-msg').val()) {

        $.notify($('#error-msg').val(), {position: "left bottom", className: $('#error-msg').data('type')});

    }


})
