<?php 

namespace App\Core;

class TextSummraizer{
    
    function summarizeText($textArray,$sentenceLimit=5){
        $fullText=implode(' ',$textArray);
        $sentences=$this->splitSentences($fullText);
        $summary=array_slice($sentences,0,$sentenceLimit);
        return implode(' ',$summary);
    }

    private function splitSentences($text){
        return preg_split('/(?<=[.!?])\s+(?=[A-Z])/',$text,-1,PREG_SPLIT_NO_EMPTY);
    }
}