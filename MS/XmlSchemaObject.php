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

namespace lyquidity\xml\MS;

/**
 * Represents the root class for the Xml schema object model hierarchy and serves
 * as a base class for classes such as the System.Xml.Schema.XmlSchema class.
 */
abstract class XmlSchemaObject
{
	/**
	 * Initializes a new instance of the System.Xml.Schema.XmlSchemaObject class.
	 */
	protected function __construct() {}

	/**
	 * Gets or sets the line number in the file to which the schema element refers.
	 *
	 * @var int $LineNumber The line number.
	 */
	public $LineNumber;

	/**
	 * Gets or sets the line position in the file to which the schema element refers.
	 *
	 * @var int $LinePosition The line number.
	 */
	public $LinePosition;

	/**
	 * Gets or sets the System.Xml.Serialization.XmlSerializerNamespaces to use with this schema object.
	 *
	 * @var XmlSerializerNamespaces $Namespaces The System.Xml.Serialization.XmlSerializerNamespaces
	 * 											property for the schema object.
	 */
	public $Namespaces;

	/**
	 * Gets or sets the parent of this System.Xml.Schema.XmlSchemaObject.
	 *
	 * @var XmlSchemaObject $Parent The parent System.Xml.Schema.XmlSchemaObject of this System.Xml.Schema.XmlSchemaObject.
	 */
	public $Parent;

	/**
	 * Gets or sets the source location for the file that loaded the schema.
	 *
	 * @var string $SourceUri The source location (URI) for the file.
	 */
	public $SourceUri;
}
