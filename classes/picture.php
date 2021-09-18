<?php

/**
 * Objet permettant de gérer l'upload d'images
 */

class Picture
{
    public $extension = '';
    public $length = '';
    public $nomImage = '';
    public $error = [];

    /**
     * Attributs pour la gestion du fichier
     */
    public $directory = '';
    //Ici on stockera le $_Files['myFile']
    public $file;

    /**
     * Constantes pour la vérifications du fichier
     */
    const SIZE = 100000; // Taille max de l'image en octets 
    const WIDTH_MAX = 200; // Largeur max de l'image en pixels
    const HEIGHT_MAX = 200; // Hauteur max de l'image en pixels
    const EXTENSIONS = ['jpg', 'gif', 'png', 'jpeg']; // Extensions autorisees

    
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
    public function isValidDimension($fileName, $fileValue, $widthMax = SELF::WIDTH_MAX, $heightMax = SELF::HEIGHT_MAX)
    {
        $length = strlen($fileValue);
        if ($length <= $widthMax && $length <= $heightMax) {
            return true;
        } else {
            $this->error[$fileName] = 'La taille de l\'image ' . $fileName . ' ne doit pas dépasser ' . $widthMax . ' et ' . $heightMax;
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
        $extension = strtolower(pathinfo($this->file['name'], $format = SELF::EXTENSIONS));
        if (!in_array($this->extension, $this->format)) {
            $this->errors['extension'] = 'Extension du fichier non valide';
            return $this->error[$fileValue] = 'L\'image ' . $fileName . ' n\'est pas au bon format';;
        }
        return true;
    }
}
