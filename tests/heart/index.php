<?php

class User
{
    public $name;
    private $password;

    public function getName(): string
    {
        return $this->name;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
    private $email;

    public function __construct(string $name,string $password)
    {
        $this->name = $name;
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
}

$user = new User('Lucas', 'Pa$$w0rd');
$user->setEmail('lucasopf@gmail.com');
echo $user->getEmail() . "<br>";
echo $user->getPassword() . "<br>";
echo $user->getName() . "<br>";