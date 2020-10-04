<?php


class Card
{
    public $type;
    public $value;

    public function __construct()
    {
        // Generating a random card
        $types = ["Hearts", "Spades", "Clubs", "Diamonds"];
        // Choose a random type
        $type = $types[array_rand($types)];
        // Choose a random value
        $value = rand(1, 13);

        $this->type = $type;
        // All highcards have a value greater than 10 but in blackjack they are all equal to 10
        $this->value = $value > 10 ? 10 : $value;
    }

    public function getName()
    {
        // E.G. "Hearts "
        $name = $this->type . " ";

        // starting from 11 so that I can just use the value to determine the card's name
        $highCards = [ 11 => "Jack", "Queen", "King"];

        if ($this->value === 1) {
            // E.G. "Hearts Ace"
            $name .= "Ace";
        } elseif ($this->value > 10){
            // E.G. "Hearts Jack"
            $name .= $highCards[$this->value];
        } else {
            // E.G. "Hearts 5"
            $name .= $this->value;
        }

        return $this->colorName($name);
    }

    // Every type like 'Hearts' or 'Diamonds' get their own color
    // disclaimer I am just a programmer not a designer!!!!!
    private function colorName($name)
    {
        switch ($this->type) {
            case "Hearts":
                // color red
                $name = "\033[0;31m" . $name . "\033[0m";
                break;
            case "Diamonds":
                // color blue
                $name = "\033[0;34m" . $name . " \033[0m";
                break;
            case "Spades":
                // color white
                $name = "\033[0;30m" . $name . " \033[0m";
                break;
            case "Clubs":
                // color green
                $name = "\033[0;32m" . $name . " \033[0m";
        }

        return $name;
    }
}