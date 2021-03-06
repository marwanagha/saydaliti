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


<div id="category-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div align="center" class="modal-content" style="margin-top: 100px">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Category</h4>
            </div>
            <div class="modal-body">
                <form action="requests/categories-management.php" method="post" class="form-horizontal  col ">
                    <div class="form-group">
                        <label class="col control-label text-left ">Category Arabic Name:</label>
                        <div class="col">
                            <input required class="form-control" name="category-name-ar" type="text" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col control-label text-left ">Category English Name:</label>
                        <div class="col">
                            <input required class="form-control" name="category-name-en" type="text" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-8 control-label text-left "></label>
                        <div class="col-md-8">
                            <button type="submit" id="add-cat" name="add-cat"
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

<div id="confirm-modal-cat-status" class="modal fade" role="dialog">
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
                        <button id="yes-status-cat" type="button" class="btn btn-info btn" data-dismiss="modal">Yes
                        </button>
                    </div>
                    <div class="col">
                        <button id="no-status-cat" type="button" class="btn btn-info btn" data-dismiss="modal">No
                        </button>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<div id="confirm-modal-delete-cat" class="modal fade" role="dialog">
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
                        <button id="yes-delete-category" type="button" class="btn btn-info btn" data-dismiss="modal">
                            Yes
                        </button>
                    </div>
                    <div class="col">
                        <button id="no-delete-category" type="button" class="btn btn-info btn" data-dismiss="modal">No
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>




<div class="content-inner chart-cont">


    <div class="row">
        <div class="col-7"><h2 class="mb-5">Categories Listing</h2></div>
        <div class="col-5">
            <button id="add-category" class="btn btn-info admin-add-btn">Add</i></button>
        </div>
    </div>
    <table id="table-categories" class="table table-hover table-striped m-1
" style="width:100%">
        <thead class="bg-info text-white">
        <tr>
<!--            <th>Id</th>-->
            <th>Name Ar</th>
            <th>Name En</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>

