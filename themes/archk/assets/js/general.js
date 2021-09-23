// ------------------------------ Header

const burgerBtn = document.querySelector('.burger-btn')
const headerDropdownBtn = document.querySelector('.user-links__dropdown-btn') ?? ''
const listContactsBtn = document.querySelectorAll('.list-block__contacts-btn') ?? ''
const searchBtn = document.querySelector('.search-platform__btn') ?? ''

const btnDelay = () => {
  burgerBtn.style.pointerEvents = 'none'
  setTimeout(() => burgerBtn.style.pointerEvents = 'all', 500)
}

burgerBtn.addEventListener('click', () => {
  const headerNavList = document.querySelector('.header-nav__list')
  const headerNavItems = document.querySelectorAll('.header-nav__item')
  
  if (!burgerBtn.classList.contains('burger-btn_active')) {
    headerNavList.style.position = 'fixed'
    document.documentElement.style.overflow = 'hidden'
    burgerBtn.classList.add('burger-btn_active')
    anime({
      targets: headerNavList,
      duration: 200,
      transition: 200,
      easing: 'linear',
      translateY: window.innerHeight
    })
    anime({
      targets: headerNavItems,
      duration: 350,
      transition: 500,
      easing: 'linear',
      translateY: window.innerHeight
    })
  }
  else {
    burgerBtn.classList.remove('burger-btn_active')
    headerNavList.style.position = 'absolute'
    document.documentElement.style.overflow = 'auto'
    anime({
      targets: headerNavList,
      duration: 400,
      transition: 500,
      easing: 'linear',
      translateY: -window.innerHeight
    })
    anime({
      targets: headerNavItems,
      duration: 300,
      transition: 300,
      easing: 'linear',
      translateY: -window.innerHeight
    })
  }
})

if (headerDropdownBtn) {
  const headerDropdownList = document.querySelector('.user-links__dropdown-list')
  
  if (document.body.clientWidth > 768) showWindow(headerDropdownBtn, headerDropdownList, 'user-links__dropdown-list_active', '.user-links__dropdown')
  else {
    headerDropdownBtn.addEventListener('click', () => {
      if (!headerDropdownList.classList.contains('user-links__dropdown-list_mob-active')) {
        headerDropdownList.classList.add('user-links__dropdown-list_mob-active')
        headerDropdownBtn.style.opacity = .5
        headerDropdownList.style.position = 'fixed'
        document.documentElement.style.overflow = 'hidden'
      }
      else {
        headerDropdownList.classList.remove('user-links__dropdown-list_mob-active')
        headerDropdownBtn.style.opacity = 1
        headerDropdownBtn.style.position = 'relative'
        document.documentElement.style.overflow = 'auto'
      }
    })
  }
}

// ------------------------------ Header

// ------------------------------ TinyMCE

tinymce.init({
  selector: 'textarea',
  menubar: false,
  toolbar: 'bold italic | alignleft aligncenter alignright alignjustify | numlist bullist | fontsizeselect | h3 h4 | forecolor',
  fontsize_formats: '12pt 14pt 16pt 18pt',
  plugins: 'lists',
  lists_indent_on_tab: false,
  height: 250,
  max_height: 500
});

// ------------------------------ TinyMCE

if (listContactsBtn) {
  showWindow(listContactsBtn, '', 'list-block__contacts-block_active', '.list-block__contacts')
}

if (searchBtn && document.body.clientWidth <= 768) {
  searchBtn.innerHTML = '<img src="/themes/archk/assets/icons/search-icon.svg">'
}


// ------------------------------ general functions
function showWindow (btn, list, activeClass, parentBlock) {
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

//------------------------------- liked
const delBtnLiked = document.querySelectorAll('.delBtn-liked')??""
const likedVacancies = document.querySelectorAll('.list-block__vacancy') ?? ''
const likedResumes = document.querySelectorAll('.list-block__resum') ?? ''
const likedCourses = document.querySelectorAll('.list-block__course') ?? ''
const likedContainer = document.querySelector('.liked-vacansies__wrapper') ?? ''

delBtnLiked.forEach(btn => {
  btn.addEventListener('click', event => {
    const length = event.target.closest('.list-block__list').children.length - 1
    if (length === 0) event.target.closest('.list-block__list').innerHTML = '<span class="empty-list">Список пуст</span>'
    btn.closest('.list-block__item').remove()
  })
  
})

// ---------------------------------- checkImage

const img = document.getElementById('profile-img-load')??""
const errMes = document.querySelector('.err-message')??""
if(img!=""){
  img.addEventListener('change', ()=>{
    const file = document.getElementById("profile-img-load").files[0] 
    
    parts = file.name.split('.');
    if (parts.length > 1) 
      ext = parts.pop();
    if (file.size>=2097152){
      errMes.innerText = "Слишком большой размер"
      img.value =''
    }
    else if(!ext=="png" || !ext=="jpeg" || !ext=="jpg"|| ext=="svg"){
      errMes.innerText = "Файл не того типа"
      img.value =''
    }
    else{
      readURL(img)
      errMes.innerText = ""
    }
  })
}

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#photo').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}










