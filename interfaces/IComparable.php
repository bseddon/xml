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

namespace lyquidity\xml\interfaces;

/**
 * Defines a generalized type-specific comparison method that a value type or class
 * implements to order or sort its instances.
 */
interface IComparable
{
	/**
	 * Compares the current instance with another object of the same type and returns an integer that indicates whether
	 * the current instance precedes, follows, or occurs in the same position in the sort order as the other object.
	 *
	 * @param object $obj An object to compare with this instance.
	 * @return int	A value that indicates the relative order of the objects being compared. The
	 *				return value has these meanings: Value Meaning Less than zero This instance precedes
	 *				obj in the sort order. Zero This instance occurs in the same position in the
	 *				sort order as obj. Greater than zero This instance follows obj in the sort order.
	 *
	 * @throws ArgumentException obj is not the same type as this instance.
	 *
	 */
	function CompareTo( $obj );
}