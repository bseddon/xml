<?php

/**
 * Part of the XML for PHP library
 *  _                      _     _ _ _
 * | |   _   _  __ _ _   _(_) __| (_) |_ _   _
 * | |  | | | |/ _` | | | | |/ _` | | __| | | |
 * | |__| |_| | (_| | |_| | | (_| | | |_| |_| |
 * |_____\__, |\__, |\__,_|_|\__,_|_|\__|\__, |
 *       |___/    |_|                    |___/
 *
 * @author Bill Seddon
 * @version 0.9
 * @Copyright (C) 2017 Lyquidity Solutions Limited
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

namespace lyquidity\XPath2;

/**
 * Defines a set of core functions for an XPath expression evaluator
 */
abstract class XPathExpression
{
	/**
	 * Expression
	 * @var string $Expression
	 */
	public $Expression;

	/**
	 * Return type
	 * @var XPathResultType
	 */
	public $ReturnType;

	/**
	 * Compile the expression and return an XPathExpression instance
	 * @param string $xpath
	 * @param IXmlNamespaceResolver $nsResolver
	 * @return XPathExpression
	 * @throw XPath2Expression
	 */
	public function Compile( $xpath, $nsResolver = null ) {}

	/**
	 * CloneInstance
	 * @return XPathExpression
	 */
	public function CloneInstance() {}

	/**
	 * SetContext
	 * @param XmlNamespaceManager $nsManager
	 * @return void
	 */
	public function SetContext( $nsManager) {}

}