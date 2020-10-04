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

        for($i = 0; $i < $aces; $i++) {
            if (($score + 10) <= 21) {
                $score += 10;
            }
        }

        return $score;
    }

    public function isDead()
    {
        return $this->getScore() > 21;
    }

    public function reset()
    {
        $this->cards = [];
    }
}