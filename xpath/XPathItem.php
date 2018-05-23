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

namespace lyquidity\xml\xpath;

/**
 * Interface allows a class to declare that is supports being an XPathItem
 */
interface XPathItem
{
	/**
	 * True if the item is a node (vs a value)
	 * @return bool
	 */
	function getIsNode();

	/**
	 * Returns the item value coerced to a specific type
	 * @return object
	 */
	function getTypedValue();

	/**
	 * returns the raw value
	 * @return string
	 */
	function getValue();

	/**
	 * Returns the value coerced to a boolean
	 * @return bool
	 */
	function getValueAsBoolean();

	/**
	 * Returns the value coerced to a datetime
	 * @return DateTime
	 */
	function getValueAsDateTime();

	/**
	 * Returns the value coerced to a double
	 * @return double
	 */
	function getValueAsDouble();

	/**
	 * Returns the value coerced to an integer
	 * @return int
	 */
	function getValueAsInt();

	/**
	 * Returns the value coerced to a long
	 * @return long
	 */
	function getValueAsLong();

	/**
	 * Returns the Xml type of the value
	 * @return Type $ValueType
	 */
	function getValueType();

	/**
	 * When overridden in a derived class, gets the XmlSchemaType for the item.
	 *
	 * @return XmlSchemaType The XmlSchemaType for the item.
	 */
	function getSchemaType();

	/**
	 * Return the value as a specific type defined in $returnType
	 * @param Type $returnType
	 * @param IXmlNamespaceResolver $nsResolver
	 *
	 * @return object
	 */
	function ValueAs( $returnType, $nsResolver );
}