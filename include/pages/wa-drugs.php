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

<div id="confirm-modal-unlink-drug" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div align="center" class="modal-content" style="margin-top: 100px">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $lang['are_you_sure'] ?></h4>
            </div>
            <div class="modal-footer">
                <div class="row" style="margin: auto;">
                    <div class="col">
                        <button id="yes-unlink-drug" type="button" class="btn btn-info btn" data-dismiss="modal">
                            <?php echo $lang['yes'] ?>
                        </button>
                    </div>
                    <div class="col">
                        <button id="no-unlink-drug" type="button" class="btn btn-info btn" data-dismiss="modal"><?php echo $lang['no'] ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<div class="content-inner chart-cont">
    <div class="row">
        <div class="col-7"><h2 class="mb-5"><?php echo $lang['my_drugs_list'] ?></h2></div>
        <div class="col-5">

        </div>
    </div>


    <table id="table-my-drugs-admin" class="table table-hover table-striped m-1 " style="width:100%">
        <thead class="bg-info text-white">
        <tr>
            <!--            <th>Id</th>-->
            <th><?php echo $lang['commerceNameEn'] ?></th>
            <th><?php echo $lang['commerceNameAr'] ?></th>
            <!--            <th>ScientificNameAr</th>-->
            <th><?php echo $lang['scientificNameEn'] ?></th>
            <th><?php echo $lang['manufacturer'] ?></th>
            <th><?php echo $lang['strengths'] ?></th>
            <th><?php echo $lang['category'] ?></th>
            <th><?php echo $lang['g_price'] ?></th>
            <th><?php echo $lang['p_price'] ?></th>
            <!--            <th>Price</th>-->

            <th><?php echo $lang['form'] ?></th>
            <!--            <th>Icon</th>-->
            <th><?php echo $lang['actions'] ?></th>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
