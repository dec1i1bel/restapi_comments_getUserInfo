<?php
class Base {
  protected $dbconn = null;

  public function __construct($dbconn) {
    $this->dbconn = $dbconn;
  }
}