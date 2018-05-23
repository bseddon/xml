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
 * Specifies the W3C XML schema data type variety of the type.
 */
class XmlSchemaDatatypeVariety
{
	/**
	 *     A W3C XML schema atomic type.
	 */
	const Atomic = 0;
	/**
	 *     A W3C XML schema list type.
	 */
	const List_ = 1;
	/**
	 *     A W3C XML schema union type.
	 */
	const Union = 2;

	/**
	 * Return the constant name corresponding to the $tokenValue
	 * @param int $varietyValue
	 * @return string
	 */
	public static function getVarietyName( $varietyValue )
	{
		// $oClass = new \ReflectionClass( "\lyquidity\XPath2\Token" );
		$oClass = new \ReflectionClass( __CLASS__ );
		foreach ( $oClass->getConstants() as $key => $value )
		{
			if ( $value == $varietyValue ) return $key;
		}

		return false;
	}

}