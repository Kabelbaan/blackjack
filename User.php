<?php
include 'card.php';

class User
{
    public $username;
    private $cards;

    public function __construct(string $name)
    {
        $this->username = $name;
        $this->cards = [];
    }

    public function showCards($all = true)
    {
        print $this->username . " has: \n";

        // $all var is given if the current user object is the dealer and it is the first time he shows his card.
        if ($all) {
            foreach ($this->cards as $card) {
                print $card->getName() . PHP_EOL;
            }
        } else {
            print $this->cards[0]->getName() . PHP_EOL;
            print "Anonymous card \n";
        }

        print PHP_EOL;
    }

    public function addCard($canShow = true)
    {
        $newCard = new Card();

        $this->cards[] = $newCard;

        if ($canShow) {
            print $this->username . " has got " . $newCard->getName() . "\n\n";
        }
    }

    public function getScore()
    {
        $score = 0;
        $aces = 0;

        foreach ($this->cards as $card) {
            if ($card->value === 1) {
                $aces += 1;
            }
            $score += $card->value;
        }

        // used a for loop since there can be multiple aces in a single hand
        // checking if an ace should be worth 1 or 11 (doing +10 because 1 was already added in the foreach loop)
        for($i = 0; $i < $aces; $i++) {
            if (($score + 10) <= 21) {
                $score += 10;
            }
        }

        return $score;
    }

    // Don't question the names
    public function isDead()
    {
        return $this->getScore() > 21;
    }

    public function reset()
    {
        $this->cards = [];
    }
}