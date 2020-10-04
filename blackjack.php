<?php
include 'User.php';
include 'Game.php';

echo "\033[1;33m What is your name? \033[0m \n";
$player = new User(trim(fgets(STDIN)));
$dealer = new User('Dealer');

$active = true;

while ($active) {
    Game::start($player, $dealer);

    print "\033[1;33mDo you want to hit or stand?\033[0m";
    print "\033[0;35m H/S \033[0m \n";
    $answer = trim(fgets(STDIN));

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

    if (!$player->isDead()) {
        $dealer->showCards();

        while (true) {
            if ($dealer->getScore() <= 16) {
                Game::hit($dealer);
            } else {
                break;
            }
        }

        if ($dealer->isDead()) {
            print "You won and the dealer lost with a score of " . $dealer->getScore() . "\n\n";
        } else {
            Game::checkWinner($player, $dealer);
        }

        $active = Game::finish($player, $dealer);
    }
}
