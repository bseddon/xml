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
 * Defines the post-schema-validation infoset of a validated XML node.
 */
interface IXmlSchemaInfo
{
	/**
	 * Gets a value indicating if this validated XML node was set as the result of a
	 * default being applied during XML Schema Definition Language (XSD) schema validation.
	 *
	 * @return bool	true if this validated XML node was set as the result of a default being applied
	 *				during schema validation; otherwise, false.
	 */
	public function getIsDefault();

	/**
	 * Gets a value indicating if the value for this validated XML node is nil.
	 *
	 * @return bool true if the value for this validated XML node is nil; otherwise, false.
	 */
	public function getIsNil();

	/**
	 * Gets the dynamic schema type for this validated XML node.
	 *
	 * @return XmlSchemaSimpleType	An XmlSchemaSimpleType object that represents the dynamic schema type for this validated XML node.
	 */
	public function getMemberType();

	/**
	 * Gets the compiled XmlSchemaAttribute that corresponds to this validated XML node.
	 *
	 * @return XmlSchemaAttribute  An XmlSchemaAttribute that corresponds to this validated XML node.
	 */
	public function getSchemaAttribute();

	/**
	 * Gets the compiled XmlSchemaElement that corresponds to this validated XML node.
	 *
	 * @return XmlSchemaElement An XmlSchemaElement that corresponds to this validated XML node.
	 */
	public function getSchemaElement();

	/**
	 * Gets the static XML Schema Definition Language (XSD) schema type of this validated XML node.
	 *
	 * @return XmlSchemaType An XmlSchemaType of this validated XML node.
	 */
	public function getSchemaType();

	/**
	 * Gets the XmlSchemaValidity value of this validated XML node.
	 *
	 * @return XmlSchemaValidity An XmlSchemaValidity value of this validated XML node.
	 */
	public function getValidity();
}
