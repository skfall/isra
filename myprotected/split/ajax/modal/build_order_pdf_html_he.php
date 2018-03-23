<?php 
  $monthes = [
    "01" => "ינואר",
    "02" => "פברואר",
    "03" => "מרץ",
    "04" => "אפריל",
    "05" => "מאי",
    "06" => "יוני",
    "07" => "יולי",
    "08" => "אוגוסטוס",
    "09" => "ספטמבר",
    "10" => "אוקטובר",
    "11" => "נובמבר",
    "12" => "דצמבר",
  ];
?>
  <h1 align="center" style="padding: 0; margin: ">
      <strong>טופס הזמנה</strong>
  </h1>
  <p align="center">
      <strong>ישראסטורג'בע"מ</strong>
  <br>
      <strong>מספר רישיון: 515637189</strong>
  <br>
      אזור תעשיה קיסריה דרום<strong>, </strong>רחוב האשל <strong>7</strong>
  <br>
      <strong>טלפון: 0773609990</strong>
  <br>
      <strong>אימייל: </strong>
      <a href="mailto:info@israstorage.co.il">
          <strong>info@israstorage.co.il</strong>
      </a>
  <br>
      <strong>אתר אינטרנט: </strong>
      <a href="http://www.israstorage.co.il/">
          <strong>www.israstorage.co.il</strong>
      </a>
  </p>
  <p align="center">
      <strong>
        כל המחירים במסגרת טופס ההזמנות מוגדרים ומשמשים על בסיס סעיף    <strong>"</strong>תעריפים עבור אחסון ושירותים ניתנים<strong>" </strong>
        שנמצאים באתר האינטרנט של החברה המצויין לעיל ועל הבסיס תנאי ההסכם אשר נחתם ע<strong>"</strong>י הצדדים בו זמנית עם מילוי טופס ההזמנות הנוכחי.
      </strong>
  </p>
  <h2 align="center">
      <strong>'טופס מס</strong> <small> <?= $order['buch_num'] ?> </small>
  </h2>
  <table cellpadding="6" style="width: 100%;">
    <tr>
      <td style="width:33%;"><strong>תאריך: </strong> </td>
      <td style="width:77% white-space:nowrap;">«<?= date("d", strtotime($order['created'])) ?>» <?= $monthes[date("m", strtotime($order['created']))] ?> <?= date("Y", strtotime($order['created'])) ?></td>
    </tr>
    <tr>
      <td style="width:33%;"><strong>מקום: </strong></td>
      <td style="width:77% white-space:nowrap;">____________________________</td>
    </tr>
    <tr>
      <td style="width:33%;" colspan="2"><h3><strong>הלקוח </strong></h3></td>
    </tr>
    <tr>
      <td style="width:33%;"><span style="display:inline-block;width:30%;">שם מלא:</span></td>
      <td style="width:77% white-space:nowrap;"><?= $order['user_name'] ?></td>
    </tr>
    <tr>
      <td style="width:33%;"><span style="display:inline-block;width:30%;">מספר ת.ז.:</span> </td>
      <td style="width:77% white-space:nowrap;"><?= $order['tz'] ?></td>
    </tr>
    <tr>
      <td style="width:33%;"><span style="display:inline-block;width:30%;">טלפון:</span></td>
      <td style="width:77% white-space:nowrap;">
      <?= preg_replace(["/[^0-9\- ]/", "/^([0-9]{3})/"], ['', '($1)'], $order['desc']['phone']); ?> 
      <?= $order['desc']['second_phone'] ? "  /  ".preg_replace(["/[^0-9\- ]/", "/^([0-9]{3})/"], ['', '($1)'], $order['desc']['second_phone'])."" : "" ?>
      </td>
    </tr>
    <tr>
      <td style="width:33%;"><span style="display:inline-block;width:30%;">כתובת אימייל:</span></td>
      <td style="width:77% white-space:nowrap;"><?= $order['login'] ? $order['login'] : '____________________ @ ________ . ______' ?></td>
    </tr>
    <tr>
      <td style="width:33%;"><span style="display:inline-block;width:30%;">תאריך לידה:</span></td>
      <td style="width:77% white-space:nowrap;">«<?= date("d", strtotime($order['birthday'])) ?>» <?= $monthes[date("m", strtotime($order['birthday']))] ?> <?= date("Y", strtotime($order['birthday'])) ?></td>
    </tr>
    <tr>
      <td style="width:33%;" colspan="2"><h3><strong>כתובת למשלוח דואר:</strong></h3></td>
    </tr>
    <tr>
      <td style="width:33%;"><span style="display:inline-block;width:30%;">מספר בית:</span></td>
      <td style="width:77% white-space:nowrap;"><?= $order['desc']['house'] ?></td>
    </tr>
    <tr>
      <td style="width:33%;"><span style="display:inline-block;width:30%;">רחוב:</span> </td>
      <td style="width:77% white-space:nowrap;"><?= $order['desc']['street'] ?></td>
    </tr>
    <tr>
      <td style="width:33%;"><span style="display:inline-block;width:30%;">עיר:</span></td>
      <td style="width:77% white-space:nowrap;"> <?= $order['desc']['city'] ?></td>
    </tr>
    <tr>
      <td style="width:33%;"><span style="display:inline-block;width:30%;">מיקוד:</span></td>
      <td style="width:77% white-space:nowrap;"> <?= $order['desc']['zipcode'] ?></td>
    </tr>
    <tr>
      <td style="width:33%;"><span style="display:inline-block;width:30%;">כניסה:</span></td>
      <td style="width:77% white-space:nowrap;"> <?= $order['entrance'] ? $order['entrance'] : ' _______________ ' ?></td>
    </tr>
    <tr>
      <td style="width:33%;"><span style="display:inline-block;width:30%;">אינטרקום:</span></td>
      <td style="width:77% white-space:nowrap;"><?= $order['desc']['intercom'] ? $order['desc']['intercom'] : " - "  ?></td>
    </tr>
    <tr>
      <td style="width:33%;"><span style="display:inline-block;width:30%;">קומה:</span></td>
      <td style="width:77% white-space:nowrap;"><?= $order['desc']['floor'] ?></td>
    </tr>
    <tr>
      <td style="width:33%;"><span style="display:inline-block;width:30%;">דירה:</span></td>
      <td style="width:77% white-space:nowrap;"><?= $order['desc']['flat'] ? $order['desc']['flat'] : " - " ?></td>
    </tr>
    <tr>
      <td style="width:33%;"><span style="display:inline-block;width:30%;">מעלית:</span> </td>
      <td style="width:77% white-space:nowrap;"><span style="font-weight: <?= $order['desc']['lift'] ? 'bold' : 'normal'; ?>;">יש</span> / <span style="font-weight: <?= !$order['desc']['lift'] ? 'bold' : 'normal'; ?>;">לא</span> (לסמן)  -  
      <span>עובד</span> / <span>לא עובד</span> (לסמן)</td>
    </tr>
    <tr>
      <td><span style="display:inline-block;width:30%;">מספר ותאריך החוזה:</span></td>
      <td> <?= $order['buch_num'] ? $order['buch_num'] : '_______________' ?> / _____________________</td> <!--«<?= date("d") ?>» <?= $monthes[date("m")] ?> <?= date("Y") ?>-->
    </tr>
    <tr>
      <td><span style="display:inline-block;width:30%;">מספר לקוח:</span></td>
      <td><?= $order['user_number'] ? $order['user_number'] : '_______________' ?></td>
    </tr>
  </table>
  <br pagebreak="true">
  <h2>
      <strong>מזמין את השירותים הבאים:</strong>
  </h2>
  <table style="width:100%;">
    <tr>
      <td style="height: 22px; padding:5px;">השכרת ארגזים לאחסון במחסן: </td>
      <td style="height: 22px; padding:5px;"> - <?= !empty($order['boxes']) ? "_____" : "_____" ?> יח'.</td>
      <td style="height: 22px; padding:5px;">מחיר: <?= !empty($order['boxes']) ? "__________" : "__________" ?> ₪</td>
    </tr>
    <tr>
      <td style="height: 22px; padding:5px;">השכרת מקום לאחסון חפצים בודדים: </td>
      <td style="height: 22px; padding:5px;"> - <?= !empty($order['clothes']) ? "_____" : "_____" ?> יח'.</td>
      <td style="height: 22px; padding:5px;">מחיר: <?= !empty($order['clothes']) ? "__________" : "__________" ?> ₪</td>
    </tr>
    <tr>
      <td style="height: 22px; padding:5px;">השכרת משטח במחסן: </td>
      <td style="height: 22px; padding:5px;"> - <?= !empty($order['pallets']) ? "_____" : "_____" ?> יח'.</td>
      <td style="height: 22px; padding:5px;">מחיר: <?= !empty($order['pallets']) ? "__________" : "__________" ?> ₪</td>
    </tr>
  </table>
  <h2>
      <strong>שירותים נוספים:</strong>
  </h2>
  <table style="width:100%;">
    <tr>
      <td style="height: 22px; padding:5px;">החזרת ארגזים ו או חפצים בודדים ללקוח (נסיעה אחת): </td>
      <td style="height: 22px; padding:5px;"> - <?= $order['shipping'] ? "_____" : "_____" ?> יח'.</td>
      <td style="height: 22px; padding:5px;">מחיר: <?= $order['shipping'] ? "__________" : "__________" ?> ₪</td>
    </tr>
    <tr>
      <td style="height: 22px; padding:5px;">___________________: </td>
      <td style="height: 22px; padding:5px;"> - _____ יח'.</td>
      <td style="height: 22px; padding:5px;">מחיר: __________ ₪</td>
    </tr>
    <tr>
      <td style="height: 22px; padding:5px;">___________________: </td>
      <td style="height: 22px; padding:5px;"> - _____ יח'.</td>
      <td style="height: 22px; padding:5px;">מחיר: __________ ₪</td>
    </tr>
  </table>
  <h2>
      <strong>רכישת חומרי אריזה / עטיפה: </strong>
  </h2>
  <table style="width:100%;">
  	<?php if(!empty($order['extras'])): foreach($order['extras'] as $_e): ?>
    <tr>
      <td style="height: 22px; padding:5px;"><?= $_e['title'] ?>: </td>
      <td style="height: 22px; padding:5px;"> - _____ יח'.</td>
      <td style="height: 22px; padding:5px;">מחיר: __________ ₪</td>
    </tr>
	<?php endforeach; else: ?>
    <tr>
      <td style="height: 22px; padding:5px;">___________________: </td>
      <td style="height: 22px; padding:5px;"> - _____ יח'.</td>
      <td style="height: 22px; padding:5px;">מחיר: __________ ₪</td>
    </tr>
    <tr>
      <td style="height: 22px; padding:5px;">___________________: </td>
      <td style="height: 22px; padding:5px;"> - _____ יח'.</td>
      <td style="height: 22px; padding:5px;">מחיר: __________ ₪</td>
    </tr>
    <tr>
      <td style="height: 22px; padding:5px;">___________________: </td>
      <td style="height: 22px; padding:5px;"> - _____ יח'.</td>
      <td style="height: 22px; padding:5px;">מחיר: __________ ₪</td>
    </tr>        	
	<?php endif; ?>
  </table>

  <p>תקופת השכרה מ: «<?= date("d", strtotime($order['delivery_date'])) ?>»  <?= $monthes[date("m", strtotime($order['delivery_date']))] ?> <?= date("Y", strtotime($order['delivery_date'])) ?> עד «<?= date("d", strtotime($order['finish_date'])) ?>» <?= $monthes[date("m", strtotime($order['finish_date']))] ?> <?= date("Y", strtotime($order['finish_date'])) ?></strong>
  <br>מספר ברקוד (בתנאי שניתן): <?= $order['promo_code'] ? $order['promo_code'] : '____________________' ?></p>
  <h2>מחיר כולל עפ "יהסכם:<small> <?= $order['total'] ? '_______________' : '_______________' ?></small> ₪</h2>

  <p>הלקוח חותם על כך שהחברה מקצה ברקוד ייחודי לכל ארגז אחסון, חפץ בודד או קופסה על משטח, וכל ארגז אחסון, חפץ בודד או קופסת קרטון על גבי משטח ארוז וחתום ע"י חותם חד פעמי.</p>
  <p>לסמן ב- V___________ חתימה ____________<br>הלקוח חותם על כך שכל הרכוש השמור בחברת ישראסטורג' בארגזי אחסון, חפצים בודדים או על גבי משטח הינו רכושו הפרטי בבעלותו המלאה וזכותו לנהל אותו על פי ראות עיניו.</p>
  <p>לסמן ב- V___________ חתימה ____________<br>הלקוח מסכים עם תנאי ביטוח ארגזי אחסון, חפצים בודדים וקופסאות על משטח</p>
  <p>לסמן ב- V___________ חתימה ____________<br>הלקוח מסכים עם התנאים הבסיסיים של ההסכם המצורף לטופס ההזמנות הנוכחי, עם תעריפים עבור שירותים בסעיף "תעריפים להשכרת מקום ושירותים ניתנים" שנמצא באתר אינטרנט של החברה.</p>
  <p>לסמן ב- V___________ חתימה ____________</p>
  <table>
    <tr>
      <td style="width: 25%;" colspan="2"><h3>שיטות תשלום:</h3></td>
    </tr>
    <tr>
      <td style="width: 25%;">כרטיס אשראי</td>
      <td style="width: 75%; white-space: nowrap;">«__<?= $order['pay_method_id']==1 ? '_' : '_' ?>__»</td>
    </tr>
    <tr>
      <td style="width: 25%;">העברה בנקאית</td>
      <td style="width: 75%; white-space: nowrap;">«__<?= $order['pay_method_id']==4 ? '_' : '_' ?>__»</td>
    </tr>
    <tr>
      <td style="width: 25%;">לבדוק</td>
      <td style="width: 75%; white-space: nowrap;">«__<?= $order['pay_method_id']==3 ? '_' : '_' ?>__»</td>
    </tr>
    <tr>
      <td style="width: 25%;">מזומן</td>
      <td style="width: 75%; white-space: nowrap;">«__<?= $order['pay_method_id']==2 ? '_' : '_' ?>__»</td>
    </tr>
    <tr>
      <td style="width: 25%;">סכום כולל: </td>
      <td style="width: 75%; white-space: nowrap;"><strong>₪ ____________</strong></td>
    </tr>
  </table>
  <p><strong>חותמת וחתימת החברה שם מלא של נציג החברה:</strong><br><strong>« __________________» (חתימה) «_____________ ___________________» (שם מלא)</strong><br><strong>שם מלא וחתימת הלקוח:</strong><br><strong>« __________________» (חתימה) «_____________ ___________________» (שם מלא)</strong></p>


  <br pagebreak="true"/>
  <h1 align="center">
      <strong>ברקוד</strong>
  </h1>

  <table cellspacing="10">
    <thead>
      <tr>
        <th>מס' סידורי</th>
        <th>מס' ארגז</th>
        <th>מס' תווית</th>
        <th>אישור קבלה</th>
        <th>אישור הספקה</th>
      </tr>
    </thead>
    <tbody>
    	<?php 
        $incr = 0;
    		foreach ($order['boxes'] as $_b): ++$incr;
    	?>
		      <tr>
		        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"><?= $incr ?></td>
		        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"><?= $_b['article'] ? $_b['article'] : ' - ' ?></td>
		        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
		        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
		        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
		      </tr>     	
    	<?php 		
    		endforeach;
      		for ($x= (sizeof($order['boxes'])>20 ? 42 : 20) -(sizeof($order['boxes'])); $x>0; $x--):
		  ?>    	
		      <tr>
		        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
		        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
		        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
		        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
		        <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
		      </tr> 
		  <?php 	
    		endfor;
    	?>
    </tbody>
  </table>

  <br pagebreak="true"/>
  <table cellspacing="10">
    <thead>
      <tr>
        <th>מס' סידורי</th>
        <th>מס' פריט חריג</th>
        <th>אישור קבלה</th>
        <th>אישור הספקה</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        $incr = 0;
        foreach ($order['clothes'] as $_c): ++$incr;
      ?>
          <tr>
            <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"><?= $incr ?></td>
            <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
            <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
            <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
          </tr>       
      <?php     
        endforeach;
          for ($x=(sizeof($order['boxes'])>20 ? 42 : 20)-(sizeof($order['boxes'])); $x>0; $x--):
      ?>      
          <tr>
            <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
            <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
            <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
            <td style="height: 30px; padding: 5px; border-bottom: 1px solid #000;"></td>
          </tr> 
      <?php   
        endfor;
      ?>
    </tbody>
  </table>

  <br pagebreak="true"/>
  <h1 align="center">
      <strong>טופס קבלה / החזרה</strong>
  </h1>
  <p>תאריך: «_____» ________________ ________
  </p>
  <p>בזה הלקוח מאשר שקיבל מהחברה את כל רכושו הפרטי הנמצא בארגזי אחסון, חפצים
    בודדים, כל הציוד השמור על גבי משטח הרשום בטופס הזמנה זה ובהתאם לברקוד.
    האריזה המקורית, סרטי בטחון, חותמים, גומיות – ללא נזק. הסימונים המתאימים
    לגבי ההחזרה נמצאים בסעיף "ברקוד"
  </p>
  <p>מרגע קבלת אפשרות גישה לחפצים בתוך ארגזי האחסון , חפצים בודדים וחפצים
    בקופסאות על משטחים הלקוח קיבל על עצמו את האחריות המלאה עבור רכושו אשר היה
    ממוקם בארגזי אחסון/ או כחפצים בודדים /או בקופסאות קרטון על משטח.
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
      <strong>חותמת וחתימת החברה שם מלא של נציג החברה:</strong>
  </p>
  <p>
      <strong></strong>
  </p>
  <p>
      <strong>«__________________» (חתימה) «_____________ ___________________» (שם מלא)</strong>
  </p>
  <p>
      <strong></strong>
  </p>
  <p>
      <strong></strong>
  </p>
  <p>
      <strong>שם מלא וחתימת הלקוח:</strong>
  </p>
  <p>
      <strong></strong>
  </p>
  <p>
      <strong>« __________________» (חתימה) «_____________ ___________________» (שם מלא)</strong>
  </p>
  <p>
      <strong></strong>
  </p>
