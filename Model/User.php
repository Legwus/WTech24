<?php

namespace Model;

use JsonSerializable;

class User implements JsonSerializable
{
    private string $name;
    private string $username;
    private string $fname;
    private string $surname;
    private string $coffeeTea;
    private string $bio;
    private bool $radio;
    private array $versions;

    public function getVersions(): array
    {
        return $this->versions;
    }

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

    public function getRadio(): bool
    {
        return $this->radio;
    }

    public function setVersions(array $versions): void
    {
        $this->versions = $versions;
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

    public function setRadio(bool $radio): void
    {
        $this->radio = $radio;
    }



    public function __construct(array $versions, string $name, string $fname, string $surname, string $coffeeTea, string $bio, bool $radio)
    {
        $this->versions = $versions;
        $this->name = $name;
        $this->fname = $fname;
        $this->surname = $surname;
        $this->coffeeTea = $coffeeTea;
        $this->bio = $bio;
        $this->radio = $radio;
    }


    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }

    public static function fromJson(object $data): self
    {
        // Erstelle eine neue Instanz mit einem leeren Namen
        $user = new self([], "", "", "", "", "", true);

        // Übernehme die Attribute aus $data
        foreach ($data as $key => $value) {
            // Setze die Eigenschaften dynamisch
            $user->{$key} = $value;
        }

        return $user;
    }
}
