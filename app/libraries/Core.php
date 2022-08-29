<h1><?php echo "Hi I am in the Core" ?></h1>

<?php

  class Core {
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];



    public function __construct() {
      $url = $this->get_url();
      if (file_exists('../app/controllers/'.ucwords($url[0]).'.php')) {
        $this->currentController = ucwords($url[0]);
        unset($url[0]);
      }

      require_once '../app/controllers/'.$this->currentController.'.php';
      $this->currentController = new $this->currentController;

      if (method_exists($this->currentController, isset($url[1]) ? $url[1] : false)) {
        $this->currentMethod = $url[1];
        unset($url[1]);
      }

      echo $this->currentMethod;
      echo "<br/>";
      print_r($url);
      echo "<br/>";

      $this->params = $url ? array_values($url) : [];

      call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
      

    }

    public function get_url() {
      if (isset($_GET['url'])) {
        $url = $_GET['url'];
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);
        return $url;
      }
    }
  }
