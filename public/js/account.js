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
                fields.forEach(field => {
                    activeField.classList.remove('used');
                    if(field.getAttribute('fieldFor') == btn.getAttribute('loginWith')) {
                        field.classList.add('used');
                    };
                });
            }
        )
    });
};