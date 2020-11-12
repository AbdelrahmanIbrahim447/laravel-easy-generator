<?php /** @noinspection ALL */


namespace biscuit\easyGenerator\Traits;


trait RequestsTrait
{
    public function rules($rules)
    {
        if ($rules !== null)
        {
            $rules = explode('|', $rules);
            $new_rules=[];

            foreach ($rules as $rule)
            {
                $new_rules[] = explode('#',$rule);
            }
            $data = '';
            foreach ($new_rules as $index => $rules)
            {
                unset($rules[0]);
                $data .= '\''.$new_rules[$index][0] . '\'=>\'' .implode('|',$rules).'\',
            ';
            }
            return $data;
        }
    }
}