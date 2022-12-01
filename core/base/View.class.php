<?php

namespace base;


class View
{
    protected $basePath;
    protected $title;
    protected $seo = [];
    protected $css = [];
    protected $js = [];
    
    protected $_layout;

    public function setLayout($layout)
    {
        $this->_layout = __DIR__.'/../views/layouts/'.$layout.'.php';
        return $this->_layout;
    }

    public function setBasePath($basePath)
    {
        $this->basePath = __DIR__.'/../views/pages/'.$basePath.'/';
        return $this->basePath;
    }

    public function render($tplName, $data)
    {
        extract($data);
        require $this->_layout;
    }


    /**
     * @param string $str
     */
    public function setTitle($str)
    {
        $this->title = $str;
    }

    /**
     * Undocumented function
     *
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Undocumented function
     *
     * @param array $css 
     */
    public function setCss($css)
    {
        $this->css[] = $css;
    }

    /**
     * Undocumented function
     *
     * @param [type] $js
     * @return void
     */
    public function setJs($js)
    {
        $this->js[] = $js;
    }

    /**
     * Undocumented function
     *
     * @return array
     */
    public function getJs()
    {
        return $this->js;
    }

    

    public function setDescription($v)
    {
        $this->seo['description'] = $v;
    }

    public function setKeywords($v)
    {
        $this->seo['keywords'] = $v;
    }

    public function setOGSiteName($v)
    {
        $this->seo['site_name'] = $v;
    }


    public $_lang;
    public function setSwitchLang()
    {
        $getLang = $_GET['lang'];

        if (empty($_SESSION['lang'])) {
            $_SESSION['lang'] = 'ru';
        }


        switch ($getLang) {
            case 'ru':
                unset($_SESSION['lang']);
                $_SESSION['lang'] = 'ru';        
                break;
            case 'kk':
                unset($_SESSION['lang']);
                $_SESSION['lang'] = 'kk';        
                break;
        }

        $setLang = $_SESSION['lang'];


        require  __DIR__.'/../lang/'.$setLang.'.php';

        // echo " <pre> ";
        // var_dump($lang);
        $this->_lang = $lang;
        return $this->_lang;
        // var_dump($this->_lang);
        // echo " </pre> ";

    }


}

?>