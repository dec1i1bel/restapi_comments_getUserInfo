<?php
class User extends Base {
  private $dbtable = 'users';

  public function read() {
    $sql = 'select * from users';
    $exec = $this->dbconn->prepare($sql);
    $exec->execute();
    return $exec;
  }
}