const regNextBtn = document.querySelector('.enter-form__next-btn')
const regTypeUser = document.querySelectorAll('[name=type_user]')
const firstForm = document.querySelector('.enter-form__form_first')
const regForm = document.querySelector('.enter-form__form')
const regContainer = document.querySelector('.enter-form__container')

const mutObsFormConf = {
  childList: true,
  subtree: true
}
const formCallback = (mutationsList, observer) => {
  for (let mutation of mutationsList) 
    if (mutation.type === 'childList') translateBack()
}
const observer = new MutationObserver(formCallback);
observer.observe(firstForm, mutObsFormConf);

const translateNext = () => {
  anime({
    targets: regForm,
    duration: 350,
    transition: 200,
    easing: 'linear',
    translateX: -regContainer.offsetWidth - 100,
  })
}

const translateBack = () => {
  anime({
    targets: regForm,
    duration: 350,
    transition: 200,
    easing: 'linear',
    translateX: 0,
  })
}

const translateRegForm = () => {
  regNextBtn.addEventListener('click', () => translateNext())
  const regReturnBtn = document.querySelector('.enter-form__return-btn')
  
  regReturnBtn.addEventListener('click', () => translateBack())
}
translateRegForm()

const regSecSection = document.querySelector('#reg-second-section')
regTypeUser.forEach(el => {
  el.addEventListener('click', () => {
    if (el.getAttribute('id') === 'user-reg' && el.checked) {
      regSecSection.innerHTML = `
      <div class="enter-form_top">
        <h2>Основная информация</h2>
        <span class="enter-form__return-btn">Вернуться</span>
      </div>
      <div class="edit-page__item-row">
        <p>ФИО</p>
        <input type="text" name="name">
        <span data-validate-for="name"></span>
      </div> 
      <div class="edit-page__radio-row">
        <p>Пол</p>
        <div class="radio__list">
          <div class="radio__item">
            <input type="radio" name="sex" id="male" value="Мужской" checked>
            <label for="male">Мужской</label>
          </div>
          <div class="radio__item">
            <input type="radio" name="sex" id="female" value="Женский">
            <label for="female">Женский</label>
          </div>
        </div>
      </div> 
      <div class="edit-page__item-row">
        <p>Дата рождения</p>
        <input type="date" name="birth_date">
        <span data-validate-for="birth_date"></span>
      </div>
      <div class="edit-page__item-row">
        <p>Город</p>
        <select name="city">
          <option value="Южно-Сахалинск">Южно-Сахалинск</option>
          <option value="Корсаков">Корсаков</option>
          <option value="Холмск">Холмск</option>
          <option value="Оха">Оха</option>
          <option value="Поронайск">Поронайск</option>
          <option value="Долинск">Долинск</option>
          <option value="Ноглики">Ноглики</option>
          <option value="Александровск-Сахалинский">Александровск-Сахалинский</option>
          <option value="Невельск">Невельск</option>
          <option value="Углегорск">Углегорск</option>
          <option value="Анива">Анива</option>
          <option value="Тымовское">Тымовское</option>
          <option value="Смирных">Смирных</option>
          <option value="Южно-Курильск">Южно-Курильск</option>
          <option value="Шахтерск">Шахтерск</option>
          <option value="Макаров">Макаров</option>
          <option value="Томари">Томари</option>
          <option value="Северо-Курильск">Северо-Курильск</option>
          <option value="Курильск">Курильск</option>
        </select>
      </div>
      <div class="enter-form__btns">
        <button type="submit" class="btn-filled">Зарегистрироваться</button>
      </div>
      `
      translateRegForm()
    }
    else {
      regSecSection.innerHTML = `
      <div class="enter-form_top">
        <h2>Основная информация</h2>
        <span class="enter-form__return-btn">Вернуться</span>
      </div>
      <div class="edit-page__item-row">
        <p>Название компании</p>
        <input type="text" name="name">
        <span data-validate-for="name"></span>
      </div> 
      <div class="edit-page__item-row">
        <p>Адрес</p>
        <input type="text" name="address">
        <span data-validate-for="address"></span>
      </div> 
      <div class="edit-page__item-row">
        <p>Направление</p>
        <select name="industry" id="industry">
          <option value="Автосервис, автотовары">Автосервис, автотовары</option>
          <option value="Бытовое обслуживание">Бытовое обслуживание</option>
          <option value="Государство">Государство</option>
          <option value="Для дома и офиса">Для дома и офиса</option>
          <option value="Животные, питомцы">Животные, питомцы</option>
          <option value="Компьютеры, интернет">Компьютеры, интернет</option>
          <option value="Красота, здоровье">Красота, здоровье</option>
          <option value="Культура, искусство">Культура, искусство</option>
          <option value="Мебель">Мебель</option>
          <option value="Медицина">Медицина</option>
          <option value="Наука, образование, работа">Наука, образование, работа</option>
          <option value="Недвижимость">Недвижимость</option>
          <option value="Нефть, газ">Нефть, газ</option>
          <option value="Общество">Общество</option>
          <option value="Одежда, обувь, аксессуары">Одежда, обувь, аксессуары</option>
          <option value="Отдых, развлечения, кафе">Отдых, развлечения, кафе</option>
          <option value="Право">Право</option>
          <option value="Продукты питания">Продукты питания</option>
          <option value="Промышленность">Промышленность</option>
          <option value="Реклама, полиграфия">Реклама, полиграфия</option>
          <option value="Рыбная отрасль">Рыбная отрасль</option>
          <option value="СМИ">СМИ</option>
          <option value="Связь">Связь</option>
          <option value="Семья, дети">Семья, дети</option>
          <option value="Строительство, ремонт">Строительство, ремонт</option>
          <option value="Торговля">Торговля</option>
          <option value="Транспорт, перевозки">Транспорт, перевозки</option>
          <option value="Туризм, спорт">Туризм, спорт</option>
          <option value="Финансы">Финансы</option>
          <option value="Экстренные службы">Экстренные службы</option>
        </select>
        <span data-validate-for="industry"></span>
      </div>
      <div class="edit-page__item-row">
        <p>Телефон</p>
        <input type="text" name="phone">
        <span data-validate-for="phone"></span>
      </div>
      <div class="enter-form__btns">
        <button type="submit" class="btn-filled">Зарегистрироваться</button>
      </div>
      `
      translateRegForm()
    }
  })
})