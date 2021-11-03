<?php 
/**
 * Payment done landing page example
 * 
 * To run the example, go to 
 * hhttps://github.com/lyra/rest-php-example
 */

/**
 * I initialize the PHP SDK
 */
require_once 'vendor/autoload.php';
require_once 'keys.php';
require_once 'helpers.php';

/** 
 * Initialize the SDK 
 * see keys.php
 */
$client = new Lyra\Client();

/* No POST data ? paid page in not called after a payment form */
if (empty($_POST)) {
    throw new Exception("no post data received!");
}

/* Use client SDK helper to retrieve POST parameters */
$formAnswer = $client->getParsedFormAnswer();

?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.3.0/styles/dracula.min.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="skinned/assets/paid.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.3.0/highlight.min.js"></script>

    <script type="text/javascript">
    $(document).ready(function() {
        $('pre code').each(function(i, block) {
            hljs.highlightBlock(block);
        });
    });
</script>
</head>
<body>

<?php
if (!$client->checkHash()) {
    signature_error($formAnswer['kr-answer']['transactions'][0]['uuid'], $hashKey, 
                    $client->getLastCalculatedHash(), $_POST['kr-hash']);
    throw new Exception("invalid signature");
}

if ($formAnswer['kr-answer']['orderStatus'] != 'PAID') {
     $title = "Transaction not paid !";
     header('Location: ../error.html');
     
} else {
    $title = "Transaction paid !";
    $var=base64_encode($formAnswer['kr-answer']['shopId']);
    header('Location: ../../success.php?id='.$var);
}
?>

<h1><?php echo $title;?></h1>
<h1><a href="/"></a></h1>

</body></html>
