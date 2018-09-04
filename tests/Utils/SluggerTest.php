<?php
/**
 * Created by PhpStorm.
 * User: leazygomalas
 * Date: 02/09/2018
 * Time: 23:04
 */

namespace App\Tests\Utils;


use App\Utils\Slugger;
use PHPUnit\Framework\TestCase;

class SluggerTest extends TestCase
{
    public function testSlugify()
    {
        $slugger = new Slugger();
        $result = $slugger->slugify('ûé');

        $this->assertEquals('ue', $result);
    }

    public function testEmptySlugify()
    {
        $slugger = new Slugger();
        $result = $slugger->slugify('');

        $this->assertEquals('n-a', $result);

    }
}