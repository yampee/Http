<?php

/*
 * Yampee Components
 * Open source web development components for PHP 5.
 *
 * @package Yampee Components
 * @author Titouan Galopin <galopintitouan@gmail.com>
 * @link http://titouangalopin.com
 */

/**
 * HTTP request
 */
class Yampee_Http_Request
{
	/**
	 * @var array $attributes
	 */
	private $attributes;

	/**
	 * @param array $attributes
	 */
	public function __construct($attributes = array())
	{
		$this->attributes = $attributes;
	}

	/**
	 * @return Yampee_Http_Request
	 */
	public static function createFromGlobals()
	{
		return new self(array_merge($_GET, $_POST, $_SERVER));
	}

	/**
	 * @param array $attributes
	 */
	public function setAttributes(array $attributes)
	{
		$this->attributes = $attributes;
	}

	/**
	 * @return array
	 */
	public function getAttributes()
	{
		return $this->attributes;
	}

	/**
	 * @param $key
	 *
	 * @return bool
	 */
	public function get($key)
	{
		$attributes = array();

		foreach($this->attributes as $attrKey => $attrValue) {
			$attributes[strtolower($attrKey)] = $attrValue;
		}

		return (isset($attributes[strtolower($key)])) ? $attributes[strtolower($key)] : false;
	}
}