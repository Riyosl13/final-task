<?php

namespace Drupal\student_form\services;

interface CrudInterface {
  /**
   * performs Get/Read operation 
   */
  public function get($uid);

  /**
   * performs Create operation 
   */
  public function create($data);

  /**
   * performs Update operation 
   */
  public function update($uid, $data);

  /**
   * performs Delete operation 
   */
  public function delete($uid);

}