/**
 * Dear Maintainer
 * 
 * When I wrote this code
 * Only God and I know what it was
 * Now, only God know what it was :)
 * 
 * Stay Tawakal and Keep Ikhtiar
 * May god give you clue about it
 * 
 * Recent Maintainer :
 * SMKN 1 Bondowoso 2022/2023 Students
**/

const searchPage = document.getElementById('search-page');
let listeners = ['click', 'keyup'];

function search(key, value) {
    value.forEach(row => {
        if(row.textContent.toLowerCase().includes(key.value.toLowerCase())) {
            row.parentElement.style.display = 'block';
        } else {
            row.parentElement.style.display = 'none';
        };
    });
};

if(searchPage != undefined || searchPage != null) {
    const related = searchPage.parentElement.querySelectorAll('.related-title');
    
    listeners.forEach(event => {
        searchPage.addEventListener(event, function() {
            search(searchPage, related);
        });
    });
    
    searchPage.parentElement.parentElement.addEventListener(
        'mouseleave', function() {
            related.forEach(row => {
                row.parentElement.style.display = 'none';
            });
        }
    );
};

function doFilterList() {
    const filterInput = document.querySelectorAll('.filter-input');
        if(filterInput != undefined || filterInput != null) {
            filterInput.forEach(input => {
                const related = input.parentElement.nextElementSibling.querySelectorAll('.related-title');
            
                related.forEach(opt => {
                    if(opt.nextElementSibling != undefined || opt.nextElementSibling != null) {
                        opt.nextElementSibling.addEventListener(
                            'click', function() {
                                opt.parentElement.parentElement.previousElementSibling.querySelector('.filter-input').value = opt.textContent;
                                related.forEach(otherOpt => {
                                    otherOpt.parentElement.style.display = 'none';
                                });
                            }
                        )
                    } else {
                        opt.parentElement.addEventListener(
                            'click', function() {
                                opt.parentElement.parentElement.previousElementSibling.querySelector('.filter-input').value = opt.textContent;
                                related.forEach(otherOpt => {
                                    otherOpt.parentElement.style.display = 'none';
                                });
                            }
                        )
                    }
                });
    
                listeners.forEach(event => {
                    input.addEventListener(event, function() {
                        setTimeout(search(input, related), 500);
                    });
                });
                
                input.parentElement.parentElement.addEventListener(
                    'mouseleave', function() {
                        related.forEach(row => {
                            row.parentElement.style.display = 'none';
                        });
                    }
                );
            });
        };
}
setInterval(doFilterList, 1000);

const navBox = document.querySelectorAll('.main-nav');
if(navBox != undefined) {
    navBox.forEach(icon => {
        icon.addEventListener(
            'click', function() {
                const activeNav = document.querySelector('.main-nav.active');
                if(activeNav != undefined || activeNav != null) {
                    activeNav.classList.remove('active');
                };
                icon.classList.add('active');
            }
        )
    });
};

const izinCount = document.querySelectorAll('.izin-count');
if(izinCount != undefined || izinCount != null) {
    izinCount.forEach(dot => {
        let red = Math.floor(Math.random() * 255);
        let green = Math.floor(Math.random() * 255);
        let blue = Math.floor(Math.random() * 255);
        let rgb = red + ',' + green + ',' + blue;

        dot.previousElementSibling.querySelector('.chart-detail-dot').setAttribute('dot-clr', rgb);
    });
};

const canvasKet = document.getElementById('chart-keterangan');
if(canvasKet != undefined || canvasKet != null) {
    const izinColor = document.querySelectorAll('.chart-detail-dot');
    const izinCountValue = document.querySelectorAll('.izin-count');
    const pieIzin = new Chart(canvasKet, {
        type: 'doughnut',
        data: {
            datasets: [{
                label: 'Data Presensi',
                data: [],
                backgroundColor: [],
            }]
        },
        options: {
            events: [],
            cutout: 90,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            },
            borderWidth: 12,
            borderColor: 'rgb(245, 245, 245)',
            borderRadius: 12
        },
    });

    izinColor.forEach(color => {
        color.style.backgroundColor = 'rgba(' + color.getAttribute('dot-clr') + ', .6)';
        pieIzin.data.datasets[0].backgroundColor.push('rgba(' + color.getAttribute('dot-clr') + ', .6)');
    });

    izinCountValue.forEach(izin => {
        pieIzin.data.datasets[0].data.push(izin.textContent);
    });

    pieIzin.update();
};

