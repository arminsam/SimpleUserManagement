<?php namespace ASM\Foundation;

use Illuminate\Validation\Factory as Validator;
use ASM\Foundation\Exceptions\ValidationFailedException;

class ASMCommandValidator {

    /**
     * @var laravel validator
     */
    protected $validator;

    /**
     * @var ValidatorInstance
     */
    protected $validation;

    /**
     * @var array
     */
    protected $rules = [];

    /**
     * @var array
     */
    protected $messages = [];

    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Validate the form data
     *
     * @param mixed $command
     * @return mixed
     * @throws ValidationFailedException
     */
    public function validateCommand($command)
    {
        $commandData = $this->normalizeCommandData($command);

        $this->validation = $this->validator->make(
            $commandData,
            $this->getValidationRules(),
            $this->getValidationMessages()
        );

        if ($this->validation->fails())
        {
            throw new ValidationFailedException('Validation failed', $this->getValidationErrors());
        }

        return true;
    }
    /**
     * @return array
     */
    public function getValidationRules()
    {
        return $this->rules;
    }
    /**
     * @return mixed
     */
    public function getValidationErrors()
    {
        return $this->validation->errors();
    }

    /**
     * @return mixed
     */
    public function getValidationMessages()
    {
        return $this->messages;
    }

    /**
     * Normalize the provided data to an array.
     *
     * @param mixed $commandData
     * @return array
     */
    protected function normalizeCommandData($commandData)
    {
        // If an object was provided, maybe the user
        // is giving us something like a DTO.
        // In that case, we'll grab the public properties
        // off of it, and use that.
        if (is_object($commandData))
        {
            $commandData = get_object_vars($commandData);
        }

        // To be able to validate multi-dimensional arrays,
        // we flatten any key which the value is an array.
        $flattenData = array_dot($commandData);

        foreach ($flattenData as $key => $value)
        {
            if (strpos($key, '.'))
            {
                $newKey = str_replace('.', '][', $key) . ']';
                $newKey = preg_replace('/]/', '', $newKey, 1);
                $flattenData[$newKey] = $value;
                unset($flattenData[$key]);
            }
        }

        return $flattenData;
    }

}