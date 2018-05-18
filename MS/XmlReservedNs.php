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
 * This class defines a set of common XML namespaces for sharing across multiple source files.
 * XmlReservedNs (public abstract)
 */
class XmlReservedNs
{
	/**
	 * @var string $NsWdXsl = "http://www.w3.org/TR/WD-xsl"
	 */
	const wdXsl = "http://www.w3.org/TR/WD-xsl";

	/**
	 * @var string $NsXml = "http://www.w3.org/XML/1998/namespace"
	 */
	const xml = "http://www.w3.org/XML/1998/namespace";

	/**
	 * @var string $NsXmlNs = "http://www.w3.org/2000/xmlns/"
	 */
	const xmlNs = "http://www.w3.org/2000/xmlns/";

	/**
	 * @var string $NsXs = "http://www.w3.org/2001/XMLSchema"
	 */
	const xs = "http://www.w3.org/2001/XMLSchema";

	/**
	 * @var string $NsXsd = "http://www.w3.org/2001/XMLSchema-datatypes"
	 */
	const xsd = "http://www.w3.org/2001/XMLSchema-datatypes";

	/**
	 * @var string $NsXsi = "http://www.w3.org/2001/XMLSchema-instance"
	 */
	const xsi = "http://www.w3.org/2001/XMLSchema-instance";

	/**
	 * @var string $NsXQueryFunc2003 = "http://www.w3.org/2003/11/xpath-functions"
	 */
	const xQueryFunc2003 = "http://www.w3.org/2003/11/xpath-functions";

	/**
	 * @var string $NsXQueryFunc = "http://www.w3.org/2005/xpath-functions"
	 */
	const xQueryFunc = "http://www.w3.org/2005/xpath-functions";

	/**
	 * @var string $NsXQueryFunc = "http://www.w3.org/2003/11/xpath-operators"
	 */
	const xQueryOp = "http://www.w3.org/2003/11/xpath-operators";

	/**
	 * @var string $NsXPathFunc = "http://www.w3.org/2005/xpath-functions"
	 */
	const xPathFunc = "http://www.w3.org/2005/xpath-functions";

	/**
	 * @var string $NsXqtErrors = "http://www.w3.org/2005/xqt-errors"
	 */
	const xqtErrors = "http://www.w3.org/2005/xqt-errors";

	/**
	 * @var string $NsXQueryDataType = "http://www.w3.org/2003/11/xpath-datatypes"
	 */
	const xQueryDataType = "http://www.w3.org/2003/11/xpath-datatypes";

	/**
	 * @var string $NsXQueryLocalFunc = "http://www.w3.org/2005/xquery-local-functions"
	 */
	const xQueryLocalFunc = "http://www.w3.org/2005/xquery-local-functions";

	/**
	 * @var string $NsCollationCodepoint = "http://www.w3.org/2005/xpath-functions/collation/codepoint"
	 */
	const collationCodepoint = "http://www.w3.org/2005/xpath-functions/collation/codepoint";

}



?>
