
<!-- Modal content-->
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Category</h4>
    </div>
    <div class="modal-body">

        <div class="form-group error">
            <label for="inputTask" class="col-sm-3 control-label">Name</label>
            <div class="col-sm-9">
                <input type="text" class="form-control has-error" id="name" name="name" placeholder="Name" value="">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-3 control-label">Image</label>
            <div class="col-sm-9">
                <input type="file" class="form-control" id="image" name="image" placeholder="Image" value="">
            </div>
        </div>
        </form>
    </div>
    <div class="modal-footer">
        <input type="submit" class="btn btn-primary" data-dismiss="modal" value="Save"/>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</div>