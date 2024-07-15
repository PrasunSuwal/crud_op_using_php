<div class="modal fade" id="exampleModal<?php  echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="float:right; background: none; border: none;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="create_user.php">
        <div class="modal-body">
          <input type="hidden" name="_method" value="DELETE">
          <input type="hidden" name="id" value="<?php  echo $id;?>">
          Are You Sure You Want To Delete This?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>