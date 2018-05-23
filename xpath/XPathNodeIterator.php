<?php
/**
 * Part of the XML Schema library for PHP
 *  _                      _     _ _ _
 * | |   _   _  __ _ _   _(_) __| (_) |_ _   _
 * | |  | | | |/ _` | | | | |/ _` | | __| | | |
 * | |__| |_| | (_| | |_| | | (_| | | |_| |_| |
 * |_____\__, |\__, |\__,_|_|\__,_|_|\__|\__, |
 *       |___/    |_|                    |___/
 *
 * @author Bill Seddon
 * @version 0.9
 * @Copyright (C) 2018 Lyquidity Solutions Limited
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace lyquidity\xml\xpath;

use lyquidity\xml\xpath\XPathNavigator;

/**
 * XPathNodeIteratorAdapter (final)
 */
class XPathNodeIterator // extends XPath2NodeIterator
{
	/**
	 * nav
	 * @var XPathNavigator $nav
	 */
	private $nav;

	/**
	 * A callback to allow the caller to determine the validity of the
	 * @var Callable $conditionalCallback
	 */
	private $conditionalCallback;

	/**
	 * True once the first node have been viewed
	 * @var bool
	 */
	private $initialized = false;

	/**
	 * Constructor
	 * @param XPathNavigator $nav
	 * @param Callable $conditionalCallback
	 */
	public function __construct( $nav, $conditionalCallback = null )
	{
		if ( is_null( $nav ) ) return;

		$this->nav = $nav->CloneInstance();
		$this->conditionalCallback = $conditionalCallback;
	}

	/**
	 * Clone
	 * @return XPathNodeIterator
	 */
	public function CloneInstance()
	{
		return new XPathNodeIterator( $this->nav );
	}

	/**
	 * getCurrent
	 * @return XPathNavigator
	 */
	public function getCurrent()
	{
		return $this->nav;
	}

	/**
	 * MoveNext
	 * @return bool
	 */
	public function MoveNext()
	{
		if ( ! isset( $this->nav ) || ! isset( $this->conditionalCallback ) ) return false;
		while ( $this->initialized ? $this->nav->MoveToNext() : $this->nav->MoveToFirst() )
		{
			$this->initialized = true;
			if ( call_user_func( $this->conditionalCallback, $this->nav->CloneInstance() ) ) return true;
		}

		return false;
	}

}


?>
