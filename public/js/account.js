const notif = document.querySelectorAll('.notif.new');
if(notif != undefined || notif != null) {
    let delay = 0;
    notif.forEach(layer => {
        layer.setAttribute('style', '--delay:' + delay);
        layer.classList.remove('new');
        delay += 3;
    });
};

const loginTypeBtn = document.querySelectorAll('.login-select-box');
if(loginTypeBtn != undefined || loginTypeBtn != null) {
    const fields = document.querySelectorAll('.switched-field');
    loginTypeBtn.forEach(btn => {
        btn.addEventListener(
            'click', function() {
                const activeBtn = document.querySelector('.login-select-box.active');
                activeBtn.classList.remove('active');
    
                btn.classList.add('active');
                const activeField = document.querySelector('.switched-field.used');
                activeField.classList.remove('used');
                fields.forEach(field => {
                    field.value = '';
                    if(field.getAttribute('fieldFor') == btn.getAttribute('loginWith')) {
                        field.classList.add('used');
                    };
                });
            }
        )
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