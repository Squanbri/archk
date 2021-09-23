const filterBtn = document.querySelector('.filter-btn') ?? ""
const filterBlock = document.querySelector('.filter-block') ?? ""
const Darkness = document.querySelector('.dark') ?? ""
const filterClose = document.querySelector('.filter-block__close') ?? ""

if (document.body.clientWidth <= 768) {
  const searchListsBtn = document.querySelector('.search__input-group button')
  const paginationPrev = document.querySelector('.pagination__prev') ?? ''
  const paginationNext = document.querySelector('.pagination__next') ?? ''
  
  searchListsBtn.style.background = 'white'
  searchListsBtn.style.width = '70px'
  searchListsBtn.innerHTML = '<img src="/themes/archk/assets/icons/search-icon.svg">'
  
  if (paginationPrev) {
    paginationPrev.innerHTML = '&#9664;'
    paginationNext.innerHTML = '&#9654;'
  }
}

const sklonenie = (number, txt, cases = [2, 0, 1, 1, 1, 2]) => txt[(number % 100 > 4 && number % 100 < 20) ? 2 : cases[(number % 10 < 5) ? number % 10 : 5]];

const findResumes = document.querySelector('.find-vacancies') ?? ""

if(findResumes!=""){
  let findWords = findResumes.innerText
  let findWordsArr = findWords.split(' ')
  let num =Number.parseInt(findWordsArr[1])
  if(findWordsArr[2]=="вакансии"){
    findResumes.innerHTML = "Найдено" + " " + num + " " + sklonenie(num, ['вакансия', 'вакансии', 'вакансий'])
  }
}


if (!filterBtn==""||!filterBlock=="" || !Darkness=="" || !filterClose==""){
  filterBtn.addEventListener('click', ()=>{
    
    filterBlock.classList.add('open')
    Darkness.style.display="inline"
    Darkness.style.zIndex = 99
    Darkness.style.backgroundColor = "rgba(0,0,0,.3)"
    
    anime({
      targets: filterBlock,
      duration: 200,
      easing: 'linear',
      translateX: 800,
      delay: 200
    });
  })


  filterClose.addEventListener('click', () => closeFilter())  
  Darkness.addEventListener('click', () => closeFilter())
  
  function closeFilter() {
    filterBlock.classList.remove('open')
    Darkness.style.display="none"

    anime({
      targets: filterBlock,
      duration: 100,
      easing: 'linear',
      translateX: 0,
      delay: 200
    });
  }
}
//------------------------------- vacansies

const parents = document.querySelectorAll('.list-block__btns') ?? ""

parents.forEach(parent=>{
  parent.addEventListener('click', (event)=>{
    if(event.target.classList.contains('list-block__like')){
      if (event.target.textContent === 'В избранное') {
        
        let attr2 = event.target.getAttribute('data-request-data');
        
        let attrArr = attr2.split(', ')
        
        let attr = attrArr[1]
        let attrName = attrArr[0]
      
        const button = document.createElement("button");
        button.textContent = 'Убрать из избранного'
        button.className = 'list-block__like'
        button.setAttribute('data-request', 'Favourites::onRemoveFavourite')
        button.setAttribute('data-request-data', attrName + ', ' + attr)
        
        event.target.replaceWith(button)
        
      }
      else{
        
        let attr2 = event.target.getAttribute('data-request-data');
        
        let attrArr = attr2.split(', ')
        
        let attr = attrArr[1]
        let attrName = attrArr[0]
        
        const button = document.createElement("button");
        button.textContent = 'В избранное'
        button.className = 'list-block__like'
        button.setAttribute('data-request', 'Favourites::onAddFavourite')
        button.setAttribute('data-request-data', attrName + ', ' + attr)
        
        event.target.replaceWith(button)
        
      }
    }
  })
})