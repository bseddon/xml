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
 * Represents the union element for simple types from XML Schema as specified by
 * the World Wide Web Consortium (W3C). A union datatype can be used to specify
 * the content of a simpleType. The value of the simpleType element must be any
 * one of a set of alternative datatypes specified in the union. Union types are
 * always derived types and must comprise at least two alternative datatypes.
 */
class XmlSchemaSimpleTypeUnion extends XmlSchemaSimpleTypeContent
{
	/**
	 * Initializes a new instance of the System.Xml.Schema.XmlSchemaSimpleTypeUnion class.
	 */
	public function __construct() {}

	/**
	 * Gets an array of System.Xml.Schema.XmlSchemaSimpleType objects representing the
	 * type of the simpleType element based on the System.Xml.Schema.XmlSchemaSimpleTypeUnion.BaseTypes
	 * and System.Xml.Schema.XmlSchemaSimpleTypeUnion.MemberTypes values of the simple
	 * type.
	 *
	 * @var XmlSchemaSimpleType[] $BaseMemberTypes
	 *     An array of System.Xml.Schema.XmlSchemaSimpleType objects representing the type
	 *     of the simpleType element.
	 */
	public $BaseMemberTypes;

	/**
	 * Gets the collection of base types.
	 *
	 * @var XmlSchemaObjectCollection $BaseTypes
	 *     The collection of simple type base values.
	 */
	public $BaseTypes;

	/**
	 * Gets or sets the array of qualified member names of built-in data types or simpleType
	 * elements defined in this schema (or another schema indicated by the specified namespace).
	 *
	 * @var XmlQualifiedName[] $MemberTypes
	 *     An array that consists of a list of members of built-in data types or simple types.
	 */
	public $MemberTypes = array();
}