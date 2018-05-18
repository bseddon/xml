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
// Represents the list element from XML Schema as specified by the World Wide Web
// Consortium (W3C). This class can be used to define a simpleType element as a
// list of values of a specified data type.
 */
class XmlSchemaSimpleTypeList extends XmlSchemaSimpleTypeContent
{
	/**
	// Initializes a new instance of the System.Xml.Schema.XmlSchemaSimpleTypeList class.
	 */
	public function __construct() {}

	/**
	 * Gets or sets the System.Xml.Schema.XmlSchemaSimpleType representing the type
	 * of the simpleType element based on the System.Xml.Schema.XmlSchemaSimpleTypeList.ItemType
	 * and System.Xml.Schema.XmlSchemaSimpleTypeList.ItemTypeName values of the simple
	 * type.
	 *
	 * @var XmlSchemaSimpleType $BaseItemType
	 *     The System.Xml.Schema.XmlSchemaSimpleType representing the type of the simpleType
	 *     element.
	 */
	public $BaseItemType;

	/**
	 * Gets or sets the simpleType element that is derived from the type specified by
	 * the base value.
	 *
	 * @var XmlSchemaSimpleType $ItemType
	 *     The item type for the simple type element.
	 */
	public $ItemType;

	/**
	 * Gets or sets the name of a built-in data type or simpleType element defined in
	 * this schema (or another schema indicated by the specified namespace).
	 *
	 * @var XmlQualifiedName $ItemTypeName
	 *     The type name of the simple type list.
	 */
	public $ItemTypeName;
}