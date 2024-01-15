<?php
class UserModel
{

    // Los atributos del modelo
    private $id;
    private $username;
    private $email;
    private $password;
    private $addresses;
    private $orderHistory;
    private $ongoingOrders;

    // Constructor para el modelo de los datos de usuario.
    public function __construct($id, $username, $email, $password, $addresses, $orderHistory, $ongoingOrders)
    {

        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->addresses = $addresses;
        $this->orderHistory = $orderHistory;
        $this->ongoingOrders = $ongoingOrders;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of addresses
     */ 
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * Set the value of addresses
     *
     * @return  self
     */ 
    public function setAddresses($addresses)
    {
        $this->addresses = $addresses;

        return $this;
    }

    /**
     * Get the value of orderHistory
     */ 
    public function getOrderHistory()
    {
        return $this->orderHistory;
    }

    /**
     * Set the value of orderHistory
     *
     * @return  self
     */ 
    public function setOrderHistory($orderHistory)
    {
        $this->orderHistory = $orderHistory;

        return $this;
    }

    /**
     * Get the value of ongoingOrders
     */ 
    public function getOngoingOrders()
    {
        return $this->ongoingOrders;
    }

    /**
     * Set the value of ongoingOrders
     *
     * @return  self
     */ 
    public function setOngoingOrders($ongoingOrders)
    {
        $this->ongoingOrders = $ongoingOrders;

        return $this;
    }
}