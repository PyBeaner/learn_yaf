<?php

class Smarty_Adapter implements Yaf_View_Interface
{

    private $_smarty;

    public function __construct($tmpPath = null, $extraParams = [])
    {
        require 'Smarty.class.php';
        $this->_smarty = new Smarty();
        if ($tmpPath) {
            $this->setScriptPath($tmpPath);
        }
        foreach ($extraParams as $key => $value) {
            $this->_smarty->$key = $value;
        }
    }

    /**
     * (Yaf >= 3.0.2)
     * 传递变量到模板
     *
     * 当只有一个参数时，参数必须是Array类型，可以展开多个模板变量
     *
     * @param string $name 变量名
     * @param string $value 变量值
     *
     * @return Boolean
     */
    public function assign($name, $value = null)
    {
        if (is_array($name)) {
            $this->_smarty->assign($name);
        } else {
            $this->_smarty->assign($name, $value);
        }
    }

    /**
     * (Yaf >= 3.0.2)
     * 渲染模板并直接输出
     *
     * @param string $tpl 模板文件名
     * @param array $var_array 模板变量
     *
     * @return Boolean
     */
    public function display($tpl, $var_array = array())
    {
        echo $this->render($tpl, $var_array);
    }

    /**
     * (Yaf >= 3.0.2)
     * 渲染模板并返回结果
     *
     * @param string $tpl 模板文件名
     * @param array $var_array 模板变量
     *
     * @return String
     */
    public function render($tpl, $var_array = array())
    {
        return $this->_smarty->fetch($tpl);
    }

    /**
     * (Yaf >= 3.0.2)
     * 设置模板文件目录
     *
     * @param string $tpl_dir 模板文件目录路径
     *
     * @return Boolean
     */
    public function setScriptPath($tpl_dir)
    {
        // TODO: Implement setScriptPath() method.
    }

    /**
     * (Yaf >= 3.0.2)
     * 获取模板目录文件
     *
     * @return String
     */
    public function getScriptPath()
    {
        // TODO: Implement getScriptPath() method.
    }
}