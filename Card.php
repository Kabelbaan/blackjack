<?php


class Card
{
    public $type;
    public $value;

    public function __construct()
    {
        $types = ["Hearts", "Spades", "Clubs", "Diamonds"];
        $type = $types[array_rand($types)];
        $value = rand(1, 13);

        $this->type = $type;
        $this->value = $value > 10 ? 10 : $value;
    }

    public function getName()
    {
        $name = $this->type . " ";
        $highCards = [ 11 => "Jack", "Queen", "King"];

        if ($this->value === 1) {
            $name .= "Ace";
        } elseif ($this->value > 10){
            $name .= $highCards[$this->value];
        } else {
            $name .= $this->value;
        }

        return $this->colorName($name);
    }

    private function colorName($name)
    {
        switch ($this->type) {
            case "Hearts":
                $name = "\033[0;31m" . $name . "\033[0m";
                break;
            case "Diamonds":
                $name = "\033[0;34m" . $name . " \033[0m";
                break;
            case "Spades":
                $name = "\033[0;30m" . $name . " \033[0m";
                break;
            case "Clubs":
                $name = "\033[0;32m" . $name . " \033[0m";
        }

        return $name;
    }
}