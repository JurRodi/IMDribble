followUnfollowBtn = document.querySelector("#followUnfollowBtn");
followUnfollowBtn.addEventListener("click", function(event){
    event.preventDefault();
    if (event.target.classList.contains('followBtn')) {
        let user = event.target.dataset.user;
console.log(user)
        const formData = new FormData();
        formData.append('followedUser', user);

        fetch('./ajax/follow.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(result => {
            console.log('Succes:', result);
            document.querySelector(".followBtn").innerHTML = "Unfollow"
            document.querySelector(".followBtn").classList.add("unfollowBtn")
            document.querySelector(".unfollowBtn").classList.remove("followBtn")
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }else if(event.target.classList.contains('unfollowBtn')) {
        event.preventDefault();
        let user = event.target.dataset.user;
console.log(user)
        const formData = new FormData();
        formData.append('followedUser', user);

        fetch('./ajax/unfollow.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(result => {
            console.log('Succes:', result);
            document.querySelector(".unfollowBtn").innerHTML = "Follow"
            document.querySelector(".unfollowBtn").classList.add("followBtn")
            document.querySelector(".followBtn").classList.remove("unfollowBtn")
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
})
