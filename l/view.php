<?php

/**
 * @author Ian
 * 模板引擎适配器接口
 */
interface View {
    public function assign($key, $value = null);
    public function fetch($tpl);
    public function display($tpl);
}