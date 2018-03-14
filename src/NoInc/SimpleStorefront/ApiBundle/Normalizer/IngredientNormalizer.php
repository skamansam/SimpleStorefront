<?php
namespace NoInc\SimpleStorefront\ApiBundle\Normalizer;

use Symfony\Component\Serializer\Encoder\EncoderInterface;
use Symfony\Component\Serializer\Encoder\DecoderInterface;
use NoInc\SimpleStorefront\ApiBundle\Entity\Ingredient;

/**
 * Convert Ingredient to "3 Cups of Milk"
 * @serializer.encoder
 */
class IngredientNormalizer implements EncoderInterface, DecoderInterface
{

    public function encode($recipeIngredient, $format, array $context = array())
    {
        $ingredient = $recipeIngredient->getIngredient();
        $qty = $recipeIngredient->getQuantity();
        $measure = $ingredient->getMeasure();
        $name = $ingredient->getName();
        $plural = $qty == 1 ? '' : 's';
        return "$qty {$measure}$plural of $name";
    }

    public function decode($data, $format, array $context = array())
    {
        $matches = [];
        preg_match('/(\d+)\s+(\S.*)\s+of\s+(\S.*)/', $data, $matches);

        $ingredient = new Ingredient();
        $ingredient.setQuantity($matches[1]);
        $ingredient.setStock($matches[3]);

        return $ingredient;
    }

    public function supportsEncoding($format)
    {
        return $format == 'json';
    }
    public function supportsDecoding($format)
    {
        return $format == 'json';
    }

}