<?php

namespace NoInc\SimpleStorefront\ApiBundle\Normalizer;

use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerAwareInterface;
use Symfony\Component\Serializer\SerializerInterface;
use NoInc\SimpleStorefront\ApiBundle\Entity\Ingredient;
use NoInc\SimpleStorefront\ApiBundle\Normalizer\IngredientNormalizer;

final class RecipeNormalizer implements NormalizerInterface, DenormalizerInterface, SerializerAwareInterface
{
    private $decorated;

    public function __construct(NormalizerInterface $decorated)
    {
        if (!$decorated instanceof DenormalizerInterface) {
            throw new \InvalidArgumentException(sprintf('The decorated normalizer must implement the %s.', DenormalizerInterface::class));
        }

        $this->decorated = $decorated;
    }

    public function supportsNormalization($data, $format = null)
    {
        return method_exists($data, 'getRecipeIngredients');
        #return $isRecipe;
        # return $this->decorated->supportsNormalization($data, $format);
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = $this->decorated->normalize($object, $format, $context);
        if (is_array($data)) {
            unset($data['recipeIngredients']);
            #var_dump($data);
            #var_dump($object);
            $ingredientStrings = [];
            foreach ($object->getRecipeIngredients() as $recipeIngredient) {
                $ingredientString = (new IngredientNormalizer)->encode($recipeIngredient, null, array());
                array_push($ingredientStrings, $ingredientString);
            }
            $data['ingredients'] = $ingredientStrings;
        }

        return $data;
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $this->decorated->supportsDenormalization($data, $type, $format);
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        return $this->decorated->denormalize($data, $class, $format, $context);
    }

    public function setSerializer(SerializerInterface $serializer)
    {
        if($this->decorated instanceof SerializerAwareInterface) {
            $this->decorated->setSerializer($serializer);
        }
    }
}

