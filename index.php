<?php
require_once 'vendor/autoload.php';

use HelpScoutApp\DynamicApp;
use Dotenv\Dotenv;
use SwSineos\ShopwareClient;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$app = new DynamicApp('8bed8a91-3fdb-4649-928d-f0be3fd79599');

if ($app->isSignatureValid()) {
        $customer = $app->getCustomer();

		$shopwareClient = new ShopwareClient();
		echo $shopwareClient->getAccessToken();

        $html = array(
			'<h4><a href="[URL here]">'.$customer->getFirstName().' '.$customer->getLastName().'</a></h4>
			<ul class="c-sb-list c-sb-list--two-line">
			  <li class="c-sb-list-item">
				<span class="c-sb-list-item__label">
				  Customer since
				  <span class="c-sb-list-item__text">05/07/2012</span>
				</span>
			  </li>
			  <li class="c-sb-list-item">
				<span class="c-sb-list-item__label">
				  Lifetime Value
				  <span class="c-sb-list-item__text">$1,245.00</span>
				</span>
			  </li>
			  <li class="c-sb-list-item">
				<span class="c-sb-list-item__label">
				  User Role
				  <span class="c-sb-list-item__text">Administrator</span>
				</span>
			  </li>
			</ul>'
        );
        echo $app->getResponse($html);
} else {
        echo "Signature validation failed. 😔";
}