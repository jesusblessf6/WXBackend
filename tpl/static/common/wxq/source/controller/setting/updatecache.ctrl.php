<?php
/**
 * 更新系统配置
 * 更新模板缓存
 * 更新模块挂勾
 * ...
 * [WeEngine System] Copyright (c) 2013 WE7.CC
 */

include_once model('cache');
include_once model('setting');

if (checksubmit('submit')) {
	cache_build_announcement();
	cache_build_template();
	cache_build_modules();
	if (!empty($_W['isfounder'])) {
		setting_cache_account_by_founder();
	} else {
		setting_cache_account_by_uid($_W['uid']);
	}
	message('缓存更新成功！', create_url('setting/updatecache'));
} else {
	template('setting/updatecache');
}
