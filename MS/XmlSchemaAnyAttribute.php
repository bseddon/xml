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
 * Represents the World Wide Web Consortium (W3C) anyAttribute element.
 */
class XmlSchemaAnyAttribute extends XmlSchemaAnnotated
{
	/**
	 * Initializes a new instance of the System.Xml.Schema.XmlSchemaAnyAttribute class.
	 */
	public function __construct() {}

	/**
	 * Gets or sets the namespaces containing the attributes that can be used.
	 *
	 * @var string $Namespace
	 *     Namespaces for attributes that are available for use. The default is ##any.Optional.
	 */
	public $Namespace = "##any";

	/**
	 * Gets or sets information about how an application or XML processor should handle
	 * the validation of XML documents for the attributes specified by the anyAttribute
	 * element.
	 *
	 * @var XmlSchemaContentProcessing $ProcessContents
	 *     One of the XmlSchemaContentProcessing values. If no processContents
	 *     attribute is specified, the default is Strict.
	 */
	public $ProcessContents = XmlSchemaContentProcessing::None;
}
