let globalDate = new Date()
let globalYear = globalDate.getFullYear()
let count = globalDate.getUTCMonth()
let globalToday = globalDate.getDate()

timeId = 1

function calendar(count, globalYear, day) {
    var d = new Date();
    var year = globalYear;
    var currentMonth = d.getMonth()
    var month = count;
    var FormatMonth = Number(month) + 1
    var today = day;
    var first_day = new Date(year, month, 1);
    var first_wday = first_day.getDay();
    var n = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']
    var days = ['', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ]

    function getCurentDay() {
        let first_day = new Date(year, month, 1);
        var oneHour = 1000 * 60 * 60;
        var oneDay = oneHour * 24;
        var lastMonth = new Date(year, month - 1, 1);
        var nextMonth = new Date(year, month + 1, 1);
        var last_date = Math.ceil((nextMonth.getTime() - first_day.getTime() - oneHour) / oneDay);
        return last_date
    }

    for (i = 1; i < getCurentDay(); i++) {
        var blockMonth = document.getElementById('month');
        var blockDay = document.querySelectorAll('.day')
        var blockDate = document.getElementById('data')
        if (i == first_wday) {
            blockMonth.innerHTML = n[month] + ' ' + year

            for (j = 0; j < getCurentDay(); j++) {
                days[i + j - 1] = 1 + j

            }
            for (let index = 0; index < blockDay.length; index++) {
                blockDay[index].innerHTML = ''

            }
            for (let index = 0; index < blockDay.length; index++) {
                blockDay[index].classList.remove('active')
            }
            days.map((item, i) => (
                item != '' ?
                blockDay[i].innerHTML = item :
                null,
                blockDay[i].addEventListener("click", (e) => {
                    globalToday = item
                    globalYear = year
                    count = month
                    FormatMonth < 10 ?
                        f_month = '0' + FormatMonth : f_month = FormatMonth,
                        item < 10 ?
                        f_day = '0' + item : f_day = item,
                        blockDate.innerHTML = f_day + '.' + f_month + '.' + year,
                        modalCalander = document.getElementById('calander')
                    modalCalander.style.display = 'none'
                    for (let index = 0; index < blockDay.length; index++) {
                        blockDay[index].classList.remove('active')
                    }
                    e.target.classList.add('active')

                })
            ))

            for (let z = 0; z < getCurentDay(); z++) {
                if (month === currentMonth) {
                    if (blockDay[z].innerHTML == today) {
                        blockDay[z].classList.add('active');
                    }
                } else {
                    for (let index = 0; index < blockDay.length; index++) {
                        blockDay[index].classList.remove('active')

                    }
                }

            }
            for (let a = 0; a < blockDay.length; a++) {
                if (blockDay[a].innerHTML === '') {
                    blockDay[a].classList.add('noActive');
                } else {
                    blockDay[a].classList.remove('noActive');
                }
            }

        }


    }
}

function selectTime(id, time) {
    let hourBlock = document.getElementById('hour')
    let minuteBlock = document.getElementById('minute')
    let count = 24
    let blockTime1 = document.getElementById('time1')
    let blockTime2 = document.getElementById('time2')
    switch (id) {
        case 'h_up':
            if (minuteBlock.innerHTML !== '00') {
                count = 23
            }
            data = Number(hourBlock.innerHTML) + 1
            if (data < 10) {
                hourBlock.innerHTML = '0' + data
            } else {
                if (data > count) {
                    data = '0' + 1
                }
                hourBlock.innerHTML = data
            }
            break;
        case 'm_up':
            data = Number(minuteBlock.innerHTML) + 1
            if (Number(hourBlock.innerHTML) > 23) {
                data2 = 23
                hourBlock.innerHTML = data2
            }
            if (data < 60) {
                data = data
            } else {
                data = 00
            }
            if (data < 10) {
                minuteBlock.innerHTML = '0' + data
            } else {
                minuteBlock.innerHTML = data
            }
            break;
        case 'h_down':
            data = Number(hourBlock.innerHTML) - 1
            if (hourBlock.innerHTML === '01') {
                if (minuteBlock.innerHTML !== '00') {
                    data = 23
                } else {
                    data = 24
                }

            }
            if (data < 10) {
                hourBlock.innerHTML = '0' + data
            } else {
                hourBlock.innerHTML = data
            }
            break;
        case 'm_down':
            data = Number(minuteBlock.innerHTML) - 1
            if (Number(hourBlock.innerHTML) > 23) {
                data2 = 23
                hourBlock.innerHTML = data2
            }
            if (data < 0) {
                data = 59
            }
            if (data < 10) {
                minuteBlock.innerHTML = '0' + data
            } else {
                minuteBlock.innerHTML = data
            }
            break;
    }

    switch (timeId) {
        case 1:
            blockTime1.innerHTML = hourBlock.innerHTML + ':' + minuteBlock.innerHTML
            break;

        case 2:
            blockTime2.innerHTML = hourBlock.innerHTML + ':' + minuteBlock.innerHTML
            break;
    }
}

function selectMonth(data) {
    switch (data) {
        case 'left':
            if (count === 0) {
                count = 11
                globalYear = globalYear - 1
            } else {
                count = count - 1
            }
            calendar(count, globalYear, globalToday)
            break;

        case 'right':
            if (count === 11) {
                count = 0
                globalYear = globalYear + 1
            } else {
                count = count + 1
            }
            calendar(count, globalYear, globalToday)
            break;
    }
}

function openModal(data) {
    let modalCalander = document.getElementById('calander')
    let modalTime = document.getElementById('time')
    switch (data) {
        case 'date':
            modalTime.style.display = 'none'
            modalCalander.style.display = 'flex'
            calendar(count, globalYear, globalToday)
            break;
        case 'time1':
            modalCalander.style.display = 'none'
            modalTime.style.display = 'flex'
            timeId = 1
            break;
        case 'time2':
            modalCalander.style.display = 'none'
            modalTime.style.display = 'flex'
            timeId = 2
            break;
    }

    document.addEventListener("click", (e) => {
        let date_search = 'date-search'
        let text = 'text'
        let info_block = 'info-block'
        let img = 'img'
        let search = 'search'
        if (e.target.className === 'container' || e.target.className === search || e.target.className === date_search || e.target.className === text || e.target.className === info_block || e.target.className === img) {
            let modalCalander = document.getElementById('calander')
            let modalTime = document.getElementById('time')
            if (modalCalander.style.display === 'flex') {
                modalCalander.style.display = 'none'
            }
            if (modalTime.style.display === 'flex') {
                modalTime.style.display = 'none'
            }
        }
    })
}