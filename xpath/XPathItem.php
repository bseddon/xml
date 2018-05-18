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

interface XPathItem
{
	/**
	 * @return bool
	 */
	function getIsNode();
	/**
	 * @return object
	 */
	function getTypedValue();
	/**
	 * @return string
	 */
	function getValue();
	/**
	 * @return bool
	 */
	function getValueAsBoolean();
	/**
	 * @return DateTime
	 */
	function getValueAsDateTime();
	/**
	 * @return double
	 */
	function getValueAsDouble();
	/**
	 * @return int
	 */
	function getValueAsInt();
	/**
	 * @return long
	 */
	function getValueAsLong();
	/**
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
	 * @param Type $returnType
	 * @param IXmlNamespaceResolver $nsResolver
	 *
	 * @return object
	 */
	function ValueAs( $returnType, $nsResolver );
}