<?php

use PHPUnit\TextUI\TestRunner;

class resources_Runner
{
    private $runner;
    private $runMethod;
    public function __construct()
    {
        $this->runner = new TestRunner();
        $this->runMethod = method_exists($this->runner, 'run') ? 'run' : 'doRun';
    }

    /**
     * @return mixed ...$args
     */
    public function run(...$args)
    {
        return $this->runner->{$this->runMethod}(...$args);
    }
}
