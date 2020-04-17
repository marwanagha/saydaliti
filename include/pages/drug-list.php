<?php
//var_dump($_SESSION);
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

<div id="confirm-modal-delete-drug" class="modal fade" role="dialog">
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
                        <button id="yes-delete-drug" type="button" class="btn btn-info btn" data-dismiss="modal">
                            Yes
                        </button>
                    </div>
                    <div class="col">
                        <button id="no-delete-drug" type="button" class="btn btn-info btn" data-dismiss="modal">No
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>



<div class="content-inner chart-cont">
    <div class="row">
        <div class="col-7"><h2 class="mb-5">Drugs Listing</h2></div>
        <div class="col-5">
            <button id="add-drug" class="btn btn-info admin-add-btn">Add</i></button>
        </div>
    </div>
    <table id="table-drugs" class="table table-hover table-striped m-1
" style="width:100%">
        <thead class="bg-info text-white">
        <tr>
            <th>Id</th>
            <th>CommerceNameAr</th>
            <th>CommerceNameEn</th>
            <th>ScientificNameAr</th>
            <th>ScientificNameEn</th>
            <th>Strengths</th>
            <th>Price</th>
            <th>Manufacture</th>
            <th>Category</th>
            <th>Form</th>
            <th>Icon</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
