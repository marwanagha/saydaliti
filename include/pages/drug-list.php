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


<div id="warehouse-admin-link-drug-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div align="center" class="modal-content" style="margin-top: 100px">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add to My Drugs</h4>
            </div>
            <div class="modal-body">
                <div class="form-horizontal  col ">
                    <input type="hidden" id="warehouse-drug-id" name="warehouse-drug-id" value="">
                    <div class="form-group">
                        <label class="col control-label text-left ">Drug:</label>
                        <div class="col">
                            <input disabled required class="form-control" placeholder="Price" id="drug-warehouse-name"
                                   name="drug-warehouse-name" type="text" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col control-label text-left ">Price:</label>
                        <div class="col">
                            <input required class="form-control" placeholder="Price" id="wa-drug-price"
                                   name="wa-drug-price" type="text" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col control-label text-left ">Expiry Date:</label>
                        <div class="col">
                            <input required class="form-control" placeholder="Expiry Date" id="drug-expiry-date"
                                   name="drug-expiry-date" type="date" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-8 control-label text-left "></label>
                        <div class="col-md-8">
                            <button type="button" id="link-drug" name="link-drug"
                                    class="btn btn-general btn-blue mr-2">Submit
                            </button>
                            <span></span>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>


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
            <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) { ?>
                <button id="add-drug" class="btn btn-info admin-add-btn">Add</i></button>
            <?php } ?>

        </div>
    </div>


    <?php if ($_SESSION['role_id'] == 2)
    { ?>
    <table id="table-drugs-admin" class="table table-hover table-striped m-1
" style="width:100%">
        <?php } else { ?>
        <table id="table-drugs" class="table table-hover table-striped m-1
" style="width:100%">
            <?php } ?>

            <thead class="bg-info text-white">
            <tr>
                <!--                <th>Id</th>-->

                <th>CommerceNameEn</th>
                <?php if ($_SESSION['role_id'] == 2) { ?>
                    <th>CommerceNameAr</th>
                <?php } ?>

                <!--                <th>ScientificNameAr</th>-->
                <th>ScientificNameEn</th>
                <th>Manufacture</th>
                <th>Strengths</th>
                <!--                <th>Price</th>-->
                <th>Category</th>
                <th>Form</th>
                <!--                <th>Icon</th>-->
                <th>Actions</th>


            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
</div>
