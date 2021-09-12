<?php

/**
 * Objet permettant de gérer l'upload d'images
 */

class Picture
{
    public $error = array();

    // Constantes
    const WIDTH_MAX = 200;    // Largeur max de l'image en pixels
    const HEIGHT_MAX = 200;    // Hauteur max de l'image en pixels
    const EXTENSIONS = array('jpg', 'gif', 'png', 'jpeg');    // Extensions autorisees

    /**
     * Fonction pour vérifier que le champ n'est pas vide et qu'il existe
     *
     * @param [string] $fileName
     * @param [type] $fileValue
     * @return boolean
     */
    public function isNotEmpty($fileName, $fileValue)
    {
        if (!empty($fileValue)) {
            return true;
        } else {
            $this->error[$fileName] = 'Le champ ' . $fileName . ' est vide';
        }
    }

    /**
     * Fonction pour vérifier la taille de l'image
     *
     * @param [string] $fileName
     * @param  $fileValue
     * @param [int] $widthMax
     * @param [int] $heightMax
     * @return boolean
     */
    public function isValidLength($fileName, $fileValue, $widthMax = SELF::WIDTH_MAX, $heightMax = SELF::HEIGHT_MAX)
    {
        $length = strlen($fileValue);
        if ($length <= $widthMax && $length <= $widthMax) {
            return true;
        } else {
            $this->error[$fileName] = 'La taille de l\'image ' . $fileName . ' doit être comprise entre ' . $widthMax . ' et ' . $widthMax;
            return false;
        }
    }

    /**
     * Fonction pour vérifier le format de l'image
     *
     * @param [string] $fileName
     * @param $fileValue
     * @param $format
     * @return boolean
     */
    public function isValidFormat($fileName, $fileValue, $format = SELF::EXTENSIONS)
    {
        if (strtolower($format, $fileValue)) {
            return true;
        } else {
            $this->error[$fileValue] = 'L\'image ' . $fileName . ' n\'est pas au bon format';
        }
    }
}
