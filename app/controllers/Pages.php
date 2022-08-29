<?php
  class Pages {
    function __construct()
    {
      echo "Pages got loaded...<p>";
    }

    public function about($id, $name, $age) {
      echo "$id<br/>";
      echo "$name<br/>";
      echo "$age<br/>";
    }
    public function index() {}
  }