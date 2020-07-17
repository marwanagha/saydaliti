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

if ($id) {

    $respons = api_post('PharmacistsAdmin/GetPharmacistDetails', array('Id' => $id));
//    var_dump($respons);exit();
    if ($respons->code == 1) {
        $respons = $respons->data;
//var_dump($respons);

    } else {
        general_error('../pharmacies-list');
    }

}


?>

<div id="confirm-modal-approve-pharmacy" class="modal fade" role="dialog">
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
                        <button id="yes-approve-pharmacy" type="button" class="btn btn-info btn" data-dismiss="modal">
                            Yes
                        </button>
                    </div>
                    <div class="col">
                        <button id="no-approve-pharmacy" type="button" class="btn btn-info btn" data-dismiss="modal">No
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<div id="confirm-modal-reject-pharmacy" class="modal fade" role="dialog">
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
                        <button id="yes-reject-pharmacy" type="button" class="btn btn-info btn" data-dismiss="modal">
                            Yes
                        </button>
                    </div>
                    <div class="col">
                        <button id="no-reject-pharmacy" type="button" class="btn btn-info btn" data-dismiss="modal">No
                        </button>
                    </div>
                </div>
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
                <h3><i class="fa fa-archive"></i> Pharmacy Info</h3>
            </div>
            <br>
            <form id="pharma-form" style="margin: auto;"
                  action="<?php if (!isset($respons)) echo 'requests/pharmacies-management.php'; else echo '../requests/pharmacies-management.php' ?>"
                  enctype="multipart/form-data"
                  method="post"
                  class="form-horizontal  col-8 ">
                <input name="pharmacy-id" type="hidden" value="<?php if (isset($id)) echo $id ?>">
                <input name="status" type="hidden" value="<?php if (isset($respons->Status)) echo $respons->Status ?>">
                <div class="form-group">
                    <label class="col-lg-8 control-label text-left ">Pharmacy Name: </label>
                    <div class="col-lg-8">
                        <input value="<?php echo isset($respons->PharmacyName) ? $respons->PharmacyName : null ?>"
                               required
                               class="form-control" placeholder="Pharmacy Name" name="PharmacyName" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-8 control-label text-left ">Pharmacist Name: </label>
                    <div class="col-lg-8">
                        <input required class="form-control" name="PharmacistName" placeholder="Pharmacist Name"
                               type="text"
                               value="<?php echo isset($respons->PharmacistName) ? $respons->PharmacistName : null ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-8 control-label text-left ">License Number:</label>
                    <div class="col-lg-8">
                        <input required class="form-control" name="LicenseNumber" placeholder="License Number"
                               type="number"
                               value="<?php echo isset($respons->LicenseNumber) ? $respons->LicenseNumber : null ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-8 control-label text-left "> </label>
                    <div class="col-lg-8">

                        <?php if (isset($respons->Status) && $respons->Status == 2) { ?>


                            <div class="btn-group btn-group-toggle" data-toggle="buttons"><label
                                        class="btn btn-info "><input checked="" type="radio" name="options"
                                                                     data-id="<?php echo $id ?>"
                                                                     class="approve-pharmacy" autocomplete="off">
                                    Approve
                                </label><label style="min-width: 77px;" class="btn btn-info "><input type="radio"
                                                                                                     name="options"
                                                                                                     data-id="<?php echo $id ?>"
                                                                                                     class="reject-pharmacy"
                                                                                                     autocomplete="off">
                                    Reject </label>
                            </div>

                        <?php } else if (isset($respons->Status) && $respons->Status == 1) { ?>

                            <span style="font-size: 18px;" class="badge badge-pill badge-success">Approved</span>


                        <?php } else if (isset($respons->Status) && $respons->Status == 0) { ?>


                            <span class="badge badge-pill badge-danger">Rejected</span>

                        <?php } else if (isset($respons->Status) && $respons->Status == 4) { ?>


                            <span class="badge badge-pill badge-primary">Admin</span>

                        <?php } ?>

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
                    <label class="col-lg-8 control-label text-left ">Address: </label>
                    <div class="col-lg-8">
                        <textarea class="form-control" name="Address" type="text" placeholder="Address"
                        ><?php echo isset($respons->Address) ? $respons->Address : null ?></textarea>
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
                        <input required class="form-control" name="Latidute" placeholder="Latitude"
                               type="number"
                               value="<?php echo isset($respons->Latidute) ? $respons->Latidute : null ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-8 control-label text-left ">Working Hours: </label>
                    <div class="col-lg-8">
                        <textarea class="form-control" name="WorkingHours" type="text" placeholder="Working Hours"
                        ><?php echo isset($respons->WorkingHours) ? $respons->WorkingHours : null ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-8 control-label text-left ">Phone: </label>
                    <div class="col-lg-8">
                        <input required class="form-control" name="phone" placeholder="Phone"
                               type="number"
                               value="<?php echo isset($respons->Phone) ? $respons->Phone : null ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-8 control-label text-left ">Mobile Number: </label>
                    <div class="col-lg-8">
                        <input required class="form-control" name="mobile" placeholder="Mobile Number"
                               type="number"
                               value="<?php echo isset($respons->Mobile) ? $respons->Mobile : null ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-8 control-label text-left ">Syndicate Number: </label>
                    <div class="col-lg-8">
                        <input required class="form-control" name="SyndicateNumber" placeholder="Syndicate Number"
                               type="number"
                               value="<?php echo isset($respons->SyndicateNumber) ? $respons->SyndicateNumber : null ?>">
                    </div>
                </div>
                <?php if (isset($id)) { ?>
                    <div class="form-group">
                        <label class="col-lg-8 control-label text-left ">Syndicate Photo File: </label>
                        <div class="col-lg-8">
                            <a href="<?php echo $FILES_ROOT . 'images/pharmacies/large/'; ?><?php echo isset($respons->SyndicateIdPhoto) ? $respons->SyndicateIdPhoto : 'test' ?>">Download
                                File</a>

                        </div>
                    </div>
                <?php } ?>


                <div class="form-group">
                    <label class="col-md-8 control-label text-left ">Syndicate Photo:</label>
                    <div class="col-md-8">
                        <input  <?php if ($id == null) echo ''; ?> type="file" class="form-control"
                                                                          name="SyndicateIdPhoto" accept="image/*">
                        <input  name="old-img-SyndicateIdPhoto" type="hidden"
                               value="<?php if (isset($respons->SyndicateIdPhoto)) echo $respons->SyndicateIdPhoto ?>">

                    </div>
                </div>
                <?php if (isset($id)) { ?>
                    <div class="form-group">
                        <label class="col-lg-8 control-label text-left ">Pharmacy Photo File: </label>
                        <div class="col-lg-8">
                            <a href="<?php echo $FILES_ROOT . 'images/pharmacies/large/'; ?><?php echo isset($respons->PharmacyPhoto) ? $respons->PharmacyPhoto : 'test' ?>">Download
                                File</a>

                        </div>
                    </div>
                <?php } ?>

                <div class="form-group">
                    <label class="col-md-8 control-label text-left ">Pharmacy Photo:</label>
                    <div class="col-md-8">
                        <input <?php if ($id == null) echo ''; ?> type="file" class="form-control"
                                                                          name="PharmacyPhoto" accept="image/*">
                        <input  name="old-img-PharmacyPhoto" type="hidden"
                               value="<?php if (isset($respons->PharmacyPhoto)) echo $respons->PharmacyPhoto ?>">

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-8 control-label text-left "></label>
                    <div class="col-md-8">
                        <button type="submit" <?php if (isset($respons)) echo 'id="edit-pharmacy-submit" name="edit-pharmacy"'; else echo 'id="add-pharmacy-submit" name="add-pharmacy"'; ?>
                                class="btn btn-general btn-blue mr-2">Submit
                        </button>
                        <span></span>
                    </div>
                </div>
            </form>

        </div>

    </div>

</div>



