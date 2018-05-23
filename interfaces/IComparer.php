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
 * Defines an interface that allows a class to declare is implements the compare function
 */
interface IComparer
{
	/**
	 * Compares two objects and returns a value indicating whether one is less than, equal to, or greater than the other.
	 *
	 * @param object $x The first object to compare.
	 * @param object $y The second object to compare.
	 * @return int  A signed integer that indicates the relative values of x and y, as shown in the
	 *              following table.Value Meaning Less than zero x is less than y. Zero x equals y.
	 *              Greater than zero x is greater than y.
	 *
	 * @throws ArgumentException 	Neither x nor y implements the System.IComparable interface.-or- x and y are
	 *    							of different types and neither one can handle comparisons with the other.
	 */
	function Compare( $x, $y );
}
