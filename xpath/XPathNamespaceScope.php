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
 * Provides a list of values that define the possible scope of a namespace
 */
class XPathNamespaceScope
{
	/**
	 * Returns all namespaces defined in the scope of the current node. This includes the xmlns:xml namespace
	 * which is always declared implicitly. The order of the namespaces returned is not defined.
	 */
	const All = 0;

	/**
	 * Returns all namespaces defined in the scope of the current node, excluding the xmlns:xml namespace. The
	 * xmlns:xml namespace is always declared implicitly. The order of the namespaces returned is not defined.
	 */
	const ExcludeXml = 1;

	/**
	 * Returns all namespaces that are defined locally at the current node.
	 */
	const Local = 2;
}
