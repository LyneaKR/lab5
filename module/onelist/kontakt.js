
document.querySelector('#kontakt').innerHTML = `
 <section>
      <a mane="kontakt"></a>
      <div class="kontakt">
        <div class="kontakt__items">
          <div class="kontakt__items__left">
            <div class="kon">
              <h3 class="kon__title">Контакты</h3>
              <p class="kon__text">Ресторан <span class="kon__text__red">gl</span>ade<span class="kon__text__row">.</span> Таганская ул., 96, Москва</p>
              <p class="kon__dop">
                ПН-ПТ 12:00 - 00:00
                <br>СБ-ВС 12:00 - 01:00
              </p>
              <p class="kon__dop">
                Служба доставки
                <br>ПН-ВС 11:00 - 22:30
                <br>тел. + 7 (911) 421-52-52
              </p>
            </div>
          </div>
          <div style="position:relative;overflow:hidden;" class="kontakt__items__map">
            <a  href="https://yandex.ru/maps/213/moscow/?utm_medium=mapframe&utm_source=maps" style="color:#eee;font-size:12px;position:absolute;top:0px;">Москва</a><a href="https://yandex.ru/maps/213/moscow/?ll=37.478892%2C55.711762&utm_medium=mapframe&utm_source=maps&z=15.32" style="color:#eee;font-size:12px;position:absolute;top:14px;">Москва — Яндекс Карты</a><iframe class="map" src="https://yandex.ru/map-widget/v1/?ll=37.478892%2C55.711762&z=15.32" width="560" height="400" frameborder="1" allowfullscreen="true" style="position:relative;"></iframe>
          </div>
        </div>
      </div>
    </section>
`