<?php

class EmployeeService
{
    public static $employee;

    /**
     * @param Employee $item
     * @return string
     */
    public function createEmployee(Employee $item)
    {
        $item->id = uniqid();
        self::$employee = $item;
        return $item->id;
    }
}

class Employee
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $firstname;

    /**
     * @var string
     */
    public $lastname;

    /**
     * @var string
     */
    public $title;

    /**
     * @var int
     */
    public $departmentid;

    /**
     * @var string
     */
    public $officephone;

    /**
     * @var string
     */
    public $cellphone;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $street;

    /**
     * @var string
     */
    public $city;

    /**
     * @var string
     */
    public $state;

    /**
     * @var string
     */
    public $zipcode;

    /**
     * @var string
     */
    public $office;

    /**
     * @var string
     */
    public $photofile;
}
