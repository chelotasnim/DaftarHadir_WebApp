const notif = document.querySelectorAll('.notif.new');
if(notif != undefined || notif != null) {
    let delay = 0;
    notif.forEach(layer => {
        layer.setAttribute('style', '--delay:' + delay);
        layer.classList.remove('new');
        delay += 3;
    });
};

const passEye = document.querySelector('.show-pass');
if(passEye != undefined || passEye != null) {
    passEye.addEventListener(
        'click', function() {
            const password = passEye.previousElementSibling;
            if(password.getAttribute('type') == 'password') {
                password.setAttribute('type', 'text');
                passEye.innerHTML = `
                    <i class="fa-regular fa-eye-slash"></i>
                `;
            } else {
                password.setAttribute('type', 'password');
                passEye.innerHTML = `
                    <i class="fa-regular fa-eye"></i>
                `;
            };
        }
    )
};