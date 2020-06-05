<?php

  class archive extends crudDatabase {
    function __construct()
    {
      crudDatabase::__construct('archives');
    }
  }
?>