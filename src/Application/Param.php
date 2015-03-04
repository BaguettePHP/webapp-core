<?php
namespace Baguette\Application;
use Baguette;

/**
 * Param trait for Application (filter_var wrapper)
 *
 * @package   Baguette\Application
 * @author    USAMI Kenta <tadsan@zonu.me>
 * @copyright 2015 USAMI Kenta
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 * @link      http://php.net/manual/function.filter-var.php
 */
trait Param
{
    private static $BODY_METHODS = ['POST', 'PUT'];

    /**
     * @param  string $name
     * @param  int    $filter
     * @param  array  $option
     * @return mixed
     */
    public function getParam($name, $filter = FILTER_DEFAULT, array $option = [])
    {
        $value = $this->getParamFilter($name, $filter, ['options' => $option], false);

        if ($value === null && isset($option['default'])) {
            return $option['default'];
        }

        return $value;
    }

    /**
     * @param  string $name
     * @param  int    $filter
     * @param  array  $option
     * @return array
     */
    public function getParamAsArray($name, $filter = FILTER_DEFAULT, array $option = [])
    {
        $value = $this->getParamFilter($name, $filter, ['options' => $option], true);

        if ($value === [] && isset($option['default'])) {
            return $option['default'];
        }

        return $value;
    }

    /**
     * @param  $name
     * @param  int     $filter
     * @param  mixed   $filter_option
     * @param  boolean $get_array
     * @return mixed
     */
    public function getParamFilter($name, $filter, $filter_option = [], $get_array = null)
    {
        /** @var \Baguette\Application $this */

        $params = [$this->get];

        if (in_array($this->server['REQUEST_METHOD'], self::$BODY_METHODS, true)) {
            array_unshift($params, $this->post);
        }

        $value = $get_array ? [] : null;

        foreach ($params as $p) {
            if (!isset($p[$name])) { continue; }

            $v = $p[$name];
            $is_array = is_array($v);

            if (($get_array !== null) && ($is_array !== $get_array)) { continue; }

            $value = self::filterParam($v, $filter, $filter_option);
            break;
        }

        return $value;
    }

    /**
     * @param   mixed $value
     * @param   int   $filter
     * @param   mixed $filter_option
     * @return  mixed
     */
    protected static function filterParam($value, $filter = FILTER_DEFAULT, $filter_option = null)
    {
        $is_array = is_array($value);
        $values = $is_array ? $value : [$value];

        $result = [];
        foreach ($values as $k => $v) {
            $result[$k] = filter_var($v, $filter, $filter_option);
        }

        return $is_array ? $result : $result[0];
    }
}
