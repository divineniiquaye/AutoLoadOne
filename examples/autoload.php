<?php
/**
 * This class is used for autocomplete.
 * Class _AUTOLOAD_
 * @noautoload it avoids to index this class
 * @generated by AutoLoadOne 1.5 generated 2018/09/05 07:14:03
 * @copyright Copyright Jorge Castro C - MIT License. https://github.com/EFTEC/AutoLoadOne
 */
class _AUTOLOAD_
{
    var $debug=false;
    private $_arrautoloadCustom = array(
		'MyProject\Connection' => '/folder/multiplenamespace.php',
		'AnotherProject\Connection' => '/folder/multiplenamespace.php',
		'MyProject\Connection2' => '/folder/multiplenamespace2.php',
		'AnotherProject\Connection2' => '/folder/multiplenamespace2.php',
		'ClassWithoutNameSpace' => '/folder/subfolderalt/ClassWithoutNameSpace.php',
		'folder\subfolder\CustomClass' => '/folder/subfolderalt/CustomClass.php'
    );
    private $_arrautoload = array(
		'folder' => '/folder',
		'folder\subfolder' => '/folder/subfolder',
		'sub\sub\sub' => '/folder/subfolder/subsubfolder'
    );
    /**
     * _AUTOLOAD_ constructor.
     * @param bool $debug
     */
    public function __construct($debug=false)
    {
        $this->debug = $debug;
    }
    /**
     * @param $class_name
     * @throws Exception
     */
    public function auto($class_name) {
        // its called only if the class is not loaded.
        $ns = dirname($class_name); // without trailing
        $ns=($ns==".")?"":$ns;        
        $cls = basename($class_name);
        // special cases
        if (isset($this->_arrautoloadCustom[$class_name])) {
            $this->loadIfExists($this->_arrautoloadCustom[$class_name] );
            return;
        }
        // normal (folder) cases
        if (isset($this->_arrautoload[$ns])) {
            $this->loadIfExists($this->_arrautoload[$ns] . "/" . $cls . ".php");
            return;
        }
    }

    /**
     * @param $filename
     * @throws Exception
     */
    public function loadIfExists($filename)
    {
        if((@include __DIR__."/".$filename) === false) {
            if ($this->debug) {
                throw  new Exception("AutoLoadOne Error: Loading file [".__DIR__."/".$filename."] for class [".basename($filename)."]");
            } else {
                throw  new Exception("AutoLoadOne Error: No file found.");
            }
        }
    }
} // end of the class _AUTOLOAD_
if (defined('_AUTOLOAD_ONEDEBUG')) {
    $_AUTOLOAD_=new _AUTOLOAD_(_AUTOLOAD_ONEDEBUG);
} else {
    $_AUTOLOAD_=new _AUTOLOAD_(false);
}
spl_AUTOLOAD_register(function ($class_name)
{
    global $_AUTOLOAD_;
    $_AUTOLOAD_->auto($class_name);
});