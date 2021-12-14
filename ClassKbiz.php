<?php

class kbizbyfeweiei {

	public $baseurl = "https://ib.gateway.kasikornbank.com";

	public $response = [];

	function __construct($response = null) {
		$this->response = $response;
	}

	function curlfew($path, $headers, $hstatus, $body) {
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => $this->baseurl.$path,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_HEADER => $hstatus,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => $body,
		CURLOPT_HTTPHEADER => $headers,
		));
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
	}

	function login() {
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => "https://online.kasikornbankgroup.com/kbiz/login.do",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => "userName=".$this->response["username"]."&password=".$this->response["password"]."&tokenId=13229096910&cmd=authenticate&locale=th&custType=&captcha=&app=0",
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/x-www-form-urlencoded',
		),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		$dataRsso = explode("dataRsso=", htmlspecialchars($response))[1];
		$dataRsso = explode('&quot;;', $dataRsso)[0];
		return $dataRsso;
	}

	function validateSession($dataRsso) {
		$info["dataRsso"] = $dataRsso;
		$response = $this->curlfew("/api/authentication/validateSession", array('Content-Type: application/json'), 1, json_encode($info));
		$token = explode("X-SESSION-TOKEN", $response)[1];
		$token = explode("\n", $token);
		$token = trim(explode(":", $token[0])[1]);
		return array('ibId' => explode('"', explode('{"ibId":"', $response)[1])[0], "token" => $token);
	}

	function refreshSession() {
		$headers = array(
			"Connection: keep-alive",
			"X-IB-ID: ".$this->response["ibId"],
			"Authorization: ".$this->response["token"],
			"Content-Type: application/json" ,
		);
		$response = $this->curlfew("/gateway/refreshSession", $headers, 0, '{}');
		return json_decode($response, true);
	}

	function getTransactionHistory($startDate = null, $endDate = null) {
		$startDate = ($startDate == null) ? date("d/m/Y", strtotime('-1 day')) : $startDate;
		$endDate = ($endDate == null) ? date("d/m/Y", time()) : $endDate;
		$headers = array(
			"Connection: keep-alive",
			"X-IB-ID: ".$this->response["ibId"],
			"Authorization: ".$this->response["token"],
			"Content-Type: application/json" ,
		);
		$body = '{"approveStatusList":[],"transStatus":[],"pageNumber":1,"pageAmount":5,"custType":"I","lang":"th","accountFrom":"'.$this->response["accountFrom"].'","accountFromType":"SA","ownerType":"Retail","ownerId":"'.$this->response["ibId"].'","startDate":"'.$startDate.'","endDate":"'.$endDate.'","tranType":"","accountTo":"","bankCode":""}';
		$response = $this->curlfew("/api/transactioninquiry/getTransactionHistoryMaker", $headers, 0, $body);
		return json_decode($response, true);
	}

	function getAccountSummaryList() {
		$headers = array(
			"Connection: keep-alive",
			"X-IB-ID: ".$this->response["ibId"],
			"Authorization: ".$this->response["token"],
			"Content-Type: application/json" ,
		);
		$body = '{"custType":"I","ownerId":"'.$this->response["ibId"].'","ownerType":"Retail","nicknameType":"OWNAC","pageAmount":6,"lang":"th","isReload":"N"}';
		$response = $this->curlfew("/api/accountsummary/getAccountSummaryList", $headers, 0, $body);
		return json_decode($response, true);
	}
}
