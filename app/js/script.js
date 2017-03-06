(function($){
    $(function(){

    $('.add-comment').on('click', function(){
        $postId = 'post/';
        $postId += ($(this).attr('data-post-id'));
        $('#add-comment').attr('action',$postId);
    })

    });
})(jQuery);
