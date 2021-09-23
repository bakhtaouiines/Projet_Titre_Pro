<?php
/**
 * Objet permettant de gerer les formulaires
 */
class Form
{
    public $error = [];
    const PATTERN = '/^[a-zA-Z0-9.-_]{3,20}$/'; //on contrôle que le pseudo contient 3 à 20 caractères

    /**
     * Vérification que le champ n'est pas vide et qu'il existe
     * @param string $fieldName
     * @param string $fieldValue
     * @return boolean
     */
    public function isNotEmpty($fieldName, $fieldValue)
    {
        if (!empty($fieldValue)) {
            return true;
        } else {
            $this->error[$fieldName] = 'Le champ ' . $fieldName . ' est vide';
        }
    }

    /**
     * Vérification que le champ pseudo correspond à la regex
     * @param string $fieldName
     * @param string $fieldValue
     * @return boolean
     */
    public function isValidFormat($fieldName, $fieldValue, $format = SELF::PATTERN)
    {
        if (preg_match($format, $fieldValue)) {
            return true;
        } else {
            $this->error[$fieldName] = 'Le champ ' . $fieldName . ' n\'est pas au bon format. Il doit contenir au moins 3 caractères, sans aucun espace et aucun caractères spéciaux.';
        }
    }

    /**
     * Vérification de l'unicité d'un champ
     * @param string $fieldName
     * @param string $fieldValue
     * @param string $className
     * @return mixed
     */
    public function isUnique($fieldName, $fieldValue, $className)
    {
        $class = new $className();
        if (method_exists($class, 'isUnique')) {
            if ($class->isUnique($fieldName, $fieldValue)) {
                return true;
            } else {
                $this->error[$fieldName] = 'Le champ ' . $fieldName . ' est déjà utilisé';
                return false;
            }
        } else {
            return null;
        }
    }

    /**
     * Vérification de l'existence d'une valeur
     *
     * @param [type] $fieldName
     * @param [type] $fieldValue
     * @param [type] $className
     * @return void
     */
    public function doesExist($fieldName, $fieldValue, $className)
    {
        $class = new $className();
        if (method_exists($class, 'doesExist')) {
            if ($class->doesExist($fieldName, $fieldValue)) {
                return true;
            } else {
                $this->error[$fieldName] = 'La valeur ' . $fieldName . ' n\'existe pas';
                return false;
            }
        } else {
            return null;
        }
    }

    /**
     * Vérification de la taille d'un champ
     * @param string $fieldName
     * @param string $fieldValue
     * @param int $min
     * @param int $max
     * @return boolean
     */
    public function isValidLength($fieldName, $fieldValue, $min, $max)
    {
        $length = strlen($fieldValue);
        if ($length >= $min && $length <= $max) {
            return true;
        } else {
            $this->error[$fieldName] = 'La taille du champ ' . $fieldName . ' doit être comprise entre ' . $min . ' et ' . $max .' caractères.';
            return false;
        }
    }
    /**
     * Vérification de la validité d'un email
     *
     * @param string $fieldName
     * @param string $fieldValue
     * @return boolean
     */
    public function isValidEmail($fieldName, $fieldValue)
    {
        if (filter_var($fieldValue, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            $this->error[$fieldName] = 'Le champ ' . $fieldName . ' n\'est pas une adresse mail valide';
            return false;
        }
    }
    /**
     * Verification de la validité du formulaire
     *
     * @return boolean
     */
    public function isValid()
    {
        return empty($this->error);
    }
}
