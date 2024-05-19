<?php

namespace Auction;

use Bid;

class Auction {
	private $reservePrice;
	private $bids;

	public function __construct($reservePrice) {
		$this->reservePrice = $reservePrice;
		$this->bids = [];
	}

	public function addBid($bidder, $amount) {
		if($amount >= $this->reservePrice) {
			$this->bids[] = new Bid($bidder, $amount);
		}
	}

	public function getWinner() {
		if(empty($this->bids)) return null;

		usort($this->bids, function($a, $b) {
			return $b->getAmount() <=> $a->getAmount();
		});

		$winningBid = $this->bids[0];
		$winningBidder = $winningBid->getBidder();

		$winningPrice = $this->reservePrice;

		$losingBidders = array_filter($this->bids, function($bid) {
			$bid->getBidder() !== $winningBidder;
		});

		if($losingBidders[0]->getAmount() > $winningPrice) $winningPrice = $losingBidders[0]->getAmount();

		return [
			'winner' => $winningBidder,
			'winningPrice'	=> $winningPrice
		];
	}
}