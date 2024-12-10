<?php

namespace Model;

use JsonSerializable;

class User implements JsonSerializable
{
    private string $username;
    private string $name;
    private string $fname;
    private string $surname;
    private string $coffeeTea = "coffee";
    private string $bio;
    private bool $radio1;
    private bool $radio2;

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getFirstName(): string
    {
        return $this->fname;
    }

    public function getSurName(): string
    {
        return $this->surname;
    }

    public function getCoffeeTea(): string
    {
        return $this->coffeeTea;
    }

    public function getBio(): string
    {

        return $this->bio;
    }

    public function getRadio1(): bool
    {
        return $this->radio1;
    }

    public function getRadio2(): bool
    {
        return $this->radio2;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function setFirstName(string $fname): void
    {
        $this->fname = $fname;
    }

    public function setSurName(string $surname): void
    {
        $this->surname = $surname;
    }

    public function setCoffeeTea(string $coffeeTea): void
    {
        $this->coffeeTea = $coffeeTea;
    }

    public function setBio(string $bio): void
    {
        $this->bio = $bio;
    }

    public function setRadio1(bool $radio1): void
    {
        $this->radio1 = $radio1;
    }

    public function setRadio2(bool $radio2): void
    {
        $this->radio2 = $radio2;
    }

    public function __construct(string $name, string $fname, string $surname, string $coffeeTea, string $bio, bool $radio1, bool $radio2)
    {
        $this->name = $name;
        $this->fname = $fname;
        $this->surname = $surname;
        $this->coffeeTea = $coffeeTea;
        $this->bio = $bio;
        $this->radio1 = $radio1;
        $this->radio2 = $radio2;
    }


    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }

    public static function fromJson(object $data): self
    {
        // Erstelle eine neue Instanz mit einem leeren Namen
        $user = new self("", "", "", "", "", "", true, false);

        // Übernehme die Attribute aus $data
        foreach ($data as $key => $value) {
            // Setze die Eigenschaften dynamisch
            $user->{$key} = $value;
        }

        return $user;
    }
}
