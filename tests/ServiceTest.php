<?php

namespace VIAF\JSKOS;

use JSKOS\ConceptScheme;
use Helmich\JsonAssert\JsonAssertions;

class VIAFServiceTest extends \PHPUnit\Framework\TestCase
{
    public function testExamples()
    {
        $service = new Service();

        $uri = "http://viaf.org/viaf/87772061";
        $jskos = $service->query(['uri'=>$uri]);

        $this->assertEquals($jskos->uri, $uri);
        $this->assertEquals($jskos->type[0], 'http://schema.org/Person');
    }
}
