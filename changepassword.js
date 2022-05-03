document.querySelector('#cp-button').addEventListener('click',
function(){
    document.querySelector('.bg-popup').style.display = 'flex';
});

document.querySelector('.close').addEventListener('click',
function(){
    document.querySelector('.bg-popup').style.display = 'none';

});