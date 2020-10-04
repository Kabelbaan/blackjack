<?php


class Game
{
    public static function start(User $player, User $dealer)
    {
        $player->addCard(false);
        $player->addCard(false);

        $dealer->addCard(false);
        $dealer->addCard(false);

        $dealer->showCards(false);
        $player->showCards();
    }

    public static function checkWinner(User $player, User $dealer)
    {
        $dealerScore = $dealer->getScore();
        $playerScore = $player->getScore();

        $dealerDiff = 21 - $dealerScore;
        $playerDiff = 21 - $playerScore;

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
        $player->reset();
        $dealer->reset();

        print "The game has finished do you want to play again? Y/N \n";
        $answer = trim(fgets(STDIN));

        return strtolower($answer) === 'y';
    }

    public static function hit(User $user)
    {
        $user->addCard();

        $user->showCards();
    }
}