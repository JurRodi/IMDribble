showcaseButton = document.querySelector("#showcaseButton");
showcaseButton.addEventListener("click", function(event){
    event.preventDefault();
    console.log("click");
   
    if (event.target.classList.contains('showcaseInactive')) {
        let project = event.target.dataset.project;
        console.log(project);
    
        
        const formData = new FormData();
        formData.append('project', project);

        fetch('./ajax/add_to_showcase.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(result => {
            console.log('Succes:', result);
            document.querySelector("#showcaseButton").innerHTML = "remove from showcase"
            document.querySelector("#showcaseButton").classList.add("showcaseActive")
            document.querySelector(".showcaseActive").classList.remove("showcaseInactive")
            document.querySelector("#showcaseButton").setAttribute("project", project )
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
    else if(event.target.classList.contains('showcaseActive')) {
        event.preventDefault();
        let project = event.target.dataset.project;
        console.log("remove")
        console.log(project)
        const formData = new FormData();
        formData.append('project', project);

        fetch('./ajax/remove_from_showcase.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(result => {
            console.log('Succes:', result);
            document.querySelector("#showcaseButton").innerHTML = "add to showcase"
            document.querySelector("#showcaseButton").classList.add("showcaseInactive")
            document.querySelector(".showcaseInactive").classList.remove("showcaseActive")
            document.querySelector("#showcaseButton").setAttribute("project", project )
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
})
