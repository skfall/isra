<?php 
  $monthes = [
    "01" => "Января",
    "02" => "Февраля",
    "03" => "Марта",
    "04" => "Апреля",
    "05" => "Мая",
    "06" => "Июня",
    "07" => "Июля",
    "08" => "Августа",
    "09" => "Сентября",
    "10" => "Октября",
    "11" => "Ноября",
    "12" => "Декабря",
  ];
?>
<body>
  <p align="center">
      <strong>ЗАКАЗ</strong>
  </p>
  <p align="center">
      <strong></strong>
  </p>
  <p align="center">
      <strong>Israstorage Ltd. (Компания)</strong>
  </p>
  <p align="center">
      <strong>Регистрационный номер: 515637189</strong>
  </p>
  <p align="center">
      <strong>Адрес: Эдом Галилея 1, Строение Б,</strong>
  </p>
  <p align="center">
      <strong>
          Улица аЭшель 7, Парк Южной Промышленной Зоны, Кесария, Израиль
      </strong>
  </p>
  <p align="center">
      <strong>Телефон: 077 3609990</strong>
  </p>
  <p align="center">
      <strong>Электронная почта: </strong>
      <a href="mailto:info@israstorage.co.il">
          <strong>info@israstorage.co.il</strong>
      </a>
  </p>
  <p align="center">
      <strong>Интернет-сайт: </strong>
      <a href="http://www.israstorage.co.il/">
          <strong>www.israstorage.co.il</strong>
      </a>
  </p>
  <p align="center">
      <strong>
          Все цены на услуги в рамках данной Книги заказов формируются и
          применяются на основе Положения «Тарифы на хранение и предоставляемые
          услуги», которое публикуется на сайте Компании, указанном выше, и на
          основании условий Договора, который подписывается Сторонами
          одновременно с заполнением бланка данной Книги заказов
      </strong>
  </p>
  <p align="center">
      <br>
      <strong>ЗАКАЗ № </strong> <?= $order['id'] ?>
      <br>
  </p>
  <p>
      <strong>Дата: </strong> «<?= date("d", strtotime($order['created'])) ?>» <?= $monthes[date("m", strtotime($order['created']))] ?> <?= date("Y", strtotime($order['created'])) ?>
  </p>
  <p>
      <strong>Место: </strong> ____________________________
  </p>
  <p>
      <strong>Клиент:</strong>
  </p>
  <p>
      <span style="display:inline-block;width:30%;">ФИО:</span> <?= $order['name'] ?> <?= $order['fname'] ?>
  </p>
  <p>
      <span style="display:inline-block;width:30%;">Номер Т.З.:</span> <?= $order['tz'] ?>
  </p>
  <p>
      <span style="display:inline-block;width:30%;">Телефон:</span> <?= $order['desc']['phone'] ?> <?= $order['desc']['second_phone'] ? " - ".$order['desc']['second_phone']."" : "" ?>
  </p>
  <p>
      <span style="display:inline-block;width:30%;">Адрес электронной почты:</span> <?= $order['login'] ?>
  </p>
  <p>
      <span style="display:inline-block;width:30%;">Дата рождения:</span>  «<?= date("d", strtotime($order['birthday'])) ?>» <?= $monthes[date("m", strtotime($order['birthday']))] ?> <?= date("Y", strtotime($order['birthday'])) ?>
  </p>
  <p>
      <span style="display:inline-block;width:30%;"><strong>Почтовый адрес:</strong></span>
  </p>
  <p>
      <span style="display:inline-block;width:30%;">Дом:</span> <?= $order['desc']['house'] ?>
  </p>
  <p>
      <span style="display:inline-block;width:30%;">Улица:</span> <?= $order['desc']['street'] ?>
  </p>
  <p>
      <span style="display:inline-block;width:30%;">Город:</span> <?= $order['desc']['city'] ?>
  </p>
  <p>
      <span style="display:inline-block;width:30%;">Индекс:</span> <?= $order['desc']['zipcode'] ?>
  </p>
  <p>
      <span style="display:inline-block;width:30%;">Подъезд:</span> <span>да</span> / <span>нет</span>
  </p>
  <p>
      <span style="display:inline-block;width:30%;">Домофон:</span> <?= $order['desc']['intercom'] ? $order['desc']['intercom'] : " - "  ?>
  </p>
  <p>
      <span style="display:inline-block;width:30%;">Этаж:</span> <?= $order['desc']['floor'] ?>
  </p>
  <p>
      <span style="display:inline-block;width:30%;">Квартира:</span> <?= $order['desc']['flat'] ? $order['desc']['flat'] : " - " ?>
  </p>
  <p>
      <span style="display:inline-block;width:30%;">Лифт:</span> <span style="font-weight: <?= $order['desc']['lift'] ? 'bold' : 'normal'; ?>;">есть</span> / <span style="font-weight: <?= !$order['desc']['lift'] ? 'bold' : 'normal'; ?>;">нет</span> (отметить)  -  <span>работает</span> / <span>не работает</span> (отметить)
  </p>
  <p>
      <span style="display:inline-block;width:30%;">Номер/Дата Договора:</span> _______________ / «<?= date("d") ?>» <?= $monthes[date("m")] ?> <?= date("Y") ?>
  </p>
  <p>
      <span style="display:inline-block;width:30%;">Номер Пользователя (присваивается в системе):</span> <?= $order['user_id'] ?>
  </p>
  <p>
      <strong></strong>
  </p>

  <p>
      <strong>Заказывает у Компании следующие услуги:</strong>
  </p>
  <table style="width:100%;">
    <tr>
      <td style="height: 25px; padding:5px;">Боксы: </td>
      <td style="height: 25px; padding:5px;"> - <?= !empty($order['boxes']) ? sizeof($order['boxes']) : "_____" ?> шт.</td>
      <td style="height: 25px; padding:5px;">Стоимость: <?= !empty($order['boxes']) ? array_sum(array_column($order['boxes'], 'price')) : "_____" ?> шекелей</td>
    </tr>
    <tr>
      <td style="height: 25px; padding:5px;">Отдельные предметы: </td>
      <td style="height: 25px; padding:5px;"> - <?= !empty($order['clothes']) ? sizeof($order['clothes']) : "_____" ?> шт.</td>
      <td style="height: 25px; padding:5px;">Стоимость: <?= !empty($order['clothes']) ? array_sum(array_column($order['clothes'], 'price')) : "_____" ?> шекелей</td>
    </tr>
    <tr>
      <td style="height: 25px; padding:5px;">Паллета: </td>
      <td style="height: 25px; padding:5px;"> - <?= !empty($order['pallets']) ? sizeof($order['pallets']) : "_____" ?> шт.</td>
      <td style="height: 25px; padding:5px;">Стоимость: <?= !empty($order['pallets']) ? array_sum(array_column($order['pallets'], 'price')) : "_____" ?> шекелей</td>
    </tr>
  </table>

  <p>
      <strong>Дополнительные услуги:</strong>
  </p>
  <table style="width:100%;">
    <tr>
      <td style="height: 25px; padding:5px;">Возврат (один рейс): </td>
      <td style="height: 25px; padding:5px;"> - <?= $order['shipping'] ? ceil($order['shipping'] / $order['delivery_price']) : '_____' ?> шт.</td>
      <td style="height: 25px; padding:5px;">Стоимость: <?= $order['shipping'] ? $order['shipping'] : '_____' ?> шекелей</td>
    </tr>
    <tr>
      <td style="height: 25px; padding:5px;">___________________: </td>
      <td style="height: 25px; padding:5px;"> - _____ шт.</td>
      <td style="height: 25px; padding:5px;">Стоимость: _____ шекелей</td>
    </tr>
    <tr>
      <td style="height: 25px; padding:5px;">___________________: </td>
      <td style="height: 25px; padding:5px;"> - _____ шт.</td>
      <td style="height: 25px; padding:5px;">Стоимость: _____ шекелей</td>
    </tr>
  </table>

  <p>
      <strong>Приобретение упаковочных материалов: </strong>
  </p>
  <table style="width:100%;">
  	<?php if(!empty($order['extras'])): foreach($order['extras'] as $_e): ?>
    <tr>
      <td style="height: 25px; padding:5px;"><?= $_e['title'] ?>: </td>
      <td style="height: 25px; padding:5px;"> - <?= $_e['quantity'] ?> шт.</td>
      <td style="height: 25px; padding:5px;">Стоимость: <?= $_e['amount'] ?> шекелей</td>
    </tr>
	<?php endforeach; else: ?>
    <tr>
      <td style="height: 25px; padding:5px;">___________________: </td>
      <td style="height: 25px; padding:5px;"> - _____ шт.</td>
      <td style="height: 25px; padding:5px;">Стоимость: _____ шекелей</td>
    </tr>
    <tr>
      <td style="height: 25px; padding:5px;">___________________: </td>
      <td style="height: 25px; padding:5px;"> - _____ шт.</td>
      <td style="height: 25px; padding:5px;">Стоимость: _____ шекелей</td>
    </tr>
    <tr>
      <td style="height: 25px; padding:5px;">___________________: </td>
      <td style="height: 25px; padding:5px;"> - _____ шт.</td>
      <td style="height: 25px; padding:5px;">Стоимость: _____ шекелей</td>
    </tr>        	
	<?php endif; ?>
  </table>

  <p>
  <strong>Срок аренды: с «<?= date("d", strtotime($order['delivery_date'])) ?>»  <?= $monthes[date("m", strtotime($order['delivery_date']))] ?> <?= date("Y", strtotime($order['delivery_date'])) ?> по «<?= date("d", strtotime($order['finish_date'])) ?>» <?= $monthes[date("m", strtotime($order['finish_date']))] ?> <?= date("Y", strtotime($order['finish_date'])) ?>
  </strong>
  </p>
  <p>
  <strong>Номер промокода (если таковой присвоен): <?= $order['promo_code'] ? $order['promo_code'] : '____________________' ?>
  </strong>
  </p>
  <p>
  <strong>Общая стоимость по Договору: <?= $order['total'] ? $order['total'] : '________' ?> шекелей 
  </strong>
  </p>
  <p>
      Клиент подтверждает, что каждому принимаемому Компанией Боксу, Отдельному
      предмету, или Коробке на Паллете, присвоен штрих-код, что каждый
      принимаемый Компанией Бокс, Отдельный предмет, или Коробка на Паллете
      упакована и опломбирована согласно Правилам Компании, а номер пломбы
      занесён в Приложение «ШТРИХ-КОД»:
  </p>
  <p>
      «_____» (отметить галочкой) «_________» (поставить подпись)
  </p>
  <p>
      Клиент подтверждает, что всё сдаваемое компании имущество в Боксах, в виде
      Отдельных предметов или в Коробке на Паллете принадлежит ему/ей по праву
      собственности и он/она вправе распоряжаться этим имуществом по своему
      усмотрению:
  </p>
  <p>
      «_____» (отметить галочкой) «_________» (поставить подпись)
  </p>
  <p>
      Клиент согласен с условиями страхования Боксов, Отдельных предметов или в
      Коробках на Паллетах
  </p>
  <p>
      «_____» (отметить галочкой) «_________» (поставить подпись)
  </p>
  <p>
      Настоящим Клиент соглашается с основными условиями Договора, прилагаемого к
      настоящему бланку Книги заказов, с основными условиями Пользовательского
      соглашения и с тарифами на услуги в Приложении «Тарифы на аренду места и
      предоставляемые услуги», которые размещены на Интернет-сайте Компании
  </p>
  <p>
      «_____» (отметить галочкой) «_________» (поставить подпись)
  </p>
  <p>
      <strong>Вид оплаты:</strong>
  </p>
  <p>
      Кредитная карта «__<?= $order['pay_method_id']==1 ? 'V' : '_' ?>__» (отметить галочкой)
  </p>
  <p>
      Банковский перевод «_____» (отметить галочкой)
  </p>
  <p>
      Чек «__<?= $order['pay_method_id']==3 ? 'V' : '_' ?>__» (отметить галочкой)
  </p>
  <p>
      Наличные «__<?= $order['pay_method_id']==2 ? 'V' : '_' ?>__» (отметить галочкой)
  </p>
  <p>
      <strong></strong>
  </p>
  <p>
      <strong>Оплаченная сумма: ________ шекелей</strong>
  </p>
  <p>
      <strong></strong>
  </p>
  <p>
      <strong>Печать Компании, подпись и ФИО сотрудника Компании:</strong>
  </p>
  <p>
      <strong></strong>
  </p>
  <p>
      <strong>«</strong>
      ____________________<strong>» (подпись) «</strong>____________________
      ____________________<strong>» (ФИО полностью)</strong>
  </p>
  <p>
      <strong></strong>
  </p>
  <p>
      <strong></strong>
  </p>
  <p>
      <strong>Подпись и ФИО Клиента:</strong>
  </p>
  <p>
      <strong></strong>
  </p>
  <p>
      <strong>«</strong>
      ____________________<strong>» (подпись) «</strong>____________________
      ____________________<strong>» (ФИО полностью)</strong>
  </p>
  <p>
      <strong></strong>
  </p>

  <br pagebreak="true"/>
  <h1 align="center">
      <strong>Приложение «Штрих-код»</strong>
  </h1>

  <table cellspacing="10">
    <thead>
      <tr>
        <th>Вид услуги:</th>
        <th>Штрих-код:</th>
        <th>Номер пломбы:</th>
        <th>Отметка о приёме:</th>
        <th>Отметка о возврате:</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
      </tr> 
      <tr>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
      </tr>
      <tr>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
      </tr>
      <tr>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
      </tr>
      <tr>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
      </tr>
      <tr>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
      </tr>
      <tr>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
      </tr>
      <tr>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
      </tr>
      <tr>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
      </tr>
      <tr>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
      </tr>
      <tr>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
      </tr>
      <tr>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
      </tr>
      <tr>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
      </tr>
      <tr>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
      </tr>
      <tr>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
      </tr>
      <tr>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
      </tr>
      <tr>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
      </tr>
      <tr>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
      </tr>
      <tr>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
      </tr>
      <tr>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
      </tr>
      <tr>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
      </tr> 
      <tr>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
      </tr> 
      <tr>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
      </tr> 
      <tr>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
      </tr> 
      <tr>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
      </tr> 
      <tr>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
      </tr> 
      <tr>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
      </tr> 
      <tr>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
      </tr> 
      <tr>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
      </tr> 
      <tr>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
      </tr> 
      <tr>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
      </tr> 
      <tr>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
      </tr> 
      <tr>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
      </tr> 
      <tr>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
      </tr> 
      <tr>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
      </tr> 
      <tr>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
      </tr> 
      <tr>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
      </tr>   
    </tbody>
  </table>


  <br pagebreak="true"/>
  <h1 align="center">
      <strong>Приложение «Акт Сдачи-Приёмки»</strong>
  </h1>
  <p>
      Дата: «_____» ________________ ________
  </p>
  <p>
      Настоящим Клиент подтверждает, что получил от Компании все без исключений
      сданные ранее Клиенту в рамках настоящего Договора и согласно Приложения
      «ШТРИХ-КОД» Боксы, Отдельные предметы и/или Коробки на Паллетах.
      Оригинальная упаковка, ленты безопасности, пломбы, жгуты не нарушены и не
      повреждены. Соответствующие пометки о получении сделаны в Приложении
      «ШТРИХ-КОД»
  </p>
  <p>
      С момента получения возможности доступа к вещам и предметам в Боксах,
      Отдельным предметам и в Коробках на Паллетах Клиент принял на себя всю
      ответственность за своё имущество, которое размещалось в Боксах, в качестве
      Отдельных предметов и/или в Коробках на Паллетах.
  </p>
  <p>
      <strong></strong>
  </p>
  <p>
      <strong></strong>
  </p>
  <p>
      <strong></strong>
  </p>
  <p>
      <strong>Печать Компании, подпись и сотрудника Компании:</strong>
  </p>
  <p>
      <strong></strong>
  </p>
  <p>
      <strong>«</strong>
      ____________________<strong>» (подпись) «</strong>____________________
      ____________________<strong>» (ФИО полностью)</strong>
  </p>
  <p>
      <strong></strong>
  </p>
  <p>
      <strong></strong>
  </p>
  <p>
      <strong>Подпись и ФИО Клиента:</strong>
  </p>
  <p>
      <strong></strong>
  </p>
  <p>
      <strong>«</strong>
      ____________________<strong>» (подпись) «</strong>____________________
      ____________________<strong>» (ФИО полностью)</strong>
  </p>
  <p>
      <strong></strong>
  </p>
</body>