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
                <h4 class="modal-title"> <?php  echo $lang['add_to_my_drugs']  ?> </h4>
            </div>
            <div class="modal-body">
                <div class="form-horizontal  col ">
                    <input type="hidden" id="warehouse-drug-id" name="warehouse-drug-id" value="">
                    <div class="form-group">
                        <label class="col control-label text-left "><?php  echo $lang['drug']  ?>:</label>
                        <div class="col">
                            <input disabled required class="form-control" placeholder="<?php  echo $lang['drug']  ?>" id="drug-warehouse-name"
                                   name="drug-warehouse-name" type="text" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col control-label text-left "><?php  echo $lang['g_price']  ?>:</label>
                        <div class="col">
                            <input required class="form-control" placeholder="Price" id="wa-drug-price"
                                   name="wa-drug-price" type="text" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col control-label text-left "><?php  echo $lang['p_price']  ?>:</label>
                        <div class="col">
                            <input required class="form-control" placeholder="<?php  echo $lang['p_price']  ?>" id="wa-drug-second-price"
                                   name="wa-drug-second-price" type="text" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col control-label text-left "><?php  echo $lang['expiry_date']  ?>:</label>
                        <div class="col">
                            <input required class="form-control" placeholder="<?php  echo $lang['expiry_date']  ?>" id="drug-expiry-date"
                                   name="drug-expiry-date" type="date" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-8 control-label text-left "></label>
                        <div class="col-md-8">
                            <button type="button" id="link-drug" name="link-drug"
                                    class="btn btn-general btn-blue mr-2"><?php  echo $lang['submit']  ?>
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
        <div class="col-7"><h2 class="mb-5"><?php  echo $lang['drug_list']  ?></h2></div>
        <div class="col-5">
            <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) { ?>
                <button id="add-drug" class="btn btn-info admin-add-btn"><?php  echo $lang['add']  ?></i></button>
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

                <th><?php echo $lang['commerceNameEn'] ?></th>
                <?php if ($_SESSION['role_id'] == 2) { ?>
                    <th><?php echo $lang['commerceNameAr'] ?></th>
                <?php } ?>

                <!--                <th>ScientificNameAr</th>-->
                <th><?php echo $lang['scientificNameEn'] ?></th>
                <th><?php echo $lang['manufacturer'] ?></th>
                <th><?php echo $lang['strengths'] ?></th>
                <!--                <th>Price</th>-->
                <th><?php echo $lang['category'] ?></th>
                <th><?php echo $lang['form'] ?></th>
                <!--                <th>Icon</th>-->
                <th><?php echo $lang['actions'] ?></th>


            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
</div>
