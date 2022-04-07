<?php

/**
 * CustomerRepo.php
 *
 * @copyright 2022 wkld.com - All Rights Reserved
 * @link https://www.wkld.com
 * @author stiffer.chen <2181867045@qq.com>
 * @created 2022-04-07 16:37:24
 * @modified 2022-04-07 16:37:24
 */

namespace App\Repositories;

class CustomerRepo
{
    /**
     * 获取当前登录用户的详细信息
     *
     * @return array
     */
    public static function infos(): array
    {
        $customerInfo = registry('customer_info') ?? null;
        if (empty($customerInfo)) {
            return [];
        }
        $customer = $customerInfo['customer'];
        if (empty($customer)) {
            return [];
        }
        $scopes = $customer->scopes ?? [];
        if (empty($scopes)) {
            return [];
        }
        $scopeDetail = $scopes[0] ?? '';
        if (empty($scopeDetail)) {
            return [];
        }
        $authority = self::authority($scopeDetail);
        $customerInfo['authority'] = $authority;
        return $customerInfo;
    }

    /**
     * 解析用户授权信息
     *
     * @param array $authUser
     * @return array
     */
    public static function authInfo(array $authUser): array
    {
        if (empty($authUser)) {
            return [];
        }
        $firstName = (string)($authUser['firstName'] ?? '');
        $lastName = (string)($authUser['lastName'] ?? '');
        $fullName = trim($firstName . $lastName);
        $authUser['fullName'] = $fullName;
        return $authUser;
    }

    /**
     *
     * @param string $scope
     * @return array
     */
    public static function authority(string $scope): array
    {
        if (!$scope) {
            return [];
        }
        $lowerScope = strtolower($scope);
        return [
            'code' => $scope,
            'title' => __("customer.authority_{$lowerScope}")
        ];
    }
}