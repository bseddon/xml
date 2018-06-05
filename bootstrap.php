<?php

/**
 * QName class and factory functions.  This is ported from Arelle.
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

namespace lyquidity\xml;

require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/schema/SchemaTypes.php';

/**
 * Load a class by name
 * @param string $className
 */
function autoload( $className )
{
	switch( $className )
	{
		case __NAMESPACE__ . "\\QName":
			require_once __DIR__ . "/QName.php";
			return true;

		case __NAMESPACE__ . "\\SchemaTypes":
			require_once __DIR__ . "/schema/SchemaTypes.php";
			return true;

		case __NAMESPACE__ . "\\TypeCode":
			require_once __DIR__ . "/TypeCode.php";
			return true;
	}

	// The exceptions are a case of their own
	// if ( schema\SchemaTypes::endsWith( $className, "Exception" ) && ! schema\SchemaTypes::endsWith( $className, "yyException" )  && ! schema\SchemaTypes::startsWith( $className, "XBRL\\Formulas" ) )
	if ( schema\SchemaTypes::endsWith( $className, "Exception" ) && schema\SchemaTypes::startsWith( $className, __NAMESPACE__ ) )
	{
		$path = __DIR__ . '/exceptions/Exceptions.php';

		if ( file_exists( $path ) )
		{
			require_once $path;
			return true;
		}
		return false;
	}

	if (
		strpos( $className, __NAMESPACE__ . '\\MS' ) !== false ||
		strpos( $className, __NAMESPACE__ . '\\xpath' ) !== false ||
		strpos( $className, __NAMESPACE__ . '\\DOM' ) !== false ||
		strpos( $className, __NAMESPACE__ . '\\interfaces' ) !== false
	)
	{
		$path = str_replace( '\\', DIRECTORY_SEPARATOR, str_replace( "lyquidity\xml", __DIR__,  $className ) . ".php" );
		if ( file_exists( $path ) )
		{
			require_once $path;
		}
	}

	return false;
}

spl_autoload_register( "\\lyquidity\\xml\\autoload" );

?>