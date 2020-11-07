<?php

namespace App\Utils;

class Tree
{
    protected static $config = array(
        /* 主键 */
        'primary_key' => 'id',
        /* 父键 */
        'parent_key' => 'parent_id',
        /* 展开属性 */
        'expanded_key' => 'expanded',
        /* 叶子节点属性 */
        'leaf_key' => 'leaf',
        /* 孩子节点属性 */
        'children_key' => 'children',
        /* 是否展开子节点 */
        'expanded' => false
    );

    /* 结果集 */
    protected static $result = array();

    /* 层次暂存 */
    protected static $level = array();

    /**
     * 生成树形结构
     * @param $data
     * @param array $options 二维数组
     * @return mixed 多维数组
     */
    public static function makeTree($data, $options = array())
    {
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                if ($value['parent_id'] == "0" || $value['parent_id'] == null) {
                    $data[$key]['parent_id'] = "";
                }
            }
            $dataSet = self::buildData($data, $options);
            $r = self::makeTreeCore('', $dataSet, 'normal');
            return $r;
        } else {
            return $data;
        }
    }

    /* 生成线性结构, 便于HTML输出, 参数同上 */

    private static function buildData(array $data, array $options)
    {
        $config = array_merge(self::$config, $options);
        self::$config = $config;
        extract($config);

        $r = array();
        foreach ($data as $item) {
            $id = $item[$primary_key];
            $parent_id = $item[$parent_key];
            $r[$parent_id][$id] = $item;
        }

        return $r;
    }

    /* 格式化数据, 私有方法 */

    private static function makeTreeCore($index, $data, $type = 'linear')
    {
        extract(self::$config);
        foreach ($data[$index] as $id => $item) {
            if ($type == 'normal') {
                if (isset($data[$id])) {
                    $item[$expanded_key] = self::$config['expanded'];
                    $item[$children_key] = self::makeTreeCore($id, $data, $type);
                } else {
                    $item[$leaf_key] = true;
                }
                $r[] = $item;
            } else if ($type == 'linear') {
                $parent_id = $item[$parent_key];
                self::$level[$id] = $index == 0 ? 0 : self::$level[$parent_id] + 1;
                $item['level'] = self::$level[$id];
                self::$result[] = $item;
                if (isset($data[$id])) {
                    self::makeTreeCore($id, $data, $type);
                }
                $r = self::$result;
            }
        }
        return $r;
    }

    /* 生成树核心, 私有方法  */

    public static function makeTreeForHtml($data, $options = array())
    {
        $dataSet = self::buildData($data, $options);
        $r = self::makeTreeCore(0, $dataSet, 'linear');
        return $r;
    }
}
