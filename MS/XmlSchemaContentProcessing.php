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
// Provides information about the validation mode of any and anyAttribute element replacements.
 */
class XmlSchemaContentProcessing
{
	/**
	 * Document items are not validated.
	 */
	const None = 0;
	/**
	 * Document items must consist of well-formed XML and are not validated by the schema.
	 */
	const Skip = 1;
	/**
	 * If the associated schema is found, the document items will be validated. No errors
	 * will be thrown otherwise.
	 */
	const Lax = 2;
	/**
	 * The schema processor must find a schema associated with the indicated namespace
	 * to validate the document items.
	 */
	const Strict = 3;
}