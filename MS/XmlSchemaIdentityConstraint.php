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
 *     Class for the identity constraints: key, keyref, and unique elements.
 */
class XmlSchemaIdentityConstraint extends XmlSchemaAnnotated
{
	/**
	 * Initializes a new instance of the System.Xml.Schema.XmlSchemaIdentityConstraint class.
	 */
	public function __construct() {}

	/**
	 * Gets the collection of fields that apply as children for the XML Path Language (XPath) expression selector.
	 *
	 * @var array $Fields The collection of fields.
	 */
	public $Fields = array();

	/**
	 * Gets or sets the name of the identity constraint.
	 *
	 * @var string The name of the identity constraint.
	 */
	public $Name;

	/**
	 * Gets the qualified name of the identity constraint, which holds the post-compilation value of the QName property.
	 *
	 * @var QName $XmlQualifiedName The post-compilation value of the QName property.
	 */
	public $XmlQualifiedName;

	/**
	 * Gets or sets the XPath expression selector element.
	 *
	 * @var XmlSchemaXPath $Selector The XPath expression selector element.
	 */
	public $Selector;
}
