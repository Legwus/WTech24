<?php
namespace Model;
use JsonSerializable;

class Friend implements JsonSerializable {
    private ?string $username;
    private string $status;

    public function __construct(?string $username = null) {
        $this->username = $username;
        $this->status = "pending"; // Standardstatus
    }

    // Getter für username
    public function getUsername(): ?string {
        return $this->username;
    }

    // Getter für status
    public function getStatus(): string {
        return $this->status;
    }

    // Methode zum Setzen des Status auf 'accepted'
    public function setAccepted(): void {
        $this->status = "accepted";
    }

    // Methode zum Setzen des Status auf 'dismissed'
    public function setDismissed(): void {
        $this->status = "dismissed";
    }

    // JSON-Serialisierung
    public function jsonSerialize(): mixed {
        return get_object_vars($this);
    }

    // JSON-Deserialisierung
    public static function fromJson(object $data): self {
        // Erstelle eine neue Instanz mit Standardwerten
        $friend = new self();

        // Übernehme die Attribute aus $data
        foreach ($data as $key => $value) {
            $friend->{$key} = $value;
        }

        return $friend;
    }
}
?>
