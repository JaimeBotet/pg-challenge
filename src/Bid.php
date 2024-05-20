<?php 

namespace Auction;

class Bid {
	private $bidder;
	private $amount;

	public function __construct($bidder, $amount) {
		$this->bidder = $bidder;
		$this->amount = $amount;
	}

	public function getBidder() {
		return $this->bidder;
	}

	public function getAmount() {
		return $this->amount;
	}
}