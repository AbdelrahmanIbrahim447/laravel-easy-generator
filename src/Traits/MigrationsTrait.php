<?php


namespace biscuit\easyGenerator\Traits;


trait MigrationsTrait
{
    private $fields;
    public function migrationClassName($name)
    {
        return 'Create' . str_replace(' ', '', ucwords(str_replace('_', ' ', $name))) . 'Table';
    }

    public function migrationFields($fields)
    {
        $fields = explode('|', $fields);
        $spliced_fields = [];

        foreach ($fields as $index => $field) {
            $field = explode(':', $field);
            $spliced_fields[] = $field;
            $modifiers = explode('#', $spliced_fields[$index][1]);
            if (count($modifiers) > 0) {
                {
                    $spliced_fields[$index][1] = $modifiers;
                    foreach ($spliced_fields[$index][1] as $number => $data)
                    {
                        if (isset($spliced_fields[$index][1][$number]) && $number != 0) {
                            $ifHasValue = explode('->', $spliced_fields[$index][1][$number]);
                            if (count($ifHasValue) > 0 && in_array($ifHasValue[0], $this->modifiersLookIn)) {
                                $spliced_fields[$index][1][$number] = $ifHasValue;
                            }
                        }
                    }
                }
            }
            $enum = explode(',', $spliced_fields[$index][1][0]);
            if ($enum[0] == 'enum') {
                $spliced_fields[$index][1][0] = $enum;
            }

            if (!in_array($spliced_fields[$index][1][0], $this->availableTypes) && !is_array($spliced_fields[$index][1][0])) {
                unset($spliced_fields[$index]);
            }
        }

        $spliced_fields = array_values($spliced_fields);

        $this->fields = $spliced_fields;
    }
    public function dataFields()
    {
        $data = '';
        foreach ($this->fields as $field)
        {
            if (!is_array($field[1][0]))
            {
                $data .= '$table->'. $field[1][0] .'(\''. $field[0] .'\')';
                if (is_array($field[1]))
                {
                    foreach ($field[1] as $counter => $extra)
                    {
                        if ($counter > 0)
                        {
                            $data .= '->'. $extra[0];
                            if (array_key_exists(1,$extra))
                            {

                                $data .= '(\'' . $extra[1] . '\')';
                            }else{
                                $data .= '()';
                            }
                        }
                    }
                    $data .= ';
            ';
                }
            }else{
                $data .= '$table->'. $field[1][0][0] .'(\''. $field[0];
                foreach ($field[1][0] as $index => $options)
                {
                    if($index != 0)
                    {
                        if ($index < count($field[1][0])-1)
                        {
                            $data .= '\',['.$options;
                        }elseif($index = count($field[1][0])-1)
                        {
                            $data .= ','.$options.'])';
                        }
                    }
                }
                foreach ($field[1] as $counter => $extra)
                {
                    if($counter != 0)
                    {
                        $data .= '->'. $extra[0];
                        if (array_key_exists(1,$extra))
                        {

                            $data .= '(\'' . $extra[1] . '\')';
                        }else{
                            $data .= '()';
                        }
                    }
                }
                $data .= ';
            ';

            }
        }
         return $data;
    }
    public function foreign($keys)
    {
        $data = '';
        $keys = trim($keys) != '' ? explode('#', $keys) : [];
        $spliced_command = [];
        foreach($keys as $index => $key)
        {
            foreach(explode('|',$key) as $rule)
            {
                $spliced_command[$index][] = $rule;
            };
        }
        foreach($spliced_command as $foreignKey)
        {
            $data .=  '$table->foreign(\'' .$foreignKey[0] . '\')->references(\''.$foreignKey[1]. '\')->on(\'' . $foreignKey[2] . '\');
            ';
        }
        return $data;
    }

    public function migrationDate($date)
    {
        $data = '';
        if($date)
        {
            $data = '$table->timestamps();';
        }
        return $data;
    }
    public function migrationDeletes($deletes)
    {
        $data = '';
        if($deletes)
        {
            $data = '$table->softDeletes();';
        }
        return $data;
    }
}