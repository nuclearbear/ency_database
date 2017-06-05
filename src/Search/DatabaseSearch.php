<?php

namespace Nuclearbear\Encydb\Search;

use Nuclearbear\Encydb\Search\Abstract\SearchAbstract;

class DatabaseSearch extends SearchAbstract
{
    public function __construct()
    {

    }

    /**
     * @param PDO $db 
     * @param string $searchRequest String which contains our search request
     * @param string $indexKey Index Key for encryption
     * @param Array $where Columns in which we should make search
     *
     * @return Collection $searchResult Result of search request from database
     *
     **/
    public function search(string $searchRequest, string $indexKey, Array $where): Collection
    {
        $index = getSSNBlindIndex($ssn, $indexKey);
        $stmt = $db->prepare('SELECT * FROM humans WHERE ssn_bidx = ?');
        $stmt->execute([$index]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSearchIndex(string $searchRequest, string $indexKey): string
    {
        return bin2hex(
            sodium_crypto_pwhash(
                32,
                $searchRequest,
                $indexKey,
                SODIUM_CRYPTO_PWHASH_OPSLIMIT_MODERATE,
                SODIUM_CRYPTO_PWHASH_MEMLIMIT_MODERATE
            )
        );
    }
}