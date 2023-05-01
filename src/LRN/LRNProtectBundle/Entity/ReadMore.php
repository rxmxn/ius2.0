<?php
/**
 * Created by PhpStorm.
 * User: ulloa
 * Date: 4/7/2015
 * Time: 5:41 AM
 */

namespace LRN\LRNProtectBundle\Entity;


class ReadMore {

    private $texto;
    private $limite;
    private $romper=".";
    private $pad="...";
    private $separar;

    public function setTexto($t){
        $this->texto = $t;
    }

    public function setLimite($l){
        $this->limite = $l;
    }

    public function setRomper($r){
        $this->romper = $r;
    }

    public function setPad($p){
        $this->pad = $p;
    }

    public function setReparar($rp){
        $this->reparar = $rp;
    }

    public  function myTruncate(){
        // return with no change if string is shorter than $limit
        if(strlen($this->texto) <= $this->limite) return $this->texto; // is $break present between $limit and the end of the string?
        if(false !== ($breakpoint = strpos($this->texto, $this->romper, $this->limite))){
            if($breakpoint < strlen($this->texto) - 1){
                $string = substr($this->texto, 0, $breakpoint) . $this->pad;
            }
        }
        return $string;
    }

    public function restoreTags() {
        $opened = array(); // loop through opened and closed tags in order
        if(preg_match_all("/<(\/?[a-z]+)>?/i", $this->reparar, $matches)){
            foreach($matches[1] as $tag){
                if(preg_match("/^[a-z]+$/i", $tag, $regs)){
                    // a tag has been opened
                    if(strtolower($regs[0]) != 'br') $opened[] = $regs[0];
                } elseif(preg_match("/^\/([a-z]+)$/i", $tag, $regs)) { // a tag has been closed
                    unset($opened[array_pop(array_keys($opened, $regs[1]))]);
                }
            }
        } // close tags that are still open
        if($opened){
            $tagstoclose = array_reverse($opened);
            foreach($tagstoclose as $tag) $this->reparar .= "</$tag>";
        }
        return $this->reparar;
    }



} 