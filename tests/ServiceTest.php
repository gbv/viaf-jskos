<?php

namespace JSKOS\Service;

use JSKOS\ConceptScheme;

class VIAFTest extends \PHPUnit\Framework\TestCase
{
    public function testExamples()
    {
        $service = new VIAF();

        $uri = "http://viaf.org/viaf/87772061";
        $result = $service->query(['uri'=>$uri]);

        $this->assertEquals($result[0]->uri, $uri);
        $this->assertTrue($result[0]->type->contains('http://schema.org/Person'));
    }
}
