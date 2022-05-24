document.querySelector('#reportuser').addEventListener('click',
function(){
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
})