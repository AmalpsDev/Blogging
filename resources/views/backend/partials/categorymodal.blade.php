<!-- The Modal -->
<div class="modal fade" id="addCategoryModal">
  <div class="modal-dialog">
    <div class="modal-content">
     <form id="addCategory">
      @csrf
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Category</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <div class="form-group">
       <label for="categoryname">Category Name</label>
       <input type="text" class="form-control" id="category_name" name="category_name" placeholder="category name...">
       <small id="category_name_help" class="text-danger"></small>
       </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Create</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-------Edit Modal------------->

<!-- The Modal -->
<div class="modal fade" id="editCategoryModal">
  <div class="modal-dialog">
    <div class="modal-content">
     <form id="editCategory">
      @csrf
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Category</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          <input type="hidden" id="category_id" name="category_id">
       <div class="form-group">
       <label for="categoryname">Category Name</label>
       <input type="text" class="form-control" id="edit_category" name="edit_category">
       <small id="edit_category_help" class="text-danger"></small>
       </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Update</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>