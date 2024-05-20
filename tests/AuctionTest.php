<?php

require __DIR__ . '/../vendor/autoload.php';

use Auction\Auction;

class AuctionTest {
	public static function run($reservePrice, $bids, $expected) {
		self::testAuctionWithMultipleBids($reservePrice, $bids, $expected);
		echo "All test passed!\n";
	}

	private static function testAuctionWithMultipleBids($reservePrice, $bids, $expected) {
		$auction = new Auction($reservePrice);

		foreach($bids as $bid) {
			$auction->addBid($bid['bidder'], $bid['amount']);
		}
		$result = $auction->getWinner();
		assert($result['winner'] === $expected['bidder'], 'Winner should be ' . $expected['bidder']);
		assert($result['winningPrice'] === $expected['amount'], 'Winning price should be ' . $expected['amount']);
	}
}

$tests = [
	[
		'reservePrice' => 100,
		'bids' => [
			['bidder' => 'A', 'amount' => 110], ['bidder' => 'A', 'amount' => 130], ['bidder' => 'C', 'amount' => 125], ['bidder' => 'D', 'amount' => 105], ['bidder' => 'D', 'amount' => 115],
			['bidder' => 'D', 'amount' => 90], ['bidder' => 'E', 'amount' => 135], ['bidder' => 'E', 'amount' => 140]
		],
		'expected' => [
			'bidder' => 'E',
			'amount' => 130
		]
	],
	[
		'reservePrice' => 100,
		'bids' => [
			['bidder' => 'A', 'amount' => 90], ['bidder' => 'B', 'amount' => 95], ['bidder' => 'C', 'amount' => 80], ['bidder' => 'D', 'amount' => 110], ['bidder' => 'D', 'amount' => 120]
		],
		'expected' => [
			'bidder' => 'D',
			'amount' => 100
		]
	],
	[
		'reservePrice' => 100,
		'bids' => [
			['bidder' => 'A', 'amount' => 90], ['bidder' => 'B', 'amount' => 90], ['bidder' => 'C', 'amount' => 95], ['bidder' => 'D', 'amount' => 85], ['bidder' => 'E', 'amount' => 80]
		],
		'expected' => [
			'bidder' => 'None',
			'amount' => 100
		]
	]
];

foreach($tests as $test) {
	AuctionTest::run($test['reservePrice'], $test['bids'], $test['expected']);
}

?>