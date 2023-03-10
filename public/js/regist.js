const slide = document.querySelectorAll('.slide');
const nextBtn = document.querySelector('.btn.next');
let step = 0;

function stepOpt() {
    if(step == 1) {
        const inputType = document.querySelectorAll('.for-type');
        if(inputType[0].checked || inputType[1].checked) {
            nextBtn.classList.add('available');
        } else {
            nextBtn.classList.remove('available');
        };
    } else if(step == 2) {
        const inputHari = document.querySelectorAll('.for-hari');
        if(inputHari[0].checked || inputHari[1].checked) {
            nextBtn.classList.add('available');
        } else {
            nextBtn.classList.remove('available');
        };
    } else if(step == 3) {
        const inputJadwal = document.querySelectorAll('.for-jadwal');
        if(inputJadwal[0].checked || inputJadwal[1].checked || inputJadwal[2].checked) {
            nextBtn.classList.add('available');
        } else {
            nextBtn.classList.remove('available');
        };
    };
};

if(slide != undefined || slide != null) {
    const prevBtn = document.querySelector('.btn.prev');
    const progress = document.querySelector('.progress-fill');
    const dot = document.querySelectorAll('.progress-dot');
    const sendBtn = document.querySelector('.send-btn');
    let transY = 0;

    document.onkeydown = function (t) {
        if(t.keyCode == 9){
         return false;
        };
    }

    nextBtn.addEventListener(
        'click', function() {
            transY += 100;
            step++;

            if(transY == slide.length * 100 - 100) {
                transY == slide.length * 100 - 100;
                nextBtn.classList.remove('available');
                sendBtn.style.display = 'block';
            };

            prevBtn.classList.add('available');
            slide.forEach(layer => {
                layer.style.transform = 'translateX(-' + transY + '%)';
            });

            let slidePoint = (slide.length * 100) / (transY + 100);
            progress.style.height = 98 / slidePoint + '%';
            dot[transY / 100].classList.add('active');

            stepOpt();
        }
    )

    prevBtn.addEventListener(
        'click', function() {
            transY -= 100;
            step--;

            if(transY < 100) {
                prevBtn.classList.remove('available');
            } else if(transY == slide.length * 100 - 200) {
                nextBtn.classList.add('available');
            }

            sendBtn.style.display = 'none';
            slide.forEach(layer => {
                layer.style.transform = 'translateX(-' + transY + '%)';
            });

            let slidePoint = (slide.length * 100) / (transY + 100);
            progress.style.height = 98 / slidePoint + '%';
            dot[(transY + 100) / 100].classList.remove('active');

            stepOpt();
        }
    )

    function searchSpan() {
        const wireSend = document.querySelector('.send-or-not');
        if(wireSend != undefined) {
            nextBtn.classList.remove('available');
            sendBtn.style.display = 'block';

            prevBtn.classList.add('available');
            slide.forEach(layer => {
                layer.style.transform = 'translateX(-' + transY + '%)';
            });

            let slidePoint = (slide.length * 100) / (transY + 100);
            progress.style.height = 98 / slidePoint + '%';
            dot[transY / 100].classList.add('active');

            wireSend.remove();
        };
    };
    setInterval(searchSpan, 1);
}

const switchWages = document.querySelector('.toggle-input');
const selectInput = document.querySelectorAll('.radio-input');
if(selectInput != undefined || selectInput != null) {
    let type;
    const selectType = document.querySelectorAll('.select-type');
    const displayType = document.querySelectorAll('span.type');
    const displayTypeTask = document.querySelectorAll('span.type-act');
    selectType.forEach(mainOpt => {
        mainOpt.querySelector('input').addEventListener(
            'change', function() {
                type = mainOpt.id;
            }
        )
    });

    selectInput.forEach(radio => {
        radio.addEventListener(
            'change', function() {
                const activeBox = radio.parentElement.parentElement.querySelector('.wizard-box.active');
                if(activeBox != undefined || activeBox != null) {
                    activeBox.classList.remove('active');
                };

                if(radio.checked) {
                    radio.parentElement.classList.add('active');
                };

                const onlyComp = document.querySelectorAll('.not-for-school');
                if(type == 'sekolah') {
                    switchWages.checked = false;
                    switchWages.parentElement.parentElement.style.display = 'none';
                    onlyComp.forEach(opt => {
                        opt.style.display = 'none';
                    });
                    displayType.forEach(span => {
                        span.textContent = 'Sekolah';
                    });
                    displayTypeTask.forEach(span => {
                        span.textContent = 'KBM';
                    });
                } else {
                    switchWages.parentElement.parentElement.style.display = 'flex';
                    onlyComp.forEach(opt => {
                        opt.style.display = 'flex';
                    });
                    displayType.forEach(span => {
                        span.textContent = 'Perusahaan';
                    });
                    displayTypeTask.forEach(span => {
                        span.textContent = 'Kerja';
                    });
                }

                console.log(type);
                stepOpt();
            }
        );
    });
}

if(switchWages != undefined || switchWages != null) {
    switchWages.addEventListener(
        'change', function() {
            if(switchWages.checked) {
                switchWages.parentElement.classList.add('active');
            } else {
                switchWages.parentElement.classList.remove('active');
            }
        } 
    )
}

function searchError() {
    const notif = document.querySelectorAll('.notif.new');
    if(notif != undefined || notif != null) {
        let delay = 0;
        notif.forEach(layer => {
            layer.setAttribute('style', '--delay:' + delay);
            layer.classList.remove('new');
            delay += 3;
        });
    }
};
setInterval(searchError, 1);