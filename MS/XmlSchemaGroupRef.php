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
 *     Represents the group element with ref attribute from the XML Schema as specified
 *     by the World Wide Web Consortium (W3C). This class is used within complex types
 *     that reference a group defined at the schema level.
 */
class XmlSchemaGroupRef extends XmlSchemaParticle
{
	/**
	 * Initializes a new instance of the System.Xml.Schema.XmlSchemaGroupRef class.
	 */
	public function __construct() {}

	/**
	 * Gets one of the System.Xml.Schema.XmlSchemaChoice, System.Xml.Schema.XmlSchemaAll,
	 * or System.Xml.Schema.XmlSchemaSequence classes, which holds the post-compilation
	 * value of the Particle property.
	 *
	 * @var XmlSchemaGroupBase $Particle
	 *     The post-compilation value of the Particle property, which is one of the System.Xml.Schema.XmlSchemaChoice,
	 *     System.Xml.Schema.XmlSchemaAll, or System.Xml.Schema.XmlSchemaSequence classes.
	 */
	public $Particle;

	/**
	 * Gets or sets the name of a group defined in this schema (or another schema indicated
	 * by the specified namespace).
	 *
	 * @var XmlQualifiedName $RefName
	 *     The name of a group defined in this schema.
	 */
	public $RefName;
}
