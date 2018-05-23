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
 *     Represents the simpleType element for simple content from XML Schema as specified
 *     by the World Wide Web Consortium (W3C). This class defines a simple type. Simple
 *     types can specify information and constraints for the value of attributes or
 *     elements with text-only content.
 */
class XmlSchemaSimpleType extends XmlSchemaType
{
	/**
	 * Initializes a new instance of the System.Xml.Schema.XmlSchemaSimpleType class.
	 */
	public function __construct() {}

	/**
	 * NOT USED
	 * Gets or sets one of XmlSchemaSimpleTypeUnion, XmlSchemaSimpleTypeList,
	 * or XmlSchemaSimpleTypeRestriction.
	 *
	 * @var XmlSchemaSimpleTypeContent $Content
	 *     One of XmlSchemaSimpleTypeUnion, XmlSchemaSimpleTypeList, or XmlSchemaSimpleTypeRestriction.
	 *
	 *     [XmlElement("union", typeof(XmlSchemaSimpleTypeUnion))]
	 *     [XmlElement("restriction", typeof(XmlSchemaSimpleTypeRestriction))]
	 *     [XmlElement("list", typeof(XmlSchemaSimpleTypeList))]
	 */
	public $Content;
}
