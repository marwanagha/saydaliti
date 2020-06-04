<?php

if (isset($_SESSION['error_msg']) && !empty($_SESSION['error_msg']) && isset($_SESSION['msg_type'])) {
    if($_SESSION['msg_type']==1)
        echo '<input id="error-msg" data-type="success"  type="hidden" value="'.$_SESSION['error_msg'].'">';
    else if($_SESSION['msg_type']==-1)
        echo '<input id="error-msg" data-type="error"  type="hidden" value="'.$_SESSION['error_msg'].'">';
    else
        echo '<input id="error-msg" data-type="warn"  type="hidden" value="'.$_SESSION['error_msg'].'">';
    $_SESSION['error_msg'] = '';
    $_SESSION['msg_type'] = '';

}



$sq = "'";
$path = '../';

?>


<!--<div id="ad-modal" class="modal fade" role="dialog">-->
<!--    <div class="modal-dialog">-->
<!--         Modal content-->
<!--        <div align="center" class="modal-content" style="margin-top: 100px">-->
<!--            <div class="modal-header">-->
<!--                <button type="button" class="close" data-dismiss="modal">&times;</button>-->
<!--                <h4 class="modal-title">Add new Advertisement</h4>-->
<!--            </div>-->
<!--            <div class="modal-body">-->
<!--                <form action="requests/ads-management.php" method="post" class="form-horizontal  col ">-->
<!--                    <div class="form-group row ">-->
<!---->
<!--                        <label class="col-4 text-left">Type: </label>-->
<!--                        <select  required name="type-select" id="type-select" class="selectpicker col-8"-->
<!--                                 menuPlacement="top">-->
<!--                            <option value="-1" selected>please choose</option>-->
<!--                        </select>-->
<!--                        <input id="type-id" type="hidden"-->
<!--                               value="">-->
<!--                    </div>-->
<!--                    <div class="form-group offers-select-cont hidden row ">-->
<!--                        <label class="col-4 text-left">Offer: </label>-->
<!--                        <select  required name="offer-select" id="offer-select" class="selectpicker col-8 "-->
<!--                                 menuPlacement="top">-->
<!--                            <option value="-1" selected>please choose</option>-->
<!--                        </select>-->
<!--                        <input id="offer-id" type="hidden"-->
<!--                               value="">-->
<!--                    </div>-->
<!--                    <div class="form-group manufacturer-select-cont hidden row ">-->
<!--                        <label class="col-4 text-left">Manufacturer: </label>-->
<!--                        <select  required name="manufacture-select" id="manufacture-select" class="selectpicker col-8 "-->
<!--                                 menuPlacement="top">-->
<!--                            <option value="-1" selected>please choose</option>-->
<!--                        </select>-->
<!--                        <input id="man-id" type="hidden"-->
<!--                               value="">-->
<!--                    </div>-->
<!--                    <div class="form-group warehouse-select-cont hidden row">-->
<!--                        <label class="col-4 text-left">Warehouse: </label>-->
<!--                        <select  required name="warehouse-select" id="warehouse-select" class="selectpicker col-8 "-->
<!--                                 menuPlacement="top">-->
<!--                            <option value="-1" selected>please choose</option>-->
<!--                        </select>-->
<!--                        <input id="warehouse-id" type="hidden"-->
<!--                               value="">-->
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        <label class="col-md-8 control-label text-left "></label>-->
<!--                        <div class="col-md-8">-->
<!--                            <button type="submit" id="submit-ad" name="submit-ad"-->
<!--                                    class="btn btn-general btn-blue mr-2">Submit-->
<!--                            </button>-->
<!--                            <span></span>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </form>-->
<!---->
<!--            </div>-->
<!---->
<!--        </div>-->
<!---->
<!--    </div>-->
<!--</div>-->



<div id="confirm-modal-delete-ad" class="modal fade" role="dialog">
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
                        <button id="yes-delete-ad" type="button" class="btn btn-info btn" data-dismiss="modal">
                            Yes
                        </button>
                    </div>
                    <div class="col">
                        <button id="no-delete-ad" type="button" class="btn btn-info btn" data-dismiss="modal">No
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>




<div class="content-inner chart-cont">


    <div class="row">
        <div class="col-7"><h2 class="mb-5">Ads Listing</h2></div>
        <div class="col-5">

        </div>
    </div>
    <table id="table-ads" class="table table-hover table-striped m-1
" style="width:100%">
        <thead class="bg-info text-white">
        <tr>
<!--            <th>Id</th>-->
            <th>TypeName</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>

