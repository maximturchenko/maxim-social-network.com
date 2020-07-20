var postId = 0;
var Body = null;
$(".post").find(".interaction").find(".edit").on("click", function(event){
    event.preventDefault();
    console.log(event);
    Body = event.target.parentNode.parentNode.childNodes[1];
    var body_text = Body.textContent;
    $('#editpostModal').find(".modal-body").find("#edit-post").val(body_text);
    postId =  event.target.parentNode.parentNode.dataset['postid'];
    $('#editpostModal').modal();
});

$("html").on("click",function(){ 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }); 
});

$(".savechanges").on("click",function(){ 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url:urlEdit,
        method:'POST',
        data:{body:$('#edit-post').val(),post_id:postId},
        success:function( msg ) {
            console.log(msg['message']);
            Body.textContent = msg['new_body'];
            $('#editpostModal').modal('hide');
        }
    });

});

$(".like").on("click",function(event){
    event.preventDefault();
    var iSlike = event.target.previousElementSibling == null ? true : false;      
    postId =  event.target.parentNode.parentNode.dataset['postid'];
    $.ajax({
        method:'POST',
        url:urlLike,
        data:{isLike:iSlike,post_id:postId},
        success:function( ) {
            event.target.innerHTML = iSlike ? event.target.innerHTML == 'Like' ? 'You like this post' : 'Like' : event.target.innerHTML == 'Dislike' ? 'You don\'t like this post' : 'Dislike';
            if(iSlike){
                event.target.nextElementSibling.innerHTML = 'Dislike';
            }else{
                event.target.previousElementSibling.innerHTML = 'Like';
            }
        }
    });
});
