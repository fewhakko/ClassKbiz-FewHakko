# ClassKbiz-FewHakko

## ขั้นตอนแรก
ให้เรียกใช้งาน Class แบบนี้
```PHP
header('content-type: text/plain');
require 'ClassKbiz.php';
$kbank = new kbizbyfeweiei(array(
    'username' => '',
    'password' => '',
    'accountFrom' => '',
    'ibId' => '',
    'token' => ''
));
```

## ขั้นตอนที่สองให้ทำการ Login เพื่อเอา ibId กับ Token
เขียนต่อจากขั้นตอนแรกได้เลย
```PHP
// Step2
$dataRsso = $kbank->login();
$result = $kbank->validateSession($dataRsso); 
print_r($result); // เอา Token กับ เอา ibId เอาไปใส่ในโค้ดที่อยู่ขั้นตอนแรก
```

## ขั้นตอนที่สามให้ทำการ แสดงผลข้อมูล 
ให้ลบโค้ดขั้นตอนที่สองออกไปแล้วใส่โค้ดด้านล่างเข้าไปแทน
```PHP
// Step3
$res = $kbank->refreshSession();
$res = $kbank->getTransactionHistory("15/12/2020"); //โชว์ผลประวัติการโอนเงินต่างๆ
$res = $kbank->getAccountSummaryList(); //โชว์ข้อมูลผู้ใช้ เช่น เลขบัญชี หรือ จำนวนเงินในบัญชี
```


## WARNING
This project may be used only for **Educational Purposes**. Developers assume **no liability and are not responsible for any misuse or damage** caused by this program.

ไม่แนะนำให้นำไปใช้โดย**เด็ดขาด** ใช้เพื่อการศึกษา**เท่านั้น**


