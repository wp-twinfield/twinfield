<?php

/**
 * Title: Finder test
 * Description:
 * Copyright: Copyright (c) 2005 - 2014
 * Company: Pronamic
 * @author Remco Tolsma
 * @version 1.0.0
 */
class Pronamic_Twinfield_FinderTest extends PHPUnit_Framework_TestCase {
    public function testSearch() {
        global $credentials;

        $client = new Pronamic\Twinfield\Client();

        $logonResponse = $client->logon($credentials);

        $this->assertInstanceOf('Pronamic\Twinfield\LogonResponse', $logonResponse);
        $this->assertInternalType('string', $logonResponse->getCluster());

        $finder = $client->getFinder($logonResponse);

        $this->assertInstanceOf('Pronamic\Twinfield\Finder', $finder);
        $this->assertInternalType('string', $finder->getId());

        $search = new Pronamic\Twinfield\Search( Pronamic\Twinfield\FinderTypes::ART, '*', Pronamic\Twinfield\SearchFields::CODE_AND_NAME, 1, 100 );
        $response = $finder->search( $search );

        $this->assertInstanceOf('Pronamic\Twinfield\SearchResponse', $response);

        $data = $response->getData();

        $this->assertInstanceOf('Pronamic\Twinfield\FinderData', $data);

        $columns = $data->getColumns();
        $items = $data->getItems();

        var_dump( $items );
    }
}
