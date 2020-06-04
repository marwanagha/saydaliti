<?php

if (isset($_SESSION['error_msg']) && !empty($_SESSION['error_msg']) && isset($_SESSION['msg_type'])) {
    if ($_SESSION['msg_type'] == 1)
        echo '<input id="error-msg" data-type="success"  type="hidden" value="' . $_SESSION['error_msg'] . '">';
    else if ($_SESSION['msg_type'] == -1)
        echo '<input id="error-msg" data-type="error"  type="hidden" value="' . $_SESSION['error_msg'] . '">';
    else
        echo '<input id="error-msg" data-type="warn"  type="hidden" value="' . $_SESSION['error_msg'] . '">';
    $_SESSION['error_msg'] = '';
    $_SESSION['msg_type'] = '';

}

if (isset($_SESSION['change_password'])) {
    echo '<input id="change-password" data-type="error"  type="hidden" value="' . $_SESSION['change_password'] . '">';
}



?>

<div id="change-password-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div align="center" class="modal-content" style="margin-top: 100px">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Please change your password</h4>
            </div>
            <div class="modal-body">
                <form action="requests/warehouses-management.php" method="post" class="form-horizontal  col ">
                    <div class="form-group">
                        <label class="col control-label text-left ">New Password: </label>
                        <div class="col">
                            <input required minlength="8" class="form-control" id="change-password-field"
                                   name="change-password-field" placeholder="New Password"
                                   type="password"
                                   value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-8 control-label text-left "></label>
                        <div class="col-md-8">
                            <button type="submit" id="submit-change-password" name="submit-change-password"
                                    class="btn btn-general btn-blue mr-2">Submit
                            </button>
                            <span></span>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>
<div id="profits-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div align="center" class="modal-content" style="margin-top: 100px">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Your profits</h4>
            </div>
            <div class="modal-body">
                <h3 id="profits-response"></h3>
            </div>
        </div>

    </div>
</div>
<div id="order-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div align="center" class="modal-content" style="margin-top: 100px">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Order Details</h4>
            </div>
            <div class="modal-body">
                <table style="margin-top:0" class="table table-striped" id="profits-response">
                    <thead>
                    <tr>
                        <th>Drug</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Offer Description</th>
                    </tr>
                    </thead>
                    <tbody id="table-body-order-details">

                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>


<div class="content-inner chart-cont">
    <div class="row">
        <div class="col"><h2 class="mb-5">Orders Listing</h2></div>
    </div>
    <div class="row mb-3">

        <?php if(isset($_SESSION['role_id']) && $_SESSION['role_id']==1){ ?>
            <div class="col ">
                <label class=" text-left mr-3 ">City: </label>
                <select required name="city-select" id="city-select" class="selectpicker "
                        menuPlacement="top">
                    <option value="-1" selected>please choose</option>
                </select>
                <input id="city-id" type="hidden"
                       value="">
            </div>
            <div class="col ">
                <label class=" text-left mr-3 ">Warehouse: </label>
                <select required  disabled name="warehouse-select" id="warehouse-select" class="selectpicker "
                        menuPlacement="top">
                    <option value="-1" selected>please choose</option>
                </select>

            </div>
            <div class="col ">
                <label class=" text-left mr-3 ">From: </label>
                <input disabled value="" type="date" name="warehouse-from-date" id="warehouse-from-date" class="form-control ">

            </div>
            <div class="col ">
                <label class=" text-left mr-3 ">To: </label>
                <input disabled value="" type="date" name="warehouse-to-date" id="warehouse-to-date" class="form-control ">

            </div>
        <?php  } ?>
        <div class="col ">
            <label class=" text-left mr-3 ">Status: </label>
            <select required name="status-select" id="status-select" class="selectpicker "
                    menuPlacement="top">
                <option value="-1" selected>please choose</option>
                <option value="1">Pending</option>
                <option value="2">Processing</option>
                <option value="3">Done</option>
                <option value="4">Rejected</option>
            </select>
            <input id="status-id" type="hidden"
                   value="">
        </div>
    </div>
<div class="row">
    <div class="col text-center">
        <?php if(isset($_SESSION['role_id']) && $_SESSION['role_id']==1){ ?>
            <button id="calculate-profits" class="btn btn-info mb-3">Profits</i></button>
        <?php  } ?>
    </div>

</div>
    <?php if(isset($_SESSION['role_id']) && $_SESSION['role_id']==1) { ?>
    <table id="table-orders" class="table table-hover table-striped m-1
" style="width:100%">
    <?php } else { ?>
        <table id="table-orders-admin" class="table table-hover table-striped m-1
" style="width:100%">
   <?php } ?>

        <thead class="bg-info text-white">
        <tr>

<!--            <th>Id</th>-->
            <?php if(isset($_SESSION['role_id']) && $_SESSION['role_id']==1) { ?>
                <th>Warehouse</th>
            <?php } ?>
            <th>Pharmacy</th>
<!--            <th>Drug</th>-->
<!--            <th>Quantity</th>-->
            <th>Price</th>
            <th>DeliveryDate</th>
            <th>City</th>
<!--            <th>OfferDescription</th>-->
            <th>RequestType</th>
            <th>RequestStatus</th>
            <th>Actions</th>



        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
