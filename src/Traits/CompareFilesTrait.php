<?php

namespace Karakhanyans\Comparison\Traits;

use Illuminate\Support\Facades\File;

trait CompareFilesTrait
{
    private $current;
    private $old;
    private $differentWords = [];
    private $highWordsCount = 0;
    private $sameWords = [];
    private $currentText = '';
    private $tag = 'b';
    private $style = 'color: #00BB00;';
    private $class = '';

    /**
     * Replace <> characters
     */
    private function replace ()
    {
        $this->current =  str_replace (array ('<', '>'), array ('&lt;', '&gt;'), $this->current);
        $this->old =  str_replace (array ('<', '>'), array ('&lt;', '&gt;'), $this->old);
    }

    /**
     * @param $current
     * @param $old
     * Get content from files and set texts to variables
     */
    private function getContent($current,$old)
    {
        $this->current = $current;
        $this->old = $old;

        if(File::isFile($current)){
            $this->current = File::get($current);
        }
        if(File::isFile($old)){
            $this->old = File::get($old);
        }
        $this->replace();
        $this->findDifference();
    }

    /**
     * Find difference between two texts
     */
    private function findDifference(){
        // Line Arrays
        $cv = explode ("\n", $this->current);
        $ov = explode ("\n", $this->old);

        $lc = (count ($cv) > count ($ov)) ? count ($cv) : count ($ov);
        $this->highWordsCount = (str_word_count($this->current,0) > str_word_count($this->old,0)) ? str_word_count($this->current,0) : str_word_count($this->old,0);
        for ($flc = count ($ov); $flc < $lc; $flc++) {
            $ov[$flc] = '';
        }
        for ($l = 0; $l < $lc; $l++) {
           
            $cw = explode (' ', $cv[$l]); // Current Version
            $ow = explode (' ', $ov[$l]); // Old Version
            
            $wc = (count ($cw) > count ($ow)) ? count ($cw) : count ($ow);
            
            for ($fwc = count ($ow); $fwc < $wc; $fwc++) {
                $ow[$fwc] = '';
            }
            for ($dwc = count ($cw); $dwc < $wc; $dwc++) {
                $cw[$dwc] = '';
            }
            if ($cv[$l] !== $ov[$l]) {
                for ($w = 0; $w < $wc; $w++) {
                    if ($cw[$w] === $ow[$w]) {
                        array_push($this->sameWords,$cw[$w]);
                        $space = ($w !== ($wc - 1)) ? ' ' : "\n";
                        $this->currentText .= $cw[$w].$space;
                    } else {
                        array_push($this->differentWords,$cw[$w]);
                        $space = ($w !== ($wc - 1)) ? '</'.$this->tag.'> ' : "</".$this->tag.">\n";
                        $this->currentText .= '<'.$this->tag.' style="'.$this->style.'" class="'.$this->class.'">'.$cw[$w].$space;
                    }
                }
            } else {
                $this->currentText .= $cv[$l]."\n";
            }
        }
    }
    
    public function compareFiles($a,$b)
    {
        $this->getContent($a,$b);
    }

    public function differentWords()
    {
        return $this->differentWords;
    }

    public function differentWordsCount()
    {
        return count($this->differentWords);
    }

    public function differencePercent()
    {
        return ceil(($this->differentWordsCount() * 100)/$this->highWordsCount);
    }

    public function sameWords()
    {
        return $this->sameWords;
    }

    public function sameWordsCount()
    {
        return count($this->sameWords);
    }

    public function showFormattedText()
    {
        return $this->currentText;   
    }

    public function old()
    {
        return $this->old;
    }

    public function current()
    {
        return $this->current;
    }

    public function tag($tag)
    {
        $this->tag = $tag;
    }

    public function style($style)
    {
        $this->style = $style;
    }

    public function class($class)
    {
        $this->class = $class;
    }
}

