<?php
include 'User.php';
include 'Game.php';

// All the weird numbers and signs like "\033[1;33m" is to color the output messages
echo "\033[1;33m What is your name? \033[0m \n";
$player = new User(trim(fgets(STDIN)));
$dealer = new User('Dealer');

$active = true;

while ($active) {
    Game::start($player, $dealer);

    print "\033[1;33mDo you want to hit or stand?\033[0m";
    print "\033[0;35m H/S \033[0m \n";
    $answer = trim(fgets(STDIN));

    // Player's turn
    while (strtolower($answer) === 'h') {
        Game::hit($player);

        if ($player->isDead()) {
            print "You lost with a score of " . $player->getScore() . "\n\n";
            break;
        }

        print "\033[1;33mDo you want to hit or stand?\033[0m";
        print "\033[0;35m H/S \033[0m \n";
        $answer = trim(fgets(STDIN));
    }

    print PHP_EOL;

    // Only allow the dealer's turn if player is not dead
    if (!$player->isDead()) {
        $dealer->showCards();

        // Dealer's turn
        while (true) {
            // Dealer has to hit if score is below or equal to 16
            if ($dealer->getScore() <= 16) {
                Game::hit($dealer);
            } else {
                break;
            }
        }

        // If the dealer is not dead check if there is a winner
        if ($dealer->isDead()) {
            print "You won and the dealer lost with a score of " . $dealer->getScore() . "\n\n";
        } else {
            Game::checkWinner($player, $dealer);
        }
    }

    // Game::finish returns a true or false wether the user wants to try again
    // if so the loop will repeat if not the program will stop
    $active = Game::finish($player, $dealer);
}
