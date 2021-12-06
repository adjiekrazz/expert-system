<?php

namespace App\Services;

use App\Models\Keyword;

class KeywordService 
{
    private $nodes;
    public function getKeywordTree()
    {
        return Keyword::get()->toTree();
    }

    public function createOrUpdateTree(array $data)
    {
        $this->nodes = $data;
        foreach($this->nodes as &$node){
            $this->_parseNode($node);
        }
        try{
            Keyword::rebuildTree($this->nodes, true);
        }catch(\Exception $error){
            return [
                'success' => false,
                'error' => $error
            ];
        }
        return [
            'success' => true
        ];
    }

    private function _parseNode(&$node)
    {
        unset($node['state']);
        unset($node['domId']);
        unset($node['checked']);
        unset($node['target']);
        unset($node['checkState']);
        if (isset($node['children'])){
            foreach ($node['children'] as &$childrenNode){
                $this->_parseNode($childrenNode);
            }
        }
    }
}