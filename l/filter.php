<?php

/**
 * @author Ian
 * filter 过滤器
 */
abstract class Filter {
    
    public function __construct() {
    }
    
    abstract public function filt();
    
    public function __destruct() {
    }
}