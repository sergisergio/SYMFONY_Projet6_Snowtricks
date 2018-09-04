<?php
/**
 * Created by PhpStorm.
 * User: leazygomalas
 * Date: 04/09/2018
 * Time: 09:51
 */

namespace App\Utils;


class Product
{


    const FOOD_PRODUCT = 'food';

        private $name;

        private $type;

        private $price;

        public function __construct($name, $type, $price)
        {
            $this->name = $name;
            $this->type = $type;
            $this->price = $price;
        }

        public function computeTVA()
        {
            if ($this->price < 0) {
                   throw new \LogicException('The TVA cannot be negative.');
                }

            if (self::FOOD_PRODUCT == $this->type) {
                return $this->price * 0.055;
            }

            return $this->price * 0.196;
        }
}