<?php

namespace App\Service;


class ProductHandler
{
    /**
     * 需求1 ：计算总价
     * @param array $products
     * @return int
     */
    public static function getTotalPrice($products)
    {
        if (empty($products)) {
            return 0;
        }

        $totalPrice = 0;
        foreach ($products as $product) {
            $price = $product['price'] ?: 0;
            $totalPrice += $price;
        }

        return $totalPrice;
    }


    /**
     * 需求2 ： 过滤并按price字段排序
     * @param $products
     * @param int $sort 价格排序
     * @param string $field 过滤key
     * @param string $value 过滤val
     * @return array
     */
    public static function sortAndFilter($products, $field = '', $value = '',$sort = SORT_DESC)
    {
        if (empty($products)) {
            return [];
        }

        //过滤
        $filter = self::filterFieldValue($products, $field, $value);

        //排序
        $arr = array_column($filter, 'price');
        array_multisort($arr, $sort, $filter);

        return $filter;

    }


    /**
     * 需求3 ：转化时间戳
     * @param $products
     */
    public static function dateToTimeStamp($products)
    {
        if ($products) {
            foreach ($products as $k => $v) {
                if (isset($v['create_at']) && $v['create_at']) {
                    $timeStamp = strtotime($v['create_at']);
                    $products[$k]['create_at'] = $timeStamp !== FALSE ? $timeStamp : 0;
                }
            }
        }

        return $products;


    }

    /**
     * 过滤商品列表
     * @param $products
     * @param $field
     * @param $value
     * @return array
     */
    private static function filterFieldValue($products, $field, $value)
    {
        if ($products && $field && $value) {
            return array_filter($products, function ($row) use ($field, $value) {
                if (isset($row[$field])) {
                    return $row[$field] == $value;
                }
            });
        }
        return $products;

    }

}