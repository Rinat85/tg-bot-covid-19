<?php


$name = $_POST['name'];
$phone = $_POST['phone'];
$date = date("🕒 H:m, 🗓 d.m.Y");
$token = "596441003:AAGoeDQEXrsP-DrghJxYIUCfI4MA3VeqmA4";
$chat_id = "-250421718";
$arr = [
  '📧 ЗАЯВКА' => '#1',
  '🎫 Имя отправителя: ' => $name,
  '📱 Телефон: '  => $phone,
  '📆 Дата получения заявки :' => $date
];

$count = file_get_contents('count.txt');
$txt = "<b>📧 ЗАЯВКА:</b> #$count\n
<b>🎫 Имя компании:</b> $name\n
<b>📱 Номер телефона:</b> $phone\n
<b>📆 Дата получения заявки:</b>\n<pre>$date</pre>";
$txt = urlencode($txt);

$sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}","r");
$count++;
file_put_contents('count.txt', $count);

//header('Location: http://iteamv3.local');
//exit;

//if ($sendToTelegram) {
//    ?>
<!--    <script type="text/javascript">-->
<!--        var form = document.getElementById('overlay-form');-->
<!--        form.addEventListener('submit', function (e) {-->
<!--            e.preventDefault();-->
<!--            alert('DONE!');-->
<!--        });-->
<!--        // var title = document.getElementsByClassName('overlay-form-title');-->
<!--        // var form = document.getElementsByClassName('overlay-form');-->
<!--        // var wrap = document.getElementsByClassName('overlay-form-wrap');-->
<!--        //-->
<!--        //-->
<!--        // title.style.display = 'none';-->
<!--        // form.style.display = 'none';-->
<!--    </script>-->
<?php //} else {
//    echo "Error";
//}

?>