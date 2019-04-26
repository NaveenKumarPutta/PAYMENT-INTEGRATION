 <html>
<head><style> body{
 margin:0;
 padding: 0;
 font-family:sans-serif;
 background-image: linear-gradient(rgba(0,0,0,0.8),rgba(0,0,0,0.8)),url("bg.jpg");
 background-size: cover; 
}</head>
</style><?php 
$product_name = $_POST["product_name"];
$price = $_POST["product_price"];
$name = $_POST["name"];
$phone = $_POST["phone"];
$email = $_POST["email"];
include 'src/instamojo.php';
$api = new Instamojo\Instamojo('test_3f562cf26adc1fab055fcf9fea0', 'test_c7bc430a6151c937086fb10e224','https://test.instamojo.com/api/1.1/');
try {
    $response = $api->paymentRequestCreate(array(
        "purpose" => $product_name,
        "amount" => $amt,
        "buyer_name" => $name,
        "phone" => $phone,
        "send_email" => true,
        "send_sms" => true,
        "email" => $email,
        'allow_repeated_payments' => false,
        "redirect_url" => "http://thankyou.php",
        "webhook" => "http://webhook.php"
        ));
    //print_r($response);
    $pay_ulr = $response['longurl'];
    
    //Redirect($response['longurl'],302); //Go to Payment page
    header("Location: $pay_ulr");
    exit();
}
catch (Exception $e) {
    print('Error: ' . $e->getMessage());
}     
  ?>
</body>
</html>