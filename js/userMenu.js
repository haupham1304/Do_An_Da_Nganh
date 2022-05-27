var userMenu = document.querySelector('.user-menu');
var up = document.querySelector('.ti-angle-up');
var down = document.querySelector('.ti-angle-down');

function openUserMenu(){
    userMenu.style.display = 'inline';
    up.style.display = 'inline';
    down.style.display = 'none';
}

function closeUserMenu(){
    userMenu.style.display = 'none';
    up.style.display = 'none';
    down.style.display = 'inline';
}

