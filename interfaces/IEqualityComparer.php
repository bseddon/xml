<?php
/**
 * Part of the XML Schema library for PHP
 *  _					   _	 _ _ _
 * | |   _   _  __ _ _   _(_) __| (_) |_ _   _
 * | |  | | | |/ _` | | | | |/ _` | | __| | | |
 * | |__| |_| | (_| | |_| | | (_| | | |_| |_| |
 * |_____\__, |\__, |\__,_|_|\__,_|_|\__|\__, |
 *	     |___/	  |_|					 |___/
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

namespace lyquidity\xml\interfaces;

/**
 * Defines methods to support the comparison of objects for equality.
 */
interface IEqualityComparer
{
	/**
	 * Determines whether the specified objects are equal.
	 *
	 * @param object $x The first object to compare.
	 * @param object $y The second object to compare.
	 * @return bool true if the specified objects are equal; otherwise, false.
	 * @throws ArgumentException x and y are of different types and neither one can handle comparisons with the other.
	 */
	function Equals( $x, $y );
	/**
	 * Returns a hash code for the specified object.
	 *
	 * @param obj The System.Object for which a hash code is to be returned.
	 * @return int A hash code for the specified object.
	 * @throws ArgumentNullException The type of obj is a reference type and obj is null.
	 */
	function GetHashCode( $obj);
}