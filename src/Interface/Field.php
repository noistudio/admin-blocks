<?php

namespace AdminBlocks\Interface;

interface Field
{

    public function __construct();



    public function setValue();

    public function getValue($value);


    public function run($block);







}
