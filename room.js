let btnAll = document.querySelectorAll('.tab-btn')

let paramsBlock = document.getElementById('params')

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
