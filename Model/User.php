<?php
namespace Model;
use JsonSerializable;

class User implements JsonSerializable {
    private string $name;

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function jsonSerialize(): mixed {
        return get_object_vars($this);
    }

    public static function fromJson(object $data): self {
        // Erstelle eine neue Instanz mit einem leeren Namen
        $user = new self("");

        // Übernehme die Attribute aus $data
        foreach ($data as $key => $value) {
            // Setze die Eigenschaften dynamisch
            $user->{$key} = $value;
        }

        return $user;
    }
}
?>
