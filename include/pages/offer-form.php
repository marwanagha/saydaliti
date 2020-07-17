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

$id = isset($_GET['id']) ? make_safe($_GET['id']) : null;
//type 1 => drug type 2 =>offer
$type = "";
$drug_id = "";
if ($id && strpos($id, 'D') === false) {
    $type = 2;

    $respons = api_post('OffersAdmin/GetOfferDetails', array('Id' => $id));

    if ($respons->code == 1) {
        $respons = $respons->data;
        $newDate = date("d/m/Y", strtotime($respons->CreateDate));
        $create_date = date_create($respons->CreateDate);
        $expiry_date = date_create($respons->ExpiryDate);


    } else {

        general_error('../offers-list');
    }


} else {

    $type = 1;
    $drug_id = substr($id, 1);
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
                <h3><i class="fa fa-archive"></i><?php echo $lang['offer_form'] ?></h3>
            </div>
            <br>
            <form style="margin: auto;"
                  action="<?php echo '../requests/offers-management.php' ?>"
                  enctype="multipart/form-data"
                  method="post"
                  class="form-horizontal  col-8 ">
                <input name="offer-id" type="hidden" value="<?php if (isset($type) && $type == 2) echo $id; ?>">
                <input name="drug-id" type="hidden"
                       value="<?php if (isset($respons->DurgId)) echo $respons->DurgId; else echo $drug_id; ?>">

                <div class="form-group">
                    <label class="col-lg-8 control-label text-left "><?php echo $lang['drug'] ?>: </label>
                    <div class="col-lg-8">
                        <input <?php echo 'disabled'; ?>
                                value="<?php echo isset($respons->Durg) ? $respons->Durg : null ?>"
                                required

                                class="form-control" placeholder="<?php echo $lang['drug'] ?>" <?php if ($type == 1) {
                            echo 'id="drug-offer-name"';
                        } ?> name="Drug" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-8 control-label text-left "><?php echo $lang['description'] ?> :</label>
                    <div class="col-lg-8">
                        <input <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) {
                            echo 'disabled';
                        } ?>
                                value="<?php echo isset($respons->Description) ? $respons->Description : null ?>"
                                required
                                class="form-control" placeholder="<?php echo $lang['description'] ?>" name="Description" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-8 control-label text-left "><?php echo $lang['g_price'] ?> :</label>
                    <div class="col-lg-8">
                        <input <?php echo 'disabled'; ?>
                                value="<?php echo isset($respons->NormalPrice) ? $respons->NormalPrice : null ?>"
                                required
                                class="form-control" placeholder="<?php echo $lang['g_price'] ?>" <?php if ($type == 1) {
                            echo 'id="drug-offer-price"';
                        } ?> name="NormalPrice" type="number">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-8 control-label text-left "><?php echo $lang['p_price'] ?> :</label>
                    <div class="col-lg-8">
                        <input <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) {
                            echo 'disabled';
                        } ?>
                                value="<?php echo isset($respons->Price) ? $respons->Price : null ?>"
                                required
                                class="form-control" placeholder="<?php echo $lang['p_price'] ?>" name="Price" type="number">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-8 control-label text-left "><?php echo $lang['quantity'] ?> :</label>
                    <div class="col-lg-8">
                        <input <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) {
                            echo 'disabled';
                        } ?>
                                value="<?php echo isset($respons->Quantity) ? $respons->Quantity : null ?>"
                                required
                                class="form-control" placeholder="<?php echo $lang['quantity'] ?>" name="Quantity" type="number">
                    </div>
                </div>

                <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) { ?>
                    <div class="form-group">
                        <label class="col-lg-8 control-label text-left "><?php echo $lang['warehouse'] ?> :</label>
                        <div class="col-lg-8">
                            <input <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) {
                                echo 'disabled';
                            } ?>
                                    value="<?php echo isset($respons->Warehouse) ? $respons->Warehouse : null ?>"

                                    class="form-control" placeholder="<?php echo $lang['warehouse'] ?>" name="Warehouse" type="text">
                        </div>
                    </div>
                <?php } ?>
                <?php if ($type == 2) { ?>
                    <div class="form-group">
                        <label class="col-lg-8 control-label text-left "><?php echo $lang['create_date'] ?> :</label>
                        <div class="col-lg-8">
                            <input disabled <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) {
                                echo 'disabled';
                            } ?>
                                    value="<?php echo isset($respons->CreateDate) ? date_format($create_date, "Y-m-d") : null ?>"

                                    class="form-control" placeholder="<?php echo $lang['create_date'] ?> " name="CreateDate" type="date">
                        </div>
                    </div>
                <?php } ?>

                <div class="form-group">
                    <label class="col-lg-8 control-label text-left "><?php echo $lang['gift'] ?> :</label>
                    <div class="col-lg-8">
                        <input  <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) {
                            echo 'disabled';
                        } ?>
                                value="<?php echo isset($respons->Gift) ? $respons->Gift : null ?>"

                                class="form-control" placeholder="<?php echo $lang['gift'] ?>" name="Gift" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-8 control-label text-left "><?php echo $lang['discount'] ?> :</label>
                    <div class="col-lg-8">
                        <input  <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) {
                            echo 'disabled';
                        } ?>
                                value="<?php echo isset($respons->Discount) ? $respons->Discount : null ?>"

                                class="form-control" placeholder="<?php echo $lang['discount'] ?>" name="Discount" type="number">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-8 control-label text-left "><?php echo $lang['notes'] ?> :</label>
                    <div class="col-lg-8">
                        <input <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) {
                            echo 'disabled';
                        } ?>
                                value="<?php echo isset($respons->Notes) ? $respons->Notes : null ?>"

                                class="form-control" placeholder="<?php echo $lang['notes'] ?>" name="Notes" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-8 control-label text-left "><?php echo $lang['expiry_date'] ?> :</label>
                    <div class="col-lg-8">
                        <input <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) {
                            echo 'disabled';
                        } ?>
                                value="<?php echo isset($respons->ExpiryDate) ? date_format($create_date, "Y-m-d") : null ?>"
                                required
                                class="form-control" placeholder="<?php echo $lang['expiry_date'] ?>" name="ExpiryDate" type="date">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-8 control-label text-left "><?php echo $lang['total_price'] ?> :</label>
                    <div class="col-lg-8">
                        <input disabled <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) {
                            echo 'disabled';
                        } ?>
                                value="<?php echo isset($respons->TotalPrice) ? $respons->TotalPrice : null ?>"
                                required
                                class="form-control" placeholder="<?php echo $lang['total_price'] ?>" name="TotalPrice" type="number">
                    </div>
                </div>

                <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 2) { ?>
                    <div class="form-group">
                        <label class="col-md-8 control-label text-left "></label>
                        <div class="col-md-8">
                            <button type="submit" <?php if (isset($respons)) echo 'id="edit-offer" name="edit-offer"'; else echo 'id="add-offer" name="add-offer"'; ?>
                                    class="btn btn-general btn-blue mr-2"><?php echo $lang['submit'] ?>
                            </button>
                            <span></span>
                        </div>
                    </div>
                <?php } ?>
            </form>

        </div>

    </div>

</div>



