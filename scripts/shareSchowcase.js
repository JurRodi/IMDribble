document.getElementById('showcase').addEventListener('click', function(e) {
    e.preventDefault();
    let showcase = document.getElementById('showcase');
    showcase.href = 'showcase.php';
    navigator.clipboard.writeText(showcase.href);
    let copied = document.createElement('p');
    copied.style.color = 'red';
    copied.innerHTML = 'Copied to clipboard!';
    document.querySelector('.showcase').appendChild(copied);
    document.querySelector('.showcase').style.flexDirection = 'column';
    document.querySelector('.showcase').style.alignItems = 'center';
});