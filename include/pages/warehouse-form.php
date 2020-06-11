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


//$respons_drugs = api_post('Listing/GetDrugsList', '');


$path = '../';
$id = isset($_GET['id']) ? make_safe($_GET['id']) : null;

if ($id) {

    $respons = api_post('WarehousesAdmin/GetWarehouseDetails', array('Id' => $id));
//    var_dump($respons);exit();
    if ($respons->code == 1) {
        $respons = $respons->data;

//        $selected_drugs_array = array();
//
//        if (isset($respons->Drugs)) {
//
//            foreach ($respons->Drugs as $drug) {
//
//                array_push($selected_drugs_array, $drug->Id);
//
//            }
//        }

    } else {
        general_error('warehouses-list');
    }

}


?>


<div id="confirm-modal-credentials-warehouse" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div align="center" class="modal-content" style="margin-top: 100px">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Are You Sure?</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post" class="form-horizontal  col ">
                    <div class="form-group">
                        <label class="col control-label text-left ">Username:</label>
                        <div class="col">
                            <input id="username_conf" required class="form-control" name="" type="text" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col control-label text-left ">Password:</label>
                        <div class="col">
                            <input id="password_conf" required class="form-control" name="" type="text" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-8 control-label text-left "></label>
                        <div class="col-md-8">
                            <button type="submit" id="" name=""
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


<div class="content-inner chart-cont">

    <div class="col personal-info " align="center">
        <!--                <div class="alert alert-info alert-dismissable">-->
        <!--                    <a class="panel-close close" data-dismiss="alert">×</a>-->
        <!--                    <i class="fa fa-coffee"></i>-->
        <!--                    This is an <strong>.alert</strong>. Use this to show important messages to the user.-->
        <!--                </div>-->
        <div class="card form" id="form1">
            <div class="card-header">
                <h3><i class="fa fa-archive"></i> Warehouse Info</h3>
            </div>
            <br>

            <form id="warehouse-form" style="margin: auto; width: -webkit-fill-available;"
                  action="<?php if (!isset($respons)) echo 'requests/warehouses-management.php';
                  else echo '../requests/warehouses-management.php' ?>"
                  enctype="multipart/form-data"
                  method="post"
                  class="form-horizontal ">
                <div class="col-8">
                    <input name="id" type="hidden" value="<?php if (isset($id)) echo $id ?>">
                    <div class="form-group">
                        <label class="col-lg-8 control-label text-left ">Name: </label>
                        <div class="col-lg-8">
                            <input value="<?php echo isset($respons->Name) ? $respons->Name : null ?>"
                                   required
                                   class="form-control" placeholder="Name" name="Name" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-8 control-label text-left ">Username: </label>
                        <div class="col-lg-8">
                            <input required class="form-control" name="Username" placeholder="Username" type="text"
                                   value="<?php echo isset($respons->Username) ? $respons->Username : 'user' . generatePIN() ?>">
                        </div>
                    </div>
                        <div class="form-group">
                            <label class="col-lg-8 control-label text-left ">Password: </label>
                            <div class="col-lg-8">
                                <input <?php if(!isset($id)) echo 'required' ?> class="form-control" name="Password" placeholder="Reset Password" type="text"
                                       value="<?php if(!isset($id)) echo randomPassword() ?>">
                            </div>
                        </div>
                    <div class="form-group">
                        <label class="col-lg-8 control-label text-left ">Address: </label>
                        <div class="col-lg-8">
                            <input required class="form-control" name="Address" placeholder="Address" type="text"
                                   value="<?php echo isset($respons->Address) ? $respons->Address : null ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-8 control-label text-left ">Longitude: </label>
                        <div class="col-lg-8">
                            <input required class="form-control" name="Longitude" placeholder="Longitude"
                                   type="number"
                                   value="<?php echo isset($respons->Longitude) ? $respons->Longitude : null ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-8 control-label text-left ">Latitude: </label>
                        <div class="col-lg-8">
                            <input required class="form-control" name="Latitude" placeholder="Latitude"
                                   type="number"
                                   value="<?php echo isset($respons->Latitude) ? $respons->Latitude : null ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-8 control-label text-left ">Phones: </label>
                        <div class="col-lg-8">
                        <textarea required class="form-control" name="Phones" type="text" placeholder="Phones"
                        ><?php echo isset($respons->Phones) ? $respons->Phones : null ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-8 control-label text-left ">City: </label>
                        <div class="col-lg-8">
                            <select required name="city-select" id="city-select" class="selectpicker"
                                    menuPlacement="top">
                                <?php if (isset($respons->CityId)) {


                                    if ($_SESSION['lang'] == 'en')
                                        $cityname = $respons->City;
                                    else $cityname = $respons->City;

                                    echo '<option value="' . $respons->CityId . '" >' . $cityname . '</option>';
                                } else {
                                    echo '<option value="-1" selected>please choose</option>';
                                } ?>
                            </select>
                        </div>
                    </div>
                    <span class="text-danger hidden" id="city-error">You Have to select city</span>
                    <input id="city-id" type="hidden"
                           value="<?php if (isset($respons->CityId)) echo $respons->CityId ?>">

                    <div class="form-group">
                        <label class="col-md-8 control-label text-left ">Type: </label>
                        <div class="col-lg-8">
                            <select required name="SubscriptionType-select" id="SubscriptionType-select"
                                    class="selectpicker"
                                    menuPlacement="top">
                                <?php if (isset($respons->SubscriptionType)) {

                                    if ($respons->SubscriptionType == 1) {
                                        $SubscriptionName = 'Commission';
                                    } else {
                                        $SubscriptionName = 'Subscription';
                                    }

                                    echo '<option value="' . $respons->SubscriptionType . '" >' . $SubscriptionName . '</option>';
                                } else {
                                    echo '<option value="-1" selected>please choose</option>';
                                    echo '<option value="1" >Commission</option>';
                                    echo '<option value="2" >Subscription</option>';
                                } ?>
                            </select>
                        </div>
                    </div>
                    <span class="text-danger hidden" id="warehouse-type-error">You Have to select type</span>
                    <div id="profit-cont"
                         class="form-group <?php if (!isset($respons->SubscriptionType)) echo 'hidden'; ?>">
                        <label class="col-lg-8 control-label text-left ">Profit: </label>
                        <div class="col-lg-8">
                            <input  class="form-control" id="profit-warehouse" name="profit"
                                   placeholder="Profit"
                                   type="number"
                                   value="<?php echo isset($respons->SubscriptionPrice) ? $respons->SubscriptionPrice : null ?>">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-8 control-label text-left "></label>
                        <div class="col-md-8">
                            <button type="submit" <?php if (isset($respons)) echo 'id="edit-warehouse-submit" name="edit-warehouse"';
                            else echo 'id="add-warehouse-submit" name="add-warehouse"'; ?>
                                    class="btn btn-general btn-blue mr-2">Submit
                            </button>
                            <span></span>
                        </div>
                    </div>
                </div>
