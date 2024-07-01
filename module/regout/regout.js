

document.querySelector('#reg').innerHTML = `
    <section>
      <div class="countainer">
        <div class="reg">
          <div class="reg__left">
            <div class="register">
              <h3 class="register__title">Зарегистрироваться в <span class="red">gl</span>ade<span class="row">.</span></h3>
              <form id="registration-form" action="reg.php" class="register__form" method="post">
                <input class="register__form__pole" required placeholder="Ваше фио" name="username" type="text">
                <input class="register__form__pole" required placeholder="Почта" name="email" type="email">
                <input class="register__form__pole" required placeholder="Пароль" name="password" type="password">
                <input class="register__form__pole" required placeholder="Пароль" name="reppassword" type="password">
                <button class="register__form__btn" type="submit">Создать аккаунт</button>
              </form>
              <a class="register__auht">Войти</a>
            </div>
          </div>
          <div class="reg__right">
            <div class="reg__right__text">
              <h3 class="reg__right__text__title"><span class="red">gl</span>ade<span class="row">.</span></h3>
              <p class="reg__right__text__info">Познакомьтесь с рестораном паназиатской кухни.</p>
            </div>
            <img class="reg__right__img" src="./public/logo.svg" alt="logo">
      </div>
    </section>
`

document.querySelector('#auht').innerHTML = `
    <section>
      <div class="countainer">
        <div class="auht">
          <div class="auht__left">
            <div class="autorization">
              <h3 class="autorization__title">Добро пожаловать в <span class="red">gl</span>ade<span class="row">.</span></h3>
              
              <form class="autorization__form" action="auht.php" method="post">
                <input id="email" class="autorization__form__pole" required name="email" placeholder="Почта" type="email">
                <input id="password" class="autorization__form__pole" required name="password" placeholder="Пароль" type="password">
                <div style="margin: 0 auto" class="g-recaptcha" data-sitekey="6Leyof0pAAAAAAXK4Y6L0WxSH9XUCBGxakNgr-yE"></div>
                <button id="rer" class="autorization__form__btn" type="submit">Войти</button>
              </form>
              <a class="autorization__auht">Создать аккаунт</a>
            </div>
          </div>
          <div class="auht__right">
            <div class="auht__right__text">
              <h3 class="auht__right__text__title"><span class="red">gl</span>ade<span class="row">.</span></h3>
              <p class="auht__right__text__info">Познакомьтесь с рестораном паназиатской кухни.</p>
            </div>
            <img class="auht__right__img" src="./public/logo.svg" alt="logo">
      </div>
    </section>
`



const reg = document.querySelectorAll('.reg');
const auht = document.querySelectorAll('.auht');
const authElements = document.querySelectorAll('.autorization__auht');
const regElements = document.querySelectorAll('.register__auht');


authElements.forEach(element => {
  element.addEventListener('click', hideElement);
});

function hideElement() {
  reg.forEach(element => {
    element.style.display = 'flex'; 
  });
  auht.forEach(element => {
    element.style.display = 'none'; 
  });
}

regElements.forEach(element => {
  element.addEventListener('click', hidedElement);
});

function hidedElement() {
  reg.forEach(element => {
    element.style.display = 'none'; 
  });
  auht.forEach(element => {
    element.style.display = 'flex'; 
  });
}


