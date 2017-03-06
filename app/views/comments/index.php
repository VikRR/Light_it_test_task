<div class="row">
    <div class="col-md-8 col-md-offset-2 text-center">
        <?php if (!empty($_SESSION['fb_id'])): ; ?>
            <h3> Comments </h3>
        <?php else: ; ?>
            <h3> Войдите, чтобы оставить комментарий </h3>
            <a href="<?= $_SESSION['link']; ?>" class="btn btn-primary">Facebook</a>
        <?php endif; ?>
    </div>
</div>
<div class="row">
    <div class="col-md-8 col-md-offset-2 post">
        <!-- Вывод сообщений в виде дерева -->
        <?= $data ; ?>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 form-box">
                        <form id="add-comment" action="post/" method="post">
                            <div class="form-group">
                                <label for="comment">Добавить комментарий:</label>
                                <textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
                            </div>
                            <button type="submit" class="btn btn-default" value="add_comment">Send</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