<!--                <div class="col-4 drugs-list">-->
<!--                    <div><h4 class="text-left">Drugs List</h4></div>-->
<!--                    <div>-->
<!--                        <hr/>-->
<!--                    </div>-->
<!--                    --><?php
//
//                    if (isset($respons_drugs->code) && $respons_drugs->code == 1) {
//
//                        if (!empty($selected_drugs_array)) {
//
//                            foreach ($respons_drugs->data->dropDownListItems as $drug) {
//
//                                if (in_array($drug->id, $selected_drugs_array)) {
//
//                                    $checked = 'checked';
//                                } else {
//                                    $checked = '';
//                                }
//
//                                ?>
<!---->
<!--                                <div class="mb-1 text-left"><input type="checkbox" name="drugs[]" --><?php //echo $checked ?>
<!--                                                                   value="--><?php //echo $drug->id ?><!--"><span-->
<!--                                            class="ml-1">--><?php //echo $drug->Name ?><!--</span></div>-->
<!---->
<!--                                --><?php
//
//
//                            }
//
//                        } else {
//
//                            foreach ($respons_drugs->data->dropDownListItems as $drug) {
//
//                                ?>
<!---->
<!--                                <div class="mb-1 text-left"><input type="checkbox" name="drugs[]"-->
<!--                                                                   value="--><?php //echo $drug->id ?><!--"><span-->
<!--                                            class="ml-1">--><?php //echo $drug->Name ?><!--</span></div>-->
<!---->
<!--                                --><?php
//
//
//                            }
//                        }
//
//
//                    } else {
//                        general_error('warehouses-list');
//                    }
//                    ?>
<!--                </div>-->

            </form>


        </div>

    </div>

</div>



