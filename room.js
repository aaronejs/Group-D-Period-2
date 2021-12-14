let checkbox = [
    document.getElementById('Laptop'),
    document.getElementById('Extension'),
    document.getElementById('TV'),
    document.getElementById('Teapot'),
    document.getElementById('Adapter'),
    document.getElementById('Adapter2'),
    document.getElementById('Adapter3')
]
let countBlock = [
    document.getElementById('0'),
    document.getElementById('1'),
    document.getElementById('2'),
    document.getElementById('3'),
    document.getElementById('4'),
    document.getElementById('5'),
    document.getElementById('6'),
]
let roomBlock = [
    document.getElementById('room_1'),
    document.getElementById('room_2'),
    document.getElementById('room_3'),
    document.getElementById('room_4'),
    document.getElementById('room_5'),
    document.getElementById('room_6'),
    document.getElementById('room_7')
]
let minusBtn = document.querySelectorAll('.minus')
let plusBtn = document.querySelectorAll('.plus')
let countNumber = document.querySelectorAll('.number')
let labelAll = document.querySelectorAll('label')

let btnAll = document.querySelectorAll('.tab-btn')

let paramsBlock = document.getElementById('params')

for (let index = 0; index < roomBlock.length; index++) {
    roomBlock[index].addEventListener('click', () => {
        if (roomBlock[index].classList.value === 'roomNoSelect') {
            return
        } else {
            let roomAll = document.querySelectorAll('.roomActive')
            for (let index = 0; index < roomAll.length; index++) {
                roomAll[index].classList.remove('roomActive')
                paramsBlock.style.display = 'none'
                roomAll[index].classList.add('roomSelect')
            }
            roomBlock[index].classList.remove('roomSelect')
            roomBlock[index].classList.add('roomActive')
            paramsBlock.style.display = 'block'
        }
    })
}

for (let index = 0; index < labelAll.length; index++) {
    labelAll[index].addEventListener('click', () => {
        if (!checkbox[index].checked) {
            countBlock[index].classList.add('active')
        } else {
            countBlock[index].classList.remove('active')
        }
    })
}

for (let index = 0; index < minusBtn.length; index++) {
    minusBtn[index].addEventListener('click', () => {
        if (countNumber[index].innerHTML === '0') {
            countNumber[index].innerHTML = 10
        } else {
            countNumber[index].innerHTML = countNumber[index].innerHTML - 1
        }
    })
}
for (let index = 0; index < plusBtn.length; index++) {
    plusBtn[index].addEventListener('click', () => {
        if (countNumber[index].innerHTML === '10') {
            countNumber[index].innerHTML = 0
        } else {
            countNumber[index].innerHTML = Number(countNumber[index].innerHTML) + 1
        }
    })
}

for (let index = 0; index < btnAll.length; index++) {
    btnAll[index].addEventListener('click', (e) => {
        switch (e.target.id) {
            case 'btn1':
                document.getElementById('equipment').style.display = 'none'
                for (let index = 0; index < btnAll.length; index++) {
                    btnAll[index].classList.remove('active')
                }
                e.target.classList.add('active')
                document.getElementById('room').style.display = 'block'
                break;
            case 'btn2':
                document.getElementById('room').style.display = 'none'
                for (let index = 0; index < btnAll.length; index++) {
                    btnAll[index].classList.remove('active')
                }
                e.target.classList.add('active')
                document.getElementById('equipment').style.display = 'block'
                break;
        }
    })
}
