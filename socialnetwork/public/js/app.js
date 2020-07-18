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


$(".savechanges").on("click",function(){
    console.log(url);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url:url,
        method:'POST',
        data:{body:$('#edit-post').val(),post_id:postId},
        success:function( msg ) {
            console.log(msg['message']);
            Body.textContent = msg['new_body'];
            $('#editpostModal').modal('hide');
        }
    });

});
