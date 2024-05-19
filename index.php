<?php

$bids = [
    ['name' => 'Alice', 'bid' => 100],
    ['name' => 'Bob', 'bid' => 120],
    ['name' => 'Carol', 'bid' => 80]
];

function secondPriceAuction($bids) {
    // Sort bids in descending order
    usort($bids, function($a, $b) {
        return $b['bid'] <=> $a['bid'];
    });
    
    // Winner is the highest bidder
    $winner = $bids[0];
    
    // Price to pay is the second highest bid
    $priceToPay = $bids[1]['bid'];
    
    return [
        'winner' => $winner['name'],
        'winningBid' => $winner['bid'],
        'pricePaid' => $priceToPay
    ];
}

$result = secondPriceAuction($bids);

echo "Winner: " . $result['winner'] . "\n";
echo "Winning Bid: " . $result['winningBid'] . "\n";
echo "Price Paid: " . $result['pricePaid'] . "\n";
