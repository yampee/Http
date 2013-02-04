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
 * Simple sessions manager.
 *
 * @author Titouan Galopin <galopintitouan@gmail.com>
 */
class Yampee_Http_Session
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->start();
	}

	/**
	 * Destructor
	 */
	public function __destruct()
	{
		$this->close();
	}

	/**
	 * @return Yampee_Http_Session
	 */
	public function close()
	{
		session_write_close();

		return $this;
	}

	/**
	 * @return Yampee_Http_Session
	 */
	public function start()
	{
		if (! $this->isStarted()) {
			session_start();
		}

		return $this;
	}

	/**
	 * @param $name
	 * @return bool
	 */
	public function has($name)
	{
		return isset($_SESSION['_attributes'][$name]);
	}

	/**
	 * @param string $name
	 * @param mixed  $default
	 * @return mixed
	 */
	public function get($name, $default = null)
	{
		if (! $this->has($name)) {
			return $default;
		}

		return $_SESSION['_attributes'][$name];
	}

	/**
	 * @param string $name
	 * @param mixed  $value
	 * @return Yampee_Http_Session
	 */
	public function set($name, $value)
	{
		$_SESSION['_attributes'][$name] = $value;

		return $this;
	}

	/**
	 * @return array
	 */
	public function all()
	{
		return $_SESSION['_attributes'];
	}

	/**
	 * @param $name
	 * @return bool
	 */
	public function hasFlash($name)
	{
		return isset($_SESSION['_flashes'][$name]);
	}

	/**
	 * @param string $name
	 * @param mixed  $default
	 * @return mixed
	 */
	public function getFlash($name, $default = null)
	{
		if (! $this->hasFlash($name)) {
			return $default;
		}

		$value = $_SESSION['_flashes'][$name];

		unset($_SESSION['_flashes'][$name]);

		return $value;
	}

	/**
	 * @param string $name
	 * @param mixed  $value
	 * @return Yampee_Http_Session
	 */
	public function setFlash($name, $value)
	{
		$_SESSION['_flashes'][$name] = $value;

		return $this;
	}

	/**
	 * @return array
	 */
	public function allFlashes()
	{
		return $_SESSION['_flashes'];
	}

	/**
	 * @return bool
	 */
	public function isStarted()
	{
		return session_id() != '';
	}
}