const weeklyChart = document.getElementById('weekly-chart');
if(weeklyChart != undefined || weeklyChart != null) {
    const dayName = document.querySelectorAll('.attend-chart-data-day-name');
    const dayCount = document.querySelectorAll('.attend-chart-data-day-count');

    let raw_count = [];
    dayCount.forEach(count => {
        raw_count.push(count.textContent);
    });

    const sevenDaysChart = new Chart(weeklyChart, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: 'Total Kehadiran',
                data: [],
                fill: true,
                backgroundColor: 'rgba(101, 129, 244, .15)',
                borderColor: 'rgb(101, 129, 244)',
                borderWidth: 2,
                radius: 1.8,
                tension: 0.4,
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: Math.max.apply(Math, raw_count) + Math.floor((Math.max.apply(Math, raw_count) / 4))
                }
            }
        }
    });

    dayName.forEach(day => {
        sevenDaysChart.data.labels.push(day.textContent);
    });

    dayCount.forEach(count => {
        sevenDaysChart.data.datasets[0].data.push(count.textContent);
    });

    sevenDaysChart.update();
};

const alphaChart = document.getElementById('alpha-chart');
if(alphaChart != undefined || alphaChart != null) {
    const dayName = document.querySelectorAll('.alpha-chart-data-day-name');
    const dayCount = document.querySelectorAll('.alpha-chart-data-day-count');

    let raw_count = [];
    dayCount.forEach(count => {
        raw_count.push(count.textContent);
    });

    const alphaSevenDays = new Chart(alphaChart, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: 'Tanpa Keterangan',
                data: [],
                fill: true,
                backgroundColor: 'rgba(255, 150, 150, .15)',
                borderColor: 'rgb(255, 100, 100)',
                borderWidth: 2,
                radius: 1.8,
                tension: 0.4,
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: Math.max.apply(Math, raw_count) + Math.floor((Math.max.apply(Math, raw_count) / 4))
                }
            }
        }
    });

    dayName.forEach(day => {
        alphaSevenDays.data.labels.push(day.textContent);
    });

    dayCount.forEach(count => {
        alphaSevenDays.data.datasets[0].data.push(count.textContent);
    });

    alphaSevenDays.update();
};

let chartNow = 1;
const toggleChart = document.querySelector('.filter-box');
if(toggleChart != undefined || toggleChart != null) {
    const chartWrapper = document.querySelector('.chart-graphic');
    toggleChart.addEventListener(
        'click', function() {
            if(chartNow === 1) {
                chartNow--;
                toggleChart.textContent = 'Lihat Grafik Kehadiran';
            } else {
                chartNow++;
                toggleChart.textContent = 'Lihat Grafik Alpha';
            };

            toggleChart.classList.toggle('alpha');
            weeklyChart.classList.toggle('active');
            alphaChart.classList.toggle('active');
        }
    )
};

let lastUpload = true;
function greenUpload() {
    const inputImage = document.querySelector('.image-field');
    const uniqeBtn = document.querySelector('.affect-on-image');
    if(lastUpload === false) {
        if(inputImage != undefined || inputImage != null) {
            if(inputImage.value.length > 0) {
                inputImage.classList.add('uploaded');
                inputImage.nextElementSibling.classList.add('uploaded');
                inputImage.nextElementSibling.innerHTML = `
                <i class="fa-solid fa-users-viewfinder"></i>
                <h5>Bukti Terupload</h5>
                `;
                uniqeBtn.classList.add('uploaded');
                uniqeBtn.innerHTML =`
                <i class="fa-solid fa-spinner"></i>
                Lanjutkan Mengisi
                `;
            }
        }
    } else {
        if(inputImage != undefined || inputImage != null) {
            inputImage.classList.remove('uploaded');
            inputImage.nextElementSibling.classList.remove('uploaded');
            inputImage.nextElementSibling.innerHTML = `
            <i class="fa-solid fa-users-viewfinder"></i>
            <h5>Upload Bukti</h5>
            `;
            uniqeBtn.classList.remove('uploaded');
            uniqeBtn.innerHTML =`
            <i class="fa-solid fa-file-circle-plus"></i>
            Tambahkan Data
            `;
        }
    }
}
setInterval(greenUpload, 1000);

