<?php

namespace Yooper;

/**
 * Loads the csv file into memory and creates an inverted index with all the 
 * nick names
 * @author yooper
 */
class Nicknames 
{
    /**
     * The key links to all the other names
     * @var array
     */
    protected $index = [];
    
    /**
     * A private data file path
     * @var string
     */
    protected $dataFilePath = null;
    
    public function __construct($dataFilePath = null)
    {
        if($dataFilePath) {
            $this->dataFilePath = $dataFilePath;
        } else {
            // the default name file
            $this->dataFilePath = dirname(__DIR__)."/data/names.csv";
        }
        $this->buildIndex();
    }
    
    private function getDataFilePath() : string
    {
        return $this->dataFilePath;
    }    
    
    /**
     * 
     * @return array
     */
    protected function getRows() : array
    {
        return array_map('str_getcsv', file($this->getDataFilePath()));        
    }
    
    /**
     * Builds the searchable index
     */
    protected function buildIndex()
    {
        $rows = $this->getRows();
        foreach($rows as $row)
        {
            if(!isset($this->index[$row[0]])) {            
                $this->index[$row[0]] = array_slice($row, 1);
            }
        }
    }
    
    public function getIndex() : array
    {
        return $this->index;
    }
    
    /**
     * Returns a list of nick names
     * @param string $name
     * @return array
     */
    public function query($name) : array
    {
        if(isset($this->index[strtolower($name)])) {
            return $this->index[strtolower($name)];
        }
        return [];
    }
    
    /**
     * 
     * @param string $name
     * @return array
     */
    public function fuzzy($name) : array
    {                
        // normalize the name
        $name = strtolower($name);
        
        $r = array_filter(array_keys($this->getIndex()), 
            function($record) use($name) { return strpos($record, $name) !== false; }
        );  
        if(empty($r)) {
            return [];
        } 
        return array_values($r);
    }
    
    public function __destruct() 
    {
        unset($this->index);
        unset($this->dataFilePath);
    }
    
}
