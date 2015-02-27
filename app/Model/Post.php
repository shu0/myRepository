<?php
/**
 * Created by PhpStorm.
 * User: shugoikeda
 * Date: 15/02/24
 * Time: 13:42
 */

class Post extends AppModel {
	public $validate = array(
		'title' => array(
			'rule' => 'notEmpty'
		),
		'body' => array(
			'rule' => 'notEmpty'
		)
	);
}
