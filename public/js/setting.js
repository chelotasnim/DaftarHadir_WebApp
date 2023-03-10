const qSettingBtn = document.querySelectorAll('.preview-cover');
if(qSettingBtn != undefined || qSettingBtn != null) {
    const settingDetail = document.querySelectorAll('.setting-option-wrapper');
    qSettingBtn.forEach(btn => {
        btn.addEventListener(
            'change', function() {
                const activeSetting = document.querySelector('.quick-setting-menu.active');
                activeSetting.classList.remove('active');

                if(btn.checked == true) {
                    btn.parentElement.parentElement.parentElement.classList.add('active');
                    settingDetail.forEach(detail => {
                        if(detail.getAttribute('quickSettingId') == btn.parentElement.parentElement.parentElement.getAttribute('quickSettingTargetId')) {
                            const usedSetting = document.querySelector('.active-detail');
                            usedSetting.classList.remove('active-detail');
                            detail.classList.add('active-detail');
                        };
                    });
                };
            }
        )
    });
};

const colorBox = document.querySelectorAll('.color-box input');
if(colorBox != undefined || colorBox != null) {
    colorBox.forEach(btn => {
        btn.addEventListener(
            'change', function() {
                const activeColor = document.querySelector('.color-box.used');
                if(activeColor != undefined || activeColor != null) {
                    activeColor.classList.remove('used');
                };

                if(btn.checked == true) {
                    const oldTheme = activeColor.querySelector('input');
                    const newTheme = btn.value;
                    
                    document.body.classList.replace(oldTheme.value, newTheme);
                    btn.parentElement.classList.add('used');
                };
            }
        )
    });
};

const notif = document.querySelectorAll('.notif.new');
if(notif != undefined || notif != null) {
    let delay = 0;
    notif.forEach(layer => {
        layer.setAttribute('style', '--delay:' + delay);
        layer.classList.remove('new');
        delay += 3;
    });
};