$(".post").find(".interaction").find(".edit").on("click", function(event){
    event.preventDefault();
    var Body = event.target.parentNode.parentNode.childNodes[1].textContent;
    $('#editpostModal').find(".modal-body").find("#edit-post").val(Body);
    $('#editpostModal').modal();
});