const inputImage = document.querySelector('.image-field');
if(inputImage != undefined || inputImage != null) {
    inputImage.addEventListener(
        'click', function() {
            lastUpload = false;
        }
    )
}

function showModal(id, action) {
    const modals = document.querySelectorAll('.modal-card');
    const accModal = document.querySelector('.acc-modal');
    const tbody = document.querySelector('tbody');
    const statHeader = document.querySelector('.data-header');
    if(tbody != undefined || tbody != null) {
        tbody.removeAttribute('wire:poll');
    };
    if(statHeader != undefined || statHeader != null) {
        statHeader.removeAttribute('wire:poll');
    };
    if(accModal != undefined || accModal != null) {
        accModal.parentElement.removeAttribute('wire:poll');
    };

    function itsNowOrNever() {
        modals.forEach(card => {
            if(card.querySelector('.modal-id').textContent == id && card.querySelector('.modal-fn').textContent == action) {
                card.parentElement.style.display = 'flex';
                card.style.display = 'block';
                function appear() {
                    card.parentElement.classList.add('active');
                    card.classList.add('active');
                };
                setTimeout(appear, 300);
            };
        });
    }
    setTimeout(itsNowOrNever, 500);
};

function closeModal(e) {
    const accModal = document.querySelector('.acc-modal');
    const tbody = document.querySelector('tbody');
    const statHeader = document.querySelector('.data-header');
    if(tbody != undefined || tbody != null) {
        tbody.setAttribute('wire:poll', '');
    };
    if(statHeader != undefined || statHeader != null) {
        statHeader.setAttribute('wire:poll', '');
    };
    if(accModal != undefined || accModal != null) {
        accModal.parentElement.setAttribute('wire:poll', '');
    };
    
    e.parentElement.classList.remove('active');
    e.parentElement.parentElement.classList.remove('active');
    function disappear() {
        e.parentElement.style.display = 'none';
        e.parentElement.parentElement.style.display = 'none';
    }
    setTimeout(disappear, 500);
}

function noData() {
    const trashBtn = document.querySelectorAll('.trash-btn');
    if(trashBtn.length < 1) {
        function wait() {
            window.location.reload();
        }
        setTimeout(wait, 1000);
    }
}

const apprCard = document.querySelectorAll('.req-card');
if(apprCard == undefined || apprCard == null || apprCard.length == 0) {
    const cardContainer = document.querySelector('.req-card-container');
    if(cardContainer != undefined || cardContainer != null) {
        cardContainer.querySelector('.no-data').classList.add('true');
    };
};

let firstError = 0;

function resetError() {
    firstError = 0;
    function unUpload() {
        lastUpload = true;
        const tbody = document.querySelector('tbody');
        const statHeader = document.querySelector('.data-header');

        if(tbody != undefined || tbody != null) {
            tbody.setAttribute('wire:poll', '');
        };
        if(statHeader != undefined || statHeader != null) {
            statHeader.setAttribute('wire:poll', '');
        };
    }
    setTimeout(unUpload, 5000);
};

function searchError() {
    const notif = document.querySelectorAll('.notif.new');
    if(notif.length > 0) {
        console.log(notif);
        firstError++;

        if(firstError > 1) {
            firstError = 2;
            return;
        };

        let delay = 0;
        notif.forEach(layer => { 
            layer.parentElement.parentElement.appendChild(layer);
            layer.setAttribute('style', '--delay:' + delay);
            layer.classList.remove('new');
            delay += 3;
        });
    }
};
setInterval(searchError, 3000);

window.onload = function() {
    firstError = 0;
}

const timeInput = document.querySelectorAll('.text-to-time');
if(timeInput != undefined || timeInput != null) {
    timeInput.forEach(input => {
        input.addEventListener(
            'keyup', function() {
                if(input.value.length === 2) {
                    input.value += ':';
                } else {
                    input.value = input.value;
                };
            }
        )
    });
}

