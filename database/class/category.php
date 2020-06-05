<?php

  class category extends crudDatabase {
    function __construct()
    {
      crudDatabase::__construct('categories');
    }
  }
?>