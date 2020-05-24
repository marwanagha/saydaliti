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




?>
<div id="confirm-modal-link-offer" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div align="center" class="modal-content" style="margin-top: 100px">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Are You Sure?</h4>
                <input type="hidden" id="item-type" value="2">
            </div>
            <div class="modal-footer">
                <div class="row" style="margin: auto;">
                    <div class="col">
                        <button id="yes-add-ad" type="button" class="btn btn-info btn" data-dismiss="modal">
                            Yes
                        </button>
                    </div>
                    <div class="col">
                        <button id="no-add-ad" type="button" class="btn btn-info btn" data-dismiss="modal">No
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div id="confirm-modal-delete-offer" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div align="center" class="modal-content" style="margin-top: 100px">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Are You Sure?</h4>
            </div>
            <div class="modal-footer">
                <div class="row" style="margin: auto;">
                    <div class="col">
                        <button id="yes-delete-offer" type="button" class="btn btn-info btn" data-dismiss="modal">
                            Yes
                        </button>
                    </div>
                    <div class="col">
                        <button id="no-delete-offer" type="button" class="btn btn-info btn" data-dismiss="modal">No
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<div class="content-inner chart-cont">
    <div class="row">
        <div class="col"><h2 class="mb-5">Offers Listing</h2></div>
        <div class="col text-center">

        </div>
        <div class="col text-center">

        </div>
        <div class="col">
        </div>
    </div>
    <table id="<?php if($_SESSION['role_id']==1) {echo 'table-offers';} else { echo 'table-offers-admin';} ?>" class="table table-hover table-striped m-1
" style="width:100%">
        <thead class="bg-info text-white">
        <tr>

            <th>Id</th>
            <?php if($_SESSION['role_id']==1) echo '<th>Warehouse</th>'; ?>
            <th>Description</th>
            <th>Durg</th>
            <th>Quantity</th>
            <th>ExpiryDate</th>
            <th>Discount</th>
            <th>TotalPrice</th>
            <th>Actions</th>



        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
