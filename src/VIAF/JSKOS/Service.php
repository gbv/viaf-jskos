<?php

/**
 * This wrapper converts VIAF Linked Open Data to JSKOS.
 */

namespace VIAF\JSKOS;

use JSKOS\Concept;
use JSKOS\Page;
use JSKOS\RDF\RDFMapping;

class Service extends \JSKOS\RDF\RDFMappingService {
    public static $CONFIG_DIR = __DIR__;
 
    protected $supportedParameters = ['notation','search'];

    public function query($query) {
        $jskos = $this->queryUriSpace($query);
        if ($jskos and $jskos->uri) {
            return $this->lookupEntity($jskos->uri);
        } elseif (isset($query['search'])) {
            return new Page( $this->search($query['search']) );
        }
    }

    public function lookupEntity($uri) {
        $rdf = RDFMapping::loadRDF("$uri/rdf.xml", $uri);
        if (!$rdf) return;

        $jskos = new Concept([ 'uri' => $uri ]);
        $this->applyRdfMapping($rdf, $jskos); 

        return $jskos;
    }

    private function search($search) {
        $url = 'http://www.viaf.org/viaf/AutoSuggest?' . http_build_query(['query'=>$search]);
        try {
            $json = @json_decode( @file_get_contents($url) );
			$response = [];
            foreach ( ($json->result ?? []) as $hit ) {
                $response[] = new Concept([
                    'prefLabel' => [ 'en' => $hit->term ],
                    'uri' => "http://viaf.org/viaf/".$hit->viafid,
                ]);
            }
            return $response;
        } catch (Exception $e) {
            error_log($e);
            return [];
        }
    } 
}
