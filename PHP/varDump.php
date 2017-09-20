<?php

/**
 * Class VarDump
 * 实现 var_dump 函数
 */
class VarDump
{
    private static $isInLoop = false;
    private static $buffer = false;

    public static function dump()
    {
        $args = func_get_args();
        $args_num = func_num_args();
        if (self::$buffer && $args_num == 1) {
            $args = func_get_args();
            $args = isset($args[0]) ? $args[0] : [];
            if (!empty($args) && (is_array($args) || is_object($args))) {
                $args_num = count($args);
            }
        }
        self::$buffer = false;
        for ($i = 0; $i < $args_num; ++$i) {
            $param = $args[$i];
            $ptype = gettype($param);
            switch ($ptype) {
                case "NULL":
                    self::dump_null();
                    break;
                case "boolean":
                    self::dump_boolean($param);
                    break;
                case "integer":
                    self::dump_integer($param);
                    break;
                case "double":
                    self::dump_double($param);
                    break;
                case "string":
                    self::dump_string($param);
                    break;
                case "array":
                    self::dump_array($param);
                    break;
                case "object":
                    self::dump_object($param);
                    break;
                case "resource":
                    echo "resource";
                    break;
                default:
                    echo "unknown type";
            }
        }
    }

    public static function dumpx()
    {
        self::$buffer = true;
        ob_start();
        self::dump(func_get_args());
        $var = ob_get_clean();
        return $var;
    }

    public static function dump_null()
    {
        echo "NULL";
        if (!self::$isInLoop) {
            echo "\n";
        }
        self::$isInLoop = false;
    }

    public static function dump_boolean($bool)
    {
        if ($bool) {
            echo "bool(true)";
        } else {
            echo "bool(false)";
        }
        if (!self::$isInLoop) {
            echo "\n";
        }
        self::$isInLoop = false;
    }

    public static function dump_integer($int)
    {
        echo "int($int)";
        if (!self::$isInLoop) {
            echo "\n";
        }
        self::$isInLoop = false;
    }

    public static function dump_double($double)
    {
        echo "float($double)";
        if (!self::$isInLoop) {
            echo "\n";
        }
        self::$isInLoop = false;
    }

    public static function dump_string($str)
    {
        $len = strlen($str);
        $value = "string($len) \"$str\"";
        echo $value;
        if (!self::$isInLoop) {
            echo "\n";
        }
        self::$isInLoop = false;
    }

    public static function dump_array($arr)
    {
        static $pads = [];  //空数组,一定是静态的,不然不会层级缩进
        $keys = array_keys($arr);
        $len = count($arr);
        echo "array($len) {";
        array_push($pads, "    ");
        for ($i = 0; $i < $len; $i++) {
            echo "\n", implode('', $pads), "[\"$keys[$i]\"] => ";
            $index = $keys[$i];
            self::$isInLoop = true;
            self::dump($arr[$index]);
        }
        array_pop($pads);
        $pad = implode('', $pads);
        echo "\n{$pad}}";
        if ($pad == '') {
            echo "\n";
        }
    }

    public static function dump_prop($obj)
    {
        static $pads = [];
        $reflect = new ReflectionClass($obj);
        $prop = $reflect->getProperties();
        $len = count($prop);
        echo "($len) {";
        array_push($pads, "    ");
        for ($i = 0; $i < $len; $i++) {
            $index = $i;
            if (!$prop[$index]->isPublic()) {
                continue;
            }
            $prop_name = $prop[$index]->getName();
            echo "\n", implode('', $pads), "[\"{$prop_name}\"] => ";
            self::$isInLoop = true;
            self::dump($prop[$index]->getValue($obj));
        }
        array_pop($pads);
        $pad = implode('', $pads);
        echo "\n{$pad}}";
        if ($pad == '') {
            echo "\n";
        }
    }

    public static function dump_object($obj)
    {
        static $objId = 1;
        $className = get_class($obj);
        echo "object($className)#$objId";
        $objId++;
        self::dump_prop($obj);
    }
}


/* examples */

//test string and integer
$string = "I am a string";
$int = 1002;
VarDump::dump($string);
VarDump::dump($int);

//test object
class test1
{
    public $var1;
    public static $var2 = 'var2';
    private $var3 = 333;

    function test()
    {
        echo "test1 method";
    }
}
class MyClass
{
    public $var4 = 4444;
    protected $var5 = 55555;
    public $test1 = null;

    function __construct()
    {
        $this->test1 = new test1();
    }

    function test()
    {
        echo "MyClass method";
    }
}
VarDump::dump(new MyClass());

//test array
$arrTest = array(
    "name" => "jim",
    "courses" => array(
        "Physics" => "2016-2017",
        "Mathematics" => array(
            "Geometry" => "2017-2018",
            "Algebraic" => "2015-2016",
        )
    ),
    "age" => 20,
    "gender" => 'male',
    "teacher" => array(
        "Physics" => "lucy",
        "Geometry" => "lilei",
        "Algebraic" => "Russell",
    )
);
echo VarDump::dumpx($arrTest);

//outputs:
/*
string(13) "I am a string"
int(1002)
object(MyClass)#1(3) {
    ["var4"] => int(4444)
    ["test1"] => object(test1)#2(3) {
        ["var1"] => NULL
        ["var2"] => string(4) "var2"
    }
}
array(5) {
    ["name"] => string(3) "jim"
    ["courses"] => array(2) {
        ["Physics"] => string(9) "2016-2017"
        ["Mathematics"] => array(2) {
            ["Geometry"] => string(9) "2017-2018"
            ["Algebraic"] => string(9) "2015-2016"
        }
    }
    ["age"] => int(20)
    ["gender"] => string(4) "male"
    ["teacher"] => array(3) {
        ["Physics"] => string(4) "lucy"
        ["Geometry"] => string(5) "lilei"
        ["Algebraic"] => string(7) "Russell"
    }
}
*/