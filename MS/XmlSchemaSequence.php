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
 *  Represents the sequence element (compositor) from the XML Schema as specified
 *  by the World Wide Web Consortium (W3C). The sequence requires the elements in
 *  the group to appear in the specified sequence within the containing element.
 */
class XmlSchemaSequence extends XmlSchemaGroupBase
{
	/**
	 * Initializes a new instance of the System.Xml.Schema.XmlSchemaSequence class.
	 */
	public function __construct() {}

	/**
	 * The elements contained within the compositor. Collection of System.Xml.Schema.XmlSchemaElement,
	 * System.Xml.Schema.XmlSchemaGroupRef, System.Xml.Schema.XmlSchemaChoice, System.Xml.Schema.XmlSchemaSequence,
	 * or System.Xml.Schema.XmlSchemaAny.
	 *
	 * @var XmlSchemaObjectCollection $Items
	 *     The elements contained within the compositor.
	 *     [XmlElement("any", typeof(XmlSchemaAny))]
	 *     [XmlElement("element", typeof(XmlSchemaElement))]
	 *     [XmlElement("group", typeof(XmlSchemaGroupRef))]
	 *     [XmlElement("choice", typeof(XmlSchemaChoice))]
	 *     [XmlElement("sequence", typeof(XmlSchemaSequence))]
	 */
	public $Items = null;
}
