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
 * Represents the keyref element from XML Schema as specified by the World Wide Web Consortium (W3C).
 */
class XmlSchemaKeyRef extends XmlSchemaIdentityConstraint
{
	/**
	 * Initializes a new instance of the XmlSchemaKeyRef class.
	 */
	public function __construct() {}

	/**
	 * Gets or sets the name of the key that this constraint refers to in another simple or complex type.
	 *
	 * @var QName $Refer The QName of the key that this constraint refers to.
	 */
	public $Refer;
}