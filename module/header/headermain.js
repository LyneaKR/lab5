

document.querySelector('#header').innerHTML = `
<header>
  <div class="countainer">
    <div class="header">
        <div class="header__items">
            <div class="header__items__it">
            <div class="start">
              <a href="index.php" class="logo">gl<span class="logo__osnov">ade</span><span class="logo__tochk">.<span></a>
              <a href="index.php#onas" class="item">О нас</a>
              <a href="./menu.php" class="item">Меню</a>
              <a href="./bronir.php" class="item">Бронирование</a>
            </div>
            <div class="button">
              <a href="./regout.php" class="btn">Аккаунт</a>
            </div>
            </div>
        </div>
        <div class="burger">
            <hr class="qaz"></hr>

        </div>
    </div>
</header>
  ` 
 
  document.querySelector('.burger').addEventListener('click',function() {
    this.classList.toggle('active'); 
    document.querySelector('.header__items').classList.toggle('open');
    document.querySelector('.qaz').classList.toggle('active');
    document.querySelector('body').classList.toggle('active');
    })

