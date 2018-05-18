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
 * Abstract class for that is the base class for all particle types (e.g. System.Xml.Schema.XmlSchemaAny).
 */
abstract class XmlSchemaParticle extends XmlSchemaAnnotated
{
	/**
	 * Initializes a new instance of the System.Xml.Schema.XmlSchemaParticle class.
	 */
	public function __construct() {}

	/**
	 * Gets or sets the maximum number of times the particle can occur.
	 *
	 * @var double $MaxOccurs
	 *     The maximum number of times the particle can occur. The default is 1.
	 */
	public $MaxOccurs = 1;

	/**
	 * Gets or sets the number as a string value. Maximum number of times the particle can occur.
	 *
	 * @var string $MaxOccursString
	 *     The number as a string value. String.Empty indicates that MaxOccurs is equal
	 *     to the default value. The default is a null reference.
	 */
	public $MaxOccursString = null;

	/**
	 * Gets or sets the minimum number of times the particle can occur.
	 *
	 * @var double $MinOccurs
	 *     The minimum number of times the particle can occur. The default is 1.
	 */
	public $MinOccurs = 0;

	/**
	 * Gets or sets the number as a string value. The minimum number of times the particle can occur.
	 *
	 * @var string MinOccursString
	 *     The number as a string value. String.Empty indicates that MinOccurs is equal
	 *     to the default value. The default is a null reference.
	 */
	public $MinOccursString = null;
}
