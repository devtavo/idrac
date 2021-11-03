<?php
/**
 * Get the client
 */
require_once __DIR__ . '/vendor/autoload.php';

/**
 * Define configuration
 */

/* Username, password and endpoint used for server to server web-service calls */
Lyra\Client::setDefaultUsername("72382922");
Lyra\Client::setDefaultPassword("prodpassword_zd4Fr0sqh1gYynFc91g4tVq4m7anEvqfNx7C4kjcZLIvM");
Lyra\Client::setDefaultEndpoint("https://api.micuentaweb.pe");

/* publicKey and used by the javascript client */
Lyra\Client::setDefaultPublicKey("72382922:publickey_FkP2oL7jKf3nLkc2y7cGnGZugadAW74WDYdF9b9IYQl9T");

/* SHA256 key */
Lyra\Client::setDefaultSHA256Key("vvr1a5AvojeiU12y3hHe1ZXd3QxFxc0pMW6T7YCsUnOHI");