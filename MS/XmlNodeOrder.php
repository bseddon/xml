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
* along with this program.  If not, see <http: *www.gnu.org/licenses/>.
*
*/

namespace lyquidity\xml\MS;

/**
 * Defines a set of values that can be used to provide information about the relative position of two nodes
 */
class XmlNodeOrder
{
	const Before = 0;
	const After = 1;
	const Same = 2;
	const Unknown = 3;

	/**
	 * Returns a string version of the value
	 * @param XmlNodeOrder $nodeOrder
	 * @return string
	 */
	public static function toString( $nodeOrder )
	{
		// $oClass = new \ReflectionClass( "\lyquidity\XPath2\Token" );
		$oClass = new \ReflectionClass( __CLASS__ );
		foreach ( $oClass->getConstants() as $key => $value )
		{
			if ( $value == $nodeOrder ) return $key;
		}

		return chr( $nodeOrder + 65 );
	}

}
