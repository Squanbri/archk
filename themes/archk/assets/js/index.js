const vacansies = document.querySelector('.block-vacansies__list');
const searchSalarySettings = document.querySelector('.search-platform__settings')
const searchSalaryBlock = document.querySelector('.search-platform__settings-block')

if (document.body.clientWidth > 768) {
  showWindowMain(searchSalarySettings, searchSalaryBlock, 'search-platform__settings-block_active', '.search-platform__settings-btn')
  modal.innerHTML = ''
}
else {
  searchSalarySettings.addEventListener('click', () => {
  searchSalaryBlock.innerHTML = ''  
  modal.classList.add('modal-visible')
  
  const html = document.getElementsByTagName('html')[0]
  document.body.style.top = `-${window.scrollY}px`
  html.style.position = 'fixed'
})


modal.addEventListener('click', (e) => {
	if (e.target == modal || e.target.classList.contains('closebtn')) {
		modal.classList.remove('modal-visible')
		
    const html = document.getElementsByTagName('html')[0]
    const scrollY = document.body.style.top
    html.style.position = ''
    document.body.style.top = ''
    window.scrollTo(0, parseInt(scrollY || '0') * -1)
	}
})
}

let moving = false;
let mouseLastPosition = 0;
let transform = 0;
let lastPageX = 0;
let transformValue = 0;

const gestureStart = (e) => {
  moving = true;
  mouseLastPosition = e.pageX;
  transform = window.getComputedStyle(vacansies)
  .getPropertyValue('transform') !== 'none'
  ? window.getComputedStyle(vacansies)
  .getPropertyValue('transform').split(',')[4].trim()
  : 0;
  console.log(transform);
};

const gestureMove = (e) => {
  if (moving) {
   const diffX =  e.pageX - mouseLastPosition;
   if (e.pageX - lastPageX > 0) {
     if (transformValue > 0) {
       return;
     }
   } else {
     if (document.body.clientWidth <= 400){
       if (Math.abs(transformValue) > vacansies.offsetWidth + 420) {
         return;
       }
     }
     else if(document.body.clientWidth <= 480){
       if (Math.abs(transformValue) > vacansies.offsetWidth + 270) {
         return;
       }
     }
     else if(document.body.clientWidth <= 600){
       if (Math.abs(transformValue) > vacansies.offsetWidth + 100) {
         return;
       }
     }
     else if(document.body.clientWidth <= 650){
       if (Math.abs(transformValue) > vacansies.offsetWidth - 120) {
         return;
       }
     }
     else{
       if (Math.abs(transformValue) > vacansies.offsetWidth - 320) {
         return;
       }
     }
   }
    transformValue = parseInt(transform) + diffX;
    vacansies.style.transform = `translateX(${transformValue}px)`;
  }
  lastPageX = e.pageX;
};

const gestureEnd = (e) => {
  moving = false;
};

if (window.PointerEvent) {
  window.addEventListener('pointerdown', gestureStart);

  window.addEventListener('pointermove', gestureMove);

  window.addEventListener('pointerup', gestureEnd);  
} else {
  window.addEventListener('touchdown', gestureStart);

  window.addEventListener('touchmove', gestureMove);

  window.addEventListener('touchup', gestureEnd);  
  
  window.addEventListener('mousedown', gestureStart);

  window.addEventListener('mousemove', gestureMove);

  window.addEventListener('mouseup', gestureEnd);  
}

function showWindowMain (btn, list, activeClass, parentBlock) {
  let prevBtn = ''
  
  if (NodeList.prototype.isPrototypeOf(btn)) btn = Array.from(btn)
  
  if (Array.isArray(btn)) {
    btn.forEach(el => {
      el.addEventListener('click', () => {
        btn.forEach(item => item.nextElementSibling.classList.remove(activeClass))
        list = el.nextElementSibling
        
        window.addEventListener('click', event => {
          if (event.target.closest(parentBlock) === null) list.classList.remove(activeClass)
          if (event.target === el && event.target.nextElementSibling.classList.contains(activeClass)) list.classList.remove(activeClass)
          if (event.target === el && !event.target.nextElementSibling.classList.contains(activeClass)) list.classList.add(activeClass)
        })
      })
    })
  }
  else {
    btn.addEventListener('click', () => {
      list.classList.toggle(activeClass)
      
      window.addEventListener('click', event => {
        if (!event.target.closest(parentBlock)) list.classList.remove(activeClass)
      })
    })
  }
}