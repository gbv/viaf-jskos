<?php declare(strict_types = 1);

namespace JSKOS\Service;

use JSKOS\Concept;
use JSKOS\Resource;
use JSKOS\Result;
use JSKOS\RDF\Mapper;
use JSKOS\ConfiguredService;
use JSKOS\URISpaceService;

/**
 * This wrapper converts VIAF Linked Open Data to JSKOS.
 */
class VIAF extends ConfiguredService
{ 
    protected $supportedParameters = ['notation','search'];

	private $mapper;

    public function __construct(array $config=[]) {
        $config = json_decode(file_get_contents(__DIR__."/VIAF.json"), true);
        $this->configure($config);
        $this->mapper = new Mapper($config);
        $this->urispace = new URISpaceService($config['_uriSpace']);
    }

    public function query(array $query=[], string $path = ''): Result
    {
        $jskos = $this->urispace->query($query, $path);
        if (count($jskos)) {
            $concept = $this->queryUri($jskos[0]->uri);
            return new Result( $concept ? [$concept] : [] );
        } elseif (isset($query['search'])) {
            return $this->search($query['search']);
        } else {
            return new Result();
        }
    }

    public function queryUri($uri) {
        $rdf = Mapper::loadRDF("$uri/rdf.xml", $uri);
        if (!$rdf || empty($rdf->getGraph()->propertyUris($uri))) return;

        $jskos = new Concept([ 'uri' => $uri ]);
        $this->mapper->applyAtResource($rdf, $jskos); 

        return $jskos;
    }

    # TODO
    private function search($search): Result {
        $url = 'http://www.viaf.org/viaf/AutoSuggest?' . http_build_query(['query'=>$search]);
        try {
            # TODO: Add http-client implementation
            $json = @json_decode( @file_get_contents($url) );
			$result = new Result();
            foreach ( ($json->result ?? []) as $hit ) {
                $result[] = new Concept([
                    'prefLabel' => [ 'en' => $hit->term ],
                    'uri' => "http://viaf.org/viaf/".$hit->viafid,
                ]);
            }
            return $result;
        } catch (Exception $e) {
            error_log($e);
            return [];
        }
    } 
}
