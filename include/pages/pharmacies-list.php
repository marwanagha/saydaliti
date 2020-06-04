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

<div id="confirm-modal-delete-pharmacy" class="modal fade" role="dialog">
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
                        <button id="yes-delete-pharmacy" type="button" class="btn btn-info btn" data-dismiss="modal">
                            Yes
                        </button>
                    </div>
                    <div class="col">
                        <button id="no-delete-pharmacy" type="button" class="btn btn-info btn" data-dismiss="modal">No
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>



<div class="content-inner chart-cont">
    <div class="row">
        <div class="col-4"><h2 class="mb-5">Pharmacies Listing</h2></div>
        <div class="col-4 text-center">
            <label class=" text-left mr-3 ">City: </label>
            <select  required name="city-select" id="city-select" class="selectpicker "
                     menuPlacement="top">
                <option value="-1" selected>please choose</option>
            </select>
            <input id="city-id" type="hidden"
                   value="">
        </div>
        <div class="col-4">
            <button id="add-pharmacy" class="btn btn-info admin-add-btn">Add</i></button>
        </div>
    </div>
    <table id="table-pharmacies" class="table table-hover table-striped m-1
" style="width:100%">
        <thead class="bg-info text-white">
        <tr>
<!--            <th>Id</th>-->
            <th>PharmacyName</th>
            <th>PharmacistName</th>
            <th>LicenseNumber</th>
            <th>City</th>
            <th>Address</th>
            <th>Status</th>
            <th>Actions</th>


        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