const dateInput = document.querySelectorAll('.text-to-date');
if(dateInput != undefined || dateInput != null) {
    dateInput.forEach(input => {
        input.addEventListener(
            'keyup', function() {
                if(input.value.length === 4 || input.value.length === 7) {
                    input.value += '-';
                } else {
                    input.value = input.value;
                };
            }
        )
    });
}

const dayBox = document.querySelectorAll('.day-box');
if(dayBox != undefined || dayBox != null) {
    const dayWrapper = document.querySelectorAll('.wrap-check-day');
    dayBox.forEach(box => {
        box.addEventListener(
            'click', function() {
                const addLog = box.parentElement.parentElement.nextElementSibling.querySelector('.add-check-time');
                const boxActive = document.querySelectorAll('.day-box.active');
                boxActive.forEach(btn => {
                    btn.classList.remove('active');  
                });
                box.classList.add('active');

                if(addLog != undefined || addLog != null) {
                    addLog.setAttribute('btn-for-day', box.textContent.toLowerCase());
                };

                dayWrapper.forEach(wrapper => {
                    wrapper.style.display = 'none';
                });

                const selectedDay = box.parentElement.parentElement.parentElement.querySelector('.day-is-' + box.textContent.toLowerCase());
                selectedDay.style.display = 'block';
            }
        );
    });
}

const addLog = document.querySelectorAll('.add-check-time');
if(addLog != undefined || addLog != null) {
    addLog.forEach(addBtn => {
        addBtn.addEventListener(
            'click', function() {
                //LR D45

                const checkContainer = addBtn.parentElement.parentElement.parentElement.querySelector('.day-is-' + addBtn.getAttribute('btn-for-day'));
                const totalLog = checkContainer.querySelector('.total-log');

                function setElement(rowNumber) {
                    checkContainer.insertAdjacentHTML('beforeend', `
                        <div class="form-row log-row" style="margin-bottom: 8px;">
                            <div class="form-field">
                                <label for="">Nama Check Log</label>
                                <input name="log_name_` + addBtn.getAttribute('btn-for-day') + rowNumber + `" type="text" autocomplete="off">
                            </div>
                            <div class="form-field">
                                <label for="">Jam / Waktu</label>
                                <input name="log_limit_` + addBtn.getAttribute('btn-for-day') + rowNumber + `" type="time">
                            </div>
                            <div class="form-field">
                                <label for="">Check Log Dibuka</label>
                                <input name="log_time_` + addBtn.getAttribute('btn-for-day') + rowNumber + `" type="time">
                            </div>
                        </div>
                        <div class="form-row log-row bottom-field" style="padding-bottom: 32px;margin-bottom: 24px">
                            <div class="form-field">
                                <label for="log_type_` + addBtn.getAttribute('btn-for-day') + rowNumber + `">Jenis Check Log</label>
                                <input name="log_type_` + addBtn.getAttribute('btn-for-day') + rowNumber + `" id="log_type_` + addBtn.getAttribute('btn-for-day') + rowNumber + `" type="text" class="filter-input" autocomplete="off">
                            </div>
                            <div class="related-list" style="left: 0; width: 32.5%; transform: translateY(-24px)">
                                <p>
                                    <span class="related-title">Masuk</span>
                                </p>
                                <p>
                                    <span class="related-title">Keluar</span>
                                </p>
                            </div>
                            <div class="form-field">
                                <label for="">Toleransi</label>
                                <input name="log_tolerance_` + addBtn.getAttribute('btn-for-day') + rowNumber + `" type="time">
                            </div>
                            <div class="form-field">
                                <label for="">Check Log Ditutup</label>
                                <input name="log_range_` + addBtn.getAttribute('btn-for-day') + rowNumber + `" type="time">
                            </div>
                        </div>
                    `);
                }

                if(checkContainer.hasAttribute('count-log')) {
                    let countLog = parseInt(checkContainer.getAttribute('count-log'));
    
                    countLog++;
                    setElement(countLog);
                    totalLog.value = countLog;
                    checkContainer.setAttribute('count-log', countLog);
                };

                if(checkContainer.hasAttribute('is-there-log')) {
                    const allRow = checkContainer.querySelectorAll('.bottom-field');

                    checkContainer.setAttribute('is-there-log', allRow.length + 1);

                    let countLog = parseInt(checkContainer.getAttribute('is-there-log'));
                    setElement(countLog);
                    totalLog.value = countLog;
                };

                doFilterList();
            }
        )
    });
}

