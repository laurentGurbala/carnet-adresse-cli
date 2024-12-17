<?php

/**
 * Class Contact
 * Cette classe représente un contact
 */
class Contact
{
    /**
     * Constructeur de la classe Contact, tous les champs sont optionnels
     * @param int|null $id
     * @param string|null $name
     * @param string|null $email
     * @param string|null $telephone
     */
    public function __construct(private int $id, private string $name, private string $email, private string $phone) {}

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        if (trim($name) !== "") {
            $this->name = $name;
        }
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail($email): void
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
        }
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone($phone): void
    {
        if (trim($phone) !== "") {
            $this->phone = $phone;
        }
    }

    public function __toString()
    {
        return "$this->id, $this->name, $this->email, $this->phone\n";
    }
}
