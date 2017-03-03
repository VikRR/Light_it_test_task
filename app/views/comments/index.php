<div class="row">
    <div class="col-md-12 text-center">
        <?php if(!empty($_SESSION['fb_id'])): ;?>
            <h3> Comments </h3>
        <?php else: ;?>
            <h3> Войдите, чтобы оставить комментарий </h3>
            <a href="<?= $_SESSION['link'] ;?>" class="btn btn-primary">Facebook</a>
        <?php endif ;?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h3>Post</h3>
    </div>
    <div class="col-md-12">
        <h3>Time</h3>
        <p>Post text</p>
        <?php //if():;?>
            <div class="col-md-12">
                <h3>Time</h3>
                <p> Comment text</p>
            </div>
        <?php //endif;?>
    </div>

</div>