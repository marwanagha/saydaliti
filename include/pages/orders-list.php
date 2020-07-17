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
                <h4 class="modal-title"><?php echo $lang['please_change_password'] ?></h4>
            </div>
            <div class="modal-body">
                <form action="requests/warehouses-management.php" method="post" class="form-horizontal  col ">
                    <div class="form-group">
                        <label class="col control-label text-left "><?php echo $lang['new_password'] ?>: </label>
                        <div class="col">
                            <input required minlength="8" class="form-control" id="change-password-field"
                                   name="change-password-field" placeholder="<?php echo $lang['new_password'] ?>"
                                   type="password"
                                   value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-8 control-label text-left "></label>
                        <div class="col-md-8">
                            <button type="submit" id="submit-change-password" name="submit-change-password"
                                    class="btn btn-general btn-blue mr-2"><?php echo $lang['submit'] ?>
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
                <h4 class="modal-title"><?php echo $lang['order_details'] ?></h4>
            </div>
            <div class="modal-body">
                <div class="<?php if ($_SESSION['lang'] == 'ar') echo 'text-right'; else echo 'text-left'; ?>"
                     id="order-details-header"></div>
                <table style="margin-top:0" class="table table-striped" id="profits-response">
                    <thead>
                    <tr>
                        <th><?php echo $lang['manufacturer'] ?></th>
                        <th><?php echo $lang['drug'] ?></th>
                        <th><?php echo $lang['quantity'] ?></th>
                        <th><?php echo $lang['g_price'] ?></th>
                        <th><?php echo $lang['secondprice'] ?></th>
                        <th><?php echo $lang['total'] ?></th>
                        <th><?php echo $lang['gift'] ?></th>
                        <th><?php echo $lang['offer_desc'] ?></th>
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
        <div class="col"><h2 class="mb-5"><?php echo $lang['orders_list'] ?></h2></div>
    </div>
    <div class="row mb-3">

        <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) { ?>
            <div class="col ">
                <label class=" text-left mr-3 ">City: </label><br/>
                <select required name="city-select" id="city-select" class="selectpicker "
                        menuPlacement="top">
                    <option value="-1" selected>please choose</option>
                </select>
                <input id="city-id" type="hidden"
                       value="">
            </div>
            <div class="col ">
                <label class=" text-left mr-3 ">Warehouse: </label>
                <select required disabled name="warehouse-select" id="warehouse-select" class="selectpicker "
                        menuPlacement="top">
                    <option value="-1" selected>please choose</option>
                </select>

            </div>
            <div class="col ">
                <label class=" text-left mr-3 ">From: </label>
                <input disabled value="" type="date" name="warehouse-from-date" id="warehouse-from-date"
                       class="form-control ">

            </div>
            <div class="col ">
                <label class=" text-left mr-3 ">To: </label>
                <input disabled value="" type="date" name="warehouse-to-date" id="warehouse-to-date"
                       class="form-control ">

            </div>
        <?php } ?>
        <div class="col ">
            <label class=" text-left <?php if ($_SESSION['lang'] == 'en') echo 'mr-3'; else echo 'ml-3'; ?> "><?php echo $lang['status'] ?>
                : </label>
            <select required name="status-select" id="status-select" class="selectpicker "
                    menuPlacement="top">
                <option value="-1" selected><?php echo $lang['please_choose'] ?></option>
                <option value="1"><?php echo $lang['pending'] ?></option>
                <option value="2"><?php echo $lang['processing'] ?></option>
                <option value="3"><?php echo $lang['done'] ?></option>
                <option value="4"><?php echo $lang['rejected'] ?></option>
            </select>
            <input id="status-id" type="hidden"
                   value="">
        </div>
    </div>
    <div class="row">
        <div class="col text-center">
            <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) { ?>
                <button id="calculate-profits" class="btn btn-info mb-3">Profits</i></button>
            <?php } ?>
        </div>

    </div>
    <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) { ?>
    <table id="table-orders" class="table table-hover table-striped m-1
" style="width:100%">
        <?php } else { ?>
        <table id="table-orders-admin" class="table table-hover table-striped m-1
" style="width:100%">
            <?php } ?>

            <thead class="bg-info text-white">
            <tr>

                <!--            <th>Id</th>-->
                <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) { ?>
                    <th><?php echo $lang['warehouse'] ?></th>
                <?php } ?>
                <th><?php echo $lang['pharmacy'] ?></th>
                <!--            <th>Drug</th>-->
                <!--            <th>Quantity</th>-->
                <th><?php echo $lang['total_price'] ?></th>
                <th><?php echo $lang['deliveryDate'] ?></th>
                <th><?php echo $lang['city'] ?></th>
                <!--            <th>OfferDescription</th>-->
                <th><?php echo $lang['requestType'] ?></th>
                <th><?php echo $lang['status'] ?></th>
                <th><?php echo $lang['actions'] ?></th>


            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
</div>





