<!-- Add -->
<div class="modal fade" id="addnewdeduct">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Add Deduction</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="deduction_add.php">
                    <div class="form-group">
                        <label for="description" class="col-sm-3 control-label">Description</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="description" name="description" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="amount" class="col-sm-3 control-label">Amount</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="amount" name="amount" required>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit -->
<div class="modal fade" id="editdeduct">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Add Employee Deduction</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="deduction_emp_add.php">
                    <input type="hidden" class="decid" name="emploid" id="emploid">
                    <div class="form-group">
                        <label for="edit_deductions" class="col-sm-3 control-label">Description</label>

                        <div class="col-sm-9">
                            <select class="form-control" name="deductionsLst" id="deductionsLst" onchange="changeAmount(this.value);">
                                <option value="" selected>- Select -</option>
                                <?php
                                $sql = "SELECT * FROM deductions";
                                $query = $conn->query($sql);
                                while ($prow = $query->fetch_assoc()) {
                                    echo "
                              <option value='" . $prow['id'] . "#" . $prow['amount'] . "'>" . $prow['description'] . " (" . $prow['amount'] . ")</option>
                            ";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit_amount" class="col-sm-3 control-label">Amount</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="0.0" id="edit_amount" name="amount">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Deleting...</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="deduction_emp_delete.php">
                    <input type="hidden" class="decid" name="emp_ded_id" id="emp_ded_id">
                    <div class="text-center">
                        <p>DELETE DEDUCTION</p>
                        <h2 id="del_deduction" class="bold"></h2>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
function changeAmount(amount) {
  //alert($(this).val());
  var res = amount.split("#");
  document.getElementById("edit_amount").value = res[1];
}
</script>

