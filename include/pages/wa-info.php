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




$path = '../';
$id = isset($_GET['id']) ? make_safe($_GET['id']) : 1;



    $respons = api_post('WarehousesAdmin/GetMyWarehouseDetails', $_POST);

    if ($respons->code == 1) {
        $respons = $respons->data;


    } else {
        general_error('orders-list');
    }




?>





<div class="content-inner chart-cont">

    <div class="col personal-info " align="center">
        <!--                <div class="alert alert-info alert-dismissable">-->
        <!--                    <a class="panel-close close" data-dismiss="alert">×</a>-->
        <!--                    <i class="fa fa-coffee"></i>-->
        <!--                    This is an <strong>.alert</strong>. Use this to show important messages to the user.-->
        <!--                </div>-->
        <div class="card form" id="form1">
            <div class="card-header">
                <h3><i class="fa fa-archive"></i><?php  echo $lang['warehouse_info']  ?></h3>
            </div>
            <br>

            <form id="warehouse-form" style="margin: auto; width: -webkit-fill-available;"
                  action="<?php  echo 'requests/warehouses-management.php'; ?>"
                  enctype="multipart/form-data"
                  method="post"
                  class="form-horizontal  ">
                <div class="col-8">
                    <input name="id" type="hidden" value="<?php if (isset($id)) echo $id ?>">
                    <div class="form-group">
                        <label class="col-lg-8 control-label text-left "><?php  echo $lang['min_order_price']  ?>: </label>
                        <div class="col-lg-8">
                            <input value="<?php echo isset($respons->MinOrderValue) ? $respons->MinOrderValue : null ?>"
                                   required
                                   class="form-control" placeholder="<?php  echo $lang['min_order_price']  ?>" name="MinOrderValue" type="number">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-8 control-label text-left "><?php  echo $lang['delivery']  ?>: </label>
                        <div class="col-lg-8">
                            <select required name="delivery-select" id="delivery-select"
                                    class="selectpicker"
                                    menuPlacement="top">
                                <?php if (isset($respons->DeliveryStatus)) {

                                    if ($respons->DeliveryStatus == 0) {
                                        $flag = $lang['no'];
                                    } else {
                                        $flag = $lang['yes'];
                                    }

                                    echo '<option value="' . $respons->DeliveryStatus . '" >' . $flag . '</option>';
                                } else {
                                    echo '<option value="-1" selected>'.$lang['please_choose'].'</option>';
                                    echo '<option value="0" >'.$lang['no'].'</option>';
                                    echo '<option value="1" >'.$lang['yes'].'</option>';
                                } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-8 control-label text-left "></label>
                        <div class="col-md-8">
                            <button type="submit" id="edit-wa-info" name="edit-wa-info" class="btn btn-general btn-blue mr-2"><?php  echo $lang['submit']  ?>
                            </button>
                            <span></span>
                        </div>
                    </div>
                </div>


            </form>


        </div>

    </div>

</div>