const logRowContainer = document.querySelectorAll('.wrap-check-day');
if(logRowContainer != undefined || logRowContainer != null) {
    logRowContainer.forEach(wrapper => {
        if(wrapper.hasAttribute('is-there-log')) {
            const totalRow = wrapper.querySelectorAll('.bottom-field');
            const inputTotal = wrapper.querySelector('.total-log');

            inputTotal.value = totalRow.length;
        };
    });
};

const searchRekap = document.querySelector('.rekap-search');
const rekapRows = document.querySelectorAll('.table-parameter');
const rekapPage = document.querySelector('.rekap-template');
if(searchRekap != undefined || searchRekap != null) {
    searchRekap.addEventListener(
        'keyup', function() {
            let searchVal = searchRekap.value.toUpperCase();
            rekapPage.removeAttribute('wire:poll.1000ms');
            rekapRows.forEach(row => {
                if(row.textContent.toUpperCase().indexOf(searchVal) > -1) {
                    row.parentElement.parentElement.style.display = 'table-row-group';                
                } else {
                    row.parentElement.parentElement.style.display = 'none';
                }
            });
        }
    )
}

function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    } else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}

const chartResource = document.querySelectorAll('.resource-package');
const hadirsCanvas = document.getElementById('chart-detail-hadir');
if(hadirsCanvas != undefined || hadirsCanvas != null) {
    let pegawai_hadir = [];
    chartResource.forEach(resource => {
        const id = resource.querySelector('.assemblyId').textContent.trim();
        const name = resource.querySelector('.resource-name').textContent.trim();
        const hadir = resource.querySelector('.stat-hadir').textContent.trim();

        let get_data = {
            data_id: id.toString(),
            name: name,
            hadir: parseInt(hadir)
        }
        
        pegawai_hadir.push(get_data);
    });

    let maxHadir = [];
    pegawai_hadir.forEach(hadir => {
        maxHadir.push(hadir.hadir);
    });
    const hadirsChart = new Chart(hadirsCanvas, {
        type: 'bar',
        data: {
          labels: [],
          datasets: [{
            label: 'Total Hadir (Hari) Dalam Sebulan',
            data: [],
            borderWidth: 1,
            backgroundColor: [
                'rgba(0, 200, 100, .6)',
                'rgba(0, 200, 100, .3)'
            ],
            borderColor: [
                'rgb(0, 200, 100)'
            ]
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
              max: Math.max.apply(Math, maxHadir) + Math.floor((Math.max.apply(Math, maxHadir) / 4))
            }
          }
        }
    });

    pegawai_hadir.forEach(hadir => {
        hadirsChart.data.labels.push(hadir.name);
        hadirsChart.data.datasets[0].data.push(hadir.hadir);
    });
    
    hadirsChart.update();    
};

const lembursCanvas = document.getElementById('chart-detail-lembur');
if(lembursCanvas != undefined || lembursCanvas != null) {
    let pegawai_lembur = [];
    chartResource.forEach(resource => {
        const id = resource.querySelector('.assemblyId').textContent.trim();
        const name = resource.querySelector('.resource-name').textContent.trim();
        const lembur = resource.querySelector('.stat-lembur').textContent.trim();

        let get_data = {
            data_id: id.toString(),
            name: name,
            lembur: parseInt(lembur)
        }
        
        pegawai_lembur.push(get_data);
    });

    let maxLembur = [];
    pegawai_lembur.forEach(lembur => {
        maxLembur.push(lembur.lembur);
    });
    const lembursChart = new Chart(lembursCanvas, {
        type: 'bar',
        data: {
          labels: [],
          datasets: [{
            label: 'Total Lembur (Jam) Dalam Sebulan',
            data: [],
            borderWidth: 1,
            backgroundColor: [
                'rgba(40, 40, 40, .6)',
                'rgba(40, 40, 40, .3)'
            ],
            borderColor: [
                'rgb(40, 40, 40)'
            ]
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
              max: Math.max.apply(Math, maxLembur) + Math.floor((Math.max.apply(Math, maxLembur) / 4))
            }
          }
        }
    });

    pegawai_lembur.forEach(lembur => {
        lembursChart.data.labels.push(lembur.name);
        lembursChart.data.datasets[0].data.push(lembur.lembur);
    });
    
    lembursChart.update();    
};

