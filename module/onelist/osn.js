

// 1 слайд
document.querySelector('#main').innerHTML = `
    <section>
      <div class="countainer">
        <div class="main">
          <div id="slides" class="main__slider">
            <img class="slide active" src="./public/ondeslide.png" alt="foto">
            <img class="slide" src="./public/twoeslide.png" alt="foto">
            <img class="slide" src="./public/threeeslide.png" alt="foto">
            <img class="slide" src="./public/foureslide.png" alt="foto">
          </div>
          <div class="button">
            <a href="./menu.php" class="btn">Подробнее</a>
          </div>
        </div>
      </div>
    </section>
  ` 

  const slides = document.querySelectorAll('.slide');
  let currentSlide = 0;
  
  function showSlide(n) {
    slides[currentSlide].classList.remove('active');
    currentSlide = (n + slides.length) % slides.length;
    slides[currentSlide].classList.add('active');
  }
  function nextSlide() {
    showSlide(currentSlide + 1);
  }
  let intervalId = setInterval(nextSlide, 4000); 



