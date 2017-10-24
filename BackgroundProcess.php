<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BackgroundProcess
 *
 * @author vishal
 */
class BackgroundProcess {

    private $pid;
    private $command;
    private $debugger = true;
    private $msg = "";

    /*
     * @Param $cmd: Pass the linux command want to run in background 
     */

    public function __construct($cmd = null) {

        if (!empty($cmd)) {
            $this->command = $cmd;
            $this->do_process();
        } else {
            $this->msg['error'] = "Please Provide the Command Here";
        }
    }

    public function setCmd($cmd) {
        $this->command = $cmd;
        return true;
    }

    public function setProcessId($pid) {
        $this->pid = $pid;
        return true;
    }

    public function getProcessId() {
        return $this->pid;
    }

    public function status() {
        $command = 'ps -p ' . $this->pid;
        exec($command, $op);
        if (!isset($op[1]))
            return false;
        else
            return true;
    }

    public function showAllPocess() {
        $command = 'ps -ef ' . $this->pid;
        exec($command, $op);
        return $op;
    }

    public function start() {
        if ($this->command != '')
            $this->do_process();
        else
            return true;
    }

    public function stop() {
        $command = 'kill ' . $this->pid;
        exec($command);
        if ($this->status() == false)
            return true;
        else
            return false;
    }

    //do the process in background
    public function do_process() {
        $command = 'nohup ' . $this->command . ' > /dev/null 2>&1 & echo $!';
        exec($command, $pross);
        $this->pid = (int) $pross[0];
    }

    /*
     * To execute a PHP url on background you have to do the following things.
     * $process=new BackgroundProcess("curl -s -o <Base Path>/log/log_storewav.log <PHP URL to execute> -d param_key=<Param_value>");
     */
}
