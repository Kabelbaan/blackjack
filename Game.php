<?php


class Game
{
    public static function start(User $player, User $dealer)
    {
        $player->addCard(false);
        $player->addCard(false);

        $dealer->addCard(false);
        $dealer->addCard(false);

        // giving false with the first showCards() because the dealer can only show his first card
        $dealer->showCards(false);
        $player->showCards();
    }

    public static function checkWinner(User $player, User $dealer)
    {
        // using vars because otherwise it does the loops multiple times that are defined in the getScore() function
        $dealerScore = $dealer->getScore();
        $playerScore = $player->getScore();

        // calculating what the difference between 21 an the user's score is
        $dealerDiff = 21 - $dealerScore;
        $playerDiff = 21 - $playerScore;

        // which ever difference is lower wins if they are equal it is a tie
        if ($dealerDiff < $playerDiff) {
            print "Dealer has won with a score of " . $dealerScore . PHP_EOL;
        } elseif ($dealerDiff > $playerDiff) {
            print "You have won with a score of " . $playerScore . PHP_EOL;
        } else {
            print "It is a tie! both have a score of " . $playerScore . PHP_EOL;
        }
    }

    public static function finish(User $player, User $dealer)
    {
        // only resetting the users hand decks
        $player->reset();
        $dealer->reset();

        print "The game has finished do you want to play again? Y/N \n";
        $answer = trim(fgets(STDIN));

        return strtolower($answer) === 'y';
    }

    // reason for not putting this in the User class is that I have none..... I am just too lazy to change it
    public static function hit(User $user)
    {
        $user->addCard();

        $user->showCards();
    }
}