const izinsCanvas = document.getElementById('chart-detail-izin');
if(izinsCanvas != undefined || izinsCanvas != null) {
    let pegawai_izin = [];
    chartResource.forEach(resource => {
        const id = resource.querySelector('.assemblyId').textContent.trim();
        const name = resource.querySelector('.resource-name').textContent.trim();
        const izin = resource.querySelector('.stat-izin').textContent.trim();

        let get_data = {
            data_id: id.toString(),
            name: name,
            izin: parseInt(izin)
        }
        
        pegawai_izin.push(get_data);
    });

    let maxIzin = [];
    pegawai_izin.forEach(izin => {
        maxIzin.push(izin.izin);
    });

    const izinsChart = new Chart(izinsCanvas, {
        type: 'bar',
        data: {
          labels: [],
          datasets: [{
            label: 'Total Izin (Hari) Dalam Sebulan',
            data: [],
            borderWidth: 1,
            backgroundColor: [
                'rgba(101, 124, 244, .6)',
                'rgba(101, 124, 244, .3)'
            ],
            borderColor: [
                'rgb(101, 124, 244)'
            ]
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
              max: Math.max.apply(Math, maxIzin) + Math.floor((Math.max.apply(Math, maxIzin) / 4))
            }
          }
        }
    });

    pegawai_izin.forEach(izin => {
        izinsChart.data.labels.push(izin.name);
        izinsChart.data.datasets[0].data.push(izin.izin);
    });
    
    izinsChart.update();
};

const alphasCanvas = document.getElementById('chart-detail-alpha');
if(alphasCanvas != undefined || alphasCanvas != null) {
    let pegawai_alpha = [];
    chartResource.forEach(resource => {
        const id = resource.querySelector('.assemblyId').textContent.trim();
        const name = resource.querySelector('.resource-name').textContent.trim();
        const alpha = resource.querySelector('.stat-alpha').textContent.trim();

        let get_data = {
            data_id: id.toString(),
            name: name,
            alpha: parseInt(alpha)
        }
        
        pegawai_alpha.push(get_data);
    });

    let maxAlpha = [];
    pegawai_alpha.forEach(alpha => {
        maxAlpha.push(alpha.alpha);
    });

    const alphasChart = new Chart(alphasCanvas, {
        type: 'bar',
        data: {
          labels: [],
          datasets: [{
            label: 'Total Alpha (Hari) Dalam Sebulan',
            data: [],
            borderWidth: 1,
            backgroundColor: [
                'rgba(255, 50, 50, .6)',
                'rgba(255, 50, 50, .3)'
            ],
            borderColor: [
                'rgb(255, 50, 50)'
            ]
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
              max: Math.max.apply(Math, maxAlpha) + Math.floor((Math.max.apply(Math, maxAlpha) / 4))
            }
          }
        }
    });

    pegawai_alpha.forEach(alpha => {
        alphasChart.data.labels.push(alpha.name);
        alphasChart.data.datasets[0].data.push(alpha.alpha);
    });
    
    alphasChart.update();
};

