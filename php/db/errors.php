<?php

class FileNotFoundException extends Exception
{
    protected $filepath;

    public function __construct(string $filepath)
    {
        parent::__construct();
        $this->filepath = $filepath;
    }

    public function get_filepath(): string
    {
        return $this->filepath;
    }

    public function __toString(): string
    {
        return __CLASS__ . ' {filepath: ' . $this->filepath . '}';
    }
}

class InvalidFieldException extends Exception
{
    protected $field;
    protected $value;

    public function __construct(string $field, $value)
    {
        $this->field = $field;
        $this->value = $value;
    }

    public function get_field(): string
    {
        return $this->field;
    }

    public function get_value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return __CLASS__ . ' {field: ' . $this->field . ', value:' . $this->value . '}';
    }
}

class RecordNotFoundException extends Exception
{
    protected $table;

    public function __construct(string $table)
    {
        $this->table = $table;
    }

    public function get_table(): string
    {
        return $this->table;
    }

    public function __toString(): string
    {
        return __CLASS__ . ' {table: ' . $this->table . '}';
    }
}
