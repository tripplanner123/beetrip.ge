<?php 
$id = "51515";

$url = "https://3dacq.georgiancard.ge/payment/start.wsm?lang=KA&merch_id=D6640FE47F9AE706A041C0D913DCF654&back_url_s=" .
 urlencode('https://beetrip.ge/en/success/?o.mer_trx_id=' . $id) . "&back_url_f=" .
urlencode('https://beetrip.ge/en/fail/?o.mer_trx_id=' . $id)."&o.mer_trx_id=". $id . "&preauth=N&o.order_id=62626&o.contract=515152266521&o.amount=3200";

$curl = curl_init();
		// $post_fields = sprintf(
		// 	"command=%s&amount=%s&currency=%d&client_ip_addr=%s&language=%s&description=%smsg_type=%s",
		// 	$this->commandtype,
		// 	$this->amount,
		// 	$this->currency,
		// 	$this->client_ip_addr,
		// 	$this->language,
		// 	$this->description,
		// 	$this->msg_type
		// );
curl_setopt($curl, CURLOPT_SSLVERSION, 0);
// curl_setopt($curl, CURLOPT_POSTFIELDS, $post_fields);
curl_setopt($curl, CURLOPT_VERBOSE, '1');
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, '0');
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, '0');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_TIMEOUT, 120);
// curl_setopt($curl, CURLOPT_SSLCERT, $this->certificate_path);
// curl_setopt($curl, CURLOPT_SSLKEYPASSWD, $this->certificate_password);
curl_setopt($curl, CURLOPT_URL, $url);
$result = curl_exec($curl);
$info = curl_getinfo($curl);

if(curl_errno($curl)){
	echo 'Error:' . curl_errno($curl) . '<br />';
	return false;
}
curl_close($curl);

echo $result;