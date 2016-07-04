<?php
/**
 * Created by PhpStorm.
 * User: rabzy
 * Date: 21.04.2016
 * Time: 21:37
 */

namespace tests\unit;

use \Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;


class SeederTest extends \PHPUnit_Framework_TestCase
{
    use InteractsWithDatabase;

    public function testLinksTable()
    {
        $this->seeInDatabase('links', ['title' => 'dotdev.co']);
    }
}
