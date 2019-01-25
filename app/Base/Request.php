<?php

namespace App\Base;

use App\Base\Contracts\Request as RequestContract;

abstract class Request implements RequestContract
{
    public $thisAttributes = [];
    public $messages = [];
    public $errors;

    /**
     * @param array $data
     *
     * @return Request
     * @author Mohammed Elkady <m.elkady365@gmail.com>
     */
    public function load(array $data): self
    {
        $attributes = (array)$this->attributes();
        foreach ($attributes as $attribute) {
            if (isset($data[$attribute])) {
                $this->thisAttributes[$attribute] = $data[$attribute];
            } else {
                $this->thisAttributes[$attribute] = null;
            }
        }

        return $this;
    }

    /**
     * @return array
     * @author Mohammed Elkady <m.elkady365@gmail.com>
     */
    public function getAttributes(): array
    {
        return (array)$this->thisAttributes;
    }

    /**
     * @param array $attributes
     * @return Request
     * @author Mohammed Elkady <m.elkady365@gmail.com>
     */
    public function setAttributes(array $attributes): self
    {
        foreach ($attributes as $attribute => $value) {
            $this->setAttribute($attribute, $value);
        }

        return $this;
    }

    /**
     * @param string $attribute
     * @param $value
     * @return Request
     * @author Mohammed Elkady <m.elkady365@gmail.com>
     */
    public function setAttribute(string $attribute, $value): self
    {
        $attributes = $this->attributes();
        if (in_array($attribute, $attributes)) {
            $this->thisAttributes[$attribute] = $value;
        }

        return $this;
    }

    /**
     * @param string $attribute
     * @return mixed|null
     * @author Mohammed Elkady <m.elkady365@gmail.com>
     */
    public function getAttribute(string $attribute): array
    {
        return $this->thisAttributes[$attribute] ? $this->thisAttributes[$attribute] : null;
    }

    /**
     * @return array
     * @author Mohammed Elkady <m.elkady365@gmail.com>
     */
    public function messages(): array
    {
        return $this->messages;
    }

    /**
     * @param string $attribute
     * @return mixed
     * @throws \ReflectionException
     * @author Mohammed Elkady <m.elkady365@gmail.com>
     */
    public function __get(string $attribute)
    {
        $method = 'get' . ucfirst($attribute);
        if (method_exists($this, $method)) {
            $reflection = new \ReflectionMethod($this, $method);
            if (!$reflection->isPublic()) {
                throw new \RuntimeException("The called method is not public");
            }
            call_user_func([$this, $method]);
        }

        if (in_array($attribute, $this->attributes())) {
            return $this->thisAttributes[$attribute];
        }
    }

    /**
     * @param $property
     * @param $value
     * @return Request
     * @throws \ReflectionException
     * @author Mohammed Elkady <m.elkady365@gmail.com>
     */
    public function __set(string $property, $value): self
    {
        $method = 'set' . ucfirst($property);
        if (method_exists($this, $method)) {
            $reflection = new \ReflectionMethod($this, $method);
            if (!$reflection->isPublic()) {
                throw new \RuntimeException("The called method is not public");
            }
        }
        if (in_array($property, $this->attributes())) {
            $this->thisAttributes[$property] = $value;
        }

        return $this;
    }

    /**
     * @return bool
     * @author Mohammed Elkady <m.elkady365@gmail.com>
     */
    public function validate(): bool
    {
        //skip validation if rules are empty
        if (empty($this->rules())) {
            return true;
        }
        $data = $this->getAttributes();
        // Make a new validator object
        $validator = validator($data, $this->rules(), $this->messages());

        // Check for failure
        if ($validator->fails()) {
            $this->errors = $validator->errors();

            return false;
        }

        return true;
    }
}