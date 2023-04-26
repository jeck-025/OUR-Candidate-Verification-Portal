<div class="modal fade" id="edit-campus" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Campus</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="updatecampus" action="" method="POST">

                        <div class="input-group col-md-12">
                            <select id="campus" name="campus" class="selectpicker form-control" title="Select Campus">
                                <?php $view->campuses(); ?>
                            </select>
                        </div>
                        <div class="modal-footer mt-3">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <input type=hidden id="id" value="">
                            <input type="hidden" name="Token" value="<?php echo Token::generate(); ?>" />
                            <button type="submit" id="update-btn" class="btn btn-info">Save</button>

                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>


    <div class="modal fade" id="verify-degree" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Verified Degree</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="verifydegree" action="" method="POST">

                        <div class="input-group col-md-12">
                            <select id="vfdegree" name="vfdegree" class="selectpicker form-control" title="Select Course">
                                <?php $view->courses(); ?>
                            </select>
                        </div>
                        <div class="modal-footer mt-3">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <input type=hidden id="id" value="">
                            <input type="hidden" name="Token" value="<?php echo Token::generate(); ?>" />
                            <button type="submit" id="update-btn" class="btn btn-info">Save</button>

                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>