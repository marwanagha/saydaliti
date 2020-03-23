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

    $respons = api_post('ManufacturesAdmin/GetManufactureDetails', array('Id' => $id));
//    var_dump($respons);exit();
    if ($respons->code == 1) {
        $respons = $respons->data;

    } else {
        general_error('manufacturers');
    }

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
                <h3><i class="fa fa-archive"></i> Manufacturer Info</h3>
            </div>
            <br>
            <form style="margin: auto;"
                  action="<?php if (!isset($respons)) echo 'requests/manufacturers-management.php';
                  else echo '../requests/manufacturers-management.php' ?>"
                  enctype="multipart/form-data"
                  method="post"
                  class="form-horizontal  col-8 ">
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
                        <input required class="form-control" name="Latidude" placeholder="Latidude"
                               type="number"
                               value="<?php echo isset($respons->Latidude) ? $respons->Latidude : null ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-8 control-label text-left ">Phones: </label>
                    <div class="col-lg-8">
                        <textarea class="form-control" name="Phones" type="text" placeholder="Phones"
                        ><?php echo isset($respons->Phones) ? $respons->Phones: null ?></textarea>
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
                <input id="city-id" type="hidden"
                       value="<?php if (isset($respons->CityId)) echo $respons->CityId ?>">

                <div class="form-group">
                    <label class="col-md-8 control-label text-left "></label>
                    <div class="col-md-8">
                        <button type="submit" <?php if (isset($respons)) echo 'id="edit-man" name="edit-man"';
                        else echo 'id="add-man" name="add-man"'; ?>
                                class="btn btn-general btn-blue mr-2">Submit
                        </button>
                        <span></span>
                    </div>
                </div>
            </form>

        </div>

    </div>

</div>



