let likeBtn = document.querySelector("#like").addEventListener("click", function (e) {
    e.preventDefault();
    like(e);
});

function like(e){
    let like = document.querySelector("#like");
    let userId = e.target.dataset.user;
    let postId = e.target.dataset.id;

    let data = new FormData();
    data.append("postId", postId);
    data.append("userId", userId);

    fetch('ajax/like_handler.php', {
        method: 'POST', 
        body: data,
    })
    .then(response => response.json())
    .then(console.log(data))
    .then(data => {
        like.innerHTML = data['totallikes'] + " likes";
        like.style.color="rgb(221, 32, 205)";
        // console.log('Success:', data, "liked");
        
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}