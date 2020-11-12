<?php


namespace biscuit\easyGenerator\Validators;


class Validators
{
    protected $availableTypes;
    protected $modifiersLookIn;

    public function __construct()
    {

        $this->availableTypes = [
            'string',
            'date',
            'unsignedInteger',
            'unsignedInt',
            'datetime',
            'timestamp',
            'text',
            'integer',
            'bigint',
            'mediumint',
            'tinyint',
            'smallint',
            'boolean',
            'decimal',
            'double',
            'float',
            'enum',
        ];
        $this->modifiersLookIn = [
            'comment',
            'default',
            'first',
            'nullable',
            'unsigned',
        ];


    }

}