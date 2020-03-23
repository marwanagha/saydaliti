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

    $respons = api_post('DrugsAdmin/DrugDetails', array('Id' => $id));
//    var_dump($respons);exit();
    if($respons->code==1)
    {
        $respons=$respons->data;


    }
    else
    {
       general_error('drug-list');
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
                <h3><i class="fa fa-archive"></i> Drug Info</h3>
            </div>
            <br>
            <form style="margin: auto;" action="<?php if (!isset($respons)) echo 'requests/drugs-management.php'; else echo '../requests/drugs-management.php' ?>"
                  enctype="multipart/form-data"
                  method="post"
                  class="form-horizontal  col-8 ">
                <input name="drug-id" type="hidden" value="<?php if (isset($id)) echo $id?>">
                <div class="form-group">
                    <label class="col-lg-8 control-label text-left ">Commerce Name Arabic: </label>
                    <div class="col-lg-8">
                        <input value="<?php echo isset($respons->CommerceNameAr) ? $respons->CommerceNameAr : null ?>"
                               required
                               class="form-control" placeholder="Commerce Name Arabic" name="CommerceNameAr" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-8 control-label text-left ">Commerce Name English:</label>
                    <div class="col-lg-8">
                        <input required class="form-control" name="CommerceNameEn" placeholder="Commerce Name English" type="text"
                               value="<?php echo isset($respons->CommerceNameEn) ? $respons->CommerceNameEn : null ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-8 control-label text-left ">Scientific Name Arabic: </label>
                    <div class="col-lg-8">
                        <input required class="form-control" name="ScientificNameAr" placeholder="Scientific Name Arabic"
                               type="text"
                               value="<?php echo isset($respons->ScientificNameAr) ? $respons->ScientificNameAr : null ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-8 control-label text-left ">Scientific Name English:</label>
                    <div class="col-lg-8">
                        <textarea class="form-control" name="ScientificNameEn" placeholder="Scientific Name English" type="text"
                        ><?php echo isset($respons->ScientificNameEn) ? $respons->ScientificNameEn : null ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-8 control-label text-left ">Strengths:</label>
                    <div class="col-lg-8">
                        <textarea class="form-control" name="Strengths" type="text" placeholder="Strengths"
                        ><?php echo isset($respons->Strengths) ? $respons->Strengths: null ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-8 control-label text-left ">Price:</label>
                    <div class="col-lg-8">
                        <textarea class="form-control" name="Price" type="text" placeholder="Price"
                        ><?php echo isset($respons->Price) ? $respons->Price : null ?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-8 control-label text-left ">Category:</label>
                    <div class="col-lg-8">
                        <select required name="category-select" id="category-select" class="selectpicker"
                                menuPlacement="top">
                            <?php if (isset($respons->CategoryId)) {


                                if ($_SESSION['lang'] == 'en')
                                    $catname = $respons->Category;
                                else $catname =$respons->Category;

                                echo '<option value="' . $respons->CategoryId . '" >' . $catname . '</option>';
                            } else {
                                echo '<option value="-1" selected>please choose</option>';
                            } ?>
                        </select>
                    </div>
                </div>
                <input id="cat-id" type="hidden"
                       value="<?php if (isset($respons->CategoryId)) echo $respons->CategoryId ?>">
                <div class="form-group">
                    <label class="col-md-8 control-label text-left ">Manufacture:</label>
                    <div class="col-lg-8">
                        <select required name="manufacture-select"  id="manufacture-select"
                                class="selectpicker">
                            <?php if (isset($respons->ManufactureId)) {
                                if ($_SESSION['lang'] == 'en')
                                    $subname = $respons->Manufacture;
                                else $subname = $respons->Manufacture;

                                echo '<option value="' . $respons->ManufactureId . '" >' . $subname . '</option>';
                            } else {
                                echo '<option value="-1" selected>please choose</option>';
                            } ?>
                        </select>
                    </div>
                </div>
                <input id="man-id" type="hidden"
                       value="<?php if (isset($respons->ManufactureId)) echo $respons->ManufactureId ?>">

                <div class="form-group">
                    <label class="col-md-8 control-label text-left ">Thumbnail:</label>
                    <div class="col-md-8">
                        <input <?php if ($id == null) echo 'required'; ?> type="file" class="form-control"
                                                                          name="Icon" accept="image/*">
                        <input name="old-img" type="hidden" value="<?php if (isset($respons->Icon)) echo $respons->Icon ?>">

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-8 control-label text-left "></label>
                    <div class="col-md-8">
                        <button type="submit" <?php if (isset($respons)) echo 'id="edit-drug" name="edit-drug"'; else echo 'id="add-drug" name="add-drug"'; ?>
                                class="btn btn-general btn-blue mr-2">Submit
                        </button>
                        <span></span>
                    </div>
                </div>
            </form>

        </div>

    </div>

</div>



