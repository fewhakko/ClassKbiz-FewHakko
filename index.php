<?php
    header('content-type: text/plain');
    require 'ClassKbiz.php';
    $kbank = new kbizbyfeweiei(array(
        'username' => '',
        'password' => '',
        'accountFrom' => '',
        'ibId' => '',
        'token' => ''
    ));

    //Step1
    // $dataRsso = $kbank->login();
    // $result = $kbank->validateSession($dataRsso); // เอา Token กับ เอา ibId
    // print_r($result);

    // Step2
    // $refresh = $kbank->refreshSession();
    // $AccountSummaryList = $kbank->getAccountSummaryList(); //โชว์ข้อมูลผู้ใช้ เช่น เลขบัญชี หรือ จำนวนเงินในบัญชี
    // $res = $kbank->getTransactionHistory(); //โชว์ผลประวัติการโอนเงินต่างๆ
    // $res = $kbank->GetNumberOtherBank($res); //ถ้าต้องการให้แสดงเลขบัญชีครบทุกหลัก ให้ใส่ฟังชั่นนี้ตามหลัง
    // print_r($res);

?>
