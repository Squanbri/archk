//-----------------------------------fav-Profile
const favBtn = document.querySelector('.profile__favorite') ?? ""

favBtn.addEventListener('click', ()=>{
  let favIcon = document.querySelector('.favImg')
  favIcon.style.filter = "invert(0.5) sepia(5) saturate(9)"
})