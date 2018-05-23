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

namespace lyquidity\xml\DOM;

use \lyquidity\xml\MS\IXmlNamespaceResolver;
use \lyquidity\xml\exceptions\NotSupportedException;

/**
 * Implements the functions required to implement the IXmlNamespaceResolver interface
 */
trait DOMNamespaceResolver
{
	/**
	 * Not used
	 * Returns the in-scope namespaces of the current node.
	 *
	 * @param XmlNamespaceScope $scope : IDictionary<string, string> An XmlNamespaceScope value specifying the namespaces to return.
	 *
	 * @return array An array of namespace names keyed by prefix.
	 */
	public function GetNamespacesInScope( $scope )
	{
		throw new NotSupportedException( "XPathNavigator::GetNamespacesInScope" );
	}

	/**
	 * Not used
	 * Gets the namespace URI for the specified prefix.
	 *
	 * @param string $prefix The prefix whose namespace URI you want to resolve. To match the default namespace, pass Empty.
	 *
	 * @return	A string that contains the namespace URI assigned to the namespace prefix
	 *     		specified; null if no namespace URI is assigned to the prefix specified. The
	 *     		string returned is atomized.
	 */
	public function LookupNamespace( $prefix )
	{
		throw new NotSupportedException( "XPathNavigator::LookupNamespace" );
	}

	/**
	 * Not used
	 * Gets the prefix declared for the specified namespace URI.
	 *
	 * @param string $namespaceURI : The namespace URI to resolve for the prefix.
	 *
	 * @return	A string that contains the namespace prefix assigned to the namespace URI specified; otherwise,
	 * 			Empty if no prefix is assigned to the namespace URI specified. The string returned is atomized.
	 */
	public function LookupPrefix( $namespaceURI )
	{
		throw new NotSupportedException( "XPathNavigator::LookupPrefix" );
	}
}