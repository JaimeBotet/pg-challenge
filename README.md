# Second-price, Sealed-bid Auction

This challenge consists of 2 classes, `Bid` and `Auction`, interaction one with the other. And a test file `AuctionTest.php` which contains a Static Class that will serve to execute the test and an array with a collection of tests with its inputs and expected outcomes.

To make this run is quite simple, since I opted to make it with namespaces, I thought it would be cleaner to do it directly with composer, and specify the **psr-4**.
So to run the autoload so the namespaces get recognized along the files just execute `composer install`in the console in the root path where you have this project.

Once this is done to run the small test-batch I created just run `php tests/AuctionTest.php` in the console line and it will run all the tests.