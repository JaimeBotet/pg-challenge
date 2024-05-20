<?php

namespace Auction;

use Auction\Bid;

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
		if(empty($this->bids)) return [
			'winner'		=> 'None',
			'winningPrice'	=> $this->reservePrice
		];

		usort($this->bids, function($a, $b) {
			return $b->getAmount() <=> $a->getAmount();
		});

		$winningBid = $this->bids[0];
		$winningBidder = $winningBid->getBidder();
		$losingBids = array_values(array_filter($this->bids, function($bid) use($winningBidder) {
			return $bid->getBidder() !== $winningBidder;
		}));
		
		$winningPrice = $this->reservePrice;
		if(!empty($losingBids) && $losingBids[0]->getAmount() > $winningPrice) $winningPrice = $losingBids[0]->getAmount();

		return [
			'winner'		=> $winningBidder,
			'winningPrice'	=> $winningPrice
		];
	}
}