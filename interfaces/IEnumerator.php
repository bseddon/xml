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
 *     Supports a simple iteration over a non-generic collection.
 */
interface IEnumerator
{
	/**
	 * Gets the current element in the collection.
	 *
	 * @returns object The current element in the collection.
	 */
	function getCurrent();

	/**
	 * Advances the enumerator to the next element of the collection.
	 *
	 * @return bool	true if the enumerator was successfully advanced to the next element; false if
	 *     			the enumerator has passed the end of the collection.
	 *
	 * @throws InvalidOperationException The collection was modified after the enumerator was created.
	 */
	function MoveNext();

	/**
	 * Sets the enumerator to its initial position, which is before the first element in the collection.
	 *
	 * @throws InvalidOperationException  The collection was modified after the enumerator was created.
	 */
	function Reset();
}
