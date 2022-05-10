document.querySelector(".submitComment").addEventListener("click", function(event){
    event.preventDefault();
    let postId = document.querySelector(".submitComment").dataset.postid;
    let text = document.querySelector("#commentText").value;

    const formData = new FormData();
    formData.append('postId', postId);
    formData.append('text', text);

    fetch('./ajax/save_comment.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(result => {
        document.querySelector("#commentText").value = " ";

        let newComment = document.createElement('li');
        
        let username = document.createElement('h4');
        username.classList.add("detailsText");
        username.innerHTML = result.username + " commented:";

        let text = document.createElement('p');
        text.innerHTML = result.body;
        
        let deleteComment = document.createElement('a');
        deleteComment.classList.add("deleteComment");
        deleteComment.innerHTML = "delete comment";
        deleteComment.dataset.commentId = result.id;
        deleteComment.addEventListener("click", function(event){
            event.preventDefault();
            let commentId = this.dataset.commentId;//is er niet=>gaat niet deleten uit db

            const formData = new FormData();
            formData.append('commentId', commentId);

            fetch('./ajax/delete_comment.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(result => {
                console.log('Succes:', result);
                this.parentNode.parentNode.removeChild(this.parentNode);
            })
            .catch(error => {
                console.error('Error:', error);
            });
            
        });
        
        newComment.appendChild(username);
        newComment.appendChild(text);
        newComment.appendChild(deleteComment);

        document.querySelector(".CommentList").appendChild(newComment);

    })
    .catch(error => {
        console.error('Error:', error);
    });

});

var deleteCommentButtons = document.querySelectorAll( ".deleteComment" );
for ( var i = 0; i < deleteCommentButtons.length; i++){
    deleteCommentButtons[i].addEventListener("click", function (event){
    event.preventDefault();
    let commentId = this.dataset.commentid;

    const formData = new FormData();
    formData.append('commentId', commentId);

    fetch('./ajax/delete_comment.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(result => {
        console.log('Succes:', result);
        this.parentNode.parentNode.removeChild(this.parentNode);
    })
    .catch(error => {
        console.error('Error:', error);
    });
})};

