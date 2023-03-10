const notif = document.querySelectorAll('.notif.new');
if(notif != undefined || notif != null) {
    let delay = 0;
    notif.forEach(layer => {
        layer.setAttribute('style', '--delay:' + delay);
        layer.classList.remove('new');
        delay += 3;
    });
};