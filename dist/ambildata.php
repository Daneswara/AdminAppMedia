<?php
require_once 'twitteroauth/twitteroauth.php';
define('CONSUMER_KEY', 'yVKVTJ4Umci4zHll7nQbOrmRM'); //isikan dengan CONSUMER_KEY anda
define('CONSUMER_SECRET', 'QX5H9BLsCRSAcGUjxNP0c0o8gWyX2g6FEthIWaq8IfEsAbtwH7'); //isikan dengan CONSUMER_KEY anda
define('ACCESS_TOKEN', '253406511-HHLW1TEmPf9apomwulBYDoE9b27WHF8KpXmwa5TU'); //isikan dengan CONSUMER_KEY anda
define('ACCESS_TOKEN_SECRET', 'tRBBcXqriDSLuPSQjDUpJCdRcnAfcxYQs67bQLJemSGVp'); //isikan dengan CONSUMER_KEY anda

// nuramijaya@gmail.com
// http://cariprogram.blogspot.com

function search($query)
{
  $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
  return $connection->get('search/tweets', $query);
}