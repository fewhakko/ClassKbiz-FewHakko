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
    // $res = $kbank->refreshSession();
    // $res = $kbank->getTransactionHistory(); //โชว์ประวัติการทำรายการต่างๆบลาๆ
    // $res = $kbank->getAccountSummaryList(); //โชว์ข้อมูลผู้ใช้ เช่น เลขบัญชี หรือ จำนวนเงินในบัญชี
    // print_r($res);

?>
