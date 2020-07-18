var postId = 0;

$(".post").find(".interaction").find(".edit").on("click", function(event){
    event.preventDefault();
    var Body = event.target.parentNode.parentNode.childNodes[1].textContent;
    $('#editpostModal').find(".modal-body").find("#edit-post").val(Body);
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
            console.log( msg['id']);
        }
    });

});
