document.querySelector('#reportitem').addEventListener('click',
function(){ console.log("click")
    document.querySelector('.bg-popup').style.display = 'flex';
});

 document.querySelector('.close').addEventListener('click',
function(){
    document.querySelector('.bg-popup').style.display = 'none';

});

document.querySelector('.report-btn').addEventListener('click',
function(event){
    event.preventDefault();
    console.log("click")

    let reportuser_id = this.dataset.reportuser_id;;
    let project_id = this.dataset.project_id;
    let complaint = document.querySelector("#reportSelect").value;

    // console.log(reportuser_id)
    // console.log(project_id)
    // console.log(complaint)

    const formData = new FormData();
    formData.append('reportuser_id', reportuser_id);
    formData.append('project_id', project_id);
    formData.append('complaint', complaint);

    fetch('./ajax/report.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(result => {
        if(result.body !== false){
        document.querySelector('.bg-popup').style.display = 'none';
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
    
});