const telatsCanvas = document.getElementById('chart-detail-telat');
if(telatsCanvas != undefined || telatsCanvas != null) {
    let pegawai_telat = [];
    chartResource.forEach(resource => {
        const id = resource.querySelector('.assemblyId').textContent.trim();
        const name = resource.querySelector('.resource-name').textContent.trim();
        const telat = resource.querySelector('.stat-telat').textContent.trim();

        let get_data = {
            data_id: id.toString(),
            name: name,
            telat: parseInt(telat)
        }
        
        pegawai_telat.push(get_data);
    });

    let maxTelat = [];
    pegawai_telat.forEach(telat => {
        maxTelat.push(telat.telat);
    });

    const telatsChart = new Chart(telatsCanvas, {
        type: 'bar',
        data: {
          labels: [],
          datasets: [{
            label: 'Total Telat (Menit) Dalam Sebulan',
            data: [],
            borderWidth: 1,
            backgroundColor: [
                'rgba(255, 200, 0, .6)',
                'rgba(255, 200, 0, .3)'
            ],
            borderColor: [
                'rgb(255, 200, 0)'
            ]
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
              max: Math.max.apply(Math, maxTelat) + Math.floor((Math.max.apply(Math, maxTelat) / 4))
            }
          }
        }
    });

    pegawai_telat.forEach(telat => {
        telatsChart.data.labels.push(telat.name);
        telatsChart.data.datasets[0].data.push(telat.telat);
    });
    
    telatsChart.update();
};

function printElement(btn) {
    const date = new Date();
    const year = date.getFullYear();
    let month = date.getMonth() + 1;
    if(parseInt(month) < 10) {
        month = '0' + month.toString();
    };
    const nowMonth = year + '-' + month;

    btn.parentElement.remove();
    window.print();

    window.location = `/dashboard/laporan/grafis-performa/preview/${nowMonth}/all`;
};

function rekapSyncFilter() {
    const get_month = document.querySelector('.as-param-get-month');
    const get_all_depar = document.querySelectorAll('.as-param-get-depar');
    let get_depar = 0;

    get_all_depar.forEach(depar => {
        if(depar.checked) {
            get_depar += depar.value;
        };
    });

    const date = new Date();
    const year = date.getFullYear();
    let month = date.getMonth() + 1;
    if(parseInt(month) < 10) {
        month = '0' + month.toString();
    };
    const nowMonth = year + '-' + month;

    if(get_month.value != undefined && get_depar != 0) {
        window.location = `/dashboard/laporan/grafis-performa/preview/${get_month.value}/${get_depar}`;
    } else if(get_month.value != undefined && get_depar == 0) {
        window.location = `/dashboard/laporan/grafis-performa/preview/${get_month.value}/all`;
    } else if(get_month.value == undefined && get_depar != 0) {
        window.location = `/dashboard/laporan/grafis-performa/preview/${nowMonth}/${get_depar}`;
    } else if(get_month.value == undefined && get_depar == 0) {
        window.location = `/dashboard/laporan/grafis-performa/preview/${nowMonth}/all`;
    };
};

const priceFormat = document.querySelectorAll('.col-price');
if(priceFormat != undefined || priceFormat != null) {
    priceFormat.forEach(field => {
        let price = field.textContent;
        let flipIt = price.split('').reverse().join('');
        let final;
        for(let i = 0; i < price.length; i += 3) {
            let result = flipIt.substring(i, i + 3) + '.';
            final += result;
            
            if(i >= price.length - 3) {
                let removeDot = final.split('').reverse().join('').replace('denifednu', '');
                field.textContent = 'Rp ' + removeDot.substr(1, removeDot.length) + ',00';
            }
        }
    });
};

function statPreview(data, departemen, subData, subDataVal) {
    window.location = `/dashboard/preview/${data}/${departemen}/${subData}/${subDataVal}`;
};

function scrollBottomPage() {
    let run = true;
    function searchElement() {
        if(run == true) {
            const chatElement = document.querySelector('.messages-box');
            if(chatElement != undefined || chatElement != null) {
                run = false;
                const chatApp = document.querySelector('.chat-history');
                if(chatApp != undefined || chatApp != null) {
                    chatApp.scrollTop = chatApp.scrollHeight;
                };
            };
        };
    };
    setInterval(searchElement, 100);
};

const chatRow = document.querySelectorAll('.chat-row');
if(chatRow != undefined || chatRow != null) {
    chatRow.forEach(row => {
        row.addEventListener(
            'click', function() {
                scrollBottomPage();
            }
        )
    });
};

window.addEventListener(
    'keypress', e => {
        if(e.key == 'Enter') {
            setTimeout(scrollBottomPage, 1500);
        };
    }
);