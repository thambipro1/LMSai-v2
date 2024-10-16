<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Advanced Search</h5>
        </button>
    </div>
    <div class="modal-body">
        <div class="d-flex align-items-start">
            <form class="form-horizontal" method="post" action="advance_search.php" style="flex: 1;">
                <div class="form-group">
                    <label for="inputTitle">Title</label>
                    <input type="text" name="title" id="inputTitle" placeholder="Title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="inputAuthor">Author</label>
                    <input type="text" name="author" id="inputAuthor" placeholder="Author" class="form-control">
                </div>
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-secondary" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
</div>
